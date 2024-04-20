import torch
from torch import nn
from torch.nn import init
import torch.nn.functional as F

class GraphAttentionLayer(nn.Module):
    def __init__(self, in_c, out_c, dropout):
        super(GraphAttentionLayer, self).__init__()
        self.in_c = in_c
        self.out_c = out_c
        self.dropout = dropout
        self.F = F.softmax

        self.W = nn.Linear(in_c, out_c, bias=False)  # y = W * x
        self.b = nn.Parameter(torch.Tensor(out_c))

        nn.init.normal_(self.W.weight)
        nn.init.normal_(self.b)

    def forward(self, inputs, graph):
        """
        :param inputs: input features, [B, N, C].
        :param graph: graph structure, [N, N].
        :return:
            output features, [B, N, D].
        """
        # inputs = inputs.reshape(inputs.size(0),307,-1)
        h = self.W(inputs)  # [B, N, D]

        outputs = torch.bmm(h, h.transpose(1, 2)) * graph.unsqueeze(0)
        outputs.data.masked_fill_(torch.eq(outputs, 0), -float(1e16))
        attention = self.F(outputs, dim=2).to(torch.float32)

        return torch.bmm(attention, h) + self.b  # [B, N, N] * [B, N, D]     
    
    
class GAT(nn.Module):
    def __init__(self, history_length, gat_hidden, gat_output, gat_heads,  dropout):
        super(GAT, self).__init__()
        self.dropout = dropout
        self.attention_module = nn.ModuleList(
            [GraphAttentionLayer(history_length, gat_hidden, dropout) for _ in range(gat_heads)])
        self.out_att = GraphAttentionLayer(gat_hidden * gat_heads, gat_output, dropout)

        self.act = nn.LeakyReLU(0.2)

    def forward(self, x, graph):
        """
        :param inputs: [B, N, C]
        :param graph: [N, N]
        :return:
        """
        B, N = x.size(0), x.size(1)
        x = x.view(B, N, -1)  
        outputs = torch.cat([attn(x, graph) for attn in self.attention_module], dim=-1)  
        outputs = self.act(outputs)
        outputs = self.out_att(outputs, graph)
        return self.act(outputs)

class GATNet(nn.Module):
    def __init__(self, in_dim, hidden_dim, out_dim, num_heads,num_nodes):
        super(GATNet, self).__init__()
        self.dropout=0.2
        self.num_nodes=num_nodes
        self.in_dim=in_dim
        self.out_dim=out_dim
        self.gat1 = GAT(in_dim, hidden_dim, out_dim,num_heads,self.dropout)
        self.gat2 = GAT(num_nodes, hidden_dim, out_dim,num_heads,self.dropout)
        self.outLayer=nn.Linear(16,3)

    def forward(self, x, adj):
        x = self.gat1(x.to(torch.float32), adj)
        x = self.gat2(x, adj)

        x=self.outLayer(x)
        # x=x.reshape(x.shape[0],self.num_nodes,self.in_dim)
        x=torch.permute(x,(0,2,1))
        return x




class GCNConv(nn.Module):
    def __init__(self, in_features, out_features):
        super(GCNConv, self).__init__()
        self.linear = nn.Linear(in_features, out_features, bias=False)

    def forward(self, x: torch.Tensor, adjacency_hat: torch.sparse_coo_tensor):
        x = self.linear(x)
        x = torch.sparse.mm(x,adjacency_hat)
        return x


class GCN(nn.Module):
    def __init__(self, input_size, hidden_size, output_size, num_hidden_layers=0, dropout=0.1, residual=False):
        super(GCN, self).__init__()

        self.dropout = dropout
        self.residual = residual

        self.input_conv = GCNConv(input_size, hidden_size)
        self.hidden_convs = nn.ModuleList([GCNConv(hidden_size, hidden_size) for _ in range(num_hidden_layers)])
        self.output_conv = GCNConv(hidden_size, output_size)

    def forward(self, x: torch.Tensor, adjacency_hat: torch.sparse_coo_tensor, labels: torch.Tensor = None):
        # b=a.to_sparse()
        B,N,D=x.shape
        x=x.reshape([B*N,D])

        x = F.relu(self.input_conv(x, adjacency_hat))
        for conv in self.hidden_convs:
            if self.residual:
                x = F.relu(conv(x, adjacency_hat)) + x
            else:
                x = F.relu(conv(x, adjacency_hat))
        x = F.dropout(x, p=self.dropout, training=self.training)
        x = self.output_conv(x, adjacency_hat)

        if labels is None:
            return x

        loss = nn.CrossEntropyLoss()(x, labels)
        return x, loss


class Generator(nn.Module):

    def __init__(self,node_num, in_features, out_features):
        super(Generator, self).__init__()

        self.node_num = node_num
        self.in_features = in_features
        self.out_features = out_features
        # self.gcn = GraphConvolution(device,in_features, out_features)
        self.gcn = GCN(self.node_num ,node_num ,out_features)
        self.gat=GATNet(in_dim=in_features,hidden_dim=64,out_dim=node_num,num_heads=3,num_nodes=self.node_num)
        # self.ffn = nn.Sequential(
        #     nn.Linear(lstm_features, node_num * node_num),
        #     nn.Sigmoid()
        # )

    def forward(self, in_shots,adj):
        """
        :param in_shots: FloatTensor (batch_size, window_size, node_num, node_num)
        :return out_shot: FloatTensor (batch_size, node_num * node_num)
        """
        batch_size,  ti_num,dim_num = in_shots.size()


        # nodes = torch.rand(batch_size, window_size, node_num, self.in_features).cuda()
        gcn_output = self.gcn(in_shots,adj)
        gat_input=gcn_output.reshape([batch_size,  ti_num,dim_num ])
        adj_den=adj.to_dense()
        gat_input=torch.permute(gat_input,(0,2,1))
        gat_output = self.gat(gat_input,adj_den)
        # gat_output = torch.permute(gat_output,(0,2,1))#gat_output.view(batch_size, -1)
        # _, (hn, _) = self.lstm(gcn_output)
        # output = self.ffn(hn)
        return gat_output


# Description: GCN 模型的定义，包含一个简单的 GCN 模型定义，用于在 gcn_server.py 中使用，以及一个简单的训练和预测函数

import torch.nn.functional as F
import torch
from torch_geometric.nn import GCNConv,GATConv

# GCN模型
class GCN(torch.nn.Module):
    def __init__(self, input_dim, hidden_dim, output_dim):
        super(GCN, self).__init__()
        self.conv1 = GCNConv(input_dim, hidden_dim)
        self.conv2 = GCNConv(hidden_dim, output_dim)

    def forward(self, data):
        x, edge_index = data.x, data.edge_index

        x = self.conv1(x, edge_index)
        x = F.relu(x)
        x = F.dropout(x, p=0.6, training=self.training)
        x = self.conv2(x, edge_index)

        return x
    
    # 训练并返回损失值
    def train_model(self, data, epochs):
        device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
        self.to(device)
        data = data.to(device)
        self.train()
        optimizer = torch.optim.Adam(self.parameters(), lr=0.01, weight_decay=5e-4)
        loss_values = []
        for epoch in range(epochs):
            optimizer.zero_grad()
            out = self(data)
            loss = F.mse_loss(out, data.x)
            loss_values.append(loss)
            loss.backward()
            optimizer.step()
        return loss_values

    # 预测
    def predict(self, data):
        self.eval()
        with torch.no_grad():
            predictions = self(data)
        return predictions
    
    
# GAT模型
class GAT(torch.nn.Module):
    def __init__(self, input_dim, hidden_dim, output_dim):
        super(GAT, self).__init__()
        self.conv1 = GATConv(input_dim, hidden_dim)
        self.conv2 = GATConv(hidden_dim, output_dim )

    def forward(self, data):
        x, edge_index = data.x, data.edge_index

        x = self.conv1(x, edge_index)
        x = F.relu(x)
        x = F.dropout(x, p=0.6, training=self.training)
        x = self.conv2(x, edge_index)

        return x
    
    # 训练
    def train_model(self, data, epochs):
        self.train()
        optimizer = torch.optim.Adam(self.parameters(), lr=0.01, weight_decay=5e-4)
        for epoch in range(epochs):
            optimizer.zero_grad()
            out = self(data)
            loss = F.mse_loss(out, data.y)
            loss.backward()
            optimizer.step()

    # 预测
    def predict(self, data):
        self.eval()
        with torch.no_grad():
            predictions = self(data)
        return predictions
    
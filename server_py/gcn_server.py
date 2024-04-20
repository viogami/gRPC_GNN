import grpc
from concurrent import futures
from proto.gcn import gcn_pb2_grpc, gcn_pb2

import torch
from torch_geometric.data import Data
import gcn_model as m
import outputHTML 

class GCNServicer(gcn_pb2_grpc.GCNServiceServicer):
    # 将图数据转换为 PyTorch Geometric 的 Data 对象
    def ProcessData(self, request):
        # 这里节点特征已经是合适的 PyTorch Tensor 格式,如果不是，需要将节点特征转换为合适的格式
        ids = [nodes.id for nodes in request.graph.nodes]
        features = [nodes.features for nodes in request.graph.nodes]
        edge_2e = [[ids.index(edge.source_id),ids.index(edge.target_id)] for edge in request.graph.edges]
        # 打印节点和边的数量
        print(f"Number of nodes: {len(ids)}")
        print(f"Number of edges: {len(edge_2e)}")
        # 得到历史数据
        history = request.history_data
        self.history_data = {year.year: year.place_data for year in history.year_data}

        x = torch.tensor(features, dtype=torch.float32)
        edge_index = torch.tensor(edge_2e, dtype=torch.long)

        self.ids = ids
        self.data = Data(x=x, edge_index=edge_index.t().contiguous())
    
    # 消息处理函数
    def Msg_handle(self, request, context):
        print(f"Received a request,from "+str(context.peer()))

        if not request.graph.nodes:
            context.set_code(grpc.StatusCode.INVALID_ARGUMENT)
            context.set_details("Nodes are required.")
            return gcn_pb2.GCNResult()
        if not request.graph.edges:
            context.set_code(grpc.StatusCode.INVALID_ARGUMENT)
            context.set_details("Edges are required.")
            return gcn_pb2.GCNResult()
        if not request.params.iterations:
            request.params.iterations = 200

    # 使用 GCN 处理图数据
    def ProcessGCN(self, request, context):
        self.Msg_handle(request, context)
        self.ProcessData(request)
        # 获取模型参数
        input_dim = request.params.input_dims
        hidden_dim = request.params.hidden_dims
        output_dim = request.params.output_dims
        iterations = request.params.iterations
        # 创建 GCN 模型
        self.model = m.GCN(input_dim, hidden_dim, output_dim)
        # 训练模型
        train_data = self.data
        self.model.train_model(train_data, iterations)
        # 预测
        pre_data = self.data
        output = self.model.predict(pre_data)

        # 创建一个新的PlaceData对象的列表
        new_place_data = []
        for i in range(len(output)):
            # 创建一个新的PlaceData对象
            place = gcn_pb2.PlaceData()
            # 复制原始PlaceData对象的属性
            place.place = request.history_data.year_data[-1].place_data[i].place
            place.longitude = request.history_data.year_data[-1].place_data[i].longitude
            place.latitude = request.history_data.year_data[-1].place_data[i].latitude
            # 设置新的total_people值
            place.total_people = round(output[i].item())
            # 将新的PlaceData对象添加到列表中
            new_place_data.append(place)

        # 将预测结果保存到历史数据中
        year = request.history_data.year_data[-1].year + 1
        self.history_data[year] = new_place_data

        # 绘制html
        outputHTML.output_html(self.history_data)

        # 将预测结果转换为字典
        result = {node_id: round(feature.item()) for node_id, feature in zip(self.ids, output)}

        return gcn_pb2.GCNResult(node_scores=result)
    
    # 创建 gRPC 服务端
    def server(self):
        server = grpc.server(futures.ThreadPoolExecutor(max_workers=10))
        gcn_pb2_grpc.add_GCNServiceServicer_to_server(self, server)

        server.add_insecure_port('[::]:9999')
        server.start()
        print('gRPC 服务端已开启,端口为9999...')
        server.wait_for_termination()

if __name__ == '__main__':
    gcn_servicer = GCNServicer()
    gcn_servicer.server()

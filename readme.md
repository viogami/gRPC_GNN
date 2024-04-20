# gRPC-GNN
为本人本科论文设计的核心代码，主要解决gcn的热度预测问题。

从原始数据出发，到数据处理，模型设计，最终可视化在web端展示，并做生产环境的部署。

主要使用php和python，利用grpc做双端的通信。

## 快速开始
如果运行全部项目，你需要安装全部的依赖
```python
pip install -r requirements.txt
```

如果你只想运行grpc的服务端：server_py。可以只安装`server_py`该文件夹下的依赖txt

--> 打开main.ipynb可看到全部思路和源码

--> 地图绘制和html生成使用pyecharts库，请多关注官方文档


## gRPC文件说明
主要对数据进行一个gcn的处理，得到返回的数据。

把图数据和模型参数封装为请求数据。

返回数据中的html为string类型，但定义了尚未使用，还是通过读取html文件的方式呈现。

## php客户端
作用：
- 从数据库读取数据
- 原始数据处理(build_graph.php)为图结构数据，并封装为grpc可用的格式
- 从grpc服务端接受数据，并展示网页，通过map.php

注意点：

- 需要进行composer安装必要依赖
    ```
    composer init
    composer install
    ```

- 如果你手动生成grpc文件，可能需要修改生成的`GCNServiceClient.php`文件，删除上面的namespace一行。

- map.php是客户端入口,需要手动添加数据库名称和密码，用于访问数据库

## py服务端
作用：
- 建立grpc服务，处理接受到的数据
- 定义gnn模型，处理图数据，并返回预测结果
- 根据历史数据和预测结果绘制html，并保存到指定位置

我只实现了gcn的模型，使用pytorch，更多模型可用性尚未实现。

注意：
 - 如果你手动生成grpc文件，可能需要对`gcn_pb2_grpc.py`文件的相对导入做修改，具体为：`from . import gcn_pb2 as gcn__pb2`
 - 需要将`outputHTML.py`文件中的`china.json`的读取和`map.html`生成的路径地址改为你自己的位置

 - gcn_server.py是程序入口。


## 文件夹说明
- client_php : grpc客户端，使用php
- server_py : grpc服务端，使用python，需要安装文件夹下的依赖
- data: 必要的数据存放文件夹
- sample-pyecharts: pyecharts的演示文件，因为html的绘制和地图可视化均依赖该库，需要多查看官方文档，以实现更好的自定义效果。
- main.ipynb ： jupyter笔记本，实现热度预测和可视化的全部代码。
- tab_base.html： 生成的成果html
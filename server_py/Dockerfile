# 设置Python应用的镜像
FROM python:3.10-slim

# 设置工作目录
WORKDIR /app

# 复制Python应用文件
COPY . .

# 安装Python应用依赖
RUN pip install -r requirements.txt -i https://pypi.tuna.tsinghua.edu.cn/simple 

# 启动服务
CMD ["python", "gcn_server.py"]
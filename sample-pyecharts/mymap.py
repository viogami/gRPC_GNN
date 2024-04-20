# -*- coding:utf-8 -*-
# 2022-1-14
# 作者：小蓝枣
# pyecharts地图

# 需要引用的库
from pyecharts import options as opts
from pyecharts.charts import Map


# 设置奥特曼所存在的相关省份，并设置初始数量为0
ultraman = [
['四川省', 20],
['江西省', 25],
['福建省', 30],
['浙江省', 90],
['江苏省', 70],
['安徽省', 50]
]

# 设置怪兽存在的相关省份，并设置初始数量为0
monster = [
['广东', 0],
['北京', 0],
['上海', 0],
['江西', 0],
['湖南', 0],
['浙江', 0],
['江苏', 0]
]

# def data_filling(array):
#     ''' 
#      作用：给数组数据填充随机数
#     '''
#     for i in array:
#         # 随机生成1到1000的随机数
#         i[1] = random.randint(1,100)
#         print(i)

# data_filling(ultraman)
# data_filling(monster)

def create_china_map():
    ''' 
     作用：生成中国地图
    '''
    (
        Map()
        .add(
            series_name="昆曲热点地区", 
            data_pair=ultraman, 
            maptype="china", 
            # 是否默认选中
            selected_mode=True,
            is_map_symbol_show=False
        )
        .add(
            series_name="昆曲热点地区", 
            data_pair=monster, 
            maptype="china", 
        )
        .set_global_opts(
        # 设置标题
        title_opts=opts.TitleOpts(title="中国地图"),
        # 设置标准显示
        visualmap_opts=opts.VisualMapOpts(max_=100, is_piecewise=True)
        )
        .set_series_opts(label_opts=opts.LabelOpts(position='right',font_size=6))#设置标签字体大小
        .render("中国地图.html")
    )
create_china_map()
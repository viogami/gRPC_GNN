# 需要引用的库
from pyecharts import options as opts
from pyecharts.charts import Geo,Timeline,Tab
from pyecharts.globals import GeoType
from pyecharts.charts import Map

import geopandas as gpd
from shapely.geometry import Point

# 计算每个省的热度的总和的函数
def HotnessSum_province(year_data):
    # 从自定义的路径读取china.json文件
    china = gpd.read_file('./data/china.json')

    china['geometry'] = china['geometry'].buffer(0)

    # 创建一个字典来存储每个省的总人数
    province_hotness = {row['name']: 0 for _, row in china.iterrows()}

    # 遍历每个点
    for place_data in year_data:
        point = Point(place_data.longitude, place_data.latitude)
        # 检查点是否在每个省内
        for _, province in china.iterrows():
            if point.within(province['geometry']):
                province_hotness[province['name']] += place_data.total_people
                break

    return province_hotness

# 创建地图可视化的函数
def output_html(history_data):
    tl1 = Timeline(init_opts=opts.InitOpts(width='80vw', height="80vh",is_horizontal_center=True))
    # 各省昆曲热度可视化,自动读取年份
    years = list(history_data.keys())
    for i in range(years[0],years[-1]+1):
        year_data = history_data[i]
        province_hotness = HotnessSum_province(year_data)
        # 将字典非0值转换为列表
        data_pair = [[k, v] for k, v in province_hotness.items() if v != 0]

        m = Map()
        m.add(maptype="china",series_name='昆曲省热度',data_pair=data_pair,label_opts=opts.LabelOpts(is_show=False)) 
        piece = [
        {"min": 100000, "label": 'HOT(100000 以上)'}, 
        {"min": 5000, "max": 100000},
        {"min": 15000, "max": 50000},
        {"min": 5000, "max": 15000},
        {"min": 2000, "max": 5000},
        {"min": 100, "max": 2000},
        # {"value": 123, "label": '自定义值', "color": 'grey'},   
        ]
        m.set_global_opts(
            title_opts=opts.TitleOpts(title="{}年".format(i)+'昆曲各省热度数据', subtitle="数据来源:from web"),
            legend_opts=opts.LegendOpts(is_show=False),
            visualmap_opts=opts.VisualMapOpts(max_=500000,is_piecewise=True,pieces=piece),
            toolbox_opts=opts.ToolboxOpts(is_show=True,feature=opts.ToolBoxFeatureOpts(restore=opts.ToolBoxFeatureRestoreOpts(False),data_zoom=opts.ToolBoxFeatureDataZoomOpts(False),magic_type=opts.ToolBoxFeatureMagicTypeOpts(False),brush=opts.ToolBoxFeatureBrushOpts(False))),
            tooltip_opts=opts.TooltipOpts(),
        )
        tl1.add(m, "{}年".format(i))

    tl1.add_schema(symbol='diamond',current_index=4,play_interval=1000,is_loop_play=False)

    tl2 = Timeline(init_opts=opts.InitOpts(width='80vw', height="80vh",is_horizontal_center=True))
    # 各剧院热度可视化
    for i in range(years[0],years[-1]+1):
        year_data = history_data[i]
        data_pair = [[place_data.place, place_data.total_people] for place_data in year_data]

        g = Geo(is_ignore_nonexistent_coord=True)
        g.add_schema(maptype="china",label_opts=opts.LabelOpts(is_show=False),) # 改为true显示省名
        for place_data in year_data:
            g.add_coordinate(place_data.place, place_data.longitude, place_data.latitude)
        
        g.add("昆曲剧院热度", data_pair,type_=GeoType.EFFECT_SCATTER, symbol_size=10)

        piece = [
        {"min": 100000, "label": 'HOT(100000 以上)'}, 
        {"min": 50000, "max": 100000},
        {"min": 30000, "max": 50000},
        {"min": 10000, "max": 30000},
        {"min": 5000, "max": 10000},
        {"min": 500, "max": 5000},
        {"min": 0, "max": 500},
        # {"value": 123, "label": '自定义值', "color": 'grey'},   
        ]
        g.set_global_opts(
            title_opts=opts.TitleOpts(title="{}年".format(i)+'昆曲各剧院热度数据', subtitle="数据来源:from web"),
            legend_opts=opts.LegendOpts(is_show=False),
            visualmap_opts=opts.VisualMapOpts(max_=500000, is_piecewise=True,pieces=piece),
            toolbox_opts=opts.ToolboxOpts(is_show=True,feature=opts.ToolBoxFeatureOpts(restore=opts.ToolBoxFeatureRestoreOpts(False),data_zoom=opts.ToolBoxFeatureDataZoomOpts(False),magic_type=opts.ToolBoxFeatureMagicTypeOpts(False),brush=opts.ToolBoxFeatureBrushOpts(False))),
            # tooltip_opts=opts.TooltipOpts(),
        )
        
        tl2.add(g, "{}年".format(i))

    tl2.add_schema(symbol='diamond',current_index=4,play_interval=1000,is_loop_play=False)

    tab = Tab(page_title="中国昆曲热度预测",bg_color="#FFFFFF")
    tab.add(tl1, "各省昆曲热度")
    tab.add(tl2, "各大昆曲剧院热度")
    # 修改为希望map.html文件导出到的路径
    tab.render("./data/map.html")
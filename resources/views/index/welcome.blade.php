<style>
    .layui-top-box {padding:40px 20px 20px 20px;color:#fff}
    .panel {margin-bottom:17px;background-color:#fff;border:1px solid transparent;border-radius:3px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}
    .panel-body {padding:15px}
    .panel-title {margin-top:0;margin-bottom:0;font-size:14px;color:inherit}
    .label {display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em;margin-top: .3em;}
    .layui-red {color:red}
    .main_btn > p {height:40px;}
</style>
<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main layui-top-box">
        <div class="layui-row layui-col-space10">

            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-cyan">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right layui-bg-blue">实时</span>
                                <h5>用户统计</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">{{$count['user']}}</h1>
                                <div class="stat-percent font-bold text-gray"><i class="fa fa-commenting"></i>{{$count['user']}}</div>
                                <small>当前后台总记录数</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-blue">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right layui-bg-cyan">实时</span>
                                <h5>文章</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">{{$count['art']}}</h1>
                                <div class="stat-percent font-bold text-gray"><i class="fa fa-commenting"></i>{{$count['art']}}</div>
                                <small>当前后台总文章记录数</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-green">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right layui-bg-orange">实时</span>
                                <h5>用户留言</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">{{$count['msg']}}</h1>
                                <div class="stat-percent font-bold text-gray"><i class="fa fa-commenting"></i>{{$count['msg']}}</div>
                                <small>当前后台留言总记录数</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-orange">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right layui-bg-green">实时</span>
                                <h5>订单统计</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">1234</h1>
                                <div class="stat-percent font-bold text-gray"><i class="fa fa-commenting"></i> 1234</div>
                                <small>当前分类总记录数</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="layui-box">
        <div class="layui-row layui-col-space10">
            <div class="layui-col-md6">
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>昵称</th>
                        <th>加入时间</th>
                        <th>上次登录时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->last_time}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="layui-col-md6">
                <ul class="layui-timeline">
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <h3 class="layui-timeline-title">2018年</h3>
                            <p>
                                创建网络金融公司
                                <br>确定方向，成立北京易巨网络科技有限公司
                            </p>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <h3 class="layui-timeline-title">2017年</h3>
                            <p>
                                目标确定
                                <br>业务不断扩大，调整方向，进军互联网
                            </p>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <h3 class="layui-timeline-title">2016年</h3>
                            <p>
                                方向调整
                                <br>由短期贷款转为信用卡及线下支付业务
                            </p>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <h3 class="layui-timeline-title">2015年</h3>
                            <p>
                                成立公司
                                <br/>合伙人成立金融公司，并针对不同人群定制理财计划
                            </p>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <h3 class="layui-timeline-title">2014年</h3>
                            <p>
                                筹备计划
                                <br>公司几位主要合伙人开始接触金融领域
                            </p>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">过去</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

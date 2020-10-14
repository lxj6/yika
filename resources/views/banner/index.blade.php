<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">

        <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-2" lay-id="currentTableId" style=" ">
            <div class="layui-table-tool">
                <div class="layui-table-tool-temp">
                    <div class="layui-btn-container">
                        <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" id="add_banner"> 新增广告 </button>
                    </div>
                </div>
            </div>
            <div class="layui-table-box">
                <div class="layui-table-header">
                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line" style="width:100%">
                        <thead>
                        <tr>
                            <th data-field="id" data-key="2-0-1">
                                <div class="layui-table-cell laytable-cell-2">
                                    <span>ID</span>
                                </div></th>
                            <th data-field="username" data-key="2-0-2">
                                <div class="layui-table-cell laytable-cell-3">
                                    <span>标题</span>
                                </div></th>
                            <th data-field="score" data-key="2-0-7" >
                                <div class="layui-table-cell laytable-cell-4">
                                    <span>跳转连接</span>
                                </div></th>
                            <th data-field="classify" data-key="2-0-8" class="">
                                <div class="layui-table-cell laytable-cell-5">
                                    <span>位置</span>
                                </div></th>
                            <th data-field="wealth" data-key="2-0-9" class="layui-unselect">
                                <div class="layui-table-cell laytable-cell-6">
                                    <span>图片预览</span>
                                </div></th>
                            <th data-field="10" data-key="2-0-10" data-minwidth="150" class=" layui-table-col-special">
                                <div class="layui-table-cell laytable-cell-7" align="center">
                                    <span>操作</span>
                                </div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $banner)
                        <tr data-index="0" class="">
                            <td data-field="id" data-key="2-0-1" class="">
                                <div class="layui-table-cell laytable-cell-2">
                                    {{$banner->id}}
                                </div></td>
                            <td data-field="username" data-key="2-0-2" class="">
                                <div class="layui-table-cell laytable-cell-3">
                                    {{$banner->title}}
                                </div></td>
                            <td data-field="sex" data-key="2-0-3" class="">
                                <div class="layui-table-cell laytable-cell-4">
                                    {{$banner->url}}
                                </div></td>
                            <td data-field="city" data-key="2-0-4" class="">
                                <div class="layui-table-cell laytable-cell-5">
                                    {{$position[$banner->position]}}
                                </div></td>
                            <td data-field="sign" data-key="2-0-5" data-minwidth="150" class="">
                                <div class="layui-table-cell laytable-cell-6">
                                    <img src="{{$banner->path}}" width="500px">
                                </div></td>
                            <td data-field="10" data-key="2-0-10" align="center" data-off="true" data-minwidth="150" class="layui-table-col-special">
                                <div class="layui-table-cell laytable-cell-7">
                                    <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete del_banner" data-id="{{$banner->id}}">删除</a>
                                </div></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</div>

<script>
    layui.use(['form', 'table','miniPage','element'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table,
            miniPage = layui.miniPage;


        // 监听搜索操作
        form.on('submit(data-search-btn)', function (data) {
            var result = JSON.stringify(data.field);
            layer.alert(result, {
                title: '最终的搜索信息'
            });

            //执行搜索重载
            table.reload('currentTableId', {
                page: {
                    curr: 1
                }
                , where: {
                    searchParams: result
                }
            }, 'data');

            return false;
        });


        //添加文章
        $('#add_banner').on('click',function(){
            console.log(11);
            var content = miniPage.getHrefContent('{{asset('/banner/add_banner')}}');
            var openWH = miniPage.getOpenWidthHeight();
            var index = layer.open({
                title: '新增广告',
                type: 1,
                shade: 0.2,
                id: 'add_article',
                maxmin:true,
                shadeClose: true,
                area: [openWH[0] + 'px', openWH[1] + 'px'],
                offset: [openWH[2] + 'px', openWH[3] + 'px'],
                content: content,
            });
            $(window).on("resize", function () {
                layer.full(index);
            });
        });


        $('.del_banner').each(function(){

            $(this).on('click',function(){
                var id = this.getAttribute('data-id');
                layer.confirm('真的删除行么', function (index) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        url: '{{url('banner/del_banner')}}', //请求的url地址
                        dataType: "json", //返回格式为json
                        async: true, //请求是否异步，默认为异步，这也是ajax重要特性
                        data: {id:id} , //参数值
                        method: "POST", //请求方式
                        success: function(res) {
                            if(res.code == 200){
                                layer.msg(res.msg, {
                                    icon: 1,
                                    time: 1000 //2秒关闭（如果不配置，默认是3秒）
                                },function () {
                                    layer.close(index);
                                    $('#refresh').click();
                                });
                            }else{
                                layer.msg(res.msg);
                            }

                        },
                    });

                });
            })
        });


    });
</script>

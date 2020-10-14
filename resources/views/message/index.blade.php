<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">

        {{--<fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">用户姓名</label>
                            <div class="layui-input-inline">
                                <input type="text" name="username" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户性别</label>
                            <div class="layui-input-inline">
                                <input type="text" name="sex" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户城市</label>
                            <div class="layui-input-inline">
                                <input type="text" name="city" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户职业</label>
                            <div class="layui-input-inline">
                                <input type="text" name="classify" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>--}}





        <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-2" lay-id="currentTableId" style=" ">

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
                                    <span>手机号</span>
                                </div></th>
                            <th data-field="score" data-key="2-0-7" >
                                <div class="layui-table-cell laytable-cell-4">
                                    <span>备注</span>
                                </div></th>
                            <th data-field="classify" data-key="2-0-8" class="">
                                <div class="layui-table-cell laytable-cell-5">
                                    <span>是否回访</span>
                                </div></th>
                            <th data-field="wealth" data-key="2-0-9" class="layui-unselect">
                                <div class="layui-table-cell laytable-cell-6">
                                    <span>是否有意向</span>

                                </div></th>
                            <th data-field="wealth" data-key="2-0-9" class="layui-unselect">
                                <div class="layui-table-cell laytable-cell-6">
                                    <span>留言时间</span>
                                </div></th>
                            <th data-field="10" data-key="2-0-10" data-minwidth="150" class=" layui-table-col-special">
                                <div class="layui-table-cell laytable-cell-7" align="center">
                                    <span>操作</span>
                                </div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($msgs as $msg)
                        <tr data-index="0" class="">
                            <td data-field="id" data-key="2-0-1" class="">
                                <div class="layui-table-cell laytable-cell-2">
                                    {{$msg->id}}
                                </div></td>
                            <td data-field="username" data-key="2-0-2" class="">
                                <div class="layui-table-cell laytable-cell-3">
                                    {{$msg->phone}}
                                </div></td>
                            <td data-field="sex" data-key="2-0-3" class="">
                                <div class="layui-table-cell laytable-cell-4">
                                    {{$msg->detail}}
                                </div></td>
                            <td data-field="city" data-key="2-0-4" class="">
                                <div class="layui-table-cell laytable-cell-5">
                                    @if($msg->is_return == 0)
                                        否
                                    @else
                                        是
                                    @endif
                                </div></td>
                            <td data-field="sign" data-key="2-0-5" data-minwidth="150" class="">
                                <div class="layui-table-cell laytable-cell-6">
                                    @if($msg->is_interest == 0)
                                        未知
                                        @elseif($msg->is_interest == 1)
                                        有
                                    @else
                                        没有
                                    @endif
                                </div></td>
                            <td data-field="sex" data-key="2-0-3" class="">
                                <div class="layui-table-cell laytable-cell-4">
                                    {{$msg->created_at}}
                                </div></td>
                            <td data-field="10" data-key="2-0-10" align="center" data-off="true" data-minwidth="150" class="layui-table-col-special">
                                <div class="layui-table-cell laytable-cell-7">
                                    <a class="layui-btn layui-btn-xs data-count-edit" id="edit">已回访</a>
                                    <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit">有意向</a>
                                    <a class="layui-btn layui-btn-xs layui-btn-warm data-count-delete">无意向</a>
                                    <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete">删除</a>
                                </div></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layui-table-page">
                {{--<div id="layui-table-page2">
                    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-2">
                        <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0"><i class="layui-icon"></i></a>
                        <span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>1</em></span>
                        <a href="javascript:;" data-page="2">2</a>
                        <a href="javascript:;" data-page="3">3</a>
                        <span class="layui-laypage-spr">…</span>
                        <a href="javascript:;" class="layui-laypage-last" title="尾页" data-page="67">67</a>
                        <a href="javascript:;" class="layui-laypage-next" data-page="2"><i class="layui-icon"></i></a>
                        <span class="layui-laypage-skip">到第<input type="text" min="1" value="1" class="layui-input" />页<button type="button" class="layui-laypage-btn">确定</button></span>
                        <span class="layui-laypage-count">共 1000 条</span>
                        <span class="layui-laypage-limits"><select lay-ignore=""><option value="10">10 条/页</option><option value="15" selected="">15 条/页</option><option value="20">20 条/页</option><option value="25">25 条/页</option><option value="50">50 条/页</option><option value="100">100 条/页</option></select></span>
                    </div>
                </div>--}}
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
        $(document).on('click','#add_art',function(){
            console.log(11);
            var content = miniPage.getHrefContent('{{asset('/article/add_article')}}');
            var openWH = miniPage.getOpenWidthHeight();

            var index = layer.open({
                title: '添加用户',
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
        //编辑分类
        $(document).on('click','#edit_art',function(){
            var content = miniPage.getHrefContent('{{asset('/article/add_article')}}');
            var openWH = miniPage.getOpenWidthHeight();

            var index = layer.open({
                title: '添加用户',
                type: 1,
                shade: 0.2,
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

        $(document).on('click','#check',function(){
            layer.confirm('真的删除行么', function (index) {
                obj.del();
                layer.close(index);
            });
            var checkStatus = table.checkStatus('currentTableId')
                , data = checkStatus.data;
            layer.alert(JSON.stringify(data));
        });

        $(document).on('click','#delete_art',function(){
            layer.confirm('真的删除行么', function (index) {
                obj.del();
                layer.close(index);
            });
            var checkStatus = table.checkStatus('currentTableId')
                , data = checkStatus.data;
            layer.alert(JSON.stringify(data));
        });


    });
</script>

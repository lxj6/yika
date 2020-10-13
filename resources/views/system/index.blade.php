<style>
    .layui-form-item .layui-input-company {width: auto;padding-right: 10px;line-height: 38px;}
</style>
<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">

        <div class="layui-form layuimini-form">
            <div class="layui-form-item">
                <label class="layui-form-label required">首页标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="required" lay-reqtext="首页标题不能为空" placeholder="请输入首页标题"  value="{{$conf->title}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META关键词</label>
                <div class="layui-input-block">
                    <textarea name="keywords" class="layui-textarea" placeholder="多个关键词用英文状态|号分割">{{$conf->keywords}}</textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META描述</label>
                <div class="layui-input-block">
                    <textarea name="descript" class="layui-textarea">{{$conf->descript}}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">公司名称</label>
                <div class="layui-input-block">
                    <input type="text" name="cor_name" value="{{$conf->cor_name}}" lay-verify="required" lay-reqtext="公司名称不能为空" placeholder="请输入公司名称"   class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">联系电话</label>
                <div class="layui-input-block">
                    <input type="text" name="phone" value="{{$conf->phone}}" lay-verify="required" lay-reqtext="联系电话不能为空" placeholder="请输入联系电话"   class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">联系地址</label>
                <div class="layui-input-block">
                    <input type="text" name="address" value="{{$conf->address}}" lay-verify="required" lay-reqtext="联系地址不能为空" placeholder="请输入联系地址"   class="layui-input">
                </div>
            </div>


            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label required">版权信息</label>
                <div class="layui-input-block">
                    <textarea name="copyright" class="layui-textarea">{{$conf->copyright}}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="setting">确认保存</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use(['form'], function () {
        var form = layui.form
            , layer = layui.layer;

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        //监听提交
        form.on('submit(setting)', function (data) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url: '{{url('system/index')}}', //请求的url地址
                dataType: "json", //返回格式为json
                async: true, //请求是否异步，默认为异步，这也是ajax重要特性
                data:  data.field , //参数值
                method: "POST", //请求方式
                success: function(res) {
                    if(res.code == 200){
                        layer.msg(res.msg);
                    }else{
                        layer.msg(res.msg);
                    }

                },
                error: function() {

                    //请求出错处理

                }
            });
        });

    });
</script>

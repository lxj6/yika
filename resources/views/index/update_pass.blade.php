<style>
    .layui-form-item .layui-input-company {
        width: auto;
        padding-right: 10px;
        line-height: 38px;
    }
</style>
<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">

        <div class="layui-form layuimini-form">
            <div class="layui-form-item">
                <label class="layui-form-label required">旧的密码</label>
                <div class="layui-input-block">
                    <input type="password" name="old_pass" lay-verify="required" lay-reqtext="旧的密码不能为空" placeholder="请输入旧的密码" value="" class="layui-input">
                    <tip>填写自己账号的旧的密码。</tip>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label required">新的密码</label>
                <div class="layui-input-block">
                    <input type="password" name="new_pass" lay-verify="required" lay-reqtext="新的密码不能为空" placeholder="请输入新的密码" value="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">新的密码</label>
                <div class="layui-input-block">
                    <input type="password" name="again_pass" lay-verify="required" lay-reqtext="新的密码不能为空" placeholder="请输入新的密码" value="" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    layui.use(['form', 'miniPage'], function () {
        var form = layui.form,
            layer = layui.layer,
            miniPage = layui.miniPage;

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            data = data.field;

            if(data.old_pass.length > 16  || data.old_pass.length < 6 || data.new_pass.length > 16  || data.new_pass.length < 6 || data.again_pass.length > 16  || data.again_pass.length < 6){
                layer.msg('密码长度在6-16之间！');
                return;
            }
            if(data.new_pass != data.again_pass){
                layer.msg('新密码两次输入不一致！');
                return ;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url: '{{url('index/update_pass')}}', //请求的url地址
                dataType: "json", //返回格式为json
                async: true, //请求是否异步，默认为异步，这也是ajax重要特性
                data:  data , //参数值
                method: "POST", //请求方式
                success: function(res) {
                    if(res.code == 200){
                        layer.msg(res.msg, function () {
                            window.location = '{{url('login')}}';
                        });
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

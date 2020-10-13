<div class="layuimini-main">

    <div class="layui-form layuimini-form">
        <div class="layui-form-item">
            <label class="layui-form-label required">上级分类</label>
            <div class="layui-input-block">
                <select name="parent_id" lay-filter="aihao">
                    <option value="0">顶级分类</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" placeholder="请输入名称" value="{{$info->name}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">是否为系统分类</label>
            <div class="layui-input-block">
                <input type="radio" name="issys" value="0" title="否" checked="">
                <input type="radio" name="issys" value="1" title="是">
            </div>
            <tip>系统分类前台不展示，仅作为不可见的文章分类，主要是给管理员归纳文章使用的。</tip>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="number" name="sort" value="{{$info->sort}}" class="layui-input">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">标题(SEO)</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="请输入标题" value="{{$info->title}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键词(SEO)</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" placeholder="请输入关键词" value="{{$info->keywords}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述简要(SEO)</label>
            <div class="layui-input-block">
                <input type="text" name="description" placeholder="请输描述简要" value="{{$info->description}}" class="layui-input">
            </div>
            <input type="hidden" name="id" value="{{$info->id}}" >
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use(['form', 'table','miniPage'], function () {
        var form = layui.form,
            layer = layui.layer,
            table = layui.table,
            $ = layui.$;

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        // 当前弹出层，防止ID被覆盖
        var parentIndex = layer.index;

        //监听提交
        form.on('submit(saveBtn)', function (data) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url: '{{url('article/edit_category')}}', //请求的url地址
                dataType: "json", //返回格式为json
                async: true, //请求是否异步，默认为异步，这也是ajax重要特性
                data:  data.field , //参数值
                method: "POST", //请求方式
                success: function(res) {
                    if(res.code == 200){
                        layer.msg(res.msg, {
                            icon: 1,
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        },function () {

                            layer.close(parentIndex);
                            $('#refresh').click();
                            //window.location.reload();

                        });
                    }else{
                        layer.msg(res.msg);
                    }

                },
            });


            return false;
        });

    });
</script>

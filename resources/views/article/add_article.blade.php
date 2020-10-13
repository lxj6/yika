<div class="layuimini-main">

    <div class="layui-form layuimini-form">
        <div class="layui-form-item">
            <label class="layui-form-label required">上级分类</label>
            <div class="layui-input-block">
                <select name="category_id" lay-filter="aihao">
                    <option value="0"></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" lay-verify="required" lay-reqtext="标题不能为空" placeholder="标题" value="" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">是否推荐</label>
            <div class="layui-input-block">
                <input type="radio" name="top" value="1" title="是" checked="">
                <input type="radio" name="top" value="0" title="否">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="number" name="sort" value="0" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <div id="editor" style="margin: 50px 0 50px 0">

                </div>
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">关键词(SEO)</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" placeholder="请输入关键词" value="" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述简要(SEO)</label>
            <div class="layui-input-block">
                <input type="text" name="description" placeholder="请输描述简要" value="" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
            </div>
        </div>
    </div>
</div>
<script>



    layui.use(['form', 'table','wangEditor'], function () {
        var form = layui.form,
            layer = layui.layer,
            table = layui.table,
            $ = layui.$,
            $ = layui.jquery,
            wangEditor = layui.wangEditor;


        var editor = new wangEditor('#editor');
        editor.customConfig.uploadImgServer = "api/upload.json";
        editor.customConfig.uploadFileName = 'image';
        editor.customConfig.pasteFilterStyle = false;
        editor.customConfig.uploadImgMaxLength = 5;
        editor.customConfig.uploadImgHooks = {
            // 上传超时
            timeout: function (xhr, editor) {
                layer.msg('上传超时！')
            },
            // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
            customInsert: function (insertImg, result, editor) {
                console.log(result);
                if (result.code == 1) {
                    var url = result.data.url;
                    url.forEach(function (e) {
                        insertImg(e);
                    })
                } else {
                    layer.msg(result.msg);
                }
            }
        };
        editor.customConfig.customAlert = function (info) {
            layer.msg(info);
        };
        editor.create();

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        // 当前弹出层，防止ID被覆盖
        var parentIndex = layer.index;

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            data.field.content = editor.txt.html();
            console.log(data);
            return;
            var index = layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            }, function () {

                // 关闭弹出层
                layer.close(index);
                layer.close(parentIndex);

            });


            return false;
        });

    });
</script>

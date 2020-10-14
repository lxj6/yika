<div class="layuimini-main">

    <div class="layui-form layuimini-form">
        <div class="layui-form-item">
            <label class="layui-form-label required">上级分类</label>
            <div class="layui-input-block">
                <select name="category_id" lay-filter="aihao">
                    @foreach($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" lay-verify="required" lay-reqtext="标题不能为空" placeholder="标题" value="{{$info->title}}" class="layui-input">
            </div>
        </div>
        <input type="hidden" name="id" value="{{$info->id}}">
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
                <input type="number" name="sort" value="{{$info->sort}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <div id="editor" style="margin: 50px 0 50px 0">
                    {!! $info->content !!}
                </div>
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
        editor.customConfig.uploadImgServer = "{{url('index/upload')}}";
        editor.customConfig.uploadFileName = 'image';
        editor.customConfig.pasteFilterStyle = false;
        editor.customConfig.uploadImgMaxLength = 1;
        editor.customConfig.uploadImgMaxSize = 2 * 1024 * 1024 // 2M
        editor.customConfig.uploadImgHooks = {
            // 上传超时
            timeout: function (xhr, editor) {
                layer.msg('上传超时！')
            },
            // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
            customInsert: function (insertImg, result) {
                console.log(result);
                if (result.code == 200) {
                    var url = result.data.url;
                    //url.forEach(function (e) {
                    insertImg(url);
                    //})
                } else {
                    layer.msg(result.msg);
                }
            }
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

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url: '{{url('article/edit_article')}}', //请求的url地址
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

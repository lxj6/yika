<div class="layuimini-main">

    <div class="layui-form layuimini-form">
        <div class="layui-form-item">
            <label class="layui-form-label required">所属位置</label>
            <div class="layui-input-block">
                <select name="position" lay-filter="aihao">
                    @foreach($position as $k => $v)
                    <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="请输入标题" value="" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">图片路径</label>
            <div class="layui-input-block">
                <input type="text" name="url" placeholder="请输入图片跳转路径" value="" class="layui-input">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label required">广告图片</label>
            <div class="layui-input-block">
                <div class="layui-upload-drag" id="up">
                    <i class="layui-icon"></i>
                    <p>点击上传，或将文件拖拽到此处</p>
                </div>
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

    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;
        //拖拽上传
        upload.render({
            elem: '#up',
            url: "{{url('index/upload')}}",
            field:'image',
            done: function(res){
                if(res.code == 200){
                    document.getElementById('up').className = '';
                    document.getElementById('up').innerHTML = "<img src="+res.data.url+" height='135px' width = '258px'>";
                    document.getElementById('imgUrl').value = res.data.url;
                }else{
                    layer.msg(res.msg);
                }
            }
        });
    });

    layui.use(['form', 'table','wangEditor'], function () {
        var form = layui.form,
            layer = layui.layer,
            table = layui.table,
            $ = layui.$,
            $ = layui.jquery;

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        // 当前弹出层，防止ID被覆盖
        var parentIndex = layer.index;

        //监听提交
        form.on('submit(saveBtn)', function (data) {

            data.field.path = $("#up>img").attr("src");;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url: '{{url('banner/add_banner')}}', //请求的url地址
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

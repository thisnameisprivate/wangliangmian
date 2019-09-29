<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录详情页/添加新的信息</title>
    <link rel="stylesheet" href="/wlmdetail/Public/statics/layui/css/layui.css">
    <style>
        .container{position:relative; width:900px; height: 500px; top:0; left:0; bottom:0; right:0; margin:auto; padding-top: 50px;}
        body{overflow-y: scroll; margin-top:20px;}
    </style>
</head>
<body>
<div class="layui-inline">
    <form action="layui-form">
        <input class="layui-input layui-input-sm" name="search" id="search" required lay-verify="required" placeholder="姓名/客户电话" autocomplete="off">
    </form>
</div>
<button id="searchbtn" class="layui-btn layui-btn-sm layui-icon layui-icon-search" date-type="reload">搜索</button>
<table id="container" lay-filter="edittable"></table>
<div class="layui-container" id="layerpopEdit" style="display:none;">
    <div class="container">
        <p style="display:none" id="idValue"></p>
        <form class="layui-form" lay-filter="fromedit">
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" placeholder="输入客户姓名~" autocomplete="off" class="layui-input">
                </div>
                <label class="layui-form-label">联系方式</label>
                <div class="layui-input-inline">
                    <input type="text" name="contact"  placeholder="输入联系方式~" autocomplete="off" class="layui-input phone">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发货状态</label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <select name="status" lay-verify="required">
                            <?php if(is_array($status)): foreach($status as $index=>$vo): ?><option value="<?php echo ($vo['status']); ?>"><?php echo ($vo['status']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <label class="layui-form-label">发货时间</label>
                <div class="layui-input-inline">
                    <input type="text" name="deliveryDate" class="layui-input time-item" placeholder="年-月-日">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">地区</label>
                <div class="layui-input-inline">
                    <input type="text" name="area" class="layui-input" placeholder="请输入地址~" autocomplete="off" lay-verify="required">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="fromedit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="layui-container" id="layerAddData" style="display:none;">
    <div class="container">
        <form class="layui-form" lay-fitler="formAdd">
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" placeholder="输入客户姓名~" autocomplete="off" class="layui-input">
                </div>
                <label class="layui-form-label">联系方式</label>
                <div class="layui-input-inline">
                    <input type="text" name="contact"  placeholder="输入联系方式~" autocomplete="off" class="layui-input phone">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发货状态</label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <select name="status" lay-verify="required">
                            <?php if(is_array($status)): foreach($status as $index=>$vo): ?><option value="<?php echo ($vo['status']); ?>"><?php echo ($vo['status']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <label class="layui-form-label">发货时间</label>
                <div class="layui-input-inline">
                    <input type="text" name="deliveryDate" class="layui-input time-item" placeholder="年-月-日">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">地区</label>
                <div class="layui-input-inline">
                    <input type="text" name="area" class="layui-input" placeholder="请输入地址~" autocomplete="off" lay-verify="required">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="fromedit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script src="/wlmdetail/Public/statics/layui/layui.js"></script>
<script type="text/html" id="toolbaradd">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm layui-icon layui-icon-add-1" lay-event="add">&nbsp;添加</button>
        <button class="layui-btn layui-btn-sm layui-icon layui-icon-refresh" lay-event="reload">&nbsp;刷新</button>
    </div>
</script>
<script type="text/html" id="bar">
    <button class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i></button>
    <button class="layui-btn layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i></button>
</script>
<script>
    layui.use(['laydate', 'table', 'layer', 'laypage', 'form'], () => {
        var table = layui.table;
        var laydate = layui.laydate;
        var layer = layui.layer;
        var form = layui.form;
        var laypage = layui.laypage;
        var $ = layui.jquery;
        var userAcc = JSON.parse(localStorage.getItem('userAcc'));
        var tableIns = table.render({
            text: { none: '暂无相关数据' },
            initSort: {
                field: 'id',
                type: 'desc'
            },
            elem: '#container',
            toolbar: '#toolbaradd',
            url: "<?php echo U('Admin/Index/visitCheck');?>",
            height: 'full-200',
            page: true,
            even: true,
            cellMinWidth:50,
            limit: 25,
            limits: [25, 50, 75, 150],
            loading: true,
            size:'sm',
            cols: [[
                {field: 'id', title: 'No .', sort: true, hide: true},
                {field: 'name', title: '姓名'},
                {field: 'contact', title: '联系方式'},
                {field: 'area', title: '地区'},
                {field: 'status', title: '发货状态', templet: (data) => { return data.status == '已发货' ? "<span style='color:orangered;'>"+ data.status +"</span>" : "<span style='color:#5FB878;'>"+ data.status +"</span>"}},
                {field: 'deliveryDate', title: '发货日期'},
                {field: 'currentTime', title: '登记时间'},
                {fixed: 'right', title: '操作', align: 'left', toolbar: '#bar', widht:'10%'}
            ]]
        });
        table.on('tool(edittable)', obj => {
            var data = obj.data;
            var layEvent = obj.event;
            var tr = obj.tr;
            if (layEvent === 'del') {
                layer.confirm('【' + data.name + '】 Are you sure to Delete?', (index) => {
                    var client = new XMLHttpRequest();
                    client.open("GET", "<?php echo U('Admin/Index/VisitDel/id/"+ parseInt(data.id) + "/data/" + JSON.stringify(data) +"');?>");
                    client.send();
                    client.onreadystatechange = () => {
                        if (client.readyState === 4 && client.status === 200) {
                            if (client.response == 1) {
                                layer.msg('delete success', {icon: 6});
                                obj.del();
                                layer.close(index);
                            } else {
                                layer.msg('delete fialed', {icon: 5});
                            }
                        }
                    }
                });
            } else if (layEvent === 'edit') {
                document.getElementById('idValue').innerHTML = data.id;
                layer.open({
                    type:1,
                    title: '编辑信息',
                    area: ['65%', '75%'],
                    content: document.getElementById('layerpopEdit').innerHTML,
                    success: () => {
                        lay('.time-item').each(function () {
                            laydate.render({
                                elem: this,
                                trigger: 'click'
                            })
                        })
                    }
                });
                setFormValue(data);
                form.on('submit(fromedit)', data => {
                    var id = document.getElementById('idValue').innerHTML;
                    var client = new XMLHttpRequest();
                    client.open("GET", "<?php echo U('Admin/Index/editData/id/"+ parseInt(id) + "/data/" + JSON.stringify(data.field) + "');?>");
                    client.send();
                    client.onreadystatechange = () => {
                        if (client.readyState === 4 && client.status === 200) {
                            if (client.response == 1) {
                                layer.msg('add success', {icon: 6});
                                layer.closeAll('page');
                                tableIns.reload();
                            } else {
                                layer.msg('add failed', {icon: 5});
                            }
                        }
                    }
                    return false;
                })
            }
        });
        table.on('toolbar(edittable)', obj => {
            if (obj.event === 'reload') {
                tableIns.reload();
            } else if (obj.event === 'add') {
                layer.open({
                    type: 1,
                    title: '新增回访信息',
                    area: ['65%', '75%'],
                    content: document.getElementById('layerAddData').innerHTML,
                    success: () => {
                        lay('.time-item').each(function () {
                            laydate.render({
                                elem: this,
                                trigger: 'click',
                            })
                        })
                    }
                });
                form.render();
                form.on('submit(formadd)', data => {
                    var client = new XMLHttpRequest();
                    client.open('GET', "<?php echo U('Admin/Index/visitAddData/data/"+ JSON.stringify(data.field) +"');?>");
                    client.send();
                    client.onreadystatechange = () => {
                        if (client.readyState === 4 && client.status === 200) {
                            if (client.response == 1) {
                                layer.msg('Add Success', {icon: 6});
                                layer.closeAll('page');
                                tableIns.reload();
                            } else {
                                layer.msg('Add Failed', {icon: 5});
                            }
                        }
                    }
                    return false;
                })
            }
        });
        /* search */
        document.getElementById('searchbtn').onclick = () => {
            var value = document.getElementById('search').value;
            if (value == '') {
                layer.msg('请输入要搜索的信息', {icon: 16});
                tableIns.reload({
                    where: {search : null}
                });
                layer.close(layer.index)
            }
            if (value != '') {
                layer.msg('数据请求中...', {icon: 16});
                tableIns.reload({
                    page: {curr: 1},
                    where: {search: value}
                })
                layer.close(layer.index);
                document.getElementById('search').value = '';
            }
        };
        /* 渲染form表单 */
        setFormValue = data => {
            console.log(data);
            form.val('fromedit', {
                'name': data.name,
                'contact': data.contact,
                'area': data.area,
                'status': data.status,
                'deliveryDate': data.deliveryDate,
            });
        }
    })
</script>
</html>
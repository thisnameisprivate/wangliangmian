<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<?php
 $color_config = array( 1 => 'color:red', 2 => 'color:green', 3 => 'color:blue', 4 => 'color:gray' ); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/wlmdetail/Public/statics/layui/css/layui.css">
    <style>
        .box{width:70%; display:flex;}
        .left-box{flex:4;}
        .right-box{flex:4; display:flex;}
        .right-box-min-container{flex:1;}
        .layui-card-header{color:#5FB878;}
        a{font-size:1rem; color:#5FB878; font-weight:600;}
        a:hover{color:#FF5722;}
    </style>
    <title>overView</title>
</head>
<body>
<div class="box">
    <div class="left-box">
        <div class="layui-card min-container">
            <div class="layui-card-header">挂号数据统计</div>
            <div class="layui-card-body">
                <table class="layui-table" lay-even lay-skin="line" lay-size="sm">
                    <thead>
                    <tr class="layui-bg-green">
                        <th>时间</th>
                        <th>总共</th>
                        <th>已到</th>
                        <th>未到</th>
                        <th>转化率</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>今日</td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="arrivalTotal"><?php echo ($arrivalTotal); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="arrival"><?php echo ($arrival); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="arrivalOut"><?php echo ($arrivalOut); ?></a></td>
                        <td><a href="javascript:;" onclick="monthdata();"><?php echo sprintf('%.2f', $arrival / $arrivalTotal * 100) . "%"; ?></a></td>
                    </tr>
                    <tr>
                        <th>昨日</th>
                        <td><a href="javascript:;" onclick="specified(this);" iden="yesterTotal"><?php echo ($yesterTotal); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="yesterArrival"><?php echo ($yesterArrival); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="yesterArrivalOut"><?php echo ($yesterArrivalOut); ?></a></td>
                        <td><a href="javascript:;" onclick="monthdata();"><?php echo sprintf('%.2f', $yesterArrival / $yesterTotal * 100) . "%"; ?></a></td>
                    </tr>
                    <tr>
                        <th>本月</th>
                        <td><a href="javascript:;" onclick="specified(this);" iden="thisTotal"><?php echo ($thisTotal); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="thisArrival"><?php echo ($thisArrival); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="thisArrivalOut"><?php echo ($thisArrivalOut); ?></a></td>
                        <td><a href="javascript:;" onclick="monthdata();"><?php echo sprintf('%.2f', $thisArrival / $thisTotal * 100) . "%"; ?></a></td>
                    </tr>
                    <tr>
                        <th>上月</th>
                        <td><a href="javascript:;" onclick="specified(this);" iden="lastTotal"><?php echo ($lastTotal); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="lastArrival"><?php echo ($lastArrival); ?></a></td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="lastArrivalOut"><?php echo ($lastArrivalOut); ?></a></td>
                        <td><a href="javascript:;" onclick="monthdata();"><?php echo sprintf('%.2f', $lastArrival / $lastTotal * 100) . "%"; ?></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="layui-card min-container">
            <div class="layui-card-header">预约未定数据统计</div>
            <div class="layui-card-body">
                <table class="layui-table" lay-even lay-skin="line" lay-size="sm">
                    <colgroup>
                        <col width="150">
                        <col width="150">
                        <col width="150">
                        <col width="150">
                    </colgroup>
                    <thead>
                    <tr class="layui-bg-green">
                        <th>时间</th>
                        <th>总共</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>今日</td>
                        <td><a href="javascript:;" onclick="specified(this);" iden="appTodayTotal"><?php echo ($appointment['todayTotal']); ?></a></td>
                        <td><a href="javascript:;"></a></td>
                    </tr>
                    <tr>
                        <th>昨日</th>
                        <td><a href="javascript:;" onclick="specified(this);" iden="appYesterTotal"><?php echo ($appointment['yesterTotal']); ?></a></td>
                        <td><a href="javascript:;"></a></td>
                    </tr>
                    <tr>
                        <th>本月</th>
                        <td><a href="javascript:;" onclick="specified(this);" iden="appThisTotal"><?php echo ($appointment['thisTotal']); ?></a></td>
                        <td><a href="javascript:;"></a></td>
                    </tr>
                    <tr>
                        <th>上月</th>
                        <td><a href="javascript:;" onclick="specified(this);" iden="appLastTotal"><?php echo ($appointment['lastTotal']); ?></a></td>
                        <td><a href="javascript:;"></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="right-box">
        <div class="right-box-min-container">
            <div class="layui-card min-container">
                <div class="layui-card-header">本月到院排行</div>
                <div class="layui-card-body">
                    <table class="layui-table" lay-even lay-skin="line" lay-size="sm">
                        <colgroup>
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr class="layui-bg-green">
                            <th>排名</th>
                            <th>名字</th>
                            <th>信息</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($thisArrivalSort)): foreach($thisArrivalSort as $k=>$vo): ?><tr>
                                <td><?php static $i = 0; $a = $i + 1; echo "<b style='$color_config[$a]'><i>No . " . $i += 1 . " </i></b>"; ?></td>
                                <td><a href="javascript:;"><?php echo ($k); ?></a></td>
                                <td><a href="javascript:;"><?php echo ($vo); ?></a></td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layui-card min-container">
                <div class="layui-card-header">上月到院排行</div>
                <div class="layui-card-body">
                    <table class="layui-table" lay-even lay-skin="line" lay-size="sm">
                        <colgroup>
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr class="layui-bg-green">
                            <th>排名</th>
                            <th>名字</th>
                            <th>信息</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($lastArrivalSort)): foreach($lastArrivalSort as $k=>$vo): ?><tr>
                                <td><?php static $c = 0; $a = $c + 1; echo "<b style='$color_config[$a]'><i>No . " . $c += 1 . " </i></b>"; ?></td>
                                <td><a href="javascript:;"><?php echo ($k); ?></a></td>
                                <td><a href="javascript:;"><?php echo ($vo); ?></a></td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="right-box-min-container">
            <div class="layui-card min-container">
                <div class="layui-card-header">本月预约排行</div>
                <div class="layui-card-body">
                    <table class="layui-table" lay-even lay-skin="line" lay-size="sm">
                        <colgroup>
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr class="layui-bg-green">
                            <th>排名</th>
                            <th>名字</th>
                            <th>信息</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($thisAppointmentSort)): foreach($thisAppointmentSort as $k=>$vo): ?><tr>
                                <td><?php static $j = 0; $a = $j + 1; echo "<b style='$color_config[$a]'><i>No . " . $j += 1 . " </i></b>"; ?></td>
                                <td><a href="javascript:;"><?php echo ($k); ?></a></td>
                                <td><a href="javascript:;"><?php echo ($vo); ?></a></td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layui-card min-container">
                <div class="layui-card-header">上月预约排行</div>
                <div class="layui-card-body">
                    <table class="layui-table" lay-even lay-skin="line" lay-size="sm">
                        <colgroup>
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr class="layui-bg-green">
                            <th>排名</th>
                            <th>名字</th>
                            <th>信息</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($lastAppointmentSort)): foreach($lastAppointmentSort as $k=>$vo): ?><tr>
                                <td><?php static $d = 0; $a = $d + 1; echo "<b style='$color_config[$a]'><i>No . " . $d += 1 . " </i></b>"; ?></td>
                                <td><a href="javascript:;"><?php echo ($k); ?></a></td>
                                <td><a href="javascript:;"><?php echo ($vo); ?></a></td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/wlmdetail/Public/statics/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['layer', 'element', 'laydate', 'form'], () => {
        var table = layui.table;
        var laydate = layui.laydate;
        var layer = layui.layer;
        var form = layui.form;
        var laypage = layui.page;
        var $ = layui.jquery;
        specified = (data) => {
            var iden = data.getAttribute('iden');
            window.parent.iframeSetAttr("<?php echo U('Admin/Index/specified/iden/"+ iden +"');?>");
        }
        // 转化率
        monthdata = () => {
            window.parent.iframeSetAttr("<?php echo U('Admin/Index/monthdata');?>");
        }
    });
</script>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:46:"./application/admin/template/tools\restore.htm";i:1573115050;s:61:"D:\wrap\www\demo\application\admin\template\public\layout.htm";i:1573115050;s:57:"D:\wrap\www\demo\application\admin\template\tools\bar.htm";i:1554199440;s:61:"D:\wrap\www\demo\application\admin\template\public\footer.htm";i:1545615936;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="/demo/public/plugins/layui/css/layui.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/demo/public/static/admin/css/main.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/demo/public/static/admin/css/page.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/demo/public/static/admin/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="/demo/public/static/admin/font/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript">
    var eyou_basefile = "<?php echo \think\Request::instance()->baseFile(); ?>";
    var module_name = "<?php echo MODULE_NAME; ?>";
    var GetUploadify_url = "<?php echo url('Uploadify/upload'); ?>";
    var __root_dir__ = "/demo";
    var __lang__ = "<?php echo $admin_lang; ?>";
</script>  
<link href="/demo/public/static/admin/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="/demo/public/static/admin/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="/demo/public/static/admin/js/jquery.js"></script>
<script type="text/javascript" src="/demo/public/static/admin/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/demo/public/plugins/layer-v3.1.0/layer.js"></script>
<script type="text/javascript" src="/demo/public/static/admin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/demo/public/static/admin/js/admin.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/demo/public/static/admin/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="/demo/public/static/admin/js/common.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/demo/public/static/admin/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/demo/public/static/admin/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/demo/public/plugins/layui/layui.js"></script>
<script src="/demo/public/static/admin/js/myFormValidate.js"></script>
<script src="/demo/public/static/admin/js/myAjax2.js?v=<?php echo $version; ?>"></script>
<script src="/demo/public/static/admin/js/global.js?v=<?php echo $version; ?>"></script>
</head>
<body class="bodystyle" style="cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>备份还原</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?php echo url("Tools/index"); ?>" class="tab <?php if(\think\Request::instance()->action() == 'index'): ?>current<?php endif; ?>"><span>数据备份</span></a></li>
                <li><a href="<?php echo url("Tools/restore"); ?>" class="tab <?php if(in_array(\think\Request::instance()->action(), array('restore'))): ?>current<?php endif; ?>"><span>数据还原</span></a></li>
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
        <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span title="收起提示" id="explanationZoom" style="display: block;"></span>
        </div>
        <ul>
            <li> 数据还原, 点击恢复选项进行数据库导入.</li>
            <li> 导入的SQL文件语句必须按照MYSQL的语法编写</li>
        </ul>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>sql文件列表</h3>
                <h5>(备份文件数量：<?php echo $filenum; ?>，占空间大小：<?php echo format_bytes($total); ?>)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="sign w40" axis="col0">
                            <div class="tc">选择</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="">
                            <div class="">文件名称</div>
                        </th>
                        <th abbr="article_show" axis="col5" class="w100">
                            <div class="tc">系统版本</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w40">
                            <div class="tc">卷号</div>
                        </th>
                        <th abbr="article_show" axis="col5" class="w60">
                            <div class="tc">压缩</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w100">
                            <div class="tc">数据大小</div>
                        </th>
                        <th abbr="article_show" axis="col7" class="w160">
                            <div class="tc">备份时间</div>
                        </th>
                       
                        <th axis="col1" class="w160">
                            <div class="tc">操作</div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto;">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table style="width: 100%">
                    <tbody>
                    <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
                        <tr>
                            <td class="no-data" align="center" axis="col0" colspan="50">
                                <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                            </td>
                        </tr>
                    <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                        <tr data-id="<?php echo $vo['basename']; ?>">
                            <td class="sign">
                                <div class="w40 tc"><input type="checkbox" name="ids[]" value="<?php echo $vo['time']; ?>"></div>
                            </td>
                            <td style="width: 100%">
                                <div><?php echo $vo['basename']; ?></div>
                            </td>
                            <td>
                                <div class="w100 tc"><?php echo $vo['version']; ?></div>
                            </td>
                            <td class="">
                                <div class="w40 tc"><?php echo $vo['part']; ?></div>
                            </td>
                            <td>
                                <div class="w60 tc"><?php echo $vo['compress']; ?></div>
                            </td>
                            <td>
                                <div class="w100 tc"><?php echo format_bytes($vo['size']); ?></div>
                            </td>
                            <td>
                                <div class="w160 tc"><?php echo date("Y-m-d H:i:s",$vo['time']); ?></div>
                            </td>
                           
                            <td>
                                <div class="w160 tc">
                                    <?php if(is_check_access(CONTROLLER_NAME.'@new_import') == '1'): ?>
                                    <a href="javascript:void(0);" data-url="<?php echo U('Tools/new_import', array('time'=>$vo['time'])); ?>" class="btn blue db-import"><i class="fa fa-repeat"></i>恢复</a>
                                    <?php endif; if(is_check_access(CONTROLLER_NAME.'@downFile') == '1'): ?>
                                    <a href="<?php echo U('Tools/downFile',array('time'=>$vo['time'])); ?>" class="btn green"><i class="fa fa-download"></i>下载</a>
                                    <?php endif; if(is_check_access(CONTROLLER_NAME.'@del') == '1'): ?>
                                    <a class="btn red"  href="javascript:void(0);" data-url="<?php echo U('Tools/del'); ?>" data-id="<?php echo $vo['time']; ?>" onClick="delfun(this);"><i class="fa fa-trash-o"></i>删除</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                          
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="iDiv" style="display: none;"></div>
        </div>
        <div class="tDiv">
            <div class="tDiv2">
                <div class="fbutton checkboxall">
                    <input type="checkbox" onclick="javascript:$('input[name*=ids]').prop('checked',this.checked);">
                </div>
                <?php if(is_check_access(CONTROLLER_NAME.'@del') == '1'): ?>
                <div class="fbutton">
                    <a onclick="batch_del(this, 'ids');" data-url="<?php echo U('Tools/del'); ?>">
                        <div class="add" title="批量删除">
                            <span><i class="fa fa-close"></i>批量删除</span>
                        </div>
                    </a>
                </div>
                <?php endif; if(is_check_access(CONTROLLER_NAME.'@restoreUpload') == '1'): ?>
                <div class="fbutton">
                    <form class="navbar-form form-inline" action="<?php echo U('Tools/restoreUpload'); ?>" name="change_System" id="change_System" method="post" enctype="multipart/form-data">
                        <a href="javascript:void(0);" class="a-upload"><input type="file" name="sqlfile" id="sqlfile" title="请选择…"><i class="fa fa-upload"></i>上传执行sql文件</a>
                    </form>
                </div>
                <?php endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
<form class="none" name="form_tmp" id="form_tmp" action="" method="POST">

</form>
<script>
    $(document).ready(function(){
        // 表格行点击选中切换
        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');
        });

        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });

        $('#sqlfile').change(function(){
            restoreUpload();
        });
    
        function restoreUpload()
        {
            var sqlfile = $('input[name=sqlfile]').val();
            var ext = sqlfile.substr(sqlfile.lastIndexOf('.')).toLowerCase();
            if ($.trim(sqlfile) == '' || ext != '.sql') {
                showErrorMsg('请上传sql文件！');
                return false;
            }

            layer.confirm('此操作不可恢复，确认执行？', {
                title: false,//'<font color="red">重要提示</font>',
                btn: ['确定', '取消'] //按钮
            }, function () {
                layer_loading('正在处理');
                $('#change_System').submit();
                return false;
            }, function (index) {
                $('#sqlfile').val('');
                layer.closeAll();
                return false;
            });
        }

    });

    $(".db-import").click(function(){
        var url = $(this).attr('data-url');
        $('#form_tmp').attr('action', url);
        layer_loading('正在处理');
        $('#form_tmp').submit();
    }); 

/*    $(".db-import").click(function(){
        var self = this, status = ".";
        $.get(self.href, success, "json");
        window.onbeforeunload = function(){ return "正在还原数据库，请不要关闭！" }
        return false;
        function success(data){
            if(data.code){
                if(data.gz){
                    data.info += status;
                    if(status.length === 5){
                        status = ".";
                    } else {
                        status += ".";
                    }
                }
                var loading = layer.msg(data.msg+data.rate+'，请不要关闭本页面！', 
                {
                    icon: 1,
                    time: 3600000, //1小时后后自动关闭
                    shade: [0.2] //0.1透明度的白色背景
                });
                $(self).parent().parent().prev().find('div').text(data.msg+data.rate);
                if(data.data){
                    $.get(self.href, {"part" : data.data.part, "start" : data.data.start}, success, "json");
                }  else {
                    setTimeout(function(){
                        layer.closeAll();
                        layer.alert('还原成功！', {icon: 6, title:false});
                    }, 1000);
                    window.onbeforeunload = function(){ return null; }
                }
            } else {
                layer.alert(data.msg,{icon:2, title:false});
            }
        }
    });*/
</script>

<br/>
<div id="goTop">
    <a href="JavaScript:void(0);" id="btntop">
        <i class="fa fa-angle-up"></i>
    </a>
    <a href="JavaScript:void(0);" id="btnbottom">
        <i class="fa fa-angle-down"></i>
    </a>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#think_page_trace_open').css('z-index', 99999);
    });
</script>
</body>
</html>
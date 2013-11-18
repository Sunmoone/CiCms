<div class="main_title">
	<h2>系统信息</h2>
</div>

<div style="padding: 30px 0;" class="tac">
    <div class="set_blk">
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>服务器时间</dd>
            <dd><?php echo ServerInfo::GetServerTime();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>服务器解译引擎</dd>
            <dd><?php echo ServerInfo::GetServerSoftwares();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>PHP版本</dd>
            <dd><?php echo ServerInfo::GetPhpVersion();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>MYSQL版本</dd>
            <dd><?php echo ServerInfo::GetMysqlVersion();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>HTTP版本</dd>
            <dd><?php echo ServerInfo::GetHttpVersion();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>网站根目录</dd>
            <dd><?php echo ServerInfo::GetDocumentRoot();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>最大执行时间</dd>
            <dd><?php echo ServerInfo::GetMaxExecutionTime();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>文件上传</dd>
            <dd><?php echo ServerInfo::GetServerFileUpload();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>全局变量 register_globals</dd>
            <dd><?php echo ServerInfo::GetRegisterGlobals();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>安全模式 safe_mode</dd>
            <dd><?php echo ServerInfo::GetSafeMode();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>图形处理 GD Library</dd>
            <dd><?php echo ServerInfo::GetGdVersion();?></dd>
        </dl>
        <dl class="set_blk" style="border:0px; height:15px">
            <dd>内存占用</dd>
            <dd><?php echo ServerInfo::GetMemoryUsage();?></dd>
        </dl>
    </div> 
</div>
<script type="text/javascript" charset="utf-8">
$(function(){
  $('.sidebar dl').removeClass('show').eq(0).addClass('show');
})
</script>
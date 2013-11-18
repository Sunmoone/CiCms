<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>修改密码</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/content/create" method="post" accept-charset="utf-8">
    <div class="con_blk">
      <h3 class="light_gray">旧密码</h3>
    	<input name="old_pass" type="text" class="text">
    </div>

    <div class="con_blk">
      <h3 class="light_gray">新密码</h3>
      <input name="password" type="text" class="text">
    </div>

    <div class="con_blk">
      <h3 class="light_gray">确认新密码</h3>
      <input name="confirm" type="text" class="text">
    </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">确定</a>
	</div>
</div>

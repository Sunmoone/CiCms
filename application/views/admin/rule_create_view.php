<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>添加采集规则</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/rule/create" method="post" accept-charset="utf-8">
  <div class="con_blk">
    <h3 class="light_gray">来源</h3>
    <input name="rule_name" type="text" class="text">
  </div>
  <div class="con_blk">
      <h3 class="light_gray">页面地址</h3>
      <textarea name="url_list" width="600" height="120"></textarea>
  </div>
    <div class="con_blk">
      <h3 class="light_gray">列表规则</h3>
      <input name="list_rule" type="text" class="text">
  </div>
    <div class="con_blk">
      <h3 class="light_gray">标题正则</h3>
      <input name="title_rule" type="text" class="text">
  </div>
    <div class="con_blk">
      <h3 class="light_gray">内容正则</h3>
      <input name="content_rule" type="text" class="text">
  </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">确定</a>
	</div>
</div>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>新建采集</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/collect/create" method="post" accept-charset="utf-8">
 <div class="con_blk">
    <dt class="light_gray">采集来源</dt>
    <dl class="set_blk">
      <dd>
      <select name="category_id">
        <?php if (isset($rule_list)):?>
        <option value="0">请选择来源</option>
        <?php foreach ($rule_list as $val):?>
        <option value="<?php echo $val['id'];?>"><?php echo $val['rule_name'];?></option>
        <?php endforeach;?>
        <?php else:?>
        <option value="0">没有来源</option>
        <?php endif;?>
      </select>
      </dd>
    </dl>
  </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">开始采集</a>
	</div>
</div>
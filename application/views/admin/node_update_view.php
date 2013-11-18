<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>编辑节点</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/node/update/<?php echo $node['id'];?>" method="post" accept-charset="utf-8">
  <div class="con_blk">
    <h3 class="light_gray">节点名称</h3>
    <input name="name" type="text" value="<?php echo $node['name'];?>" class="text">
  </div>
  <div class="con_blk">
      <h3 class="light_gray">节点标题</h3>
      <input name="title" value="<?php echo $node['title'];?>" type="text" class="text">
  </div>
  <div class="con_blk">
      <dt class="light_gray">选择父节点</dt>
      <dl class="set_blk">
        <dd>
        <select name="pid">
          <option value="0">顶级</option>
          <?php if ($nodes_list):?>
          <?php foreach($nodes_list as $val):?>
            <option value="<?php echo $val['id'];?>" <?php if ($val['id'] == $node['pid']):?> selected<?php endif;?>><?php echo $val['name'];?></option>
          <?php endforeach;?>
          <?php endif;?>
        </select>
        </dd>
      </dl>
  </div>
  <div class="con_blk">
      <h3 class="light_gray">层级</h3>
      <input name="level" value="<?php echo $node['level'];?>" type="text" class="text">
  </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">确定</a>
	</div>
</div>
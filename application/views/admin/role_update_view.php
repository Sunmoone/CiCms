<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>编辑角色</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/role/update/<?php echo $role['id'];?>" method="post" accept-charset="utf-8">
    <div class="con_blk">
      <h3 class="light_gray">角色名称</h3>
    	<input name="name" value="<?php echo $role['name'];?>" type="text" class="text">
    </div>

    <div class="con_blk">
      <dt class="light_gray">状态</dt>
      <dl class="set_blk">
        <dd>
        <select name="status">
          <option value="1" <?php if ($role['status'] == 1):?> selected<?php endif;?>>启用</option>
          <option value="0" <?php if ($role['status'] == 0):?> selected<?php endif;?>>禁用</option>
        </select>
        </dd>
      </dl>
    </div>

    <div class="con_blk">
      <h3 class="light_gray">描述</h3>
      <textarea name="desc" width="600" height="120"><?php echo $role['desc'];?></textarea>
    </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">确定</a>
	</div>
</div>
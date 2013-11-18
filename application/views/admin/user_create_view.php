<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>添加用户</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/user/create" method="post" accept-charset="utf-8">
    <div class="con_blk">
      <h3 class="light_gray">用户名</h3>
        <input name="username" type="text" class="text">
    </div>
    <div class="con_blk">
      <h3 class="light_gray">昵称</h3>
        <input name="nickname" type="text" class="text">
    </div>
    <div class="con_blk">
      <h3 class="light_gray">邮箱</h3>
      <input name="email" type="text" class="text">
    </div>
    <div class="con_blk">
      <h3 class="light_gray">密码</h3>
        <input name="password" type="text" class="text">
    </div>
    <div class="con_blk">
      <h3 class="light_gray">重复密码</h3>
        <input name="confirm" type="text" class="text">
    </div>
    <div class="con_blk">
      <dt class="light_gray">选择用户组</dt>
      <dl class="set_blk">
        <dd>
        <select name="roles_id">
          <option value="0">请选择</option>
          <?php if ($roles_list):?>
          <?php foreach($roles_list as $val):?>
            <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
          <?php endforeach;?>
          <?php endif;?>
        </select>
        </dd>
      </dl>
    </div>
    <div class="con_blk">
      <dt class="light_gray">状态</dt>
      <dl class="set_blk">
        <dd>
        <select name="status">
          <option value="1">启用</option>
          <option value="0">禁用</option>
        </select>
        </dd>
      </dl>
    </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">确定</a>
	</div>
</div>
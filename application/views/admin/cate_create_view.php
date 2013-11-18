<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>添加分类</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/category/create" method="post" accept-charset="utf-8">
  <div class="con_blk">
    <h3 class="light_gray">分类名称</h3>
    <input name="name" type="text" class="text">
  </div>
  <div class="con_blk">
      <h3 class="light_gray">缩略名</h3>
      <input name="slug" type="text" class="text">
  </div>
  <div class="con_blk">
      <dt class="light_gray">选择父级分类</dt>
      <dl class="set_blk">
        <dd>
        <select name="pid">
          <option value="0">顶级</option>
          <?php if ($category_list):?>
          <?php foreach($category_list as $val):?>
            <option value="<?php echo $val['id'];?>"><?php echo $val['tab'];?><?php echo $val['name'];?></option>
          <?php endforeach;?>
          <?php endif;?>
        </select>
        </dd>
      </dl>
  </div>
  <div class="con_blk">
      <h3 class="light_gray">描述</h3>
      <textarea name="desc" width="600" height="120"></textarea>
  </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">确定</a>
	</div>
</div>
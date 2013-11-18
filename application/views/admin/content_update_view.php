<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>编辑文章</h2>
</div>
<?php if (validation_errors()) {?>
<div class="error"><?php echo validation_errors();?></div>
<?php }?>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/content/update/<?php echo $content['id'];?>" method="post" accept-charset="utf-8">
    <div class="con_blk">
      <h3 class="light_gray">文章标题</h3>
    	<input name="title" value="<?php echo $content['title'];?>" type="text" class="text">
    </div>

    <div class="con_blk">
      <dt class="light_gray">文章分类</dt>
      <dl class="set_blk">
        <dd>
        <select name="category_id">
          <?php if ($category_list):?>
          <option value="0">请选择分类</option>
          <?php foreach ($category_list as $val):?>
          <option value="<?php echo $val['id'];?>" <?php if ($val['id'] == $content['category_id']):?>selected<?php endif;?>><?php echo $val['tab'];?><?php echo $val['name'];?></option>
          <?php endforeach;?>
          <?php else:?>
          <option value="0">没有分类</option>
          <?php endif;?>
        </select>
        </dd>
      </dl>
    </div>

    <div class="con_blk">
      <h3 class="light_gray">文章内容</h3>
      <textarea name="content" width="600" height="120"><?php echo $content['content'];?></textarea>
    </div>

    <div class="con_blk">
      <dt class="light_gray">状态</dt>
      <dl class="set_blk">
        <dd>
        <select name="status">
          <option value="1" <?php if ($content['status'] ==1):?>selected<?php endif;?>>发布</option>
          <option value="0" <?php if ($content['status'] ==0):?>selected<?php endif;?>>草稿</option>
        </select>
        </dd>
      </dl>
    </div>

    <div class="con_blk">
      <h3 class="light_gray">是否允许评论</h3>
      <input type="checkbox" name="allowComment" value="1" <?php if ($content['allowComment']==1):?>checked<?php endif;?> />
    </div>
</form>
<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">取消</a>
		<a href="#" class="btn1 fr save">确定</a>
	</div>
</div>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="application/views/admin/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="application/views/admin/js/tinymce.js"></script>
<!-- /TinyMCE -->
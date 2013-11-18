<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>分类管理</h2>
	<p>分类列表</p>
</div>
     
<div class="btn_blk">
	<div class="fl"><?php if(isset($page))echo $page;?></div>
	<div class="fr">
		<a href="admin/category/delete" class="btn2 fr ml20  del_all">删除</a>
		<a href="admin/category/create" class="btn1 fr">新增</a>
	</div>
</div>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/category/delete" method="post" accept-charset="utf-8" id="res_del">
<table width="100%" class="table_list">
	<tr>
		<th width="55"><input type="checkbox" class="checkAll" rel="check[]"/></th>
		<th width="">分类名称</td>
		<th width="">缩略名</td>
		<th width="">父级分类</td>
		<th width="">描述</td>
		<th width="15%">操作</td>
	</tr>
	<?php if ($category_list):?>
	<?php foreach($category_list as $key => $val):?>
	<tr <?php if (($key+1) % 2) {?>class="odd"<?php }?>>
		<td><input type="checkbox" name="check[]" value="<?php echo $val['id'];?>"></td>
		<td><?php if ($val['pid']==0):?>
			『<?php echo $val['tab'];?><?php echo $val['name'];?>』
			<?php else:?>
			<?php echo $val['tab'];?>╚ <?php echo $val['name'];?>
			<?php endif;?>
		</td>
		<td><?php echo $val['slug'];?></td>
		<td><?php echo $val['pid'];?></td>
		<td><?php echo $val['desc'];?></td>
		<td class="tc">
			<a href="admin/category/update/<?php echo $val['id'];?>"><img src="application/views/admin/images/i.gif" class="ico_edit" title="编辑"></a> &nbsp;&nbsp;
			<a href="admin/category/delete/<?php echo $val['id'];?>" class="delete"><img src="application/views/admin/images/i.gif" class="ico_del" title="删除"></a>
		</td>
	</tr>
	<?php endforeach;?>
	<?php else: ?>
    <tr class="even">
    	<td colspan="7">没有任何分类</td>
    </tr>
    <?php endif; ?>
</table>
</form>

<div class="btn_blk">
	<div class="fl">说明：如果分类下面有子类，则不能删除。</div>
	<div class="fr">
		<?php if(isset($page))echo $page;?>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$('.del_all').click(function(){
	var check = $(":checkbox:checked").size();
	if (!check) {
		alert('你还没有选择要删除的节点');
		return false;
	};
	$("#res_del").submit();
  return false;
});
</script>


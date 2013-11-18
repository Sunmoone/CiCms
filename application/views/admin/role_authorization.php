<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>应用授权</h2>
	<p><?php echo $role['name'];?></p>
</div>
<div class="btn_blk">
	<div class="fl"><?php //echo $page;?></div>
	<div class="fr">
		<!-- <a href="admin/role/delete" class="btn2 fr ml20  del_all">删除</a> -->
		<a href="admin/role/authorization/<?php echo $role['id'];?>" class="btn1 fr" id="save">保存</a>
	</div>
</div>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/role/authorization/<?php echo $role['id'];?>" method="post" accept-charset="utf-8" id="res_del">
<table width="100%" class="table_list">
	<tr>
		<th width="55"><input type="checkbox" class="checkAll" rel="check[]"/></th>
		<th width="15%">标题</td>
		<th width="">名称</td>
		<th width="10%">节点ID</td>
		<th width="10%">父节点ID</td>
		<th width="">层级</td>
	</tr>
	<?php if ($tree):?>
	<?php foreach($tree as $key => $val):?>
	<tr <?php if (($key+1) % 2) {?>class="odd"<?php }?>>
		<td><input type="checkbox" name="check[]" value="<?php echo $val['id'];?>" <?php if (in_array($val['id'], $role['permission'])):?>checked<?php endif;?>></td>
		<td><?php if ($val['level'] == 2):?>
			<h2>『<?php echo $val['title'];?>』</h2>
			<?php elseif ($val['level'] == 1):?>
			<h2>〖<?php echo $val['title'];?>〗</h2>
			<?php else:?>
			<h2 style="margin-left:20px"><?php echo $val['title'];?></h2>
			<?php endif;?>
		</td>
		<td><?php echo $val['tab'];?>&nbsp;&nbsp;<?php echo $val['name'];?></td>
		<td><?php echo $val['id'];?></td>
		<td><?php echo $val['pid'];?></td>
		<td><?php echo $val['level'];?></td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<tr class="even">
    	<td colspan="3">没有任何用户</td>
    </tr>
    <?php endif; ?>
</table>
</form>

<div class="btn_blk">
	<div class="fr">
		<?php //echo $page;?>
	</div>
</div>

<div class="btn_blk b_t">
	<div class="fr">
		<a href="#" class="btn2 fr ml20 cancel">返回</a>
		<!-- <a href="#" class="btn1 fr save">确定</a> -->
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$('#save').click(function(){
	var check = $(":checkbox:checked").size();
	if (!check) {
		alert('你还没有选择授权的节点');
		return false;
	};
	$("#res_del").submit();
  return false;
});
</script>
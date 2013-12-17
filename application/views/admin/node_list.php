<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>节点管理</h2>
	<p>节点列表及管理</p>
</div>
     
<div class="btn_blk">
	<div class="fl"></div>
	<div class="fr">
		<a href="admin/node/delete" class="btn2 fr ml20  del_all">删除</a>
		<a href="admin/node/create" class="btn1 fr">新增</a>
	</div>
</div>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/node/delete" method="post" accept-charset="utf-8" id="res_del">
<table width="100%" class="table_list">
	<tr>
		<th width="55"><input type="checkbox" class="checkAll" rel="check[]"/></th>
		<th width="">节点ID</td>
		<th width="">节点标题</td>
		<th width="">节点标识</td>
		<th width="">节点路径</td>
		<th width="">父节点</td>
		<th width="">层级</td>
		<th width="15%">操作</td>
	</tr>
	<?php if ($node_list):?>
	<?php foreach($node_list as $key => $val):?>
	<tr <?php if (($key+1) % 2) {?>class="odd"<?php }?>>
		<td><input type="checkbox" name="check[]" value="<?php echo $val['id'];?>"></td>
		<td><?php echo $val['id'];?></td>
		<td><?php echo $val['title'];?></td>
		<td><?php echo $val['name'];?></td>
		<td><?php echo $val['breadcrumbs'];?></td>
		<td><?php echo $val['pid'];?></td>
		<td><?php echo $val['level'];?></td>
		<td class="tc">
			<a href="admin/node/update/<?php echo $val['id'];?>"><img src="application/views/admin/images/i.gif" class="ico_edit" title="编辑"></a> &nbsp;&nbsp;
			<a href="admin/node/delete/<?php echo $val['id'];?>" class="delete"><img src="application/views/admin/images/i.gif" class="ico_del" title="删除"></a>
		</td>
	</tr>
	<?php endforeach;?>
	<?php else: ?>
    <tr class="even">
    	<td colspan="8">没有任何节点</td>
    </tr>
    <?php endif; ?>
</table>
</form>

<div class="btn_blk">
	<div class="fl">说明：如果节点下面有子节点，则不能删除。</div>
	<div class="fr page">
		<?php echo $page;?>
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


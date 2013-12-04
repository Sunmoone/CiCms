<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="main_title">
	<h2>用户管理</h2>
	<p>用户列表及管理</p>
</div>

<div class="btn_blk">
	<div class="fl"><?php echo $page;?></div>
	<div class="fr">
		<a href="admin/user/delete" class="btn2 fr ml20 del_all">删除</a>
		<a href="admin/user/create" class="btn1 fr">新增</a>
	</div>
</div>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/user/delete" method="post" accept-charset="utf-8" id="res_del">
<table width="100%" class="table_list">
	<tr>
		<th width="55"><input type="checkbox" class="checkAll" rel="check[]"/></th>
		<th width="15%">用户名</th>
		<th width="15%">角色</th>
		<th width="20%">邮箱</th>
		<th width="15%">状态</td>
		<th width="">创建时间</th>
		<th width="15%">操作</th>
	</tr>
	<?php if ($user_list):?>
	<?php foreach ($user_list as $key => $val):?>
	<tr <?php if (($key+1) % 2) {?>class="odd"<?php }?>>
		<td><input type="checkbox" name="check[]" value="<?php echo $val['id'];?>"></td>
		<td><?php echo $val['username'];?> (<?php echo $val['nickname'];?>)</td>
		<td><?php echo $val['name'];?></td>
		<td><?php echo $val['email'];?></td>
		<td align="center">
			<?php if ($val['status'] == 1):?><img src="application/views/admin/images/check_mark.png"><?php endif;?>
			<?php if ($val['status'] == 0):?><img src="application/views/admin/images/delete.png"><?php endif;?>
		</td>
		<td><?php echo date('Y-m-d H:i:s', $val['created']);?></td>
		<td class="tc">
			<a href="admin/user/update/<?php echo $val['id'];?>"><img src="<?php echo base_url();?>application/views/admin/images/i.gif" class="ico_edit" title="编辑"></a>&nbsp;&nbsp;
			<a href="admin/user/delete" class="delete"><img src="<?php echo base_url();?>application/views/admin/images/i.gif" class="ico_del" title="删除"></a>
		</td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<tr class="even">
    	<td colspan="6">没有任何用户</td>
    </tr>
    <?php endif; ?>
</table>
</form>

<div class="btn_blk">
	<div class="fr">
		<?php echo $page;?>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
$('.del_all').click(function(){
	var check = $(":checkbox:checked").size();
	if (!check) {
		alert('你还没有选择要删除的用户');
		return false;
	};
	$("#res_del").submit();
  return false;
});
</script>


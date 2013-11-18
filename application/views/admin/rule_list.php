<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>采集规则</h2>
	<p>采集规则列表</p>
</div>
     
<div class="btn_blk">
	<div class="fl"><?php //echo $page;?></div>
	<div class="fr">
		<a href="admin/rule/delete" class="btn2 fr ml20  del_all">删除</a>
		<a href="admin/rule/create" class="btn1 fr">新增</a>
	</div>
</div>
<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
<form action="admin/rule/delete" method="post" accept-charset="utf-8" id="res_del">
<table width="100%" class="table_list">
	<tr>
		<th width="55"><input type="checkbox" class="checkAll" rel="check[]"/></th>
		<th width="">来源</td>
		<th width="">列表规则</td>
		<th width="">标题正则</td>
		<th width="">内容正则</td>
		<th width="15%">操作</td>
	</tr>
	<?php if (isset($rule_list)):?>
	<?php foreach($rule_list as $key => $val):?>
	<tr <?php if (($key+1) % 2) {?>class="odd"<?php }?>>
		<td><input type="checkbox" name="check[]" value="<?php echo $val['id'];?>"></td>
		<td><?php echo $val['rule_name'];?></td>
		<td><?php echo $val['list_rule'];?></td>
		<td><?php echo $val['title_rule'];?></td>
		<td><?php echo $val['content_rule'];?></td>
		<td class="tc">
			<a href="admin/rule/update/<?php echo $val['id'];?>"><img src="application/views/admin/images/i.gif" class="ico_edit" title="编辑"></a> &nbsp;&nbsp;
			<a href="admin/rule/delete/<?php echo $val['id'];?>" class="delete"><img src="application/views/admin/images/i.gif" class="ico_del" title="删除"></a>
		</td>
	</tr>
	<?php endforeach;?>
	<?php else: ?>
    <tr class="even">
    	<td colspan="7">没有任何采集规则</td>
    </tr>
    <?php endif; ?>
</table>
</form>

<div class="btn_blk">
	<div class="fl"></div>
	<div class="fr">
		<?php //echo $page;?>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$('.del_all').click(function(){
	var check = $(":checkbox:checked").size();
	if (!check) {
		alert('你还没有选择要删除的采集规则');
		return false;
	};
	$("#res_del").submit();
  return false;
});
</script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="main_title">
	<h2>组用户列表</h2>
</div>
<div class="btn_blk">
	<div class="fr">
		
	</div>
</div>
<form action="" method="post" accept-charset="utf-8" id="res_del">
<table width="50%" class="table_list">
	<tr>
		<th width="">当前组：<?php echo $role['name'];?></td>
	</tr>
	<?php if ($user_list):?>
	<?php foreach($user_list as $key => $val):?>
	<tr <?php if (($key+1) % 2) {?>class="odd"<?php }?>>
		<td><?php echo $val['username'];?></td>
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

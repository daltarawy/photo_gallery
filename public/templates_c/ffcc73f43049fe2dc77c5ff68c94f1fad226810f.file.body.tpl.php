<?php /* Smarty version Smarty-3.1.16, created on 2014-01-01 16:27:09
         compiled from "..\templates\body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2488552c46cff82dd17-41250124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffcc73f43049fe2dc77c5ff68c94f1fad226810f' => 
    array (
      0 => '..\\templates\\body.tpl',
      1 => 1388611622,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2488552c46cff82dd17-41250124',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52c46cff831b98_90796305',
  'variables' => 
  array (
    'photos' => 0,
    'photo' => 0,
    'pagination' => 0,
    'i' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c46cff831b98_90796305')) {function content_52c46cff831b98_90796305($_smarty_tpl) {?><div id="main">

	<?php  $_smarty_tpl->tpl_vars['photo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['photo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['photos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['photo']->key => $_smarty_tpl->tpl_vars['photo']->value) {
$_smarty_tpl->tpl_vars['photo']->_loop = true;
?>
	<div style="float: left; margin-left: 20px;">
		<a href="photo.php?id=<?php echo $_smarty_tpl->tpl_vars['photo']->value->id;?>
">  <img
			src="<?php echo $_smarty_tpl->tpl_vars['photo']->value->image_path();?>
" width="200" />
		</a>
		<p><?php echo $_smarty_tpl->tpl_vars['photo']->value->caption;?>
</p>
	</div>
	<?php } ?>



	<div id="pagination" style="clear: both;">
		<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pagination']->value->total_pages();?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1>1) {?>
			
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pagination']->value->has_previous_page();?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2) {?>
				<a href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['pagination']->value->previous_page();?>
">&laquo; Previous</a>
			<?php }?>
			
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pagination']->value->total_pages();?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_tmp3+1 - (1) : 1-($_tmp3)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
				<?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->tpl_vars['page']->value) {?>
					<span class="selected"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</span>
				<?php } else { ?>
					<a href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
				<?php }?>
			<?php }} ?>
			
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pagination']->value->has_next_page();?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4) {?>
				<a href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['pagination']->value->next_page();?>
">Next &raquo;</a>
			<?php }?>
		<?php }?>
	</div>

</div>

<?php }} ?>

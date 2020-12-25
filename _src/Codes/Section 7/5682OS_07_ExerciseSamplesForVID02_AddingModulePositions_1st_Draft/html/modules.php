<?php


defined('_JEXEC') or die;

function modChrome_foo($module, &$params, &$attribs)
{
	if (!empty ($module->content)) {
	 
		$color = $attribs['color']; 	?>
        
		<div class="foo moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
		<?php if (!empty($module->showtitle)) { ?>
			<h3><?php echo $module->title; ?></h3>
		<?php } ?>
			<?php echo $module->content; ?>
		</div>
	<?php }
}

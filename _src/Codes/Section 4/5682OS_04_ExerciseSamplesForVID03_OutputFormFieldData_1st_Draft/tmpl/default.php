<?php
defined('_JEXEC') or die;
?>
<div class="goodcook<?php echo $moduleclass_sfx; ?>">
	<?php
    foreach ($data as $class => $item) {

		if ($class == "items") {
			foreach ($item as $itm) {
				echo "<div>".$itm->linkitem."</div>";
			}
			continue;
		}
    ?>
        <div class="<?php echo $class; ?>"><?php echo $item; ?></div>
    <?php 
    }
    ?>
</div>

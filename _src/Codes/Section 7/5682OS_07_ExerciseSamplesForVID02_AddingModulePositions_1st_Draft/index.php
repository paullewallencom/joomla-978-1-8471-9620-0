<?php
defined('_JEXEC') or die;
// Get template parameters
$params = JFactory::getApplication()->getTemplate(true)->params;

// Set the logo as an image file or text as per the template params
if ($this->params->get('logoFile')){
	$logo = '<img src="'. JURI::root() . 
			$this->params->get('logoFile') .
			'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle')){
	$logo = '<span class="site-title" title="'. 
			$sitename .'">'. 
			htmlspecialchars($this->params->get('sitetitle')) .
			'</span>';
}
else{
	$logo = '<span class="site-title" title="'. $sitename .'">'. 
			$sitename .'</span>';
}

// Make sure bootstrap is active
JHtml::_('bootstrap.framework');

// Basic objects for accessing Joomla functionality
$app = JFactory::getApplication();
$doc = JFactory::getDocument();

// Add Stylesheet for Template
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Calculate Variables to be added to the CSS classes on the body
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $doc->language; ?>" lang="<?php echo $doc->language; ?>" >
<head>
	<jdoc:include type="head" />
</head>
<body class="site  <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '');
?>">
	<!-- Body -->
	<div class="body">
		<div class="container">
			<!-- Header -->
			<div class="header">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>">
						<?php echo $logo;?>
					</a>
				</div>
			</div>
			<div class="row-fluid">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<!-- End Content -->
				</div>
			</div>
		</div>
	</div>
	<!-- End Body -->
    <?php if ($this->countModules( 'footer' )) { ?>
        <!-- Footer -->
        <div class="footer">
            <div class="container">
                <hr />
                <jdoc:include type="modules" name="footer" style="none" />
            </div>
        </div>
        <!-- End Footer -->
    <?php } ?>
    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>










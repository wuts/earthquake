<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// needed to seperate the ISO number from the language file constant _ISO
$iso = split( '=', _ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php
if ( $my->id ) {
	initEditor();
}
mosShowHead();

?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div id="wrapper">
		<div id="wrapperbg">
			<div id="header">
				<div id="header_logo"><a href="<?php echo $mosConfig_live_site;?>"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/logo.gif" alt="<?php echo $mosConfig_sitename;?>" border="0" /></a></div>
				<div id="header_banner">
					<div id="header_banner_left">
					<?php 
					if (mosCountModules('banner')) {
						mosLoadModules('banner', -1);
					}
					?></div>
					<div id="header_banner_right">
					<?php 
					if (mosCountModules('top')) {
						mosLoadModules('top', -1);
					}
					?></div>
				</div>
			</div>
			<div class="clr"></div>
			<div id="horizmenusep"></div>
			<div id="horizmenu">
				<div id="horizmenu_left">
					<?php mosPathWay(); ?>
				</div>
				<div id="horizmenu_right">
					<?php mosLoadModules('toolbar', -1); ?>
				</div>
			</div>
			<div class="clr"></div>
			<div id="bodywrapper">
				<?php if (mosCountModules('left')) { ?>
				<div id="sidebar_left">
						<?php mosLoadModules('left', -2); ?>
				</div>
				<?php } ?>
				<div id="mainbody">
						<?php if (mosCountModules('user1')) { ?>
						<?php mosLoadModules('user1', -2); ?>
						<?php } ?>
						<?php mosMainBody(); ?>
						<?php if (mosCountModules('user2')) { ?>
						<div id="horizsep"></div>
						<?php mosLoadModules('user2', -2); ?>
						<?php } ?>
				</div>
			</div>

			<div class="clr"></div>
			<div id="horizmenu">
				<div id="horizmenu_left">
					<?php mosLoadModules('bottom', -1); ?>
				</div>
			</div>
			<div id="horizmenusep"></div>
			<div id="footer">
				<?php mosLoadModules('footer', -1); ?>
				<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
				<?php mosLoadModules('advert1', -1); ?>
				<?php mosLoadModules( 'debug', -1 ); ?>
			</div>
		</div>
	</div>
</body>
</html>

<?php
/**
* @version $Id: index.php,v 1.1 2005/07/22 01:54:20 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$tstart = mosProfiler::getmicrotime();
// needed to seperate the ISO number from the language file constant _A_ISO
$iso = explode( '=', _A_ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _A_ISO; ?>" />
<title><?php echo $mosConfig_sitename; ?> - Administration [Mambo]</title>
<script language="JavaScript">var RTLsupport = <?php echo ($adminLanguage->RTLsupport ? "true" : "false" ); ?> ;</script> <!-- rtl change -->
<link rel="stylesheet" href="templates/mambo_admin_blue/css/<?php echo (!$adminLanguage->RTLsupport ? 'template_css.css' : 'template_css_rtl.css'); ?>" type="text/css" /> <!-- rtl change -->
<link rel="stylesheet" href="templates/mambo_admin_blue/css/theme.css" type="text/css" />
<script language="JavaScript" src="<?php echo $mosConfig_live_site; ?>/includes/js/JSCookMenu.js" type="text/javascript"></script>
<script language="JavaScript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/ThemeOffice/theme.js" type="text/javascript"></script>
<script language="JavaScript" src="<?php echo $mosConfig_live_site; ?>/includes/js/mambojavascript.js" type="text/javascript"></script>
<?php
// if(@$_REQUEST["task"] == "edit" || @$_REQUEST["task"] == "new") {
// MUST be included ALWAYS for custom components to work
	include_once( $mosConfig_absolute_path . "/editor/editor.php" );
	initEditor();
//}
?>
<!--
*	DO NOT REMOVE THE FOLLOWING - FAILURE TO COMPLY IS A DIRECT VIOLATION
*	OF THE GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/copyleft/gpl.html
-->
<?php
echo "<meta name=\"Generator\" content=\"Mambo (C) 2000 - 2005 Miro International Pty Ltd.  All rights reserved.\" />\r\n";
?>
<!--
*	END OF COPYRIGHT
-->
</head>
<body onload="MM_preloadImages('images/help_f2.png','images/archive_f2.png','images/back_f2.png','images/cancel_f2.png','images/delete_f2.png','images/edit_f2.png','images/new_f2.png','images/preview_f2.png','images/publish_f2.png','images/save_f2.png','images/unarchive_f2.png','images/unpublish_f2.png','images/upload_f2.png')">
<div id="wrapper">
    <div id="header">
    		<?php 
			if (file_exists ("templates/mambo_admin_blue/images/header_text_".$mosConfig_alang.".png"))
				echo '<div id="mambo"><img src="templates/mambo_admin_blue/images/header_text_'.$mosConfig_alang.'.png" alt="Mambo Logo" /></div>'."\n";
			else
				echo '<div id="mambo"><img src="templates/mambo_admin_blue/images/header_text.png" alt="Mambo Logo" /></div>'."\n";
			?>    
    </div>
</div>
<?php if (!mosGetParam( $_REQUEST, 'hidemainmenu', 0 )) { ?>
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td class="menubackgr"><?php mosLoadAdminModule( 'fullmenu' );?></td>
    <td class="menubackgr" align="right">
        <div id="wrapper1">
			<?php mosLoadAdminModules( 'header', 2 );?>
		</div>
	</td>
    <td class="menubackgr" align="right"><a href="index2.php?option=logout" style="color: #333333; font-weight: bold"><?php echo $adminLanguage->A_LOGOUT;?></a> <strong><?php echo $my->username;?></strong>&nbsp;</td>
    </tr>
</table>
<?php } ?>
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td class="menudottedline" width="40%">
    	<?php mosLoadAdminModule( 'pathway' );?>
    </td>
    <td class="menudottedline" align="<?php echo ($adminLanguage->RTLsupport ? 'left' : 'right'); ?>"> <!-- rtl change -->
  		<?php mosLoadAdminModule( 'toolbar' );?>
    </td>
  </tr>
</table>
<br />
<?php mosLoadAdminModule( 'mosmsg' );?>
<div align="center">
<div class="main">
<table width="100%" border="0">
  <tr>
    <td valign="middle" align="center">
	<?php
	// Show list of items to edit or delete or create new
	if ($path = $mainframe->getPath( 'admin' )) {
		require $path;
	} else {
		echo "<img src=\"images/logo.png\" border=\"0\" alt=\"Mambo Logo\" />\r\n<br />\r\n";
	}
	?>
   </td>
  </tr>
</table>
</div>
</div>
<table width="99%" border="0">
<tr>
<td align="center"><?php
include ($mosConfig_absolute_path . "/includes/footer.php");
echo ("<div class=\"smallgrey\">");
$tend = mosProfiler::getmicrotime();
$totaltime = ($tend - $tstart);
printf ($adminLanguage->A_GENERATE_TIME, $totaltime);
echo ("</div>");
?>
</td></tr></table>
<?php mosLoadAdminModules( 'debug' );?>
</body>
</html>                                                                                                    
                                                                                                    

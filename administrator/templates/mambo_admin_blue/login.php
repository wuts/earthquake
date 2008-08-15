<?php
/**
* @version $Id: login.php,v 1.1 2005/07/22 01:54:20 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$tstart = mosProfiler::getmicrotime();
?>
<?php echo "<?xml version=\"1.0\"?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _A_ISO; ?>" />
<title><?php echo $mosConfig_sitename; ?> - Administration [Mambo]</title>
<link rel="stylesheet" href="templates/mambo_admin_blue/css/<?php echo (!$adminLanguage->RTLsupport) ? 'admin_login.css' : 'admin_login_rtl.css'; ?>" type="text/css" />

<script language="javascript" type="text/javascript">
	function setFocus() {
		document.loginForm.usrname.select();
		document.loginForm.usrname.focus();
	}
</script>
</head>
<body onload="setFocus();">
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
<div id="ctr" align="center">
	<div class="login">
		<div class="login-form">
			<?php 
			if (file_exists ("templates/mambo_admin_blue/images/login_".$mosConfig_alang.".gif"))
				echo '<img src="templates/mambo_admin_blue/images/login_'.$mosConfig_alang.'.gif" alt="Login" />'."\n";
			else
				echo '<img src="templates/mambo_admin_blue/images/login.gif" alt="Login" />'."\n";			
			?>
        	<form action="index.php" method="post" name="loginForm" id="loginForm">
			<div class="form-block">
	        	<div class="inputlabel"><?php echo $adminLanguage->A_USERNAME;?></div>
		    	<div><input name="usrname" type="text" class="inputbox" size="15" /></div>
	        	<div class="inputlabel"><?php echo $adminLanguage->A_PASSWORD;?></div>
		    	<div><input name="pass" type="password" class="inputbox" size="15" /></div>
	        	<div align=<?php echo ($adminLanguage->RTLsupport) ? '"right"' : '"left"'; ?>><input type="submit" name="submit" class="button" value="<?php echo $adminLanguage->A_LOGIN; ?>" /></div>
        	</div>
			</form>
    	</div>
		<div class="login-text">
			<div class="ctr"><img src="templates/mambo_admin_blue/images/security.png" width="64" height="64" alt="security" /></div>
        	<?php echo $adminLanguage->A_WELCOME_MAMBO;?>
    	</div>
		<div class="clr"></div>
	</div>
</div>
<div id="break"></div>
<noscript>
<?php echo $adminLanguage->A_WARNING_JAVASCRIPT;?>
</noscript>
<div class="footer" align="center">
<?php
	include ($mosConfig_absolute_path . "/includes/footer.php");
?>
</div>
</body>
</html>

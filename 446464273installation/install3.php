<?php
/**
* @version $Id: install3.php,v 1.10 2005/02/20 19:47:42 mic Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
*/

/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );

/** Include common.php */
include_once("common.php");

$DBhostname = trim( mosGetParam( $_POST, 'DBhostname', '' ) );
$DBuserName = trim( mosGetParam( $_POST, 'DBuserName', '' ) );
$DBpassword = trim( mosGetParam( $_POST, 'DBpassword', '' ) );
$DBname  	= trim( mosGetParam( $_POST, 'DBname', '' ) );
$DBPrefix  	= trim( mosGetParam( $_POST, 'DBPrefix', '' ) );
$DBSample  	= trim( mosGetParam( $_POST, 'DBSample', '' ) );
$sitename  	= trim( mosGetParam( $_POST, 'sitename', '' ) );
$adminEmail = trim( mosGetParam( $_POST, 'adminEmail', '') );
$siteUrl  	= trim( mosGetParam( $_POST, 'siteUrl', '' ) );
$absolutePath = trim( mosGetParam( $_POST, 'absolutePath', '' ) );
$adminPassword = trim( mosGetParam( $_POST, 'adminPassword', '') );
$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$detected_lang = trim( mosGetParam( $_POST, 'detected_lang', '' ) );
$install_iso = trim( mosGetParam( $_POST, 'install_iso', '' ) );

if ( file_exists( 'language/install_'.$language_install.'.php')) {
	require_once( '../language/'.$language_install.'.php' );
	require_once( 'language/install_'.$language_install.'.php' );
} else {
	require_once( '../language/english.php' );
	require_once( 'language/install_english.php' );
}

$filePerms = '0777';
$dirPerms = '0777';

if ((trim($adminEmail== "")) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $adminEmail )==false)) {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install2.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"DBSample\" value=\"$DBSample\">
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"language_install\" value=\"$language_install\" />
		<input type=\"hidden\" name=\"detected_lang\" value=\"$detected_lang\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		</form>";
	echo "<script>alert('" . html_convert( _INSTALL_JS_CHECKEMAIL ) . "'); document.stepBack.submit(); </script>";
	return;
}

if($DBhostname && $DBuserName && $DBname) {
	$configArray['DBhostname'] = $DBhostname;
	$configArray['DBuserName'] = $DBuserName;
	$configArray['DBpassword'] = $DBpassword;
	$configArray['DBname']     = $DBname;
	$configArray['DBPrefix']   = $DBPrefix;
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install2.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"DBSample\" value=\"$DBSample\">
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"language_install\" value=\"$language_install\" />
		<input type=\"hidden\" name=\"detected_lang\" value=\"$detected_lang\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		</form>";

	echo "<script>alert('" . html_convert( _INSTALL_JS_CHECKDB ) . "'); document.stepBack.submit(); </script>";
	return;
}

if ($sitename) {
	if (!get_magic_quotes_gpc()) {
		$configArray['sitename'] = addslashes($sitename);
	} else {
		$configArray['sitename'] = $sitename;
	}
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install2.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"DBSample\" value=\"$DBSample\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"language_install\" value=\"$language_install\" />
		<input type=\"hidden\" name=\"detected_lang\" value=\"$detected_lang\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		</form>";

	echo "<script>alert('".html_convert(_INSTALL_JS_CHECKSITENAME)."'); document.stepBack2.submit();</script>";
	return;
}

if (file_exists( '../configuration.php' )) {
	$canWrite = is_writable( '../configuration.php' );
} else {
	$canWrite = is_writable( '..' );
}

if ($siteUrl) {
	$chmod_mail = '';
	$configArray['siteUrl']=$siteUrl;
	// Fix for Windows
	$absolutePath= str_replace( '\\', '/', $absolutePath );
	$absolutePath= str_replace( '//', '/', $absolutePath );
	$configArray['absolutePath'] = $absolutePath;
	$configArray['filePerms'] = $filePerms;
	$configArray['dirPerms'] = $dirPerms;

	$config = "<?php\n";
	$config .= "\$mosConfig_offline = '0';\n";
	$config .= "\$mosConfig_host = '{$configArray['DBhostname']}';\n";
	$config .= "\$mosConfig_user = '{$configArray['DBuserName']}';\n";
	$config .= "\$mosConfig_password = '{$configArray['DBpassword']}';\n";
	$config .= "\$mosConfig_db = '{$configArray['DBname']}';\n";
	$config .= "\$mosConfig_dbprefix = '{$configArray['DBPrefix']}';\n";
	$config .= "\$mosConfig_lang = '".$language_install."';\n";
	$config .= "\$mosConfig_alang = '".$language_install."';\n";
	$config .= "\$mosConfig_absolute_path = '{$configArray['absolutePath']}';\n";
	$config .= "\$mosConfig_live_site = '{$configArray['siteUrl']}';\n";
	$config .= "\$mosConfig_sitename = '{$configArray['sitename']}';\n";
	$config .= "\$mosConfig_shownoauth = '0';\n";
	$config .= "\$mosConfig_allowUserRegistration = '1';\n";
	$config .= "\$mosConfig_useractivation = '1';\n";
	$config .= "\$mosConfig_uniquemail = '1';\n";
	$config .= "\$mosConfig_allowRegisteredSubmitContent = '0';\n";
	$config .= "\$mosConfig_offline_message = "._INSTALL_CONF_SITE_MAINTAIN.";\n";
	$config .= "\$mosConfig_error_message = "._INSTALL_CONF_SITE_UNAVAILABLE.";\n";
	$config .= "\$mosConfig_debug = '0';\n";
	$config .= "\$mosConfig_lifetime = '900';\n";
	$config .= "\$mosConfig_MetaDesc = "._INSTALL_CONF_METADESC.";\n";
	$config .= "\$mosConfig_MetaKeys = "._INSTALL_CONF_METAKEYS.";\n";
	$config .= "\$mosConfig_MetaTitle = '1';\n";
	$config .= "\$mosConfig_MetaAuthor = '1';\n";
	// check if language is detected otherwise use standard value from language file
	//if( $detected_lang != '') $mosConfig_tmp_locale = $detected_lang; else $mosConfig_tmp_locale = _INSTALL_CONF_LANGUAGE_REF;
	$config .= "\$mosConfig_locale = '"._INSTALL_CONF_LANGUAGE_REF."';\n";  // original
	//$config .= "\$mosConfig_locale = '".$mosConfig_tmp_locale."';\n";
	$config .= "\$mosConfig_offset = '0';\n";
	$config .= "\$mosConfig_hideAuthor = '0';\n";
	$config .= "\$mosConfig_hideCreateDate = '0';\n";
	$config .= "\$mosConfig_hideModifyDate = '0';\n";
	$config .= "\$mosConfig_hidePdf = '".intval( !is_writable( "{$configArray['absolutePath']}/media/" ) )."';\n";
	$config .= "\$mosConfig_hidePrint = '0';\n";
	$config .= "\$mosConfig_hideEmail = '0';\n";
	$config .= "\$mosConfig_enable_log_items = '0';\n";
	$config .= "\$mosConfig_enable_log_searches = '0';\n";
	$config .= "\$mosConfig_enable_stats = '0';\n";
	$config .= "\$mosConfig_sef = '0';\n";
	$config .= "\$mosConfig_vote = '0';\n";
	$config .= "\$mosConfig_gzip = '0';\n";
	$config .= "\$mosConfig_multipage_toc = '1';\n";
	$config .= "\$mosConfig_link_titles = '0';\n";
	$config .= "\$mosConfig_error_reporting = '-1';\n";
	$config .= "\$mosConfig_register_globals = '1';\n";
	$config .= "\$mosConfig_list_limit = '20';\n";
	$config .= "\$mosConfig_caching = '0';\n";
	$config .= "\$mosConfig_cachepath = '{$configArray['absolutePath']}/cache';\n";
	$config .= "\$mosConfig_cachetime = '900';\n";
	$config .= "\$mosConfig_mailer = 'mail';\n";
	$config .= "\$mosConfig_mailfrom = '$adminEmail';\n";
	$config .= "\$mosConfig_fromname = '{$configArray['sitename']}';\n";
	$config .= "\$mosConfig_sendmail = '/usr/sbin/sendmail';\n";
	$config .= "\$mosConfig_smtpauth = '0';\n";
	$config .= "\$mosConfig_smtpuser = '';\n";
	$config .= "\$mosConfig_smtppass = '';\n";
	$config .= "\$mosConfig_smtphost = 'localhost';\n";
	$config .= "\$mosConfig_back_button = '1';\n";
	$config .= "\$mosConfig_item_navigation = '1';\n";
	$config .= "\$mosConfig_secret = '" . mosMakePassword(16) . "';\n";
	$config .= "\$mosConfig_pagetitles = '1';\n";
	$config .= "\$mosConfig_readmore = '1';\n";
	$config .= "\$mosConfig_hits = '1';\n";
	$config .= "\$mosConfig_icons = '1';\n";
	$config .= "\$mosConfig_favicon = 'favicon.ico';\n";
	$config .= "\$mosConfig_fileperms = '".$configArray['filePerms']."';\n";
	$config .= "\$mosConfig_dirperms = '".$configArray['dirPerms']."';\n";
	$config .= "\$mosConfig_helpurl = 'http://www.mambochina.net';\n";
	$config .= "\$mosConfig_mbf_content = '0';\n";
	$config .= "setlocale (LC_TIME, \$mosConfig_locale);\n";
	$config .= "?>";

	if ($canWrite && ($fp = @fopen("../configuration.php", "w"))) {
		@fputs( $fp, $config, strlen( $config ) );
		@fclose( $fp );
	} else {
		$canWrite = false;
	}

	$cryptpass = md5($adminPassword);

	mysql_connect($DBhostname, $DBuserName, $DBpassword);
	mysql_select_db($DBname);

	// create the admin user
	$installdate = date("Y-m-d H:i:s");
	$query = "INSERT INTO `{$DBPrefix}users` VALUES (62, 'Administrator', 'admin', '$adminEmail', '$cryptpass', 'Superadministrator', 0, 1, 25, '$installdate', '0000-00-00 00:00:00', '', '')";
	mysql_query( $query );
	// add the ARO (Access Request Object)
	$query = "INSERT INTO `{$DBPrefix}core_acl_aro` VALUES (10,'users','62',0,'Administrator',0)";
	mysql_query( $query );
	// add the map between the ARO and the Group
	$query = "INSERT INTO `{$DBPrefix}core_acl_groups_aro_map` VALUES (25,'',10)";
	mysql_query( $query );

	// now rename the installation folder
	$ren_mail = false;
	// contruct a new name for installation folder
	$tmp_instname = crc32( time() );
	$tmp_instname = substr( $tmp_instname, 1, strlen( $tmp_instname ) ) . 'installation';
	@chmod( $absolutePath.'/installation', 0777 );
	if( @rename ( $absolutePath.'/installation', $absolutePath.'/' . $tmp_instname ) ){
		$ren_mail = true;
		@chmod( $absolutePath.'/' . $tmp_instname, 0644 );
	}
	// end rename
} else { ?>
	<form action="install2.php" method="post" name="stepBack3" id="stepBack3">
  		<input type="hidden" name="DBhostname" value="<?php echo $DBhostname; ?>" />
  		<input type="hidden" name="DBusername" value="<?php echo $DBuserName; ?>" />
  		<input type="hidden" name="DBpassword" value="<?php echo $DBpassword; ?>" />
  		<input type="hidden" name="DBname" value="<?php echo $DBname; ?>" />
  		<input type="hidden" name="DBPrefix" value="<?php echo $DBPrefix; ?>" />
  		<input type="hidden" name="DBcreated" value="1" />
  		<input type="hidden" name="sitename" value="<?php echo $sitename; ?>" />
  		<input type="hidden" name="language_install" value="<?php echo $language_install; ?>" />
  		<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
  		<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
  		<input type="hidden" name="adminEmail" value="<?php echo $adminEmail; ?>" />
  		<input type="hidden" name="siteUrl" value="<?php echo $siteUrl; ?>" />
  		<input type="hidden" name="absolutePath" value="<?php echo $absolutePath; ?>" />
  		<input type="hidden" name="filePerms" value="<?php echo $filePerms; ?>" />
  		<input type="hidden" name="dirPerms" value="<?php echo $dirPerms; ?>" />
  	</form>
	<?php
	echo "<script>alert('".html_convert(_INSTALL_JS_CHECKURL)."'); document.stepBack3.submit();</script>";
}

echo "<?xml version=\"1.0\" encoding=\"" . $install_iso . "\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $install_iso; ?>" />
<title><?php echo _MAMBO_WEB_INSTALLER . _INSTALL_STEP_3; ?></title>
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<?php
if( $ren_mail ) $img_path = '../'. $tmp_instname . '/'; else $img_path = '../installation/';
if( file_exists( $img_path . 'images/header_'.substr( $language_install, 0, 3 ).'_install.png' ) ){
	$install_img = $img_path . 'images/header_'.substr( $language_install, 0, 3 ).'_install.png';
}else $install_img = $img_path . 'images/header_eng_install.png'; ?>

<div id="wrapper">
	<div id="header">
		<div id="mambo">
    		<img src="<?php echo $install_img ; ?>" alt="<?php echo _INSTALL_MAMBO; ?>" />
    		<?php echo '<font color="#FF9900"><strong><a href="http://www.mambochina.net" target="_blank">' . _MAMBORS_VERSION . '</a></strong></font>'; ?>
    	</div>
	</div>
</div>

<div id="ctr" align="center">
		<form name="form" id="form">

	<div class="install">
		<div id="stepbar">
      	<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_LICENSE; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_1; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_2; ?></div>
		<div class="step-on"><?php echo _INSTALL_STEP_3; ?></div>
		</div>
		<div id="right">

	  <div id="step"><?php echo _INSTALL_STEP_3; ?></div>

	  <div class="far-right">
        <input class="button" type="button" name="runSite" value="<?php echo _INSTALL_VIEWSITE; ?>"
     		<?php if ($siteUrl){
     			print "onClick='window.location.href=\"$siteUrl"."/index.php\" '";
     		}	else {
     			print "onClick='window.location.href=\"{$configArray['siteURL']}"."/index.php\" '";
     		}
    		?> />
        <input class="button" type="button" name="Admin" value="<?php echo _INSTALL_LOGINADMIN; ?>"
     		<?php
     		if ($siteUrl){
     			print "onClick='window.location.href=\"$siteUrl"."/administrator/index.php\" '";
     		} else {
     			print "onClick='window.location.href=\"{$configArray['siteURL']}"."/administrator/index.php\" '";
     		}
    		?> />
      </div>
    	<div class="clr"></div>
    	<h1><?php echo _INSTALL_CONGRATULATION; ?></h1>

      <div class="install-text"> <?php echo _INSTALL_DESCRIPTION; ?> </div>

	  <div class="install-form">
        <div class="form-block">
          <table width="100%">
            <tr>
              <td colspan="2" class="error" align="center">
              	<?php if( $ren_mail ) echo sprintf( _INSTALL_MAIL_DEL_INSTALLDIR_RENAME, $tmp_instname ); else echo _INSTALL_MAIL_DEL_INSTALLDIR; ?>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center"><h5><?php echo _INSTALL_LOGIN; ?></h5></td>
            </tr>
            <tr>
              <td colspan="2" align="center" class="notice"><strong><?php echo _INSTALL_ADMIN_USERNAME; ?></strong></td>
            </tr>
            <tr>
              <td colspan="2" align="center" class="notice"><strong><?php echo _INSTALL_ADMIN_PASSWORD." ".$adminPassword; ?></strong></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <?php
    		  	if (!$canWrite) { ?>
            		<tr>
              			<td colspan="2" class="small"><?php echo html_convert(_INSTALL_ALERT); ?> </td>
            	   	</tr>
            		<tr>
              			<td colspan="2" align="center"> <textarea rows="5" cols="60" name="configcode" onclick="javascript:this.form.configcode.focus();this.form.configcode.select();" ><?php echo html_convert( $config ); ?></textarea>
              			</td>
            		</tr>
            		<?php
    		  	} ?>
          </table>
        </div>
      </div>
    	<div id="break"></div>
		</div>
		<div class="clr"></div>
		</form>
	</div>
	<div class="clr"></div>
</div>
<div class="ctr">
	<?php echo _D_MAMBORS; ?>
</div>
</body>
</html>

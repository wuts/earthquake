<?php
/**
* @version $Id: install1.php,v 1.7 2004/02/20 20:20:51 mic Exp $
* @package MMLi
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
*/

/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );

/** Include common.php */
include_once( "common.php" );

$DBhostname = trim( mosGetParam( $_POST, 'DBhostname', 'localhost' ) );
$DBuserName = trim( mosGetParam( $_POST, 'DBuserName', '' ) );
$DBpassword = trim( mosGetParam( $_POST, 'DBpassword', '' ) );
$DBverifypassword = trim(mosGetParam( $_POST, 'DBverifypassword', '' ) );
$DBname  	= trim( mosGetParam( $_POST, 'DBname', '' ) );
$DBPrefix  	= trim( mosGetParam( $_POST, 'DBPrefix', 'mos_' ) );
$DBDel  	= trim( mosGetParam( $_POST, 'DBDel', '' ) );
$DBBackup  	= trim( mosGetParam( $_POST, 'DBBackup', '' ) );
$DBSample  	= trim( mosGetParam( $_POST, 'DBSample', 1 ) );
$DBHelp 	= trim( mosGetParam( $_POST, 'DBHelp', '' ) );
$DBcreated = trim( mosGetParam( $_POST, 'DBcreated', 0 ) );
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

echo "<?xml version=\"1.0\" encoding=\"".$install_iso."\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $install_iso; ?>" />
<title><?php echo _MAMBO_WEB_INSTALLER . _INSTALL_STEP_1; ?></title>
<link rel="shortcut icon" href="../../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
function check() {
	<!-- form validation check -->
	var formValid=false;
	var f = document.form;
	if ( f.DBhostname.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_HOSTNAME ); ?>');
		f.DBhostname.focus();
		formValid=false;
	} else if ( f.DBuserName.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_USERNAME ); ?>');
		f.DBuserName.focus();
		formValid=false;
	} else if ( f.DBpassword.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_PASSWORD ); ?>');
		f.DBpassword.focus();
		formValid=false;
	} else if ( f.DBname.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_BASENAME ); ?>');
		f.DBname.focus();
		formValid=false;
	} else if ( confirm('<?php echo html_convert( _INSTALL_DB_JS_WARNING ); ?>')) {
		formValid=true;
	}
	return formValid;
}
// -->
</script>
</head>
<body onload="document.form.DBhostname.focus();"/>
<?php
if( file_exists( 'images/header_'.substr( $language_install, 0, 3 ).'_install.png' ) ){
	$install_img = 'images/header_'.substr( $language_install, 0, 3 ).'_install.png';
}else $install_img = 'images/header_eng_install.png'; ?>
<div id="wrapper">
	<div id="header">
		<div id="mambo">
    		<img src="<?php echo $install_img ; ?>" alt="<?php echo _INSTALL_MAMBO; ?>" />
    		<?php echo '<font color="#FF9900"><strong><a href="http://www.mambochina.net" target="_blank">' . _MAMBORS_VERSION . '</a></strong></font>'; ?>
    	</div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="install2.php" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="language_install" value="<?php echo $language_install; ?>">
	<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
	<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	<div class="install">
    <div id="stepbar">
      	<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_LICENSE ; ?></div>
		<div class="step-on"><?php echo _INSTALL_STEP_1 ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_2 ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_3 ; ?></div>
      </div>
      <div id="right">
      <div class="far-right">
        <input class="button" type="submit" name="next" value="<?php echo _INSTALL_NEXT; ?>"/>
      </div>
      <div id="step"><?php echo _INSTALL_STEP_1 ; ?></div>
  		<div class="clr"></div>
  		<h1><?php echo _INSTALL_DB_SECTION ; ?></h1>
      <div class="install-form">
        <div class="form-block">
          <table class="content2">
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_HOSTNAME; ?><br/><input class="inputbox" type="text" name="DBhostname" value="<?php echo "$DBhostname"; ?>" /></td>
			  <td><?php echo _INSTALL_DB_HOSTNAME_DESCRIPTION ; ?></td>
            </tr>
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_USERNAME ; ?><br/><input class="inputbox" type="text" name="DBuserName" value="<?php echo "$DBuserName"; ?>" /></td>
			  <td><?php echo _INSTALL_DB_USERNAME_DESC ; ?></td>
            </tr>
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_PASSWORD ; ?><br/><input class="inputbox" type="password" name="DBpassword" value="" /></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
				<td colspan="2"><?php echo _INSTALL_DB_PASSWORD_VERRIFY ; ?><br/><input class="inputbox" type="password" name="DBverifypassword" value="" /></td>
				<td>&nbsp;</td>
			</tr>
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_BASENAME ; ?><br/><input class="inputbox" type="text" name="DBname" value="<?php echo "$DBname"; ?>" /></td>
			  			<td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_PREFIX ; ?><input class="inputbox" type="text" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" /></td>
			  <td><?php echo _INSTALL_DB_PREFIX_DESC ; ?></td>
            </tr>
            <tr>
			  <td><input type="checkbox" name="DBDel" id="DBDel" value="1" <?php if ($DBDel) echo 'checked="checked"'; ?> /></td>
			  <td><label for="DBDel"><?php echo _INSTALL_DB_DROPTABLES ; ?></label></td>
  			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td><input type="checkbox" name="DBBackup" id="DBBackup" value="1" <?php if ($DBBackup) echo 'checked="checked"'; ?> /></td>
			  <td><label for="DBBackup"><?php echo _INSTALL_DB_BACKUP ; ?></label></td>
  			  <td><?php echo _INSTALL_DB_BACKUP_DESCRIPTION ; ?></td>
			</tr>
  		  	<tr>
			  <td><input type="checkbox" name="DBSample" id="DBSample" value="1" <?php if ($DBSample) echo 'checked="checked"'; ?> /></td>
			  <td><label for="DBSample"><?php echo _INSTALL_DB_SAMPLE_DATA ; ?></label></td>
			  <td><?php echo _INSTALL_DB_SAMPLE_DATA_DESC ; ?></td>
			</tr>
          </table>
        </div>
      </div>
    </div>
	<div class="clr"></div>
	</form>
	</div>
      </div>
  <div class="clr"></div>
</div>
<div class="ctr">
	<?php echo _D_MAMBORS ; ?>
</div>
</body>
</html>

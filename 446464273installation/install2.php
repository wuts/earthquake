<?php
/**
* @version $Id: install2.php,v 1.7 2005/02/20 21:13:51 mic Exp $
* @package MMLi
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
*/

/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );

/** Include common.php */
require_once( "common.php" );
require_once( "../includes/database.php" );

$DBhostname = trim( mosGetParam( $_POST, 'DBhostname', '' ) );
$DBuserName = trim( mosGetParam( $_POST, 'DBuserName', '' ) );
$DBpassword = trim( mosGetParam( $_POST, 'DBpassword', '' ) );
$DBverifypassword = trim(mosGetParam( $_POST, 'DBverifypassword', '' ) );
$DBname  	= trim( mosGetParam( $_POST, 'DBname', '' ) );
$DBPrefix  	= trim( mosGetParam( $_POST, 'DBPrefix', '' ) );
$DBDel  	= intval( trim( mosGetParam( $_POST, 'DBDel', '' ) ) );
$DBBackup  	= intval( trim( mosGetParam( $_POST, 'DBBackup', '' ) ) );
$DBSample  	= intval( trim( mosGetParam( $_POST, 'DBSample', '' ) ) );
$DBcreated = trim( mosGetParam( $_POST, 'DBcreated', 0 ) );
$BUPrefix = 'old_';

$configArray['sitename'] = trim( mosGetParam( $_POST, 'sitename', '' ) );
$sitename  	= trim( mosGetParam( $_POST, 'sitename', '' ) );
$adminEmail = trim( mosGetParam( $_POST, 'adminEmail', '') );
$configArray['siteUrl'] = trim( mosGetParam( $_POST, 'siteUrl', '' ) );
$configArray['absolutePath'] = trim( mosGetParam( $_POST, 'absolutePath', '' ) );

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

if (get_magic_quotes_gpc()) {
	$configArray['absolutePath'] = stripslashes(stripslashes($configArray['absolutePath']));
	$sitename = stripslashes(stripslashes($sitename));
}

$database = null;
$errors = array();

if ($DBcreated != 1){
	if (!$DBhostname || !$DBuserName || !$DBname) {
		db_err ( 'install1.php', _INSTALL_DB_ERROR1);
	}
	if ($DBpassword !== $DBverifypassword) {
		db_err ("install1.php", INSTALL_DB_ERROR5);
	}
	if (!($mysql_link = @mysql_connect( $DBhostname, $DBuserName, $DBpassword ))) {
		db_err ( 'install1.php', _INSTALL_DB_ERROR2);
	}

	if( $DBname == '' ) {
		db_err ( 'install1.php', _INSTALL_DB_ERROR3);
	}

	// Does this code actually do anything???
	$configArray['DBhostname'] = $DBhostname;
	$configArray['DBuserName'] = $DBuserName;
	$configArray['DBpassword'] = $DBpassword;
	$configArray['DBname']     = $DBname;
	$configArray['DBPrefix']   = $DBPrefix;

	$mysql_charsets['utf-8']='utf8';
	$mysql_charsets['iso-8859-1']='latin1';
	$mysql_charsets['iso-8859-15']='latin1';
	$mysql_charsets['koi8-r']='koi8r';
	$mysql_charsets['windows-1251']='cp1251';
	$mysql_charsets['cp1251']='cp1251';
	$mysql_charsets['gb2312']='gbk';
	$mysql_charsets['gb18030']='gbk';
	$mysql_charsets['gbk']='gbk';
	$mysql_charsets['big5-hkscs']='big5';
	$mysql_charsets['big5']='big5';
	$mysql_charsets['euc-tw']='big5';
	$mysql_charsets['iso-8859-2']='latin2';
	$mysql_charsets['windows-1250']='latin2';
	$mysql_charsets['iso-8859-7']='latin7';
	$mysql_charsets['iso-8859-8-i']='hebrew';
	$mysql_charsets['iso-8859-8']='hebrew';
	$mysql_charsets['sjis']='sjis';
	$mysql_charsets['windows-1257']='latin7';
	$mysql_charsets['iso-8859-13']='latin7';
	$mysql_charsets['cp-866']='cp1251';
	$mysql_charsets['iso-8859-5']='latin5';
	$mysql_charsets['koi8-u']='koi8r';
	$mysql_charsets['windows-1252']='latin1';
	$mysql_charsets['tis-620']='tis620';
	$mysql_charsets['iso-8859-9']='latin5';
	$mysql_charsets['windows-1256']='cp1256';
	$mysql_charsets['georgian-ps']='geostd8';
	$mysql_charsets['euc-jp']='eucjpms';
	$mysql_charsets['euc-kr']='euckr';
	$mysql_charsets['iso-8859-6']='cp1256';
	$mysql_charsets['windows-1258']='latin1'; //No better match

	// test if db exists or is reachable
	$sql = "CREATE DATABASE `$DBname`";
	if(floatval(mysql_get_server_info())>=4.1) {
		$charset = strtolower( _CHARSET );
		if ( $charset == 'utf8' ) $charset = 'utf-8';
		$cs=isset($mysql_charsets[$charset]) ? $mysql_charsets[$charset] : 'latin1';
		$sql .= ' DEFAULT CHARACTER SET ' . $cs;
	}
			
	$mysql_result = @mysql_query( $sql );
	$test = mysql_errno();

	if ($test <> 0 && $test <> 1007) {
		db_err( 'install1.php', _INSTALL_DB_ERROR4 . ' ' . mysql_errno() ); // '-L german' -> lokalisierte Fehlermeldung
	}

	// db is now new or existing, create the db object connector to do the serious work
	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );

	// delete existing mos table if requested
	if ($DBDel) {
		$database->setQuery( "SHOW TABLES FROM `$DBname`" );
		$errors = array();
		if ($tables = $database->loadResultArray()) {
			foreach ($tables as $table) {
				if (strpos( $table, $DBPrefix ) === 0) {
					if ($DBBackup) {
						$butable = str_replace( $DBPrefix, $BUPrefix, $table );
						$database->setQuery( "DROP TABLE IF EXISTS `$butable`" );
						$database->query();
						if ($database->getErrorNum()) {
							$errors[$database->getQuery()] = $database->getErrorMsg();
						}
						$database->setQuery( "RENAME TABLE `$table` TO `$butable`" );
						$database->query();
						if ($database->getErrorNum()) {
							$errors[$database->getQuery()] = $database->getErrorMsg();
						}
					}
					$database->setQuery( "DROP TABLE IF EXISTS `$table`" );
					$database->query();
					if ($database->getErrorNum()) {
						$errors[$database->getQuery()] = $database->getErrorMsg();
					}
				}
			}
		}
		if( count( $errors ) ){
			db_err( 'install1.php', _INSTALL_DB_DATAERROR );
			//exit();
		}
	}

	if( file_exists( 'sql/mambo_'.$language_install.'.sql' ) ) {
		populate_db( $DBname,$DBPrefix,'mambo_'.$language_install.'.sql' );
	}else populate_db( $DBname,$DBPrefix,'mambo_english.sql' );

	if ( $DBSample == 1 ) {
		if( file_exists( 'sql/sample_'.$language_install.'_data.sql' ) ) {
			populate_db( $DBname,$DBPrefix,'sample_'.$language_install.'_data.sql' );
		}else populate_db( $DBname,$DBPrefix,'sample_english_data.sql' );
	}
}

function db_err( $step, $alert ) {
	global $DBhostname,$DBuserName,$DBpassword,$DBDel,$DBname,$DBPrefix, $DBSample, $language_install, $detected_lang, $install_iso; ?>
	<html>
	<body>
	<form name="stepBack" method="post" action="<?php echo $step; ?>">
		<input type="hidden" name="DBhostname" value="<?php echo $DBhostname; ?>" />
		<input type="hidden" name="DBuserName" value="<?php echo $DBuserName; ?>" />
		<input type="hidden" name="DBpassword" value="<?php echo $DBpassword; ?>" />
		<input type="hidden" name="DBname" value="<?php echo $DBname; ?>" />
		<input type="hidden" name="DBPrefix" value="<?php echo $DBPrefix; ?>" />
		<input type="hidden" name="DBSample" value="<?php echo $DBSample; ?>" />
		<input type="hidden" name="DBcreated" value="1" />
		<input type="hidden" name="language_install" value="<?php echo $language_install; ?>" />
		<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
		<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	</form>
	</body>
	</html>
	<?php
	echo "<script>alert('" . html_convert( $alert ) . "'); document.stepBack.submit();</script>";
	exit;
}

function populate_db( $DBname, $DBPrefix, $sqlfile ) {
	global $errors, $database;

	@mysql_select_db($DBname);
	$mqr = @get_magic_quotes_runtime();
	@set_magic_quotes_runtime(0);
	$query = fread(fopen("sql/".$sqlfile, "r"), filesize("sql/".$sqlfile));
	@set_magic_quotes_runtime($mqr);
	$pieces  = split_sql($query);

	for ($i=0; $i<count($pieces); $i++) {
		$pieces[$i] = trim($pieces[$i]);
		if(!empty($pieces[$i]) && $pieces[$i] != "#") {
			if(floatval(mysql_get_server_info())>=4.1) {
				if (preg_match ("/create( )+table/i", $pieces[$i])) {
					$charset = ' DEFAULT CHARACTER SET ' . $database->_charset;
					$pieces[$i] = str_replace(';', '', $pieces[$i]);
					$pieces[$i] = $pieces[$i] . $charset;
				}
			}

			$pieces[$i] = str_replace( "#__", $DBPrefix, $pieces[$i]);
			if (!$result = @mysql_query ($pieces[$i])) {
				$errors[] = array ( mysql_error(), $pieces[$i] );
			}
		}
	}
}

function split_sql($sql) {
	$sql = trim($sql);
	$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);

	$buffer = array();
	$ret = array();
	$in_string = false;

	for($i=0; $i<strlen($sql)-1; $i++) {
		if($sql[$i] == ";" && !$in_string) {
			$ret[] = substr($sql, 0, $i);
			$sql = substr($sql, $i + 1);
			$i = 0;
		}

		if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
			$in_string = false;
		}
		elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
			$in_string = $sql[$i];
		}
		if(isset($buffer[1])) {
			$buffer[0] = $buffer[1];
		}
		$buffer[1] = $sql[$i];
	}

	if(!empty($sql)) {
		$ret[] = $sql;
	}
	return($ret);
}

$isErr = intval( count( $errors ) );

echo "<?xml version=\"1.0\" encoding=\"".$install_iso."\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $install_iso; ?>" />
<title><?php echo _MAMBO_WEB_INSTALLER . _INSTALL_STEP_2; ?></title>
<link rel="shortcut icon" href="../../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
function check() {
	<!-- form validation check -->
	var formValid = true;
	var f = document.form;
	if ( f.sitename.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_SITENAME); ?>');
		f.sitename.focus();
		formValid = false
	} else if ( f.siteUrl.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_SITEURL); ?>');
		f.siteUrl.focus();
		formValid = false;
	} else if ( f.absolutePath.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_PATH); ?>');
		f.absolutePath.focus();
		formValid = false;
	} else if ( f.adminEmail.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_EMAIL); ?>');
		f.adminEmail.focus();
		formValid = false;
	} else if ( f.adminPassword.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_PASSWORD); ?>');
		f.adminPassword.focus();
		formValid = false;
	}

	return formValid;
}
// -->
</script>
</head>
<?php
if (!$isErr) echo '<body onload="document.form.sitename.focus();"/>'; else echo '<body onload="document.form.back.focus();"/>';
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
	<?php if (!$isErr) $butt_action = 'install3.php'; else $butt_action = 'install1.php'; ?>
	<form action="<?php echo $butt_action; ?>" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="DBhostname" value="<?php echo $DBhostname; ?>" />
	<input type="hidden" name="DBuserName" value="<?php echo $DBuserName; ?>" />
	<input type="hidden" name="DBpassword" value="<?php echo $DBpassword; ?>" />
	<input type="hidden" name="DBname" value="<?php echo $DBname; ?>" />
	<input type="hidden" name="DBPrefix" value="<?php echo $DBPrefix; ?>" />
	<input type="hidden" name="DBSample" value="<?php echo $DBSample; ?>" />
	<input type="hidden" name="language_install" value="<?php echo $language_install; ?>">
	<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
	<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	<div class="install">
    <div id="stepbar">
      	<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_LICENSE; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_1; ?></div>
		<div class="step-on"><?php echo _INSTALL_STEP_2; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_3; ?></div>
      </div>
      <div id="right">

      <div class="far-right">
      <?php
      if (!$isErr) { ?>
      	<input class="button" type="submit" name="next" value="<?php echo _INSTALL_NEXT; ?>" />
        <?php
      }else{ ?>
      	<input style="color:red" class="button" type="submit" name="back" value="<?php echo _INSTALL_BACK; ?>" />
        <?php
      } ?>
      </div>

      <div id="step"><?php echo _INSTALL_STEP_2; ?></div>
  		<div class="clr"></div>

  		<h1><?php echo _INSTALL_SITE_SECTION; ?></h1>

      <div class="install-text">
        <?php if ($isErr) {
        echo '<span style="font-size:xx-small;color:red">';
		echo _INSTALL_DB_DATAERROR ;
		echo '</span>';
	 	}
	 	else {
	 		echo _INSTALL_SITE_DESCRIPTION ;
	 	}?>
      </div>

      <div class="install-form">
        <div class="form-block">
          <table class="content2">
            <?php
            if ($isErr) {
            	echo '<tr><td colspan="2">';
            	echo _INSTALL_DB_LOGERROR . '<br />';
            	// abrupt failure
            	echo '<textarea rows="20" cols="95">';
            	foreach($errors as $error) {
            		echo "SQL=$error[0]:\n- - - - - - - - - -\n$error[1]\n= = = = = = = = = =\n\n";
            	}
            	echo '</textarea>';
            	echo '</td></tr>';
            } else { ?>
            <tr>
              <td width="100"><?php echo _INSTALL_SITE_NAME; ?></td>
              <td align="left"><input class="inputbox" type="text" name="sitename" size="50" value="<?php echo "{$configArray['sitename']}"; ?>" /></td>
            </tr>
			<tr>
					<td width="100"><?php echo _INSTALL_SITE_URL; ?></td>
						<?php
						$url = '';
						if( $configArray['siteUrl'] ){
							$url = $configArray['siteUrl'];
					}else{
						$root = $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
					$root = str_replace( 'installation/', '', $root);
					$root = str_replace( '/install2.php', '', $root);
						$url = 'http://' . $root;
				}?>
				<td align="left"><input class="inputbox" type="text" name="siteUrl" value="<?php echo $url; ?>" size="50" /></td>
			</tr>
			<tr>
				<td><?php echo _INSTALL_SITE_PATH ; ?></td>
					<?php
					$abspath = '';
					if( $configArray['absolutePath'] ){
					$abspath = $configArray['absolutePath'];
					}else{
						$path = getcwd();
					if( preg_match( '/\/installation/i', $path )) {
						$abspath = str_replace( '/installation', '', $path);
					}else{
						$abspath = str_replace( '\installation' , '', $path);
					} 
				} ?>
				<td align="left"><input class="inputbox" type="text" name="absolutePath" value="<?php echo $abspath; ?>" size="50" /></td>
			</tr>
			<tr>
				<td><?php echo _INSTALL_SUPERADMIN_EMAIL; ?></td>
				<td align="left"><input class="inputbox" type="text" name="adminEmail" value="<?php echo "$adminEmail"; ?>" size="50" /></td>
			</tr>
			<tr>
				<td><?php echo _INSTALL_SUPERADMIN_PASSWORD; ?></td>
				<td align="left"><input class="inputbox" type="text" name="adminPassword" value="<?php echo mosMakePassword(8); ?>" size="50" /></td>
			</tr>
			<tr>
					<td>&nbsp;</td>
					<td><?php echo _INSTALL_ADMIN_PW; ?></td>
			</tr>
		<?php
          } 
        ?>
		</table>

        </div>
      </div>
  	  <div class="clr"></div>
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

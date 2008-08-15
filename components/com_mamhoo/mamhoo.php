<?php
/**
* @version $Id: mamhoo.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$access = new stdClass();
$access->canEdit = $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'all' );
$access->canEditOwn = $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'own' );

require_once ("administrator/components/com_mamhoo/mamhoo.class.php");

require_once ( $mainframe->getPath( 'front_html' ) );
$task = mosGetParam( $_REQUEST, 'task' );

switch( $task ) {
	case "saveUpload":
	saveUpload( $mosConfig_dbprefix, $uid, $option, $userfile, $userfile_name, $type, $existingImage);
	break;

	case "UserDetails":
	userEdit( $option, $my->id, _UPDATE );
	break;

	case "saveUserEdit":
	userSave( $option, $my->id );
	break;

	case "UserView":
	UserView( $option, $my->id );
	break;

	case "CheckIn":
	CheckIn( $my->id, $access, $option );
	break;

	case "lostPassword":
	$aUrl = mamhooutils::getlostPasswordUrl();
	if ($aUrl) {
		echo "<script>document.location.href='$aUrl'</script>\n";
		exit;
	}
	else {
		lostPassForm( $option );
	}
	break;

	case "sendNewPass":
	sendNewPass( $option );
	break;

	case "register":
	$aUrl = mamhooutils::getRegisterUrl();
	if ($aUrl) {
		echo "<script>document.location.href='$aUrl'</script>\n";
		exit;
	}
	else {
		registerForm( $option, $mosConfig_useractivation );
	}
	break;

	case "saveRegistration":
	saveRegistration( $option );
	break;

	case "activate":
	activate( $option );
	break;

	default:
	HTML_mamhoo::frontpage();
	break;
}

mamhooutils::showCopyright();

function lostPassForm( $option ) {
	global $mainframe;
	$mainframe->SetPageTitle(_PROMPT_PASSWORD);
	HTML_mamhoo::lostPassForm($option);
}

function sendNewPass( $option ) {
	global $database;
	global $mosConfig_live_site, $mosConfig_sitename;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;
	global $_MAMHOOKS;

	$_live_site = $mosConfig_live_site;
	$_sitename = $mosConfig_sitename;

	// ensure no malicous sql gets past
	$checkusername = trim( mosGetParam( $_POST, 'checkusername', '') );
	$checkusername = $database->getEscaped( $checkusername );
	$confirmEmail = trim( mosGetParam( $_POST, 'confirmEmail', '') );
	$confirmEmail = $database->getEscaped( $confirmEmail );

	$database->setQuery( "SELECT id FROM #__users"
	. "\nWHERE username='$checkusername' AND email='$confirmEmail'"
	);

	if (!($user_id = $database->loadResult()) || !$checkusername || !$confirmEmail) {
		mosRedirect( "index.php?option=$option&task=lostPassword&mosmsg="._ERROR_PASS );
	}

	$database->setQuery( "SELECT name, email FROM #__users"
	. "\n WHERE usertype='superadministrator'" );
	$rows = $database->loadObjectList();
	foreach ($rows AS $row) {
		$adminName = $row->name;
		$adminEmail = $row->email;
	}

	$newpass = mosMakePassword();
	$message = _NEWPASS_MSG;
	eval ("\$message = \"$message\";");
	$subject = _NEWPASS_SUB;
	eval ("\$subject = \"$subject\";");

	mosMail($mosConfig_mailfrom, $mosConfig_fromname, $confirmEmail, $subject, $message);

	$newpass = md5( $newpass );
	$query = "UPDATE #__users SET password='$newpass' WHERE id='$user_id'";
	$database->setQuery( $query );
	$database->query() or die( $database->stderr(true) );

	//************************************************************//
	// onChangePassword 事件处理
	$results = $_MAMHOOKS->hook( 'onChangePassword', array( $user_id, $newpass ) );

	//************************************************************//

	mosRedirect( "index.php?option=$option&task=default", _NEWPASS_SENT );

	
}

function registerForm( $option, $useractivation ) {
	global $mainframe, $database, $my, $acl;

	if (!$mainframe->getCfg( 'allowUserRegistration' )) {
		mosNotAuth();
		return;
	}

	$query = "SELECT * from #__mamhoo_config where fieldshow = 1 ";
	$database->SetQuery($query);
	$mamhoo_configs = $database->LoadObjectList();

	$mainframe->SetPageTitle(_REGISTER_TITLE);
	HTML_mamhoo::registerForm($mamhoo_configs, $option, $useractivation);
}

function saveRegistration( $option ) {
	global $database, $my, $acl;
	global $mosConfig_sitename, $mosConfig_live_site, $mosConfig_useractivation, $mosConfig_allowUserRegistration;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;
	global $_MAMHOOKS;

	if ($mosConfig_allowUserRegistration=="0") {
		mosNotAuth();
		return;
	}

	$row = new mosUser( $database );

	if (!$row->bind( $_POST, "usertype" )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->name = $row->username;
	
	mosMakeHtmlSafe($row);

	$row->id = 0;
	$row->usertype = '';
	$row->gid = $acl->get_group_id('Registered','ARO');

	if ($mosConfig_useractivation=="1") {
		$row->activation = md5( mosMakePassword() );
		$row->block = "1";
	}

	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$pwd = $row->password;
	$row->password = md5( $row->password );
	$row->registerDate = date("Y-m-d H:i:s");

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

//// Begin mamhoo

	$rowMamhoo = new mosmamhoo($database);
	if (!$rowMamhoo->bind( $_POST )) {
		echo "<script> alert('".$rowMamhoo->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$rowMamhoo->store($row->id)) {
		echo "<script> alert('".$rowMamhoo->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
//// End mamhoo

	//************************************************************//
	// onCreateUser 事件处理
	$results = $_MAMHOOKS->hook( 'onCreateUser', array( &$row ) );

	//************************************************************//

	$name = $row->name;
	$userEmail = $row->email;
	$username = $row->username;

	$subject = sprintf (_SEND_SUB, $name, $mosConfig_sitename);
	$subject = html_entity_decode($subject, ENT_QUOTES);
	if ($mosConfig_useractivation=="1"){
		$message = sprintf (_USEND_MSG_ACTIVATE, $name, $mosConfig_sitename, $mosConfig_live_site."/index.php?option=com_mamhoo&task=activate&activation=".$row->activation, $mosConfig_live_site, $username, $pwd);
	} else {
		$message = sprintf (_USEND_MSG, $name, $mosConfig_sitename, $mosConfig_live_site);
	}

	$message = html_entity_decode($message, ENT_QUOTES);
	// Send email to user
	if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
		$adminName = $mosConfig_fromname;
		$adminEmail = $mosConfig_mailfrom;
	} else {
		$query = "SELECT name, email FROM #__users WHERE gid=25 LIMIT 0,1";
		$database->setQuery( $query );
		$database->loadObject( $adminObj );
		$adminName = $adminObj->name;
		$adminEmail = $adminObj->email;
	}

	mosMail($adminEmail, $adminName, $userEmail, $subject, $message);

	// Send notification to all administrators
	$subject = sprintf (_SEND_SUB, $name, $mosConfig_sitename);
	$message = sprintf (_ASEND_MSG, $adminName, $mosConfig_sitename, $name, $userEmail, $username);
	$subject = html_entity_decode($subject, ENT_QUOTES);
	$message = html_entity_decode($message, ENT_QUOTES);

	$database->setQuery( "SELECT email FROM #__users WHERE gid=25 AND sendmail>0" );
	$adminEmails = $database->loadResultArray();
	if (count($adminEmails)>0) {
		mosMail($adminEmail, $adminName, $adminEmails, $subject, $message);
	}
	
	if ( $mosConfig_useractivation == "1" ){
		echo _REG_COMPLETE_ACTIVATE;
	} else {
		echo _REG_COMPLETE;
	}

}

function activate( $option ) {
	global $database;
	global $_MAMHOOKS;

	$activation = trim( mosGetParam( $_REQUEST, 'activation', '') );

	$database->setQuery( "SELECT id FROM #__users"
	."\n WHERE activation='$activation' AND block='1'" );
	$result = $database->loadResult();

	if ($result) {
		$database->setQuery( "UPDATE #__users SET block='0', activation='' WHERE activation='$activation' AND block='1'" );
		if (!$database->query()) {
			echo "SQL error" . $database->stderr(true);
		}

	$cid = array($result);
	$block = 0;
	//************************************************************//
	// onBlockUser 事件处理
	$results = $_MAMHOOKS->hook( 'onBlockUser', array( $cid, $block ) );

	//************************************************************//

	mosRedirect( "index.php?option=$option&task=default", _REG_ACTIVATE_COMPLETE );
	} else {
	mosRedirect( "index.php?option=$option&task=default", _REG_ACTIVATE_NOT_FOUND );
	}
}

function is_email($email){
	$rBool=false;

	if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)){
		$rBool=true;
	}
	return $rBool;
}

############################################################################

function saveUpload($database, $_dbprefix, $uid, $option, $userfile, $userfile_name, $type, $existingImage) {
	global $database;

	if ($uid == 0) {
		mosNotAuth();
		return;
	}

	$base_Dir = "images/stories/";
	$checksize=filesize($userfile);
	if ($checksize > 50000) {
		echo "<script> alert(\""._UP_SIZE."\"); window.history.go(-1); </script>\n";
	} else {
		if (file_exists($base_Dir.$userfile_name)) {
			$message=_UP_EXISTS;
			eval ("\$message = \"$message\";");
			print "<script> alert('$message'); window.history.go(-1);</script>\n";
		} else {
			if ((!strcasecmp(substr($userfile_name,-4),".gif")) || (!strcasecmp(substr($userfile_name,-4),".jpg"))) {
				if (!move_uploaded_file($userfile, $base_Dir.$userfile_name))
				{
					echo _UP_COPY_FAIL." $userfile_name";
				} else {
					echo "<script>window.opener.focus;</script>";
					if ($type=="news") {
						$op="UserNews";
					} elseif ($type=="articles") {
						$op="UserArticle";
					}

					if ($existingImage!="") {
						if (file_exists($base_Dir.$existingImage)) {
							//delete the exisiting file
							unlink($base_Dir.$existingImage);
						}
					}
					echo "<script>window.opener.document.adminForm.ImageName.value='$userfile_name';</script>";
					echo "<script>window.opener.document.adminForm.ImageName2.value='$userfile_name';</script>";
					echo "<script>window.opener.document.adminForm.imagelib.src=null;</script>";
					echo "<script>window.opener.document.adminForm.imagelib.src='images/stories/$userfile_name';</script>";
					echo "<script>window.close(); </script>";
				}
			} else {
				echo "<script> alert(\""._UP_TYPE_WARN."\"); window.history.go(-1); </script>\n";
			}
		}
	}
}


function userEdit( $option, $uid, $submitvalue) {
	global $database;
	if ($uid == 0) {
		mosNotAuth();
		return;
	}
	$query = "SELECT u.*, m.* from #__users as u
						LEFT JOIN #__mamhoo as m ON u.id = m.user_id
						WHERE u.id = $uid ";
	$database->SetQuery($query);
	$rows = $database->LoadObjectList();
	$row = $rows[0];

	$query = "SELECT * from #__mamhoo_config where fieldshow = 1 ";
	$database->SetQuery($query);
	$mamhoo_configs = $database->LoadObjectList();

	HTML_mamhoo::userEdit( $row, $mamhoo_configs, $option, $submitvalue );
}


function userSave( $option, $uid) {
	global $database;
	global $_MAMHOOKS;

	$user_id = intval( mosGetParam( $_POST, 'id', 0 ));

	// do some security checks
	if ($uid == 0 || $user_id == 0 || $user_id <> $uid) {
		mosNotAuth();
		return;
	}
	$row = new mosUser( $database );
	$row->load( $user_id );
	$row->orig_password = $row->password;

	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->name = $row->username;
	mosMakeHtmlSafe($row);

	if(isset($_POST["password"]) && $_POST["password"] != "") {
		if(isset($_POST["verifyPass"]) && ($_POST["verifyPass"] == $_POST["password"])) {
			$row->password = md5($_POST["password"]);
		} else {
			echo "<script> alert(\""._PASS_MATCH."\"); window.history.go(-1); </script>\n";
			exit();
		}
	} else {
		// Restore 'original password'
		$row->password = $row->orig_password;
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	unset($row->orig_password); // prevent DB error!!

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	//更新用户session记录的用户名
	$query = "UPDATE #__session SET username= '$row->username' WHERE userid = $row->id ";
	$database->setQuery( $query );
	$database->query() or die( $database->stderr() );

	// save Mamhoo details
	$rowMamhoo = new mosmamhoo($database);

	if (!$rowMamhoo->bind( $_POST )) {
		echo "<script> alert('".$rowMamhoo->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (!$rowMamhoo->store($user_id, true)) {
		echo "<script> alert('".$rowMamhoo->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	//************************************************************//
	// onModifyUser 事件处理
	$results = $_MAMHOOKS->hook( 'onModifyUser', array( &$row ) );

	//************************************************************//
	
	mosRedirect( "index.php?option=$option&task=default", _USER_DETAILS_SAVE );
}


function UserView( $option, $uid ) {
	global $database;
	if ($uid == 0) {
		mosNotAuth();
		return;
	}
	$userid = intval( mosGetParam( $_REQUEST, 'userid', 0 ));
	if ($userid == 0) {
		$userid = $uid;
	}
	$query = "SELECT u.*, m.* from #__users as u
						LEFT JOIN #__mamhoo as m ON u.id = m.user_id
						WHERE u.id = $userid ";
	$database->SetQuery($query);
	$rows = $database->LoadObjectList();
	if ( count($rows) < 1) {
		echo _MAMHOO_USER_NOT_EXISTS;
		return;
	}
	$row = $rows[0];

	$query = "SELECT * from #__mamhoo_config ";
	$database->SetQuery($query);
	$mamhoo_configs = $database->LoadObjectList();

	HTML_mamhoo::UserView( $row, $mamhoo_configs, $option );
}

############################################################################
?>

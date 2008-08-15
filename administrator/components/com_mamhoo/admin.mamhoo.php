<?php
/**
* $Id: admin.mamhoo.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!$acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' )) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$element = mosGetParam( $_REQUEST, 'element', '' );
$client = mosGetParam( $_REQUEST, 'client', '' );

if ( $element == "mamhook" ) {
	require_once( $mosConfig_absolute_path . "/administrator/components/com_mamhoo/installer/mamhook.php" );
}
else {
	$cid = mosGetParam( $_REQUEST, 'cid', array( 0 ) );
	if (!is_array( $cid )) {
		$cid = array ( 0 );
	}
		
	switch ($task) {
		case "new":
			editUser( 0, $option);
			break;
	
		case "edit":
			editUser( intval( $cid[0] ), $option );
			break;
		
		case "save":
			saveUser( $option );
			break;
		
		case "remove":
			removeUsers( $cid, $option );
			break;
		
		case "block":
			changeUserBlock( $cid, 1, $option );
			break;
		
		case "unblock":
			changeUserBlock( $cid, 0, $option );
			break;
		
		case 'logout':
			logoutUser( $cid, $option );
			break;
		
		case 'cancel':
			cancelUser( $option );
			break;
		
		case "config":
			config( $option );
			break;
		
		case "saveconfig":
			saveConfig( $option );
			break;
		
		case "about":
			showAbout();
			break;
		
		default:
			showUsers( $option );
			break;
	}
}
mamhooutils::showCopyright();

function showAbout() {
	HTML_mamhoo::showAbout();
}

function showUsers( $option ) {
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit, $mosConfig_absolute_path;

	$filter_type	= $mainframe->getUserStateFromRequest( "filter_type{$option}", 'filter_type', 0 );
	$filter_logged	= $mainframe->getUserStateFromRequest( "filter_logged{$option}", 'filter_logged', 0 );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search = $database->getEscaped( trim( strtolower( $search ) ) );
	$where = array();

	if (isset( $search ) && $search!= "") {
		$where[] = "(a.username LIKE '%$search%' OR a.email LIKE '%$search%' OR a.name LIKE '%$search%')";
	}
	if ( $filter_type ) {
		if ( $filter_type == 'Public Frontend' ) {
			$where[] = "g.name = 'Registered' OR g.name = 'Author' OR g.name = 'Editor'OR g.name = 'Publisher'";
		} else if ( $filter_type == 'Public Backend' ) {
			$where[] = "g.name = 'Manager' OR g.name = 'Administrator' OR g.name = 'Super Administrator'";
		} else {
			$where[] = "g.name = '$filter_type'";
		}
	}
	if ( $filter_logged == 1 ) {
		$where[] = "s.userid = a.id";
	} else if ($filter_logged == 2) {
		$where[] = "s.userid IS NULL";
	}

	// exclude any child group id's for this user
	//$acl->_debug = true;
	$pgids = $acl->get_group_children( $my->gid, 'ARO', 'RECURSE' );

	if (is_array( $pgids ) && count( $pgids ) > 0) {
		$where[] = "(a.gid NOT IN (" . implode( ',', $pgids ) . "))";
	}

	$query = "SELECT COUNT(a.id)"
	. "\n FROM #__users AS a";
	if ($filter_logged == 1 || $filter_logged == 2) {
		$query .= "\n INNER JOIN #__session AS s ON s.userid = a.id";
	}
	$query .= ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' );
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( "$mosConfig_absolute_path/administrator/includes/pageNavigation.php" );
	$pageNav = new mosPageNav( $total, $limitstart, $limit	);

	$query = "SELECT a.*, g.name AS groupname"
	. "\n FROM #__users AS a"
	. "\n INNER JOIN #__core_acl_aro AS aro ON aro.value = a.id"	// map user to aro
	. "\n INNER JOIN #__core_acl_groups_aro_map AS gm ON gm.aro_id = aro.aro_id"	// map aro to group
	. "\n INNER JOIN #__core_acl_aro_groups AS g ON g.group_id = gm.group_id";
	if ($filter_logged == 1 || $filter_logged == 2) {
		$query .= "\n INNER JOIN #__session AS s ON s.userid = a.id";
	}
	$query .= (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
	. "\n GROUP BY a.id"
	. "\n LIMIT $pageNav->limitstart, $pageNav->limit"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$template = 'SELECT COUNT(s.userid) FROM #__session AS s WHERE s.userid = %d';
	$n = count( $rows );
	for ($i = 0; $i < $n; $i++) {
		$row = &$rows[$i];
		$query = sprintf( $template, intval( $row->id ) );
		$database->setQuery( $query );
		$row->loggedin = $database->loadResult();
	}

	// get list of Groups for dropdown filter
	$query = "SELECT name AS value, name AS text"
	. "\n FROM #__core_acl_aro_groups"
	. "\n WHERE name != 'ROOT'"
	. "\n AND name != 'USERS'"
	;
	$types[] = mosHTML::makeOption( '0', '- Select Group -' );
	$database->setQuery( $query );
	$types = array_merge( $types, $database->loadObjectList() );
	$lists['type'] = mosHTML::selectList( $types, 'filter_type', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_type" );

	// get list of Log Status for dropdown filter
	$logged[] = mosHTML::makeOption( 0, '- Select Log Status - ');
	$logged[] = mosHTML::makeOption( 1, 'Logged In');
	$lists['logged'] = mosHTML::selectList( $logged, 'filter_logged', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_logged" );
	HTML_mamhoo::showUsers( $rows, $pageNav, $search, $option, $lists );
}

function editUser( $uid='0', $option='users' ) {
	global $database, $my, $acl;

	//$row = new mosUser( $database );
	//load the row from the db table
	//$row->load( $uid );
	$row = null;
	if ($uid) {
		$query = "SELECT u.*, m.* from #__users as u
							LEFT JOIN #__mamhoo as m ON u.id = m.user_id
							WHERE u.id = $uid ";
		$database->SetQuery($query);
		$rows = $database->LoadObjectList();
		$row = $rows[0];

		$query = "SELECT * FROM #__contact_details WHERE user_id='". $row->id ."'";
		$database->setQuery( $query );
		$contact = $database->loadObjectList();
	} else {
		$contact = NULL;
	}

	$query = "SELECT * from #__mamhoo_config ";
	$database->SetQuery($query);
	$mamhoo_configs = $database->LoadObjectList();

	$lists = array();							 

	$my_group = strtolower( $acl->get_group_name( $row->gid, 'ARO' ) );
	if ($my_group == 'super administrator') {
		$lists['gid'] = '<input type="hidden" name="gid" value="'. $my->gid .'" /><strong>'. _MAMHOO_USERS_SUPER_ADMIN .'</strong>';
	} else {
		// ensure user can't add group higher than themselves
		$my_groups = $acl->get_object_groups( 'users', $my->id, 'ARO' );
		if (is_array( $my_groups ) && count( $my_groups ) > 0) {
			$ex_groups = $acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
		} else {
			$ex_groups = array();
		}

		$gtree = $acl->get_group_children_tree( null, 'USERS', false );

		// remove users 'above' me
		$i = 0;
		while ($i < count( $gtree )) {
			if (in_array( $gtree[$i]->value, $ex_groups )) {
				array_splice( $gtree, $i, 1 );
			} else {
				$i++;
			}
		}

		$lists['gid'] = mosHTML::selectList( $gtree, 'gid', 'size="4"', 'value', 'text', $row->gid );
	}

// build the html select list
	$lists['block'] 		= mosHTML::yesnoRadioList( 'block', 'class="inputbox" size="1"', $row->block );

// build the html select list
	$lists['sendEmail'] 	= mosHTML::yesnoRadioList( 'sendEmail', 'class="inputbox" size="1"', $row->sendEmail );

	//HTML_users::edituser( $row, $lists, $option, $uid );
	HTML_mamhoo::edituser( $row, $mamhoo_configs, $contact, $lists, $option, $uid );
}

function saveUser( $option ) {
	global $database, $my;
	global $mosConfig_live_site, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_sitename;
	global $_MAMHOOKS;

	$row = new mosUser( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$isNew = !$row->id;
	$pwd = '';
	if ($isNew) {
		// new user stuff
		if ($row->password == '') {
			$pwd = mosMakePassword();
			$row->password = md5( $pwd );
		} else {
			$pwd = $row->password;
			$row->password = md5( $row->password );
		}
		$row->registerDate = date( 'Y-m-d H:i:s' );
	} else {
		// existing user stuff
		if ($row->password == '') {
			// password set to null if empty
			$row->password = null;
		} else {
			$row->password = md5( $row->password );
		}
	}
	mosMakeHtmlSafe($row);
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-2); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-2); </script>\n";
		exit();
	}

	//************************************************************//
	// onCreateUser 和 onModifyUser 事件处理
	if ($isNew) {
 		$results = $_MAMHOOKS->hook( 'onCreateUser', array( &$row ) );
	} 
	else {
		//如果禁用用户,则删除用户的Seesion记录
		if ( $row->block ) {
			$query = "DELETE FROM #__session WHERE userid = $row->id ";
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
		}
		//更新用户session记录的用户名
		$query = "UPDATE #__session SET username= '$row->username' WHERE userid = $row->id ";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		$results = $_MAMHOOKS->hook( 'onModifyUser', array( &$row ) );
	}

	//************************************************************//

	if ($isNew) {
		$query = "SELECT email FROM #__users WHERE id=$my->id";
		$database->setQuery( $query );
		$adminEmail = $database->loadResult();

		$userEmail = $row->email;
		$subject = _NEW_USER_MESSAGE_SUBJECT;
		$message = sprintf ( _NEW_USER_MESSAGE, $row->name, $mosConfig_sitename, $mosConfig_live_site, $row->username, $pwd );

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
		mosMail( $adminEmail, $adminName, $userEmail, $subject, $message );
	}

	$rowMamhoo = new mosmamhoo( $database );
	if (!$rowMamhoo->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (!$rowMamhoo->store($row->id, true)) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-2); </script>\n";
		exit();
	}
	mosRedirect( "index2.php?option=$option" );
}

/**
* Cancels an edit operation
* @param option component option to call
*/
function cancelUser( $option ) {
	mosRedirect( 'index2.php?option='. $option .'&task=view' );
}

function removeUsers( $cid, $option ) {
	global $database, $acl;
	global $_MAMHOOKS, $my;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert(\"". _MAMHOO_ITEM_SEL_DEL ."\"); window.history.go(-1);</script>\n";
		exit;
	}
	$msg = '';
	if (count( $cid )) {
		$obj = new mosUser( $database );
		$obj2 = new mosmamhoo( $database );
		foreach ($cid as $id) {
			// check for a super admin ... can't delete them
			$groups = $acl->get_object_groups( 'users', $id, 'ARO' );
			$this_group = strtolower( $acl->get_group_name( $groups[0], 'ARO' ) );
			if ($this_group == 'super administrator') {
				$msg .= _MAMHOO_USERS_CANNOT;
			} else {
				$obj->delete( $id );
				$msg .= $obj->getError();

				$obj2->delete( $id );
				$msg .= $obj2->getError();

		//删除用户session
		$query = "DELETE FROM #__session WHERE userid = $id";
		$database->setQuery( $query );
		if (!$database->query()) {
			die( $msg . $database->stderr() );
			return false;
		}

				// onDeleteUser 事件处理
				$admin_id = $my->id;
				$results = $_MAMHOOKS->hook( 'onDeleteUser', array( $id, $admin_id ) );
			}
		}
	}

	$limit = intval( mosGetParam( $_REQUEST, 'limit', 10 ) );
	$limitstart	= intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );
	mosRedirect( "index2.php?option=$option", $msg );
}

/**
* Blocks or Unblocks one or more user records
* @param array An array of unique category id numbers
* @param integer 0 if unblock, 1 if blocking
* @param string The current url option
*/
function changeUserBlock( $cid=null, $block=1, $option ) {
	global $database, $my;
	global $_MAMHOOKS;

	if (count( $cid ) < 1) {
		$action = $block ? 'block' : 'unblock';
		echo "<script> alert(\"". _MAMHOO_SEL_ITEM ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit;
	}

	//不能block 自己
	for ($i=0; $i<count($cid); $i++) {
		if ($my->id == $cid[$i]) {
			unset ($cid[$i]);
			break;
		}
	}

	if (count($cid) > 0) {
		$cids = implode( ',', $cid );

		$query = "UPDATE #__users SET block='$block' WHERE id IN ($cids)";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		//如果禁用用户,则删除用户的Seesion记录
		if ( $block ) {
			$query = "DELETE FROM #__session WHERE userid IN ($cids) ";
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
		}

		//************************************************************//
		// onBlockUser 事件处理
		$results = $_MAMHOOKS->hook( 'onBlockUser', array( $cid, $block ) );

		//************************************************************//
	}
	mosRedirect( "index2.php?option=$option" );
}

/**
* @param array An array of unique user id numbers
* @param string The current url option
*/
function logoutUser( $cid=null, $option, $redirect=true ) {
	global $database, $my, $_MAMHOOKS;

	if (count( $cid ) < 1) {
		mosRedirect( 'index2.php?option='. $option, _MAMHOO_SELECT_USER );
	}

	//不能logout 自己
	for ($i=0; $i<count($cid); $i++) {
		if ($my->id == $cid[$i]) {
		unset ($cid[$i]);
//			array_splice ($cid, $i, 1);
			break;
		}
	}

	if (count($cid) > 0) {
		$cids = implode( ',', $cid );

		$query = "DELETE FROM #__session WHERE userid IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		//************************************************************//
		// onLogout 事件处理
		$results = $_MAMHOOKS->hook( 'onForceLogout', array($cids) );

		//************************************************************//

	if ($redirect) {
			mosRedirect( 'index2.php?option='. $option, _MAMHOO_FLOGOUT_SUCC );
	}
	}
	else {
	if ($redirect) {
		mosRedirect( 'index2.php?option='. $option );
	}
	}
}

function is_email($email){
	$rBool=false;

	if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)){
		$rBool=true;
	}
	return $rBool;
}

function config( $option ) {
	global $database;
	$query = " select * from #__mamhoo_config ";
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	HTML_mamhoo::Config( $rows, $option );
}

function saveConfig( $option ) {
	global $database, $mainframe;
	global $customfields;

	$query = " delete from #__mamhoo_config ";
	$database->setQuery( $query );
	$database->query() or die( $database->stderr() );

	for ($i = 1; $i <= $customfields; $i++) {
		$id = "id$i";
		$fieldname = "fieldname$i";
		$fieldlabel = "fieldlabel$i";
		$fieldshow = "fieldshow$i";
		$fieldtype = "fieldtype$i";
		$fieldrequired = "fieldrequired$i";
		$fieldsize = "fieldsize$i";
		$fieldvalue = "fieldvalue$i";
		$id = $_POST[$id];
		$fieldname = $_POST[$fieldname];
		$fieldlabel = $_POST[$fieldlabel];
		$fieldshow = $_POST[$fieldshow];
		$fieldtype = $_POST[$fieldtype];
		$fieldrequired = $_POST[$fieldrequired];
		$fieldsize = $_POST[$fieldsize];
		$fieldvalue = $_POST[$fieldvalue];

		$query = " insert into #__mamhoo_config (id, fieldname, fieldlabel, fieldshow, fieldtype, fieldrequired, fieldsize, fieldvalue )
							 values ($id, '$fieldname', '$fieldlabel', '$fieldshow', '$fieldtype', '$fieldrequired', $fieldsize, '$fieldvalue') ";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );
	}

	mosRedirect("index2.php?option=com_mamhoo&task=config", _MAMHOO_CONFIG_SAVE);
}
?>
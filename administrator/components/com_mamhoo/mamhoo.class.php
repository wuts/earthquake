<?php
/**
* $Id: mamhoo.class.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

define( '_MAMHOO_', 1 );

$mamhoo_version="3.0";
$customfields = 20;

//get mambo charset
global $mosConfig_lang;
// loads english language file by default
if ( $mosConfig_lang == '' ) {
	$mosConfig_lang = 'english';
}

// get language files
if (file_exists($mosConfig_absolute_path.'/components/com_mamhoo/language/' . $mosConfig_lang . '.php')){
	include_once($mosConfig_absolute_path.'/components/com_mamhoo/language/' . $mosConfig_lang . '.php');
} else {
	include_once($mosConfig_absolute_path.'/components/com_mamhoo/language/english.php');
}

if (defined('_MAMHOO_ADDON_') || function_exists('mosCountAdminModules')) {
	include_once ( "$mosConfig_absolute_path/language/$mosConfig_lang.php" );
}
else {
	include_once ( 'language/'.$mosConfig_lang.'.php' );
}
$temps = explode('=', _ISO);
$MAMBO_CHARSET = strtoupper( trim( $temps[1] ) );
if ( $MAMBO_CHARSET == 'UTF8' ) $MAMBO_CHARSET = 'UTF-8';

//mamhoo utility class
class mamhooutils {
	
	//get copyright string
	function getCopyrightStr() {
		global $mamhoo_version;
		$Copyright = "powered by <a href='http://www.mamhoo.com/' target=_blank> mamhoo </a> 
					<a href='http://www.mamhoo.com/' target=_blank>$mamhoo_version</a>
					of <a href='http://www.mambochina.net/' target=_blank>mambochina.net</A>";
		return $Copyright;
	}

	//show copyright information
	function showCopyright() {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><div align="center"><?php echo mamhooutils::getCopyrightStr(); ?></div></td>
	</tr>
</table>
<?php
	}

	//show mamhoo logo image
	function showLogo() {
?>
<A href="http://www.mamhoo.com/" target=_blank><img src="components/com_mamhoo/images/mamhoologo.gif" border="0" width="88" height="125" alt="mamhoo"></A>
<?php
	}

	//get mamhook parameters
	function gethookparams($folder, $element) {
		global $database;
		$query = "SELECT params FROM #__mamhooks WHERE element = '$element' AND folder = '$folder'";
		$database->setQuery( $query );
		$paramsstr = $database->loadResult();
		$params =& new mosParameters( $paramsstr );
		return $params;
	}

	function getRegisterUrl()
	{
		global $mosConfig_absolute_path;
		$result = false;
		if (file_exists("$mosConfig_absolute_path/components/com_mamhoo/register.inc")){
			include_once("$mosConfig_absolute_path/components/com_mamhoo/register.inc");
			if (isset($regSystem) && isset($registerUrl) && trim($registerUrl)) {
				$result = $registerUrl;
			}
		}
		return $result;
	}
	
	function getlostPasswordUrl()
	{
		global $mosConfig_absolute_path;
		$result = false;
		if (file_exists("$mosConfig_absolute_path/components/com_mamhoo/register.inc")){
			include_once("$mosConfig_absolute_path/components/com_mamhoo/register.inc");
			if (isset($regSystem) && isset($lostPasswordUrl) && trim($lostPasswordUrl)) {
				$result = $lostPasswordUrl;
			}
		}
		return $result;
	}
}

//mos_mamhoo table class
class mosmamhoo extends mosDBTable {
	var $user_id=null;
	var $f01=null;
	var $f02=null;
	var $f03=null;
	var $f04=null;
	var $f05=null;
	var $f06=null;
	var $f07=null;
	var $f08=null;
	var $f09=null;
	var $f10=null;
	var $f11=null;
	var $f12=null;
	var $f13=null;
	var $f14=null;
	var $f15=null;
	var $f16=null;
	var $f17=null;
	var $f18=null;
	var $f19=null;
	var $f20=null;
	var $f21=null;
	var $f22=null;
	var $f23=null;
	var $f24=null;
	var $f25=null;
	var $f26=null;
	var $f27=null;
	var $f28=null;
	var $f29=null;
	var $f30=null;
	var $f31=null;
	var $f32=null;
	var $f33=null;
	var $f34=null;
	var $f35=null;
	var $f36=null;
	var $f37=null;
	var $f38=null;
	var $f39=null;
	var $f40=null;
	var $f41=null;
	var $f42=null;
	var $f43=null;
	var $f44=null;
	var $f45=null;
	var $f46=null;
	var $f47=null;
	var $f48=null;
	var $f49=null;
	var $f50=null;
	/**
	* @param database A database connector object
	*/
	function mosmamhoo( &$db ) {
		$this->mosDBTable( '#__mamhoo', 'user_id', $db );
	} //end func

	//save record
	function store( $id, $updateNulls=false) {
		global $database;

		if ( $id > 0 ) {
			$query = "Select count(*) from #__mamhoo where user_id = $id ";
			$database->SetQuery( $query );
			$total = $database->LoadResult();
			if( $total > 0 ) {
				// existing record
				$this->user_id = $id;
				$ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
			} else {
				// new user but not in mamhoo table
				$this->user_id = $id;
				$ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );
			}
		} else {
			// new record
			$query = "Select max(id) from #__users";
			$database->SetQuery($query);
			$this->user_id = $database->LoadResult();
			$ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );
		}

		if( !$ret ) {
			$this->_error = get_class( $this ) . "::" . _MAMHOO_STORE_FAILED. " <br />" . $this->_db->getErrorMsg();
			return false;
		}
		return true;
	} //end func
} //end class


//mos_mamhoo_config table class
class mosmamhoo_Config extends mosDBTable {
	var $id=null;
	var $fieldname=null;
	var $fieldlabel=null;
	var $fieldshow=null;
	var $fieldtype=null;
	var $fieldrequired=null;
	var $fieldsize=null;
	var $fieldvalue=null;

	/**
	* @param database A database connector object
	*/
	function mosmamhoo_Config( &$db ) {
		$this->mosDBTable( '#__mamhoo_config', 'id', $db );
	} //end func

} //end class


// mos_mamhook table class
class mosMamhook extends mosDBTable {
	/** @var int */
	var $id=null;
	/** @var varchar */
	var $name=null;
	/** @var varchar */
	var $element=null;
	/** @var varchar */
	var $folder=null;
	/** @var tinyint unsigned */
	var $access=null;
	/** @var int */
	var $ordering=null;
	/** @var tinyint */
	var $published=null;
	/** @var tinyint */
	var $iscore=null;
	/** @var tinyint */
	var $client_id=null;
	/** @var int unsigned */
	var $checked_out=null;
	/** @var datetime */
	var $checked_out_time=null;
	/** @var text */
	var $params=null;

	function mosMamhook( &$db ) {
		$this->mosDBTable( '#__mamhooks', 'id', $db );
	}
}

// mos_mamhook table class
class mosmamhoo_Salt {
	
	//calculate salt app hash password, result return 
	// the $passwd is md5 once password
	function salt_fx ( $passwd, $salt, $saltapp ) {
		switch ( $saltapp ) {
		    case 'MEDIAWIKI':
		        $hash_password = md5( "{$salt}-{$passwd}" );
		        break;
		    case 'IPB':
		        $hash_password = md5( md5( $salt ) . $passwd );
		        break;
		    case 'VBB':
		        $hash_password = md5( $passwd . $salt );
		        break;
		    default:
		        $hash_password = null;
		}
		return $hash_password;
	}
	
	//login by check in table mos_mamhoo_salt's password field
	function loginsalt ( $user_id, $passwd ) {
		global $database;
		
		$result = false;
		$query = "SELECT * FROM #__mamhoo_salt WHERE user_id=$user_id";
		$database->setQuery( $query );
		$row = null;
		if ($this->_db->loadObject( $row )) {
			$hash_password = mosmamhoo_Salt::salt_fx( $passwd, $row->salt, $row->saltapp );
			if ( $hash_password == $row->password ) {
				$query = "UPDATE #__users SET password='$passwd' WHERE id=$user_id";
				$database->setQuery( $query );
				if ( $database->query() ) {
					$result = true;
				}
			}
		}
		return $result;
	}
	
}


//mos_users table's utility class, called by the addon systems
class mamhooUser {
	/** @var int Unique id*/
	var $id=null;
	/** @var string The users real name (or nickname)*/
	var $name=null;
	/** @var string The login name*/
	var $username=null;
	/** @var string email*/
	var $email=null;
	/** @var string MD5 encrypted password*/
	var $password=null;
	/** @var string */
	var $usertype=null;
	/** @var int */
	var $block=null;
	/** @var int */
	var $sendEmail=null;
	/** @var int The group id number */
	var $gid=null;
	/** @var datetime */
	var $registerDate=null;
	/** @var datetime */
	var $lastvisitDate=null;
	/** @var string activation hash*/
	var $activation=null;
	/** @var string */
	var $params=null;

	//update user record
	function update (&$row) {
		global $database, $_MAMHOOKS;
		//update user record
		$query = "update #__users set id = id ";
		if ( $row->name ) {
			$query .= ", name = '$row->name', username = '$row->username' ";
		}
		if ( $row->email ) {
			$query .= ", email = '$row->email' ";
		}
		if ( $row->password ) {
			$query .= ", password = '$row->password' ";
		}
		if ( $row->block >= 0 ) {
			$query .= ", block = '$row->block' ";
			if ( $row->block == 0 ) {
				$query .= ", activation = '' ";
			}
		}
		$query .= " where id = $row->id ";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		//if block, then delete user's session record
		if ( $row->block > 0 ) {
			$query = "DELETE FROM #__session WHERE userid = $row->id ";
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
		}

		//onModifyUser event handler
		$results = $_MAMHOOKS->hook( 'onModifyUser', array( &$row ) );
		return $results;
	}

	//delete user record
	function delete ($id, $admin_id) {
		global $acl, $database, $_MAMHOOKS;

		$obj = new mosUser( $database );
		$obj2 = new mosmamhoo( $database );
		// check for a super admin ... can't delete them
		$groups = $acl->get_object_groups( 'users', $id, 'ARO' );
		$this_group = strtolower( $acl->get_group_name( $groups[0], 'ARO' ) );
		if ($this_group == 'super administrator') {
			return false;
		} else {
			$obj->delete( $id );
			$obj2->delete( $id );

			//delete user's session record
			$query = "DELETE FROM #__session WHERE userid = $id";
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );

			//************************************************************//
			// onDeleteUser event handler
			$result = $_MAMHOOKS->hook( 'onDeleteUser', array( $id, $admin_id ) );

			//************************************************************//
			return $result;
		}
	}

	//save new user
	function saveNew($row){
		global $database, $acl, $_MAMHOOKS;

		$section_value = 'users';

		mosMakeHtmlSafe($row);

		$query = "INSERT INTO #__users (id, name, username, email, password, usertype, block, sendEmail, gid, registerDate, lastvisitDate, activation, params)
		VALUES ('$row->id', '$row->name', '$row->username', '$row->email', '$row->password', '$row->usertype', '$row->block', '$row->sendEmail', '$row->gid', '$row->registerDate', '$row->lastvisitDate', '$row->activation', '$row->params' )";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		// syncronise ACL
		$acl->add_object( $section_value, $database->getEscaped( $row->name ), $row->id, null, null, 'ARO' );
		$acl->add_group_object( $row->gid, $section_value, $row->id, 'ARO' );

		// Begin mamhoo
		$query = "INSERT INTO #__mamhoo (user_id)	VALUES ('$row->id')";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		//************************************************************//
		// onCreateUser event handler
		$results = $_MAMHOOKS->hook( 'onCreateUser', array( &$row ) );

		//************************************************************//
		return $results;
	}//end func SaveNew

	//block or unblock user
	function setBlock( $cid=null, $block=1 ) {
		global $database;
		global $_MAMHOOKS;

		if (count($cid) > 0) {
			$cids = implode( ',', $cid );

			$query = "UPDATE #__users SET block='$block' WHERE id IN ($cids)";
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );

			//if block, then delete user's session record
			if ( $block ) {
				$query = "DELETE FROM #__session WHERE userid IN ($cids) ";
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			}

			//************************************************************//
			// onBlockUser event handler
			$results = $_MAMHOOKS->hook( 'onBlockUser', array( $cid, $block ) );

			//************************************************************//
			return $results;
		}
	}

	//update user record
	function changePassword ($user_id, $newPassword) {
		global $database, $_MAMHOOKS;
		//update user record
		$query = "update #__users set  password = '$newPassword' where id = $user_id ";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		//onChangePassword event handler
		$results = $_MAMHOOKS->hook( 'onChangePassword', array( $user_id, $newPassword ) );
		return $results;
	}	
}// end class mamhooUser


//mamhoo events handler, refers to mambot events handler
class mosMamhookHandler {
	/** @var array An array of functions in event groups */
	var $_events=null;
	/** @var array An array of lists */
	var $_lists=null;
	/** @var array An array of mamhooks */
	var $_hooks=null;
	/** @var int Index of the mamhook being loaded */
	var $_loading=null;

	/**
	* Constructor
	*/
	function mosMamhookHandler() {
		$this->_events = array();
	}
	/**
	* Loads all the hook files
	*/
	function loadHookGroup() {
		global $database, $my, $mosConfig_absolute_path, $_MAMHOOKS;

		$access = ($my) ? $my->gid : 0;
		$database->setQuery( "SELECT folder, element, published, CONCAT_WS('/',folder,element) AS lookup"
		. "\nFROM #__mamhooks"
		. "\nWHERE published >= 1 AND access <= $access "
		. "\nORDER BY ordering"
		);
		if (!($hooks = $database->loadObjectList())) {
			//echo "Error loading Mamhooks: " . $database->getErrorMsg();
			return false;
		}
		$n = count( $hooks);
		for ($i = 0; $i < $n; $i++) {
			$path = $mosConfig_absolute_path . '/components/com_mamhoo/mamhooks/' . $hooks[$i]->folder . '/' . $hooks[$i]->element . '.php';
			//die ($path);
			if (file_exists( $path )) {
				$this->_loading = count( $this->_hooks );
				$this->_hooks[] = $hooks[$i];
				require_once( $path );
				$this->_loading = null;
			}
		}
		return true;
	}
	/**
	* Registers a function to a particular event group
	* @param string The event name
	* @param string The function name
	*/
	function registerFunction( $event, $function ) {
		$this->_events[$event][] = array( $function, $this->_loading );
	}
	/**
	* Makes a option for a particular list in a group
	* @param string The group name
	* @param string The list name
	* @param string The value for the list option
	* @param string The text for the list option
	*/
	function addListOption( $group, $listName, $value, $text='' ) {
		$this->_lists[$group][$listName][] = mosHTML::makeOption( $value, $text );
	}
	/**
	* @param string The group name
	* @param string The list name
	* @return array
	*/
	function getList( $group, $listName ) {
		return $this->_lists[$group][$listName];
	}
	/**
	* Calls all functions associated with an event group
	* @param string The event name
	* @param array An array of arguments
	* @param boolean True is unpublished hooks are to be processed
	* @return array An array of results from each function call
	*/
	function hook( $event, $args=null, $doUnpublished=false ) {
		$result = array();

		if ($args === null) {
			$args = array();
		}
		if ($doUnpublished) {
			// prepend the published argument
			array_unshift( $args, null );
		}
		if (isset( $this->_events[$event] )) {
			foreach ($this->_events[$event] as $func) {
				if (function_exists( $func[0] )) {
					if ($doUnpublished) {
						$args[0] = $this->_hooks[$func[1]]->published;
						$result[] = call_user_func_array( $func[0], $args );
					} else if ($this->_hooks[$func[1]]->published) {
						$result[] = call_user_func_array( $func[0], $args );
					}
				}
			}
		}
		return $result;
	}
	/**
	* Same as trigger but only returns the first event and
	* allows for a variable argument list
	* @param string The event name
	* @return array The result of the first function call
	*/
	function call( $event ) {
		$doUnpublished=false;

		$args =& func_get_args();
		array_shift( $args );

		if (isset( $this->_events[$event] )) {
			foreach ($this->_events[$event] as $func) {
				if (function_exists( $func[0] )) {
					if ($this->_hooks[$func[1]]->published) {
						return call_user_func_array( $func[0], $args );
					}
				}
			}
		}
		return null;
	}
}

//************************************************************//
// mamhoo initialization

$_MAMHOOKS = new mosMamhookHandler();
$_MAMHOOKS->loadHookGroup();

//************************************************************//

?>
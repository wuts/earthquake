<?php
/**
* @version $Id: mambo.php,v 1.14 2005/11/14 21:56:04 eliasan Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_MOS_MAMBO_INCLUDED', 1 );


if (phpversion() < '4.2.0') {
	require_once( $mosConfig_absolute_path . '/includes/compat.php41x.php' );
}
if (phpversion() < '4.3.0') {
	require_once( $mosConfig_absolute_path . '/includes/compat.php42x.php' );
}
if (in_array( 'globals', array_keys( array_change_key_case( $_REQUEST, CASE_LOWER ) ) ) ) {
	die( 'Fatal error.  Global variable hack attempted.' );
}
if (in_array( '_post', array_keys( array_change_key_case( $_REQUEST, CASE_LOWER ) ) ) ) {
	die( 'Fatal error.  Post variable hack attempted.' );
}

@set_magic_quotes_runtime( 0 );

if (@$mosConfig_error_reporting === 0) {
	error_reporting( 0 );
} else if (@$mosConfig_error_reporting > 0) {
	error_reporting( $mosConfig_error_reporting );
}

require_once( $mosConfig_absolute_path . '/includes/database.php' );
require_once( $mosConfig_absolute_path . '/includes/gacl.class.php' );
require_once( $mosConfig_absolute_path . '/includes/gacl_api.class.php' );
require_once( $mosConfig_absolute_path . '/includes/phpmailer/class.phpmailer.php' );
require_once( $mosConfig_absolute_path . '/includes/mamboxml.php' );
require_once( $mosConfig_absolute_path . '/includes/phpInputFilter/class.inputfilter.php' );
include_once( $mosConfig_absolute_path . '/includes/sefbot.inc');

/**
 * Task routing class
 * @package Mambo
 * @abstract
 */
class mosAbstractTasker {
	/** @var array An array of the class methods to call for a task */
	var $taskMap = null;
	/** @var string The name of the default task */
	var $defaultTask = null;
	/** @var string The name of the current task*/
	var $task = null;
	/** @var array An array of the class methods*/
	var $_methods = null;
	/** @var string A url to redirect to */
	var $_redirect = null;
	/** @var string A message about the operation of the task */
	var $_message = null;

	/**
	 * Constructor
	 */
	function mosAbstractTasker() {
		$taskMap = array();
		$this->_methods = array();
		foreach (get_class_methods( get_class( $this ) ) as $method) {
			$this->_methods[] = strtolower( $method );
		}
		$this->_redirect = '';
		$this->_message = '';
	}
	/**
	 * Set a URL to redirect the browser to
	 * @param string A URL
	 */
	function setRedirect( $url, $msg = null ) {
		$this->_redirect = $url;
		if ($msg !== null) {
			$this->_message = $msg;
		}
	}
	/**
	 * Redirects the browser
	 */
	function redirect() {
		if ($this->_redirect) {
			mosRedirect( $this->_redirect, $this->_message );
		}
	}
	/**
	 * Register (map) a task to a method in the class
	 * @param string The task
	 * @param string The name of the method in the derived class to perform for this task
	 */
	function registerTask( $task, $method ) {
		if (in_array( strtolower( $method ), $this->_methods )) {
			$this->taskMap[$task] = $method;
		} else {
			$this->methodNotFound( $method );
		}
	}
	/**
	 * Register the default task to perfrom if a mapping is not found
	 * @param string The name of the method in the derived class to perform if the task is not found
	 */
	function registerDefaultTask( $method ) {
		$this->registerTask( '__default', $method );
	}
	/**
	 * Perform a task by triggering a method in the derived class
	 * @param string The task to perform
	 * @return mixed The value returned by the function
	 */
	function performTask( $task ) {
		$this->task = $task;

		if (isset( $this->taskMap[$task] )) {
			return call_user_func( array( &$this, $this->taskMap[$task] ) );
		} else if (isset( $this->taskMap['__default'] )) {
			return call_user_func( array( &$this, $this->taskMap['__default'] ) );
		} else {
			return $this->taskNotFound( $task );
		}
	}
	/**
	 * Get the last task that was to be performed
	 * @return string The task that was or is being performed
	 */
	function getTask() {
		return $this->task;
	}
	/**
	 * Basic method if the task is not found
	 * @param string The task
	 * @return null
	 */
	function taskNotFound( $task ) {
		echo 'Task ' . $task . ' not found';
		return null;
	}
	/**
	 * Basic method if the registered method is not found
	 * @param string The name of the method in the derived class
	 * @return null
	 */
	function methodNotFound( $name ) {
		echo 'Method ' . $name . ' not found';
		return null;
	}
}


/**
* Class to support function caching
* @package Mambo
*/
class mosCache {
	/**
	* @return object A function cache object
	*/
	function &getCache(  $group=''  ) {
		global $mosConfig_absolute_path, $mosConfig_caching, $mosConfig_cachepath, $mosConfig_cachetime;

		require_once( "$mosConfig_absolute_path/includes/Cache/Lite/Function.php" );

		$options = array(
		'cacheDir' => "$mosConfig_cachepath/",
		'caching' => $mosConfig_caching,
		'defaultGroup' => $group,
		'lifeTime' => $mosConfig_cachetime
		);
		$cache =& new Cache_Lite_Function( $options );
		return $cache;
	}
	/**
	* Cleans the cache
	*/
	function cleanCache( $group=false ) {
		global $mosConfig_caching;
		if ($mosConfig_caching) {
			$cache =& mosCache::getCache( $group );
			$cache->clean( $group );
		}
	}
}
/**
* Mambo Mainframe class
*
* Provide many supporting API functions
* @package Mambo
*/
class mosMainFrame {
	/** @var database Internal database class pointer */
	var $_db=null;
	/** @var object An object of configuration variables */
	var $_config=null;
	/** @var object An object of path variables */
	var $_path=null;
	/** @var mosSession The current session */
	var $_session=null;
	/** @var string The current template */
	var $_template=null;
	/** @var array An array to hold global user state within a session */
	var $_userstate=null;
	/** @var array An array of page meta information */
	var $_head=null;

	/**
	* Class constructor
	* @param database A database connection object
	* @param string The url option
	* @param string The path of the mos directory
	*/
	function mosMainFrame( &$db, $option, $basePath, $isAdmin=false ) {
		$this->_db =& $db;

		// load the configuration values
		//return( $this->loadConfig() );
		$this->_setConfig( $basePath );
		$this->_setTemplate( $isAdmin );
		$this->_setAdminPaths( $option, $this->getCfg( 'absolute_path' ) );
		if (isset( $_SESSION['session_userstate'] )) {
			$this->_userstate =& $_SESSION['session_userstate'];
		} else {
			$this->_userstate = null;
		}
		$this->_head = array();
		$this->_head['title'] = $GLOBALS['mosConfig_sitename'];
		$this->_head['meta'] = array();
		$this->_head['custom'] = array();
	}
	/**
	* @param string
	*/
	function setPageTitle( $title=null ) {
		if (@$GLOBALS['mosConfig_pagetitles']) {
			$title = trim( htmlspecialchars( $title ) );
			$this->_head['itemtitle'] = $title;
			$this->_head['title'] = $title ? $title . ' - ' . $GLOBALS['mosConfig_sitename'] : $GLOBALS['mosConfig_sitename'];
		}
	}
	/**
	* @param string The value of the name attibute
	* @param string The value of the content attibute
	* @param string Text to display before the tag
	* @param string Text to display after the tag
	*/
	function addMetaTag( $name, $content, $prepend='', $append='' ) {
	    $name = trim( htmlspecialchars( $name ) );
	    $content = trim( htmlspecialchars( $content ) );
	    $prepend = trim( $prepend );
	    $append = trim( $append );
		$this->_head['meta'][] = array( $name, $content, $prepend, $append );
	}
	/**
	* @param string The value of the name attibute
	* @param string The value of the content attibute to append to the existing
	* Tags ordered in with Site Keywords and Description first
	*/
	function appendMetaTag( $name, $content ) {
		$name = trim( htmlspecialchars( $name ) );
		$n = count( $this->_head['meta'] );
		for ($i = 0; $i < $n; $i++) {
			if ($this->_head['meta'][$i][0] == $name) {
				$content = trim( htmlspecialchars( $content ) );
				if ( $content ) {
					if ( !$this->_head['meta'][$i][1] ) {
						$this->_head['meta'][$i][1] = $content ;
					} else {
						$this->_head['meta'][$i][1] = $this->_head['meta'][$i][1] . ', ' . $content;
					}
				}
				return;
			}
		}
		$this->addMetaTag( $name , $content );
    }

	/**
	* @param string The value of the name attibute
	* @param string The value of the content attibute to append to the existing
	*/
	function prependMetaTag( $name, $content ) {
	    $name = trim( htmlspecialchars( $name ) );
	    $n = count( $this->_head['meta'] );
	    for ($i = 0; $i < $n; $i++) {
	        if ($this->_head['meta'][$i][0] == $name) {
			    $content = trim( htmlspecialchars( $content ) );
			    if ( $content ) {
					if ( !$this->_head['meta'][$i][1] ) {
						$this->_head['meta'][$i][1] = $content ;
					} else {
						$this->_head['meta'][$i][1] = $content .', '. $this->_head['meta'][$i][1];
					}
				}
//				$this->_head['meta'][$i][1] = $content . $this->_head['meta'][$i][1];
				return;
			}
		}
		$this->addMetaTag( $name, $content );
	}
	/**
	 * Adds a custom html string to the head block
	 * @param string The html to add to the head
	 */
	function addCustomHeadTag( $html ) {
		$this->_head['custom'][] = trim( $html );
	}
	/**
	* @return string
	*/
	function getHead() {
	    $head = array();
	    $head[] = '<title>' . $this->_head['title'] . '</title>';
	    foreach ($this->_head['meta'] as $meta) {
	        if ($meta[2]) {
	            $head[] = $meta[2];
			}
	        $head[] = '<meta name="' . $meta[0] . '" content="' . $meta[1] . '" />';
	        if ($meta[3]) {
	            $head[] = $meta[3];
			}
		}
	    foreach ($this->_head['custom'] as $html) {
	        $head[] = $html;
		}
		return implode( "\n", $head ) . "\n";
	}
	/**
	* @return string
	*/
	function getPageTitle() {
	    return $this->_head['title'];
	}

	/**
	* @return string
	*/
	function getItemTitle() {
	    return $this->_head['itemtitle'];
	}
	
  /**
	* Gets the value of a user state variable
	* @param string The name of the variable
	*/
	function getUserState( $var_name ) {
		if (is_array( $this->_userstate )) {
			return mosGetParam( $this->_userstate, $var_name, null );
		} else {
			return null;
		}
	}
	/**
	* Gets the value of a user state variable
	* @param string The name of the user state variable
	* @param string The name of the variable passed in a request
	* @param string The default value for the variable if not found
	*/
	function getUserStateFromRequest( $var_name, $req_name, $var_default=null ) {
		if (is_array( $this->_userstate )) {
			if (isset( $_REQUEST[$req_name] )) {
				$this->setUserState( $var_name, $_REQUEST[$req_name] );
			} else if (!isset( $this->_userstate[$var_name] )) {
				$this->setUserState( $var_name, $var_default );
			}
			return $this->_userstate[$var_name];
		} else {
			return null;
		}
	}
	/**
	* Sets the value of a user state variable
	* @param string The name of the variable
	* @param string The value of the variable
	*/
	function setUserState( $var_name, $var_value ) {
		if (is_array( $this->_userstate )) {
			$this->_userstate[$var_name] = $var_value;
		}
	}
	/**
	* Initialises the user session
	*
	* Old sessions are flushed based on the configuration value for the cookie
	* lifetime. If an existing session, then the last access time is updated.
	* If a new session, a session id is generated and a record is created in
	* the mos_sessions table.
	*/
	function initSession() {
		global $mosConfig_live_site, $_MAMHOOKS;
		
		$session =& $this->_session;
		$session = new mosSession( $this->_db );
		
		// check and skip spider or bot
		global $spiders;
		$spiderfound = false;
		foreach ($spiders as $spider) {
		//while ( $i < count($spiders) ) { 
			if ( eregi($spider, $_SERVER['HTTP_USER_AGENT']) ) {
				$spiderfound = true;
				break;
			}
		} 
		
		if ( $spiderfound ) { 
			return true; 
		} 
		
		$sessionCookieName = md5( 'site'.$mosConfig_live_site );
		
		$sessioncookie = mosGetParam( $_COOKIE, $sessionCookieName, null );
		$usercookie = mosGetParam( $_COOKIE, 'usercookie', null );
		
		$session->_sessionmethod = 0;

		//********************************************************************************
		// set sessionmethod, decide where $sessioncookie gets from 
/*		if ( isset($sessioncookie) || eregi("Mozilla", $_SERVER['HTTP_USER_AGENT']) )
		//if ( isset($sessioncookie))
		{
			$session->_sessionmethod = 0; //SESSION_METHOD_COOKIE,  session gets from cookie
		}
		else
		{
			$session->_sessionmethod = 1; //SESSION_METHOD_GET,  session gets from url's param sid 
			$sessioncookie = mosGetParam( $_REQUEST, 'sid', null );
		}*/
		//********************************************************************************

		if ($sessioncookie && $session->load( md5( $sessioncookie . $_SERVER['REMOTE_ADDR'] ) )) {
//		if ($sessioncookie && $session->load( $sessioncookie )) {
			// Session cookie exists, update time in session table
			// Only update session DB a minute or so after last update
			$session->_session_cookie = $sessioncookie;
			$current_time = time();
			if ($current_time - $session->time > 60 )
			{
				$session->time = $current_time;
				$session->update();
				
				if ( defined('_MAMHOO_') ) {
					if ($session->guest == 0) {
						//************************************************************//
						// onUpdateSession event handler, only for register user
						$results = $_MAMHOOKS->hook( 'onUpdateSession', array($session->userid) );
	
						//************************************************************//
					}
				}

				//purge expired session
				$inc = intval( $this->getCfg( 'lifetime' ) );
				$session->purge($inc);
				if ( defined('_MAMHOO_') ) {
					//************************************************************//
					// onPurgeSession event handler
					$results = $_MAMHOOKS->hook( 'onPurgeSession', array($inc) );

					//************************************************************//
				}
			}

		} else {
			$session->generateId();
			$session->guest = 1;
			$session->username = '';
			$session->time = time();
			$session->gid = 0;

			if (!$session->insert()) {
				die( $session->getError() );
			}
			
			//session ends with browser close
			mamhooCookie($sessionCookieName, $session->getCookie(), 0);

			if ($usercookie) {
				// Remember me cookie exists. Login with usercookie info.
				$remember="yes";
				$this->login($usercookie['username'], $usercookie['password'], $remember);
			}
		}
	}

	/**
	* Login validation function
	*
	* Username and encoded password is compare to db entries in the mos_users
	* table. A successful validation updates the current session record with
	* the users details.
	*/
	function login( $username=null,$passwd=null, $remember=null ) {
		global $acl, $database;
		global $mosConfig_live_site, $_MAMHOOKS;

		$session =& $this->_session;

		$bypost = 0;
		if (!$username || !$passwd) {
			$username = trim( mosGetParam( $_POST, 'username', '' ) );
			$passwd = trim( mosGetParam( $_POST, 'passwd', '' ) );
			if (!$username || !$passwd) {
				echo "<script> alert(\""._LOGIN_INCOMPLETE."\"); window.history.go(-1); </script>\n";
				exit();
			}
			$passwd = md5( $passwd );
			$bypost = 1;
		}
		if ( !isset($remember) || empty($remember) ) $remember = trim( mosGetParam( $_POST, 'remember', '' ) );

		if (!$username || !$passwd) {
			echo "<script> alert(\""._LOGIN_INCOMPLETE."\"); window.history.go(-1); </script>\n";
			exit();
		} else {
			$username = $this->_db->getEscaped($username);
			$passwd = $this->_db->getEscaped($passwd);
			$this->_db->setQuery( "SELECT id, password, gid, block, usertype"
			. "\nFROM #__users"
			. "\nWHERE username='$username' "
			);
			$row = null;
			if ($this->_db->loadObject( $row )) {
				if ( ( $row->password == $passwd ) || ( defined('_MAMHOO_') && empty( $row->password ) && mosmamhoo_Salt::loginsalt($row->id, $passwd ) ) ) {
					if ( $row->block == 1 ) {
						echo "<script>alert(\""._LOGIN_BLOCKED."\"); window.history.go(-1); </script>\n";
						exit();
					}
					// fudge the group stuff
					$grp = $acl->getAroGroup( $row->id );
					$row->gid = 1;
	
					if ($acl->is_group_child_of( $grp->name, 'Registered', 'ARO' ) ||
					$acl->is_group_child_of( $grp->name, 'Public Backend', 'ARO' )) {
						// fudge Authors, Editors, Publishers and Super Administrators into the Special Group
						$row->gid = 2;
					}
					$row->usertype = $grp->name;
	
					$session->guest = 0;
					$session->username = $username;
					$session->userid = intval( $row->id );
					$session->usertype = $row->usertype;
					$session->gid = intval( $row->gid );
	
					$session->update();
	
					$currentDate = date("Y-m-d\TH:i:s");
					$query = "UPDATE #__users SET lastvisitDate='$currentDate' where id='$session->userid'";
					$this->_db->setQuery($query);
					if (!$this->_db->query()) {
						die($this->_db->stderr(true));
					}
	
					if ($remember=="yes") {
						mamhooCookie("usercookie[username]", $username,1);
						mamhooCookie("usercookie[password]", $passwd,1);
					}
					
					if ( defined('_MAMHOO_') ) {
						//************************************************************//
						// onLogin event handler
						$results = $_MAMHOOKS->hook( 'onLogin', array($session->userid, $remember) );
	
						//************************************************************//
					}
					return true;
	
				} else { // mos_users's password is not match, login failed
					if ($bypost) {
						echo "<script>alert(\""._LOGIN_INCORRECT."\"); window.history.go(-1); </script>\n";
						exit();
					} else {
						$this->logout();
						mosRedirect("index.php");
					}
					return false;
				}
			} else { //login failed
				if ($bypost) {
					echo "<script>alert(\""._LOGIN_INCORRECT."\"); window.history.go(-1); </script>\n";
					exit();
				} else {
					$this->logout();
					mosRedirect("index.php");
				}
			}
		}
	}
	/**
	* User logout
	*
	* Reverts the current session record back to 'anonymous' parameters
	*/
	function logout() {
		global $mosConfig_live_site, $_MAMHOOKS;
		$session =& $this->_session;
		$userid = $session->userid;

		$session->guest = 1;
		$session->username = '';
		$session->userid = '';
		$session->usertype = '';
		$session->gid = 0;

		$session->update();

		mamhooCookie("usercookie[username]", "",-1);
		mamhooCookie("usercookie[password]", "",-1);
		mamhooCookie("usercookie", "",-1);
		
		@session_destroy();
		if ( defined('_MAMHOO_') ) {
			//************************************************************//
			// onLogout event handler
			if ($userid) {
				$results = $_MAMHOOKS->hook( 'onLogout', array($userid) );
			}
	
			//************************************************************//
		}
	}
	/**
	* @return mosUser A user object with the information from the current session
	*/
	function getUser() {
		$user = new mosUser( $this->_db );

		$user->id = intval( $this->_session->userid );
		$user->username = $this->_session->username;
		$user->usertype = $this->_session->usertype;
		$user->gid = intval( $this->_session->gid );

		return $user;
	}
	/**
	* Loads the configuration.php file and assigns values to the internal variable
	* @param string The base path from which to load the configuration file
	*/
	function _setConfig( $basePath='.' ) {
		$this->_config = new stdClass();

		require( $basePath . '/configuration.php' );

		$this->_config->offline 				= $mosConfig_offline;
		$this->_config->host 				= $mosConfig_host;
		$this->_config->user 				= $mosConfig_user;
		$this->_config->password 			= $mosConfig_password;
		$this->_config->db 					= $mosConfig_db;
		$this->_config->dbprefix 			= $mosConfig_dbprefix;
		$this->_config->lang 				= $mosConfig_lang;
		$this->_config->absolute_path 		= $mosConfig_absolute_path;
		$this->_config->live_site 			= $mosConfig_live_site;
		$this->_config->sitename 			= $mosConfig_sitename;
		$this->_config->shownoauth 			= $mosConfig_shownoauth;
		$this->_config->useractivation 		= $mosConfig_useractivation;
		$this->_config->uniquemail 			= $mosConfig_uniquemail;
		$this->_config->offline_message 		= $mosConfig_offline_message;
		$this->_config->error_message 		= $mosConfig_error_message;
		$this->_config->lifetime 			= $mosConfig_lifetime;
		$this->_config->MetaDesc 			= $mosConfig_MetaDesc;
		$this->_config->MetaKeys 			= $mosConfig_MetaKeys;
		$this->_config->debug 				= $mosConfig_debug;
		$this->_config->vote 				= $mosConfig_vote;
		$this->_config->hideAuthor 			= $mosConfig_hideAuthor;
		$this->_config->hideCreateDate 		= $mosConfig_hideCreateDate;
		$this->_config->hideModifyDate 		= $mosConfig_hideModifyDate;
		$this->_config->hidePdf 				= $mosConfig_hidePdf;
		$this->_config->hidePrint 			= $mosConfig_hidePrint;
		$this->_config->hideEmail 			= $mosConfig_hideEmail;
		$this->_config->enable_log_items 		= $mosConfig_enable_log_items;
		$this->_config->enable_log_searches 	= $mosConfig_enable_log_searches;
		$this->_config->enable_stats 			= $mosConfig_enable_stats;
		$this->_config->sef 				= $mosConfig_sef;
		$this->_config->vote 				= $mosConfig_vote;
		$this->_config->hideModifyDate 		= $mosConfig_hideModifyDate;
		$this->_config->multipage_toc 		= $mosConfig_multipage_toc;
		$this->_config->allowUserRegistration 	= $mosConfig_allowUserRegistration;
		$this->_config->error_reporting 		= $mosConfig_error_reporting;
		$this->_config->mosConfig_register_globals 		= $mosConfig_register_globals;
		$this->_config->link_titles 			= $mosConfig_link_titles;
		$this->_config->list_limit 			= $mosConfig_list_limit;
		$this->_config->caching 				= $mosConfig_caching;
		$this->_config->cachepath 			= $mosConfig_cachepath;
		$this->_config->cachetime 			= $mosConfig_cachetime;
		$this->_config->mailer 				= $mosConfig_mailer;
		$this->_config->mailfrom 			= $mosConfig_mailfrom;
		$this->_config->fromname 			= $mosConfig_fromname;
		$this->_config->smtpauth 			= $mosConfig_smtpauth;
		$this->_config->smtpuser 			= $mosConfig_smtpuser;
		$this->_config->smtppass 			= $mosConfig_smtppass;
		$this->_config->smtphost 			= $mosConfig_smtphost;
		$this->_config->back_button 			= $mosConfig_back_button;
		$this->_config->item_navigation 		= $mosConfig_item_navigation;
		$this->_config->secret 				= $mosConfig_secret;
		$this->_config->pagetitles 			= $mosConfig_pagetitles;
		$this->_config->readmore 			= $mosConfig_readmore;
		$this->_config->hits 				= $mosConfig_hits;
		$this->_config->icons 				= $mosConfig_icons;

		if (@$mosConfig_error_reporting === 0) {
			error_reporting( 0 );
		} else if (@$mosConfig_error_reporting > 0) {
			error_reporting( $mosConfig_error_reporting );
		}
	}
	/**
	* @param string The name of the variable (from configuration.php)
	* @return mixed The value of the configuration variable or null if not found
	*/
	function getCfg( $varname ) {
		if (isset( $this->_config->$varname )) {
			return $this->_config->$varname;
		} else {
			return null;
		}
	}

	// TODO
	function loadConfig() {
		unset( $this->_config );

		$this->_db->setQuery( "SELECT name,value FROM #__config2" );
		if (!$this->_config = $this->_db->loadObjectList( 'name' )) {
			echo $this->_db->stderr();
			return false;
		}
		return true;
	}

	function _setTemplate( $isAdmin=false ) {
		global $Itemid;
		$mosConfig_absolute_path = $this->getCfg( 'absolute_path' );

		// Default template
		$this->_db->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'" );
		$cur_template = $this->_db->loadResult();

		// Assigned template
		if (isset($Itemid) && $Itemid!="" && $Itemid!=0) {
			$this->_db->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='$Itemid' LIMIT 1" );
			$cur_template = $this->_db->loadResult() ? $this->_db->loadResult() : $cur_template;
		}

		if ($isAdmin) {
			$this->_db->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='1' AND menuid='0'" );
			$cur_template = $this->_db->loadResult();
			$path = "$mosConfig_absolute_path/administrator/templates/$cur_template/index.php";
			if (!file_exists( $path )) {
				$cur_template = 'mambo_admin';
			}
		} else {
			// TemplateChooser Start
			$mos_user_template = mosGetParam( $_COOKIE, 'mos_user_template', '' );
			$mos_change_template = mosGetParam( $_REQUEST, 'mos_change_template', $mos_user_template );
			if ($mos_change_template AND strpos($mos_change_template,'..') == false AND strpos($mos_change_template,':') == false) {
				// check that template exists in case it was deleted
				if (file_exists( "$mosConfig_absolute_path/templates/$mos_change_template/index.php" )) {
					$lifetime = 60*10;
					$cur_template = $mos_change_template;
					mamhooCookie( "mos_user_template", "$mos_change_template", $lifetime);
				} else {
					mamhooCookie( "mos_user_template", "", -1 );
				}
			}
			// TemplateChooser End
		}

		$this->_template = $cur_template;
	}

	function getTemplate() {
		return $this->_template;
	}

	/**
	* Determines the paths for including engine and menu files
	* @param string The current option used in the url
	* @param string The base path from which to load the configuration file
	*/
	function _setAdminPaths( $option, $basePath='.' ) {
		$option = strtolower( $option );
		$this->_path = new stdClass();

		$prefix = substr( $option, 0, 4 );
		if ($prefix != 'com_') {
			// ensure backward compatibility with existing links
			$name = $option;
			$option = "com_$option";
		} else {
			$name = substr( $option, 4 );
		}
		// components
		if (file_exists( "$basePath/templates/$this->_template/components/$name.html.php" )) {
			$this->_path->front = "$basePath/components/$option/$name.php";
			$this->_path->front_html = "$basePath/templates/$this->_template/components/$name.html.php";
		} else if (file_exists( "$basePath/components/$option/$name.php" )) {
			$this->_path->front = "$basePath/components/$option/$name.php";
			$this->_path->front_html = "$basePath/components/$option/$name.html.php";
		}
		if (file_exists( "$basePath/administrator/components/$option/admin.$name.php" )) {
			$this->_path->admin = "$basePath/administrator/components/$option/admin.$name.php";
			$this->_path->admin_html = "$basePath/administrator/components/$option/admin.$name.html.php";
		}
		if (file_exists( "$basePath/administrator/components/$option/toolbar.$name.php" )) {
			$this->_path->toolbar = "$basePath/administrator/components/$option/toolbar.$name.php";
			$this->_path->toolbar_html = "$basePath/administrator/components/$option/toolbar.$name.html.php";
			$this->_path->toolbar_default = "$basePath/administrator/includes/toolbar.html.php";
		}
		if (file_exists( "$basePath/components/$option/$name.class.php" )) {
			$this->_path->class = "$basePath/components/$option/$name.class.php";
		} else if (file_exists( "$basePath/administrator/components/$option/$name.class.php" )) {
			$this->_path->class = "$basePath/administrator/components/$option/$name.class.php";
		} else if (file_exists( "$basePath/includes/$name.php" )) {
			$this->_path->class = "$basePath/includes/$name.php";
		}
		if (file_exists("$basePath/administrator/components/$option/admin.$name.php" )) {
			$this->_path->admin = "$basePath/administrator/components/$option/admin.$name.php";
			$this->_path->admin_html = "$basePath/administrator/components/$option/admin.$name.html.php";
		} else {
			$this->_path->admin = "$basePath/administrator/components/com_admin/admin.admin.php";
			$this->_path->admin_html = "$basePath/administrator/components/com_admin/admin.admin.html.php";
		}
	}
	/**
	* Returns a stored path variable
	*
	*/
	function getPath( $varname, $option='' ) {
		global $mosConfig_absolute_path;
		if ($option) {
			$temp = $this->_path;
			$this->_setAdminPaths( $option, $this->getCfg( 'absolute_path' ) );
		}
		$result = null;
		if (isset( $this->_path->$varname )) {
			$result = $this->_path->$varname;
		} else {
			switch ($varname) {
				case 'com_xml':
				$name = substr( $option, 4 );
				$path = "$mosConfig_absolute_path/administrator/components/$option/$name.xml";
				if (file_exists( $path )) {
					$result = $path;
				} else {
					$path = "$mosConfig_absolute_path/components/$option/$name.xml";
					if (file_exists( $path )) {
						$result = $path;
					}
				}
				break;
				case 'mod0_xml':
				// Site modules
				if ($option == '') {
					$path = $mosConfig_absolute_path . "/modules/custom.xml";
				} else {
					$path = $mosConfig_absolute_path . "/modules/$option.xml";
				}
				if (file_exists( $path )) {
					$result = $path;
				}
				break;
				case 'mod1_xml':
				// admin modules
				if ($option == '') {
					$path = $mosConfig_absolute_path . '/administrator/modules/custom.xml';
				} else {
					$path = $mosConfig_absolute_path . "/administrator/modules/$option.xml";
				}
				if (file_exists( $path )) {
					$result = $path;
				}
				break;
				case 'bot_xml':
				// Site mambots
				$path = $mosConfig_absolute_path . "/mambots/$option.xml";
				if (file_exists( $path )) {
					$result = $path;
				}
				break;
				case 'menu_xml':
				$path = $mosConfig_absolute_path . "/administrator/components/com_menus/$option/$option.xml";
				if (file_exists( $path )) {
					$result = $path;
				}
				break;
				case 'installer_html':
				$path = $mosConfig_absolute_path . "/administrator/components/com_installer/$option/$option.html.php";
				if (file_exists( $path )) {
					$result = $path;
				}
				break;
				case 'installer_class':
				$path = $mosConfig_absolute_path . "/administrator/components/com_installer/$option/$option.class.php";
				if (file_exists( $path )) {
					$result = $path;
				}
				break;
			}
		}
		if ($option) {
			$this->_path = $temp;
		}
		return $result;
	}
	/**
	* Detects a 'visit'
	*
	* This function updates the agent and domain table hits for a particular
	* visitor.  The user agent is recorded/incremented if this is the first visit.
	* A cookie is set to mark the first visit.
	*/
	function detect() {
		global $mosConfig_enable_stats;
		if ($mosConfig_enable_stats == 1) {
			if (mosGetParam( $_COOKIE, 'mosvisitor', 0 )) {
				return;
			}
			mamhooCookie("mosvisitor", "1", 0);

			if (phpversion() <= "4.2.1") {
				$agent = getenv( "HTTP_USER_AGENT" );
				$domain = gethostbyaddr( getenv( "REMOTE_ADDR" ) );
			} else {
				$agent = $_SERVER['HTTP_USER_AGENT'];
				$domain = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
			}

			$browser = mosGetBrowser( $agent );

			$this->_db->setQuery( "SELECT count(*) FROM #__stats_agents WHERE agent='$browser' AND type='0'" );
			if ($this->_db->loadResult()) {
				$this->_db->setQuery( "UPDATE #__stats_agents SET hits=(hits+1) WHERE agent='$browser' AND type='0'" );
			} else {
				$this->_db->setQuery( "INSERT INTO #__stats_agents (agent,type) VALUES ('$browser','0')" );
			}
			$this->_db->query();

			$os = mosGetOS( $agent );

			$this->_db->setQuery( "SELECT count(*) FROM #__stats_agents WHERE agent='$os' AND type='1'" );
			if ($this->_db->loadResult()) {
				$this->_db->setQuery( "UPDATE #__stats_agents SET hits=(hits+1) WHERE agent='$os' AND type='1'" );
			} else {
				$this->_db->setQuery( "INSERT INTO #__stats_agents (agent,type) VALUES ('$os','1')" );
			}
			$this->_db->query();

			// tease out the last element of the domain
			$tldomain = split( "\.", $domain );
			$tldomain = $tldomain[count( $tldomain )-1];

			if (is_numeric( $tldomain )) {
				$tldomain = "Unknown";
			}

			$this->_db->setQuery( "SELECT count(*) FROM #__stats_agents WHERE agent='$tldomain' AND type='2'" );
			if ($this->_db->loadResult()) {
				$this->_db->setQuery( "UPDATE #__stats_agents SET hits=(hits+1) WHERE agent='$tldomain' AND type='2'" );
			} else {
				$this->_db->setQuery( "INSERT INTO #__stats_agents (agent,type) VALUES ('$tldomain','2')" );
			}
			$this->_db->query();
		}
	}

	/**
	* @return correct Itemid for Content Item
	*/
	function getItemid( $id, $typed=1, $link=1, $bs=1, $bc=1, $gbs=0 ) {
		global $Itemid;

		$_Itemid = '';
		if ($_Itemid == '' && $typed) {
			// Search for typed link
			$this->_db->setQuery( "SELECT id "
			."\nFROM #__menu "
			."\nWHERE type='content_typed' AND published='1' AND link='index.php?option=com_content&task=view&id=$id'" );
			$_Itemid = $this->_db->loadResult();
		}

		if ($_Itemid == '' && $link) {
			// Search for item link
			$this->_db->setQuery( "SELECT id "
			."\nFROM #__menu "
			."\nWHERE type='content_item_link' AND published='1' AND link='index.php?option=com_content&task=view&id=$id'" );
			$_Itemid = $this->_db->loadResult();
		}

		if ($_Itemid == '' && $bc) {
			// Search in specific blog category
			$this->_db->setQuery( "SELECT m.id "
			."\nFROM #__content AS i"
			."\nINNER JOIN #__categories AS c ON i.catid=c.id"
			."\nINNER JOIN #__menu AS m ON m.componentid=c.id "
			."\nWHERE m.type='content_blog_category' AND m.published='1' AND i.id=".$id );
			$_Itemid = $this->_db->loadResult();
		}

		if ($_Itemid == '' && $bs) {
			// Search in specific blog section
			$this->_db->setQuery( "SELECT m.id "
			."\nFROM #__content AS i"
			."\nINNER JOIN #__sections AS s ON i.sectionid=s.id"
			."\nINNER JOIN #__menu AS m ON m.componentid=s.id "
			."\nWHERE m.type='content_blog_section' AND m.published='1' AND i.id=".$id );
			$_Itemid = $this->_db->loadResult();
		}
		
		if ($_Itemid == '') {
			// Search in categories
			$this->_db->setQuery( "SELECT m.id "
			."\nFROM #__content AS i"
			."\nINNER JOIN #__categories AS c ON i.catid=c.id"
			."\nINNER JOIN #__menu AS m ON m.componentid=c.id "
			."\nWHERE m.type='content_category' AND m.published='1' AND i.id=".$id );
			$_Itemid = $this->_db->loadResult();
		}
		
		if ($_Itemid == '') {
			// Search in sections
			$this->_db->setQuery( "SELECT m.id "
			."\nFROM #__content AS i"
			."\nINNER JOIN #__sections AS s ON i.sectionid=s.id"
			."\nINNER JOIN #__menu AS m ON m.componentid=s.id "
			."\nWHERE m.type='content_section' AND m.published='1' AND i.id=".$id );
			$_Itemid = $this->_db->loadResult();
		}

/*
		if ($_Itemid == '' && $gbs) {
			// Search in global blog section
			$this->_db->setQuery( "SELECT id "
			."\nFROM #__menu "
			."\nWHERE type='content_blog_section' AND published='1' AND componentid=0" );
			$_Itemid = $this->_db->loadResult();
		}
*/
		if ($_Itemid) {
			return $_Itemid;
		} else {
			return $Itemid;
		}
	}

	/**
	* @return number of Published Blog Sections
	*/
	function getBlogSectionCount( ) {
		$query = "SELECT COUNT( m.id ) "
		."\n FROM #__sections AS s "
		."\n INNER JOIN #__menu AS m ON m.componentid=s.id "
		."\n WHERE m.type='content_blog_section'"
		."\n AND m.published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Published Blog Categories
	*/
	function getBlogCategoryCount( ) {
		$query = "SELECT COUNT( m.id ) "
		. "\n FROM #__categories AS c "
		. "\n INNER JOIN #__menu AS m ON m.componentid=c.id "
		. "\n WHERE m.type='content_blog_category'"
		. "\n  AND m.published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Published Global Blog Sections
	*/
	function getGlobalBlogSectionCount( ) {
		$query = "SELECT COUNT( id )"
		."\n FROM #__menu "
		."\n WHERE type='content_blog_section'"
		."\n AND published='1'"
		."\n AND componentid=0";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Static Content
	*/
	function getStaticContentCount( ) {
		$query = "SELECT COUNT( id )"
		."\n FROM #__menu "
		."\n WHERE type='content_typed'"
		."\n AND published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Content Item Links
	*/
	function getContentItemLinkCount( ) {
		$query = "SELECT COUNT( id )"
		."\n FROM #__menu "
		."\n WHERE type='content_item_link'"
		."\n AND published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}
}

/**
* Component database table class
* @package Mambo
*/
class mosComponent extends mosDBTable {
	/** @var int Primary key */
	var $id=null;
	/** @var string */
	var $name=null;
	/** @var string */
	var $link=null;
	/** @var int */
	var $menuid=null;
	/** @var int */
	var $parent=null;
	/** @var string */
	var $admin_menu_link=null;
	/** @var string */
	var $admin_menu_alt=null;
	/** @var string */
	var $option=null;
	/** @var string */
	var $ordering=null;
	/** @var string */
	var $admin_menu_img=null;
	/** @var int */
	var $iscore=null;
	/** @var string */
	var $params=null;

	/**
	* @param database A database connector object
	*/
	function mosComponent( &$db ) {
		$this->mosDBTable( '#__components', 'id', $db );
	}
}

/**
* Utility class for all HTML drawing classes
* @package Mambo
*/
class mosHTML {
	function makeOption( $value, $text='' ) {
		$obj = new stdClass;
		$obj->value = $value;
		$obj->text = trim( $text ) ? $text : $value;
		return $obj;
	}

  function writableCell( $folder ) {

  	echo '<tr>';
  	echo '<td class="item">' . $folder . '/</td>';
  	echo '<td align="left">';
  	echo is_writable( "../$folder" ) ? '<b><font color="green">Writeable</font></b>' : '<b><font color="red">Unwriteable</font></b>' . '</td>';
  	echo '</tr>';
  }

	/**
	* Generates an HTML select list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @param mixed The key that is selected
	* @returns string HTML for the select list
	*/
	function selectList( &$arr, $tag_name, $tag_attribs, $key, $text, $selected=NULL ) {
		reset( $arr );
		$html = "\n<select name=\"$tag_name\" $tag_attribs>";
		for ($i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = @$arr[$i]->id;

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= (($k == $selected) ? " selected=\"selected\"" : '');
			}
			$html .= "\n\t<option value=\"".$k."\"$extra>" . $t . "</option>";
		}
		$html .= "\n</select>\n";
		return $html;
	}

	/**
	* Writes a select list of integers
	* @param int The start integer
	* @param int The end integer
	* @param int The increment
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The printf format to be applied to the number
	* @returns string HTML for the select list
	*/
	function integerSelectList( $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format="" ) {
		$start = intval( $start );
		$end = intval( $end );
		$inc = intval( $inc );
		$arr = array();
		for ($i=$start; $i <= $end; $i+=$inc) {
			$fi = $format ? sprintf( "$format", $i ) : "$i";
			$arr[] = mosHTML::makeOption( $fi, $fi );
		}

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Writes a select list of month names based on Language settings
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the select list values
	*/
	function monthSelectList( $tag_name, $tag_attribs, $selected ) {
		$arr = array(
		mosHTML::makeOption( '01', _JAN ),
		mosHTML::makeOption( '02', _FEB ),
		mosHTML::makeOption( '03', _MAR ),
		mosHTML::makeOption( '04', _APR ),
		mosHTML::makeOption( '05', _MAY ),
		mosHTML::makeOption( '06', _JUN ),
		mosHTML::makeOption( '07', _JUL ),
		mosHTML::makeOption( '08', _AUG ),
		mosHTML::makeOption( '09', _SEP ),
		mosHTML::makeOption( '10', _OCT ),
		mosHTML::makeOption( '11', _NOV ),
		mosHTML::makeOption( '12', _DEC )
		);

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Generates an HTML select list from a tree based query list
	* @param array Source array with id and parent fields
	* @param array The id of the current list item
	* @param array Target array.  May be an empty array.
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @param mixed The key that is selected
	* @returns string HTML for the select list
	*/
	function treeSelectList( &$src_list, $src_id, $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected ) {

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ($src_list as $v ) {
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$ilist = mosTreeRecurse( 0, '', array(), $children );

		// assemble menu items to the array
		$this_treename = '';
		foreach ($ilist as $item) {
			if ($this_treename) {
				if ($item->id != $src_id && strpos( $item->treename, $this_treename ) === false) {
					$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
				}
			} else {
				if ($item->id != $src_id) {
					$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
				} else {
					$this_treename = "$item->treename/";
				}
			}
		}
		// build the html select list
		return mosHTML::selectList( $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected );
	}

	/**
	* Writes a yes/no select list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the select list values
	*/
	function yesnoSelectList( $tag_name, $tag_attribs, $selected, $yes=_CMN_YES, $no=_CMN_NO ) {
		$arr = array(
		mosHTML::makeOption( '0', $no ),
		mosHTML::makeOption( '1', $yes ),
		);

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Generates an HTML radio list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @returns string HTML for the select list
	*/
	function radioList( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text' ) {
		reset( $arr );
		$html = "";
		for ($i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = @$arr[$i]->id;

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " checked=\"checked\"" : '');
			}
			$html .= "\n\t<input type=\"radio\" name=\"$tag_name\" value=\"".$k."\"$extra $tag_attribs />" . $t;
		}
		$html .= "\n";
		return $html;
	}

	/**
	* Writes a yes/no radio list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the radio list
	*/
	function yesnoRadioList( $tag_name, $tag_attribs, $selected, $yes=_CMN_YES, $no=_CMN_NO ) {
		$arr = array(
		mosHTML::makeOption( '0', $no, true ),
		mosHTML::makeOption( '1', $yes, true )
		);
		return mosHTML::radioList( $arr, $tag_name, $tag_attribs, $selected );
	}

	/**
	* @param int The row index
	* @param int The record id
	* @param boolean
	* @param string The name of the form element
	* @return string
	*/
	function idBox( $rowNum, $recId, $checkedOut=false, $name='cid' ) {
		if ( $checkedOut ) {
			return '';
		} else {
			return '<input type="checkbox" id="cb'.$rowNum.'" name="'.$name.'[]" value="'.$recId.'" onclick="isChecked(this.checked);" />';
		}
	}

	function sortIcon( $base_href, $field, $state='none' ) {
		global $mosConfig_live_site;

		$alts = array(
		'none' => _CMN_SORT_NONE,
		'asc' => _CMN_SORT_ASC,
		'desc' => _CMN_SORT_DESC,
		);
		$next_state = 'asc';
		if ($state == 'asc') {
			$next_state = 'desc';
		} else if ($state == 'desc') {
			$next_state = 'none';
		}

		$html = "<a href=\"$base_href&field=$field&order=$next_state\">"
		. "<img src=\"$mosConfig_live_site/images/M_images/sort_$state.png\" width=\"12\" height=\"12\" border=\"0\" alt=\"{$alts[$next_state]}\" />"
		. "</a>";
		return $html;
	}

	/**
	* Writes Close Button
	*/
	function CloseButton ( &$params, $hide_js=NULL ) {
		// displays close button in Pop-up window
		if ( $params->get( 'popup' ) && !$hide_js ) {
			?>
			<div align="center" style="margin-top: 30px; margin-bottom: 30px;">
			<a href='javascript:window.close();'>
			<span class="small">
			<?php echo _PROMPT_CLOSE;?>
			</span>
			</a>
			</div>
			<?php
		}
	}

	/**
	* Writes Back Button
	*/
	function BackButton ( &$params, $hide_js=NULL ) {
		// Back Button
		if ( $params->get( 'back_button' ) && !$params->get( 'popup' ) && !$hide_js) {
			?>
			<div class="back_button">
			<a href='javascript:history.go(-1)'>
			<?php echo _BACK; ?>
			</a>
			</div>
			<?php
		}
	}

	/**
	* Cleans text of all formating and scripting code
	*/
	function cleanText ( &$text ) {
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
		$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
		$text = preg_replace( '/<!--.+?-->/', '', $text );
		$text = preg_replace( '/{.+?}/', '', $text );
		$text = preg_replace( '/&nbsp;/', ' ', $text );
		$text = preg_replace( '/&amp;/', ' ', $text );
		$text = preg_replace( '/&quot;/', ' ', $text );
		$text = strip_tags( $text );
		$text = htmlspecialchars( $text );
		return $text;
	}

	/**
	* Writes Print icon
	*/
	function PrintIcon( &$row, &$params, $hide_js, $link, $status=NULL ) {
		global $mosConfig_live_site, $mosConfig_absolute_path, $cur_template, $Itemid;
		if ( $params->get( 'print' )  && !$hide_js ) {
			// use default settings if none declared
			if ( !$status ) {
				$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
			}

			// checks template image directory for image, if non found default are loaded
			if ( $params->get( 'icons' ) ) {
				$image = mosAdminMenus::ImageCheck( 'printButton.png', '/images/M_images/', NULL, NULL, _CMN_PRINT );
			} else {
				$image = _ICON_SEP .'&nbsp;'. _CMN_PRINT. '&nbsp;'. _ICON_SEP;
			}

			if ( $params->get( 'popup' ) && !$hide_js ) {
				// Print Preview button - used when viewing page
				?>
				<td align="right" width="100%" class="buttonheading">
				<a href="#" onclick="javascript:window.print(); return false" title="<?php echo _CMN_PRINT;?>">
				<?php echo $image;?>
				</a>
				</td>
				<?php
			} else {
				// Print Button - used in pop-up window
				?>
				<td align="right" width="100%" class="buttonheading">
				<a href="javascript:void window.open('<?php echo $link; ?>', 'win2', '<?php echo $status; ?>');" title="<?php echo _CMN_PRINT;?>">
				<?php echo $image;?>
				</a>
				</td>
				<?php
			}
		}
	}

	/**
	* simple Javascript Cloaking
	* email cloacking
 	* by default replaces an email with a mailto link with email cloacked
	*/
	function emailCloaking( $mail, $mailto=1, $text='', $email=1 ) {
		// convert text
		$mail 		= mosHTML::encoding_converter( $mail );
		// split email by @ symbol
		$mail		= explode( '@', $mail );
		$mail_parts	= explode( '.', $mail[1] );
		// random number
		$rand	= rand( 1, 100000 );

		$replacement 	= "\n<script language='JavaScript' type='text/javascript'> \n";
		$replacement 	.= "<!-- \n";
		$replacement 	.= "var prefix = '&#109;a' + 'i&#108;' + '&#116;o'; \n";
		$replacement 	.= "var path = 'hr' + 'ef' + '='; \n";
		$replacement 	.= "var addy". $rand ." = '". @$mail[0] ."' + '&#64;' + '". implode( "' + '&#46;' + '", $mail_parts ) ."'; \n";
		if ( $mailto ) {
			// special handling when mail text is different from mail addy
			if ( $text ) {
				if ( $email ) {
					// convert text
					$text 	= mosHTML::encoding_converter( $text );
					// split email by @ symbol
					$text 	= explode( '@', $text );
					$text_parts	= explode( '.', $text[1] );
					$replacement 	.= "var addy_text". $rand ." = '". @$text[0] ."' + '&#64;' + '". implode( "' + '&#46;' + '", @$text_parts ) ."'; \n";
				} else {
					$text 	= mosHTML::encoding_converter( $text );
					$replacement 	.= "var addy_text". $rand ." = '". $text ."';\n";
				}
				$replacement 	.= "document.write( '<a ' + path + '\'' + prefix + ':' + addy". $rand ." + '\'>' ); \n";
				$replacement 	.= "document.write( addy_text". $rand ." ); \n";
				$replacement 	.= "document.write( '<\/a>' ); \n";
			} else {
				$replacement 	.= "document.write( '<a ' + path + '\'' + prefix + ':' + addy". $rand ." + '\'>' ); \n";
				$replacement 	.= "document.write( addy". $rand ." ); \n";
				$replacement 	.= "document.write( '<\/a>' ); \n";
			}
		} else {
			$replacement 	.= "document.write( addy". $rand ." ); \n";
		}
		$replacement 	.= "//--> \n";
		$replacement 	.= "</script> \n";
		$replacement 	.= "<noscript> \n";
		$replacement 	.= _CLOAKING;
		$replacement 	.= "\n</noscript> \n";

		return $replacement;
	}

	function encoding_converter( $text ) {
		// replace vowels with character encoding
		$text 	= str_replace( 'a', '&#97;', $text );
		$text 	= str_replace( 'e', '&#101;', $text );
		$text 	= str_replace( 'i', '&#105;', $text );
		$text 	= str_replace( 'o', '&#111;', $text );
		$text	= str_replace( 'u', '&#117;', $text );

		return $text;
	}
}

/**
* Category database table class
* @package Mambo
*/
class mosCategory extends mosDBTable {
	/** @var int Primary key */
	var $id=null;
	/** @var string The menu title for the Category (a short name)*/
	var $title=null;
	/** @var string The full name for the Category*/
	var $name=null;
	/** @var string */
	var $image=null;
	/** @var string */
	var $section=null;
	/** @var int */
	var $image_position=null;
	/** @var string */
	var $description=null;
	/** @var boolean */
	var $published=null;
	/** @var boolean */
	var $checked_out=null;
	/** @var time */
	var $checked_out_time=null;
	/** @var int */
	var $ordering=null;
	/** @var int */
	var $access=null;
	/** @var int */
	var $count=null;	
	/** @var string */
	var $params=null;

	/**
	* @param database A database connector object
	*/
	function mosCategory( &$db ) {
		$this->mosDBTable( '#__categories', 'id', $db );
	}
	// overloaded check function
	function check() {
		// check for valid name
		if (trim( $this->title ) == '') {
			$this->_error = "Your Category must contain a title.";
			return false;
		}
		if (trim( $this->name ) == '') {
			$this->_error = "Your Category must have a name.";
			return false;
		}
		// check for existing name
		$this->_db->setQuery( "SELECT id FROM #__categories "
		. "\nWHERE name='".$this->name."' AND section='".$this->section."'"
		);

		$xid = intval( $this->_db->loadResult() );
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = "There is a category already with that name, please try again.";
			return false;
		}
		return true;
	}
}

/**
* Section database table class
* @package Mambo
*/
class mosSection extends mosDBTable {
	/** @var int Primary key */
	var $id=null;
	/** @var string The menu title for the Section (a short name)*/
	var $title=null;
	/** @var string The full name for the Section*/
	var $name=null;
	/** @var string */
	var $image=null;
	/** @var string */
	var $scope=null;
	/** @var int */
	var $image_position=null;
	/** @var string */
	var $description=null;
	/** @var boolean */
	var $published=null;
	/** @var boolean */
	var $checked_out=null;
	/** @var time */
	var $checked_out_time=null;
	/** @var int */
	var $ordering=null;
	/** @var int */
	var $access=null;
	/** @var int */
	var $count=null;
	/** @var string */
	var $params='';

	/**
	* @param database A database connector object
	*/
	function mosSection( &$db ) {
		$this->mosDBTable( '#__sections', 'id', $db );
	}
	// overloaded check function
	function check() {
		// check for valid name
		if (trim( $this->title ) == '') {
			$this->_error = "Your Section must contain a title.";
			return false;
		}
		if (trim( $this->name ) == '') {
			$this->_error = "Your Section must have a name.";
			return false;
		}
		// check for existing name
		$this->_db->setQuery( "SELECT id FROM #__sections "
		. "\nWHERE name='$this->name' AND scope='$this->scope'"
		);

		$xid = intval( $this->_db->loadResult() );
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = "There is a section already with that name, please try again.";
			return false;
		}
		return true;
	}
}

/**
* Module database table class
* @package Mambo
*/
class mosContent extends mosDBTable {
	/** @var int Primary key */
	var $id=null;
	/** @var string */
	var $title=null;
	/** @var string */
	var $title_alias=null;
	/** @var string */
	var $introtext=null;
	/** @var string */
	var $fulltext=null;
	/** @var int */
	var $state=null;
	/** @var int The id of the category section*/
	var $sectionid=null;
	/** @var int DEPRECATED */
	var $mask=null;
	/** @var int */
	var $catid=null;
	/** @var datetime */
	var $created=null;
	/** @var int User id*/
	var $created_by=null;
	/** @var string An alias for the author*/
	var $created_by_alias=null;
	/** @var datetime */
	var $modified=null;
	/** @var int User id*/
	var $modified_by=null;
	/** @var boolean */
	var $checked_out=null;
	/** @var time */
	var $checked_out_time=null;
	/** @var datetime */
	var $frontpage_up=null;
	/** @var datetime */
	var $frontpage_down=null;
	/** @var string */
	var $images=null;
	/** @var string */
	var $urls=null;
	/** @var string */
	var $attribs=null;
	/** @var int */
	var $version=null;
	/** @var int */
	var $parentid=null;
	/** @var int */
	var $ordering=null;
	/** @var string */
	var $metakey=null;
	/** @var string */
	var $metadesc=null;
	/** @var int */
	var $access=null;
	/** @var int */
	var $hits=null;

	/**
	* @param database A database connector object
	*/
	function mosContent( &$db ) {
		$this->mosDBTable( '#__content', 'id', $db );
	}

	/**
	 * Validation and filtering
	 */
	function check() {
		// filter malicious code
		$ignoreList = array( 'introtext', 'fulltext' );
		$this->filter( $ignoreList );

		/*
		TODO: This filter is too rigorous,
		need to implement more configurable solution
		// specific filters
		$iFilter = new InputFilter( null, null, 1, 1 );
		$this->introtext = trim( $iFilter->process( $this->introtext ) );
		$this->fulltext =  trim( $iFilter->process( $this->fulltext ) );
		*/

		if (trim( str_replace( '&nbsp;', '', $this->fulltext ) ) == '') {
			$this->fulltext = '';
		}

		return true;
	}

	/**
	* Converts record to XML
	* @param boolean Map foreign keys to text values
	*/
	function toXML( $mapKeysToText=false ) {
		global $database;

		if ($mapKeysToText) {
			$query = 'SELECT name FROM #__sections WHERE id=' . $this->sectionid;
			$database->setQuery( $query );
			$this->sectionid = $database->loadResult();

			$query = 'SELECT name FROM #__categories WHERE id=' . $this->catid;
			$database->setQuery( $query );
			$this->catid = $database->loadResult();

			$query = 'SELECT name FROM #__users WHERE id=' . $this->created_by;
			$database->setQuery( $query );
			$this->created_by = $database->loadResult();
		}

		return parent::toXML( $mapKeysToText );
	}
}

/**
* Module database table class
* @package Mambo
*/
class mosMenu extends mosDBTable {
	/** @var int Primary key */
	var $id=null;
	/** @var string */
	var $menutype=null;
	/** @var string */
	var $name=null;
	/** @var string */
	var $sefpath=null;
	/** @var string */
	var $link=null;
	/** @var int */
	var $type=null;
	/** @var int */
	var $published=null;
	/** @var int */
	var $componentid=null;
	/** @var int */
	var $parent=null;
	/** @var int */
	var $sublevel=null;
	/** @var int */
	var $ordering=null;
	/** @var boolean */
	var $checked_out=null;
	/** @var datetime */
	var $checked_out_time=null;
	/** @var boolean */
	var $pollid=null;

	/** @var string */
	var $browserNav=null;
	/** @var int */
	var $access=null;
	/** @var int */
	var $utaccess=null;
	/** @var string */
	var $params=null;

	/**
	* @param database A database connector object
	*/
	function mosMenu( &$db ) {
		$this->mosDBTable( '#__menu', 'id', $db );
	}
}

/**
* Users Table Class
*
* Provides access to the mos_templates table
* @package Mambo
*/
class mosUser extends mosDBTable {
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

	/**
	* @param database A database connector object
	*/
	function mosUser( &$database ) {
		$this->mosDBTable( '#__users', 'id', $database );
	}

	/**
	 * Validation and filtering
	 * @return boolean True is satisfactory
	 */
	function check() {
		global $mosConfig_uniquemail;

		// filter malicious code
		//$this->filter();

		// Validate user information
		if (trim( $this->name ) == '') {
			$this->_error = _REGWARN_NAME;
			return false;
		}

		if (trim( $this->username ) == '') {
			$this->_error = _REGWARN_UNAME;
			return false;
		}

		if (eregi( "[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", $this->username) || strlen( $this->username ) < 3) {
			$this->_error = sprintf( _VALID_AZ09, _PROMPT_UNAME, 2 );
			return false;
		}

		if ((trim($this->email == "")) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $this->email )==false)) {
			$this->_error = _REGWARN_MAIL;
			return false;
		}

		// check for existing username
		$this->_db->setQuery( "SELECT id FROM #__users "
		. "\nWHERE LOWER(username)=LOWER('$this->username') AND id!='$this->id'"
		);

		$xid = intval( $this->_db->loadResult() );
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = _REGWARN_INUSE;
			return false;
		}

		if ($mosConfig_uniquemail) {
			// check for existing email
			$this->_db->setQuery( "SELECT id FROM #__users "
			. "\nWHERE email='$this->email' AND id!='$this->id'"
			);

			$xid = intval( $this->_db->loadResult() );
			if ($xid && $xid != intval( $this->id )) {
				$this->_error = _REGWARN_EMAIL_INUSE;
				return false;
			}
		}

		return true;
	}

	function store( $updateNulls=false ) {
		global $acl, $migrate;
		$section_value = 'users';

		$k = $this->_tbl_key;
		$key =  $this->$k;
		if( $key && !$migrate) {
			// existing record
			$ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
			// syncronise ACL
			// single group handled at the moment
			// trivial to expand to multiple groups
			$groups = $acl->get_object_groups( $section_value, $this->$k, 'ARO' );
			$acl->del_group_object( $groups[0], $section_value, $this->$k, 'ARO' );
			$acl->add_group_object( $this->gid, $section_value, $this->$k, 'ARO' );

			$object_id = $acl->get_object_id( $section_value, $this->$k, 'ARO' );
			$acl->edit_object( $object_id, $section_value, $this->_db->getEscaped( $this->name ), $this->$k, 0, 0, 'ARO' );
		} else {
			// new record
			$ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );
			// syncronise ACL
			$acl->add_object( $section_value, $this->_db->getEscaped( $this->name ), $this->$k, null, null, 'ARO' );
			$acl->add_group_object( $this->gid, $section_value, $this->$k, 'ARO' );
		}
		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}

	function delete( $oid=null ) {
		global $acl;

		$k = $this->_tbl_key;
		if ($oid) {
			$this->$k = intval( $oid );
		}
		$aro_id = $acl->get_object_id( 'users', $this->$k, 'ARO' );
//		$acl->del_object( $aro_id, 'ARO', true );

		$this->_db->setQuery( "DELETE FROM $this->_tbl WHERE $this->_tbl_key = '".$this->$k."'" );

		if ($this->_db->query()) {
			// cleanup related data

			// :: private messaging
			$this->_db->setQuery( "DELETE FROM #__messages_cfg WHERE user_id='".$this->$k."'" );
			if (!$this->_db->query()) {
				$this->_error = $this->_db->getErrorMsg();
				return false;
			}
			$this->_db->setQuery( "DELETE FROM #__messages WHERE user_id_to='".$this->$k."'" );
			if (!$this->_db->query()) {
				$this->_error = $this->_db->getErrorMsg();
				return false;
			}

			return true;
		} else {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}
	}
}

/**
* Template Table Class
*
* Provides access to the mos_templates table
* @package Mambo
*/
class mosTemplate extends mosDBTable {
	/** @var int */
	var $id=null;
	/** @var string */
	var $cur_template=null;
	/** @var int */
	var $col_main=null;

	/**
	* @param database A database connector object
	*/
	function mosTemplate( &$database ) {
		$this->mosDBTable( '#__templates', 'id', $database );
	}
}

/**
* Utility function to return a value from a named array or a specified default
*/
define( "_MOS_NOTRIM", 0x0001 );
define( "_MOS_ALLOWHTML", 0x0002 );
define( "_MOS_ALLOWRAW", 0x0004 );
function mosGetParam( &$arr, $name, $def=null, $mask=0 ) {
	if (isset( $arr[$name] )) {
		if (is_array($arr[$name])) foreach ($arr[$name] as $key=>$element) mosGetParam ($arr[$name], $key, $def, $mask);
		else {
			if (!($mask&_MOS_NOTRIM)) $arr[$name] = trim( $arr[$name] );
			if (!is_numeric( $arr[$name] )) {
				if (!($mask&_MOS_ALLOWHTML)) $arr[$name] = strip_tags( $arr[$name] );
				if (!($mask&_MOS_ALLOWRAW)) {
					if (is_numeric($def)) $arr[$name] = intval($arr[$name]);
				}
			}
			if (!get_magic_quotes_gpc()) {
				$return = addslashes( $return );
			}
		}
		return $arr[$name];
	} else {
		return $def;
	}
}

/**
* Strip slashes from strings or arrays of strings
* @param value the input string or array
*/
function mosStripslashes(&$value)
{
	$ret = '';
    if (is_string($value)) {
		$ret = stripslashes($value);
	} else {
	    if (is_array($value)) {
	        $ret = array();
	        while (list($key,$val) = each($value)) {
	            $ret[$key] = mosStripslashes($val);
	        } // while
	    } else {
	        $ret = $value;
		} // if
	} // if
    return $ret;
} // mosStripSlashes

/**
* Copy the named array content into the object as properties
* only existing properties of object are filled. when undefined in hash, properties wont be deleted
* @param array the input array
* @param obj byref the object to fill of any class
* @param string
* @param boolean
*/
function mosBindArrayToObject( $array, &$obj, $ignore='', $prefix=NULL, $checkSlashes=true ) {
	if (!is_array( $array ) || !is_object( $obj )) {
		return (false);
	}

	foreach (get_object_vars($obj) as $k => $v) {
		if( substr( $k, 0, 1 ) != '_' ) {			// internal attributes of an object are ignored
			if (strpos( $ignore, $k) === false) {
				if ($prefix) {
					$ak = $prefix . $k;
				} else {
					$ak = $k;
				}
				if (isset($array[$ak])) {
					$obj->$k = ($checkSlashes && get_magic_quotes_gpc()) ? mosStripslashes( $array[$k] ) : $array[$k];
				}
			}
		}
	}

	return true;
}

/**
* Utility function to read the files in a directory
* @param string The file system path
* @param string A filter for the names
* @param boolean Recurse search into sub-directories
* @param boolean True if to prepend the full path to the file name
*/
function mosReadDirectory( $path, $filter='.', $recurse=false, $fullpath=false  ) {
	$arr = array();
	if (!@is_dir( $path )) {
		return $arr;
	}
	$handle = opendir( $path );

	while ($file = readdir($handle)) {
		$dir = mosPathName( $path.'/'.$file, false );
		$isDir = is_dir( $dir );
		if (($file <> ".") && ($file <> "..")) {
			if (preg_match( "/$filter/", $file )) {
				if ($fullpath) {
					$arr[] = trim( mosPathName( $path.'/'.$file, false ) );
				} else {
					$arr[] = trim( $file );
				}
			}
			if ($recurse && $isDir) {
				$arr2 = mosReadDirectory( $dir, $filter, $recurse, $fullpath );
				$arr = array_merge( $arr, $arr2 );
			}
		}
	}
	closedir($handle);
	asort($arr);
	return $arr;
}

/**
* Utility function redirect the browser location to another url
*
* Can optionally provide a message.
* @param string The file system path
* @param string A filter for the names
*/
function mosRedirect( $url, $msg='' ) {
	// specific filters
	$iFilter = new InputFilter();
	$url = $iFilter->process( $url );
	$msg = $iFilter->process( $msg );

	if ($iFilter->badAttributeValue( array( 'href', $url ))) {
		$url = $GLOBALS['mosConfig_live_site'];
	}

	if (trim( $msg )) {
	 	if (strpos( $url, '?' )) {
			$url .= '&mosmsg=' . urlencode( $msg );
		} else {
			$url .= '?mosmsg=' . urlencode( $msg );
		}
	}

	if (headers_sent()) {
		echo "<script>document.location.href='$url';</script>\n";
	} else {
		@ob_end_clean(); // clear output buffer
		header( "Location: $url" );
	}
	exit();
}

function mosTreeRecurse( $id, $indent, $list, &$children, $maxlevel=9999, $level=0, $type=1 ) {
	if (@$children[$id] && $level <= $maxlevel) {
		foreach ($children[$id] as $v) {
			$id = $v->id;

			if ( $type ) {
				$pre 	= '<sup>L</sup>&nbsp;';
				$spacer = '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			} else {
				$pre 	= '- ';
				$spacer = '&nbsp;&nbsp;';
			}

			if ( $v->parent == 0 ) {
				$txt 	= $v->name;
			} else {
				$txt 	= $pre . $v->name;
			}
			$pt = $v->parent;
			$list[$id] = $v;
			$list[$id]->treename = "$indent$txt";
			$list[$id]->children = count( @$children[$id] );
			$list = mosTreeRecurse( $id, $indent . $spacer, $list, $children, $maxlevel, $level+1, $type );
		}
	}
	return $list;
}

/**
* Function to strip additional / or \ in a path name
* @param string The path
* @param boolean Add trailing slash
*/
function mosPathName($p_path,$p_addtrailingslash = true) {
	$retval = "";

	$isWin = (substr(PHP_OS, 0, 3) == 'WIN');

	if ($isWin)	{
		$retval = str_replace( '/', '\\', $p_path );
		if ($p_addtrailingslash) {
			if (substr( $retval, -1 ) != '\\') {
				$retval .= '\\';
			}
		}
		// Remove double \\
		$retval = str_replace( '\\\\', '\\', $retval );
	} else {
		$retval = str_replace( '\\', '/', $p_path );
		if ($p_addtrailingslash) {
			if (substr( $retval, -1 ) != '/') {
				$retval .= '/';
			}
		}
		// Remove double //
		$retval = str_replace('//','/',$retval);
	}

	return $retval;
}

/**
* Class mosMambot
* @package Mambo
*/
class mosMambot extends mosDBTable {
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

	function mosMambot( &$db ) {
		$this->mosDBTable( '#__mambots', 'id', $db );
	}
}

/**
* Module database table class
* @package Mambo
*/
class mosModule extends mosDBTable {
	/** @var int Primary key */
	var $id=null;
	/** @var string */
	var $title=null;
	/** @var string */
	var $showtitle=null;
	/** @var int */
	var $content=null;
	/** @var int */
	var $ordering=null;
	/** @var string */
	var $position=null;
	/** @var boolean */
	var $checked_out=null;
	/** @var time */
	var $checked_out_time=null;
	/** @var boolean */
	var $published=null;
	/** @var string */
	var $module=null;
	/** @var int */
	var $numnews=null;
	/** @var int */
	var $access=null;
	/** @var string */
	var $params=null;
	/** @var string */
	var $iscore=null;
	/** @var string */
	var $client_id=null;

	/**
	* @param database A database connector object
	*/
	function mosModule( &$db ) {
		$this->mosDBTable( '#__modules', 'id', $db );
	}
	// overloaded check function
	function check() {
		// check for valid name
		if (trim( $this->title ) == '') {
			$this->_error = "Your Module must contain a title.";
			return false;
		}

		// limitation has been removed
		// check for existing title
		//$this->_db->setQuery( "SELECT id FROM #__modules"
		//. "\nWHERE title='$this->title'"
		//);
		// check for module of same name
		//$xid = intval( $this->_db->loadResult() );
		//if ($xid && $xid != intval( $this->id )) {
		//	$this->_error = "There is a module already with that name, please try again.";
		//	return false;
		//}
		return true;
	}
}

/**
* Session database table class
* @package Mambo
*/
class mosSession extends mosDBTable {
	/** @var int Primary key */
	var $session_id=null;
	/** @var string */
	var $time=null;
	/** @var string */
	var $userid=null;
	/** @var string */
	var $usertype=null;
	/** @var string */
	var $username=null;
	/** @var time */
	var $gid=null;
	/** @var int */
	var $guest=null;
	/** @var string */
	var $_session_cookie=null;
	/** @var int��0--session, 1--url */ 
	var $_sessionmethod=null;

	/**
	* @param database A database connector object
	*/
	function mosSession( &$db ) {
		$this->mosDBTable( '#__session', 'session_id', $db );
	}

	function insert() {
		$ret = $this->_db->insertObject( $this->_tbl, $this );

		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->stderr();
			return false;
		} else {
			return true;
		}
	}

	function update( $updateNulls=false ) {
		$ret = $this->_db->updateObject( $this->_tbl, $this, 'session_id', $updateNulls );

		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->stderr();
			return false;
		} else {
			return true;
		}
	}

	function generateId() {
		$randnum = md5( uniqid( microtime(), 1 ) );
		$this->_session_cookie = $randnum;
		$this->session_id = md5( $randnum . $_SERVER['REMOTE_ADDR'] );
	}

	function getCookie() {
		return $this->_session_cookie;
	}

	function purge( $inc=1800 ) {
		$past = time() - $inc;
		$query = "DELETE FROM $this->_tbl"
		. "\nWHERE (time < $past)";
		$this->_db->setQuery($query);

		return $this->_db->query();
	}
}


function mosObjectToArray($p_obj)
{
	$retarray = null;
	if(is_object($p_obj))
	{
		$retarray = array();
		foreach (get_object_vars($p_obj) as $k => $v)
		{
			if(is_object($v))
			$retarray[$k] = mosObjectToArray($v);
			else
			$retarray[$k] = $v;
		}
	}
	return $retarray;
}
/**
* Checks the user agent string against known browsers
*/
function mosGetBrowser( $agent ) {
	require( "includes/agent_browser.php" );

	if (preg_match( "/msie[\/\sa-z]*([\d\.]*)/i", $agent, $m )
	&& !preg_match( "/webtv/i", $agent )
	&& !preg_match( "/omniweb/i", $agent )
	&& !preg_match( "/opera/i", $agent )) {
		// IE
		return "MS Internet Explorer $m[1]";
	} else if (preg_match( "/netscape.?\/([\d\.]*)/i", $agent, $m )) {
		// Netscape 6.x, 7.x ...
		return "Netscape $m[1]";
	} else if ( preg_match( "/mozilla[\/\sa-z]*([\d\.]*)/i", $agent, $m )
	&& !preg_match( "/gecko/i", $agent )
	&& !preg_match( "/compatible/i", $agent )
	&& !preg_match( "/opera/i", $agent )
	&& !preg_match( "/galeon/i", $agent )
	&& !preg_match( "/safari/i", $agent )) {
		// Netscape 3.x, 4.x ...
		return "Netscape $m[2]";
	} else {
		// Other
		$found = false;
		foreach ($browserSearchOrder as $key) {
			if (preg_match( "/$key.?\/([\d\.]*)/i", $agent, $m )) {
				$name = "$browsersAlias[$key] $m[1]";
				return $name;
				break;
			}
		}
	}

	return 'Unknown';
}

/**
* Checks the user agent string against known operating systems
*/
function mosGetOS( $agent ) {
	require( "includes/agent_os.php" );

	foreach ($osSearchOrder as $key) {
		if (preg_match( "/$key/i", $agent )) {
			return $osAlias[$key];
			break;
		}
	}

	return 'Unknown';
}

/**
* @param string SQL with ordering As value and 'name field' AS text
* @param integer The length of the truncated headline
*/
function mosGetOrderingList( $sql, $chop='30' ) {
	global $database;

	$order = array();
	$database->setQuery( $sql );
	if (!($orders = $database->loadObjectList())) {
		if ($database->getErrorNum()) {
			echo $database->stderr();
			return false;
		} else {
			$order[] = mosHTML::makeOption( 1, 'first' );
			return $order;
		}
	}
	$order[] = mosHTML::makeOption( 0, '0 first' );
	for ($i=0, $n=count( $orders ); $i < $n; $i++) {

        if (strlen($orders[$i]->text) > $chop) {
        	$text = substr($orders[$i]->text,0,$chop)."...";
        } else {
        	$text = $orders[$i]->text;
        }

		$order[] = mosHTML::makeOption( $orders[$i]->value, $orders[$i]->value.' ('.$text.')' );
	}
	$order[] = mosHTML::makeOption( $orders[$i-1]->value+1, ($orders[$i-1]->value+1).' last' );

	return $order;
}

/**
* Makes a variable safe to display in forms
*
* Object parameters that are non-string, array, object or start with underscore
* will be converted
* @param object An object to be parsed
* @param int The optional quote style for the htmlspecialchars function
* @param string|array An optional single field name or array of field names not
*                     to be parsed (eg, for a textarea)
*/
function mosMakeHtmlSafe( &$mixed, $quote_style=ENT_QUOTES, $exclude_keys='' ) {
	if (is_object( $mixed )) {
		foreach (get_object_vars( $mixed ) as $k => $v) {
			if (is_array( $v ) || is_object( $v ) || $v == NULL || substr( $k, 1, 1 ) == '_' ) {
				continue;
			}
			if (is_string( $exclude_keys ) && $k == $exclude_keys) {
				continue;
			} else if (is_array( $exclude_keys ) && in_array( $k, $exclude_keys )) {
				continue;
			}
			$mixed->$k = htmlspecialchars( $v, $quote_style );
		}
	}
}

/**
* Checks whether a menu option is within the users access level
* @param int Item id number
* @param string The menu option
* @param int The users group ID number
* @param database A database connector object
* @return boolean True if the visitor's group at least equal to the menu access
*/
function mosMenuCheck( $Itemid, $menu_option, $task, $gid ) {
	global $database, $menuIdVars;
	$access = 0;
	$dblink="index.php?option=$menu_option";
	if (!empty($Itemid) && isset($menuIdVars[$Itemid]->access)) {
		$access = $menuIdVars[$Itemid]->access;
		//$database->setQuery( "SELECT access FROM #__menu WHERE id='$Itemid'" );
	} else {
		if ($task) {
			$task = $database->getEscaped($task);
			$dblink.="&task=$task";
		}
		$database->setQuery( "SELECT access FROM #__menu WHERE link like '$dblink%'" );
		$results = $database->loadObjectList();
		foreach ($results as $result) {
			$access = max( $access, $result->access );
		}
	}
	
	return ($access <= $gid);
}

/**
* Returns formated date according to current local and adds time offset
* @param string date in datetime format
* @param string format optional format for strftime
* @param offset time offset if different than global one
* @returns formated date
*/
function mosFormatDate( $date, $format="", $offset="" ){
	global $mosConfig_offset;
	if ( $format == '' ) {
		// %Y-%m-%d %H:%M:%S
		$format = _DATE_FORMAT_LC;
	}
	if ( $offset == '' ) {
		$offset = $mosConfig_offset;
	}
	if ( $date ) {
		$date = strtotime($date);
		$date = ($date != -1 || !$date) ? strftime( $format, $date + ($offset*60*60) ) : '-';
	}
	return $date;
}

/**
* Returns current date according to current local and time offset
* @param string format optional format for strftime
* @returns current date
*/
function mosCurrentDate( $format="" ) {
	global $mosConfig_offset;
	if ($format=="") {
		$format = _DATE_FORMAT_LC;
	}
	$date = strftime( $format, time() + ($mosConfig_offset*60*60) );
	return $date;
}

/**
* Utility function to provide ToolTips
* @param string ToolTip text
* @param string Box title
* @returns HTML code for ToolTip
*/
function mosToolTip( $tooltip, $title='', $width='', $image='tooltip.png', $text='', $href='#' ) {
	global $mosConfig_live_site;

	if ( $width ) {
		$width = ', WIDTH, \''.$width .'\'';
	}
	if ( $title ) {
		$title = ', CAPTION, \''.$title .'\'';
	}
	if ( !$text ) {
		$image 	= $mosConfig_live_site . '/includes/js/ThemeOffice/'. $image;
		$text 	= '<img src="'. $image .'" border="0" />';
	}
	$style = 'style="text-decoration: none; color: #333;"';
	if ( $href ) {
		$style = '';
	}
	$tip 	= "<a href=\"". $href ."\" onMouseOver=\"return overlib('" . $tooltip . "'". $title .", BELOW, RIGHT". $width .");\" onmouseout=\"return nd();\" ". $style .">". $text ."</a>";
	return $tip;
}

/**
* Utility function to provide Warning Icons
* @param string Warning text
* @param string Box title
* @returns HTML code for Warning
*/
function mosWarning($warning, $title='Mambo Warning') {
	global $mosConfig_live_site;
	$tip = "<a href=\"#\" onMouseOver=\"return overlib('" . $warning . "', CAPTION, '$title', BELOW, RIGHT);\" onmouseout=\"return nd();\"><img src=\"" . $mosConfig_live_site . "/includes/js/ThemeOffice/warning.png\" border=\"0\" /></a>";
	return $tip;
}

function mosCreateGUID(){
	srand((double)microtime()*1000000);
	$r = rand ;
	$u = uniqid(getmypid() . $r . (double)microtime()*1000000,1);
	$m = md5 ($u);
	return($m);
}

function mosCompressID( $ID ){
	return(Base64_encode(pack("H*",$ID)));
}

function mosExpandID( $ID ) {
	return ( implode(unpack("H*",Base64_decode($ID)), '') );
}

/**
* Page generation time
* @package Mambo
*/
class mosProfiler {
	var $start=0;
	var $prefix='';

	function mosProfiler( $prefix='' ) {
		$this->start = $this->getmicrotime();
		$this->prefix = $prefix;
	}

	function mark( $label ) {
		return sprintf ( "\n<div class=\"profiler\">$this->prefix %.3f $label</div>", $this->getmicrotime() - $this->start );
	}

	function getmicrotime(){
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}
}

/**
* Function to create a mail object for futher use (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string E-mail subject
* @param string Message body
* @return object Mail object
*/
function mosCreateMail( $from='', $fromname='', $subject, $body ) {
	global $mosConfig_absolute_path, $mosConfig_sendmail;
	global $mosConfig_smtpauth, $mosConfig_smtpuser;
	global $mosConfig_smtppass, $mosConfig_smtphost;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailer;

	$mail = new mosPHPMailer();

	$mail->PluginDir = $mosConfig_absolute_path .'/includes/phpmailer/';
	$mail->SetLanguage( 'en', $mosConfig_absolute_path . '/includes/phpmailer/language/' );
	$mail->CharSet 	= substr_replace(_ISO, '', 0, 8);
	$mail->IsMail();
	$mail->From 	= $from ? $from : $mosConfig_mailfrom;
	$mail->FromName = $fromname ? $fromname : $mosConfig_fromname;
	$mail->Mailer 	= $mosConfig_mailer;

	// Add smtp values if needed
	if ( $mosConfig_mailer == 'smtp' ) {
		$mail->SMTPAuth = $mosConfig_smtpauth;
		$mail->Username = $mosConfig_smtpuser;
		$mail->Password = $mosConfig_smtppass;
		$mail->Host 	= $mosConfig_smtphost;
	} else

	// Set sendmail path
	if ( $mosConfig_mailer == 'sendmail' ) {
		if (isset($mosConfig_sendmail))
			$mail->Sendmail = $mosConfig_sendmail;
	} // if

	$mail->Subject 	= $subject;
	$mail->Body 	= $body;

	return $mail;
}

/**
* Mail function (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string/array Recipient e-mail address(es)
* @param string E-mail subject
* @param string Message body
* @param boolean false = plain text, true = HTML
* @param string/array CC e-mail address(es)
* @param string/array BCC e-mail address(es)
* @param string/array Attachment file name(s)
* @param string/array Reply-to e-mail address
* @param string/array Reply-to name
*/
function mosMail($from, $fromname, $recipient, $subject, $body, $mode=0, $cc=NULL, $bcc=NULL, $attachment=NULL, $replyto=NULL, $replytoname=NULL ) {
	global $mosConfig_debug;
	$mail = mosCreateMail( $from, $fromname, $subject, $body );

	// activate HTML formatted emails
	if ( $mode ) {
		$mail->IsHTML(true);
	}

	if( is_array($recipient) ) {
		foreach ($recipient as $to) {
			$mail->AddAddress($to);
		}
	} else {
		$mail->AddAddress($recipient);
	}
	if (isset($cc)) {
	    if( is_array($cc) )
	        foreach ($cc as $to) $mail->AddCC($to);
	    else
	        $mail->AddCC($cc);
	}
	if (isset($bcc)) {
	    if( is_array($bcc) )
	        foreach ($bcc as $to) $mail->AddBCC($to);
	    else
	        $mail->AddBCC($bcc);
	}
    if ($attachment) {
        if ( is_array($attachment) )
            foreach ($attachment as $fname) $mail->AddAttachment($fname);
        else
            $mail->AddAttachment($attachment);
    } // if
    if ($replyto) {
        if ( is_array($replyto) ) {
        	reset($replytoname);
            foreach ($replyto as $to) {
            	$toname = ((list($key, $value) = each($replytoname))
				? $value : "");
            	$mail->AddReplyTo($to, $toname);
            }
        } else
            $mail->AddReplyTo($replyto, $replytoname);
    }
	$mailssend = $mail->Send();

	if( $mosConfig_debug ) {
		//$mosDebug->message( "Mails send: $mailssend");
	}
	if( $mail->error_count > 0 ) {
		//$mosDebug->message( "The mail message $fromname <$from> about $subject to $recipient <b>failed</b><br /><pre>$body</pre>", false );
		//$mosDebug->message( "Mailer Error: " . $mail->ErrorInfo . "" );
	}
	return $mailssend;
} // mosMail

/**
* Initialise GZIP
*/
function initGzip() {
	global $mosConfig_gzip, $do_gzip_compress;
	$do_gzip_compress = FALSE;
	
	//zlib.output_compression and ob_gzhandler don't get along well so we'll check to make
	//that zlib.output_compression is not enable in the php.ini before turning on ob_gzhandler
	if ( $mosConfig_gzip == 1 && (int)ini_get('zlib.output_compression') != 1 ) {
		$phpver = phpversion();
		$useragent = mosGetParam( $_SERVER, 'HTTP_USER_AGENT', '' );
		$canZip = mosGetParam( $_SERVER, 'HTTP_ACCEPT_ENCODING', '' );

		if ( $phpver >= '4.0.4pl1' &&
				( strpos($useragent,'compatible') !== false ||
				  strpos($useragent,'Gecko')      !== false
				)
		   ) {
			if ( extension_loaded('zlib') ) {
				ob_start( 'ob_gzhandler' );
				return;
			}
		} else if ( $phpver > '4.0' ) {
			if ( strpos($canZip,'gzip') !== false ) {
				if (extension_loaded( 'zlib' )) {
					$do_gzip_compress = TRUE;
					ob_start();
					ob_implicit_flush(0);

					header( 'Content-Encoding: gzip' );
					return;
				}
			}
		}
	}
	ob_start();
}

/**
* Perform GZIP
*/
function doGzip() {
	global $do_gzip_compress;
	if ( $do_gzip_compress ) {
		/**
		*Borrowed from php.net!
		*/
		$gzip_contents = ob_get_contents();
		ob_end_clean();

		$gzip_size = strlen($gzip_contents);
		$gzip_crc = crc32($gzip_contents);

		$gzip_contents = gzcompress($gzip_contents, 9);
		$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

		echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
		echo $gzip_contents;
		echo pack('V', $gzip_crc);
		echo pack('V', $gzip_size);
	} else {
		ob_end_flush();
	}
}

/**
* Random password generator
* @return password
*/
function mosMakePassword() {
	$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < 8; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}

if (!function_exists('html_entity_decode')) {
	/**
	* html_entity_decode function for backward compatability in PHP
	* @param string
	* @param string
	*/
	function html_entity_decode ($string, $opt = ENT_COMPAT) {

		$trans_tbl = get_html_translation_table (HTML_ENTITIES);
		$trans_tbl = array_flip ($trans_tbl);

		if ($opt & 1) { // Translating single quotes
		// Add single quote to translation table;
		// doesn't appear to be there by default
		$trans_tbl["&apos;"] = "'";
		}

		if (!($opt & 2)) { // Not translating double quotes
		// Remove double quote from translation table
		unset($trans_tbl["&quot;"]);
		}

		return strtr ($string, $trans_tbl);
	}
}

/**
* Plugin handler
* @package Mambo
*/
class mosMambotHandler {
	/** @var array An array of functions in event groups */
	var $_events=null;
	/** @var array An array of lists */
	var $_lists=null;
	/** @var array An array of mambots */
	var $_bots=null;
	/** @var int Index of the mambot being loaded */
	var $_loading=null;

	/**
	* Constructor
	*/
	function mosMambotHandler() {
		$this->_events = array();
	}
	/**
	* Loads all the bot files for a particular group
	* @param string The group name, relates to the sub-directory in the mambots directory
	*/
	function loadBotGroup( $group ) {
		global $database, $my, $mosConfig_absolute_path;
		global $_MAMBOTS, $mambotsIdVars, $mambotsVars;

		if (!isset($mambotsIdVars) || empty($mambotsIdVars)) {
			$database->setQuery( "SELECT id, name, folder, element, published, CONCAT_WS('/',folder,element) AS lookup, params"
			. "\nFROM #__mambots"
			. "\nWHERE published >= 1 AND access <= $my->gid"
			. "\nORDER BY folder, ordering"
			);
			$mambotsIdVars = $database->loadObjectList('id');
			if (!$mambotsIdVars) return false;
			foreach ($mambotsIdVars as $key => $value) {
				$mambotsVars[$value->folder][$value->element] = &$mambotsIdVars[$key];
			}
		}
		$group = trim( $group );
		/*
		$database->setQuery( "SELECT id, name, folder, element, published, CONCAT_WS('/',folder,element) AS lookup, params"
		. "\nFROM #__mambots"
		. "\nWHERE published >= 1 AND access <= $my->gid AND folder='$group'"
		. "\nORDER BY ordering"
		);
		if (!($bots = $database->loadObjectList())) {
			//echo "Error loading Mambots: " . $database->getErrorMsg();
			return false;
		}
		*/
		
		if (!isset($mambotsVars[$group]) || empty($mambotsVars[$group])) {
			return false;
		}

		$bots = $mambotsVars[$group];
		foreach ($bots as $bot) {
			$path = $mosConfig_absolute_path . '/mambots/' . $bot->folder . '/' . $bot->element . '.php';
			if (file_exists( $path )) {
				$this->_loading = count( $this->_bots );
				$this->_bots[] = $bot;
				require_once( $path );
				$this->_loading = null;
			}
		}
/*		
		$n = count( $bots);
		for ($i = 0; $i < $n; $i++) {
			$path = $mosConfig_absolute_path . '/mambots/' . $bots[$i]->folder . '/' . $bots[$i]->element . '.php';
			if (file_exists( $path )) {
				$this->_loading = count( $this->_bots );
				$this->_bots[] = $bots[$i];
				require_once( $path );
				$this->_loading = null;
			}
		}
*/
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
	* @param boolean True is unpublished bots are to be processed
	* @return array An array of results from each function call
	*/
	function trigger( $event, $args=null, $doUnpublished=false ) {
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
						$args[0] = $this->_bots[$func[1]]->published;
						$result[] = call_user_func_array( $func[0], $args );
					} else if ($this->_bots[$func[1]]->published) {
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
					if ($this->_bots[$func[1]]->published) {
						return call_user_func_array( $func[0], $args );
					}
				}
			}
		}
		return null;
	}
}

/**
* Tab Creation handler
* @package Mambo
* @author Phil Taylor
*/
class mosTabs {
	/** @var int Use cookies */
	var $useCookies = 0;

	/**
	* Constructor
	* Includes files needed for displaying tabs and sets cookie options
	* @param int useCookies, if set to 1 cookie will hold last used tab between page refreshes
	*/
	function mosTabs($useCookies) {
		global $mosConfig_live_site, $adminLanguage; /* rtl change */
		// if rtl display context use appropriate css file
		if (!$adminLanguage->RTLsupport){ /* rtl change */
			echo "<link id=\"luna-tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"" . $mosConfig_live_site. "/includes/js/tabs/tabpane.css\" />";
		} 
		else {
			echo "<link id=\"luna-tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"" . $mosConfig_live_site. "/includes/js/tabs/tabpane_rtl.css\" />";			
		}
		echo "<script type=\"text/javascript\" src=\"". $mosConfig_live_site . "/includes/js/tabs/tabpane.js\"></script>";
		$this->useCookies = $useCookies;
	}

	/**
	* creates a tab pane and creates JS obj
	* @param string The Tab Pane Name
	*/
	function startPane($id){
		echo "<div class=\"tab-page\" id=\"".$id."\">";
		echo "<script type=\"text/javascript\">\n";
		echo "   var tabPane1 = new WebFXTabPane( document.getElementById( \"".$id."\" ), ".$this->useCookies." )\n";
		echo "</script>\n";
	}

	/**
	* Ends Tab Pane
	*/
	function endPane() {
		echo "</div>";
	}

	/*
	* Creates a tab with title text and starts that tabs page
	* @param tabText - This is what is displayed on the tab
	* @param paneid - This is the parent pane to build this tab on
	*/
	function startTab( $tabText, $paneid ) {
		echo "<div class=\"tab-page\" id=\"".$paneid."\">";
		echo "<h2 class=\"tab\">".$tabText."</h2>";
		echo "<script type=\"text/javascript\">\n";
		echo "  tabPane1.addTabPage( document.getElementById( \"".$paneid."\" ) );";
		echo "</script>";
	}

	/*
	* Ends a tab page
	*/
	function endTab() {
		echo "</div>";
	}
}

/**
* Common HTML Output Files
* @package Mambo
*/
class mosAdminMenus {
	/**
	* build the select list for Menu Ordering
	*/
	function Ordering( &$row, $id ) {
		global $database;

		if ( $id ) {
			$order = mosGetOrderingList( "SELECT ordering AS value, name AS text"
			. "\n FROM #__menu"
			. "\n WHERE menutype='". $row->menutype ."'"
			. "\n AND parent='". $row->parent ."'"
			. "\n AND published != '-2'"
			. "\n ORDER BY ordering"
			);
			$ordering = mosHTML::selectList( $order, 'ordering', 'class="inputbox" size="1"', 'value', 'text', intval( $row->ordering ) );
		} else {
			$ordering = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />'. _CMN_NEW_ITEM_LAST;
		}
		return $ordering;
	}

	/**
	* build the select list for access level
	*/
	function Access( &$row ) {
		global $database;

		$query = 'SELECT id AS value, name AS text FROM #__groups ORDER BY id';
		$database->setQuery( $query );
		$groups = $database->loadObjectList();
		$access = mosHTML::selectList( $groups, 'access', 'class="inputbox" size="3"', 'value', 'text', intval( $row->access ) );
		return $access;
	}

	/**
	* build the select list for parent item
	*/
	function Parent( &$row ) {
		global $database;

		// get a list of the menu items
		$query = "SELECT m.*"
		. "\n FROM #__menu m"
		. "\n WHERE menutype='$row->menutype'"
		. "\n AND published <> -2"
		. "\n ORDER BY ordering"
		;
		$database->setQuery( $query );
		$mitems = $database->loadObjectList();

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ( $mitems as $v ) {
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$list = mosTreeRecurse( 0, '', array(), $children, 9999, 0, 0 );

		// assemble menu items to the array
		$mitems = array();
		$mitems[] = mosHTML::makeOption( '0', 'Top' );
		$this_treename = '';
		foreach ( $list as $item ) {
			if ( $this_treename ) {
				if ( $item->id != $row->id && strpos( $item->treename, $this_treename ) === false) {
					$mitems[] = mosHTML::makeOption( $item->id, $item->treename );
				}
			} else {
				if ( $item->id != $row->id ) {
					$mitems[] = mosHTML::makeOption( $item->id, $item->treename );
				} else {
					$this_treename = "$item->treename/";
				}
			}
		}
		$parent = mosHTML::selectList( $mitems, 'parent', 'class="inputbox" size="1"', 'value', 'text', $row->parent );
		return $parent;
	}

	/**
	* build a radio button option for published state
	*/
	function Published( &$row ) {
		$published = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );
		return $published;
	}

	/**
	* build the link/url of a menu item
	*/
	function Link( &$row, $id, $link=NULL ) {
		if ( $id ) {
			if ( $link ) {
				$link = $row->link;
			} else {
				$link = $row->link .'&amp;Itemid='. $row->id;
			}
		} else {
			$link = NULL;
		}
		return $link;
	}

	/**
	* build the select list for target window
	*/
	function Target( &$row ) {
		$click[] = mosHTML::makeOption( '0', _A_PARENT_BROWSER_NAV );
		$click[] = mosHTML::makeOption( '1', _A_NEW_BROWSER_NAV );
		$click[] = mosHTML::makeOption( '2', _A_NEW_W_BROWSER_NAV );
		$target = mosHTML::selectList( $click, 'browserNav', 'class="inputbox" size="4"', 'value', 'text', intval( $row->browserNav ) );
		return $target;
	}

	/**
	* build the multiple select list for Menu Links/Pages
	*/
	function MenuLinks( &$lookup, $all=NULL, $none=NULL ) {
		global $database;

		// get a list of the menu items
		$database->setQuery( "SELECT m.*"
		. "\n FROM #__menu m"
		. "\n WHERE type != 'separator'"
		. "\n AND link NOT LIKE '%tp:/%'"
		. "\n AND published = '1'"
		. "\n ORDER BY menutype, parent, ordering"
		);
		$mitems = $database->loadObjectList();
		$mitems_temp = $mitems;

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ( $mitems as $v ) {
			$id = $v->id;
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$list = mosTreeRecurse( intval( $mitems[0]->parent ), '', array(), $children, 9999, 0, 0 );

		// Code that adds menu name to Display of Page(s)
		$text_count = "0";
		$mitems_spacer = $mitems_temp[0]->menutype;
		foreach ($list as $list_a) {
			foreach ($mitems_temp as $mitems_a) {
				if ($mitems_a->id == $list_a->id) {
					// Code that inserts the blank line that seperates different menus
					if ($mitems_a->menutype <> $mitems_spacer) {
						$list_temp[] = mosHTML::makeOption( -999, '----' );
						$mitems_spacer = $mitems_a->menutype;
					}
					$text = $mitems_a->menutype." | ".$list_a->treename;
					$list_temp[] = mosHTML::makeOption( $list_a->id, $text );
					if ( strlen($text) > $text_count) {
						$text_count = strlen($text);
					}
				}
			}
		}
		$list = $list_temp;

		$mitems = array();
		if ( $all ) {
			// prepare an array with 'all' as the first item
			$mitems[] = mosHTML::makeOption( 0, 'All' );
			// adds space, in select box which is not saved
			$mitems[] = mosHTML::makeOption( -999, '----' );
		}
		if ( $none ) {
			// prepare an array with 'all' as the first item
			$mitems[] = mosHTML::makeOption( -999, 'None' );
			// adds space, in select box which is not saved
			$mitems[] = mosHTML::makeOption( -999, '----' );
		}
		// append the rest of the menu items to the array
		foreach ($list as $item) {
			$mitems[] = mosHTML::makeOption( $item->value, $item->text );
		}
		$pages = mosHTML::selectList( $mitems, 'selections[]', 'class="inputbox" size="26" multiple="multiple"', 'value', 'text', $lookup );
		return $pages;
	}


	/**
	* build the select list to choose a category
	*/
	function Category( &$menu, $id, $javascript='' ) {
		global $database;

		$query = "SELECT c.id AS `value`, c.section AS `id`, CONCAT_WS( ' / ', s.title, c.title) AS `text`"
		. "\n FROM #__sections AS s"
		. "\n INNER JOIN #__categories AS c ON c.section = s.id"
		. "\n WHERE s.scope = 'content'"
		. "\n ORDER BY s.name,c.name"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		$category = '';
		if ( $id ) {
			foreach ( $rows as $row ) {
				if ( $row->value == $menu->componentid ) {
					$category = $row->text;
				}
			}
			$category .= '<input type="hidden" name="componentid" value="'. $menu->componentid .'" />';
			$category .= '<input type="hidden" name="link" value="'. $menu->link .'" />';
		} else {
			$category = mosHTML::selectList( $rows, 'componentid', 'class="inputbox" size="10"'. $javascript, 'value', 'text' );
			$category .= '<input type="hidden" name="link" value="" />';
		}
		return $category;
	}

	/**
	* build the select list to choose a section
	*/
	function Section( &$menu, $id, $all=0 ) {
		global $database;

		$query = "SELECT s.id AS `value`, s.id AS `id`, s.title AS `text`"
		. "\n FROM #__sections AS s"
		. "\n WHERE s.scope = 'content'"
		. "\n ORDER BY s.name"
		;
		$database->setQuery( $query );
		if ( $all ) {
			$rows[] = mosHTML::makeOption( 0, '- All Sections -' );
			$rows = array_merge( $rows, $database->loadObjectList() );
		} else {
			$rows = $database->loadObjectList();
		}

		if ( $id ) {
			foreach ( $rows as $row ) {
				if ( $row->value == $menu->componentid ) {
					$section = $row->text;
				}
			}
			$section .= '<input type="hidden" name="componentid" value="'. $menu->componentid .'" />';
			$section .= '<input type="hidden" name="link" value="'. $menu->link .'" />';
		} else {
			$section = mosHTML::selectList( $rows, 'componentid', 'class="inputbox" size="10"', 'value', 'text' );
			$section .= '<input type="hidden" name="link" value="" />';
		}
		return $section;
	}

	/**
	* build the select list to choose a component
	*/
	function Component( &$menu, $id ) {
		global $database;

		$query = "SELECT c.id AS value, c.name AS text, c.link"
		. "\n FROM #__components AS c"
		. "\n WHERE c.link <> ''"
		. "\n ORDER BY c.name"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList( );

		if ( $id ) {
			// existing component, just show name
			foreach ( $rows as $row ) {
				if ( $row->value == $menu->componentid ) {
					$component = $row->text;
				}
			}
			$component .= '<input type="hidden" name="componentid" value="'. $menu->componentid .'" />';
		} else {
			$component = mosHTML::selectList( $rows, 'componentid', 'class="inputbox" size="10"', 'value', 'text' );
		}
		return $component;
	}

	/**
	* build the select list to choose a component
	*/
	function ComponentName( &$menu, $id ) {
		global $database;

		$query = "SELECT c.id AS value, c.name AS text, c.link"
		. "\n FROM #__components AS c"
		. "\n WHERE c.link <> ''"
		. "\n ORDER BY c.name"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList( );

		$component = 'Component';
		foreach ( $rows as $row ) {
			if ( $row->value == $menu->componentid ) {
				$component = $row->text;
			}
		}

		return $component;
	}

	/**
	* build the select list to choose an image
	*/
	function Images( $name, &$active, $javascript=NULL, $directory=NULL ) {
		global $mosConfig_absolute_path;

		if ( !$javascript ) {
			$javascript = "onchange=\"javascript:if (document.forms[0].image.options[selectedIndex].value!='') {document.imagelib.src='../images/stories/' + document.forms[0].image.options[selectedIndex].value} else {document.imagelib.src='../images/blank.png'}\"";
		}
		if ( !$directory ) {
			$directory = '/images/stories';
		}

		$imageFiles = mosReadDirectory( $mosConfig_absolute_path . $directory );
		$images = array(  mosHTML::makeOption( '', '- Select Image -' ) );
		foreach ( $imageFiles as $file ) {
			if ( eregi( "bmp|gif|jpg|png", $file ) ) {
				$images[] = mosHTML::makeOption( $file );
			}
		}
		$images = mosHTML::selectList( $images, $name, 'class="inputbox" size="1" '. $javascript, 'value', 'text', $active );

		return $images;
	}

	/**
	* build the select list for Ordering of a specified Table
	*/
	function SpecificOrdering( &$row, $id, $query, $neworder=0 ) {
		global $database;

		if ( $neworder ) {
			$text = _CMN_NEW_ITEM_FIRST;
		} else {
			$text = _CMN_NEW_ITEM_LAST;
		}

		if ( $id ) {
			$order = mosGetOrderingList( $query );
			$ordering = mosHTML::selectList( $order, 'ordering', 'class="inputbox" size="1"', 'value', 'text', intval( $row->ordering ) );
		} else {
			$ordering = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />'. $text;
		}
		return $ordering;
	}

	/**
	* Select list of active users
	*/
	function UserSelect( $name, $active, $nouser=0, $javascript=NULL, $order='name' ) {
		global $database, $my;

		$query = "SELECT id AS value, name AS text"
		. "\n FROM #__users"
		. "\n WHERE block = '0'"
		. "\n ORDER BY ". $order
		;
		$database->setQuery( $query );
		if ( $nouser ) {
			$users[] = mosHTML::makeOption( '0', '- No User -' );
			$users = array_merge( $users, $database->loadObjectList() );
		} else {
			$users = $database->loadObjectList();
		}

		$users = mosHTML::selectList( $users, $name, 'class="inputbox" size="1" '. $javascript, 'value', 'text', $active );

		return $users;
	}

	/**
	* Select list of positions - generally used for location of images
	*/
	function Positions( $name, $active=NULL, $javascript=NULL, $none=1, $center=1, $left=1, $right=1 ) {
		if ( $none ) {
			$pos[] = mosHTML::makeOption( '', _CMN_NONE );
		}
		if ( $center ) {
			$pos[] = mosHTML::makeOption( 'center', _CMN_CENTER );
		}
		if ( $left ) {
			$pos[] = mosHTML::makeOption( 'left', _CMN_LEFT );
		}
		if ( $right ) {
			$pos[] = mosHTML::makeOption( 'right', _CMN_RIGHT );
		}

		$positions = mosHTML::selectList( $pos, $name, 'class="inputbox" size="1"'. $javascript, 'value', 'text', $active );

		return $positions;
	}

	/**
	* Select list of active categories for components
	*/
	function ComponentCategory( $name, $section, $active=NULL, $javascript=NULL, $order='ordering', $size=1, $sel_cat=1 ) {
		global $database;

		$query = "SELECT c.id FROM #__categories c WHERE c.params like '%newsfeed=true%' LIMIT 0, 1";
		$database->setQuery( $query );
		$hasNewsfeedCat = $database->loadResult();

		if ( ($section == 'com_newsfeeds') && $hasNewsfeedCat ) {
			$query = "SELECT c.id AS value, CONCAT_WS('/', s.title, c.title) AS text"
			. "\n FROM #__categories c, #__sections s"
			. "\n WHERE c.params like '%newsfeed=true%'"
			. "\n AND c.section = s.id"
			. "\n AND c.published = '1'"
			. "\n ORDER BY c.section, c.". $order
			;
		}
		else {
			$query = "SELECT id AS value, title AS text"
			. "\n FROM #__categories"
			. "\n WHERE section = '". $section ."'"
			. "\n AND published = '1'"
			. "\n ORDER BY ". $order
			;
		}
		$database->setQuery( $query );
		if ( $sel_cat ) {
			$categories[] = mosHTML::makeOption( '0', _SEL_CATEGORY );
			$categories = array_merge( $categories, $database->loadObjectList() );
		} else {
			$categories = $database->loadObjectList();
		}

		if ( count( $categories ) < 1 ) {
			mosRedirect( 'index2.php?option=com_categories&section='. $section, 'You must create a category first.' );
		}

		$category = mosHTML::selectList( $categories, $name, 'class="inputbox" size="'. $size .'" '. $javascript, 'value', 'text', $active );

		return $category;
	}

	/**
	* Select list of active sections
	*/
	function SelectSection( $name, $active=NULL, $javascript=NULL, $order='ordering' ) {
		global $database;

		$categories[] = mosHTML::makeOption( '0', _SEL_SECTION );
		$query = "SELECT id AS value, title AS text"
		. "\n FROM #__sections"
		. "\n WHERE published = '1'"
		. "\n ORDER BY ". $order
		;
		$database->setQuery( $query );
		$sections = array_merge( $categories, $database->loadObjectList() );

		$category = mosHTML::selectList( $sections, $name, 'class="inputbox" size="1" '. $javascript, 'value', 'text', $active );

		return $category;
	}

	/**
	* Select list of menu items for a specific menu
	*/
	function Links2Menu( $type, $and ) {
		global $database;

		$query = "SELECT *"
		. "\n FROM #__menu"
		. "\n WHERE type = '". $type ."'"
		. "\n AND published = '1'"
		. $and
		;
		$database->setQuery( $query );
		$menus = $database->loadObjectList();

		return $menus;
	}

	/**
	* Select list of menus
	*/
	function MenuSelect( $name='menuselect', $javascript=NULL ) {
		global $database;

		$query = "SELECT params"
		. "\n FROM #__modules"
		. "\n WHERE module = 'mod_mainmenu'"
		;
		$database->setQuery( $query );
		$menus = $database->loadObjectList();
		$total = count( $menus );
		for( $i = 0; $i < $total; $i++ ) {
			$params = mosParseParams( $menus[$i]->params );
			$menuselect[$i]->value 	= $params->menutype;
			$menuselect[$i]->text 	= $params->menutype;
		}
		// sort array of objects
		SortArrayObjects( $menuselect, 'text', 1 );

		$menus = mosHTML::selectList( $menuselect, $name, 'class="inputbox" size="10" '. $javascript, 'value', 'text' );

		return $menus;
	}

	/**
	* Internal function to recursive scan the media manager directories
	* @param string Path to scan
	* @param string root path of this folder
	* @param array  Value array of all existing folders
	* @param array  Value array of all existing images
	*/
	function ReadImages( $imagePath, $folderPath, &$folders, &$images ) {
		$imgFiles = mosReadDirectory( $imagePath );

		foreach ($imgFiles as $file) {
			$ff_ 	= $folderPath . $file .'/';
			$ff 		= $folderPath . $file;
			$i_f 	= $imagePath .'/'. $file;

			if ( is_dir( $i_f ) && $file <> 'CVS' ) {
				$folders[] = mosHTML::makeOption( $ff_ );
				mosAdminMenus::ReadImages( $i_f, $ff_, $folders, $images );
			} else if ( eregi( "bmp|gif|jpg|png", $file ) && is_file( $i_f ) ) {
				// leading / we don't need
				$imageFile = substr( $ff, 1 );
				$images[$folderPath][] = mosHTML::makeOption( $imageFile, $file );
			}
		}
	}

	function GetImageFolders( &$folders, $path ) {
		$javascript 	= "onchange=\"changeDynaList( 'imagefiles', folderimages, document.adminForm.folders.options[document.adminForm.folders.selectedIndex].value, 0, 0);  previewImage( 'imagefiles', 'view_imagefiles', '$path/' );\"";
		$getfolders 	= mosHTML::selectList( $folders, 'folders', 'class="inputbox" size="1" '. $javascript, 'value', 'text', '/' );
		return $getfolders;
	}

	function GetImages( &$images, $path ) {
		if ( !isset($images['/'] ) ) {
			$images['/'][] = mosHTML::makeOption( '' );
		}

		//$javascript	= "onchange=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\" onfocus=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\"";
		$javascript	= "onchange=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\"";
		$getimages	= mosHTML::selectList( $images['/'], 'imagefiles', 'class="inputbox" size="10" multiple="multiple" '. $javascript , 'value', 'text', null );

		return $getimages;
	}

	function GetSavedImages( &$row, $path ) {
		$images2 = array();
		foreach( $row->images as $file ) {
			$temp = explode( '|', $file );
			if( strrchr($temp[0], '/') ) {
				$filename = substr( strrchr($temp[0], '/' ), 1 );
			} else {
				$filename = $temp[0];
			}
			$images2[] = mosHTML::makeOption( $file, $filename );
		}
		//$javascript	= "onchange=\"previewImage( 'imagelist', 'view_imagelist', '$path/' ); showImageProps( '$path/' ); \" onfocus=\"previewImage( 'imagelist', 'view_imagelist', '$path/' )\"";
		$javascript	= "onchange=\"previewImage( 'imagelist', 'view_imagelist', '$path/' ); showImageProps( '$path/' ); \"";
		$imagelist 	= mosHTML::selectList( $images2, 'imagelist', 'class="inputbox" size="10" '. $javascript, 'value', 'text' );

		return $imagelist;
	}

	/**
	* Checks to see if an image exists in the current templates image directory
 	* if it does it loads this image.  Otherwise the default image is loaded.
	* Also can be used in conjunction with the menulist param to create the chosen image
	* load the default or use no image
	*/
	function ImageCheck( $file, $directory='/images/M_images/', $param=NULL, $param_directory='/images/M_images/', $alt=NULL, $name='image', $type=1, $align='middle' ) {
		global $mosConfig_absolute_path, $mosConfig_live_site, $mainframe;
		$cur_template = $mainframe->getTemplate();

		if ( $param ) {
			$image = $mosConfig_live_site. $param_directory . $param;
			if ( $type ) {
				$image = '<img src="'. $image .'" align="'. $align .'" alt="'. $alt .'" name="'. $name .'" border="0" />';
			}
		} else if ( $param == -1 ) {
			$image = '';
		} else {
			if ( file_exists( $mosConfig_absolute_path .'/templates/'. $cur_template .'/images/'. $file ) ) {
				$image = $mosConfig_live_site .'/templates/'. $cur_template .'/images/'. $file;
			} else {
				// outputs only path to image
				$image = $mosConfig_live_site. $directory . $file;
			}

			// outputs actual html <img> tag
			if ( $type ) {
				$image = '<img src="'. $image .'" alt="'. $alt .'" align="'. $align .'" name="'. $name .'" border="0" />';
			}
		}

		return $image;
	}

	/**
	* Checks to see if an image exists in the current templates image directory
 	* if it does it loads this image.  Otherwise the default image is loaded.
	* Also can be used in conjunction with the menulist param to create the chosen image
	* load the default or use no image
	*/
	function ImageCheckAdmin( $file, $directory='/administrator/images/', $param=NULL, $param_directory='/administrator/images/', $alt=NULL, $name=NULL, $type=1, $align='middle' ) {
		global $mosConfig_absolute_path, $mosConfig_live_site, $mainframe;
		$cur_template = $mainframe->getTemplate();

		if ( $param ) {
			$image = $mosConfig_live_site. $param_directory . $param;
			if ( $type ) {
				$image = '<img src="'. $image .'" align="'. $align .'" alt="'. $alt .'" name="'. $name .'" border="0" />';
			}
		} else if ( $param == -1 ) {
			$image = '';
		} else {
			if ( file_exists( $mosConfig_absolute_path .'/administrator/templates/'. $cur_template .'/images/'. $file ) ) {
				$image = $mosConfig_live_site .'/administrator/templates/'. $cur_template .'/images/'. $file;
			} else {
				$image = $mosConfig_live_site. $directory . $file;
			}

			// outputs actual html <img> tag
			if ( $type ) {
				$image = '<img src="'. $image .'" alt="'. $alt .'" align="'. $align .'" name="'. $name .'" border="0" />';
			}
		}

		return $image;
	}

	function menutypes() {
		global $database;

		$query = "SELECT params"
		. "\n FROM #__modules"
		. "\n WHERE module = 'mod_mainmenu'"
		. "\n ORDER BY title"
		;
		$database->setQuery( $query	);
		$modMenus = $database->loadObjectList();

		$query = "SELECT menutype"
		. "\n FROM #__menu"
		. "\n GROUP BY menutype"
		. "\n ORDER BY menutype"
		;
		$database->setQuery( $query	);
		$menuMenus = $database->loadObjectList();

		$menuTypes = '';
		foreach ( $modMenus as $modMenu ) {
			$check = 1;
			mosMakeHtmlSafe( $modMenu) ;
			$modParams 	= mosParseParams( $modMenu->params );
			$menuType 	= @$modParams->menutype;
			if (!$menuType) {
				$menuType = 'mainmenu';
			}

			// stop duplicate menutype being shown
			if ( !is_array( $menuTypes) ) {
				// handling to create initial entry into array
				$menuTypes[] = $menuType;
			} else {
				$check = 1;
				foreach ( $menuTypes as $a ) {
					if ( $a == $menuType ) {
						$check = 0;
					}
				}
				if ( $check ) {
					$menuTypes[] = $menuType;
				}
			}

		}
		// add menutypes from mos_menu
		foreach ( $menuMenus as $menuMenu ) {
			$check = 1;
			foreach ( $menuTypes as $a ) {
				if ( $a == $menuMenu->menutype ) {
					$check = 0;
				}
			}
			if ( $check ) {
				$menuTypes[] = $menuMenu->menutype;
			}
		}

		// sorts menutypes
		asort( $menuTypes );

		return $menuTypes;
	}

	/*
	* loads files required for menu items
	*/
	function menuItem( $item ) {
		global $mosConfig_absolute_path;

		$path = $mosConfig_absolute_path .'/administrator/components/com_menus/'. $item .'/';
		include_once( $path . $item .'.class.php' );
		include_once( $path . $item .'.menu.html.php' );
	}
}


class mosCommonHTML {

	function menuLinksContent( &$menus ) {
		?>
		<script language="javascript" type="text/javascript">
		function go2( pressbutton, menu, id ) {
			var form = document.adminForm;

			if (pressbutton == 'go2menu') {
				form.menu.value = menu;
				submitform( pressbutton );
				return;
			}

			if (pressbutton == 'go2menuitem') {
				form.menu.value 	= menu;
				form.menuid.value 	= id;
				submitform( pressbutton );
				return;
			}
		}
		</script>
		<?php
		foreach( $menus as $menu ) {
			?>
			<tr>
				<td colspan="2">
				<hr />
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				Menu
				</td>
				<td>
				<a href="javascript:go2( 'go2menu', '<?php echo $menu->menutype; ?>' );" title="Go to Menu">
				<?php echo $menu->menutype; ?>
				</a>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				Link Name
				</td>
				<td>
				<strong>
				<a href="javascript:go2( 'go2menuitem', '<?php echo $menu->menutype; ?>', '<?php echo $menu->id; ?>' );" title="Go to Menu Item">
				<?php echo $menu->name; ?>
				</a>
				</strong>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				State
				</td>
				<td>
				<?php
				switch ( $menu->published ) {
					case 0:
						echo 'UnPublished';
						break;
					case 1:
					default:
						echo '<font color="green">Published</font>';
						break;
				}
				?>
				</td>
			</tr>
			<?php
		}
		?>
		<input type="hidden" name="menu" value="" />
		<input type="hidden" name="menuid" value="" />
		<?php
	}

	function menuLinksSecCat( &$menus ) {
		?>
		<script language="javascript" type="text/javascript">
		function go2( pressbutton, menu, id ) {
			var form = document.adminForm;

			if (pressbutton == 'go2menu') {
				form.menu.value = menu;
				submitform( pressbutton );
				return;
			}

			if (pressbutton == 'go2menuitem') {
				form.menu.value 	= menu;
				form.menuid.value 	= id;
				submitform( pressbutton );
				return;
			}
		}
		</script>
		<?php
		foreach( $menus as $menu ) {
			?>
			<tr>
				<td colspan="2">
				<hr/>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				Menu
				</td>
				<td>
				<a href="javascript:go2( 'go2menu', '<?php echo $menu->menutype; ?>' );" title="Go to Menu">
				<?php echo $menu->menutype; ?>
				</a>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				Type
				</td>
				<td>
				<?php echo $menu->type; ?>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				Item Name
				</td>
				<td>
				<strong>
				<a href="javascript:go2( 'go2menuitem', '<?php echo $menu->menutype; ?>', '<?php echo $menu->id; ?>' );" title="Go to Menu Item">
				<?php echo $menu->name; ?>
				</a>
				</strong>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				State
				</td>
				<td>
				<?php
				switch ( $menu->published ) {
					case 0:
						echo 'UnPublished';
						break;
					case 1:
					default:
						echo '<font color="green">Published</font>';
						break;
				}
				?>
				</td>
			</tr>
			<?php
		}
		?>
		<input type="hidden" name="menu" value="" />
		<input type="hidden" name="menuid" value="" />
		<?php
	}

	function checkedOut( &$row, $overlib=1 ) {
		$hover = '';
		if ( $overlib ) {
			$date 				= mosFormatDate( $row->checked_out_time, '%A, %d %B %Y' );
			$time				= mosFormatDate( $row->checked_out_time, '%H:%M' );
			$checked_out_text 	= '<table>';
			$checked_out_text 	.= '<tr><td>'. $row->editor .'</td></tr>';
			$checked_out_text 	.= '<tr><td>'. $date .'</td></tr>';
			$checked_out_text 	.= '<tr><td>'. $time .'</td></tr>';
			$checked_out_text 	.= '</table>';
			$hover = 'onMouseOver="return overlib(\''. $checked_out_text .'\', CAPTION, \'Checked Out\', BELOW, RIGHT);" onMouseOut="return nd();"';
		}
		$checked	 		= '<img src="images/checked_out.png" '. $hover .'/>';

		return $checked;
	}

	/*
	* Loads all necessary files for JS Overlib tooltips
	*/
	function loadOverlib() {
		global  $mosConfig_live_site;
		?>
		<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<?php
	}


	/*
	* Loads all necessary files for JS Calendar
	*/
	function loadCalendar() {
		global  $mosConfig_live_site;
		?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $mosConfig_live_site;?>/includes/js/calendar/calendar-mos.css" title="green" />
		<!-- import the calendar script -->
		<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/calendar/calendar.js"></script>
		<!-- import the language module -->
		<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/calendar/lang/calendar-en.js"></script>
		<?php
	}

	function AccessProcessing( &$row, $i ) {
		if ( !$row->access ) {
			$color_access = 'style="color: green;"';
			$task_access = 'accessregistered';
		} else if ( $row->access == 1 ) {
			$color_access = 'style="color: red;"';
			$task_access = 'accessspecial';
		} else {
			$color_access = 'style="color: black;"';
			$task_access = 'accesspublic';
		}

		$href = '
		<a href="javascript: void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $task_access .'\')" '. $color_access .'>
		'. $row->groupname .'
		</a>'
		;

		return $href;
	}

	function CheckedOutProcessing( &$row, $i ) {
		$checked = mosHTML::idBox( $i, $row->id, false );
		return $checked;
	}
/*
	function CheckedOutProcessing( &$row, $i ) {
		global $my;

		if ( $row->checked_out ) {
			$checked = mosCommonHTML::checkedOut( $row );
		} else {
			$checked = mosHTML::idBox( $i, $row->id, ($row->checked_out && $row->checked_out != $my->id ) );
		}
	
		return $checked;
	}
*/
	function PublishedProcessing( &$row, $i ) {
		$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
		$task 	= $row->published ? 'unpublish' : 'publish';
		$alt 	= $row->published ? 'Published' : 'Unpublished';
		$action	= $row->published ? 'Unpublish Item' : 'Publish item';

		$href = '
		<a href="javascript: void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $task .'\')" title="'. $action .'">
		<img src="images/'. $img .'" border="0" alt="'. $alt .'" />
		</a>'
		;

		return $href;
	}
}

/**
* Sorts an Array of objects
*/
function SortArrayObjects_cmp( &$a, &$b ) {
	global $csort_cmp;

	if ( $a->$csort_cmp['key'] > $b->$csort_cmp['key'] ) {
		return $csort_cmp['direction'];
	}

	if ( $a->$csort_cmp['key'] < $b->$csort_cmp['key'] ) {
		return -1 * $csort_cmp['direction'];
	}

	return 0;
}

/**
* Sorts an Array of objects
* sort_direction [1 = Ascending] [-1 = Descending]
*/
function SortArrayObjects( &$a, $k, $sort_direction=1 ) {
	global $csort_cmp;

	$csort_cmp = array(
		'key'          => $k,
		'direction'    => $sort_direction
	);

	usort( $a, 'SortArrayObjects_cmp' );

	unset( $csort_cmp );
}

/**
* Sends mail to admin
*/
function mosSendAdminMail( $adminName, $adminEmail, $email, $type, $title, $author ) {
	global $mosConfig_live_site;

	$subject = _MAIL_SUB." '$type'";
	$message = _MAIL_MSG;
	eval ("\$message = \"$message\";");
	mosMail($mosConfig_mailfrom, $mosConfig_fromname, $adminEmail, $subject, $message);
}

/*
* Includes pathway file
*/
function mosPathWay() {
    $Itemid = mosGetParam($_REQUEST,'Itemid','');
    require $GLOBALS['mosConfig_absolute_path'] . '/includes/pathway.php';
}

/**
* Displays a not authorised message
*
* If the user is not logged in then an addition message is displayed.
*/
function mosNotAuth() {
	global $my;

	echo _NOT_AUTH;
	if ($my->id < 1) {
		echo "<br />" . _DO_LOGIN;
	}
}

/**
* Replaces &amp; with & for xhtml compliance
*
* Needed to handle unicode conflicts due to unicode conflicts
*/
function ampReplace( $text ) {
	$text = str_replace( '&#', '*-*', $text );
	$text = str_replace( '&', '&amp;', $text );
	$text = str_replace( '*-*', '&#', $text );

	return $text;
}

/**
* Prepares results from search for display
* @param string The source string
* @param int Number of chars to trim
* @param string The searchword to select around
* @return string
*/
function mosPrepareSearchContent( $text, $length=200, $searchword ) {
	// strips tags won't remove the actual jscript
	$text = preg_replace( "'<script[^>]*>.*?</script>'si", "", $text );
	$text = preg_replace( '/{.+?}/', '', $text);
	//$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2', $text );
	return mosSmartSubstr( strip_tags( $text ), $length, $searchword );
}

/**
* returns substring of characters around a searchword
* @param string The source string
* @param int Number of chars to return
* @param string The searchword to select around
* @return string
*/
function mosSmartSubstr($text, $length=200, $searchword) {
  $wordpos = strpos(strtolower($text), strtolower($searchword));
  $halfside = intval($wordpos - $length/2 - strlen($searchword));
  if ($wordpos && $halfside > 0) {
      return '...' . substr($text, $halfside, $length);
  } else {
    return substr( $text, 0, $length);
  }
}

/**
* Chmods files and directories recursively to given permissions. Available from 4.5.2 up.
* @param path The starting file or directory (no trailing slash)
* @param filemode Integer value to chmod files. NULL = dont chmod files.
* @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
* @return TRUE=all succeeded FALSE=one or more chmods failed
*/
function mosChmodRecursive($path, $filemode=NULL, $dirmode=NULL)
{
	$ret = TRUE;
	if (is_dir($path)) {
	    $dh = opendir($path);
	    while ($file = readdir($dh)) {
	        if ($file != '.' && $file != '..') {
	            $fullpath = $path.'/'.$file;
	            if (is_dir($fullpath)) {
                    if (!mosChmodRecursive($fullpath, $filemode, $dirmode))
                        $ret = FALSE;
	            } else {
	                if (isset($filemode))
	                    if (!@chmod($fullpath, $filemode))
	                        $ret = FALSE;
	            } // if
	        } // if
	    } // while
	    closedir($dh);
	    if (isset($dirmode))
	        if (!@chmod($path, $dirmode))
	            $ret = FALSE;
	} else {
		if (isset($filemode))
			$ret = @chmod($path, $filemode);
    } // if
	return $ret;
} // mosChmodRecursive

/**
* Chmods files and directories recursively to mos global permissions. Available from 4.5.2 up.
* @param path The starting file or directory (no trailing slash)
* @param filemode Integer value to chmod files. NULL = dont chmod files.
* @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
* @return TRUE=all succeeded FALSE=one or more chmods failed
*/
function mosChmod($path)
{
	global $mosConfig_fileperms, $mosConfig_dirperms;
	$filemode = NULL;
	if ($mosConfig_fileperms != '')
		$filemode = octdec($mosConfig_fileperms);
	$dirmode = NULL;
	if ($mosConfig_dirperms != '')
		$dirmode = octdec($mosConfig_dirperms);
	if (isset($filemode) || isset($dirmode))
		return mosChmodRecursive($path, $filemode, $dirmode);
	return TRUE;
} // mosChmod

/**
 * Function to convert array to integer values
 */
function mosArrayToInts( &$array, $default=null ) {
	if (is_array( $array )) {
		$n = count( $array );
		for ($i = 0; $i < $n; $i++) {
			$array[$i] = intval( $array[$i] );
		}
	} else {
		if (is_null( $default )) {
			return array();
		} else {
			return array( $default );
		}
	}
}


//get client ip
function getClientIP()
{
	$onlineip = '';
	if(getenv('HTTP_CLIENT_IP')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
		list($onlineip) = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
	} elseif(getenv('REMOTE_ADDR')) {
		$onlineip = getenv('REMOTE_ADDR');
	} else {
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}
	return $onlineip;
}

/**
* Extracts host from url
* @param string The url
*/
function URLHost( $url ) {
	//remove http:// or https://
	$url = eregi_replace ("http?://", "", $url);
	$urls = explode("/", $url, 2);
	$host = trim( $urls[0]);
	return $host;
}

/**
* Extracts path from url
* @param string The url
*/
function URLPath( $url ) {
	//remove http:// or https://
	$url = eregi_replace ("http?://", "", $url);
	$urls = explode("/", $url, 2);
	if (isset($urls[1])) {
		$path = trim( $urls[1]);
		if (substr($path, -1, 1) != '/') {
			$path .= '/';
		}
	}
	return $path;
}

/**
* Gets cookie domain from url
* @param string The url
*/
function getCookieDomain( $url ) {
	$host = URLHost( $url );
	//clear prefix
	$domain = eregi_replace ( "^www\.", "", $host );
	
	if ( !ereg( "\.", $domain) ) {
		//single section domain ( eg. localhost ), then ""
		$domain = "";
	}
	elseif ( ereg( "[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}", $domain) ) {
		//ip address domain ( eg. 192.168.0.1 ), then ""
		$domain = "";
	}
	else {
		// add "." at the beginning of domain
		$domain = "." . $domain;
	}
	
	return $domain;
}

// $internal: 1 = 1year, -1 = expired, 0 = 0, others = $internal + time()
function mamhooCookie($name, $value = "", $internal = 1)
{
	global $mosCookiepath, $mosCookiedomain, $mosConfig_live_site;
	
	$timestamp = time();
	$expires = $internal == 1 ? $timestamp + 31536000 : ( $internal == -1 ? $timestamp - 31536000 : ( $internal == 0 ? 0 : $timestamp + $internal) );
	if (!isset($mosCookiedomain) || empty($mosCookiedomain)) {
		$mosCookiedomain = getCookieDomain( $mosConfig_live_site );
	}
	if (!isset($mosCookiepath) || empty($mosCookiepath)) {
		$mosCookiepath = '/';
	}
	
	$S = $_SERVER['SERVER_PORT']=='443' ? 1:0;
	setcookie($name, $value, $expires, $mosCookiepath, $mosCookiedomain, $S);
}

// ----- NO MORE CLASSES OR FUNCTIONS PASSED THIS POINT -----
// Post class declaration initialisations
// some version of PHP don't allow the instantiation of classes
// before they are defined

/** @global mosPlugin $_MAMBOTS */
$_MAMBOTS = new mosMambotHandler();

function tr( $str )
{
/** @global TR_STRS translation string array */
	global $TR_STRS;
	$strindex = strtolower(trim($str));
	$result = ( array_key_exists($strindex, $TR_STRS) ? $TR_STRS[$strindex] : $str );
	return $result;
}

function UTF8toMamboCharset( $str )
{
	$charset = strtoupper( _CHARSET );
	if ( $charset != 'UTF-8' ) {
		$result = mos_convert_encoding($str, $charset, "UTF-8");
	}
	else {
		$result = $str;
	}
	return $result;
}

//generate menu array Vars
function genMenuVars () {
	global $database;
	global $menuIdVars, $menuPathVars, $homeItemid;
	global $htmlsuffix, $dirsuffix;
	$htmlsuffixtype = array('component_item_link', 'contact_item_link', 'content_item_link', 'content_typed', 'newsfeed_link', 'wrapper');
	$dirsuffixtype = array('components', 'contact_category_table', 'content_blog_category', 'content_blog_section', 'content_category', 'content_section', 'newsfeed_category_table', 'weblink_category_table');
	
	$query = "SELECT `id`, `menutype`, `name`, `sefpath`, `link`, `type`, `componentid`, `parent`, `access` FROM #__menu
			WHERE `published`=1 AND `type`<>'url' AND `type`<>'separator' AND `link` LIKE 'index.php%'
			ORDER BY `menutype`, `parent`, `ordering` ";
	$database->setQuery( $query );
	$menuIdVars = $database->loadObjectList('id');
	$i = 1;
	foreach ($menuIdVars as $key => $value) {
		if (empty($value->sefpath)) {
			$value->sefpath = $value->name;
		}
		if ($i && $value->menutype == 'mainmenu') {
			$i = 0;
			$homeItemid = $value->id;
			$value->sefpath = '';
		}
		$value->sefpath = urlencode(str_replace(' ', '-', $value->sefpath));
		$value->link = str_replace("&amp;", "&", $value->link);
		$temps = explode("?", $value->link);
		if (isset($temps[1])) {
			parse_str($temps[1], $value->linkvars);
			$menuIdVars[$key]->linkvars = $value->linkvars;
		}
		$menuIdVars[$key]->path = $value->sefpath;
		$menuIdVars[$key]->link = $value->link;
		
		if (preg_match("/option=(\w+)/i", $value->link, $matches)) {
			$menuIdVars[$key]->componentname = $matches[1];
		}
		$menuIdVars[$key]->hasChild = FALSE;
		if ($value->parent) {
			$menuIdVars[$value->parent]->hasChild = TRUE;
		}
	}

	//Set path
	foreach ($menuIdVars as $key => $value) {
		if ($value->hasChild) {
			$menuIdVars[$key]->path .= '/';
		}
		else {
			if ( in_array($value->type, $htmlsuffixtype) ) {
				$menuIdVars[$key]->path .= $htmlsuffix;
			}
			else {
				$menuIdVars[$key]->path .= $dirsuffix;
			}
		}
		//Set homepage path to ''
		if ($menuIdVars[$key]->path == $dirsuffix) {
			$menuIdVars[$key]->path = '';
		}
	}
	//Set child path
	foreach ($menuIdVars as $key => $value) {
		if ($value->parent) {
			$menuIdVars[$key]->path = $menuIdVars[$value->parent]->path . $menuIdVars[$key]->path;
		}
	}
	
	//Set final path and menuPathVars
	foreach ($menuIdVars as $key => $value) {
		$menuIdVars[$key]->path = $dirsuffix . $menuIdVars[$key]->path;
		if (!isset($menuPathVars[$menuIdVars[$key]->path])) {
			$menuPathVars[$menuIdVars[$key]->path] = &$menuIdVars[$key];
		}
	}
}

//generate Section and Category array Vars
function genSecCatVars() {
	global $database;
	global $secIdVars, $secPathVars, $catIdVars, $catPathVars;
	
	//gen sections vars
	$query = "SELECT `id`, `name`, `title` FROM #__sections
			WHERE `published`=1 AND `scope`='content'
			ORDER BY `ordering` ";
	$database->setQuery( $query );
	$secIdVars = $database->loadObjectList('id');
	foreach ($secIdVars as $key => $value) {
		$value->name = urlencode(str_replace(' ', '-', $value->name));
		$secIdVars[$key]->path = $value->name;
		$secPathVars[$value->name] = &$secIdVars[$key];
	}

	//gen categories vars
	$query = "SELECT `id`, `parent_id`, `name`, `title`, `section` FROM #__categories
			WHERE `published`=1
			ORDER BY `section`, `ordering` ";
	$database->setQuery( $query );
	$catIdVars = $database->loadObjectList('id');
	foreach ($catIdVars as $key => $value) {
		$catPath = urlencode(str_replace(' ', '-', $value->name)) . '/';
		$catIdVars[$key]->path = $catPath;
		$catPathVars[$value->section][$catPath] = &$catIdVars[$key];
	}

}

function getMenuPathByURL ($link) {
	global $menuIdVars;
	
	$result = NULL;
	$temps = explode("?", $link);
	if (isset($temps[1])) {
		parse_str($temps[1], $stringVars);
	}
	if (isset($stringVars['Itemid']) && $stringVars['Itemid']) {
		$aItemid = $stringVars['Itemid'];
		unset($stringVars['Itemid']);
		if ( isset($menuIdVars[$aItemid]) && (($menuIdVars[$aItemid]->link == $link) || ($menuIdVars[$aItemid]->linkvars == $stringVars))) {
			$result = $menuIdVars[$aItemid]->path;
/*			$parent = $menuIdVars[$aItemid]->parent;
			while ($parent) {
				$result = $menuIdVars[$parent]->name . "/$result";
				$parent = $menuIdVars[$parent]->parent;
			}*/
		}
	}
	return $result;
}

function getMenuItemByPath ($path) {
	global $menuPathVars;
	
	$result = NULL;
	if (isset($menuPathVars[$path])) {
		return $menuPathVars[$path];
	}
	else {
		return $result;
	}

}

/**
* @return Itemid of Content Item
*/
function getContentItemid( $sectionid=0, $catid=0, $id=0 ) {
	global $menuIdVars, $homeItemid;

	if ($id) {
		foreach ($menuIdVars as $key => $value) {
			if (isset($value->linkvars['id']) && ($value->linkvars['id'] == $id) && ($value->type == 'content_item_link' || $value->type == 'content_typed')) {
				return $key;
			}
		}
	}
	
	if ($catid) {
		foreach ($menuIdVars as $key => $value) {
			if (isset($value->linkvars['id']) && ($value->linkvars['id'] == $catid) && ($value->type == 'content_blog_category' || $value->type == 'content_category')) {
				return $key;
			}
		}
	}
	
	if ($sectionid) {
		foreach ($menuIdVars as $key => $value) {
			if (isset($value->linkvars['id']) && ($value->linkvars['id'] == $sectionid) && ($value->type == 'content_blog_section' || $value->type == 'content_section')) {
				return $key;
			}
		}
	}
	
	return $homeItemid;
}

/**
* @return pathway of Itemid
*/
function getMenuPathway( $aItemid, $selflink=false ) {
	global $menuIdVars, $homeItemid, $mosConfig_live_site;
	global $pathwaySeperator;
	
	$result = '';
	$homePathway = $menuIdVars[$homeItemid]->name;
	$homePathwayLink = '<a href="'. $mosConfig_live_site . '">' . $homePathway . '</a>';
	if ($aItemid == $homeItemid) {
			$result = $selflink ? $homePathwayLink : $homePathway;
	}
	else {
		if (isset($menuIdVars[$aItemid])) {
			$aPathway = $menuIdVars[$aItemid]->name;
			$aLink = sefRelToAbs($menuIdVars[$aItemid]->link . "&Itemid=$aItemid");
			$aPathwayLink = '<a href="'. $aLink . '">' . $aPathway . '</a>';
			$result = $selflink ? $aPathwayLink : $aPathway;
			$result = $pathwaySeperator . $result;
			$parentid = $menuIdVars[$aItemid]->parent;
			
			while ($parentid && isset($menuIdVars[$parentid])) {
				$aPathway = $menuIdVars[$parentid]->name;
				$aLink = sefRelToAbs($menuIdVars[$parentid]->link . "&Itemid=$parentid");
				$aPathwayLink = '<a href="'. $aLink . '">' . $aPathway . '</a>';
				$result = $pathwaySeperator . $aPathwayLink . $result;
				$parentid = $menuIdVars[$parentid]->parent;
			}
			$result = $homePathwayLink . $result;
		}
		else {
			$result = $selflink ? $homePathwayLink : $homePathway;
		}
	}
	return $result;
}


function mos_convert_encoding( $str, $to_encoding, $from_encoding )
{
	if (function_exists('mb_convert_encoding')) {
		$result = mb_convert_encoding($str, $to_encoding, $from_encoding);
	}
	elseif (function_exists('iconv')) {
		$result = iconv($from_encoding, $to_encoding, $str);
	}
	else {
		$result = $str;
	}
	return $result;
}


?>
<?php
/**
* @version $Id: index.php,v 1.6 2005/11/21 11:57:20 csouza Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/


/** Set flag that this is a parent file  */
define( '_VALID_MOS', 1 );

// checks for configuration file, if none found loads installation page
if ( !file_exists( 'configuration.php' ) || filesize( 'configuration.php' ) < 10 ) {
	header( 'Location: installation/index.php' );
	exit();
}

require_once( 'configuration.php' );
require_once( 'globals.php' );

/*Installation sub folder check, removed for work with CVS*/
if (file_exists( 'installation/index.php' )) {
	include ('offline.php');
	exit();
}
// displays offline page
if ( $mosConfig_offline == 1 ){
	include( 'offline.php' );
	exit();
}

require_once( 'includes/mambo.php' );
$tstart = mosProfiler::getmicrotime();

$mosCookiedomain = getCookieDomain( $mosConfig_live_site );
$mosCookiepath = '/';
session_name( md5( $mosConfig_live_site . 'frontend' ) );
session_set_cookie_params( 0, $mosCookiepath, $mosCookiedomain );
session_start();

header('Content-type: text/html; ' . _ISO);

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();
genMenuVars();
genSecCatVars();

if (file_exists( 'components/com_sef/sef.php' )) {
	require_once( 'components/com_sef/sef.php' );
} else {
	require_once( 'includes/sef.php' );
}
require_once( 'includes/frontend.php' );

/** retrieve some expected url (or form) arguments */
$option = trim( strtolower( mosGetParam( $_REQUEST, 'option' ) ) );
$Itemid = intval( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
if (empty($option) && empty($Itemid)) {
	$Itemid = $homeItemid;
}

if (empty($option) && $Itemid) {
	$link = $menuIdVars[$Itemid]->link;
	if (($pos = strpos( $link, '?' )) !== false) {
		$link = substr( $link, $pos+1 ). '&Itemid='.$Itemid;
	}
		
	parse_str( $link, $temp );
	/** this is a patch, need to rework when globals are handled better */
	foreach ($temp as $k=>$v) {
		$GLOBALS[$k] = $v;
		$_REQUEST[$k] = $v;
		if ($k == 'option') {
			$option = $v;
		}
	}
}

//************************************************************//
// mamhoo begin
if ( file_exists(  'administrator/components/com_mamhoo/mamhoo.class.php' ) ) {
	require_once( 'administrator/components/com_mamhoo/mamhoo.class.php' );
}
// mamhoo end
//************************************************************//

/** mainframe is an API workhorse, lots of 'core' interaction routines */
$mainframe = new mosMainFrame( $database, $option, '.' );
$mainframe->initSession();


/** patch to lessen the impact on templates */
if ($option == 'search') {
	$option = 'com_search';
}

// frontend login & logout controls
$return = mosGetParam( $_REQUEST, 'return', 'index.php' );
if ($option == 'login') {
	$mainframe->login();

	// JS Popup message
	if ( mosGetParam( $_POST, 'message', 0 ) ) {
		?>
		<script> 
		<!--//
		alert( "<?php echo _LOGIN_SUCCESS; ?>" ); 
		//-->
		</script>
		<?php
	}

	mosRedirect( $return );
}
elseif ($option == "logout") {
	$mainframe->logout();

	// JS Popup message
	if ( mosGetParam( $_POST, 'message', 0 ) ) {
		?>
		<script> 
		<!--//
		alert( "<?php echo _LOGOUT_SUCCESS; ?>" ); 
		//-->
		</script>
		<?php
	}

	mosRedirect( $return );
}

/** get the information about the current user from the sessions table */
$my = $mainframe->getUser();

/** detect first visit */
$mainframe->detect();

$gid = intval( $my->gid );

// gets template for page
$cur_template = $mainframe->getTemplate();
/** temp fix - this feature is currently disabled */

/** @global A places to store information from processing of the component */
$_MOS_OPTION = array();

// precapture the output of the component
require_once( $mosConfig_absolute_path . '/editor/editor.php' );

ob_start();
if ($path = $mainframe->getPath( 'front' )) {
	$task = mosGetParam( $_REQUEST, 'task', '' );
	$ret = mosMenuCheck( $Itemid, $option, $task, $gid );
	if ($ret) {
		require_once( $path );
	} else {
		mosNotAuth();
	}
} else {
	echo _NOT_EXIST;
}
$_MOS_OPTION['buffer'] = ob_get_contents();
ob_end_clean();

initGzip();

header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

// loads template file
if ( !file_exists( 'templates/'. $cur_template .'/index.php' ) ) {
	echo _TEMPLATE_WARN . $cur_template;
} else {
	require_once( 'templates/'. $cur_template .'/index.php' );
	echo "<!-- ".time()." -->";
}

// displays queries performed for page
if ($mosConfig_debug) {
	$tend = mosProfiler::getmicrotime();
	$totaltime = ($tend - $tstart);
	printf("Page was generated in %f seconds<br />", $totaltime);
	$database->displayLogged ();
}

doGzip();
?>
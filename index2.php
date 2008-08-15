<?php
/**
* @version $Id: index2.php,v 1.3 2005/11/21 11:57:20 csouza Exp $
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
$no_html 	= intval( mosGetParam( $_REQUEST, 'no_html', 0 ) );
$Itemid = intval( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
$act 		= mosGetParam( $_REQUEST, 'act', '' );
$do_pdf 	= intval( mosGetParam( $_REQUEST, 'do_pdf', 0 ) );

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


if ($option == 'login') {
	$mainframe->login();
	mosRedirect('index.php');
}
elseif ($option == 'logout') {
	$mainframe->logout();
	mosRedirect( 'index.php' );
}

/** get the information about the current user from the sessions table */
$my = $mainframe->getUser();

/** detect first visit */
$mainframe->detect();

$gid = intval( $my->gid );

// gets template for page
$cur_template = $mainframe->getTemplate();

if ( $do_pdf == 1 ){
	include ('includes/pdf.php');
	exit();
}

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
// start basic HTML
if ( $no_html == 0 ) {
	// needed to seperate the ISO number from the language file constant _ISO
	$iso = split( '=', _ISO );
	// xml prolog
	echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<link rel="stylesheet" href="templates/<?php echo $cur_template;?>/css/template_css.css" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	<meta name="robots" content="noindex, nofollow">
	</head>
	<body class="contentpane">
	<?php mosMainBody(); ?>
	</body>
	</html>
	<?php
} else {
	mosMainBody();
}
doGzip();

?>

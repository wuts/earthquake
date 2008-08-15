<?php
/**
* @version $Id: globals.php,v 1.6 2005/11/26 00:43:58 csouza Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** Set flag that this is a parent file  */
if (!defined('_VALID_MOS')) define( '_VALID_MOS', 1 );

// fix to address the globals overwrite problem in php versions < 4.4.1
$protect_globals = array('_REQUEST', '_GET', '_POST', '_COOKIE', '_FILES', '_SERVER', '_ENV', 'GLOBALS', '_SESSION');
foreach ($protect_globals as $global) {
    if ( in_array($global , array_keys($_REQUEST)) ||
         in_array($global , array_keys($_GET))     ||
         in_array($global , array_keys($_POST))    ||
         in_array($global , array_keys($_COOKIE))  ||
         in_array($global , array_keys($_FILES))) {
        die("Invalid Request.");
    }
}

$config_register_globals = isset($mosConfig_register_globals) ? $mosConfig_register_globals : 1;

// superglobals array
$superglobals = array($_SERVER, $_ENV, $_FILES, $_COOKIE, $_POST, $_GET);
if (isset($_SESSION)) array_unshift ($superglobals , $_SESSION); 

// Emulate register_globals on
if (!ini_get('register_globals') && $config_register_globals) {
    while(list($key,$value)=each($_GET)) {
       if (!isset($GLOBALS[$key])) $GLOBALS[$key]=$value;
    }
    while(list($key,$value)=each($_POST)) {
       if (!isset($GLOBALS[$key])) $GLOBALS[$key]=$value;
    }
}
// Emulate register_globals off
elseif (ini_get('register_globals') && !$config_register_globals) {
   foreach ($superglobals as $superglobal) {
       foreach ($superglobal as $key => $value) {
           unset($GLOBALS[$key]);
           unset( $GLOBALS[$key]);
       }
   }
}

require_once( $mosConfig_absolute_path . '/includes/version.php' );
// loads english language file by default
if ( $mosConfig_lang == '' ) {
	$mosConfig_lang = 'english';
}
require_once( $mosConfig_absolute_path . '/language/'. $mosConfig_lang.'.php' );

$local_backup_path = $mosConfig_absolute_path.'/administrator/backups';
$media_path = $mosConfig_absolute_path.'/media/';
$image_path = $mosConfig_absolute_path.'/images/stories';
$image_size = 100;

$htmlsuffix = '.html';
$dirsuffix = '/';
$curPathway = '';
$pathwaySeperator = '>>->';


resetLivesite();

function resetLivesite() {
	global $mosConfig_live_site;
	$aHost = $_SERVER['SERVER_NAME'];
	$live_site_section = parse_url($mosConfig_live_site);
	if ($aHost != $live_site_section['host']) {
		$mosConfig_live_site = $live_site_section['scheme'] . '://' . $aHost;
		if (isset($live_site_section['port']) && $live_site_section['port'] != '80') {
			$mosConfig_live_site .= ':' . $live_site_section['port'];
		}
		if (isset($live_site_section['path']) && $live_site_section['path'] != '/') {
			$aPath = preg_replace("/(.+)\/$/", "$1", $live_site_section['path']);
			$mosConfig_live_site .= $aPath;
		}
	}
}



?>
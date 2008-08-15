<?php
/**
* $Id: mamhoo_addon.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

define( "_VALID_MOS", 1 );
define( '_MAMHOO_ADDON_', 1 );

$oversion = $version;

require_once( $MAMBO_ABSOLUTE_PATH . "/configuration.php" );
require_once( $mosConfig_absolute_path . "/includes/version.php" );

// loads english language file by default
if ( $mosConfig_lang == '' ) {
	$mosConfig_lang = 'english';
}
include_once ( "$mosConfig_absolute_path/language/$mosConfig_lang.php" );

//get mambo charset
$MAMBO_CHARSET = strtoupper( _CHARSET );
if ( $MAMBO_CHARSET == 'UTF8' ) $MAMBO_CHARSET = 'UTF-8';

require_once( $mosConfig_absolute_path . "/includes/mambo.php" );
$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$acl = new gacl_api();
$option = 'com_mamhoo';
require_once( $mosConfig_absolute_path . '/administrator/components/com_mamhoo/mamhoo.class.php' );
$mainframe = new mosMainFrame( $database, $option, $mosConfig_absolute_path );

$MAMBO_REGISTER_URL = $mosConfig_live_site . '/index.php?option=com_mamhoo&task=register';
$MAMBO_LOSTPASSWORD_URL = $mosConfig_live_site . '/index.php?option=com_mamhoo&task=lostPassword';

//************************************************************//
// mamhoo main class

//************************************************************//

$version = $oversion;
?>
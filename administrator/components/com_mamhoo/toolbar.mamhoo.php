<?php
/**
* $Id: toolbar.mamhoo.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $mainframe, $task;

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

require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );

$element = mosGetParam( $_REQUEST, 'element', '' );

if ( $element == "mamhook" ) {
	TOOLBAR_MAMHOO::INSTALLER_MENU();
}
else {
	switch ($task) {
	
	  case "new":
	    TOOLBAR_MAMHOO::NEW_MENU();
	    break;
	
	  case "edit":
	    TOOLBAR_MAMHOO::EDIT_MENU();
	    break;
	
	  case "config":
	    TOOLBAR_MAMHOO::CONFIG_MENU();
	    break;
	
	  case "about":
	    TOOLBAR_MAMHOO::ABOUT_MENU();
	    break;
	
	  default:
	    TOOLBAR_MAMHOO::DEFAULT_MENU();
	    break;
	}
}
?>
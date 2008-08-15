<?php
/**
* @version $Id: admin.installer.php,v 1.1 2005/07/22 01:52:25 eddieajau Exp $
* @package Mambo
* @subpackage Installer
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// XML library
require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$element 	= mosGetParam( $_REQUEST, 'element', '' );
$client 	= mosGetParam( $_REQUEST, 'client', '' );
$path 		= $mosConfig_absolute_path . "/administrator/components/com_installer/$element/$element.php";

// ensure user has access to this function
if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

// map the element to the required derived class
$classMap = array(
    'component' => 'mosInstallerComponent',
    'language' => 'mosInstallerLanguage',
    'mambot' => 'mosInstallerMambot',
    'module' => 'mosInstallerModule',
    'template' => 'mosInstallerTemplate'
);

if (array_key_exists ( $element, $classMap )) {
	require_once( $mainframe->getPath( 'installer_class', $element ) );

	switch ($task) {

		case 'uploadfile':
		    uploadPackage( $classMap[$element], $option, $element, $client );
			break;

		case 'installfromdir':
			installFromDirectory( $classMap[$element], $option, $element, $client );
			break;

		case 'remove':
		    removeElement( $classMap[$element], $option, $element, $client );
			break;

		default:
			$path = $mosConfig_absolute_path . "/administrator/components/com_installer/$element/$element.php";

			if (file_exists( $path )) {
				require $path;
			} else {
				echo $adminLanguage->A_INSTALL_NOT_FOUND ."[$element]";
			}
		    break;
	}
} else {
	echo $adminLanguage->A_INSTALL_NOT_AVAIL ."[$element]";
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/
function uploadPackage( $installerClass, $option, $element, $client ) {
	global $mainframe, $adminLanguage;

	$installer = new $installerClass();

	// Check if file uploads are enabled
	if (!(bool)ini_get('file_uploads')) {
		HTML_installer::showInstallMessage( $adminLanguage->A_INSTALL_ENABLE_MSG,
			$adminLanguage->A_INSTALL_ERROR_MSG_TITLE, $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	// Check that the zlib is available
	if(!extension_loaded('zlib')) {
		HTML_installer::showInstallMessage( $adminLanguage->A_INSTALL_ZLIB_MSG,
			$adminLanguage->A_INSTALL_ERROR_MSG_TITLE, $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	$userfile = mosGetParam( $_FILES, 'userfile', null );

	if (!$userfile) {
		HTML_installer::showInstallMessage( $adminLanguage->A_INSTALL_NOFILE_MSG, $adminLanguage->A_INSTALL_NEWMODULE_ERROR_MSG_TITLE,
			$installer->returnTo( $option, $element, $client ));
		exit();
	}

	$userfile_name = $userfile['name'];

	$msg = '';
	$resultdir = uploadFile( $userfile['tmp_name'], $userfile['name'], $msg );

	if ($resultdir !== false) {
		if (!$installer->upload( $userfile['name'] )) {
			HTML_installer::showInstallMessage( $installer->getError(), $adminLanguage->A_INSTALL_UPLOAD_PRE .$element. $adminLanguage->A_INSTALL_UPLOAD_POST,
				$installer->returnTo( $option, $element, $client ) );
		}
		$ret = $installer->install();

		HTML_installer::showInstallMessage( $installer->getError(), $adminLanguage->A_INSTALL_UPLOAD_PRE.$element.' - '.($ret ? $adminLanguage->A_INSTALL_SUCCESS : $adminLanguage->A_INSTALL_FAILED),
			$installer->returnTo( $option, $element, $client ) );
		cleanupInstall( $userfile['name'], $installer->unpackDir() );
	} else {
		HTML_installer::showInstallMessage( $msg, $adminLanguage->A_INSTALL_UPLOAD_PRE.$element. $adminLanguage->A_INSTALL_UPLOAD_POST2,
			$installer->returnTo( $option, $element, $client ) );
	}
}

/**
* Install a template from a directory
* @param string The URL option
*/
function installFromDirectory( $installerClass, $option, $element, $client ) {
	global $adminLanguage;
	$userfile = mosGetParam( $_REQUEST, 'userfile', '' );

	if (!$userfile) {
		mosRedirect( "index2.php?option=$option&element=module", $adminLanguage->A_INSTALL_SELECT_DIR );
	}

	$installer = new $installerClass();

	$path = mosPathName( $userfile );
	if (!is_dir( $path )) {
		$path = dirname( $path );
	}

	$ret = $installer->install( $path );
	HTML_installer::showInstallMessage( $installer->getError(), $adminLanguage->A_INSTALL_UPLOAD_NEW.$element.' - '.($ret ? $adminLanguage->A_INSTALL_SUCCESS : $adminLanguage->A_INSTALL_ERROR),
		$installer->returnTo( $option, $element, $client ) );
}
/**
*
* @param
*/
function removeElement( $installerClass, $option, $element, $client ) {
	global $adminLanguage;
	$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
	if (!is_array( $cid )) {
	    $cid = array(0);
	}

	$installer = new $installerClass();
	$result = false;
	if ($cid[0]) {
	    $result = $installer->uninstall( $cid[0], $option, $client );
	}

	$msg = $installer->getError();

	mosRedirect( $installer->returnTo( $option, $element, $client ), $result ? $adminLanguage->A_INSTALL_SUCCESS . $msg : $adminLanguage->A_INSTALL_FAILED . ' ' . $msg );
}
/**
* @param string The name of the php (temporary) uploaded file
* @param string The name of the file to put in the temp directory
* @param string The message to return
*/
function uploadFile( $filename, $userfile_name, &$msg ) {
	global $mosConfig_absolute_path, $adminLanguage;
	$baseDir = mosPathName( $mosConfig_absolute_path . '/media' );

	if (file_exists( $baseDir )) {
		if (is_writable( $baseDir )) {
			if (move_uploaded_file( $filename, $baseDir . $userfile_name )) {
			    if (mosChmod( $baseDir . $userfile_name )) {
			        return true;
				} else {
					$msg = $adminLanguage->A_INSTALL_FAIL_PERMISSION;
				}
			} else {
				$msg = $adminLanguage->A_INSTALL_FAIL_MOVE;
			}
		} else {
		    $msg = $adminLanguage->A_INSTALL_FAIL_WRITE;
		}
	} else {
	    $msg = $adminLanguage->A_INSTALL_FAIL_EXIST;
	}
	return false;
}
?>
<?php
/**
* $Id: mamhook.php,v 3.0  2007-05-31
* @package Mamhoo
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// XML library
require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
require_once( $mosConfig_absolute_path . "/administrator/components/com_mamhoo/installer/mamhook.html.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_mamhoo/installer/mamhook.class.php" );

	switch ($task) {

		case 'uploadfile':
		    uploadPackage( 'mosInstallerMamhook', $option, $element, $client );
			break;

		case 'installfromdir':
			installFromDirectory( 'mosInstallerMamhook', $option, $element, $client );
			break;

		case 'remove':
		    removeElement( 'mosInstallerMamhook', $option, $element, $client );
			break;

		case 'AddonConfig':
			showAddonConfig( $option );
			break;
			
		default:
			$addon_tableprefix = trim( mosGetParam( $_COOKIE, 'mamhook_addon_tableprefix', '' ) );
			$addon_relativepath = trim( mosGetParam( $_COOKIE, 'mamhook_addon_relativepath', '' ) );
			HTML_MAMHOOK::showAddonConfigForm (_MAMHOO_INSTALL_INSTALL_MAMHOOK, $option, 'mamhook', '', $addon_tableprefix, $addon_relativepath );
		    break;
	}
	

showInstalledMamhooks( $option );

function showAddonConfig( $option )
{
	global $mosConfig_absolute_path;
	
	// check the input of addon_tableprefix and addon_relativepath
	$addon_tableprefix = trim( mosGetParam( $_POST, 'addon_tableprefix', '' ) );
	$addon_relativepath = trim( mosGetParam( $_POST, 'addon_relativepath', '' ) );

	mamhooCookie('mamhook_addon_tableprefix', $addon_tableprefix,1);
	mamhooCookie('mamhook_addon_relativepath', $addon_relativepath,1);
	
	if (!$addon_tableprefix) {
		echo "<script> alert('"._MAMHOO_INSTALL_ADDON_TABLEPREFIX_REQUIRED."'); window.history.go(-1); </script>\n";
		exit();
	} else if (!$addon_relativepath) {
		echo "<script> alert('"._MAMHOO_INSTALL_ADDON_RELATIVE_PATH_REQUIRED."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	//check valid addon system table prefix
	checkTableExist( $addon_tableprefix );
	
	//check valid addon system relative path
	$addon_path = mosPathName( mosPathName( $mosConfig_absolute_path ) . $addon_relativepath );
	if ( !is_dir( $addon_path ) ) {
		echo "<script> alert('" . _MAMHOO_INSTALL_ADDON_PATH_NOTEXIST . "\"" . addslashes($addon_path)."\" " . "'); window.history.go(-1); </script>\n";
		exit();
	}

	$txt = array();
	$txt[] = "addon_tableprefix=$addon_tableprefix";
	$txt[] = "addon_relativepath=$addon_relativepath";
	$client = implode( "\n", $txt );

	HTML_MAMHOOK::showInstallForm( _MAMHOO_INSTALL_INSTALL_MAMHOOK, $option, 'mamhook', $client, dirname(__FILE__) );
?>
	<table class="content">
	<?php
	writableCell( 'components/com_mamhoo' );
	writableCell( 'components/com_mamhoo/mamhooks' );
	writableCell( $addon_relativepath );
?>
	</table>

<?php
}

function showInstalledMamhooks( $_option ) {
	global $database, $mosConfig_absolute_path;

	$database->setQuery( "SELECT id, name, folder, element, client_id"
	. "\n FROM #__mamhooks"
	. "\n WHERE iscore='0'"
	. "\n ORDER BY folder, name"
	);
	$rows = $database->loadObjectList();

	// path to mamhook directory
	$mamhookBaseDir	= mosPathName( mosPathName( $mosConfig_absolute_path ) . "components/com_mamhoo/mamhooks" );

	$xmlfile = '';
	$n = count( $rows );
	for ($i = 0; $i < $n; $i++) {
		$row =& $rows[$i];
		// xml file for mambo hooks
		$xmlfile = mosPathName ($mamhookBaseDir. "/" .$row->folder ) . $row->element .".xml";

		$xmlDoc =& new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		if (!$xmlDoc->loadXML( $xmlfile, false, true )) {
			continue;
		}

		$element = &$xmlDoc->documentElement;

		if ($element->getTagName() != 'mosinstall') {
			continue;
		}
		if ($element->getAttribute( "type" ) != "mamhook") {
			continue;
		}

		$element = &$xmlDoc->getElementsByPath('creationDate', 1);
		$row->creationdate = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('author', 1);
		$row->author = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('copyright', 1);
		$row->copyright = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('authorEmail', 1);
		$row->authorEmail = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('authorUrl', 1);
		$row->authorUrl = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('version', 1);
		$row->version = $element ? $element->getText() : '';
	}

	HTML_MAMHOOK::showInstalledMamhooks( $rows, $_option );
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/
function uploadPackage( $installerClass, $option, $element, $client ) {
	global $mainframe;

	$installer = new $installerClass();

	// Check if file uploads are enabled
	if (!(bool)ini_get('file_uploads')) {
		HTML_MAMHOOK::showInstallMessage( _MAMHOO_INSTALL_ENABLE_MSG,
			_MAMHOO_INSTALL_ERROR_MSG_TITLE, $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	// Check that the zlib is available
	if(!extension_loaded('zlib')) {
		HTML_MAMHOOK::showInstallMessage( _MAMHOO_INSTALL_ZLIB_MSG,
			_MAMHOO_INSTALL_ERROR_MSG_TITLE, $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	$userfile = mosGetParam( $_FILES, 'userfile', null );

	if (!$userfile) {
		HTML_MAMHOOK::showInstallMessage( _MAMHOO_INSTALL_NOFILE_MSG, _MAMHOO_INSTALL_NEWMODULE_ERROR_MSG_TITLE,
			$installer->returnTo( $option, $element, $client ));
		exit();
	}

	$userfile_name = $userfile['name'];

	$msg = '';
	$resultdir = uploadFile( $userfile['tmp_name'], $userfile['name'], $msg );

	if ($resultdir !== false) {
		if (!$installer->upload( $userfile['name'] )) {
			HTML_MAMHOOK::showInstallMessage( $installer->getError(), _MAMHOO_INSTALL_UPLOAD_PRE .$element. _MAMHOO_INSTALL_UPLOAD_POST,
				$installer->returnTo( $option, $element, $client ) );
		}
		$ret = $installer->install();

		HTML_MAMHOOK::showInstallMessage( $installer->getError(), _MAMHOO_INSTALL_UPLOAD_PRE.$element.' - '.($ret ? _MAMHOO_INSTALL_SUCCESS : _MAMHOO_INSTALL_FAILED),
			$installer->returnTo( $option, $element, $client ) );
		cleanupInstall( $userfile['name'], $installer->unpackDir() );
	} else {
		HTML_MAMHOOK::showInstallMessage( $msg, _MAMHOO_INSTALL_UPLOAD_PRE.$element. _MAMHOO_INSTALL_UPLOAD_POST2,
			$installer->returnTo( $option, $element, $client ) );
	}
}

/**
* Install a template from a directory
* @param string The URL option
*/
function installFromDirectory( $installerClass, $option, $element, $client ) {
	$userfile = mosGetParam( $_REQUEST, 'userfile', '' );

	if (!$userfile) {
		mosRedirect( "index2.php?option=$option&element=module", _MAMHOO_INSTALL_SELECT_DIR );
	}

	$installer = new $installerClass();

	$path = mosPathName( $userfile );
	if (!is_dir( $path )) {
		$path = dirname( $path );
	}

	$ret = $installer->install( $path );
	HTML_MAMHOOK::showInstallMessage( $installer->getError(), _MAMHOO_INSTALL_UPLOAD_NEW.$element.' - '.($ret ? _MAMHOO_INSTALL_SUCCESS : _MAMHOO_INSTALL_ERROR),
		$installer->returnTo( $option, $element, $client ) );
}
/**
*
* @param
*/
function removeElement( $installerClass, $option, $element, $client ) {
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

	mosRedirect( $installer->returnTo( $option, $element, $client ), $result ? _MAMHOO_INSTALL_SUCCESS . $msg : _MAMHOO_INSTALL_FAILED . ' ' . $msg );
}
/**
* @param string The name of the php (temporary) uploaded file
* @param string The name of the file to put in the temp directory
* @param string The message to return
*/
function uploadFile( $filename, $userfile_name, &$msg ) {
	global $mosConfig_absolute_path;
	$baseDir = mosPathName( $mosConfig_absolute_path . '/media' );

	if (file_exists( $baseDir )) {
		if (is_writable( $baseDir )) {
			if (move_uploaded_file( $filename, $baseDir . $userfile_name )) {
			    if (mosChmod( $baseDir . $userfile_name )) {
			        return true;
				} else {
					$msg = _MAMHOO_INSTALL_FAIL_PERMISSION;
				}
			} else {
				$msg = _MAMHOO_INSTALL_FAIL_MOVE;
			}
		} else {
		    $msg = _MAMHOO_INSTALL_FAIL_WRITE;
		}
	} else {
	    $msg = _MAMHOO_INSTALL_FAIL_EXIST;
	}
	return false;
}

function checkTableExist( $tableprefix ) {
	global $database;
	$userTables = array('members', 'user', 'users');
	$result = false;
	foreach ($userTables as $userTable) {
		$userTableName = $tableprefix . $userTable;
		$query = "SELECT 1 from $userTableName limit 1";
		$database->setQuery( $query );
		$result = $database->query();
		if ( $result ) break;
	}
	if ( !$result ) {
		echo "<script> alert('"._MAMHOO_INSTALL_ADDON_TABLEPREFIX_INVALID."'); window.history.go(-1); </script>\n";
		exit();
	}
}
?>
<?php
/**
* @package Mambo Open Source
* @copyright (C) 2005 - 2006 Mambo Foundation Inc.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* Mambo was originally developed by Miro (www.miro.com.au) in 2000. Miro assigned
* the copyright in Mambo to The Mambo Foundation in 2005 to ensure
* that Mambo remained free Open Source software owned and managed by the community.
* Mambo is Free Software
*
* $Id: mambofck.php,v 1.4 2006/09/16 21:59:10 cristea Exp $
*
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onInitEditor', 'botMamboFCKInit' );
$_MAMBOTS->registerFunction( 'onGetEditorContents', 'botMamboFCKGetContents' );
$_MAMBOTS->registerFunction( 'onEditorArea', 'botMamboFCKEditorArea' );

/**
* This function enable/disable the PHP browser/upload connector
*/
function mambofck_enable_connector($enabled, $type = 'browser') {
	global $mosConfig_absolute_path, $mosConfig_live_site;
	$enabled_code = "<?php\n\$Config['Enabled'] = true ;\n\$Config['UserFilesPath'] = '$mosConfig_live_site/images/stories/' ;\n\$Config['UserFilesAbsolutePath'] = '$mosConfig_absolute_path/images/stories/' ;\n?>\n";

	$files = array(
		'browser'	=>	'browser/default/connectors/php/config.php',
		'upload'	=>	'upload/php/config.php'
	);
	$file = $mosConfig_absolute_path . '/mambots/editors/mambofck/FCKeditor/editor/filemanager/' . $files[$type];
	$file_contents = file_get_contents($file);
	$file_contents = str_replace($enabled_code, '', $file_contents);
	if ($enabled) {
		$file_contents .= $enabled_code;
	}
	$fh = fopen($file, 'w');
	fwrite($fh, $file_contents);
	fclose($fh);
}

/**
* FCKeditor WYSIWYG Editor - javascript initialisation
*/
function botMamboFCKInit() {
	global $mosConfig_live_site, $database, $mosConfig_absolute_path, $mosConfig_lang;
	$js_init = '<script type="text/javascript" src="' . $mosConfig_live_site . '/mambots/editors/mambofck/FCKeditor/fckeditor.js"></script>';
/*	$browser_set = $upload_set = 0;

	$query = "SELECT id FROM #__mambots WHERE element = 'mambofck' AND folder = 'editors'";
	$database->setQuery( $query );
	$id = $database->loadResult();
	$mambot = new mosMambot( $database );
	$mambot->load( $id );
	$params =& new mosParameters( $mambot->params );
	
	// MamboFCK was not configured yet, no parameters are read from database...
	// simply use default mambofck_config.js
	if (empty($params->_params)) {
		return $js_init;
	}
	
	$fck_config = array();
	while (list($k, $v) = each($params->_params)) {

		// is that config key a string?
		if (substr($k, 0, 2) == 's:') {
			$k = substr($k, 2);
			$v = "'$v'";
		}

		// Treat specific values using "case"
		// ordinary values are treated at "default"
		switch ($k) {
			case 'SkinPath':
				$v = str_replace("'", '', $v);
				$fck_config[] = 'FCKConfig.' . $k . " = FCKConfig.BasePath + 'skins/" . $v . "/';";
				$fck_config[] = "FCKConfig.PreloadImages = [ FCKConfig.SkinPath + 'images/toolbar.start.gif', FCKConfig.SkinPath + 'images/toolbar.buttonarrow.gif' ];";
			break;
			case 'DefaultLanguage':
				if ($v == "'default'") {
					$mambo_lng = $mosConfig_lang;
					if (file_exists($mosConfig_absolute_path . '/mambots/editors/mambofck/FCKeditor/editor/lang/' . $mambo_lng . '.js')) {
						$fck_config[] = 'FCKConfig.' . $k . " = '" . $mambo_lng . "';";
						break;
					}
					list($mambo_lng,) = explode('_', $mambo_lng, 2);
					if (strlen($mambo_lng) > 0 && file_exists($mosConfig_absolute_path . '/mambots/editors/mambofck/FCKeditor/editor/lang/' . $mambo_lng . '.js')) {
						$fck_config[] = 'FCKConfig.' . $k . " = '" . $mambo_lng . "';";
					}
					else {
						$fck_config[] = 'FCKConfig.' . $k . ' = \'en\';';
					}
				}
				else {
					$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';	
				}
			break;
			case 'ToolbarSet':
				$v = str_replace('<br />', "\n", $v);
				$fck_config[] = 'FCKConfig.ToolbarSets["Mambo"] = ' . $v . ';';	
			break;
			case 'LinkBrowser':
				$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';
				if ($v == 1) {
					$fck_config[] = "FCKConfig.LinkBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Connector=connectors/php/connector.php';";
					$fck_config[] = "FCKConfig.LinkBrowserWindowWidth	= FCKConfig.ScreenWidth * 0.7 ;		// 70%";
					$fck_config[] = "FCKConfig.LinkBrowserWindowHeight	= FCKConfig.ScreenHeight * 0.7 ;	// 70%";
					$browser_set++;
				}
			break;
			case 'ImageBrowser':
				$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';
				if ($v == 1) {
					$fck_config[] = "FCKConfig.ImageBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Image&Connector=connectors/php/connector.php';";
					$fck_config[] = "FCKConfig.ImageBrowserWindowWidth  = FCKConfig.ScreenWidth * 0.7 ;	// 70%";
					$fck_config[] = "FCKConfig.ImageBrowserWindowHeight = FCKConfig.ScreenHeight * 0.7 ;	// 70%";
					$browser_set++;
				}
			break;
			case 'FlashBrowser':
				$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';
				if ($v == 1) {
					$fck_config[] = "FCKConfig.FlashBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Flash&Connector=connectors/php/connector.php';";
					$fck_config[] = "FCKConfig.FlashBrowserWindowWidth  = FCKConfig.ScreenWidth * 0.7 ;	//70% ;";
					$fck_config[] = "FCKConfig.FlashBrowserWindowHeight = FCKConfig.ScreenHeight * 0.7 ;	//70% ;";
					$browser_set++;
				}
			break;
			case 'LinkUpload':
				$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';
				if ($v == 1) {
					$fck_config[] = "FCKConfig.LinkUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php';";
					$fck_config[] = "FCKConfig.LinkUploadAllowedExtensions	= '';			// empty for all";
					$fck_config[] = "FCKConfig.LinkUploadDeniedExtensions	= '.(php|php3|php5|phtml|asp|aspx|ascx|jsp|cfm|cfc|pl|bat|exe|dll|reg|cgi)$' ;	// empty for no one";
					$upload_set++;
				}
			break;
			case 'ImageUpload':
				$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';
				if ($v == 1) {
					$fck_config[] = "FCKConfig.ImageUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php?Type=Image';";
					$fck_config[] = "FCKConfig.ImageUploadAllowedExtensions	= '.(jpg|gif|jpeg|png)$' ;		// empty for all";
					$fck_config[] = "FCKConfig.ImageUploadDeniedExtensions	= '' ;					// empty for no one";
					$upload_set++;
				}
			break;
			case 'FlashUpload':
				$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';
				if ($v == 1) {
					$fck_config[] = "FCKConfig.FlashUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php?Type=Flash';";
					$fck_config[] = "FCKConfig.FlashUploadAllowedExtensions	= '.(swf|fla)$' ;		// empty for all";
					$fck_config[] = "FCKConfig.FlashUploadDeniedExtensions	= '' ;					// empty for no one";
					$upload_set++;
				}
			break;
			default:
				$fck_config[] = 'FCKConfig.' . $k . ' = ' . $v . ';';
		}
	}
	
	// register Mambo plugin
	$fck_config[] = "FCKConfig.Plugins.Add('mambofck', 'en,ro', FCKConfig.BasePath.replace(new RegExp('FCKeditor\\/editor\\/\$', 'gi'), ''));";

	// enable or disable the browser connector
	//mambofck_enable_connector(($browser_set > 0));

	// enable or disable the upload connector
	//mambofck_enable_connector(($upload_set > 0), 'upload');

	// prepare the custom config file content
	$fck_config = implode("\n", $fck_config);

	// dump the custom config file contents
	$fh = fopen($mosConfig_absolute_path . '/mambots/editors/mambofck/mambofck_config.js', 'w');
	fwrite($fh, $fck_config);
	fclose($fh);
*/
	return $js_init;
}
/**
* FCKeditor WYSIWYG Editor - copy editor contents to form field
* @param string The name of the editor area
* @param string The name of the form field
*/
function botMamboFCKGetContents( $editorArea, $hiddenField ) {
	return <<<EOD

EOD;
}
/**
* FCKeditor WYSIWYG Editor - display the editor
* @param string The name of the editor area
* @param string The content of the field
* @param string The name of the form field
* @param string The width of the editor area
* @param string The height of the editor area
* @param int The number of columns for the editor area
* @param int The number of rows for the editor area
*/
function botMamboFCKEditorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
	global $mosConfig_live_site;
	$content = ereg_replace("\n|\r", ' ', $content);
	$content = str_replace(
					array('&amp;', '&lt;', '&gt;', '&quot;'),
					array('&', '<', '>', '"'),
					$content
	);
	return <<<EOD
<script type="text/javascript">
  var oFCKeditor = new FCKeditor('$hiddenField');
  oFCKeditor.Config['CustomConfigurationsPath'] = '$mosConfig_live_site/mambots/editors/mambofck/mambofck_config.js';
  oFCKeditor.BasePath = '$mosConfig_live_site/mambots/editors/mambofck/FCKeditor/';
  oFCKeditor.Value = '$content';
  oFCKeditor.Width = '$width';
  oFCKeditor.Height = '$height';
  oFCKeditor.ToolbarSet = 'Mambo';
  oFCKeditor.Create();
</script>
EOD;
}
?>

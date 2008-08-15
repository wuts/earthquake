<?php
/**
* @version $Id: admin.admin.html.php,v 1.3 2005/11/08 10:26:19 eliasan Exp $
* @package Mambo Open Source
* @subpackage Admin
* @copyright (C) 2005 - 2006 Mambo Foundation Inc.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* Mambo was originally developed by Miro (www.miro.com.au) in 2000. Miro assigned the copyright in Mambo to The Mambo Foundation in 2005 to ensure
* that Mambo remained free Open Source software owned and managed by the community.
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Admin
*/
class HTML_admin_misc {

	/**
	* Control panel
	*/
	function controlPanel() {
	    global $mosConfig_absolute_path, $mainframe, $adminLanguage;
		?>
		<table class="adminheading" border="0">
		<tr>
			<th class="cpanel">
			<?php echo $adminLanguage->A_COMP_ADMIN_HOME;?>
			</th>
		</tr>
		</table>
		<?php
		$path = $mosConfig_absolute_path . '/administrator/templates/' . $mainframe->getTemplate() . '/cpanel.php';
		if (file_exists( $path )) {
		    require $path;
		} else {
		    echo '<br />';
			mosLoadAdminModules( 'cpanel', 1 );
		}
	}

	function get_php_setting($val) {
		$r =  (ini_get($val) == '1' ? 1 : 0);
		return $r ? 'ON' : 'OFF';
	}

	function get_server_software() {
		if (isset($_SERVER['SERVER_SOFTWARE'])) {
			return $_SERVER['SERVER_SOFTWARE'];
		} else if (($sf = getenv('SERVER_SOFTWARE'))) {
			return $sf;
		} else {
			return 'n/a';
		}
	}

	function system_info( $version ) {
		global $mosConfig_absolute_path, $database, $adminLanguage;
		//$tab = mosGetParam( $_REQUEST, 'tab', 'tab1' );
		$width = 400;	// width of 100%
		$tabs = new mosTabs(0);
		?>

		<table class="adminheading">
		<tr>
			<th class="info">
			<?php echo $adminLanguage->A_COMP_ADMIN_INFO;?>
			</th>
		</tr>
		</table>
		<?php
		$tabs->startPane("sysinfo");
		$tabs->startTab($adminLanguage->A_MENU_SYSTEM_INFO,"system-page");
		?>
		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo $adminLanguage->A_COMP_ADMIN_SYSTEM;?>
			</th>
		</tr>
		<tr>
			<td valign="top" width="250">
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_PHP_BUILT_ON;?>
			</b>
			</td>
			<td>
			<?php echo php_uname(); ?>
			</td>
		</tr>
		<tr>
			<td>
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_DB;?>
			</b>
			</td>
			<td>
			<?php echo mysql_get_server_info(); ?>
			</td>
		</tr>
		<tr>
			<td>
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_PHP_VERSION;?>
			</b>
			</td>
			<td>
			<?php echo phpversion(); ?>
			</td>
		</tr>
		<tr>
			<td>
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_SERVER;?>
			</b>
			</td>
			<td>
			<?php echo HTML_admin_misc::get_server_software(); ?>
			</td>
		</tr>
		<tr>
			<td>
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_SERVER_TO_PHP;?>
			</b>
			</td>
			<td>
			<?php echo php_sapi_name(); ?>
			</td>
		</tr>
		<tr>
			<td>
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_MAMBO_VERSION;?>
			</b>
			</td>
			<td>
			<?php echo $version; ?>
			</td>
		</tr>
		<tr>
			<td>
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_AGENT;?>
			</b>
			</td>
			<td>
			<?php echo phpversion() <= "4.2.1" ? getenv( "HTTP_USER_AGENT" ) : $_SERVER['HTTP_USER_AGENT'];?>
			</td>
		</tr>
		<tr>
			<td valign="top">
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_SETTINGS;?>
			</b>
			</td>
			<td>
				<table cellspacing="1" cellpadding="1" border="0">
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_MODE;?>
					</td>
					<td>
					<?php echo HTML_admin_misc::get_php_setting('safe_mode'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_BASEDIR;?>
					</td>
					<td>
					<?php echo (($ob = ini_get('open_basedir')) ? $ob : 'none'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_ERRORS;?>
					</td>
					<td>
					<?php echo HTML_admin_misc::get_php_setting('display_errors'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_OPEN_TAGS;?>
					</td>
					<td>
					<?php echo HTML_admin_misc::get_php_setting('short_open_tag'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_FILE_UPLOADS;?>
					</td>
					<td>
					<?php echo HTML_admin_misc::get_php_setting('file_uploads'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_QUOTES;?>
					</td>
					<td>
					<?php echo HTML_admin_misc::get_php_setting('magic_quotes_gpc'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_REG_GLOBALS;?>
					</td>
					<td>
					<?php echo HTML_admin_misc::get_php_setting('register_globals'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_OUTPUT_BUFF;?>
					</td>
					<td>
					<?php echo HTML_admin_misc::get_php_setting('output_buffering'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_S_SAVE_PATH;?>
					</td>
					<td>
					<?php echo (($sp=ini_get('session.save_path'))?$sp:'none'); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_S_AUTO_START;?>
					</td>
					<td>
					<?php echo intval( ini_get( 'session.auto_start' ) ); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_XML;?>
					</td>
					<td>
					<?php echo extension_loaded('xml')?'Yes':'No'; ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_ZLIB;?>
					</td>
					<td>
					<?php echo extension_loaded('zlib')?'Yes':'No'; ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_DISABLED;?>
					</td>
					<td>
					<?php echo (($df=ini_get('disable_functions'))?$df:'none'); ?>
					</td>
				</tr>
				<?php
				$query = "SELECT name FROM #__mambots"
				. "\nWHERE folder='editors' AND published='1'"
				. "\nLIMIT 1";
				$database->setQuery( $query );
				$editor = $database->loadResult();
				?>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ADMIN_WYSIWYG;?>
					</td>
					<td>
					<?php echo $editor; ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">
			<b>
			<?php echo $adminLanguage->A_COMP_ADMIN_CONF_FILE;?>
			</b>
			</td>
			<td>
			<?php
			$cf = file( $mosConfig_absolute_path . '/configuration.php' );
			foreach ($cf as $k=>$v) {
				if (eregi( 'mosConfig_host', $v)) {
					$cf[$k] = '$mosConfig_host = \'xxxxxx\'';
				} else if (eregi( 'mosConfig_user', $v)) {
					$cf[$k] = '$mosConfig_user = \'xxxxxx\'';
				} else if (eregi( 'mosConfig_password', $v)) {
					$cf[$k] = '$mosConfig_password = \'xxxxxx\'';
				} else if (eregi( 'mosConfig_db ', $v)) {
					$cf[$k] = '$mosConfig_db = \'xxxxxx\'';
				} else if (eregi( '<?php', $v)) {
					$cf[$k] = '&lt;?php';
				}
			}
			echo implode( "<br />", $cf );
			?>
			</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_ADMIN_PHP_INFO2,"php-page");
		?>
		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo $adminLanguage->A_COMP_ADMIN_PHP_INFO;?>
			</th>
		</tr>
		<tr>
			<td>
			<?php
			ob_start();
			phpinfo(INFO_GENERAL | INFO_CONFIGURATION | INFO_MODULES);
			$phpinfo = ob_get_contents();
			ob_end_clean();
			preg_match_all('#<body[^>]*>(.*)</body>#siU', $phpinfo, $output);
			$output = preg_replace('#<table#', '<table class="adminlist" align="center"', $output[1][0]);
			$output = preg_replace('#(\w),(\w)#', '\1, \2', $output);
			$output = preg_replace('#border="0" cellpadding="3" width="600"#', 'border="0" cellspacing="1" cellpadding="4" width="95%"', $output);
			$output = preg_replace('#<hr />#', '', $output);
			echo $output;
			?>
			</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_ADMIN_PERMISSIONS,"perms");
		?>
		<table class="adminform">
          <tr>
            <th colspan="2"><?php echo $adminLanguage->A_COMP_ADMIN_DIR_PERM;?></th>
          </tr>
          <tr>
            <td>
        <strong><?php echo $adminLanguage->A_COMP_ADMIN_FOR_ALL;?></strong>
			<?php
mosHTML::writableCell( 'administrator/backups' );
mosHTML::writableCell( 'administrator/components' );
mosHTML::writableCell( 'administrator/modules' );
mosHTML::writableCell( 'administrator/templates' );
mosHTML::writableCell( 'cache' );
mosHTML::writableCell( 'components' );
mosHTML::writableCell( 'images' );
mosHTML::writableCell( 'images/banners' );
mosHTML::writableCell( 'images/stories' );
mosHTML::writableCell( 'language' );
mosHTML::writableCell( 'mambots' );
mosHTML::writableCell( 'mambots/content' );
mosHTML::writableCell( 'mambots/search' );
mosHTML::writableCell( 'media' );
mosHTML::writableCell( 'modules' );
mosHTML::writableCell( 'templates' );

?>

            </td>
          </tr>
        </table>
		<?php
		$tabs->endTab();
		$tabs->endPane();
		?>
		<?php
	}

	function ListComponents() {
			mosLoadAdminModule( 'components' );
		}

	/**
	* Display Help Page
	*/
	function help() {
		global $mosConfig_live_site, $adminLanguage;
		//$helpUrl = mosGetParam( $GLOBALS, 'mosConfig_helpurl', '' );
		//$helpUrl = empty($helpUrl) ? 'http://www.mambochina.net' : $helpUrl;
		$helpUrl = 'http://www.mambochina.net';
		//$fullhelpurl = $helpurl . '/index2.php?option=com_content&amp;task=findkey&pop=1&keyref=';  // This line don't used?  NineKrit
		$fullhelpurl = $helpUrl.'/help/';
//      $helpexit=file_exists( $helpurl.'/help/454.mambo.whatsnew.html' );
		$helpexit=true;
		$helpsearch = mosGetParam( $_REQUEST, 'helpsearch', '' );
		$page 		= mosGetParam( $_REQUEST, 'page', '454.mambo.whatsnew.html' );
		$toc 		= getHelpToc( $helpsearch );
		if (!eregi( '\.html$', $page )) {
			$page .= '.html';
		}
		?>
		<style type="text/css">
		.helpIndex {
			border: 0px;
			width: 95%;
			height: 100%;
			padding: 0px 5px 0px 10px;
			overflow: auto;
		}
		.helpFrame {
			border-left: 0px solid #222;
			border-right: none;
			border-top: none;
			border-bottom: none;
			width: 100%;
			height: 700px;
			padding: 0px 5px 0px 10px;
		}
		</style>
		<form name="adminForm">
		<table class="adminform" border="1">
		<tr>
			<th colspan="2" class="title">
			<?php echo $adminLanguage->A_HELP;?>
			</th>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
				<tr>
					<td>
					<strong>Search:</strong>
					<input class="text_area" type="hidden" name="option" value="com_admin" />
					<input type="text" name="helpsearch" value="<?php echo $helpsearch;?>" class="inputbox" />
					<input type="submit" value="Go" class="button" />
					<input type="button" value="Clear Results" class="button" onclick="f=document.adminForm;f.helpsearch.value='';f.submit()" />
					</td>
					<td style="text-align:right">
					<?php
//					if ($helpurl) {    // change to check the exist file
					if ($helpexit) {
					?>
					<a href="<?php echo $fullhelpurl;?>454.mambo.glossary.html" target="helpFrame">
						Glossary</a>
					|
					<a href="<?php echo $fullhelpurl;?>454.mambo.credits.html" target="helpFrame">
						Credits</a>
					|
					<a href="<?php echo $fullhelpurl;?>454.mambo.support.html" target="helpFrame">
						Support</a>
					<?php
					} else {
					?>
					<a href="<?php echo $mosConfig_live_site;?>/help/454.mambo.glossary.html" target="helpFrame">
						Glossary</a>
					|
					<a href="<?php echo $mosConfig_live_site;?>/help/454.mambo.credits.html" target="helpFrame">
						Credits</a>
					|
					<a href="<?php echo $mosConfig_live_site;?>/help/454.mambo.support.html" target="helpFrame">
						Support</a>
					<?php
					}
					?>
					|
					<a href="http://www.gnu.org/copyleft/gpl.html" target="helpFrame">
						License</a>
					|
					<a href="http://www.mambochina.net" target="_blank">
						mambochina.net</a>
					|
					<a href="<?php echo $mosConfig_live_site;?>/administrator/index2.php?option=com_admin&task=sysinfo&no_html=1" target="helpFrame">
						System Info</a>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr valign="top">
			<td width="20%" valign="top">
				<strong><?php echo $adminLanguage->A_COMP_ADMIN_INDEX;?></strong>
				<div class="helpIndex">
				<?php
				foreach ($toc as $k=>$v) {
//					if ($helpurl) {
				if ($helpexit) {
						echo '<br /><a href="' . $fullhelpurl . urlencode( $k ) . '" target="helpFrame">' . $v . '</a>';
					} else {
						echo '<br /><a href="' . $mosConfig_live_site . '/help/' . $k . '" target="helpFrame">' . $v . '</a>';
					}
				}
				?>
				</div>
			</td>
			<td valign="top">
				<iframe name="helpFrame" src="<?php echo $mosConfig_live_site . '/help/' . $page;?>" class="helpFrame" frameborder="0" /></iframe>
			</td>
		</tr>
		</table>
		
		<input type="hidden" name="task" value="help" />
		</form>
		<?php
	}

	/**
	* Preview site
	*/
	function preview( $tp=0 ) {
	    global $mosConfig_live_site;
	    Global $adminLanguage;
	    $tp = intval( $tp );
		?>
		<style type="text/css">
		.previewFrame {
			border: none;
			width: 95%;
			height: 600px;
			padding: 0px 5px 0px 10px;
		}
		</style>
		<table class="adminform">
		<tr>
			<th width="50%" class="title">
			<?php echo $adminLanguage->A_COMP_ADMIN_SITE_PREVIEW;?>
			</th>
			<th width="50%" style="text-align:right">
			<a href="<?php echo $mosConfig_live_site . '/index.php?tp=' . $tp;?>" target="_blank">
			<?php echo $adminLanguage->A_COMP_ADMIN_OPEN_NEW_WIN;?>
			</a>
			</th>
		</tr>
		<tr>
			<td width="100%" valign="top" colspan="2">
			<iframe name="previewFrame" src="<?php echo $mosConfig_live_site . '/index.php?tp=' . $tp;?>" class="previewFrame" /></iframe>
			</td>
		</tr>
		</table>
		<?php
	}
}

/**
 * Compiles the help table of contents
 * @param string A specific keyword on which to filter the resulting list
 */
function getHelpTOC( $helpsearch ) {
	global $mosConfig_absolute_path;
	$helpurl = mosGetParam( $GLOBALS, 'mosConfig_helpurl', '' );
	$helpUrl = empty($helpUrl) ? 'http://www.mambochina.net' : $helpUrl;
	$helpexit=false;

	$files = mosReadDirectory( $mosConfig_absolute_path . '/help/', '\.xml$|\.html$' );

	require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );

	$toc = array();
	foreach ($files as $file) {
		$buffer = file_get_contents( $mosConfig_absolute_path . '/help/' . $file );
		if (preg_match( '#<title>(.*?)</title>#', $buffer, $m )) {
			$title = trim( $m[1] );
			if ($title) {
//				if ($helpurl) {
				if ($helpexit) {
					// strip the extension
					$file = preg_replace( '#\.xml$|\.html$#', '', $file );
				}
		        if ($helpsearch) {
		            if (strpos( strip_tags( $buffer ), $helpsearch ) !== false) {
				    	$toc[$file] = $title;
					}
				} else {
				    $toc[$file] = $title;
				}
			}
		}
		/*
		$xmlDoc =& new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		echo "<br>$file ";
	    if ($xmlDoc->loadXML( $mosConfig_absolute_path . '/help/' . $file, false, true )) {
	    	if (eregi( '\.html$', $file )) {
	    		// html file
	    		$elem = $xmlDoc->getElementsByPath( 'head/title', 1 );
	    	} else {
	    		// xml file
			    $elem = $xmlDoc->getElementsByPath( 'title', 1 );
	    	}
		    if ($elem) {
		        if ($helpsearch) {
		            if (strpos( $xmlDoc->getText(), $helpsearch ) !== false) {
				    	$toc[$file] = $elem->getText();
					}
				} else {
				    $toc[$file] = $elem->getText();
				}
			}
		} else {
			echo $xmlDoc->getErrorString();
	    }
	    */
	}
	asort( $toc );
	return $toc;
}
?>

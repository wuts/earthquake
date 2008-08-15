<?php
/**
* @version $Id: admin.installer.html.php,v 1.1 2005/07/22 01:52:21 eddieajau Exp $
* @package Mambo
* @subpackage Installer
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function writableCell( $folder ) {
	global $adminLanguage;
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="left">';
	echo is_writable( $GLOBALS['mosConfig_absolute_path'] . '/' . $folder ) ? '<b><font color="green">'.$adminLanguage->A_COMP_CONF_WRT.'</font></b>' : '<b><font color="red">'.$adminLanguage->A_COMP_CONF_UNWRT.'</font></b>' . '</td>';
	echo '</tr>';
}

/**
* @package Mambo
*/
class HTML_installer {
	
	function showInstallForm( $title, $option, $element, $client = "", $p_startdir = "", $backLink="" ) {
	global $adminLanguage;
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton3(pressbutton) {
			var form = document.adminForm_dir;
	
			// do field validation
			if (form.userfile.value == ""){
				alert( "<?php echo $adminLanguage->A_INSTALL_SELECT_DIR;?>" );
			} else {
				form.submit();
			}
		}
		</script>
		<form enctype="multipart/form-data" action="index2.php" method="post" name="filename">
		<table class="adminheading">
		<tr>
			<th class="install">
			<?php echo $title;?>
			</th>
			<td align="right" nowrap="true">
			<?php echo $backLink;?>
			</td>
		</tr>
		</table>
		
		<table class="adminform">
		<tr>
			<th>
			<?php echo $adminLanguage->A_INSTALL_UPLOAD_PACK_FILE;?>
			</th>
		</tr>
		<tr>
			<td align="left">
			<?php echo $adminLanguage->A_INSTALL_PACK_FILE;?>:
			<input class="text_area" name="userfile" type="file" size="70"/>
			<input class="button" type="submit" value="<?php echo $adminLanguage->A_INSTALL_UPL_INSTALL;?>" />
			</td>
		</tr>
		</table>
		
		<input type="hidden" name="task" value="uploadfile"/>
		<input type="hidden" name="option" value="<?php echo $option;?>"/>
		<input type="hidden" name="element" value="<?php echo $element;?>"/>
		<input type="hidden" name="client" value="<?php echo $client;?>"/>
		</form>
		<br />
		
		<form enctype="multipart/form-data" action="index2.php" method="post" name="adminForm_dir">
		<table class="adminform">
		<tr>
			<th>
			<?php echo $adminLanguage->A_INSTALL_FROM_DIR;?>
			</th>
		</tr>
		<tr>
			<td align="left">
			<?php echo $adminLanguage->A_INSTALL_DIR;?>:&nbsp;
			<input type="text" name="userfile" class="text_area" size="65" value="<?php echo $p_startdir; ?>"/>&nbsp;
			<input type="button" class="button" value="<?php echo $adminLanguage->A_INSTALL_DO_INSTALL;?>" onclick="submitbutton3()" />
			</td>
		</tr>
		</table>
		
		<input type="hidden" name="task" value="installfromdir" />
		<input type="hidden" name="option" value="<?php echo $option;?>"/>
		<input type="hidden" name="element" value="<?php echo $element;?>"/>
		<input type="hidden" name="client" value="<?php echo $client;?>"/>
		</form>
		<?php
	}
	
	/**
	* @param string
	* @param string
	* @param string
	* @param string
	*/
	function showInstallMessage( $message, $title, $url ) {
		global $PHP_SELF, $adminLanguage;
		?>
		<table class="adminheading">
		<tr>
			<th class="install">
			<?php echo $title; ?>
			</th>
		</tr>
		</table>
		
		<table class="adminform">
		<tr>
			<td align="left">
			<strong><?php echo $message; ?></strong>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			[&nbsp;<a href="<?php echo $url;?>" style="font-size: 16px; font-weight: bold"><?php echo $adminLanguage->A_INSTALL_CONTINUE;?></a>&nbsp;]
			</td>
		</tr>
		</table>
		<?php
	}
}
?>
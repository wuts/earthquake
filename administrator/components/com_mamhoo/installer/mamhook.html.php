<?php
/**
* $Id:  mamhook.html.php,v 3.0  2007-05-31
* @package Mamhoo
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function writableCell( $folder ) {
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="left">';
	echo is_writable( $GLOBALS['mosConfig_absolute_path'] . '/' . $folder ) ? '<b><font color="green">'._MAMHOO_INSTALL_WRITABLE.'</font></b>' : '<b><font color="red">'._MAMHOO_INSTALL_UNWRITABLE.'</font></b>' . '</td>';
	echo '</tr>';
}

/**
* @package Mambo_4.5.1
* @subpackage Installer
*/
class HTML_MAMHOOK {
/**
* Displays the installed non-core mamhook
* @param array An array of mamhook object
* @param strong The URL option
*/

	function showInstallForm( $title, $option, $element, $client = "", $p_startdir = "", $backLink="" ) 
	{
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton3(pressbutton) {
			var form = document.adminForm_dir;
	
			// do field validation
			if (form.userfile.value == ""){
				alert( "<?php echo _MAMHOO_INSTALL_SELECT_DIR;?>" );
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
			<?php echo _MAMHOO_INSTALL_UPLOAD_PACK_FILE;?>
			</th>
		</tr>
		<tr>
			<td align="left">
			<?php echo _MAMHOO_INSTALL_PACK_FILE;?>:
			<input class="text_area" name="userfile" type="file" size="70"/>
			<input class="button" type="submit" value="<?php echo _MAMHOO_INSTALL_UPL_INSTALL;?>" />
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
			<?php echo _MAMHOO_INSTALL_FROM_DIR;?>
			</th>
		</tr>
		<tr>
			<td align="left">
			<?php echo _MAMHOO_INSTALL_DIR;?>:&nbsp;
			<input type="text" name="userfile" class="text_area" size="65" value="<?php echo $p_startdir; ?>"/>&nbsp;
			<input type="button" class="button" value="<?php echo _MAMHOO_INSTALL_DO_INSTALL;?>" onclick="submitbutton3()" />
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
		global $PHP_SELF;
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
			[&nbsp;<a href="<?php echo $url;?>" style="font-size: 16px; font-weight: bold"><?php echo _MAMHOO_INSTALL_CONTINUE;?></a>&nbsp;]
			</td>
		</tr>
		</table>
		<?php
	}
	
	function showInstalledMamhooks( &$rows, $option ) {
		?>
		<table class="adminheading">
		<tr>
			<th class="install">
			<?php echo _MAMHOO_INSTALL_MAMHOOKS; ?>
			</th>
		</tr>
		<tr>
			<td>
			<?php echo _MAMHOO_INSTALL_CORE; ?>
			<br /><br />
			</td>
		</tr>
		</table>
		<?php
		if ( count( $rows ) ) { ?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminlist">
			<tr>
				<th width="20%" class="title">
				<?php echo _MAMHOO_INSTALL_MAMHOOK; ?>
				</th>
				<th width="10%" class="title">
				<?php echo _MAMHOO_INSTALL_TYPE; ?>
				</th>
				<!--
				Currently Unsupported
				<th width="10%" align="left">
				Client
				</th>
				-->
				<th width="10%" align="left">
				<?php echo _MAMHOO_INSTALL_AUTHOR; ?>
				</th>
				<th width="5%" align="center">
				<?php echo _MAMHOO_INSTALL_VERSION; ?>
				</th>
				<th width="10%" align="center">
				<?php echo _MAMHOO_INSTALL_DATE; ?>
				</th>
				<th width="15%" align="left">
				<?php echo _MAMHOO_INSTALL_AUTH_MAIL; ?>
				</th>
				<th width="15%" align="left">
				<?php echo _MAMHOO_INSTALL_AUTH_URL; ?>
				</th>
			</tr>
			<?php
			$rc = 0;
			$n = count( $rows );
			for ($i = 0; $i < $n; $i++) {
			    $row =& $rows[$i];
				?>
				<tr class="<?php echo "row$rc"; ?>">
					<td>
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);">
					<span class="bold">
					<?php echo $row->name; ?>
					</span>
					</td>
					<td>
					<?php echo $row->folder; ?>
					</td>
					<!--
					Currently Unsupported
					<td>
					<?php //echo $row->client_id == "0" ? 'Site' : 'Administrator'; ?>
					</td>
					-->
					<td>
					<?php echo @$row->author != '' ? $row->author : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->version != '' ? $row->version : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->creationdate != '' ? $row->creationdate : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorEmail != '' ? $row->authorEmail : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorUrl != "" ? "<a href=\"" .(substr( $row->authorUrl, 0, 7) == 'http://' ? $row->authorUrl : 'http://'.$row->authorUrl). "\" target=\"_blank\">$row->authorUrl</a>" : "&nbsp;";?>
					</td>
				</tr>
				<?php
				$rc = 1 - $rc;
			}
			?>
			</table>

			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="element" value="mamhook" />
			</form>
			<?php
		} else {
			echo _MAMHOO_INSTALL_NO_MAMHOOKS;
		}
	}

  function showAddonConfigForm( $title, $option, $element, $client, $addon_tableprefix, $addon_relativepath )
  {
  ?>
  <script language="javascript" type="text/javascript">
    function submitbutton3() {
      var form = document.adminForm_addon;

      // do field validation
      if (trim(form.addon_tableprefix.value) == ""){
        alert( "<?php echo _MAMHOO_INSTALL_ADDON_TABLEPREFIX_REQUIRED;?>" );
        form.addon_tableprefix
      } else if (trim(form.addon_relativepath.value) == ""){
        alert( "<?php echo _MAMHOO_INSTALL_ADDON_RELATIVE_PATH_REQUIRED;?>" );
      } else {
        form.submit();
      }
      return;
    }
  </script>
<form action="index2.php" method="post" name="adminForm_addon">
  <input type="hidden" name="task" value="AddonConfig" />
  <input type="hidden" name="option" value="<?php echo $option;?>">
  <input type="hidden" name="element" value="<?php echo $element;?>">
  <input type="hidden" name="client" value="<?php echo $client;?>">
  <table class="adminheading">
    <tr>
      <th><?php echo $title;?></th>
    </tr>
  </table>
  <table class="adminform">
    <tr>
      <th colspan="2" ><?php echo _MAMHOO_INSTALL_ADDON_CONFIG;?></th>
    </tr>
    <tr>
      <td align="Left" width="150"><?php echo _MAMHOO_INSTALL_ADDON_TABLEPREFIX;?>:</td>
      <td>&nbsp;<input class="text" name="addon_tableprefix" type="text" value="<?php echo $addon_tableprefix;?>" size="50"/><?php echo _MAMHOO_INSTALL_ADDON_TABLEPREFIX_EG;?> </td>
    </tr>
    <tr>
      <td align="Left"><?php echo _MAMHOO_INSTALL_ADDON_RELATIVE_PATH;?>:</td>
      <td>&nbsp;<input class="text" name="addon_relativepath" type="text" value="<?php echo $addon_relativepath;?>" size="50"/><?php echo _MAMHOO_INSTALL_ADDON_RELATIVE_PATH_EG;?> </td>
    </tr>
    <tr>
      <td align="Left" colspan="2">&nbsp;<input class="button" type="button" value="<?php echo _MAMHOO_INSTALL_ADDON_NEXT;?>" onclick="submitbutton3()" />
      </td>
    </tr>
  </table>
</form>
<br />

  <?php
  }
}
?>
<?php
/**
* @version $Id: mambot.html.php,v 1.1 2005/07/22 01:52:31 eddieajau Exp $
* @package Mambo
* @subpackage Installer
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Installer
*/
class HTML_mambot {
/**
* Displays the installed non-core Mambot
* @param array An array of mambot object
* @param strong The URL option
*/
	function showInstalledMambots( &$rows, $option ) {
		global $adminLanguage;
		?>
		<table class="adminheading">
		<tr>
			<th class="install">
			<?php echo $adminLanguage->A_INSTALL_MAMB_MAMBOTS; ?>
			</th>
		</tr>
		<tr>
			<td>
			<?php echo $adminLanguage->A_INSTALL_MAMB_CORE; ?>
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
				<?php echo $adminLanguage->A_INSTALL_MAMB_MAMBOT; ?>
				</th>
				<th width="10%" class="title">
				<?php echo $adminLanguage->A_INSTALL_MAMB_TYPE; ?>
				</th>
				<!--
				Currently Unsupported
				<th width="10%" align="left">
				Client
				</th>
				-->
				<th width="10%" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
				<?php echo $adminLanguage->A_INSTALL_MAMB_AUTHOR; ?>
				</th>
				<th width="5%" align="center">
				<?php echo $adminLanguage->A_INSTALL_MAMB_VERSION; ?>
				</th>
				<th width="10%" align="center">
				<?php echo $adminLanguage->A_INSTALL_MAMB_DATE; ?>
				</th>
				<th width="15%" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
				<?php echo $adminLanguage->A_INSTALL_MAMB_AUTH_MAIL; ?>
				</th>
				<th width="15%" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
				<?php echo $adminLanguage->A_INSTALL_MAMB_AUTH_URL; ?>
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
			<input type="hidden" name="option" value="com_installer" />
			<input type="hidden" name="element" value="mambot" />
			</form>
			<?php
		} else {
			echo $adminLanguage->A_INSTALL_MOD_NO_MAMBOTS;
		}
	}
}
?>

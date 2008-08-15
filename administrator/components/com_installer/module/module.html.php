<?php
/**
* @version $Id: module.html.php,v 1.1 2005/07/22 01:52:34 eddieajau Exp $
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
class HTML_module {

	function showInstalledModules( &$rows, $option, &$xmlfile, &$lists ) {
		global $adminLanguage;
		if (count($rows)) {
			?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
			<tr>
				<th class="install">
				<?php echo $adminLanguage->A_INSTALL_MOD_MODS; ?>
				</th>
				<td>
				<?php echo $adminLanguage->A_INSTALL_MOD_FILTER; ?>
				</td>
				<td width="right">
				<?php echo $lists['filter'];?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
				<?php echo $adminLanguage->A_INSTALL_MOD_CORE; ?>
				<br /><br />
				</td>
			</tr>
			</table>

			<table class="adminlist">
			<tr>
				<th width="20%" class="title">
				<?php echo $adminLanguage->A_INSTALL_MOD_MOD; ?>
				</th>
				<th width="10%" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
				<?php echo $adminLanguage->A_INSTALL_MOD_CLIENT; ?>
				</th>
				<th width="10%" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
				<?php echo $adminLanguage->A_INSTALL_MOD_AUTHOR; ?>
				</th>
				<th width="5%" align="center">
				<?php echo $adminLanguage->A_INSTALL_MOD_VERSION; ?>
				</th>
				<th width="10%" align="center">
				<?php echo $adminLanguage->A_INSTALL_MOD_DATE; ?>
				</th>
				<th width="15%" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
				<?php echo $adminLanguage->A_INSTALL_MOD_AUTH_MAIL; ?>
				</th>
				<th width="15%" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
				<?php echo $adminLanguage->A_INSTALL_MOD_AUTH_URL; ?>
				</th>
			</tr>
			<?php
			$rc = 0;
			for ($i = 0, $n = count( $rows ); $i < $n; $i++) {
				$row =& $rows[$i];
				?>
				<tr class="<?php echo "row$rc"; ?>">
					<td>
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);"><span class="bold"><?php echo $row->module; ?></span></td>
					<td>
					<?php echo $row->client_id == "0" ? 'Site' : 'Administrator'; ?>
					</td>
					<td>
					<?php echo @$row->author != "" ? $row->author : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->version != "" ? $row->version : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->creationdate != "" ? $row->creationdate : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorEmail != "" ? $row->authorEmail : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorUrl != "" ? "<a href=\"" .(substr( $row->authorUrl, 0, 7) == 'http://' ? $row->authorUrl : 'http://'.$row->authorUrl) ."\" target=\"_blank\">$row->authorUrl</a>" : "&nbsp;"; ?>
					</td>
				</tr>
				<?php
				$rc = $rc == 0 ? 1 : 0;
			}
		} else {
			?>
			<td class="small">
			<?php echo $adminLanguage->A_INSTALL_MOD_INSTALL_MOD;?>
			</td>
			<?php
		}
		?>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="element" value="module" />
		</form>
		<?php
	}
}
?>

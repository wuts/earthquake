<?php
/**
* @version $Id: admin.languages.html.php,v 1.1 2005/07/22 01:52:34 eddieajau Exp $
* @package Mambo
* @subpackage Languages
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Languages
*/
class HTML_languages {

	function showLanguages( $cur_lang, &$rows, &$pageNav, $option ) {
		global $my, $adminLanguage;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="langmanager"><?php echo $adminLanguage->A_COMP_LANG_INSTALL;?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">#</th>
			<th width="30">&nbsp;</th>
			<th width="25%" class="title"><?php echo $adminLanguage->A_COMP_LANG_LANG;?></th>
			<th width="5%"><?php echo $adminLanguage->A_COMP_PUBLISHED;?></th>
			<th width="10%"><?php echo $adminLanguage->A_COMP_ADMIN_VERSION;?></th>
			<th width="10%"><?php echo $adminLanguage->A_COMP_DATE;?></th>
			<th width="20%"><?php echo $adminLanguage->A_COMP_AUTHOR;?></th>
			<th width="25%"><?php echo $adminLanguage->A_COMP_LANG_EMAIL;?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20"><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td width="20">
				<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->language; ?>" onClick="isChecked(this.checked);" />
				</td>
				<td width="25%">
				<a href="#edit" onclick="hideMainMenu();return listItemTask('cb<?php echo $i;?>','edit_source')"><?php echo $row->name;?></a></td>
				<td width="5%" align="center">
				<?php
				if ($row->published == 1) {	 ?>
				<img src="images/tick.png" alt="<?php echo $adminLanguage->A_COMP_PUBLISHED;?>">
					<?php
				} else {
					?>
					&nbsp;
				<?php
				}
				?>
				</td>
				<td align=center>
				<?php echo $row->version; ?>
				</td>
				<td align=center>
				<?php echo $row->creationdate; ?>
				</td>
				<td align=center>
				<?php echo $row->author; ?>
				</td>
				<td align=center>
				<?php echo $row->authorEmail; ?>
				</td>
			</tr>
		<?php
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function editLanguageSource( $language, &$content, $option ) {
		global $mosConfig_absolute_path, $adminLanguage;
		$language_path = $mosConfig_absolute_path . "/language/" . $language . ".php";
		?>
		<form action="index2.php" method="post" name="adminForm">
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td width="270"><table class="adminheading"><tr><th class="langmanager"><?php echo $adminLanguage->A_COMP_LANG_EDITOR;?></th></tr></table></td>
	        <td width="240">
	            <span class="componentheading"><?php echo $language; ?>.php <?php echo $adminLanguage->A_COMP_CONF_IS;?>:
	            <b><?php echo is_writable($language_path) ? '<font color="green">' . $adminLanguage->A_COMP_CONF_WRT. '</font>' : '<font color="red">' . $adminLanguage->A_COMP_CONF_UNWRT. '</font>' ?></b>
	            </span>
	        </td>
<?php
	        if (mosIsChmodable($language_path)) {
	            if (is_writable($language_path)) {
?>
	        <td>
	            <input type="checkbox" id="disable_write" name="disable_write" value="1"/>
	            <label for="disable_write"><?php echo $adminLanguage->A_COMP_SAVE_UNWRT; ?></label>
	        </td>
<?php
	            } else {
?>
	        <td>
	            <input type="checkbox" id="enable_write" name="enable_write" value="1"/>
	            <label for="enable_write"><?php echo $adminLanguage->A_COMP_OVERRIDE_SAVE; ?></label>
	        </td>
<?php
	            } // if
	        } // if
?>
	    </tr>
	    </table>
		<table class="adminform">
	        <tr><th><?php echo $language_path; ?></th></tr>
	        <tr><td><textarea style="width:100%" cols="110" rows="25" name="filecontent" class="inputbox"><?php echo $content; ?></textarea></td></tr>
		</table>
		<input type="hidden" name="language" value="<?php echo $language; ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		</form>
	<?php
	}

}
?>
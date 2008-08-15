<?php
/**
* @version $Id: admin.massmail.html.php,v 1.1 2005/07/22 01:52:35 eddieajau Exp $
* @package Mambo
* @subpackage Massmail
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Massmail
*/
class HTML_massmail {
	function messageForm( &$lists, $option ) {
        global $adminLanguage;
		?>
		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				// do field validation
				if (form.mm_subject.value == ""){
					alert( "<?php echo $adminLanguage->A_COMP_MASS_SUBJECT;?>" );
				} else if (getSelectedValue('adminForm','mm_group') < 0){
					alert( "<?php echo $adminLanguage->A_COMP_MASS_GROUP;?>" );
				} else if (form.mm_message.value == ""){
					alert( "<?php echo $adminLanguage->A_COMP_MASS_MESSAGE;?>" );
				} else {
					submitform( pressbutton );
				}
			}
		</script>

		<form action="index2.php" name="adminForm" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail">
			<?php echo $adminLanguage->A_COMP_MASS_MAIL;?>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo $adminLanguage->A_COMP_MASS_MAIL;?>
			</th>
		</tr>
		<tr>
			<td width="150" valign="top">
			<?php echo $adminLanguage->A_COMP_MASS_GROUP;?>:
			</td>
			<td width="85%">
			<?php echo $lists['gid']; ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $adminLanguage->A_COMP_MASS_CHILD;?>:
			</td>
			<td>
			<input type="checkbox" name="mm_recurse" value="RECURSE" />
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $adminLanguage->A_COMP_MASS_HTML;?>:
			</td>
			<td>
			<input type="checkbox" name="mm_mode" value="1" />
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $adminLanguage->A_COMP_MASS_SUB;?>:
			</td>
			<td>
			<input class="inputbox" type="text" name="mm_subject" value="" size="50"/>
			</td>
		</tr>
		<tr>
			<td valign="top">
			<?php echo $adminLanguage->A_COMP_MASS_MESS;?>:
			</td>
			<td>
			<textarea cols="80" rows="25" name="mm_message" class="inputbox"></textarea>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>"/>
		<input type="hidden" name="task" value=""/>
		</form>
		<?php
	}
}
?>
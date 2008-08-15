<?php
/**
* @version $Id: admin.users.html.php,v 1.1 2005/07/22 01:53:37 eddieajau Exp $
* @package Mambo
* @subpackage Users
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Users
*/
class HTML_users {

	function showUsers( &$rows, $pageNav, $search, $option, $lists ) {
		global $mosConfig_offset, $adminLanguage;
		?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="user">
			<?php echo $adminLanguage->A_MENU_USER_MANAGE;?>
			</th>
			<td>
			<?php echo $adminLanguage->A_COMP_FILTER;?>:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
			</td>
			<td width="right">
			<?php echo $lists['type'];?>
			</td>
			<td width="right">
			<?php echo $lists['logged'];?>
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="2%" class="title">
			<?php echo $adminLanguage->A_COMP_NB;?>
			</th>
			<th width="3%" class="title">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_COMP_NAME;?>
			</th>
			<th width="5%" class="title" nowrap="nowrap">
			<?php echo $adminLanguage->A_COMP_USERS_LOG_IN;?>
			</th>
			<th width="5%" class="title">
			<?php echo $adminLanguage->A_COMP_STAT_ENABLED;?>
			</th>
			<th width="15%" class="title" >
			<?php echo $adminLanguage->A_COMP_USERS_ID;?>
			</th>
			<th width="15%" class="title">
			<?php echo $adminLanguage->A_COMP_MASS_GROUP;?>
			</th>
			<th width="15%" class="title">
			<?php echo $adminLanguage->A_COMP_EMAIL;?>
			</th>
			<th width="10%" class="title">
			<?php echo $adminLanguage->A_COMP_USERS_LAST;?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	=& $rows[$i];

			$img 	= $row->block ? 'publish_x.png' : 'tick.png';
			$task 	= $row->block ? 'unblock' : 'block';
			$alt = $row->block ? $adminLanguage->A_COMP_STAT_ENABLED : $adminLanguage->A_COMP_USERS_BLOCKED;
			$link 	= 'index2.php?option=com_users&amp;task=editA&amp;id='. $row->id. '&amp;hidemainmenu=1';
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $i+1+$pageNav->limitstart;?>
				</td>
				<td>
				<?php echo mosHTML::idBox( $i, $row->id ); ?>
				</td>
				<td>
				<a href="<?php echo $link; ?>">
				<?php echo $row->name; ?>
				</a>
				</td>
				<td align="center">
				<?php echo $row->loggedin ? '<img src="images/tick.png" width="12" height="12" border="0" alt="" />': ''; ?>
				</td>
				<td>
				<a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')">
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
				</a>
				</td>
				<td>
				<?php echo $row->username; ?>
				</td>
				<td>
				<?php echo $row->groupname; ?>
				</td>
				<td>
				<a href="mailto:<?php echo $row->email; ?>">
				<?php echo $row->email; ?>
				</a>
				</td>
				<td nowrap="nowrap">
				<?php echo mosFormatDate( $row->lastvisitDate, "%Y-%m-%d %H:%M:%S" ); ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}

	function edituser( &$row, &$contact, &$lists, $option, $uid ) {
		global $my, $acl, $adminLanguage;
		global $mosConfig_live_site;
		$tabs =& new mosTabs( 0 );

		$canBlockUser = $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'user properties', 'block_user' );
		$canEmailEvents = $acl->acl_check( 'workflow', 'email_events', 'users', $acl->get_group_name( $row->gid, 'ARO' ) );
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "<?php echo $adminLanguage->A_COMP_CONT_YOUR_NAME;?>" );
			} else if (form.username.value == "") {
				alert( "<?php echo $adminLanguage->A_COMP_USERS_YOU_MUST;?>" );
			} else if (r.exec(form.username.value) || form.username.value.length < 3) {
				alert( "<?php echo $adminLanguage->A_COMP_USERS_YOU_LOGIN;?>" );
			} else if (trim(form.email.value) == "") {
				alert( "<?php echo $adminLanguage->A_COMP_USERS_MUST_EMAIL;?>" );
			} else if (form.gid.value == "") {
				alert( "<?php echo $adminLanguage->A_COMP_USERS_ASSIGN;?>" );
			} else if (trim(form.password.value) != "" && form.password.value != form.password2.value){
				alert( "<?php echo $adminLanguage->A_COMP_USERS_NO_MATCH;?>" );
			} else if (form.gid.value == "29") {
				alert( "<?php echo $adminLanguage->A_COMP_USERS_NO_FRONTEND;?>" );
			} else if (form.gid.value == "30") {
				alert( "<?php echo $adminLanguage->A_COMP_USERS_NO_BACKEND;?>" );
			} else {
				submitform( pressbutton );
			}
		}

		function gotocontact( id ) {
			var form = document.adminForm;
			form.contact_id.value = id;
			submitform( 'contact' );
		}
		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<?php echo $row->id ? $adminLanguage->A_COMP_EDIT : $adminLanguage->A_COMP_ADD;?> <?php echo $adminLanguage->A_COMP_MOD_USER;?>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr>
			<td width="60%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_USERS_DETAILS;?>
					</th>
				</tr>
				<tr>
					<td width="100">
					<?php echo $adminLanguage->A_COMP_NAME;?>:
					</td>
					<td width="85%">
					<input type="text" name="name" class="inputbox" size="40" value="<?php echo $row->name; ?>" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_USERNAME;?>:
					</td>
					<td>
					<input type="text" name="username" class="inputbox" size="40" value="<?php echo $row->username; ?>" />
					</td>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_USERS_EMAIL;?>:
					</td>
					<td>
					<input class="inputbox" type="text" name="email" size="40" value="<?php echo $row->email; ?>" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_USERS_PASS;?>:
					</td>
					<td>
					<input class="inputbox" type="password" name="password" size="40" value="" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_USERS_VERIFY;?>:
					</td>
					<td>
					<input class="inputbox" type="password" name="password2" size="40" value="" />
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo $adminLanguage->A_COMP_MASS_GROUP;?>:
					</td>
					<td>
					<?php echo $lists['gid']; ?>
					</td>
				</tr>
				<?php
				if ($canBlockUser) {
					?>
					<tr>
						<td>
						<?php echo $adminLanguage->A_COMP_USERS_BLOCK;?>
						</td>
						<td>
						<?php echo $lists['block']; ?>
						</td>
					</tr>
					<?php
				}
				if ($canEmailEvents) {
					?>
					<tr>
						<td>
						<?php echo $adminLanguage->A_COMP_USERS_SUBMI;?>
						</td>
						<td>
						<?php echo $lists['sendEmail']; ?>
						</td>
					</tr>
					<?php
				}
				if( $uid ) {
					?>
					<tr>
						<td>
						<?php echo $adminLanguage->A_COMP_USERS_REG_DATE;?>
						</td>
						<td>
						<?php echo $row->registerDate;?>
						</td>
					</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_USERS_VISIT_DATE;?>
					</td>
					<td>
					<?php echo $row->lastvisitDate;?>
					</td>
				</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="2">&nbsp;

					</td>
				</tr>
				</table>
			</td>
			<td width="40%" valign="top">
			<?php
			if ( !$contact ) {
				?>
				<table class="adminform">
				<tr>
					<th>
					<?php echo $adminLanguage->A_COMP_USERS_CONTACT;?>
					</th>
				</tr>
				<tr>
					<td>
					<br />
					<?php echo $adminLanguage->A_COMP_USERS_NO_DETAIL;?>
					<br /><br />
					</td>
				</tr>
				</table>
				<?php
			} else {
				?>
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_USERS_CONTACT;?>
					</th>
				</tr>
				<tr>
					<td width="15%">
					<?php echo $adminLanguage->A_COMP_NAME;?>:
					</td>
					<td>
					<strong>
					<?php echo $contact[0]->name;?>
					</strong>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_MOD_POSITION;?>:
					</td>
					<td >
					<strong>
					<?php echo $contact[0]->con_position;?>
					</strong>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_CONT_TEL;?>:
					</td>
					<td >
					<strong>
					<?php echo $contact[0]->telephone;?>
					</strong>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_CONT_FAX;?>:
					</td>
					<td >
					<strong>
					<?php echo $contact[0]->fax;?>
					</strong>
					</td>
				</tr>
				<tr>
					<td></td>
					<td >
					<strong>
					<?php echo $contact[0]->misc;?>
					</strong>
					</td>
				</tr>
				<?php
				if ($contact[0]->image) {
					?>
					<tr>
						<td></td>
						<td valign="top">
						<img src="<?php echo $mosConfig_live_site;?>/images/stories/<?php echo $contact[0]->image; ?>" align="middle" alt="<?php echo $adminLanguage->A_COMP_CONTACT;?>" />
						</td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="2">
					<br /><br />
					<input class="button" type="button" value="change Contact Details" onclick="javascript: gotocontact( '<?php echo $contact[0]->id; ?>' )">
					<i>
					<br />
					'<?php echo $adminLanguage->A_COMP_USERS_CONTACT_INFO;?>'
					</i>
					</td>
				</tr>
				</table>
				<?php
			}
			?>
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="contact_id" value="" />
		<?php
		if (!$canEmailEvents) {
			?>
			<input type="hidden" name="sendEmail" value="0" />
			<?php
		}
		?>
		</form>
		<?php
	}
}
?>
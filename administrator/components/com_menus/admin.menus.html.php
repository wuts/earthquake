<?php
/**
* @version $Id: admin.menus.html.php,v 1.3 2005/10/21 17:33:55 lang3 Exp $
* @package Mambo
* @subpackage Menus
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Menus
*/
class HTML_menusections {

	function showMenusections( $rows, $pageNav, $search, $levellist, $menutype, $option ) {
		global $my, $adminLanguage;

		mosCommonHTML::loadOverlib();

		$menuCaption = tr($menutype);

		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus">
			<?php echo $adminLanguage->A_MENU_MANAGER;?> <small><small>[ <?php echo $menuCaption;?> ]</small></small>
			</th>
			<td nowrap="true">
			<?php echo $adminLanguage->A_COMP_MENUS_MAX_LVLS;?>
			</td>
			<td>
			<?php echo $levellist;?>
			</td>
			<td>
			<?php echo $adminLanguage->A_COMP_CONF_SEARCH;?>:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" />
			</td>
		</tr>
		<?php
		if ( $menutype == 'mainmenu' ) {
			?>
			<tr>
				<td align="right" nowrap style="color: red; font-weight: normal;" colspan="5">
				<?php echo _MAINMENU_DEL; ?>
				<br/>
				<span style="color: black;">
				<?php echo _MAINMENU_HOME; ?>
				</span>
				</td>
			</tr>
			<?php
		}
		?>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">
			<?php echo $adminLanguage->A_COMP_NB;?>
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title" width="40%">
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_ITEM;?>
			</th>
			<th width="5%">
			<?php echo $adminLanguage->A_COMP_PUBLISHED;?>
			</th>
			<th colspan="2" width="5%">
			<?php echo $adminLanguage->A_COMP_REORDER;?>
			</th>
			<th width="2%">
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_ORDER;?>
			</th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_COMP_SAVE_ORDER;?>" /></a>
			</th>
			<th width="10%">
			<?php echo $adminLanguage->A_COMP_ACCESS;?>
			</th>
			<th width="5%">
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_ITEMID;?>
			</th>
			<th width="20%" align="left">
			<?php echo $adminLanguage->A_COMP_TYPE;?>
			</th>
			<th width="5%">
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_CID;?>
			</th>
		</tr>
	    <?php
		$k = 0;
		$i = 0;
		$n = count( $rows );
		foreach ($rows as $row) {
			$access 	= mosCommonHTML::AccessProcessing( $row, $i );
			$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );
			$published 	= mosCommonHTML::PublishedProcessing( $row, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $i + 1 + $pageNav->limitstart;?>
				</td>
				<td>
				<?php echo $checked; ?>
				</td>
				<td nowrap="nowrap">
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->treename;
				} else {
					$link = 'index2.php?option=com_menus&menutype='. $row->menutype .'&task=edit&id='. $row->id . '&hidemainmenu=1';
					?>
					<a href="<?php echo $link; ?>">
					<?php echo $row->treename; ?>
					</a>
					<?php
				}
				?>
				</td>
				<td width="10%" align="center">
				<?php echo $published;?>
				</td>
				<td>
				<?php echo $pageNav->orderUpIcon( $i ); ?>
				</td>
				<td>
				<?php echo $pageNav->orderDownIcon( $i, $n ); ?>
				</td>
				<td align="center" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
				<?php echo $access;?>
				</td>
				<td align="center">
				<?php echo $row->id; ?>
				</td>
				<td align="left">
				<?php
				echo mosToolTip( $row->descrip, '', 280, 'tooltip.png', $row->type, $row->edit );
				?>
				</td>
				<td align="center">
				<?php echo $row->componentid; ?>
				</td>
		    </tr>
			<?php
			$k = 1 - $k;
			$i++;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


	/**
	* Displays a selection list for menu item types
	*/
	function addMenuItem( &$cid, $menutype, $option, $types_content, $types_component, $types_link, $types_other ) {
		global $adminLanguage;
		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus">
			<?php echo $adminLanguage->A_COMP_MENUS_ADD_ITEM;?>
			</th>
			<td valign="bottom" nowrap style="color: red;">
			<?php //echo _MENU_GROUP; ?>
			</td>
		</tr>
		</table>
<style type="text/css">
fieldset {
	border: 1px solid #777;
}
legend {
	font-weight: bold;
}
</style>
<table class="adminform">
	<tr>
		<td width="50%" valign="top">
			<fieldset>
				<legend><?php echo $adminLanguage->A_COMP_MENUS_MENU_CONTENT;?></legend>
				<table class="adminform">
				<?php
				$k 		= 0;
				$count 	= count( $types_content );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_content[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&hidemainmenu=1&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td width="20">
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo tr($row->name); ?>
						</a>
						</td>
						<td align="center" width="20">
						<?php
						echo mosToolTip( tr($row->descrip), $row->name, 250 );
						?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				</table>
			</fieldset>
			<fieldset>
				<legend><?php echo $adminLanguage->A_COMP_MENUS_MENU_MISC;?></legend>
				<table class="adminform">
				<?php
				$k 		= 0;
				$count 	= count( $types_other );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_other[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td width="20">
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo tr($row->name); ?>
						</a>
						</td>
						<td align="center" width="20">
						<?php
						echo mosToolTip( tr($row->descrip), $row->name, 250 );
						?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				</table>
			</fieldset>
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_NOTE;?>
		</td>
		<td width="50%" valign="top">
			<fieldset>
				<legend><?php echo $adminLanguage->A_COMP_MENUS_MENU_COM;?></legend>
				<table class="adminform">
				<?php
				$k 		= 0;
				$count 	= count( $types_component );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_component[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td width="20">
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo tr($row->name); ?>
						</a>
						</td>
						<td align="center" width="20">
						<?php
						echo mosToolTip( tr($row->descrip), $row->name, 250 );
						?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				</table>
			</fieldset>
			<fieldset>
				<legend><?php echo $adminLanguage->A_COMP_MENUS_MENU_LINKS;?></legend>
				<table class="adminform">
				<?php
				$k 		= 0;
				$count 	= count( $types_link );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_link[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td width="20">
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo tr($row->name); ?>
						</a>
						</td>
						<td align="center" width="20">
						<?php
						echo mosToolTip( tr($row->descrip), $row->name, 250 );
						?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				</table>
			</fieldset>
		</td>
	</tr>
</table>

<?php /* ?>

		<table width="100%">
		<tr>
			<td width="60%">
				<h2 align="left"><?php echo $adminLanguage->A_COMP_MENUS_MENU_CONTENT;?></h2>
				<table class="adminlist">
				<tr>
					<th width="5">
					<?php echo $adminLanguage->A_COMP_NB;?>
					</th>
					<th width="20">
					</th>
					<th class="title">
					<?php echo $adminLanguage->A_COMP_MENUS_MENU_ITEM_TYPE;?>
					</th>
					<th class="title" align="center" width="20px">
					<?php echo $adminLanguage->A_COMP_DESCRIPTION;?>
					</th>
					<th>
					</th>
				</tr>
				<?php
				$k 		= 0;
				$count 	= count( $types_content );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_content[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td>
						<?php echo $i+1; ?>
						</td>
						<td>
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo $row->name; ?>
						</a>
						</td>
						<td align="center">
						<?php
						echo mosToolTip( $row->descrip, $row->name, 250 );
						?>
						</td>
						<td>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				<tr>
					<th colspan="5">
					</th>
				</tr>
				</table>
				<br/>

				<h2 align="left"><?php echo $adminLanguage->A_COMP_MENUS_MENU_COM;?></h2>
				<table class="adminlist">
				<tr>
					<th width="5">
					<?php echo $adminLanguage->A_COMP_NB;?>
					</th>
					<th width="20">
					</th>
					<th class="title">
					<?php echo $adminLanguage->A_COMP_MENUS_MENU_ITEM_TYPE;?>
					</th>
					<th class="title" align="center" width="20">
					<?php echo $adminLanguage->A_COMP_DESCRIPTION;?>
					</th>
					<th>
					</th>
				</tr>
				<?php
				$k 		= 0;
				$count 	= count( $types_component );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_component[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td>
						<?php echo $i+1; ?>
						</td>
						<td>
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo $row->name; ?>
						</a>
						</td>
						<td align="center">
						<?php
						echo mosToolTip( $row->descrip, $row->name, 250 );
						?>
						</td>
						<td>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				<tr>
					<th colspan="5">
					</th>
				</tr>
				</table>
				<br/>


				<h2 align="left"><?php echo adminLanguage->A_COMP_MENUS_MENU_LINKS;?></h2>
				<table class="adminlist">
				<tr>
					<th width="5">
					<?php echo $adminLanguage->A_COMP_NB;?>
					</th>
					<th width="20">
					</th>
					<th class="title">
					<?php echo $adminLanguage->A_COMP_MENUS_MENU_ITEM_TYPE;?>
					</th>
					<th class="title" align="center" width="20">
					<?php echo $adminLanguage->A_COMP_DESCRIPTION;?>
					</th>
					<th>
					</th>
				</tr>
				<?php
				$k 		= 0;
				$count 	= count( $types_link );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_link[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td>
						<?php echo $i+1; ?>
						</td>
						<td>
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo $row->name; ?>
						</a>
						</td>
						<td align="center">
						<?php
						echo mosToolTip( $row->descrip, $row->name, 250 );
						?>
						</td>
						<td>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				<tr>
					<th colspan="5">
					</th>
				</tr>
				</table>
				<br/>

				<h2 align="left">Other</h2>
				<table class="adminlist">
				<tr>
					<th width="5">
					<?php echo $adminLanguage->A_COMP_NB;?>
					</th>
					<th width="20">
					</th>
					<th class="title">
					<?php echo $adminLanguage->A_COMP_MENUS_MENU_ITEM_TYPE;?>
					</th>
					<th class="title" align="center" width="20">
					<?php echo $adminLanguage->A_COMP_DESCRIPTION;?>
					</th>
					<th>
					</th>
				</tr>
				<?php
				$k 		= 0;
				$count 	= count( $types_other );
					for ( $i=0; $i < $count; $i++ ) {
					$row = &$types_other[$i];

					$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=edit&type='. $row->type;
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td>
						<?php echo $i+1; ?>
						</td>
						<td>
						<input type="radio" id="cb<?php echo $i;?>" name="type" value="<?php echo $row->type; ?>" onClick="isChecked(this.checked);" />
						</td>
						<td>
						<a href="<?php echo $link; ?>">
						<?php echo $row->name; ?>
						</a>
						</td>
						<td align="center">
						<?php
						echo mosToolTip( $row->descrip, $row->name, 250 );
						?>
						</td>
						<td>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				<tr>
					<th colspan="5">
					</th>
				</tr>
				</table>
			</td>
			<td width="40%" valign="top" align="center">
			<h2><?php echo $adminLanguage->A_COMP_MENUS_MENU_HELP;?></h2>
			<br/>
			<a href="#">
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_BLOGVIEW;?>
			</a>
			<br/><br/><br/>
			<a href="#">
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_TABLEVIEW;?>
			</a>
			<br/><br/><br/>
			<a href="#">
			<?php echo $adminLanguage->A_COMP_MENUS_MENU_LISTVIEW;?>
			</a>
			<br/><br/><br/><br/><br/>
			<div style="color: red; font-weight: bold;">
			<?php echo _MENU_GROUP; ?>
			</div>
			</td>
		</tr>
		</table>
<?php */ ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<input type="hidden" name="task" value="edit" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


	/**
	* Form to select Menu to move menu item(s) to
	*/
	function moveMenu( $option, $cid, $MenuList, $items, $menutype  ) {
		global $adminLanguage;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<br />
		<table class="adminheading">
		<tr>
			<th>
			<?php echo $adminLanguage->A_COMP_MENUS_MOVE_ITEMS;?>
			</th>
		</tr>
		</table>

		<br />
		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td align="left" valign="top" width="30%">
			<strong><?php echo $adminLanguage->A_COMP_MENUS_MOVE_MENU;?>:</strong>
			<br />
			<?php echo $MenuList ?>
			<br /><br />
			</td>
			<td align="left" valign="top">
			<strong>
			<?php echo $adminLanguage->A_COMP_MENUS_BEING_MOVED;?>:
			</strong>
			<br />
			<ol>
			<?php
			foreach ( $items as $item ) {
				?>
				<li>
				<?php echo $item->name; ?>
				</li>
				<?php
			}
			?>
			</ol>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<?php
		foreach ( $cid as $id ) {
			echo "\n <input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
		?>
		</form>
		<?php
	}


	/**
	* Form to select Menu to copy menu item(s) to
	*/
	function copyMenu( $option, $cid, $MenuList, $items, $menutype  ) {
		global $adminLanguage;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<br />
		<table class="adminheading">
		<tr>
			<th>
			<?php echo $adminLanguage->A_COMP_MENUS_COPY_ITEMS;?>
			</th>
		</tr>
		</table>

		<br />
		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td align="left" valign="top" width="30%">
			<strong>
			<?php echo $adminLanguage->A_COMP_MENUS_COPY_MENU;?>:
			</strong>
			<br />
			<?php echo $MenuList ?>
			<br /><br />
			</td>
			<td align="left" valign="top">
			<strong>
			<?php echo $adminLanguage->A_COMP_MENUS_BEING_COPIED;?>:
			</strong>
			<br />
			<ol>
			<?php
			foreach ( $items as $item ) {
				?>
				<li>
				<?php echo $item->name; ?>
				</li>
				<?php
			}
			?>
			</ol>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<?php
		foreach ( $cid as $id ) {
			echo "\n <input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
		?>
		</form>
		<?php
	}


}
?>
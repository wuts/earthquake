<?php
/**
* @version $Id: admin.menumanager.html.php,v 1.1 2005/07/22 01:52:39 eddieajau Exp $
* @package Mambo
* @subpackage Menus
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* HTML class for all menumanager component output
* @package Mambo
* @subpackage Menus
*/
class HTML_menumanager {
	/**
	* Writes a list of the menumanager items
	*/
	function show ( $option, $menus, $pageNav ) {
		global $mosConfig_live_site, $adminLanguage;
		?>
		<script language="javascript" type="text/javascript">
		function menu_listItemTask( id, task, option ) {
			var f = document.adminForm;
			cb = eval( 'f.' + id );
			if (cb) {
				cb.checked = true;
				submitbutton(task);
			}
			return false;
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus">
			<?php echo $adminLanguage->A_MENU_MANAGER;?>
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="30px"><?php echo $adminLanguage->A_COMP_NB;?></th>
			<th width="30px"></th>
			<th class="title" nowrap="nowrap" align="<?php echo ($adminLanguage->RTLsupport ? 'right' : 'left'); ?>"> <!-- rtl change -->
			<?php echo $adminLanguage->A_COMP_MENU_NAME;?>
			</th>
			<th width="10%" nowrap="nowrap">
			<?php echo $adminLanguage->A_COMP_MENU_TYPE;?>
			</th>
			<th width="10%">
			<?php echo $adminLanguage->A_COMP_MENU_PUB;?>
			</th>
			<th width="10%">
			<?php echo $adminLanguage->A_COMP_MENU_UNPUB;?>
			</th>
			<th width="10%">
			<?php echo $adminLanguage->A_COMP_MENU_MODULES;?>
			</th>
		</tr>
		<?php
		$k = 0;
		$i = 0;
		$start = 0;
		if ($pageNav->limitstart)
			$start = $pageNav->limitstart;
		$count = count($menus)-$start;
		if ($pageNav->limit)
			if ($count > $pageNav->limit)
				$count = $pageNav->limit;
		for ($m = $start; $m < $start+$count; $m++) {
			$menu = $menus[$m];
			$link 	= 'index2.php?option=com_menumanager&task=edit&hidemainmenu=1&menu='. $menu->type;
			$linkA 	= 'index2.php?option=com_menus&menutype='. $menu->type;
			?>
			<tr class="<?php echo "row". $k; ?>">
				<td align="center">
				<?php echo $i + 1 + $pageNav->limitstart;?>
				</td>
				<td align="center">
				<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $menu->type; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td>
				<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_COMP_MENU_EDIT_NAME;?>">
				<?php echo $menu->type; ?>
				</a>
				</td>
				<td align="center">
				<a href="<?php echo $linkA; ?>" title="<?php echo $adminLanguage->A_COMP_MENU_EDIT_ITEM;?>">
				<img src="<?php echo $mosConfig_live_site; ?>/includes/js/ThemeOffice/mainmenu.png" border="0"/>
				</a>
				</td>
				<td align="center">
				<?php
				echo $menu->published;
				?>
				</td>
				<td align="center">
				<?php
				echo $menu->unpublished;
				?>
				</td>
				<td align="center">
				<?php
				echo $menu->modules;
				?>
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
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


	/**
	* writes a form to take the name of the menu you would like created
	* @param option	display options for the form
	*/
	function edit ( &$row, $option ) {
		global $mosConfig_live_site, $adminLanguage;

		$new = $row->menutype ? 0 : 1;
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if (pressbutton == 'savemenu') {
				if ( form.menutype.value == '' ) {
					alert( 'Please enter a menu name' );
					form.menutype.focus();
					return;
				}
				<?php
				if ( $new ) {
					?>
					if ( form.title.value == '' ) {
						alert( '<?php echo $adminLanguage->A_COMP_MENU_ENTER_TITLE;?>' );
						form.title.focus();
						return;
					}
					<?php
				}
				?>
				submitform( 'savemenu' );
			} else {
				submitform( pressbutton );
			}
		}
		</script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus">
			<?php echo $adminLanguage->A_COMP_MENU_DETAILS;?>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr height="45px;">
			<td width="100px" align="left">
			<strong><?php echo $adminLanguage->A_COMP_MENU_NAME;?>:</strong>
			</td>
			<td>
			<input class="inputbox" type="text" name="menutype" size="30" value="<?php echo isset( $row->menutype ) ? $row->menutype : ''; ?>" />
			<?php
			$tip = $adminLanguage->A_COMP_MENU_TIPS;
			echo mosToolTip( $tip );
			?>
			</td>
		</tr>
		<?php
		if ( $new ) {
			?>
			<tr>
				<td width="100px" align="left" valign="top">
				<strong><?php echo $adminLanguage->A_COMP_MENU_TITLE;?>:</strong>
				</td>
				<td>
				<input class="inputbox" type="text" name="title" size="30" value="<?php echo $row->title ? $row->title : '';?>" />
				<?php
				$tip = $adminLanguage->A_COMP_MENU_TIPS2;
				echo mosToolTip( $tip );
				?>
				<br/><br/><br/>
				<strong>
				<?php echo $adminLanguage->A_COMP_MENU_TIPS3;?>
				</strong>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="2">
			</td>
		</tr>
		</table>
		<br /><br />

		<script language="Javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/overlib_mini.js"></script>
		<?php
		if ( $new ) {
			?>
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="iscore" value="<?php echo $row->iscore; ?>" />
			<input type="hidden" name="published" value="<?php echo $row->published; ?>" />
			<input type="hidden" name="position" value="<?php echo $row->position; ?>" />
			<input type="hidden" name="module" value="mod_mainmenu" />
			<input type="hidden" name="params" value="<?php echo $row->params; ?>" />
			<?php
		}
		?>

		<input type="hidden" name="new" value="<?php echo $new; ?>" />
		<input type="hidden" name="old_menutype" value="<?php echo $row->menutype; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="savemenu" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
		}


	/**
	* A delete confirmation page
	* Writes list of the items that have been selected for deletion
	*/
	function showDelete( $option, $type, $items, $modules ) {
		global $adminLanguage;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo $adminLanguage->A_COMP_MENU_DEL;?>: <?php echo $type;?>
			</th>
		</tr>
		</table>

		<br />
		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td align="left" valign="top" width="20%">
			<?php
			if ( $modules ) {
				?>
				<strong><?php echo $adminLanguage->A_COMP_MENU_MODULE_DEL;?>:</strong>
				<ol>
				<?php
				foreach ( $modules as $module ) {
					?>
					<li>
					<font color="#000066">
					<strong>
					<?php echo $module->title; ?>
					</strong>
					</font>
					</li>
					<input type="hidden" name="cid[]" value="<?php echo $module->id; ?>" />
					<?php
				}
				?>
				</ol>
				<?php
			}
			?>
			</td>
			<td align="left" valign="top" width="25%">
			<strong><?php echo $adminLanguage->A_COMP_MENU_ITEMS_DEL;?>:</strong>
			<br />
			<ol>
			<?php
			foreach ( $items as $item ) {
				?>
				<li>
				<font color="#000066">
				<?php echo $item->name; ?>
				</font>
				</li>
				<input type="hidden" name="mids[]" value="<?php echo $item->id; ?>" />
				<?php
			}
			?>
			</ol>
			</td>
			<td>
			<?php echo $adminLanguage->A_COMP_MENU_WILL;?> <strong><font color="#FF0000">
            <?php echo $adminLanguage->A_COMP_MEDIA_DEL;?></font></strong>
            <?php echo $adminLanguage->A_COMP_MENU_WILL2;?>
			<br /><br /><br />
			<div style="border: 1px dotted gray; width: 70px; padding: 10px; margin-left: 100px;">
			<a class="toolbar" href="javascript:if (confirm('<?php echo $adminLanguage->A_COMP_MENU_YOU_SURE;?>')){ submitbutton('deletemenu');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('remove','','images/delete_f2.png',1);">
			<img name="remove" src="images/delete.png" alt="<?php echo $adminLanguage->A_COMP_MEDIA_DEL;?>" border="0" align="middle" />
			&nbsp;<?php echo $adminLanguage->A_COMP_MEDIA_DEL;?>
			</a>
			</div>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		<input type="hidden" name="boxchecked" value="1" />
		</form>
		<?php
	}


	/**
	* A copy confirmation page
	* Writes list of the items that have been selected for copy
	*/
	function showCopy( $option, $type, $items ) {
		global $adminLanguage;
	?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'copymenu') {
				if ( document.adminForm.menu_name.value == '' ) {
					alert( '<?php echo $adminLanguage->A_COMP_MENU_NAME_MENU;?>' );
					return;
				} else if ( document.adminForm.module_name.value == '' ) {
					alert( '<?php echo $adminLanguage->A_COMP_MENU_NAME_MOD;?>' );
					return;
				} else {
					submitform( 'copymenu' );
				}
			} else {
				submitform( pressbutton );
			}
		}
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo $adminLanguage->A_COMP_MENU_COPY;?>
			</th>
		</tr>
		</table>

		<br />
		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td align="left" valign="top" width="30%">
			<strong><?php echo $adminLanguage->A_COMP_MENU_NEW;?>:</strong>
			<br />
			<input class="inputbox" type="text" name="menu_name" size="30" value="" />
			<br /><br /><br />
			<strong><?php echo $adminLanguage->A_COMP_MENU_NEW_MOD;?>:</strong>
			<br />
			<input class="inputbox" type="text" name="module_name" size="30" value="" />
			<br /><br />
			</td>
			<td align="left" valign="top" width="25%">
			<strong>
			<?php echo $adminLanguage->A_COMP_MENU_COPIED;?>:
			</strong>
			<br />
			<font color="#000066">
			<strong>
			<?php echo $type; ?>
			</strong>
			</font>
			<br /><br />
			<strong>
			<?php echo $adminLanguage->A_COMP_MENU_ITEMS_COPIED;?>:
			</strong>
			<br />
			<ol>
			<?php
			foreach ( $items as $item ) {
				?>
				<li>
				<font color="#000066">
				<?php echo $item->name; ?>
				</font>
				</li>
				<input type="hidden" name="mids[]" value="<?php echo $item->id; ?>" />
				<?php
			}
			?>
			</ol>
			</td>
			<td valign="top">
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		</form>
		<?php
	}
}
?>
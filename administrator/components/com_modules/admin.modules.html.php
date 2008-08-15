<?php
/**
* @version $Id: admin.modules.html.php,v 1.3 2005/10/21 17:33:55 lang3 Exp $
* @package Mambo
* @subpackage Modules
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Modules
*/
class HTML_modules {

	/**
	* Writes a list of the defined modules
	* @param array An array of category objects
	*/
	function showModules( &$rows, $myid, $client, &$pageNav, $option, &$lists, $search ) {
		global $my, $adminLanguage;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="modules" rowspan="2">
			<?php echo $adminLanguage->A_COMP_MOD_MANAGER;?> <small><small>[ <?php echo $client == 'admin' ? $adminLanguage->A_COMP_MAMB_ADMIN : $adminLanguage->A_COMP_MAMB_SITE;?> ]</small></small>
			</th>
			<td width="right">
			<?php echo $lists['position'];?>
			</td>
			<td width="right">
			<?php echo $lists['type'];?>
			</td>
		</tr>
		<tr>
			<td align="right">
			<?php echo $adminLanguage->A_COMP_FILTER;?>
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20px"><?php echo $adminLanguage->A_COMP_NB;?></th>
			<th width="20px">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_COMP_MOD_NAME;?>
			</th>
			<th nowrap="nowrap" width="10%">
			<?php echo $adminLanguage->A_COMP_PUBLISHED;?>
			</th>
			<th colspan="2" align="center" width="5%">
			<?php echo $adminLanguage->A_COMP_REORDER;?>
			</th>
			<th width="2%">
			<?php echo $adminLanguage->A_COMP_ORDER;?>
			</th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_COMP_MENUS_MENU_SAVE_ORDER;?>" /></a>
			</th>
			<?php
			if ( !$client ) {
				?>
				<th nowrap="nowrap" width="7%">
				<?php echo $adminLanguage->A_COMP_ACCESS;?>
				</th>
				<?php
			}
			?>
			<th nowrap="nowrap" width="7%">
			<?php echo $adminLanguage->A_COMP_MOD_POSITION;?>
			</th>
			<th nowrap="nowrap" width="5%">
			<?php echo $adminLanguage->A_COMP_MOD_PAGES;?>
			</th>
			<th nowrap="nowrap" width="5%">
			<?php echo $adminLanguage->A_COMP_ID;?>
			</th>
			<th nowrap="nowrap" width="10%" align="left">
			<?php echo $adminLanguage->A_COMP_TYPE;?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];

			$link = 'index2.php?option=com_modules&client='. $client .'&task=editA&hidemainmenu=1&id='. $row->id;

			$access 	= mosCommonHTML::AccessProcessing( $row, $i );
			$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );
			$published 	= mosCommonHTML::PublishedProcessing( $row, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="right">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo tr($row->title);
				} else {
					?>
					<a href="<?php echo $link; ?>">
					<?php echo tr($row->title); ?>
					</a>
					<?php
				}
				?>
				</td>
				<td align="center">
				<?php echo $published;?>
				</td>
				<td>
				<?php echo $pageNav->orderUpIcon( $i, ($row->position == @$rows[$i-1]->position) ); ?>
				</td>
				<td>
				<?php echo $pageNav->orderDownIcon( $i, $n, ($row->position == @$rows[$i+1]->position) ); ?>
				</td>
				<td align="center" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<?php
				if ( !$client ) {
					?>
					<td align="center">
					<?php echo $access;?>
					</td>
					<?php
				}
				?>
				<td align="center">
				<?php echo $row->position; ?>
				</td>
				<td align="center">
				<?php
				if (is_null( $row->pages )) {
					echo $adminLanguage->A_COMP_NONE;
				} else if ($row->pages > 0) {
					echo $adminLanguage->A_COMP_MOD_VARIES;
				} else {
					echo $adminLanguage->A_COMP_MOD_ALL;
				}
				?>
				</td>
				<td align="center">
				<?php echo $row->id;?>
				</td>
				<td align="left">
				<?php echo $row->module ? $row->module : $adminLanguage->A_COMP_MOD_USER;?>
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
		<input type="hidden" name="client" value="<?php echo $client;?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}

	/**
	* Writes the edit form for new and existing module
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.
	* @param mosCategory The category object
	* @param array <p>The modules of the left side.  The array elements are in the form
	* <var>$leftorder[<i>order</i>] = <i>label</i></var>
	* where <i>order</i> is the module order from the db table and <i>label</i> is a
	* text label associciated with the order.</p>
	* @param array See notes for leftorder
	* @param array An array of select lists
	* @param object Parameters
	*/
	function editModule( &$row, &$orders2, &$lists, &$params, $option ) {
		global $mosConfig_live_site;
		global $adminLanguage;
		$row->titleA = '';
		if ( $row->id ) {
			$row->titleA = '<small><small>[ '. tr($row->title) .' ]</small></small>';
		}

		mosCommonHTML::loadOverlib();
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if ( ( pressbutton == 'save' ) && ( document.adminForm.title.value == "" ) ) {
				alert("<?php echo $adminLanguage->A_COMP_MOD_MUST_TITLE;?>");
			} else {
				<?php if ($row->module == "") {
					getEditorContents( 'editor1', 'content' );
				}?>
				submitform(pressbutton);
			}
			submitform(pressbutton);
		}
		<!--
		var originalOrder = '<?php echo $row->ordering;?>';
		var originalPos = '<?php echo $row->position;?>';
		var orders = new Array();	// array in the format [key,value,text]
		<?php	$i = 0;
		foreach ($orders2 as $k=>$items) {
			foreach ($items as $v) {
				echo "\n	orders[".$i++."] = new Array( \"$k\",\"$v->value\",\"$v->text\" );";
			}
		}
		?>
		//-->
		</script>
		<table class="adminheading">
		<tr>
			<th class="modules">
			<?php echo $lists['client_id'] ? $adminLanguage->A_COMP_MAMB_ADMIN : $adminLanguage->A_COMP_MAMB_SITE;?>
			<?php echo $adminLanguage->A_COMP_MOD_MODULE;?>:
			<small>
			<?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW;?>
			</small>
			<?php echo $row->titleA; ?>
			</th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">

		<table cellspacing="0" cellpadding="0" width="100%">
		<tr valign="top">
			<td width="60%">
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_MOD_DETAILS;?>
					</th>
				<tr>
				<tr>
					<td width="100" align="left">
					<?php echo $adminLanguage->A_COMP_TITLE;?>:
					</td>
					<td>
					<input class="text_area" type="text" name="title" size="35" value="<?php echo tr($row->title); ?>" />
					</td>
				</tr>
				<!-- START selectable pages -->
				<tr>
					<td width="100" align="left">
					<?php echo $adminLanguage->A_COMP_MOD_SHOW_TITLE;?>:
					</td>
					<td>
					<?php echo $lists['showtitle']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo $adminLanguage->A_COMP_MOD_POSITION;?>:
					</td>
					<td>
					<?php echo $lists['position']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo $adminLanguage->A_COMP_MOD_ORDER;?>:
					</td>
					<td>
					<script language="javascript" type="text/javascript">
					<!--
					writeDynaList( 'class="inputbox" name="ordering" size="1"', orders, originalPos, originalPos, originalOrder );
					//-->
					</script>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo $adminLanguage->A_COMP_ACCESS_LEVEL;?>:
					</td>
					<td>
					<?php echo $lists['access']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo $adminLanguage->A_COMP_PUBLISHED;?>:
					</td>
					<td>
					<?php echo $lists['published']; ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo $adminLanguage->A_COMP_ID;?>:
					</td>
					<td>
					<?php echo $row->id; ?>
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo $adminLanguage->A_COMP_DESCRIPTION;?>:
					</td>
					<td>
					<?php echo $row->description; ?>
					</td>
				</tr>
				</table>

				<table class="adminform">
				<tr>
					<th >
					<?php echo $adminLanguage->A_COMP_CONT_PARAMETERS;?>
					</th>
				<tr>
				<tr>
					<td>
					<?php echo $params->render();?>
					</td>
				</tr>
				</table>
			</td>
			<td width="40%" >
				<table width="100%" class="adminform">
				<tr>
					<th>
					<?php echo $adminLanguage->A_COMP_MOD_PAGES_ITEMS;?>
					</th>
				<tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_MOD_ITEM_LINK;?>:
					<br />
					<?php echo $lists['selections']; ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<?php
		if ($row->module == "") {
			?>
			<tr>
				<td colspan="2">
						<table width="100%" class="adminform">
						<tr>
							<th colspan="2">
							<?php echo $adminLanguage->A_COMP_MOD_CUSTOM_OUTPUT;?>
							</th>
						<tr>
						<tr>
							<td valign="top" align="left">
							<?php echo $adminLanguage->A_COMP_MOD_CONTENT;?>:
							</td>
							<td>
							<?php
							// parameters : areaname, content, hidden field, width, height, rows, cols
							editorArea( 'editor1',  $row->content , 'content', '700', '350', '95', '30' ) ; ?>
							</td>
						</tr>
						</table>
				</td>
			</tr>
			<?php
		}
		?>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="original" value="<?php echo $row->ordering; ?>" />
		<input type="hidden" name="module" value="<?php echo $row->module; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client_id" value="<?php echo $lists['client_id']; ?>" />
		<?php
		if ( $row->client_id || $lists['client_id'] ) {
			echo '<input type="hidden" name="client" value="admin" />';
		}
		?>
		</form>
		<?php
	}

}
?>
<?php
/**
* @version $Id: admin.sections.html.php,v 1.4 2005/10/21 17:33:55 lang3 Exp $
* @package Mambo
* @subpackage Sections
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Sections
*/
class sections_html {
	/**
	* Writes a list of the categories for a section
	* @param array An array of category objects
	* @param string The name of the category section
	*/
	function show( &$rows, $scope, $myid, &$pageNav, $option ) {
		global $my, $adminLanguage;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			 <th class="sections">
			<?php echo $adminLanguage->A_COMP_SECT_MANAGER;?>
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">
			<?php echo $adminLanguage->A_COMP_NB;?>
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_COMP_SECT_NAME;?>
			</th>
			<th width="10%">
			<?php echo $adminLanguage->A_COMP_PUBLISHED;?>
			</th>
			<th colspan="2" width="5%">
			<?php echo $adminLanguage->A_COMP_REORDER;?>
			</th>
			<th width="2%">
			<?php echo $adminLanguage->A_COMP_ORDER;?>
			</th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_COMP_SAVE_ORDER;?>" /></a>
			</th>
			<th width="8%">
			<?php echo $adminLanguage->A_COMP_ACCESS;?>
			</th>
			<th width="12%" nowrap>
			<?php echo $adminLanguage->A_COMP_SECT_ID;?>
			</th>
			<th width="12%" nowrap>
			<?php echo $adminLanguage->A_COMP_SECT_NB_CATEG;?>
			</th>
			<th width="12%" nowrap>
			<?php echo $adminLanguage->A_COMP_ACTIVE;?>
			</th>

		</tr>
		<?php
		$k = 0;
		for ( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
			$row = &$rows[$i];

			$link = 'index2.php?option=com_sections&scope=content&task=editA&hidemainmenu=1&id='. $row->id;

			$access 	= mosCommonHTML::AccessProcessing( $row, $i );
			$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );
			$published 	= mosCommonHTML::PublishedProcessing( $row, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20" align="right">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td width="20">
				<?php echo $checked; ?>
				</td>
				<td width="35%">
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->name. " ( ". $row->title ." )";
				} else {
					?>
					<a href="<?php echo $link; ?>">
					<?php echo $row->name. " ( ". $row->title ." )"; ?>
					</a>
					<?php
				}
				?>
				</td>
				<td align="center">
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
				<td align="center">
				<?php echo $row->categories; ?>
				</td>
				<td align="center">
				<?php echo $row->count; ?>
				</td>
				<?php
				$k = 1 - $k;
				?>
			</tr>
			<?php
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="scope" value="<?php echo $scope;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="chosen" value="" />
		<input type="hidden" name="act" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}

	/**
	* Writes the edit form for new and existing categories
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.  Note that the <var>section</var> property <b>must</b> be defined
	* even for a new record.
	* @param mosCategory The category object
	* @param string The html for the image list select list
	* @param string The html for the image position select list
	* @param string The html for the ordering list
	* @param string The html for the groups select list
	*/
	function edit( &$row, $option, &$lists, &$menus ) {
		global $mosConfig_live_site, $adminLanguage;
		if ( $row->name != '' ) {
			$name = $row->name;
		} else {
			$name = $adminLanguage->A_COMP_SECT_NEW;
		}
		if ($row->image == "") {
			$row->image = 'blank.png';
		}
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if ( pressbutton == 'menulink' ) {
				if ( form.menuselect.value == "" ) {
					alert( "<?php echo $adminLanguage->A_COMP_SECT_SEL_MENU;?>" );
					return;
				} else if ( form.link_type.value == "" ) {
					alert( "<?php echo $adminLanguage->A_COMP_SELECT_MENU_TYPE;?>" );
					return;
				} else if ( form.link_name.value == "" ) {
					alert( "<?php echo $adminLanguage->A_COMP_ENTER_MENU_NAME;?>" );
					return;
				}
			}

			if (form.name.value == ""){
				alert("<?php echo $adminLanguage->A_COMP_SECT_MUST_NAME;?>");
			} else if (form.title.value ==""){
				alert("<?php echo $adminLanguage->A_COMP_SECT_MUST_TITLE;?>");
			} else {
				<?php getEditorContents( 'editor1', 'description' ) ; ?>
				submitform(pressbutton);
			}
		}
		// show / hide publishing information
			function displayParameterInfo()
			{
				
				if(document.getElementById('simpleediting').style.display == 'block')
				{
					document.getElementById('simpleediting').style.display = 'none';	
					document.getElementById('show').style.display = 'block';	
					document.getElementById('hide').style.display = 'none';
					document.adminForm.simple_editing.value ='on';
				}
				else
				{
					document.getElementById('simpleediting').style.display = 'block';
					document.getElementById('show').style.display = 'none';	
					document.getElementById('hide').style.display = 'block';
					document.adminForm.simple_editing.value ='off';
				}
				
			}
		</script>
		<?php
			$advanced = 'block';
			$simple = 'none';
			$simpleediting ='block';
		?>
		<form action="index2.php" method="post" name="adminForm">
		<input type ="hidden" name="simple_editing" value=''>
		<table class="adminheading">
		<tr>
			<th class="sections">
			<?php echo $adminLanguage->A_COMP_SECTION;?>:
			<small>
			<?php echo $row->id ? $adminLanguage->A_COMP_EDIT : $adminLanguage->A_COMP_NEW;?>
			</small>
			<small><small>
			[ <?php echo $name ; ?> ]
			</small></small>
			</th>
		</tr>
		</table>
		<table width="100%">
			<tr>
				<td valign="top" align="right">
				<div id = "show" style="display:<?php echo $simple;?>">
				<a href="javascript:displayParameterInfo();"><?php echo $adminLanguage->A_COMP_SHOW_ADV_DETAILS;?></a>
				</div>
				<div id = "hide" style="display:<?php echo $advanced;?>">
				<a href="javascript:displayParameterInfo();"><?php echo $adminLanguage->A_COMP_HIDE_ADV_DETAILS;?></a>
				</div>
				</td>
			</tr>
		</table>
		<table width="100%">
		<tr>
			<td valign="top" >
				<table class="adminform">
				<tr>
					<th colspan="3">
					<?php echo $adminLanguage->A_COMP_SECT_DETAILS;?>
					</th>
				<tr>
				<tr>
					<td width="150">
					<?php echo $adminLanguage->A_COMP_SECT_SCOPE;?>:
					</td>
					<td width="85%" colspan="2">
					<strong>
					<?php echo $row->scope; ?>
					</strong>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_TITLE;?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="title" value="<?php echo $row->title; ?>" size="50" maxlength="50" title="<?php echo $adminLanguage->A_COMP_SECT_SHORT_NAME;?>" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo (isset($row->section) ? $adminLanguage->A_COMP_CATEG : $adminLanguage->A_COMP_SECTION );?> <?php echo $adminLanguage->A_COMP_NAME;?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="name" value="<?php echo $row->name; ?>" size="50" maxlength="255" title="<?php echo $adminLanguage->A_COMP_SECT_LONG_NAME;?>" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_IMAGE;?>:
					</td>
					<td>
					<?php echo $lists['image']; ?>
					</td>
					<td rowspan="4" width="50%">
					<?php
						$path = $mosConfig_live_site . "/images/";
						if ($row->image != "blank.png") {
							$path.= "stories/";
						}
					?>
					<img src="<?php echo $path;?><?php echo $row->image;?>" name="imagelib" width="80" height="80" border="2" alt="<?php echo $adminLanguage->A_COMP_PREVIEW;?>" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_IMAGE_POSITION;?>:
					</td>
					<td>
					<?php echo $lists['image_position']; ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ORDERING;?>:
					</td>
					<td>
					<?php echo $lists['ordering']; ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_ACCESS_LEVEL;?>:
					</td>
					<td>
					<?php echo $lists['access']; ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_PUBLISHED;?>:
					</td>
					<td>
					<?php echo $lists['published']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo $adminLanguage->A_COMP_DESCRIPTION;?>:
					</td>
					<td colspan="2">
					<?php
					// parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor1',  $row->description , 'description', '100%;', '300', '60', '20' ) ; ?>
					</td>
				</tr>
				</table>
			</td>
			<td valign="top" align="right">
			<div id="simpleediting" style="display:<?php echo $simpleediting;?>">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" >
				<tr>
					<td width="40%">
			<?php
			if ( $row->id > 0 ) {
    				?>
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_LINK_TO_MENU;?>
					</th>
				<tr>
				<tr>
					<td colspan="2">
					<?php echo $adminLanguage->A_COMP_CREATE_MENU;?>
					<br /><br />
					</td>
				<tr>
				<tr>
					<td valign="top" width="100px">
					<?php echo $adminLanguage->A_COMP_SELECT_MENU;?>
					</td>
					<td>
					<?php echo $lists['menuselect']; ?>
					</td>
				<tr>
				<tr>
					<td valign="top" width="100px">
					<?php echo $adminLanguage->A_COMP_MENU_TYPE;?>
					</td>
					<td>
					<?php echo $lists['link_type']; ?>
					</td>
				<tr>
				<tr>
					<td valign="top" width="100px">
					<?php echo $adminLanguage->A_COMP_MENU_NAME;?>
					</td>
					<td>
					<input type="text" name="link_name" class="inputbox" value="" size="25" />
					</td>
				<tr>
				<tr>
					<td>
					</td>
					<td>
					<input name="menu_link" type="button" class="button" value="<?php echo $adminLanguage->A_COMP_LINK_TO_MENU;?>" onClick="submitbutton('menulink');" />
					</td>
				<tr>
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_MENU_LINKS;?>
					</th>
				</tr>
				<?php
				if ( $menus == NULL ) {
					?>
					<tr>
						<td colspan="2">
						<?php echo $adminLanguage->A_COMP_NONE;?>
						</td>
					</tr>
					<?php
				} else {
					mosCommonHTML::menuLinksSecCat( $menus );
				}
				?>
				<tr>
					<td colspan="2">
					</td>
				</tr>
				</table>
			<?php
			} else {
			?>
			
			<table class="adminform" width="40%">
				<tr><th>&nbsp;</th></tr>
				<tr><td><?php echo $adminLanguage->A_COMP_SECT_MENU_LINK;?></td></tr>
			</table>
			<?php
			}
			?>
			</td>
		</tr>
		</table>
			</td>
					</tr>
					</table>
					</div>
					</td>
					
				</tr>
			</table>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="scope" value="<?php echo $row->scope; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="oldtitle" value="<?php echo $row->title ; ?>" />
		</form>
		<?php
	}


	/**
	* Form to select Section to copy Category to
	*/
	function copySectionSelect( $option, $cid, $categories, $contents, $section ) {
		global $adminLanguage;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<br />
		<table class="adminheading">
		<tr>
			<th class="sections">
			<?php echo $adminLanguage->A_COMP_SECT_COPY;?>
			</th>
		</tr>
		</table>

		<br />
		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td align="left" valign="top" width="30%">
			<strong><?php echo $adminLanguage->A_COMP_SECT_COPY_TO;?>:</strong>
			<br />
			<input class="text_area" type="text" name="title" value="" size="35" maxlength="50" title="<?php echo $adminLanguage->A_COMP_SECT_NEW_NAME;?>" />
			<br /><br />
			</td>
			<td align="left" valign="top" width="20%">
			<strong><?php echo $adminLanguage->A_COMP_CATEG_BEING_COPIED;?>:</strong>
			<br />
			<?php
			echo "<ol>";
			foreach ( $categories as $category ) {
				echo "<li>". $category->name ."</li>";
				echo "\n <input type=\"hidden\" name=\"category[]\" value=\"$category->id\" />";
			}
			echo "</ol>";
			?>
			</td>
			<td valign="top" width="20%">
			<strong><?php echo $adminLanguage->A_COMP_CATEG_ITEMS_COPIED;?>:</strong>
			<br />
			<?php
			echo "<ol>";
			foreach ( $contents as $content ) {
				echo "<li>". $content->title ."</li>";
				echo "\n <input type=\"hidden\" name=\"content[]\" value=\"$content->id\" />";
			}
			echo "</ol>";
			?>
			</td>
			<td valign="top">
			<?php echo $adminLanguage->A_COMP_SECT_WILL_COPY;?>
			</td>.
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="section" value="<?php echo $section;?>" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="scope" value="content" />
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
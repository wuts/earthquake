<?php
/**
* @version $Id: admin.typedcontent.html.php,v 1.4 2005/10/21 17:33:55 lang3 Exp $
* @package Mambo
* @subpackage Content
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Content
*/
class HTML_typedcontent {

	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showContent( &$rows, &$pageNav, $option, $search, &$lists ) {
		global $my, $acl, $adminLanguage;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="edit">
			<?php echo $adminLanguage->A_COMP_TYPED_STATIC;?>
			</th>
			<td>
			<?php echo $adminLanguage->A_COMP_FILTER;?>:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
			<td>
			<?php echo $adminLanguage->A_COMP_FRONT_ORDER;?>:
			</td>
			<td>
			<?php echo $lists['order']; ?>
			</td>
			<td width="right">
			<?php echo $lists['authorid'];?>
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5">
			<?php echo $adminLanguage->A_COMP_NB;?>
			</th>
			<th width="5px">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_COMP_TITLE;?>
			</th>
			<th width="5%">
			<?php echo $adminLanguage->A_COMP_PUBLISHED;?>
			</th>
			<th width="2%">
			<?php echo $adminLanguage->A_COMP_ORDER;?>
			</th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_COMP_SAVE_ORDER;?>" /></a>
			</th>
			<th width="10%">
			<?php echo $adminLanguage->A_COMP_ACCESS;?>
			</th>
			<th width="5%">
			<?php echo $adminLanguage->A_COMP_ID;?>
			</th>
			<th width="1%" align="left">
			<?php echo $adminLanguage->A_COMP_TYPED_LINKS;?>
			</th>
			<th width="20%" align="left">
			<?php echo $adminLanguage->A_COMP_AUTHOR;?>
			</th>
			<th align="left" width="10%">
			<?php echo $adminLanguage->A_COMP_DATE;?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$now = date( "Y-m-d H:i:s" );
			if ( $row->state == "1" ) {
				$img = 'publish_g.png';
				$alt = $adminLanguage->A_COMP_PUBLISHED;
			}
			else {
				$img = "publish_x.png";
				$alt = $adminLanguage->A_COMP_UNPUBLISHED;
			}

			if ( !$row->access ) {
				$color_access = 'style="color: green;"';
				$task_access = 'accessregistered';
			} else if ( $row->access == 1 ) {
				$color_access = 'style="color: red;"';
				$task_access = 'accessspecial';
			} else {
				$color_access = 'style="color: black;"';
				$task_access = 'accesspublic';
			}

			$link = 'index2.php?option=com_typedcontent&task=edit&hidemainmenu=1&id='. $row->id;

			if ( $row->checked_out ) {
				$checked	 		= mosCommonHTML::checkedOut( $row );
			} else {
				$checked	 		= mosHTML::idBox( $i, $row->id, ($row->checked_out && $row->checked_out != $my->id ) );
			}

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='. $row->created_by;
					$author = '<a href="'. $linkA .'" title="' . $adminLanguage->A_COMP_CONTENT_EDIT_USER . '">'. $row->creator .'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->creator;
				}
			}

			$date = mosFormatDate( $row->created, '%x' );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
					if ( $row->title_alias ) {
						echo ' (<i>'. $row->title_alias .'</i>)';
					}
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_COMP_CONTENT_EDIT_STATIC;?>">
					<?php
					echo $row->title;
					if ( $row->title_alias ) {
						echo ' (<i>'. $row->title_alias .'</i>)';
					}
					?>
					</a>
					<?php
				}
				?>
				</td>
				<td align="center">
				<a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->state ? "unpublish" : "publish";?>')">
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
				</a>
				</td>

				<td align="center" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task_access;?>')" <?php echo $color_access; ?>>
				<?php echo $row->groupname;?>
				</a>
				</td>
				<td align="center">
				<?php echo $row->id;?>
				</td>
				<td align="center">
				<?php echo $row->links;?>
				</td>
				<td align="left">
				<?php echo $author;?>
				</td>
				<td>
				<?php echo $date; ?>
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

	function edit( &$row, &$images, &$lists, &$params, $option, &$menus ) {
		global $mosConfig_live_site, $adminLanguage;

		//mosMakeHtmlSafe( $row );
		$tabs = new mosTabs( 1 );
		// used to hide "Reset Hits" when hits = 0
		if ( !$row->hits ) {
			$visibility = "style='display: none; visbility: hidden;'";
		} else {
			$visibility = "";
		}

		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();
		?>
		<script language="javascript" type="text/javascript">
		var folderimages = new Array;
		<?php
		$i = 0;
		foreach ($images as $k=>$items) {
			foreach ($items as $v) {
				echo "\n	folderimages[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );";
			}
		}
		?>
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if ( pressbutton ==' resethits' ) {
				if (confirm('<?php echo $adminLanguage->A_COMP_CONTENT_ZERO;?>')){
					submitform( pressbutton );
					return;
				} else {
					return;
				}
			}

			if ( pressbutton == 'menulink' ) {
				if ( form.menuselect.value == "" ) {
					alert( "<?php echo $adminLanguage->A_COMP_SECT_SEL_MENU;?>" );
					return;
				} else if ( form.link_name.value == "" ) {
					alert( "<?php echo $adminLanguage->A_COMP_ENTER_MENU_NAME;?>" );
					return;
				}
			}

			var temp = new Array;
			for (var i=0, n=form.imagelist.options.length; i < n; i++) {
				temp[i] = form.imagelist.options[i].value;
			}
			form.images.value = temp.join( '\n' );

			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			if (trim(form.title.value) == ""){
				alert( "<?php echo $adminLanguage->A_COMP_CONTENT_MUST_TITLE;?>" );
			} else if (trim(form.name.value) == ""){
				alert( "<?php echo $adminLanguage->A_COMP_CONTENT_MUST_NAME;?>" );
			} else {
				if ( form.reset_hits.checked ) {
					form.hits.value = 0;
				} else {
				}
				<?php getEditorContents( 'editor1', 'introtext' ) ; ?>
				submitform( pressbutton );
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
		<table class="adminheading">
		<tr>
			<th class="edit">
			<?php echo $adminLanguage->A_COMP_TYPED_ITEM;?>:
			<small>
			<?php echo $row->id ? $adminLanguage->A_COMP_EDIT : $adminLanguage->A_COMP_NEW;?>
			</small>
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
		<form action="index2.php" method="post" name="adminForm">
		<input type ="hidden" name="simple_editing" value=''>
		
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top">
				<table class="adminform">
				<tr>
					<th colspan="3">
					<?php echo $adminLanguage->A_COMP_CONTENT_ITEM_DETAILS;?>
					</th>
				<tr>
				<tr>
					<td align="left">
					<?php echo $adminLanguage->A_COMP_TITLE;?>:
					</td>
					<td>
					<input class="inputbox" type="text" name="title" size="30" maxlength="100" value="<?php echo $row->title; ?>" />
					</td>
				</tr>
				<tr>
					<td align="left">
					<?php echo $adminLanguage->A_COMP_CONTENT_TITLE_ALIAS;?>:
					</td>
					<td>
					<input class="inputbox" type="text" name="title_alias" size="30" maxlength="100" value="<?php echo $row->title_alias; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" colspan="2">
					<?php echo $adminLanguage->A_COMP_TYPED_TEXT;?><br />
					<?php
					// parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor1',  $row->introtext, 'introtext', '100%;', '400', '65', '50' );
					?>
					</td>
				</tr>
				</table>
			</td>
			
			<td valign="top" align="right">
			<div id="simpleediting" style="display:<?php echo $simpleediting;?>">
			<table width="100%" >
				<tr>
					<td width="200">
			
						<table width="400">
						<tr>
							<td >
				<?php
				$tabs->startPane("content-pane");
				$tabs->startTab($adminLanguage->A_COMP_CONT_PUB_TAB, "publish-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_CONT_PUBLISHING;?>
					</th>
				<tr>
				<tr>
					<td valign="top" align="right">
					<?php echo $adminLanguage->A_COMP_STATE;?>:
					</td>
					<td>
					<?php echo $row->state > 0 ? $adminLanguage->A_COMP_PUBLISHED : $adminLanguage->A_COMP_CONTENT_DRAFT_UNPUB; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo $adminLanguage->A_COMP_PUBLISHED;?>:
					</td>
					<td>
					<input type="checkbox" name="published" value="1" <?php echo $row->state ? 'checked="checked"' : ''; ?> />
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo $adminLanguage->A_COMP_ACCESS_LEVEL;?>:
					</td>
					<td>
					<?php echo $lists['access']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo $adminLanguage->A_COMP_CONTENT_AUTHOR;?>:
					</td>
					<td>
					<input type="text" name="created_by_alias" size="30" maxlength="100" value="<?php echo $row->created_by_alias; ?>" class="inputbox" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo $adminLanguage->A_COMP_CONTENT_CREATOR;?>:
					</td>
					<td>
					<?php echo $lists['created_by']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo $adminLanguage->A_COMP_CONTENT_OVERRIDE;?>
					</td>
					<td>
					<input class="inputbox" type="text" name="created" id="created" size="25" maxlength="19" value="<?php echo $row->created; ?>" />
					<input name="reset" type="reset" class="button" onClick="return showCalendar('created', 'y-mm-dd');" value="...">
					</td>
				</tr>
				</table>
				<br />
				<table class="adminform">
				<?php
				if ( $row->id ) {
					?>
					<tr>
						<td>
						<strong><?php echo $adminLanguage->A_COMP_CONTENT_ID;?>:</strong>
						</td>
						<td>
						<?php echo $row->id; ?>
						</td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td width="90px" valign="top" align="right">
					<strong><?php echo $adminLanguage->A_COMP_STATE;?></strong>
					</td>
					<td>
					<?php echo $row->state > 0 ? $adminLanguage->A_COMP_PUBLISHED : $adminLanguage->A_COMP_CONTENT_DRAFT_UNPUB ;?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<strong><?php echo $adminLanguage->A_COMP_HITS;?></strong>
					</td>
					<td>
					<?php echo $row->hits;?>
					<div <?php echo $visibility; ?>>
					<input name="reset_hits" type="button" class="button" value="<?php echo $adminLanguage->A_COMP_CONTENT_RESET_HIT;?>" onClick="submitbutton('resethits');">
					</div>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<strong><?php echo $adminLanguage->A_COMP_ADMIN_VERSION;?></strong>
					</td>
					<td>
					<?php echo "$row->version";?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<strong><?php echo $adminLanguage->A_CREATED;?></strong>
					</td>
					<td>
					<?php echo $row->created ? "$row->created</td></tr><tr><td valign='top' align='right'><strong>By</strong></td><td>$row->creator" : "New document";?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<strong><?php echo $adminLanguage->A_COMP_CONTENT_LAST_MOD;?></strong>
					</td>
					<td>
					<?php echo $row->modified ? $row->modified ."</td></tr><tr><td valign='top' align='right'><strong>". $adminLanguage->A_COMP_CONTENT_BY ."</strong></td><td>". $row->modifier : $adminLanguage->A_COMP_CONTENT_NOT_MOD;?>
					</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_COMP_CONTENT_IMAGES2, "images-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_CONTENT_MOSIMAGE;?>
					</th>
				<tr>
				<tr>
					<td colspan="6"><?php echo $adminLanguage->A_COMP_CONTENT_SUB_FOLDER;?>: <?php echo $lists['folders'];?></td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_CONTENT_GALLERY;?>:
					<br />
					<?php echo $lists['imagefiles'];?>
					<br />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_COMP_ADD;?>" onClick="addSelectedToList('adminForm','imagefiles','imagelist')" />
					</td>
					<td valign="top">
					<img name="view_imagefiles" src="../images/M_images/blank.png" width="100" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_COMP_CONTENT_IMAGES;?>:
					<br />
					<?php echo $lists['imagelist'];?>
					<br />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_COMP_CONTENT_UP;?>" onClick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_COMP_CONTENT_DOWN;?>" onClick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_COMP_CONTENT_REMOVE;?>" onClick="delSelectedFromList('adminForm','imagelist')" />
					</td>
					<td valign="top">
					<img name="view_imagelist" src="../images/M_images/blank.png" width="100" />
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $adminLanguage->A_COMP_CONTENT_EDIT_IMAGE;?>:
						<table>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_SOURCE;?>:
							</td>
							<td>
							<input type="text" name= "_source" value="" />
							</td>
						</tr>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_CONTENT_ALIGN;?>:
							</td>
							<td>
							<?php echo $lists['_align']; ?>
							</td>
						</tr>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_CONTENT_ALT;?>:
							</td>
							<td>
							<input type="text" name="_alt" value="" />
							</td>
						</tr>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_CONTENT_BORDER;?>:
							</td>
							<td>
							<input type="text" name="_border" value="" size="3" maxlength="1" />
							</td>
						</tr>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_CONTENT_IMG_CAPTION;?>:
							</td>
							<td>
							<input class="text_area" type="text" name="_caption" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_CONTENT_IMG_CAPTION_POS;?>:
							</td>
							<td>
							<?php echo $lists['_caption_position']; ?>
							</td>
						</tr>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_CONTENT_IMG_CAPTION_ALIGN;?>:
							</td>
							<td>
							<?php echo $lists['_caption_align']; ?>
							</td>
						</tr>
						<tr>
							<td align="right">
							<?php echo $adminLanguage->A_COMP_CONTENT_IMG_WIDTH;?>:
							</td>
							<td>
							<input class="text_area" type="text" name="_width" value="" size="5" maxlength="5" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<input class="button" type="button" value="<?php echo $adminLanguage->A_COMP_CONTENT_APPLY;?>" onClick="applyImageProps()" />
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_COMP_CONT_PARAMETERS, "params-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_CONTENT_PARAM;?>
					</th>
				<tr>
				<tr>
					<td>
					<?php echo $params->render();?>
					</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_COMP_CONTENT_META_INFO, "metadata-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_CONTENT_META_DATA;?>
					</th>
				<tr>
				<tr>
					<td align="left">
					<?php echo $adminLanguage->A_COMP_DESCRIPTION;?>:<br />
					<textarea class="inputbox" cols="40" rows="5" name="metadesc" style="width:300px"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea>
					</td>
				</tr>
				<tr>
					<td align="left">
					<?php echo $adminLanguage->A_COMP_CONTENT_KEYWORDS;?>:<br />
					<textarea class="inputbox" cols="40" rows="5" name="metakey" style="width:300px"><?php echo str_replace('&','&amp;',$row->metakey); ?></textarea>
					</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_COMP_CONTENT_LINK_TO_MENU, "link-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo $adminLanguage->A_COMP_LINK_TO_MENU;?>
					</th>
				<tr>
				<tr>
					<td colspan="2">
					<?php echo $adminLanguage->A_COMP_TYPED_WILL;?>
					<br /><br />
					</td>
				<tr>
				<tr>
					<td valign="top" width="90px">
					<?php echo $adminLanguage->A_COMP_SELECT_MENU;?>
					</td>
					<td>
					<?php echo $lists['menuselect']; ?>
					</td>
				<tr>
				<tr>
					<td valign="top" width="90px">
					<?php echo $adminLanguage->A_COMP_MENU_NAME;?>
					</td>
					<td>
					<input type="text" name="link_name" class="inputbox" value="" size="30" />
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
					mosCommonHTML::menuLinksContent( $menus );
				}
				?>
				<tr>
					<td colspan="2">
					</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->endPane();
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
			
		</td>
	</tr>
</table>
		<input type="hidden" name="images" value="" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="hits" value="<?php echo $row->hits; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}
}
?>
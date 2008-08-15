<?php
/**
* @version $Id: content.html.php,v 1.4 2005/10/26 10:40:00 csouza Exp $
* @package Mambo
* @subpackage Content
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/HTML_toolbar.php' );

/**
* Utility class for writing the HTML for content
* @package Mambo
* @subpackage Content
*/
class HTML_content {
	/**
	* Show Content List of all categories in a section
	* Used by Content Section
	*/
	function showSectionContentList( $section, $items, $gid, $params, $categories, $pageNav ) {
		global $mosConfig_offset, $mainframe, $my, $database, $Itemid, $mosConfig_live_site;
		global $iscf, $cf_begindate, $cf_enddate;
		$now 		= date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60 );
		$noauth = !$mainframe->getCfg( 'shownoauth' );
		$sectionid = $section->id;
		
		$categorylist = $params->get( 'categorylist', 1 );
		$sectionitemlist = $params->def( 'sectionitemlist', 0 );
	
		$urltarget = $params->get( 'target' ) ? 'target="_blank"' : '';
		$pageclass_sfx = $params->get( 'pageclass_sfx', '' );
		
		if ( $params->get( 'page_title' ) ) {
			?>
			<div class="componentheading<?php echo $pageclass_sfx; ?>">
			<?php echo $section->title; ?>
			</div>
			<?php
		}
		
		$descrip = $params->get( 'description', 0 );
		$descrip_image = $params->get( 'description_image', 0 );
		// Category Description & Image
		if ( ($descrip && $section->description) || ($descrip_image && $section->image) ) {
			echo '<table><tr>';
			echo '<td class="contentdescription'. $pageclass_sfx .'">';
			if ( $descrip_image && $section->image ) {
				$link = $mosConfig_live_site .'/images/stories/'. $section->image;
				echo '<img src="'. $link .'" align="'. $section->image_position .'" border="0" hspace="6" alt="" />';
			}
			if ( $descrip && $section->description ) {
				echo $section->description;
			}
			echo '</td>';
			echo '</tr></table>';
		}

		if ($categorylist) {
			$categoryitems = $params->get( 'categoryitems', 0 );
			$categoriesperrow = $params->get( 'categoriesperrow', 2 );
			$categoryitemlist = $params->get( 'categoryitemlist', 1 );
			$itemcount = $params->get( 'itemcount', 5 );
			$titlelength = $params->get( 'titlelength', 40 );
			$datedisplay = $params->get( 'datedisplay', 0 );
			echo '<h3><table width="100%" border="0" cellspacing="0" cellpadding="0">';
			$ci = 0;
			$crow = 0;
			if (empty($categoriesperrow)) $categoriesperrow = 2;
			$widthpercent = floor(100 / $categoriesperrow) - 1;
			
			foreach ( $categories as $cat ) {
				$catid = $cat->id;
				$catlink = "index.php?option=com_content&task=category&sectionid=$sectionid&id=$catid&Itemid=$Itemid";
				if ($iscf) {
					$catlink .= "&begindate=$cf_begindate&enddate=$cf_enddate";
				}
				$catlink = sefRelToAbs($catlink);
				$cattitle = $categoryitems ? $cat->title . " (". $cat->count .")" : $cat->title;
				if ($ci==0) echo "<tr>";
				if (empty($categoryitemlist)) {
					echo '<td width="' . $widthpercent . '%" class="contentcatlist'. $pageclass_sfx .'"><a href="' . $catlink . '">' . $cattitle . '</a></td>';
				}
				else {
					$query = "SELECT a.id, a.title, a.created, a.sectionid, a.catid"
					. "\n FROM #__content AS a"
					. "\n WHERE ( a.state = '1' )"
			    	. ( $noauth ? "\n AND a.access <= '". $gid ."'" : '' )
					. "\n AND ( a.catid =$catid )"
					. ( $iscf ? "\n AND a.created>'$cf_begindate' AND a.created<'$cf_enddate'" : '' )
					. "\n ORDER BY a.created DESC LIMIT $itemcount"
					;
					$database->setQuery( $query );
					$contentRows = $database->loadObjectList();
?>
					<td width="<?php echo $widthpercent;?>%" valign="top">
					<table width="95%" border="0" cellspacing="0" cellpadding="0" >
					<tr><td width="100%" class="contentcatlist<?php echo $pageclass_sfx; ?>"><?php echo "<a href='$catlink'>$cattitle</a>";?></td>
					</tr>
					<tr><td width="100%", valign="top" >
					<ul>
<?php
				foreach ( $contentRows as $contentRow ) {
					$id = $contentRow->id;
					$link = sefRelToAbs( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$Itemid" );
					$title = $contentRow->title;
					if (strlen($title) > $titlelength) {
						$title =  substr( $title, 0, $titlelength ) . "...";
					}
					$datestr = $datedisplay ? ' (' . date($datedisplay, strtotime( $contentRow->created ) ) . ')' : '';
?>
					<li>
					<a href="<?php echo $link; ?>" <?php echo $urltarget;?>><?php echo $title . $datestr; ?></a>
					</li>
<?php
				}
?>
					</ul>
					</td></tr>
					<tr><td width="100%", valign="top" >
						<?php echo "<a href='$catlink'>". _MORE ."</a>";?>
					</td></tr>
					<tr><td>&nbsp;</td></tr>
					</table>
				</td>
<?php					
				}
				$ci++;
				if ($ci >= $categoriesperrow) {
					echo "</tr>";
					$ci = 0;
					$crow++;
				}
				
			}
			if ($ci!=0) {
				if ($crow) {
					$colspan = $categoriesperrow - $ci;
					$colspan = ($colspan == 1) ? '' : 'colspan="' . $colspan . '"';
					echo "<td $colspan>&nbsp;</td>";
				}
				echo "</tr>";
			}
			echo '</table></h3>';
		}
?>
		<br />
		<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="contentpane<?php echo $pageclass_sfx; ?>">
		<tr>
			<td>
			<?php
			// Displays the Table of Items in Section View
			if ( $items ) {
				$catid = 0;
				HTML_content::showTable( $params, $items, $gid, $sectionid, $catid, $pageNav, $access );
			}
			?>
			</td>
		</tr>
		</table>
<?php
		// displays back button
		mosHTML::BackButton ( $params );
	}
	
		
	/**
	* Draws a Content List
	* Used by Content Category & Content Section
	*/
	function showCategoryContentList( $category, $items, $access, $gid, $params, $pageNav=NULL ) {
		global $Itemid, $mosConfig_live_site;

		$catid = $category->id;
		$sectionid = $category->section;

		$pageclass_sfx = $params->get( 'pageclass_sfx', '' );
		if ( $params->get( 'page_title' ) ) {
			?>
			<div class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<?php echo $category->title; ?>
			</div>
			<?php
		}
		$descrip = $params->get( 'description', 0 );
		$descrip_image = $params->get( 'description_image', 0 );
		// Category Description & Image
		if ( ($descrip && $category->description) || ($descrip_image && $category->image) ) {
			echo '<table><tr>';
			echo '<td class="contentdescription'. $pageclass_sfx .'">';
			if ( $descrip_image && $category->image ) {
				$link = $mosConfig_live_site .'/images/stories/'. $category->image;
				echo '<img src="'. $link .'" align="'. $category->image_position .'" border="0" hspace="6" alt="" />';
			}
			if ( $descrip && $category->description ) {
				echo $category->description;
			}
			echo '</td>';
			echo '</tr></table>';
		}
		?>
		<br />
		<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="contentpane<?php echo $pageclass_sfx; ?>">
		<tr>
			<td>
			<?php
			// Displays the Table of Items in Category View
			if ( $items ) {
				HTML_content::showTable( $params, $items, $gid, $sectionid, $catid, $pageNav, $access );
			} else if ( $catid ) {
				echo '<br />';
			}
			?>
			</td>
		</tr>
		</table>
		<?php
		// displays back button
		mosHTML::BackButton ( $params );
	}


	/**
	* Display links to categories
	*/
	function showCategories( &$params, &$items, $gid, &$other_categories, $catid, $sectionid, $Itemid ) {
		?>
		<ul>
		<?php
		foreach ( $other_categories as $row ) {
			if ( $catid != $row->id ) {
				if ( $row->access <= $gid ) {
					$link = sefRelToAbs( "index.php?option=com_content&task=category&sectionid=$sectionid&id=" . $row->id . "&Itemid=$Itemid" );
					?>
					<li>
					<a href="<?php echo $link; ?>" class="category">
					<?php echo $row->name;?>
					</a>
					<?php
					// Writes Category Description
					if ( $params->get( 'cat_description' ) && $row->description ) {
						echo "<br />";
						echo $row->description;
					}
					?>
					</li>
				<?php
				} else {
					?>
					<li>
					<?php echo $row->name; ?>
					<a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=register' ); ?>">
					( <?php echo _E_REGISTERED; ?> )
					</a>
					<?php
				}
			}
		}
		?>
		</ul>
		<?php
	}


	/**
	* Display Table of items
	*/
	function showTable( &$params, &$items, &$gid, $sectionid, $catid, &$pageNav, &$access ) {
		global $mosConfig_live_site, $Itemid;
		global $iscf, $cf_begindate, $cf_enddate;
		$urltarget = $params->get( 'target' ) ? 'target="_blank"' : '';
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php
		if ( $params->get( 'headings' ) ) {
			?>
			<tr>
				<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" width="58%">
				<?php echo _HEADER_TITLE; ?>
				</td>
				<?php
				if ( $params->get( 'author' ) ) {
					?>
					<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" align="left" width="15%">
					<?php echo _HEADER_AUTHOR; ?>
					</td>
					<?php
				}
				if ( $params->get( 'date' ) ) {
					?>
					<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" width="22%">
					&nbsp;<?php echo _DATE; ?>
					</td>
					<?php
				}
				if ( $params->get( 'hits' ) ) {
					?>
					<td align="center" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" width="5%">
					<?php echo _HEADER_HITS; ?>
					</td>
					<?php
				}
				?>
			</tr>
			<?php
		}

		$k = 0;
		foreach ( $items as $row ) {
			$id = $row->id;
			$row->created = mosFormatDate ($row->created, $params->get( 'date_format' ));
			?>
			<tr class="sectiontableentry<?php echo ($k+1) . $params->get( 'pageclass_sfx' ); ?>" >
				<?php
				if( $row->access <= $gid ){
					$link = sefRelToAbs( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$Itemid" );
					?>
					<td>
					<a href="<?php echo $link; ?>" <?php echo $urltarget;?>>
					<?php echo $row->title; ?>
					</a>
					<?php
					HTML_content::EditIcon( $row, $params, $access );
					?>
					</td>
					<?php
				} else {
					?>
					<td>
					<?php
					echo $row->title .' : ';
					$link = sefRelToAbs( 'index.php?option=com_registration&amp;task=register' );
					?>
					<a href="<?php echo $link; ?>">
					<?php echo _READ_MORE_REGISTER; ?>
					</a>
					</td>
					<?php
				}
				
				if ( $params->get( 'author' ) ) {
					?>
					<td align="left">
					<?php echo $row->created_by_alias ? $row->created_by_alias : $row->author; ?>
					</td>
					<?php
				}
				if ( $params->get( 'date' ) ) {
					?>
					<td>
					<?php echo $row->created; ?>
					</td>
					<?php
				}
				if ( $params->get( 'hits' ) ) {
				?>
					<td align="center">
					<div align="right"><?php echo $row->hits ? $row->hits : '-'; ?></div>
					</td>
				<?php
			} ?>
		</tr>
		<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php
		if ( $params->get( 'navigation' ) ) {
			?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center" class="sectiontablefooter<?php echo $params->get( 'pageclass_sfx' ); ?>">
				<?php
				if ($catid) {
					$link = "index.php?option=com_content&task=category&sectionid=$sectionid&id=$catid&Itemid=$Itemid";
				}
				else {
					$link = "index.php?option=com_content&task=section&id=$sectionid&Itemid=$Itemid";
				}
				if ($iscf) {
					$link .= "&begindate=$cf_begindate&enddate=$cf_enddate";
				}
				echo $pageNav->writePagesLinks( $link );
				?>
				</td>
			</tr>
			<tr>
				<td align="right">
				<?php echo $pageNav->writePagesCounter(); ?>
				</td>
			</tr>
		</table>
			<?php
		}
		?>
		<?php
		if ( $access->canEdit || $access->canEditOwn ) {
			$link = sefRelToAbs( 'index.php?option=com_content&amp;task=new&amp;sectionid='. $sectionid .'&amp;cid='. $row->id .'&amp;Itemid='. $Itemid );
			?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="4">
				<a href="<?php echo $link; ?>">
				<img src="<?php echo $mosConfig_live_site;?>/images/M_images/new.png" width="13" height="14" align="middle" border="0" alt="<?php echo _CMN_NEW;?>" />
				&nbsp;<?php echo _CMN_NEW;?>...
				</a>
				</td>
			</tr>
		</table>
			<?php
		}
	}


	/**
	* Display links to content items
	*/
	function showLinks( &$rows, $links, $total, $i=0, $urltarget ) {
		global $mainframe, $option, $Itemid;

		$_Itemid = $Itemid;
		?>
		<div><strong><?php echo _MORE; ?></strong></div>
		<ul>
		<?php
		for ( $z = 0; $z < $links; $z++ ) {
			if ( $i >= $total ) {
				// stops loop if total number of items is less than the number set to display as intro + leading
				break;
			}
			$sectionid = $rows[$i]->sectionid;
			$catid = $rows[$i]->catid;
			$id = $rows[$i]->id;

			if ( $option == 'com_frontpage' ) {
				$_Itemid = getContentItemid($sectionid, $catid, $id);
			}
			
			$link = sefRelToAbs( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$_Itemid" );
			?>
			<li>
			<a class="blogsection" href="<?php echo $link; ?>" <?php echo $urltarget; ?>>
			<?php echo $rows[$i]->title; ?>
			</a>
			</li>
			<?php
			$i++;
		}
		?>
		</ul>
		<?php
	}


	/**
	* Show a content item
	* @param object An object with the record data
	* @param boolean If <code>false</code>, the print button links to a popup window.  If <code>true</code> then the print button invokes the browser print method.
	*/
	function show( $row, $params, $access, $page=0, $option ) {
		global $mainframe, $my, $hide_js;
		global $mosConfig_sitename, $Itemid, $mosConfig_live_site, $task;
		global $_MAMBOTS;

		$gid 		= $my->gid;
		$_Itemid 	= $Itemid;
		$sectionid = $row->sectionid;
		$catid = $row->catid;
		$id = $row->id;
		$link_on 	= '';
		$link_text 	= '';
		$urltarget = $params->get( 'target' ) ? 'target="_blank"' : '';

		// process the new bots
		$_MAMBOTS->loadBotGroup( 'content' );
		$results = $_MAMBOTS->trigger( 'onPrepareContent', array( &$row, &$params, $page ), true );

		// adds mospagebreak heading or title to <site> Title
		if ( @$row->page_title ) {
			$mainframe->SetPageTitle( $row->title .': '. $row->page_title );
		}

		// determines the link and link text of the readmore button
		if ( $params->get( 'intro_only' ) ) {
			// checks if the item is a public or registered/special item
			if ( $row->access <= $gid ) {
				if ($option == "com_frontpage") {
					$_Itemid = getContentItemid($sectionid, $catid, $id);
				}
				
				if ( $params->get( 'url' ) && $row->urls ) {
					$link_on = "index.php?option=com_content&task=wrapper&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$_Itemid";
				}
				else {
					$link_on = "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$_Itemid";
				}
				$link_on = sefRelToAbs($link_on);
				if ( strlen( trim( $row->fulltext ) )) {
					$link_text = _READ_MORE;
				}
			} else {
				$link_on = sefRelToAbs("index.php?option=com_registration&amp;task=register");
				if (strlen( trim( $row->fulltext ) )) {
					$link_text = _READ_MORE_REGISTER;
				}
			}
		}

		$no_html = mosGetParam( $_REQUEST, 'no_html', null);

		// for pop-up page
		if ( $params->get( 'popup' ) && $no_html == 0) {
		    ?>
			<title>
			<?php echo $mosConfig_sitename .' :: '. $row->title; ?>
			</title>
			<?php
		}

		// determines links to next and prev content items within category
		if ( $params->get( 'item_navigation' ) ) {
			if ( $row->prev ) {
				$id = $row->prev;
				$row->prev = sefRelToAbs( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$_Itemid" );
			} else {
				$row->prev = 0;
			}
			if ( $row->next ) {
				$id = $row->next;
				$row->next = sefRelToAbs( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$_Itemid" );
			} else {
				$row->next = 0;
			}
		}

		if ( $params->get( 'item_title' ) || $params->get( 'pdf' )  || $params->get( 'print' ) || $params->get( 'email' ) ) {
			// link used by print button
			$print_link = $mosConfig_live_site. '/index2.php?option=com_content&amp;task=view&amp;id='. $row->id .'&amp;Itemid='. $Itemid .'&amp;pop=1&amp;page='. @$page;
			?>
			<table class="contentpaneopen<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<tr>
				<?php
				// displays Item Title
				HTML_content::Title( $row, $params, $link_on, $access, $urltarget );

				// displays PDF Icon
				HTML_content::PdfIcon( $row, $params, $link_on, $hide_js );

				// displays Print Icon
				mosHTML::PrintIcon( $row, $params, $hide_js, $print_link );

				// displays Email Icon
				HTML_content::EmailIcon( $row, $params, $hide_js );
				?>
			</tr>
			</table>
			<?php
 		} else if ( $access->canEdit ) {
 			// edit icon when item title set to hide
 			?>
			<table class="contentpaneopen<?php echo $params->get( 'pageclass_sfx' ); ?>">
 			<tr>
 				<td>
 				<?php
 				HTML_content::EditIcon( $row, $params, $access );
 				?>
 				</td>
 			</tr>
 			</table>
 			<?php
  		}

		if ( !$params->get( 'intro_only' ) ) {
			$results = $_MAMBOTS->trigger( 'onAfterDisplayTitle', array( &$row, &$params, $page ) );
			echo trim( implode( "\n", $results ) );
		}

		$results = $_MAMBOTS->trigger( 'onBeforeDisplayContent', array( &$row, &$params, $page ) );
		echo trim( implode( "\n", $results ) );
		?>

		<table class="contentpaneopen<?php echo $params->get( 'pageclass_sfx' ); ?>">
		<?php
		// displays Category Name or URL
		HTML_content::Category( $row, $params );

		// displays Author Name and Created Date
		HTML_content::AuthorNCreateDate( $row, $params );
		
		// displays Author Name
		//HTML_content::Author( $row, $params );

		// displays Created Date
		//HTML_content::CreateDate( $row, $params );

		?>
		<tr>
			<td valign="top" colspan="2">
			<?php
			// displays Table of Contents
			HTML_content::TOC( $row );

			// displays Item Text
			echo $row->text;
			?>
			</td>
		</tr>
		<?php
		
		// displays Urls
		HTML_content::wrapURL( $row, $params, $urltarget );
		
		// displays Urls
		//HTML_content::URL( $row, $params );

		// displays Modified Date
		HTML_content::ModifiedDate( $row, $params );

		// displays Readmore button
		HTML_content::ReadMore( $params, $link_on, $link_text, $urltarget );
		?>
		</table>
		<?php
		$results = $_MAMBOTS->trigger( 'onAfterDisplayContent', array( &$row, &$params, $page ) );
		echo trim( implode( "\n", $results ) );

		// displays the next & previous buttons
		HTML_content::Navigation ( $row, $params );

		// displays close button in pop-up window
		mosHTML::CloseButton ( $params, $hide_js );

		// displays back button in pop-up window
		mosHTML::BackButton ( $params, $hide_js );
	}


	/**
	* Writes Title
	*/
	function Title( $row, $params, $link_on, $access, $urltarget ) {
		global $mosConfig_live_site, $Itemid;
		if ( $params->get( 'item_title' ) ) {
			if ( $params->get( 'link_titles' ) && $link_on != '' ) {
				?>
				<td class="contentheading<?php echo $params->get( 'pageclass_sfx' ); ?>" width="100%">
				<a href="<?php echo $link_on;?>" <?php echo $urltarget;?> class="contentpagetitle<?php echo $params->get( 'pageclass_sfx' ); ?>">
				<?php echo $row->title;?>
				</a>
				<?php HTML_content::EditIcon( $row, $params, $access ); ?>
				</td>
				<?php
			} else {
				?>
				<td class="contentheading<?php echo $params->get( 'pageclass_sfx' ); ?>" width="100%">
				<?php echo $row->title;?>
				<?php HTML_content::EditIcon( $row, $params, $access ); ?>
				</td>
				<?php
			}
		}
	}

	/**
	* Writes Edit icon that links to edit page
	*/
	function EditIcon( $row, $params, $access ) {
		global $mosConfig_live_site, $Itemid, $my;
		if ( $params->get( 'popup' ) ) {
			return;
		}
		if ( $row->state < 0 ) {
			return;
		}
		if ( !$access->canEdit && !( $access->canEditOwn && $row->created_by == $my->id ) ) {
			return;
		}
		$link = 'index.php?option=com_content&amp;task=edit&amp;id='. $row->id .'&amp;Itemid='. $Itemid .'&amp;Returnid='. $Itemid;
		$image = mosAdminMenus::ImageCheck( 'edit.png', '/images/M_images/', NULL, NULL, _E_EDIT );
		?>
		<a href="<?php echo sefRelToAbs( $link ); ?>" title="<?php echo _E_EDIT;?>">
		<?php echo $image; ?>
		</a>
		<?php
		if ( $row->state == 0 ) {
			echo '( '. _CMN_UNPUBLISHED .' )';
		}
		echo '  ( '. $row->groups .' )';
	}


	/**
	* Writes PDF icon
	*/
	function PdfIcon( $row, $params, $link_on, $hide_js ) {
		global $mosConfig_live_site;
		if ( $params->get( 'pdf' ) && !$params->get( 'popup' ) && !$hide_js ) {
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
			$link = $mosConfig_live_site. '/index2.php?option=com_content&amp;do_pdf=1&amp;id='. $row->id;
			if ( $params->get( 'icons' ) ) {
				$image = mosAdminMenus::ImageCheck( 'pdf_button.png', '/images/M_images/', NULL, NULL, _CMN_PDF );
			} else {
				$image = _CMN_PDF .'&nbsp;';
			}
			?>
			<td align="right" width="100%" class="buttonheading">
			<a href="javascript:void window.open('<?php echo $link; ?>', 'win2', '<?php echo $status; ?>');" title="<?php echo _CMN_PDF;?>">
			<?php echo $image; ?>
			</a>
			</td>
			<?php
		}
	}


	/**
	* Writes Email icon
	*/
	function EmailIcon( $row, $params, $hide_js ) {
		global $mosConfig_live_site;
		if ( $params->get( 'email' ) && !$params->get( 'popup' ) && !$hide_js ) {
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=400,height=250,directories=no,location=no';
			$link = $mosConfig_live_site .'/index2.php?option=com_content&amp;task=emailform&amp;id='. $row->id;
			if ( $params->get( 'icons' ) ) {
				$image = mosAdminMenus::ImageCheck( 'emailButton.png', '/images/M_images/', NULL, NULL, _CMN_EMAIL );
			} else {
				$image = '&nbsp;'. _CMN_EMAIL;
			}
			?>
			<td align="right" width="100%" class="buttonheading">
			<a href="javascript:void window.open('<?php echo $link; ?>', 'win2', '<?php echo $status; ?>');" title="<?php echo _CMN_EMAIL;?>">
			<?php echo $image; ?>
			</a>
			</td>
			<?php
		}
	}

	/**
	* Writes Category Name or URL
	*/
	function Category( $row, $params ) {
		if ( $params->get( 'category' ) ) {
			?>
			<tr>
				<td><span><?php echo $row->category; ?></span>
				</td>
			</tr>
		<?php
		}
	}

	/**
	* Writes Author name and Create Date
	*/
	function AuthorNCreateDate( $row, $params ) {
		global $acl;
		$Author = '';
		$create_date = '';
		if ( ( $params->get( 'author' ) ) && ( !empty($row->author) ) ) {
			$Author = '&nbsp;&nbsp;' . (empty($row->created_by_alias) ? $row->author : $row->created_by_alias);
		}
		if ( $params->get( 'createdate' ) && ( intval( $row->created ) != 0 ) ) {
			$create_date = '&nbsp;&nbsp;' . mosFormatDate( $row->created );
		}
		if (!(empty($Author) && empty($create_date))) {
			?>
			<tr>
				<td align="left" valign="top" colspan="2">
				<span class="small">
				<?php echo $Author; ?>
				</span>
				<span class="createdate">
				<?php echo $create_date; ?>
				</span>
				</td>
			</tr>
			<?php
		}
	}
	
	/**
	* Writes Author name
	*/
	function Author( $row, $params ) {
		global $acl;
		if ( ( $params->get( 'author' ) ) && ( $row->author != "" ) ) {
			$grp = $acl->getAroGroup( $row->created_by );
			$is_frontend_user = $acl->is_group_child_of( intval( $grp->group_id ), 'Public Frontend', 'ARO' );
			$by = $is_frontend_user ? _AUTHOR_BY : _WRITTEN_BY;
		?>
		<tr>
			<td width="70%" align="left" valign="top" colspan="2">
			<span class="small">
			<?php echo $by. ' '.( $row->created_by_alias ? $row->created_by_alias : $row->author ); ?>
			</span>
			&nbsp;&nbsp;
			</td>
		</tr>
		<?php
		}
	}


	/**
	* Writes Create Date
	*/
	function CreateDate( $row, $params ) {
		$create_date = null;
		if ( intval( $row->created ) != 0 ) {
			$create_date = mosFormatDate( $row->created );
		}
		if ( $params->get( 'createdate' ) ) {
			?>
			<tr>
				<td valign="top" colspan="2" class="createdate">
				<?php echo $create_date; ?>
				</td>
			</tr>
			<?php
		}
	}

	
	/**
	* wraps URLs
	*/
	function wrapURL( $row, $params, $urltarget ) {
		global $Itemid;
		if ( $params->get( 'url' ) && $row->urls ) {
			$link = 'index.php?option=com_content&amp;task=wrapper&amp;id='. $row->id .'&amp;Itemid='. $Itemid;
			?>
			<tr>
				<td valign="top" colspan="2">
				<a href="<?php echo sefRelToAbs($link); ?>" <?php echo $urltarget; ?>>
				<?php echo _READ_MORE; ?>
				</a>
				</td>
			</tr>
			<?php
		}
	}
	
	/**
	* Writes URL's
	*/
	function URL( $row, $params ) {
		if ( $params->get( 'url' ) && $row->urls ) {
			if ( (!preg_match("/^(http:\/\/)/i", $row->urls)) && (!preg_match("/^(https:\/\/)/i", $row->urls)) ) {
				$row->urls = 'http://' . $row->urls;
			}
			?>
			<tr>
				<td valign="top" colspan="2">
				<a href="<?php echo $row->urls ; ?>" target="_blank">
				<?php echo _READ_MORE; ?>
				</a>
				</td>
			</tr>
			<?php
		}
	}

	/**
	* Writes TOC
	*/
	function TOC( $row ) {
		if ( @$row->toc ) {
			echo $row->toc;
		}
	}

	/**
	* Writes Modified Date
	*/
	function ModifiedDate( $row, $params ) {
		$mod_date = null;
		if ( intval( $row->modified ) != 0) {
			$mod_date = mosFormatDate( $row->modified );
		}
		if ( ( $mod_date != '' ) && $params->get( 'modifydate' ) ) {
			?>
			<tr>
				<td colspan="2" align="left" class="modifydate">
				<?php echo _LAST_UPDATED; ?> ( <?php echo $mod_date; ?> )
				</td>
			</tr>
			<?php
		}
	}

	/**
	* Writes Readmore Button
	*/
	function ReadMore ( $params, $link_on, $link_text, $urltarget ) {
		if ( $params->get( 'readmore' ) ) {
			if ( $params->get( 'intro_only' ) && $link_text ) {
				?>
				<tr>
					<td align="left" colspan="2">
					<a href="<?php echo $link_on;?>" <?php echo $urltarget;?> class="readon<?php echo $params->get( 'pageclass_sfx' ); ?>">
					<?php echo $link_text;?>
					</a>
					</td>
				</tr>
				<?php
			}
		}
	}

	/**
	* Writes Next & Prev navigation button
	*/
	function Navigation( $row, $params ) {
		$task = mosGetParam( $_REQUEST, 'task', '' );
		if ( $params->get( 'item_navigation' ) && ( $task == "view" ) && !$params->get( 'popup' ) ) {
		?>
		<table align="center" style="margin-top: 25px;">
		<tr>
			<?php
			if ( $row->prev ) {
				?>
				<th class="pagenav_prev">
				<a href="<?php echo $row->prev; ?>">
				<?php echo _ITEM_PREVIOUS; ?>
				</a>
				</th>
				<?php
			}
			if ( $row->prev && $row->next ) {
				?>
				<td width="50px">&nbsp;

				</td>
				<?php
			}
			if ( $row->next ) {
				?>
				<th class="pagenav_next">
				<a href="<?php echo $row->next; ?>">
				<?php echo _ITEM_NEXT; ?>
				</a>
				</th>
				<?php
			}
			?>
		</tr>
		</table>
		<?php
		}
	}

	/**
	* Writes the edit form for new and existing content item
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.
	* @param mosContent The category object
	* @param string The html for the groups select list
	*/
	function editContent( &$row, $sectionname, &$lists, &$images, &$access, $myid, $sectionid, $task, $Itemid, $sectioncategories ) {
		global $mosConfig_live_site;
		mosMakeHtmlSafe( $row );
		$Returnid = intval( mosGetParam( $_REQUEST, 'Returnid', $Itemid ) );
		?>
  		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
  		<link rel="stylesheet" type="text/css" media="all" href="includes/js/calendar/calendar-mos.css" title="green" />
			<!-- import the calendar script -->
			<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/calendar/calendar.js"></script>
			<!-- import the language module -->
			<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/calendar/lang/calendar-en.js"></script>
	  	<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
	  	
	  	<script language="javascript" type="text/javascript">
		onunload = WarnUser;
		var folderimages = new Array;
		<?php
		$i = 0;
		foreach ($images as $k=>$items) {
			foreach ($items as $v) {
				echo "\n	folderimages[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );";
			}
		}
		?>
		
		var sectioncategories = new Array;
		<?php
		$i = 0;
		foreach ($sectioncategories as $k=>$items) {
			foreach ($items as $v) {
				echo "sectioncategories[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>
		
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// var goodexit=false;
			// assemble the images back into one field
			form.goodexit.value=1
			var temp = new Array;
			for (var i=0, n=form.imagelist.options.length; i < n; i++) {
				temp[i] = form.imagelist.options[i].value;
			}
			form.images.value = temp.join( '\n' );
			try {
				form.onsubmit();
			}
			catch(e){}
			// do field validation
			if (form.title.value == "") {
				alert ( "<?php echo _E_WARNTITLE; ?>" );
			} else if (parseInt('<?php echo $row->sectionid;?>')) {
				// for content items
				if (getSelectedValue('adminForm','catid') < 1) {
					alert ( "<?php echo _E_WARNCAT; ?>" );
				//} else if (form.introtext.value == "") {
				//	alert ( "<?php echo _E_WARNTEXT; ?>" );
				} else {
					<?php
					getEditorContents( 'editor1', 'introtext' );
					getEditorContents( 'editor2', 'fulltext' );
					?>
					submitform(pressbutton);
				}
			//} else if (form.introtext.value == "") {
			//	alert ( "<?php echo _E_WARNTEXT; ?>" );
			} else {
				// for static content
				<?php
				getEditorContents( 'editor1', 'introtext' ) ;
				?>
				submitform(pressbutton);
			}
		}

		function setgood(){
			document.adminForm.goodexit.value=1;
		}

		function WarnUser(){
			if (document.adminForm.goodexit.value==0) {
				alert('<?php echo _E_WARNUSER;?>');
				window.location="<?php echo sefRelToAbs("index.php?option=com_content&task=".$task."&sectionid=".$sectionid."&id=".$row->id."&Itemid=".$Itemid); ?>"
			}
		}
		</script>

		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td class="contentheading" >
			<?php echo $row->id ? _E_EDIT : _E_ADD; echo _E_CONTENT;?>
			</td>
			<td width="10%">
			 <?php
			 mosToolBar::startTable();
			 mosToolBar::save();
			 mosToolBar::spacer(25);
			 mosToolBar::cancel();
			 mosToolBar::endtable();
			 $tabs = new mosTabs(0);
			?>
			</td>
		</tr>
		</table>

		<form action="index.php" method="post" name="adminForm" onSubmit="javascript:setgood();">
		<input type="hidden" name="images" value="" />
		<table class="adminform">
		<tr>
			<td>
			<?php echo _E_TITLE; ?> <input class="inputbox" type="text" name="title" size="50" maxlength="100" value="<?php echo $row->title; ?>" />
			</td>
		</tr>
		<?php
		if ($row->sectionid) {
			?>
			<tr>
				<td>
				<?php echo _E_SECTION; echo $lists['sectionid'];?>
				</td>
			</tr>
			<tr>
				<td>
				<?php echo _E_CATEGORY; echo $lists['catid'];?>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<?php
			if (intval( $row->sectionid ) <> 0) {
				?>
				<td>
				<?php echo _E_INTRO.' ('._CMN_REQUIRED.')'; ?>:
				</td>
				<?php
			} else {
				?>
				<td>
				<?php echo _E_MAIN.' ('._CMN_REQUIRED.')'; ?>:
				</td>
			<?php
			} ?>
		</tr>
		<tr>
			<td>
			<?php
			// parameters : areaname, content, hidden field, width, height, rows, cols
			editorArea( 'editor1',  $row->introtext , 'introtext', '500', '200', '45', '5' ) ;
			?>
			</td>
		</tr>
		<?php
		if (intval( $row->sectionid ) <> 0) {
			?>
			<tr>
				<td>
				<?php echo _E_MAIN.' ('._CMN_OPTIONAL.')'; ?>:
				</td>
			</tr>
			<tr>
				<td>
				<?php
				// parameters : areaname, content, hidden field, width, height, rows, cols
				editorArea( 'editor2',  $row->fulltext , 'fulltext', '500', '400', '45', '10' ) ;
				?>
				</td>
			</tr>
			<?php
		}
		?>
		</table>
     	<?php
		$tabs->startPane( 'content-pane' );
		$tabs->startTab( _E_IMAGES, 'images-page' );
		?>
		<table class="adminform">
		<tr>
			<td colspan="6">
			<?php echo _CMN_SUBFOLDER; ?> :: <?php echo $lists['folders'];?>
			</td>
		</tr>
		<tr>
			<td align="top">
			<?php echo _E_GALLERY_IMAGES; ?>
			</td>
			<td align="top">
			<?php echo _E_CONTENT_IMAGES; ?>
			</td>
			<td align="top">
			<?php echo _E_EDIT_IMAGE; ?>
			</td>
		<tr>
			<td valign="top">
			<?php echo $lists['imagefiles'];?>
			<br />
			<input class="button" type="button" value="<?php echo _E_INSERT; ?>" onclick="addSelectedToList('adminForm','imagefiles','imagelist')" />
			</td>
			<td valign="top">
			<?php echo $lists['imagelist'];?>
			<br />
			<input class="button" type="button" value="<?php echo _E_UP; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
			<input class="button" type="button" value="<?php echo _E_DOWN; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
			<input class="button" type="button" value="<?php echo _E_REMOVE; ?>" onclick="delSelectedFromList('adminForm','imagelist')" />
			</td>
			<td valign="top">
				<table>
				<tr>
					<td align="right">
					<?php echo _E_SOURCE; ?>
					</td>
					<td>
					<input class="inputbox" type="text" name= "_source" value="" size="15" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">
					<?php echo _E_ALIGN; ?>
					</td>
					<td>
					<?php echo $lists['_align']; ?>
					</td>
				</tr>
				<tr>
					<td align="right">
					<?php echo _E_ALT; ?>
					</td>
					<td>
					<input class="inputbox" type="text" name="_alt" value="" size="15" />
					</td>
				</tr>
				<tr>
					<td align="right">
					<?php echo _E_BORDER; ?>
					</td>
					<td>
					<input class="inputbox" type="text" name="_border" value="" size="3" maxlength="1" />
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td>
					<input class="button" type="button" value="<?php echo _E_APPLY; ?>" onclick="applyImageProps()" />
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
			<img name="view_imagefiles" src="<?php echo $mosConfig_live_site;?>/images/M_images/blank.png" width="50" alt="No Image" />
			</td>
			<td>
			<img name="view_imagelist" src="<?php echo $mosConfig_live_site;?>/images/M_images/blank.png" width="50" alt="No Image" />
			</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( _E_PUBLISHING, 'publish-page' );
		?>
		<table class="adminform">
		<?php
		if ($access->canPublish) {
			?>
			<tr>
				<td align="left">
				<?php echo _E_STATE; ?>
				</td>
				<td>
				<?php echo $lists['state']; ?>
				</td>
			</tr>
			<?php
		} ?>
		<tr>
			<td align="left">
			<?php echo _E_ACCESS_LEVEL; ?>
			</td>
			<td>
			<?php echo $lists['access']; ?>
			</td>
		</tr>
		<tr>
			<td align="left">
			<?php echo _E_AUTHOR_ALIAS; ?>
			</td>
			<td>
			<input type="text" name="created_by_alias" size="50" maxlength="100" value="<?php echo $row->created_by_alias; ?>" class="inputbox" />
			</td>
		</tr>
		<tr>
			<td align="left">
			<?php echo _E_ORDERING; ?>
			</td>
			<td>
			<?php echo $lists['ordering']; ?>
			</td>
		</tr>
		<tr>
			<td align="left">
			<?php echo _E_SHOW_FP; ?>
			</td>
			<td>
			<input type="checkbox" name="frontpage" value="1" <?php echo $row->frontpage ? 'checked="checked"' : ''; ?> />
			</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( _E_METADATA, 'meta-page' );
		?>
		<table class="adminform">
		<tr>
			<td align="left" valign="top">
			<?php echo _E_M_DESC; ?>
			</td>
			<td>
			<textarea class="inputbox" cols="45" rows="3" name="metadesc"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
			<?php echo _E_M_KEY; ?>
			</td>
			<td>
			<textarea class="inputbox" cols="45" rows="3" name="metakey"><?php echo str_replace('&','&amp;',$row->metakey); ?></textarea>
			</td>
		</tr>
		</table>
		<input type="hidden" name="goodexit" value="0" />
		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="Returnid" value="<?php echo $Returnid; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="version" value="<?php echo $row->version; ?>" />
<!--		<input type="hidden" name="sectionid" value="<?php echo $row->sectionid; ?>" /> -->
		<input type="hidden" name="created_by" value="<?php echo $row->created_by; ?>" />
		<input type="hidden" name="task" value="" />
		<?php 
			if ($row->id) {
				echo '<input type="hidden" name="oldstate" value="'.$row->state.'" />';
			}
		?>
		</form>
		<?php
		$tabs->endTab();
		$tabs->endPane();
		?>
		<div style="clear:both;"></div>
		<?php
	}

	/**
	* Writes Email form for filling in the send destination
	*/
	function emailForm( $uid, $title, $template='' ) {
		global $mosConfig_sitename;
		
		$form_check = $_SESSION['_form_check_']['com_content'] = crypt(time()); 
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton() {
			var form = document.frontendForm;
			// do field validation
			if (form.email.value == "" || form.youremail.value == "") {
				alert( '<?php echo addslashes( _EMAIL_ERR_NOINFO ); ?>' );
				return false;
			}
			return true;
		}
		</script>

		<title><?php echo $mosConfig_sitename; ?> :: <?php echo $title; ?></title>
		<link rel="stylesheet" href="templates/<?php echo $template; ?>/css/template_css.css" type="text/css" />
		<form action="index2.php?option=com_content&task=emailsend" name="frontendForm" method="post" onSubmit="return submitbutton();">
		<input type="hidden" name="form_check" value="<?php echo $form_check;?>">
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td colspan="2">
			<?php echo _EMAIL_FRIEND; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="130">
			<?php echo _EMAIL_FRIEND_ADDR; ?>
			</td>
			<td>
			<input type="text" name="email" class="inputbox" size="25">
			</td>
		</tr>
		<tr>
			<td height="27">
			<?php echo _EMAIL_YOUR_NAME; ?>
			</td>
			<td>
			<input type="text" name="yourname" class="inputbox" size="25">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo _EMAIL_YOUR_MAIL; ?>
			</td>
			<td>
			<input type="text" name="youremail" class="inputbox" size="25">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo _SUBJECT_PROMPT; ?>
			</td>
			<td>
			<input type="text" name="subject" class="inputbox" maxlength="100" size="40">
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">
			<input type="submit" name="submit" class="button" value="<?php echo _BUTTON_SUBMIT_MAIL; ?>">
			&nbsp;&nbsp; <input type="button" name="cancel" value="<?php echo _BUTTON_CANCEL; ?>" class="button" onclick="window.close();">
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<?php echo $uid; ?>">
		</form>
		<?php
	}

	/**
	* Writes Email sent popup
	* @param string Who it was sent to
	* @param string The current template
	*/
	function emailSent( $to, $template='' ) {
		global $mosConfig_sitename;
		?>
		<title><?php echo $mosConfig_sitename; ?></title>
		<link rel="stylesheet" href="templates/<?php echo $template; ?>/css/template_css.css" type="text/css" />
		<span class="contentheading"><?php echo _EMAIL_SENT." $to";?></span> <br />
		<br />
		<br />
		<a href='javascript:window.close();'>
		<span class="small"><?php echo _PROMPT_CLOSE;?></span>
		</a>
		<?php
	}
	
	function showWrapItem( &$row, &$params ) {
		?>
		<script language="javascript" type="text/javascript">
		<?php echo $row->load ."\n"; ?>
		function iFrameHeight() {
			var h = 0;
			if ( !document.all ) {
				h = document.getElementById('blockrandom').contentDocument.height;
				document.getElementById('blockrandom').style.height = h + 60 + 'px';
			} else if( document.all ) {
				h = document.frames('blockrandom').document.body.scrollHeight;
				document.all.blockrandom.style.height = h + 20 + 'px';
			}
		}
		</script>
		<div class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">

		<?php
		if ( $params->get( 'page_title' ) ) {
			?>
			<div class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<?php echo $params->get( 'header' ); ?>
			</div>
			<?php
		}
		?>
		<iframe   
		id="blockrandom"
		src="<?php echo $row->urls; ?>" 
		width="<?php echo $params->get( 'width' ); ?>" 
		height="<?php echo $params->get( 'height' ); ?>" 
		scrolling="<?php echo $params->get( 'scrolling' ); ?>" 
		align="top"
		frameborder="0"
		class="wrapper<?php echo $params->get( 'pageclass_sfx' ); ?>">
		<?php echo _CMN_IFRAMES; ?>
		</iframe>

		</div>
		<?php
		// displays back button
		//mosHTML::BackButton ( $params );
	}

}
?>
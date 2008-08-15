<?php
/**
* @version $Id: pathway.php,v 1.1 2005/07/22 01:57:13 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function pathwayMakeLink( $id, $name, $link, $parent ) {
	$mitem = new stdClass();
	$mitem->id 		= $id;
	$mitem->name 	= $mitem->name = html_entity_decode( $name ); 
	$mitem->link 	= $link;
	$mitem->parent 	= $parent;
	$mitem->type 	= '';

	return $mitem;
}

/**
* Outputs the pathway breadcrumbs
* @param database A database connector object
* @param int The db id field value of the current menu item
*/
function showPathway( $Itemid ) {
	global $database, $option, $task, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site;
	global $menuIdVars, $catIdVars;
	global $homeItemid, $pathwaySeperator, $curPathway;

	$imgPath =  'templates/' . $mainframe->getTemplate() . '/images/arrow.png';
	if (file_exists( "$mosConfig_absolute_path/$imgPath" )){
		$img = '<img src="' . $mosConfig_live_site . '/' . $imgPath . '" height="9" width="9" border="0" alt="arrow" />';
	}
	else { 
		$imgPath = '/images/M_images/arrow.png';
		if (file_exists( $mosConfig_absolute_path . $imgPath )){
			$img = '<img src="' . $mosConfig_live_site . '/images/M_images/arrow.png" height="9" width="9" alt="arrow" />';
		}
		else {
		  $img = '&gt;';
		}
	}
	$img = " $img ";
	
	if ($curPathway) {
		$aPathway = str_replace($pathwaySeperator, $img, $curPathway);
		echo ( "<span class=\"pathway\">". $aPathway ."</span>\n" );
		return true;
	}

	$mitems = $menuIdVars;
	$optionstring = $_SERVER['QUERY_STRING'];

	// are we at the home page or not
	$homemenuid = $homeItemid;
	$home = @$mitems[$homemenuid]->name;

	switch( @$mitems[$Itemid]->type ) {
		case 'content_section':
		case 'content_blog_section':
		$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

		switch ($task) {
			case 'category':
			case 'blogcategory':
			if ($id) {
				$title = $mainframe->getItemTitle();
				$id = max( array_keys( $mitems ) ) + 1;
				$mitem = pathwayMakeLink($id,$title,'index.php?option='. $option .'&task='. $task .'&id='. $id .'&Itemid='. $Itemid,$Itemid);
				$mitems[$id] = $mitem;
				$Itemid = $id;
			}
			break;

			case 'view':
			case 'wrapper':
			if ($id) {
				$catid = intval( mosGetParam( $_REQUEST, 'catid', 0 ) );
				$sectionid = intval( mosGetParam( $_REQUEST, 'sectionid', 0 ) );
				if (!($catid && $sectionid)) {
					// load the content item name and category
					$database->setQuery( "SELECT title, sectionid, catid FROM #__content WHERE id=$id" );
					$row = null;
					$database->loadObject( $row );
					$catid = $row->catid;
					$sectionid = $row->sectionid;
				}
				$cattitle = $catIdVars[$catid]->title;
				$linkcat = ($mitems[$Itemid]->type == 'content_section') ? 'category' : 'blogcategory';
				$title = $mainframe->getItemTitle();

				$id = max( array_keys( $mitems ) ) + 1;
				$mitem1 = pathwayMakeLink($Itemid,$cattitle,'index.php?option='. $option .'&task='. $linkcat . '&sectionid='. $sectionid .'&id='. $catid,$Itemid);
				$mitems[$id] = $mitem1;

				// add the final content item
				$id++;
				$mitem2 = pathwayMakeLink($Itemid,$title,"",$id-1);
				$mitems[$id] = $mitem2;
				$Itemid = $id;

			}
			break;
		}
		break;

		case 'content_category':
		case 'content_blog_category':
		$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

		switch ($task) {

			case 'view':
			case 'wrapper':
			if ($id) {
				$title = $mainframe->getItemTitle();
				$id = max( array_keys( $mitems ) ) + 1;
				// add the final content item
				$mitem2 = pathwayMakeLink($Itemid,$title,"",$Itemid);
				$mitems[$id] = $mitem2;
				$Itemid = $id;

			}
			break;
		}
		break;

	}

	$i = count( $mitems );
	$mid = $Itemid;
	$path = "";

	while ($i--) {
		if (!$mid || empty( $mitems[$mid] ) || $mid == 1 || !eregi("option", $optionstring)) {
			break;
		}
		$item =& $mitems[$mid];

		// converts & to &amp; for xtml compliance
		$itemname = ampReplace( $item->name );
		
		// if it is the current page, then display a non hyperlink
		if ($item->id == $Itemid || empty( $mid ) || empty($item->link)) {
			$newlink = "  $itemname";
		} else if (isset($item->type) && $item->type == 'url') {
			$correctLink = eregi( 'http://', $item->link);
			if ($correctLink==1) {
				$newlink = '<a href="'. $item->link .'" target="_window" class="pathway">'. $itemname .'</a>';
			} else {
				$newlink = $itemname;
			}
		} else {
			$newlink = '<a href="'. sefRelToAbs( $item->link .'&Itemid='. $item->id ) .'" class="pathway">'. $itemname .'</a>';
		}

		$newlink = ampReplace( $newlink );
		
		if (trim($newlink)!="") {
			$path = $img . $newlink .' '. $path;
		} else {
			$path = '';
		}

		$mid = $item->parent;
	}
	
	if ( eregi( 'option', $optionstring ) && trim( $path  ) ) {
		$home = '<a href="'. $mosConfig_live_site .'" class="pathway">'. $home .'</a>';
	}

	echo ( "<span class=\"pathway\">". $home . $path ."</span>\n" );
}

// code placed in a function to prevent messing up global variables
showPathway( $Itemid );
?>

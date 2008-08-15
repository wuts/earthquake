<?php
/**
* @version $Id: content.php,v 1.7 2005/11/24 04:28:51 csouza Exp $
* @package Mambo
* @subpackage Content
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'front_html', 'com_content' ) );

$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );
$sectionid = intval( mosGetParam( $_REQUEST, 'sectionid', 0 ) );
$pop = intval( mosGetParam( $_REQUEST, 'pop', 0 ) );
$task = strtolower( trim( mosGetParam( $_REQUEST, 'task', '' ) ) );
$limit = intval( mosGetParam( $_REQUEST, 'limit', '' ) );
$limitstart = intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );

$iscf = false;
$Itemidnid = "Itemid$Itemid";
if (isset($_REQUEST['begindate']) && isset($_REQUEST['enddate'])) {
	$cf_begindate = trim( mosGetParam( $_REQUEST, 'begindate', '' ) );
	$cf_enddate = trim( mosGetParam( $_REQUEST, 'enddate', '' ) );
	if (!empty($cf_begindate) && !empty($cf_enddate)) {
		$iscf = true;
		$_SESSION[$Itemidnid . '_begindate'] = $cf_begindate;
		$_SESSION[$Itemidnid . '_enddate'] = $cf_enddate;
	}
}
else {
	if (isset($_SESSION[$Itemidnid . '_begindate']) && isset($_SESSION[$Itemidnid . '_enddate']) && !empty($_SESSION[$Itemidnid . '_begindate']) && !empty($_SESSION[$Itemidnid . '_begindate'])) {
		$iscf = true;
		$cf_begindate = $_SESSION[$Itemidnid . '_begindate'];
		$cf_enddate = $_SESSION[$Itemidnid . '_enddate'];
	}
}

$now = date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60 );

// Editor usertype check
$access = new stdClass();
$access->canEdit 	= $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'all' );
$access->canEditOwn = $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'own' );
$access->canPublish = $acl->acl_check( 'action', 'publish', 'users', $my->usertype, 'content', 'all' );

// loads function for frontpage component
if ( $option == 'com_frontpage' ) {
	//frontpage( $option, $gid, $pop, $now );
	frontpage( $gid, $access, $pop, $now );
	return;
}

switch ( $task ) {
	case 'findkey':
		findKeyItem( $gid, $access, $pop, $option, $now );
		break;

	case 'view':
		showItem( $id, $gid, $access, $pop, $option, $now );
		break;

	case 'wrapper':
		showWrapItem( $id, $gid );
		break;
	
	case 'section':
		showSection( $id, $gid, $access, $limit, $limitstart, $now );
		break;

	case 'category':
		showCategory( $id, $gid, $access, $limit, $limitstart, $now );
		break;

	case 'blogsection':
		showBlogSection( $id, $gid, $access, $pop, $limitstart, $now );
		break;

	case 'blogcategory':
		showBlogCategory( $id, $gid, $access, $pop, $limitstart, $now );
		break;

	case 'edit':
		editItem( $id, $gid, $access, 0, $task, $Itemid );
		break;

	case 'new':
		editItem( 0, $gid, $access, $sectionid, $task, $Itemid );
		break;

	case 'save':
		saveContent( $access );
		break;

	case 'cancel':
		cancelContent( $access );
		break;

	case 'emailform':
		emailContentForm( $id );
		break;

	case 'emailsend':
		emailContentSend( $id );
		break;

	case 'vote':
		recordVote ( $url , $user_rating , $cid , $database);
		break;

	default:
		showBlogSection( 0, $gid, $access, $pop, $now );
		break;
}

/**
 * Searches for an item by a key parameter
 * @param int The user access level
 * @param object Actions this user can perform
 * @param int
 * @param string The url option
 * @param string A timestamp
 */
function findKeyItem( $gid, $access, $pop, $option, $now ) {
	global $database;
	$keyref = mosGetParam( $_REQUEST, 'keyref', '' );
	$keyref = $database->getEscaped( $keyref );

	$query = 'SELECT id
		FROM #__content
		WHERE attribs LIKE \'%keyref=' . $keyref . '%\'
		';
	$database->setQuery( $query );
	$id = $database->loadResult();
	if ($id > 0) {
		showItem( $id, $gid, $access, $pop, $option, $now );
	} else {
		echo 'Key not found '. $keyref;
	}
}

function frontpage( $gid, &$access, $pop, $now ) {
	global $database, $mainframe, $my, $Itemid, $option, $mosConfig_offset;

	$noauth = !$mainframe->getCfg( 'shownoauth' );

	// Parameters
	$menu =& new mosMenu( $database );
	$menu->load( $Itemid );
	$params =& new mosParameters( $menu->params );
	$orderby = _orderby( $params->def( 'orderby', '' ) );

	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

	// query records
	$query = "SELECT a.*, ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count, u.name AS author, u.usertype, g.name AS groups"
	. "\n FROM #__content AS a"
	. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id"
	. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
	. "\n LEFT JOIN #__content_rating AS v ON a.id = v.content_id"
	. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
	. "\n WHERE a.state = '1'"
	. ( $noauth ? "\n AND a.access <= '". $my->gid ."'" : '' )
	. "\n ORDER BY $orderby"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	// Dynamic Page Title
	$mainframe->SetPageTitle( $menu->name );

	// parameters
	if ( $params->get( 'page_title', 1 ) && $menu) {
		$header = $params->def( 'header', $menu->name );
	} else {
		$header = '';
	}
	$columns = $params->def( 'columns', 2 );
	if ( $columns == 0 ) {
		$columns = 1;
	}
	$intro 				= $params->def( 'intro', 4 );
	$leading 				= $params->def( 'leading', 1 );
	$links 				= $params->def( 'link', 4 );
	$pagination 			= $params->def( 'pagination', 2 );
	$pagination_results 	= $params->def( 'pagination_results', 1 );
	// needed for back button for page
	$back 				= $params->get( 'back_button', $mainframe->getCfg( 'back_button' ) );
	// needed to disable back button for item
	$params->set( 'back_button', 0 );
	$params->def( 'pageclass_sfx', '' );
	$params->set( 'intro_only', 1 );
	
	$params->def( 'target', 0 );
	$urltarget = $params->get( 'target' ) ? 'target="_blank"' : '';
	
	$total = count( $rows );

	// pagination support
	$limitstart = intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );
	$limit = $intro + $leading + $links;
	if ( $total <= $limit ) {
		$limitstart = 0;
	}
	$i = $limitstart;

	// Page Output
	// page header
	if ( $header ) {
		echo '<div class="componentheading'. $params->get( 'pageclass_sfx' ) .'">'. $header .'</div>';
	}

	// checks to see if there are there any items to display
	if ( $total ) {
		$col_with = 100 / $columns;			// width of each column
		$width = 'width="'. $col_with .'%"';

		echo '<table class="blog' . $params->get( 'pageclass_sfx' ) . '" cellpadding="0" cellspacing="0">';

		// Leading story output
		if ( $leading ) {
			echo '<tr>';
			echo '<td valign="top">';
			for ( $z = 0; $z < $leading; $z++ ) {
				if ( $i >= $total ) {
					// stops loop if total number of items is less than the number set to display as leading
					break;
				}
				echo '<div>';
				show( $rows[$i], $params, $gid, $access, $pop, $option );
				echo '</div>';
				$i++;
			}
			echo '</td>';
			echo '</tr>';
		}

		if ( $intro && ( $i < $total ) ) {
			echo '<tr>';
			echo '<td valign="top">';
			echo '<table width="100%"  cellpadding="0" cellspacing="0">';
			// intro story output
			for ( $z = 0; $z < $intro; $z++ ) {
				if ( $i >= $total ) {
					// stops loop if total number of items is less than the number set to display as intro + leading
					break;
				}

				if ( !( $z % $columns ) || $columns == 1 ) {
					echo '<tr>';
				}

				echo '<td valign="top" '. $width .'>';

				// outputs either intro or only a link
				if ( $z < $intro ) {
					show( $rows[$i], $params, $gid, $access, $pop, $option );
				} else {
					echo '</td>';
					echo '</tr>';
					break;
				}

				echo '</td>';

				if ( !( ( $z + 1 ) % $columns ) || $columns == 1 ) {
					echo '</tr>';
				}

				$i++;
			}

			// this is required to output a final closing </tr> tag when the number of items does not fully
			// fill the last row of output - a blank column is left
			if ( $intro % $columns ) {
				echo '</tr>';
			}

			echo '</table>';
			echo '</td>';
			echo '</tr>';
		}

		// Links output
		if ( $links && ( $i < $total )  ) {
			echo '<tr>';
			echo '<td valign="top">';
			echo '<div class="blog_more'. $params->get( 'pageclass_sfx' ) .'">';
			HTML_content::showLinks( $rows, $links, $total, $i, $urltarget );
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		}

		// Pagination output
		if ( $pagination ) {
			if ( ( $pagination == 2 ) && ( $total <= $limit ) ) {
				// not visible when they is no 'other' pages to display
			} else {
				// get the total number of records
				$limitstart = $limitstart ? $limitstart : 0;
				require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/pageNavigation.php' );
				$pageNav = new mosPageNav( $total, $limitstart, $limit );
				$link = 'index.php?option=com_frontpage&amp;Itemid='. $Itemid;
				echo '<tr>';
				echo '<td valign="top" align="center">';
				echo $pageNav->writePagesLinks( $link );
				echo '<br /><br />';
				echo '</td>';
				echo '</tr>';
				if ( $pagination_results ) {
					echo '<tr>';
					echo '<td valign="top" align="center">';
					echo $pageNav->writePagesCounter();
					echo '</td>';
					echo '</tr>';
				}
			}
		}

		echo '</table>';

	} else {
		// Generic blog empty display
		//echo _EMPTY_BLOG;
	}

	// Back Button
	$params->set( 'back_button', $back );
	mosHTML::BackButton ( $params );
}

function showSection( $id, $gid, &$access, $limit, $limitstart, $now ) {
	global $database, $mainframe, $mosConfig_offset, $mosConfig_list_limit, $Itemid;
	global $iscf, $cf_begindate, $cf_enddate;

	$noauth = !$mainframe->getCfg( 'shownoauth' );

	// Paramters
	$params = new stdClass();
	if ( $Itemid ) {
		$menu = new mosMenu( $database );
		$menu->load( $Itemid );
		$params =& new mosParameters( $menu->params );
	} else {
		$menu = "";
		$params =& new mosEmpty();

	}
	
	$params->def( 'pageclass_sfx', '' );
	$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );

	$params->def( 'page_title', 1 );
	$params->def( 'description', 0 );
	$params->def( 'description_image', 0 );
	
	$categorylist = $params->def( 'categorylist', 1 );
	$categoryitems = $params->def( 'categoryitems', 0 );
	$categoriesperrow = $params->def( 'categoriesperrow', 2 );
	$categoryitemlist = $params->def( 'categoryitemlist', 1 );
	$itemcount = $params->def( 'itemcount', 5 );
	$titlelength = $params->def( 'titlelength', 40 );
	$datedisplay = $params->def( 'datedisplay', 0 );
	
	$sectionitemlist = $params->def( 'sectionitemlist', 0 );

	$params->def( 'author', !$mainframe->getCfg( 'hideAuthor' ) );
	$params->def( 'date', !$mainframe->getCfg( 'hideCreateDate' ) );
	$params->def( 'date_format', _DATE_FORMAT_LC );
	$params->def( 'hits', $mainframe->getCfg( 'hits' ) );
	$params->def( 'headings', 1 );
	$params->def( 'navigation', 1 );
	$params->def( 'display_num', $mosConfig_list_limit );
	$params->def( 'target', 0 );

	// Ordering control
	$orderby = _orderby( $params->def( 'orderby', 'rdate' ) );

	$section = new mosSection( $database );
	$section->load( $id );

	$categories = null;
	if ($categorylist) {
		if ( $access->canEdit ) {
			$xwhere = '';
		} else {
			$xwhere = "\n AND c.published = '1'";
		}
	
		$query = "SELECT c.* FROM #__categories AS c
			WHERE c.section = '" . $section->id . "' $xwhere";
		if ($noauth) {
			$query .= "	AND c.access <= '$gid'";
		}
		$query .= ' ORDER BY c.ordering';
		$database->setQuery( $query );
		$categories = $database->loadObjectList();
	}

	$pageNav = null;
	$items = null;
	if ($sectionitemlist) {
		// get the total number of published items in the category
		if ( $access->canEdit ) {
			$xwhere = '';
		} else {
			$xwhere = "\n AND a.state='1'";
		}
	
		$query = "SELECT COUNT(a.id) as numitems"
		. "\n FROM #__content AS a"
		. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
		. "\n WHERE a.sectionid='". $section->id ."' ". $xwhere
		. ( $noauth ? "\n AND a.access<='". $gid ."'" : '' )
		. ( $iscf ? "\n AND a.created>'$cf_begindate' AND a.created<'$cf_enddate'" : '' )
		;
		$database->setQuery( $query );
		$total = $database->loadResult();
		$limit = $limit ? $limit : $params->get( 'display_num' ) ;
		if ( $total <= $limit ) $limitstart = 0;
	
		require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	
		// get the list of items for this section
		$query = "SELECT a.id, a.title, a.hits, a.created_by, a.created_by_alias, a.created AS created, a.access, u.name AS author, a.state, g.name AS groups"
		. "\n FROM #__content AS a"
		. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
		. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
		. "\n WHERE a.sectionid='". $section->id ."' ". $xwhere
		. ( $noauth ? "\n AND a.access<='". $gid ."'" : '' )
		. ( $iscf ? "\n AND a.created>'$cf_begindate' AND a.created<'$cf_enddate'" : '' )
		. "\n ORDER BY ". $orderby .""
		. "\n LIMIT ". $limitstart .", ". $limit
		;
		$database->setQuery( $query );
		$items = $database->loadObjectList();
	}
	
	// Dynamic Page Title
	if ( $menu ) {
		$pos = strpos($menu->type, 'content_section');
		if ($pos !== false){
			$section->title = $menu->name;
		}
	} // if	
	$mainframe->SetPageTitle( $section->title );

	HTML_content::showSectionContentList( $section, $items, $gid, $params, $categories, $pageNav );
}


/**
* @param int The category id
* @param int The group id of the user
* @param int The access level of the user
* @param int The section id
* @param int The number of items to dislpay
* @param int The offset for pagination
*/
function showCategory( $id, $gid, &$access, $limit, $limitstart, $now  ) {
	global $database, $mainframe, $Itemid, $mosConfig_offset, $mosConfig_list_limit;
	global $iscf, $cf_begindate, $cf_enddate;

	$category = new mosCategory( $database );
	$category->load( $id );
	
	if ( $gid < $category->access ) {
		mosNotAuth();
		return;
	}

	$noauth = !$mainframe->getCfg( 'shownoauth' );

	// Paramters
	$params = new stdClass();
	if ( $Itemid ) {
		$menu = new mosMenu( $database );
		$menu->load( $Itemid );
		$params =& new mosParameters( $menu->params );
	} else {
		$menu = "";
		$params =& new mosParameters( '' );
	}

	$params->def( 'pageclass_sfx', '' );
	$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );

	$params->def( 'page_title', 1 );
	$params->def( 'description', 0 );
	$params->def( 'description_image', 0 );

	$params->def( 'author', !$mainframe->getCfg( 'hideAuthor' ) );
	$params->def( 'date', !$mainframe->getCfg( 'hideCreateDate' ) );
	$params->def( 'date_format', _DATE_FORMAT_LC );
	$params->def( 'hits', $mainframe->getCfg( 'hits' ) );
	$params->def( 'headings', 1 );
	$params->def( 'navigation', 1 );
	$params->def( 'display_num', $mosConfig_list_limit );
	$params->def( 'target', 0 );

	// Ordering control
	$orderby = _orderby( $params->def( 'orderby', 'rdate' ) );

	// get the total number of published items in the category
	if ( $access->canEdit ) {
		$xwhere = '';
	} else {
		$xwhere = "\n AND a.state='1'";
	}

	$query = "SELECT COUNT(a.id) as numitems"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
	. "\n WHERE a.catid='". $category->id ."' ". $xwhere
	. ( $noauth ? "\n AND a.access<='". $gid ."'" : '' )
	. ( $iscf ? "\n AND a.created>'$cf_begindate' AND a.created<'$cf_enddate'" : '' )
	;
	$database->setQuery( $query );
	$counter = $database->loadObjectList();
	$total = $counter[0]->numitems;
	$limit = $limit ? $limit : $params->get( 'display_num' ) ;
	if ( $total <= $limit ) $limitstart = 0;

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	// get the list of items for this category
	$query = "SELECT a.id, a.title, a.hits, a.created_by, a.created_by_alias, a.created AS created, a.access, u.name AS author, a.state, g.name AS groups"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
	. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
	. "\n WHERE a.catid='". $category->id ."' ". $xwhere
	. ( $noauth ? "\n AND a.access<='". $gid ."'" : '' )
	. ( $iscf ? "\n AND a.created>'$cf_begindate' AND a.created<'$cf_enddate'" : '' )
	. "\n ORDER BY ". $orderby .""
	. "\n LIMIT ". $limitstart .", ". $limit
	;
	$database->setQuery( $query );
	$items = $database->loadObjectList();

	// Dynamic Page Title
	if ( $menu ) {
		$pos = strpos($menu->type, 'content_category');
		if ($pos !== false){
			$category->title = $menu->name;
		}
	} // if
	$mainframe->SetPageTitle( $category->title );

	HTML_content::showCategoryContentList( $category, $items, $access, $gid, $params, $pageNav );
} // showCategory


function showBlogSection( $id=0, $gid, &$access, $pop, $limitstart, $now=NULL ) {
	global $database, $mainframe, $mosConfig_offset, $Itemid;
	global $task, $option, $mosConfig_live_site;
	global $iscf, $cf_begindate, $cf_enddate;

	$noauth = !$mainframe->getCfg( 'shownoauth' );

	// if $id is null, load the first id from table sections
	if ( !$id ) {
		$query = "SELECT id FROM #__sections WHERE published = '1' AND access <= '$gid' ORDER BY id LIMIT 0, 1";
		$database->setQuery( $query );
		$id = $database->loadResult();
	}
	$section = new mosSection( $database );
	$section->load( $id );
	if ($gid < $section->access ) {
		mosNotAuth();
		return;
	}
	$sectionid = $id;
	// Parameters
	$params = new stdClass();
	if ( $Itemid ) {
		$menu = new mosMenu( $database );
		$menu->load( $Itemid );
		$params =& new mosParameters( $menu->params );
	} else {
		$menu = "";
		$params =& new mosParameters( '' );
	}

	$pageclass_sfx = $params->def( 'pageclass_sfx', '' );
	// needed for back button for page
	$back = $params->get( 'back_button', $mainframe->getCfg( 'back_button' ) );
	// needed to disable back button for item
	$params->set( 'back_button', 0 );
	$params->set( 'intro_only', 1 );
	
	$params->def( 'page_title', 1 );
	$descrip = $params->def( 'description', 0 );
	$descrip_image = $params->def( 'description_image', 0 );
	
	$categorylist = $params->def( 'categorylist', 1 );
	$categoryitems = $params->def( 'categoryitems', 0 );
	$categoriesperrow = $params->def( 'categoriesperrow', 4 );
	
	$leading = $params->def( 'leading', 1 );
	$intro = $params->def( 'intro', 4 );
	$columns = $params->def( 'columns', 2 );
	if ( $columns <= 0 ) {
		$columns = 1;
	}
	$links = $params->def( 'link', 4 );
	$pagination = $params->def( 'pagination', 2 );
	$pagination_results = $params->def( 'pagination_results', 1 );
	$params->def( 'target', 0 );
	$urltarget = $params->get( 'target' ) ? 'target="_blank"' : '';
	
	$params->def( 'sectionid', $id );
	
	// Dynamic Page Title
	if ( $menu ) {
		$pos = strpos($menu->type, 'content_blog_section');
		if ($pos !== false){
			$section->title = $menu->name;
		}
	} // if	
	$mainframe->setPageTitle( $section->title );

	$total = $section->count;

	// pagination support
	$limit = $intro + $leading + $links;
	if ( $total <= $limit ) $limitstart = 0;

	$where 		= _where( 1, $access, $noauth, $gid, $id, $now );

	// Ordering control
	$orderby 	= _orderby( $params->def( 'orderby', 'rdate' ) );

	// Main data query
	$query = "SELECT a.*, ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count, u.name AS author, u.usertype, cc.name AS category, g.name AS groups"
	. "\n FROM #__content AS a"
	. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
	. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
	. "\n LEFT JOIN #__content_rating AS v ON a.id = v.content_id"
	. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
	. ( count( $where ) ? "\n WHERE ".implode( "\n AND ", $where ) : '' )
	. "\n ORDER BY $orderby"
	. "\n LIMIT $limitstart, $limit";

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	$curtotal = count( $rows );
	$i = 0;

	// Page Output
	// page header
	if ( $params->get( 'page_title' ) ) {
		echo '<div class="componentheading'. $pageclass_sfx .'">'. $section->title .'</div>';
	}

	// Secrion Description & Image
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
	
	// Category List
	if ($categorylist) {
		if ( $access->canEdit ) {
			$xwhere = '';
		} else {
			$xwhere = "\n AND c.published = '1'";
		}
	
		$query = "SELECT c.id, c.title, c.count FROM #__categories AS c
			WHERE c.section = '" . $section->id . "' $xwhere";
		if ($noauth) {
			$query .= "	AND c.access <= '$gid'";
		}
		$query .= ' ORDER BY c.ordering';
		$database->setQuery( $query );
		$categories = $database->loadObjectList();
		if ($categories) {
			echo '<h3><table width="100%" border="0" cellspacing="0" cellpadding="0">';
			$ci = 0;
			$crow = 0;
			foreach ( $categories as $cat ) {
				$catid = $cat->id;
				$catlink = sefRelToAbs("index.php?option=com_content&task=blogcategory&sectionid=$sectionid&id=$catid&Itemid=$Itemid");
				$cattitle = $categoryitems ? $cat->title . " (". $cat->count .")" : $cat->title;
				if (empty($ci)) echo "<tr>";
				echo '<td class="contentcatlist'. $pageclass_sfx .'"><a href="' . $catlink . '">' . $cattitle . '</a></td>';
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
	}

	// checks to see if there are there any items to display
	if ( $curtotal ) {
		$col_with = 100 / $columns;			// width of each column
		$width = 'width="'. $col_with .'%"';

		echo '<table class="blog' . $pageclass_sfx . '" cellpadding="0" cellspacing="0">';

		// Leading story output
		if ( $leading ) {
			echo '<tr>';
			echo '<td valign="top">';
			for ( $z = 0; $z < $leading; $z++ ) {
				if ( $i >= $curtotal ) {
					// stops loop if total number of items is less than the number set to display as leading
					break;
				}
				echo '<div>';
				show( $rows[$i], $params, $gid, $access, $pop, $option );
				echo '</div>';
				$i++;
			}
			echo '</td>';
			echo '</tr>';
		}

		if ( $intro && ( $i < $curtotal ) ) {
			echo '<tr>';
			echo '<td valign="top">';
			echo '<table width="100%"  cellpadding="0" cellspacing="0">';
			// intro story output
			for ( $z = 0; $z < $intro; $z++ ) {
				if ( $i >= $curtotal ) {
					// stops loop if total number of items is less than the number set to display as intro + leading
					break;
				}

				if ( !( $z % $columns ) || $columns == 1 ) {
					echo '<tr>';
				}

				echo '<td valign="top" '. $width .'>';

				// outputs either intro or only a link
				if ( $z < $intro ) {
					show( $rows[$i], $params, $gid, $access, $pop, $option );
				} else {
					echo '</td>';
					echo '</tr>';
					break;
				}

				echo '</td>';

				if ( !( ( $z + 1 ) % $columns ) || $columns == 1 ) {
					echo '</tr>';
				}

				$i++;
			}

			// this is required to output a final closing </tr> tag when the number of items does not fully
			// fill the last row of output - a blank column is left
			if ( $intro % $columns ) {
				echo '</tr>';
			}

			echo '</table>';
			echo '</td>';
			echo '</tr>';
		}

		// Links output
		if ( $links && ( $i < $curtotal )  ) {
			echo '<tr>';
			echo '<td valign="top">';
			echo '<div class="blog_more'. $params->get( 'pageclass_sfx' ) .'">';
			HTML_content::showLinks( $rows, $links, $curtotal, $i, $urltarget );
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		}

		// Pagination output
		if ( $pagination ) {
			if ( ( $pagination == 2 ) && ( $total <= $limit ) ) {
				// not visible when they is no 'other' pages to display
			} else {
				// get the total number of records
				require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/pageNavigation.php' );
				$pageNav = new mosPageNav( $total, $limitstart, $limit );
				$link = 'index.php?option=com_content&amp;task='. $task .'&amp;id='. $id .'&amp;Itemid='. $Itemid;
				if ($iscf) {
					$link .= "&amp;begindate=$cf_begindate&amp;enddate=$cf_enddate";
				}
				echo '<tr>';
				echo '<td valign="top" align="center">';
				echo $pageNav->writePagesLinks( $link );
				echo '<br /><br />';
				echo '</td>';
				echo '</tr>';
				if ( $pagination_results ) {
					echo '<tr>';
					echo '<td valign="top" align="center">';
					echo $pageNav->writePagesCounter();
					echo '</td>';
					echo '</tr>';
				}
			}
		}

		echo '</table>';

	} else {
		// Generic blog empty display
		//echo _EMPTY_BLOG;
	}

	// Back Button
	$params->set( 'back_button', $back );
	mosHTML::BackButton ( $params );
}


function showBlogCategory( $id=0, $gid, &$access, $pop, $limitstart, $now=NULL ) {
	global $database, $mainframe, $mosConfig_offset, $Itemid;
	global $task, $option, $mosConfig_live_site;
	global $iscf, $cf_begindate, $cf_enddate;

	$noauth = !$mainframe->getCfg( 'shownoauth' );

	// if $id is null, load the first content categories id from table categories
	if ( !$id ) {
		$query = "SELECT id FROM #__categories ORDER BY section, id LIMIT 0, 1";
		$database->setQuery( $query );
		$id = $database->loadResult();
	}
	
	$category = new mosCategory( $database );
	$category->load( $id );
	
	if ($category->access > $gid) {
		mosNotAuth();
		return;
	}

	// Parameters
	$params = new stdClass();
	if ( $Itemid ) {
		$menu = new mosMenu( $database );
		$menu->load( $Itemid );
		$params =& new mosParameters( $menu->params );
	} else {
		$menu = "";
		$params =& new mosParameters( '' );
	}

	$pageclass_sfx = $params->def( 'pageclass_sfx', '' );
	// needed for back button for page
	$back = $params->get( 'back_button', $mainframe->getCfg( 'back_button' ) );
	// needed to disable back button for item
	$params->set( 'back_button', 0 );
	$params->set( 'intro_only', 1 );

	$params->def( 'page_title', 1 );
	$descrip = $params->def( 'description', 0 );
	$descrip_image = $params->def( 'description_image', 0 );

	$leading = $params->def( 'leading', 1 );
	$intro = $params->def( 'intro', 4 );
	$columns = $params->def( 'columns', 2 );
	if ( $columns <= 0 ) {
		$columns = 1;
	}
	$links = $params->def( 'link', 4 );
	$pagination = $params->def( 'pagination', 2 );
	$pagination_results = $params->def( 'pagination_results', 1 );
	$params->def( 'target', 0 );
	$urltarget = $params->get( 'target' ) ? 'target="_blank"' : '';

	$params->def( 'categoryid', $id );

	// Dynamic Page Title
	if ( $menu ) {
		$pos = strpos($menu->type, 'content_blog_category');
		if ($pos !== false){
			$category->title = $menu->name;
		}
	} // if	
	$mainframe->setPageTitle( $category->title );

	$total = $category->count;

	// pagination support
	$limit = $intro + $leading + $links;
	if ( $total <= $limit ) $limitstart = 0;

	$where = _where( 2, $access, $noauth, $gid, $id, $now );

	// Ordering control
	$orderby = _orderby( $params->def( 'orderby', 'rdate' ) );

	// Main data query
	$query = "SELECT a.*, ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count, u.name AS author, u.usertype, cc.name AS category, g.name AS groups"
	. "\n FROM #__content AS a"
	. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
	. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
	. "\n LEFT JOIN #__content_rating AS v ON a.id = v.content_id"
	. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
	. ( count( $where ) ? "\n WHERE ".implode( "\n AND ", $where ) : '' )
	. "\n ORDER BY $orderby"
	. "\n LIMIT $limitstart, $limit";

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	$curtotal = count( $rows );
	$i = 0;

	// Page Output
	// page header
	if ( $params->get( 'page_title' ) ) {
		echo '<div class="componentheading'. $pageclass_sfx .'">'. $category->title .'</div>';
	}

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

	// checks to see if there are there any items to display
	if ( $curtotal ) {
		$col_with = 100 / $columns;			// width of each column
		$width = 'width="'. $col_with .'%"';

		echo '<table class="blog' . $pageclass_sfx . '" cellpadding="0" cellspacing="0">';

		// Leading story output
		if ( $leading ) {
			echo '<tr>';
			echo '<td valign="top">';
			for ( $z = 0; $z < $leading; $z++ ) {
				if ( $i >= $curtotal ) {
					// stops loop if total number of items is less than the number set to display as leading
					break;
				}
				echo '<div>';
				show( $rows[$i], $params, $gid, $access, $pop, $option );
				echo '</div>';
				$i++;
			}
			echo '</td>';
			echo '</tr>';
		}

		if ( $intro && ( $i < $curtotal ) ) {
			echo '<tr>';
			echo '<td valign="top">';
			echo '<table width="100%"  cellpadding="0" cellspacing="0">';
			// intro story output
			for ( $z = 0; $z < $intro; $z++ ) {
				if ( $i >= $curtotal ) {
					// stops loop if total number of items is less than the number set to display as intro + leading
					break;
				}

				if ( !( $z % $columns ) || $columns == 1 ) {
					echo '<tr>';
				}

				echo '<td valign="top" '. $width .'>';

				// outputs either intro or only a link
				if ( $z < $intro ) {
					show( $rows[$i], $params, $gid, $access, $pop, $option );
				} else {
					echo '</td>';
					echo '</tr>';
					break;
				}

				echo '</td>';

				if ( !( ( $z + 1 ) % $columns ) || $columns == 1 ) {
					echo '</tr>';
				}

				$i++;
			}

			// this is required to output a final closing </tr> tag when the number of items does not fully
			// fill the last row of output - a blank column is left
			if ( $intro % $columns ) {
				echo '</tr>';
			}

			echo '</table>';
			echo '</td>';
			echo '</tr>';
		}

		// Links output
		if ( $links && ( $i < $curtotal )  ) {
			echo '<tr>';
			echo '<td valign="top">';
			echo '<div class="blog_more'. $pageclass_sfx .'">';
			HTML_content::showLinks( $rows, $links, $curtotal, $i, $urltarget );
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		}

		// Pagination output
		if ( $pagination ) {
			if ( ( $pagination == 2 ) && ( $total <= $limit ) ) {
				// not visible when they is no 'other' pages to display
			} else {
				// get the total number of records
				require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/pageNavigation.php' );
				$pageNav = new mosPageNav( $total, $limitstart, $limit );
				$link = 'index.php?option=com_content&amp;task='. $task .'&amp;id='. $id .'&amp;Itemid='. $Itemid;
				if ($iscf) {
					$link .= "&amp;begindate=$cf_begindate&amp;enddate=$cf_enddate";
				}
				echo '<tr>';
				echo '<td valign="top" align="center">';
				echo $pageNav->writePagesLinks( $link );
				echo '<br /><br />';
				echo '</td>';
				echo '</tr>';
				if ( $pagination_results ) {
					echo '<tr>';
					echo '<td valign="top" align="center">';
					echo $pageNav->writePagesCounter();
					echo '</td>';
					echo '</tr>';
				}
			}
		}

		echo '</table>';

	} else {
		// Generic blog empty display
		//echo _EMPTY_BLOG;
	}

	// Back Button
	$params->set( 'back_button', $back );
	mosHTML::BackButton ( $params );
}

function showItem( $uid, $gid, &$access, $pop, $option, $now ) {
	global $database, $mainframe;
	global $mosConfig_offset, $mosConfig_live_site, $mosConfig_MetaTitle, $mosConfig_MetaAuthor;

	if ( $access->canEdit ) {
		$xwhere='';
	} else {
		$xwhere = "AND (a.state = '1')";
	}

	$query = "SELECT a.*, ROUND(v.rating_sum/v.rating_count) AS rating, v.rating_count, u.name AS author, u.usertype, cc.name AS category, s.name AS section, g.name AS groups"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
	. "\n LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope='content'"
	. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
	. "\n LEFT JOIN #__content_rating AS v ON a.id = v.content_id"
	. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
	. "\n WHERE a.id='". $uid ."' ". $xwhere
	. "\n AND a.access <= ". $gid
	;
	$database->setQuery( $query );
	$row = NULL;

	if ( $database->loadObject( $row ) ) {
		$params =& new mosParameters( $row->attribs );
		$params->set( 'intro_only', 0 );
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
		if ( $row->sectionid == 0) {
			$params->set( 'item_navigation', 0 );
		} else {
			$params->set( 'item_navigation', $mainframe->getCfg( 'item_navigation' ) );
		}
		// loads the links for Next & Previous Button
		if ( $params->get( 'item_navigation' ) ) {
			$query = "SELECT a.id"
			. "\n FROM #__content AS a"
			. "\n WHERE a.catid = ". $row->catid.""
			. "\n AND a.state = $row->state AND ordering < $row->ordering"
			. ($access->canEdit ? "" : "\n AND a.access <= '". $gid ."'" )
			. "\n ORDER BY a.ordering DESC"
			. "\n LIMIT 1"
			;
			$database->setQuery( $query );
			$row->prev = $database->loadResult();

			$query = "SELECT a.id"
			. "\n FROM #__content AS a"
			. "\n WHERE a.catid = ". $row->catid.""
			. "\n AND a.state = $row->state AND ordering > $row->ordering"
			. ($access->canEdit ? "" : "\n AND a.access <= '". $gid ."'" )
			. "\n ORDER BY a.ordering"
			. "\n LIMIT 1"
			;
			$database->setQuery( $query );
			$row->next = $database->loadResult();
		}
		// page title
		$mainframe->setPageTitle( $row->title );
		if ($mosConfig_MetaTitle=='1') {
			$mainframe->addMetaTag( 'title' , $row->title );
		}
		if ($mosConfig_MetaAuthor=='1') {
			$mainframe->addMetaTag( 'author' , $row->author );
		}

		show( $row, $params, $gid, $access, $pop, $option );
	} else {
		mosNotAuth();
		return;
	}
}


function show( $row, $params, $gid, &$access, $pop, $option ) {
	global $database, $mainframe, $Itemid;
	global $mosConfig_live_site, $mosConfig_absolute_path;
	global $options, $task;

	$noauth = !$mainframe->getCfg( 'shownoauth' );

	if ( $access->canEdit ) {
		if ( $row->id === null || $row->access > $gid ) {
			mosNotAuth();
			return;
		}
	} else {
		if ( $row->id === null || $row->state == 0 ) {
			mosNotAuth();
			return;
		}
		if ( $row->access > $gid ) {
			if ( $noauth ) {
				mosNotAuth();
				return;
			} else {
				if ( !( $params->get( 'intro_only' ) ) ) {
					mosNotAuth();
					return;
				}
			}
		}
	}

	$sectionid = $row->sectionid;
	$catid = $row->catid;
	
	$params->def( 'category', 0 );
	$params->def( 'category_link', 0 );
	$params->def( 'item_title', 1 );
	$params->def( 'introtext', 1 );
	$params->def( 'url', 1 );
	
	// GC Parameters
	$params->def( 'link_titles', $mainframe->getCfg( 'link_titles' ) );
	$params->def( 'readmore', $mainframe->getCfg( 'readmore' ) );
	$params->def( 'rating', $mainframe->getCfg( 'vote' ) );
	$params->def( 'author', !$mainframe->getCfg( 'hideAuthor' ) );
	$params->def( 'createdate', !$mainframe->getCfg( 'hideCreateDate' ) );
	$params->def( 'modifydate', !$mainframe->getCfg( 'hideModifyDate' ) );
	$params->def( 'pdf', !$mainframe->getCfg( 'hidePdf' ) );
	$params->def( 'print', !$mainframe->getCfg( 'hidePrint' ) );
	$params->def( 'email', !$mainframe->getCfg( 'hideEmail' ) );
	$params->def( 'icons', $mainframe->getCfg( 'icons' ) );

	// loads the link for Category name
	if ( $params->get( 'category_link' ) ) {
		$query = 	"SELECT a.id, a.link"
		. "\n FROM #__menu AS a"
		. "\n WHERE a.componentid = ". $row->catid.""
		;
		$database->setQuery( $query );
		$catmenuitem = $database->loadObjectList();
		if ($catmenuitem) {
			$link = $catmenuitem[0]->link . '&Itemid='.$catmenuitem[0]->id;
		}
		else {
			$link = "index.php?option=com_content&task=blogcategory&sectionid=$sectionid&id=$catid&Itemid=$Itemid";
		}
		$link = sefRelToAbs( $link );
		$row->category = '<a href="'. $link .'">'. $row->category .'</a>';
	}

	// loads current template for the pop-up window
	$template = '';
	if ( $pop ) {
		$params->set( 'popup', 1 );
		$database->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'" );
		$template = $database->loadResult();
	}

	// show/hides the intro text
	if ( $params->get( 'introtext'  ) ) {
		$row->text = $row->introtext. ( $params->get( 'intro_only' ) ? '' : chr(13) . chr(13) . $row->fulltext);
	} else {
		$row->text = $row->fulltext;
	}

	// deal with the {mospagebreak} mambots
	// only permitted in the full text area
	$page = intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );

	// record the hit
	if ( !$params->get( 'intro_only' ) ) {
		$obj = new mosContent( $database );
		$obj->hit( $row->id );
	}
	if ($task=='view') {
		$mainframe->appendMetaTag( 'description', $row->metadesc );
		$mainframe->appendMetaTag( 'keywords', $row->metakey );
	}
	HTML_content::show( $row, $params, $access, $page, $option );
}

function showWrapItem( $uid, $gid ) {
	global $database, $Itemid, $mainframe;

	$query = "SELECT a.title, a.urls, a.metakey, a.metadesc FROM #__content AS a"
	. "\n WHERE a.id='". $uid ."' "
	. "\n AND a.access <= ". $gid
	;
	$database->setQuery( $query );
	$row = NULL;

	if ( $database->loadObject( $row ) ) {
		$params =& new mosParameters('');
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
		$params->def( 'scrolling', 'auto' );
		$params->def( 'page_title', '1' );
		$params->def( 'pageclass_sfx', '' );
		$params->def( 'header', $row->title );
		$params->def( 'height', '500' );
		$params->def( 'height_auto', '1' );
		$params->def( 'width', '100%' );
		$params->def( 'add', '1' );
		// auto height control
		if ( $params->def( 'height_auto' ) ) {
			$row->load = 'window.onload = iFrameHeight;';
		} else {
			$row->load = '';
		}
	
		$mainframe->SetPageTitle($row->title);
		$mainframe->prependMetaTag( 'description', $row->metadesc );
		$mainframe->prependMetaTag( 'keywords', $row->metakey );
		HTML_content::showWrapItem( $row, $params );
	}
}


function editItem( $uid, $gid, &$access, $sectionid=-1, $task, $Itemid ){
	global $database, $mainframe, $my;
	global $mosConfig_absolute_path, $mosConfig_live_site;

	$row = new mosContent( $database );
	// load the row from the db table
	$row->load( $uid );

	// fail if checked out not by 'me'
	if ( $row->checked_out && $row->checked_out <> $my->id ) {
		echo"<script>alert('The module [ ".$row->title." ] is currently being edited by another person.'); window.history.go(-1); </script>";
		exit;
	}

	if ( $uid ) {
		// edit existing record
		if ( !( $access->canEdit || ( $access->canEditOwn && $row->created_by == $my->id ) ) ) {
			mosNotAuth();
			return;
		}
	} else {
		// new record
		if (!($access->canEdit || $access->canEditOwn)) {
			mosNotAuth();
			return;
		}
	}

	if ( $uid ) {
		$sectionid = $row->sectionid;
	}

	$sectionid = intval( $sectionid );
	if ( $sectionid == -1 ) {
		$where = "\n WHERE section NOT LIKE '%com_%'";
	} else {
		$where = "\n WHERE section='$sectionid'";
	}
	
	$lists = array();

	// get the type name - which is a special category
	$query = "SELECT name FROM #__sections WHERE id='$sectionid'";
	$database->setQuery( $query );
	$sectionname = $database->loadResult();

	if ( $uid == 0 ) {
		$row->catid = 0;
	}

	if ( $uid ) {
		$row->checkout( $my->id );
		if (trim( $row->images )) {
			$row->images = explode( "\n", $row->images );
		} else {
			$row->images = array();
		}
		$query = "SELECT name from #__users"
		. "\n WHERE id = ". $row->created_by
		;
		$database->setQuery( $query	);
		$row->creator = $database->loadResult();

		$query = "SELECT name from #__users"
		. "\n WHERE id = ". $row->modified_by
		;
		$database->setQuery( $query );
		$row->modifier = $database->loadResult();

		$query = "SELECT content_id from #__content_frontpage"
		."\n WHERE content_id = ". $row->id
		;
		$database->setQuery( $query );
		$row->frontpage = $database->loadResult();
	} else {
		$row->sectionid 	= $sectionid;
		$row->version 		= 0;
		$row->state 		= 0;
		$row->ordering 		= 0;
		$row->images 		= array();
		$row->creator 		= 0;
		$row->modifier 		= 0;
		$row->frontpage 	= 0;
	}


	// calls function to read image from directory
	$pathA 		= $mosConfig_absolute_path .'/images/stories';
	$pathL 		= $mosConfig_live_site .'/images/stories';
	$images 	= array();
	$folders 	= array();
	$folders[] 	= mosHTML::makeOption( '/' );
	mosAdminMenus::ReadImages( $pathA, '/', $folders, $images );
	// list of folders in images/stories/
	$lists['folders'] 		= mosAdminMenus::GetImageFolders( $folders, $pathL );
	// list of images in specfic folder in images/stories/
	$lists['imagefiles']	= mosAdminMenus::GetImages( $images, $pathL );
	// list of saved images
	$lists['imagelist'] 	= mosAdminMenus::GetSavedImages( $row, $pathL );

	// make the select list for the states
	$states[] = mosHTML::makeOption( 0, _CMN_UNPUBLISHED );
	$states[] = mosHTML::makeOption( 1, _CMN_PUBLISHED );
	$lists['state'] 		= mosHTML::selectList( $states, 'state', 'class="inputbox" size="1"', 'value', 'text', intval( $row->state ) );

	// build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text"
	. "\n FROM #__content"
	. "\n WHERE catid = '$row->catid'"
	. "\n ORDER BY ordering"
	;
	$lists['ordering'] 		= mosAdminMenus::SpecificOrdering( $row, $uid, $query, 1 );

	// build list of categories
	//$lists['catid'] 		= mosAdminMenus::ComponentCategory( 'catid', $sectionid, intval( $row->catid ) );
	// build the select list for the image positions
	$lists['_align'] 		= mosAdminMenus::Positions( '_align' );
	// build the html select list for the group access
	$lists['access'] 		= mosAdminMenus::Access( $row );


	$javascript = "onchange=\"changeDynaList( 'catid', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);\"";

	$query = "SELECT s.id AS value, s.title AS text"
	. "\n FROM #__sections AS s"
	. "\n ORDER BY s.ordering";
	$database->setQuery( $query );
	$sections = $database->loadObjectList();
	$sections1[] = mosHTML::makeOption( '-1', _SELECT_SEC );
	$sections1 = array_merge( $sections1, $sections );
	$lists['sectionid'] = mosHTML::selectList( $sections1, 'sectionid', 'class="inputbox" size="1" '. $javascript, 'value', 'text', $sectionid );

	$sectioncategories 			= array();
	$sectioncategories[-1] 		= array();
	$sectioncategories[-1][] 	= mosHTML::makeOption( '-1', _SELECT_CAT );
	foreach($sections as $section) {
		$sectioncategories[$section->value] = array();
		$query = "SELECT id AS value, title AS text"
			. "\n FROM #__categories"
			. "\n WHERE section='$section->value'"
			. "\n ORDER BY ordering";
		$database->setQuery( $query );
		$rows2 = $database->loadObjectList();
		foreach($rows2 as $row2) {
			$sectioncategories[$section->value][] = mosHTML::makeOption( $row2->value, $row2->text );
		}
	}

	$categories = array();
 	// get list of categories
  	if ( !$row->catid && !$row->sectionid ) {
 		$categories[] 		= mosHTML::makeOption( '-1', _SELECT_CAT );
 		$lists['catid'] 	= mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1"', 'value', 'text' );
  	} else {
 		$query = "SELECT id AS value, name AS text"
 		. "\n FROM #__categories"
 		. $where
 		. "\n ORDER BY ordering";
 		$database->setQuery( $query );
 		$categories[] 		= mosHTML::makeOption( '-1', _SELECT_CAT );
 		$categories 		= array_merge( $categories, $database->loadObjectList() );
 		$lists['catid'] 	= mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1"', 'value', 'text', intval( $row->catid ) );
  	}

	HTML_content::editContent( $row, $sectionname, $lists, $images, $access, $my->id, $sectionid, $task, $Itemid, $sectioncategories );
}

/**
* Change value of `count` field of table categories
*/
function changeCountCat( $catid, $delta ) {
	global $database;
	$database->setQuery( "UPDATE #__categories SET `count` = `count` + $delta WHERE id='$catid'" );
	if (!$database->query()) {
		echo "<script> alert('".$database->stderr()."');</script>\n";
		exit();
	}
}

/**
* Change value of `count` field of table sections
*/
function changeCountSection( $secid, $delta ) {
	global $database;
	$database->setQuery( "UPDATE #__sections SET `count` = `count` + $delta WHERE id='$secid'" );
	if (!$database->query()) {
		echo "<script> alert('".$database->stderr()."');</script>\n";
		exit();
	}
}

/**
* Saves the content item an edit form submit
*/
function saveContent( &$access ) {
	global $database, $mainframe, $my;
	global $mosConfig_absolute_path;

	$row = new mosContent( $database );
	if ( !$row->bind( $_POST ) ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	// sanitize
	$row->id = intval($row->id);
	$row->catid = intval($row->catid);
	$row->sectionid = intval($row->sectionid);
	//
	$isNew = $row->id < 1;
	if ( $isNew ) {
		// new record
		if ( !( $access->canEdit || $access->canEditOwn ) ) {
			mosNotAuth();
			return;
		}
		$row->created = date( 'Y-m-d H:i:s' );
		$row->created_by = $my->id;
	} else {
		// existing record
		if ( !( $access->canEdit || ( $access->canEditOwn && $row->created_by == $my->id ) ) ) {
			mosNotAuth();
			return;
		}
		$row->modified = date( 'Y-m-d H:i:s' );
		$row->modified_by = $my->id;
	}

	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->version++;
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	//Change value of `count` field of table sections and categories
	if ( $isNew ) {
		if ( $row->state ) {
			changeCountCat($row->catid, 1);
			changeCountSection($row->sectionid, 1);
		}
	}
	else {
		$oldstate = intval( mosGetParam( $_POST, 'oldstate', 0 ) );
		if ( $oldstate != $row->state ) {
			$delta = ( $row->state == "1" ) ? 1 : -1;
			changeCountCat($row->catid, $delta);
			changeCountSection($row->sectionid, $delta);
		}
	}
	
	// manage frontpage items
	require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );
	$fp = new mosFrontPage( $database );

	if ( mosGetParam( $_REQUEST, 'frontpage', 0 ) ) {

		// toggles go to first place
		if (!$fp->load( $row->id )) {
			// new entry
			$database->setQuery( "INSERT INTO #__content_frontpage VALUES ('$row->id','1')" );
			if (!$database->query()) {
				echo "<script> alert('".$database->stderr()."');</script>\n";
				exit();
			}
			$fp->ordering = 1;
		}
	} else {
		// no frontpage mask
		if ( !$fp->delete( $row->id ) ) {
			$msg .= $fp->stderr();
		}
		$fp->ordering = 0;
	}
	$fp->updateOrder();

	$row->checkin();
	$row->updateOrder( "catid='$row->catid'" );

	// gets section name of item
	$database->setQuery( "SELECT s.title"
	. "\n FROM #__sections AS s"
	. "\n WHERE s.scope = 'content'"
	. "\n AND s.id = '". $row->sectionid ."'"
	);
	// gets category name of item
	$section = $database->loadResult();
	$database->setQuery( "SELECT c.title"
	. "\n FROM #__categories AS c"
	. "\n WHERE c.id = '". $row->catid ."'"
	);
	$category = $database->loadResult();

 	$Itemid 	= mosGetParam( $_POST, 'Returnid', '0' );
 	$msg 	= $isNew ? _THANK_SUB : _E_ITEM_SAVED;
	mosRedirect( 'index.php', $msg );
}


/**
* Cancels an edit operation
* @param database A database connector object
*/
function cancelContent( &$access ) {
	global $database, $mainframe, $my;

	$row = new mosContent( $database );
	$row->bind( $_POST );

	if ( $access->canEdit || ( $access->canEditOwn && $row->created_by == $my->id ) ) {
		$row->checkin();
	}

	$Itemid = mosGetParam( $_POST, 'Returnid', '0' );

	if ( $Itemid ) {
		$sectionid = $row->sectionid;
		$catid = $row->catid;
		$id = $row->id;
		mosRedirect( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$Itemid" );
	} else {
		mosRedirect( 'index.php' );
	}
}

/**
* Shows the email form for a given content item.
*/
function emailContentForm( $uid ) {
	global $database, $mainframe, $my;
	$row = new mosContent( $database );
	$row->load( $uid );

	if ( $row->id === null || $row->access > $my->gid ) {
		mosNotAuth();
		return;
	} else {
		$template='';
		$database->setQuery( "SELECT template FROM #__templates_menu WHERE client_id = '0' AND menuid = '0'" );
		$template = $database->loadResult();
		HTML_content::emailForm( $row->id, $row->title, $template );		
	}

}


/**
* Shows the email form for a given content item.
*/
function emailContentSend( $uid ) {
	global $database, $mainframe;
	global $mosConfig_live_site, $mosConfig_sitename;
	global $mosConfig_mailfrom, $mosConfig_fromname;

	$email = trim( mosGetParam( $_POST, 'email', '' ) );
	$yourname = trim( mosGetParam( $_POST, 'yourname', '' ) );
	$youremail = trim( mosGetParam( $_POST, 'youremail', '' ) );
	$subject_default = _EMAIL_INFO ." $yourname";
	$subject = trim( mosGetParam( $_POST, 'subject', $subject_default ) );

	$form_check = mosGetParam( $_POST, 'form_check', '' );    
    if (empty($_SESSION['_form_check_']['com_content']) || $form_check != $_SESSION['_form_check_']['com_content']) {
      // the form hasn't been generated by the server on this session 	
       exit;
    }  
	if ( !$email || !$youremail || ( is_email( $email ) == false ) || ( is_email( $youremail ) == false ) ) {
		echo "<script>alert (\""._EMAIL_ERR_NOINFO."\"); window.history.go(-1);</script>";
		exit(0);
	}

	$template='';
	$database->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'" );
	$template = $database->loadResult();

	// link sent in email
	$row = new mosContent( $database );
	// load the row from the db table
	$row->load( $uid );
	
	$sectionid = $row->sectionid;
	$catid = $row->catid;
	$id = $row->id;
	$Itemid = getContentItemid($sectionid, $catid, $id);
	$link = sefRelToAbs( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$Itemid" );
	// message text
	$msg = sprintf( _EMAIL_MSG, $mosConfig_sitename, $yourname, $youremail, $link );

	// mail function
	mosMail( $mosConfig_mailfrom, $mosConfig_fromname, $email, $subject, $msg );

	HTML_content::emailSent( $email, $template );
}

function is_email( $email ){
	$rBool = false;

	if ( preg_match( "/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email ) ) {
		$rBool = true;
	}
	return $rBool;
}

function recordVote() {
	global $database;

	$user_rating = mosGetParam( $_REQUEST, 'user_rating', 0 );
	$url = mosGetParam( $_REQUEST, 'url', '' );
	$cid = mosGetParam( $_REQUEST, 'cid', 0 );
	$cid = intval( $cid );
	$user_rating = intval( $user_rating );

	if ( ( $user_rating >= 1 ) and ( $user_rating <= 5 ) ) {
		$currip = getenv( 'REMOTE_ADDR' );

		$query = "SELECT * FROM #__content_rating WHERE content_id = $cid";
		$database->setQuery( $query );
		$votesdb = NULL;
		if ( !( $database->loadObject( $votesdb ) ) ) {
			$query = "INSERT INTO #__content_rating ( content_id, lastip, rating_sum, rating_count )"
			. "\n VALUES ( '$cid', '$currip', '$user_rating', '1' )";
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );;
		} else {
			if ($currip <> ($votesdb->lastip)) {
				$query = "UPDATE #__content_rating"
				. "\n SET rating_count = rating_count + 1,"
				. "\n rating_sum = rating_sum + $user_rating,"
				. "\n lastip = '$currip'"
				. "\n WHERE content_id = ". $cid
				;
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			} else {
				mosRedirect ( $url, _ALREADY_VOTE );
			}
		}
		mosRedirect ( $url, _THANKS );
	}
}


function _orderby( $orderby ) {
	switch ( $orderby ) {
		case 'date':
			$orderby = 'a.created';
			break;
		case 'rdate':
			$orderby = 'a.created DESC';
			break;
		case 'alpha':
			$orderby = 'a.title';
			break;
		case 'ralpha':
			$orderby = 'a.title DESC';
			break;
		case 'hits':
			$orderby = 'a.hits DESC';
			break;
		case 'rhits':
			$orderby = 'a.hits ASC';
			break;
		case 'author':
			$orderby = 'a.created_by, u.name';
			break;
		case 'rauthor':
			$orderby = 'a.created_by DESC, u.name DESC';
			break;
		case 'front':
			$orderby = 'f.ordering';
			break;
		case 'order':
		default:
			$orderby = 'a.ordering';
			break;
	}

	return $orderby;
}

/*
* @param int 1 = Section, 2 = Category
*/
function _where( $type=1, &$access, &$noauth, $gid, $id, $now=NULL, $year=NULL, $month=NULL ) {
	global $iscf, $cf_begindate, $cf_enddate;
	$where = array();

	// normal
	if ( $type > 0) {
		$where[] = "a.state = '1'";

		if ( $noauth ) {
			$where[] = "a.access <= '$gid'";
		}
		if ( $id > 0 ) {
			if ( $type == 1 ) {
				$where[] = "a.sectionid = '$id'";
			} else if ( $type == 2 ) {
				$where[] = "a.catid = '$id'";
			}
		}
		if ($iscf) {
			$where[] = "a.created > '$cf_begindate'";
			$where[] = "a.created < '$cf_enddate'";
		}
	}

	return $where;
}
?>

<?php
/**
* @version $Id: admin.content.php,v 1.3 2005/11/23 23:47:03 counterpoint Exp $
* @package Mambo
* @subpackage Content
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'admin_html' ) );

$sectionid = mosGetParam( $_REQUEST, 'sectionid', 0 );
$id = mosGetParam( $_REQUEST, 'id', '' );
$cid = mosGetParam( $_POST, 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case 'new':
		editContent( 0, $sectionid, $option );
		break;

	case 'edit':
		editContent( $id, $sectionid, $option );
		break;

	case 'editA':
		editContent( $cid[0], '', $option );
		break;

	case 'go2menu':
	case 'go2menuitem':
	case 'resethits':
	case 'menulink':
	case 'apply':
	case 'save':
		saveContent( $sectionid, $task );
		break;

	case 'remove':
		removeContent( $cid, $sectionid, $option );
		break;

	case 'publish':
		changeContent( $cid, 1, $option );
		break;

	case 'unpublish':
		changeContent( $cid, 0, $option );
		break;

	case 'toggle_frontpage':
		toggleFrontPage( $cid, $sectionid, $option );
		break;

	case 'cancel':
		cancelContent();
		break;

	case 'orderup':
		orderContent( $cid[0], -1, $option );
		break;

	case 'orderdown':
		orderContent( $cid[0], 1, $option );
		break;

	case 'movesect':
		moveSection( $cid, $sectionid, $option );
		break;

	case 'movesectsave':
		moveSectionSave( $cid, $sectionid, $option );
		break;

	case 'copy':
		copyItem( $cid, $sectionid, $option );
		break;

	case 'copysave':
		copyItemSave( $cid, $sectionid, $option );
		break;

	case 'accesspublic':
		accessMenu( $cid[0], 0, $option );
		break;

	case 'accessregistered':
		accessMenu( $cid[0], 1, $option );
		break;

	case 'accessspecial':
		accessMenu( $cid[0], 2, $option );
		break;

	case 'saveorder':
		saveOrder( $cid );
		break;

	default:
		viewContent( $sectionid, $option );
		break;
}

/**
* Compiles a list of installed or defined modules
* @param database A database connector object
*/
function viewContent( $sectionid, $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $adminLanguage;

	$catid 				= $mainframe->getUserStateFromRequest( "catid{$option}{$sectionid}", 'catid', 0 );
	$filter_authorid 	= $mainframe->getUserStateFromRequest( "filter_authorid{$option}{$sectionid}", 'filter_authorid', 0 );
	$filter_sectionid 	= $mainframe->getUserStateFromRequest( "filter_sectionid{$option}{$sectionid}", 'filter_sectionid', 0 );
	$limit 				= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart 		= $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 );
	$search 			= $mainframe->getUserStateFromRequest( "search{$option}{$sectionid}", 'search', '' );
	$search 			= $database->getEscaped( trim( strtolower( $search ) ) );
	$redirect 			= $sectionid;
	$filter 			= ''; //getting a undefined variable error

	if ( $sectionid == 0 ) {
		// used to show All content items
		$where = array(
		"c.state >= 0",
		"c.catid=cc.id",
		"cc.section=s.id",
		"s.scope='content'",
		);
		$order = "\n ORDER BY s.title, c.catid, cc.ordering, cc.title, c.ordering";
		$all = 1;
		//$filter = "\n , #__sections AS s WHERE s.id = c.section";

		if ($filter_sectionid > 0) {
			$filter = "\nWHERE cc.section=$filter_sectionid";
		}
		$section->title = $adminLanguage->A_COMP_CONTENT_ALL_ITEMS;
		$section->id = 0;
	} else {
		$where = array(
		"c.state >= 0",
		"c.catid=cc.id",
		"cc.section=s.id",
		"s.scope='content'",
		"c.sectionid='$sectionid'"
		);
		$order = "\n ORDER BY cc.ordering, cc.title, c.ordering";
		$all = NULL;
		$filter = "\n WHERE cc.section = '$sectionid'";
		$section = new mosSection( $database );
		$section->load( $sectionid );
	}

	// used by filter
	if ( $filter_sectionid > 0 ) {
		$where[] = "c.sectionid = '$filter_sectionid'";
	}
	if ( $catid > 0 ) {
		$where[] = "c.catid = '$catid'";
	}
	if ( $filter_authorid > 0 ) {
		$where[] = "c.created_by = '$filter_authorid'";
	}

	if ( $search ) {
		$where[] = "LOWER( c.title ) LIKE '%$search%'";
	}

	// get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__content AS c, #__categories AS cc, #__sections AS s"
	. (count( $where ) ? "\nWHERE " . implode( ' AND ', $where ) : "")
	);
	$total = $database->loadResult();
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT c.*, g.name AS groupname, cc.name, u.name AS editor, f.content_id AS frontpage, s.title AS section_name, v.name AS author"
	. "\n FROM #__categories AS cc, #__sections AS s, #__content AS c "
	. "\n LEFT JOIN #__groups AS g ON g.id = c.access"
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__users AS v ON v.id = c.created_by"
	. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = c.id"
	. ( count( $where ) ? "\nWHERE " . implode( ' AND ', $where ) : '' )
	. $order
	. "\n LIMIT $pageNav->limitstart,$pageNav->limit"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// get list of categories for dropdown filter
	$query = "SELECT cc.id AS value, cc.title AS text, section"
	. "\n FROM #__categories AS cc"
	. "\n INNER JOIN #__sections AS s ON s.id=cc.section "
	. $filter
	. "\n ORDER BY s.ordering, cc.ordering"
	;
	$lists['catid'] 	= filterCategory( $query, $catid );

	// get list of sections for dropdown filter
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sectionid']	= mosAdminMenus::SelectSection( 'filter_sectionid', $filter_sectionid, $javascript );

	// get list of Authors for dropdown filter
	$query = "SELECT c.created_by AS value, u.name AS text"
	. "\n FROM #__content AS c"
	. "\n INNER JOIN #__sections AS s ON s.id = c.sectionid"
	. "\n LEFT JOIN #__users AS u ON u.id = c.created_by"
	. "\n WHERE c.state <> '-1'"
	. "\n AND c.state <> '-2'"
	. "\n GROUP BY u.name"
	. "\n ORDER BY u.name"
	;
	$authors[] = mosHTML::makeOption( '0', _SEL_AUTHOR );
	$database->setQuery( $query );
	$authors = array_merge( $authors, $database->loadObjectList() );
	$lists['authorid']	= mosHTML::selectList( $authors, 'filter_authorid', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_authorid );

	HTML_content::showContent( $rows, $section, $lists, $search, $pageNav, $all, $redirect );
}

/**
* Compiles information to add or edit the record
* @param database A database connector object
* @param integer The unique id of the record to edit (0 if new)
* @param integer The id of the content section
*/
function editContent( $uid=0, $sectionid=0, $option ) {
	global $database, $my, $mainframe, $adminLanguage;
	global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_offset;

	$redirect = mosGetParam( $_POST, 'redirect', '' );
	if ( !$redirect ) {
		$redirect = $sectionid;
	}

	// load the row from the db table
	$row = new mosContent( $database );
	$row->load( $uid );

	if ($uid) {
		$sectionid = $row->sectionid;
	}

	if ( $sectionid == 0 ) {
		$where = "\n WHERE section NOT LIKE '%com_%'";
	} else {
		$where = "\n WHERE section='$sectionid'";
	}

	// get the type name - which is a special category
	 if ($row->sectionid){
		$query = "SELECT name FROM #__sections WHERE id=$row->sectionid";
		$database->setQuery( $query );
		$section = $database->loadResult();
		$contentSection = $section;
	} else {
		$query = "SELECT name FROM #__sections WHERE id=$sectionid";
		$database->setQuery( $query );
		$section = $database->loadResult();
		$contentSection = $section;
	}

	// fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		mosRedirect( 'index2.php?option=com_content', $adminLanguage->A_COMP_CONTENT_MODULE .' '. $row->title .' '. $adminLanguage->A_COMP_CONTENT_ANOTHER );
	}

	if ($uid) {
		$row->checkout( $my->id );
		if (trim( $row->images )) {
			$row->images = explode( "\n", $row->images );
		} else {
			$row->images = array();
		}

 		$row->created 		= mosFormatDate( $row->created, '%Y-%m-%d %H:%M:%S' );
		$row->modified 		= mosFormatDate( $row->modified, '%Y-%m-%d %H:%M:%S' );

		$query = "SELECT name from #__users"
		. "\n WHERE id=$row->created_by"
		;
		$database->setQuery( $query );
		$row->creator = $database->loadResult();

		$query = "SELECT name from #__users"
		. "\n WHERE id=$row->modified_by"
		;
		$database->setQuery( $query );
		$row->modifier = $database->loadResult();

		$query = "SELECT content_id from #__content_frontpage"
		. "\n WHERE content_id=$row->id"
		;
		$database->setQuery( $query );
		$row->frontpage = $database->loadResult();

		// get list of links to this item
		$and = "\n AND componentid = ". $row->id;
		$menus = mosAdminMenus::Links2Menu( 'content_item_link', $and );
	} else {
		$row->sectionid 	= $sectionid;
		$row->version 		= 0;
		$row->state 		= 1;
		$row->ordering 		= 0;
		$row->images 		= array();
		$row->catid 		= NULL;
		$row->creator 		= '';
		$row->modifier 		= '';
		$row->frontpage 	= 0;
		$menus = array();
	}

	$javascript = "onchange=\"changeDynaList( 'catid', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);\"";

	$query = "SELECT s.id AS value, s.title AS text"
	. "\n FROM #__sections AS s"
	. "\n ORDER BY s.ordering";
	$database->setQuery( $query );
	$sections = $database->loadObjectList();
	if ( $sectionid == 0 ) {
		$sections1[] = mosHTML::makeOption( '-1', $adminLanguage->A_COMP_CONTENT_SELECT_SEC );
		$sections1 = array_merge( $sections1, $sections );
		$lists['sectionid'] = mosHTML::selectList( $sections1, 'sectionid', 'class="inputbox" size="1" '. $javascript, 'value', 'text' );
	} else {
		$intval = intval( $row->sectionid);
		$lists['sectionid'] = mosHTML::selectList( $sections, 'sectionid', 'class="inputbox" size="1" '. $javascript, 'value', 'text', $intval );
	}

	$sectioncategories 			= array();
	$sectioncategories[-1] 		= array();
	$sectioncategories[-1][] 	= mosHTML::makeOption( '-1', $adminLanguage->A_COMP_CONTENT_SELECT_CAT );
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
 		$categories[] 		= mosHTML::makeOption( '-1', $adminLanguage->A_COMP_CONTENT_SELECT_CAT );
 		$lists['catid'] 	= mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1"', 'value', 'text' );
  	} else {
 		$query = "SELECT id AS value, name AS text"
 		. "\n FROM #__categories"
 		. $where
 		. "\n ORDER BY ordering";
 		$database->setQuery( $query );
 		$categories[] 		= mosHTML::makeOption( '-1', $adminLanguage->A_COMP_CONTENT_SELECT_CAT );
 		$categories 		= array_merge( $categories, $database->loadObjectList() );
 		$lists['catid'] 	= mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1"', 'value', 'text', intval( $row->catid ) );
  	}

	// build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text"
	. "\n FROM #__content"
	. "\n WHERE catid='$row->catid'"
	. "\n AND state >= 0"
	. "\n ORDER BY ordering"
	;
	$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $uid, $query, 1 );

	// calls function to read image from directory
	$pathA 		= $mosConfig_absolute_path .'/images/stories';
	$pathL 		= $mosConfig_live_site .'/images/stories';
	$images 	= array();
	$folders 	= array();
	$folders[] 	= mosHTML::makeOption( '/' );
	mosAdminMenus::ReadImages( $pathA, '/', $folders, $images );

	// list of folders in images/stories/
	$lists['folders'] 			= mosAdminMenus::GetImageFolders( $folders, $pathL );
	// list of images in specfic folder in images/stories/
	$lists['imagefiles']		= mosAdminMenus::GetImages( $images, $pathL );
	// list of saved images
	$lists['imagelist'] 		= mosAdminMenus::GetSavedImages( $row, $pathL );

	// build list of users
	$active = ( intval( $row->created_by ) ? intval( $row->created_by ) : $my->id );
	$lists['created_by'] 		= mosAdminMenus::UserSelect( 'created_by', $active );
	// build the select list for the image position alignment
	$lists['_align'] 			= mosAdminMenus::Positions( '_align' );
	// build the select list for the image caption alignment
	$lists['_caption_align'] 	= mosAdminMenus::Positions( '_caption_align' );
	// build the html select list for the group access
	$lists['access'] 			= mosAdminMenus::Access( $row );
	// build the html select list for menu selection
	$lists['menuselect']		= mosAdminMenus::MenuSelect( );

	// build the select list for the image caption position
	$pos[] = mosHTML::makeOption( 'bottom', _CMN_BOTTOM );
	$pos[] = mosHTML::makeOption( 'top', _CMN_TOP );
	$lists['_caption_position'] = mosHTML::selectList( $pos, '_caption_position', 'class="inputbox" size="1"', 'value', 'text' );


	// get params definitions
	$params =& new mosParameters( $row->attribs, $mainframe->getPath( 'com_xml', 'com_content' ), 'component' );

	HTML_content::editContent( $row, $contentSection, $lists, $sectioncategories, $images, $params, $option, $redirect, $menus );
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
* @param database A database connector object
*/
function saveContent( $sectionid, $task ) {
	global $database, $my, $mainframe, $mosConfig_offset;

	$menu 		= mosGetParam( $_POST, 'menu', 'mainmenu' );
	$menuid		= mosGetParam( $_POST, 'menuid', 0 );

	$row = new mosContent( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	// sanitize
	$row->id = intval($row->id);
	$row->catid = intval($row->catid);
	$row->sectionid = intval($row->sectionid);
	//
	
	$isNew = ( $row->id < 1 );
	if ($isNew) {
		//$row->created		= $row->created ? $row->created : date( "Y-m-d H:i:s" );
		$row->created 		= $row->created ? mosFormatDate( $row->created, '%Y-%m-%d %H:%M:%S', -$mosConfig_offset ) : date( "Y-m-d H:i:s" );
		$row->created_by 	= $row->created_by ? $row->created_by : $my->id;
	} else {
		$row->modified 		= date( "Y-m-d H:i:s" );
		$row->modified_by 	= $my->id;
		//$row->created 	= $row->created ? $row->created : date( "Y-m-d H:i:s" );
		$row->created 		= $row->created ? mosFormatDate( $row->created, '%Y-%m-%d %H:%M:%S', -$mosConfig_offset ) : date( "Y-m-d H:i:s" );
		$row->created_by 	= $row->created_by ? $row->created_by : $my->id;
	}

	$row->state = intval( mosGetParam( $_POST, 'published', 0 ) );

	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ( $params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$row->attribs = implode( "\n", $txt );
	}

	// code cleaner for xhtml transitional compliance
	$row->introtext = str_replace( '<br>', '<br />', $row->introtext );
	$row->fulltext 	= str_replace( '<br>', '<br />', $row->fulltext );

 	// remove <br /> take being automatically added to empty fulltext
 	$length	= strlen( $row->fulltext ) < 9;
 	$search = strstr( $row->fulltext, '<br />');
 	if ( $length && $search ) {
 		$row->fulltext = NULL;
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
			if ( $oldstate ) {
				changeCountCat($row->catid, -1);
				changeCountSection($row->sectionid, -1);
			}
			else {
				changeCountCat($row->catid, 1);
				changeCountSection($row->sectionid, 1);
			}
		}
	}
	
	// manage frontpage items
	require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );
	$fp = new mosFrontPage( $database );

	if (mosGetParam( $_REQUEST, 'frontpage', 0 )) {

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
		if (!$fp->delete( $row->id )) {
			$msg .= $fp->stderr();
		}
		$fp->ordering = 0;
	}
	$fp->updateOrder();

	$row->checkin();
	$row->updateOrder( "catid='$row->catid' AND state >= 0" );

	$redirect = mosGetParam( $_POST, 'redirect', $sectionid );
	switch ( $task ) {
		case 'go2menu':
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menu );
			break;

		case 'go2menuitem':
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menu .'&task=edit&hidemainmenu=1&id='. $menuid );
			break;

		case 'menulink':
			menuLink( $redirect, $row->id );
			break;

		case 'resethits':
			resethits( $redirect, $row->id );
			break;

		case 'apply':
			$msg = 'Successfully Saved changes to Item: '. $row->title;
			mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $row->id, $msg );

		case 'save':
		default:
			$msg = 'Successfully Saved Item: '. $row->title;
			mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect, $msg );

			break;
	}
}

/**
* Changes the state of one or more content pages
* @param string The name of the category section
* @param integer A unique category id (passed from an edit form)
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function changeContent( $cid=null, $state=0, $option ) {
	global $database, $my, $adminLanguage;

	if ( $state > "1" || $state < "0") {
		return false;
	}
	
	if (count( $cid ) < 1) {
		$action = $state == 1 ? 'publish' : 'unpublish';
		echo "<script> alert('". $adminLanguage->A_COMP_SEL_ITEM ." ". $action ."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "SELECT id, sectionid, catid, state FROM #__content"
	. "\nWHERE id IN ($cids) AND (state>='0') AND (state<>'$state')"
	. "\nAND (checked_out=0 OR (checked_out='".$my->id."'))"
	);
	$rows = $database->loadObjectList();
	$total = count ( $rows );
	
	$database->setQuery( "UPDATE #__content SET state='$state'"
	. "\nWHERE id IN ($cids) AND (state>='0') AND (state<>'$state')"
	. "\nAND (checked_out=0 OR (checked_out='".$my->id."'))"
	);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ($total == 1) {
		$row = new mosContent( $database );
		$row->checkin( $rows[0]->id );
	}
	
	//Change value of `count` field of table sections and categories
	$delta = ( $state == "1" ) ? 1 : -1;
	foreach ($rows as $row) {
		changeCountCat($row->catid, $delta);
		changeCountSection($row->sectionid, $delta);
	}

	if ( $state == "1" ) {
		$msg = $total ." ". $adminLanguage->A_COMP_CONTENT_PUBLISHED;
	} else if ( $state == "0" ) {
		$msg = $total ." ". $adminLanguage->A_COMP_CONTENT_UNPUBLISHED;
	}

	$redirect = mosGetParam( $_POST, 'redirect', $row->sectionid );
	$task = mosGetParam( $_POST, 'returntask', '' );
	if ( $task ) {
		$task = '&task='. $task;
	} else {
		$task = '';
	}

	mosRedirect( 'index2.php?option='. $option . $task .'&sectionid='. $redirect .'&mosmsg='. $msg );
}

/**
* Changes the state of one or more content pages
* @param string The name of the category section
* @param integer A unique category id (passed from an edit form)
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function toggleFrontPage( $cid, $section, $option ) {
	global $database, $my, $mainframe, $adminLanguage;

	if (count( $cid ) < 1) {
		echo "<script> alert(\"". $adminLanguage->A_COMP_CONTENT_SEL_TOG ."\"); window.history.go(-1);</script>\n";
		exit;
	}

	$msg = '';
	require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );

	$fp = new mosFrontPage( $database );
	foreach ($cid as $id) {
		// toggles go to first place
		if ($fp->load( $id )) {
			if (!$fp->delete( $id )) {
				$msg .= $fp->stderr();
			}
			$fp->ordering = 0;
		} else {
			// new entry
			$database->setQuery( "INSERT INTO #__content_frontpage VALUES ('$id','0')" );
			if (!$database->query()) {
				echo "<script> alert('".$database->stderr()."');</script>\n";
				exit();
			}
			$fp->ordering = 0;
		}
		$fp->updateOrder();
	}

	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $section, $msg );
}

function removeContent( &$cid, $sectionid, $option ) {
	global $database, $mainframe, $adminLanguage;

	$total = count( $cid );
	if ( $total < 1) {
		echo "<script> alert(\"". $adminLanguage->A_COMP_CONTENT_SEL_DEL ."\"); window.history.go(-1);</script>\n";
		exit;
	}

	//seperate contentids
	$cids = implode( ',', $cid );
	
	$database->setQuery( "SELECT id, sectionid, catid FROM #__content WHERE id IN ($cids)" );
	$rows = $database->loadObjectList();
	
	$query = 	"DELETE FROM #__content_frontpage WHERE content_id IN ( ". $cids ." )";
	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$query = 	"DELETE FROM #__content WHERE id IN ( ". $cids ." )";
	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$affected_rows = mysql_affected_rows();
	
	//Change value of `count` field of table sections and categories
	foreach ($rows as $row) {
		changeCountCat($row->catid, -1);
		changeCountSection($row->sectionid, -1);
	}
	
	$msg = $affected_rows . $adminLanguage->A_COMP_CONTENT_SUCCESS_DEL;
	$return = mosGetParam( $_POST, 'returntask', '' );
	mosRedirect( 'index2.php?option='. $option .'&task='. $return .'&sectionid='. $sectionid, $msg );
}

/**
* Cancels an edit operation
*/
function cancelContent( ) {
	global $database;

	$row = new mosContent( $database );
	$row->bind( $_POST );
	// sanitize
	$row->id = intval($row->id);
	$row->checkin();

	$redirect = mosGetParam( $_POST, 'redirect', 0 );
	mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect );
}

/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderContent( $uid, $inc, $option ) {
	global $database;

	$row = new mosContent( $database );
	$row->load( $uid );
	$row->move( $inc, "catid='$row->catid' AND state >= 0" );

	$redirect = mosGetParam( $_POST, 'redirect', $row->sectionid );

	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $redirect );
}

/**
* Form for moving item(s) to a different section and category
*/
function moveSection( $cid, $sectionid, $option ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert(\"". $adminLanguage->A_COMP_CONTENT_SEL_MOVE ."\"); window.history.go(-1);</script>\n";
		exit;
	}

	//seperate contentids
	$cids = implode( ',', $cid );
	// Content Items query
	$query = 	"SELECT a.title"
	. "\n FROM #__content AS a"
	. "\n WHERE ( a.id IN (". $cids .") )"
	. "\n ORDER BY a.title"
	;
	$database->setQuery( $query );
	$items = $database->loadObjectList();

	$database->setQuery(
	$query = 	"SELECT CONCAT_WS( ', ', s.id, c.id ) AS `value`, CONCAT_WS( '/', s.name, c.name ) AS `text`"
	. "\n FROM #__sections AS s"
	. "\n INNER JOIN #__categories AS c ON c.section = s.id"
	. "\n WHERE s.scope = 'content'"
	. "\n ORDER BY s.name, c.name"
	);
	$rows = $database->loadObjectList();
	// build the html select list
	$sectCatList = mosHTML::selectList( $rows, 'sectcat', 'class="inputbox" size="8"', 'value', 'text', null );

	HTML_content::moveSection( $cid, $sectCatList, $option, $sectionid, $items );
}

/**
* Save the changes to move item(s) to a different section and category
*/
function moveSectionSave( &$cid, $sectionid, $option ) {
	global $database, $my, $adminLanguage;

	$sectcat = mosGetParam( $_POST, 'sectcat', '' );
	list( $newsect, $newcat ) = explode( ',', $sectcat );

	if (!$newsect || !$newcat ) {
		mosRedirect( "index.php?option=com_content&sectionid=$sectionid&mosmsg=". $adminLanguage->A_COMP_CONTENT_ERR_OCCURRED );
	}

	// find section name
	$query = "SELECT a.name"
	. "\n FROM #__sections AS a"
	. "\n WHERE a.id = ". $newsect .""
	;
	$database->setQuery( $query );
	$section = $database->loadResult();

	// find category name
	$query = "SELECT  a.name"
	. "\n FROM #__categories AS a"
	. "\n WHERE a.id = ". $newcat .""
	;
	$database->setQuery( $query );
	$category = $database->loadResult();

	$total = count( $cid );
	$cids = implode( ',', $cid );

	$rows = array();
	$row = new mosContent( $database );
	// update old orders - put existing items in last place
	foreach ($cid as $id) {
		$row->load( intval( $id ) );
		if ($row->state == 1) {
			$aClass = new stdClass();
			$aClass->id = $id;
			$aClass->sectionid = $row->sectionid;
			$aClass->catid = $row->catid;
			$rows[] = $aClass;
		}
		$row->ordering = 0;
		$row->store();
		$row->updateOrder( "catid='$row->catid' AND state >= 0" );
	}

	$query = "UPDATE #__content SET sectionid = '". $newsect ."', catid='". $newcat ."'"
	. "\n WHERE id IN ($cids)"
	. "\n AND ( checked_out='0' OR ( checked_out='". $my->id ."') )"
	;
	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	// update new orders - put items in last place
	foreach ($cid as $id) {
		$row->load( intval( $id ) );
		$row->ordering = 0;
		$row->store();
		$row->updateOrder( "catid='". $row->catid ."' AND state >= 0" );
	}

	//Change value of `count` field of table sections and categories
	//old section/category -1, new section/category +1
	foreach ($rows as $row) {
		if ($row->sectionid != $newsect) {
			changeCountSection($row->sectionid, -1);
			changeCountSection($newsect, 1);
		}
		if ($row->catid != $newcat) {
			changeCountCat($row->catid, -1);
			changeCountCat($newcat, 1);
		}
	}
	$msg = $total.' '. $adminLanguage->A_COMP_CONTENT_MOVED .': '. $section .', '. $adminLanguage->A_COMP_CATEG .': '. $category;
	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $sectionid .'&mosmsg='. $msg );
}


/**
* Form for copying item(s)
**/
function copyItem( $cid, $sectionid, $option ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert(\"". $adminLanguage->A_COMP_CONTENT_SEL_MOVE ."\"); window.history.go(-1);</script>\n";
		exit;
	}

	//seperate contentids
	$cids = implode( ',', $cid );
	## Content Items query
	$query = 	"SELECT a.title"
	. "\n FROM #__content AS a"
	. "\n WHERE ( a.id IN (". $cids .") )"
	. "\n ORDER BY a.title"
	;
	$database->setQuery( $query );
	$items = $database->loadObjectList();

	## Section & Category query
	$query = 	"SELECT CONCAT_WS(',',s.id,c.id) AS `value`, CONCAT_WS(' // ', s.name, c.name) AS `text`"
	. "\n FROM #__sections AS s"
	. "\n INNER JOIN #__categories AS c ON c.section = s.id"
	. "\n WHERE s.scope='content'"
	. "\n ORDER BY s.name, c.name"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	// build the html select list
	$sectCatList = mosHTML::selectList( $rows, 'sectcat', 'class="inputbox" size="10"', 'value', 'text', NULL );

	HTML_content::copySection( $option, $cid, $sectCatList, $sectionid, $items );
}


/**
* saves Copies of items
**/
function copyItemSave( $cid, $sectionid, $option ) {
	global $database, $my, $adminLanguage;

	$sectcat = mosGetParam( $_POST, 'sectcat', '' );
	//seperate sections and categories from selection
	$sectcat = explode( ',', $sectcat );
	list( $newsect, $newcat ) = $sectcat;

	if ( !$newsect && !$newcat ) {
		mosRedirect( 'index.php?option=com_content&sectionid='. $sectionid .'&mosmsg='. $adminLanguage->A_COMP_CONTENT_ERR_OCCURRED );
	}

	// find section name
	$query = 	"SELECT a.name"
	. "\n FROM #__sections AS a"
	. "\n WHERE a.id = ". $newsect .""
	;
	$database->setQuery( $query );
	$section = $database->loadResult();

	// find category name
	$query = 	"SELECT  a.name"
	. "\n FROM #__categories AS a"
	. "\n WHERE a.id = ". $newcat .""
	;
	$database->setQuery( $query );
	$category = $database->loadResult();

	$total = count( $cid );
	for ( $i = 0; $i < $total; $i++ ) {
		$row = new mosContent( $database );

		// main query
		$query =	"SELECT a.* FROM #__content AS a"
		. "\n WHERE a.id = ". $cid[$i] ."";
		;
		$database->setQuery( $query );
		$item = $database->loadObjectList();

		// values loaded into array set for store
		$row->id 				= NULL;
		$row->sectionid 		= $newsect;
		$row->catid 			= $newcat;
		$row->hits 				= '0';
		$row->ordering			= '0';
		$row->title 			= $item[0]->title;
		$row->title_alias 		= $item[0]->title_alias;
		$row->introtext 		= $item[0]->introtext;
		$row->fulltext 			= $item[0]->fulltext;
		$row->state 			= $item[0]->state;
		$row->mask 				= $item[0]->mask;
		$row->created 			= $item[0]->created;
		$row->created_by 		= $item[0]->created_by;
		$row->created_by_alias 	= $item[0]->created_by_alias;
		$row->modified 			= $item[0]->modified;
		$row->modified_by 		= $item[0]->modified_by;
		$row->checked_out 		= $item[0]->checked_out;
		$row->checked_out_time 	= $item[0]->checked_out_time;
		$row->images 			= $item[0]->images;
		$row->attribs 			= $item[0]->attribs;
		$row->version 			= $item[0]->parentid;
		$row->parentid 			= $item[0]->parentid;
		$row->metakey 			= $item[0]->metakey;
		$row->metadesc 			= $item[0]->metadesc;
		$row->access 			= $item[0]->access;

		if (!$row->check()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		$row->updateOrder( "catid='". $row->catid ."' AND state >= 0" );
	}

	$msg = $total .' '. $adminLanguage->A_COMP_CONTENT_COPIED .': '. $section .', '. $adminLanguage->A_COMP_CATEG .': '. $category;
	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $sectionid .'&mosmsg='. $msg );
}

/**
* Function to reset Hit count of a content item
* PT
*/
function resethits( $redirect, $id ) {
	global $database, $adminLanguage;

	$row = new mosContent($database);
	$row->Load($id);
	$row->hits = "0";
	$row->store();
	$row->checkin();

	$msg = $adminLanguage->A_COMP_CONTENT_RESET_HIT_COUNT;
	mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $id, $msg );
}

/**
* @param integer The id of the content item
* @param integer The new access level
* @param string The URL option
*/
function accessMenu( $uid, $access, $option ) {
	global $database;

	$row = new mosContent( $database );
	$row->load( $uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}

	$redirect = mosGetParam( $_POST, 'redirect', $row->sectionid );

	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $redirect );
}

function filterCategory( $query, $active=NULL ) {
	global $database;

	$categories[] = mosHTML::makeOption( '0', _SEL_CATEGORY );
	$database->setQuery( $query );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$category = mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $active );

	return $category;
}

function menuLink( $redirect, $id ) {
	global $database, $adminLanguage;

	$menu = mosGetParam( $_POST, 'menuselect', '' );
	$link = mosGetParam( $_POST, 'link_name', '' );

	$row = new mosMenu( $database );
	$row->menutype 		= $menu;
	$row->name 			= $link;
	$row->type 			= 'content_item_link';
	$row->published		= 1;
	$row->componentid	= $id;
	$row->link			= 'index.php?option=com_content&task=view&id='. $id;
	$row->ordering		= 9999;

	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
	$row->updateOrder( "menutype='$row->menutype' AND parent='$row->parent'" );

	$msg = $link .' '. $adminLanguage->A_COMP_CONTENT_IN_MENU .': '. $menu .' '. $adminLanguage->A_COMP_CONTENT_SUCCESS;
	mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $id, $msg );
}

function go2menu() {
	$menu = mosGetParam( $_POST, 'menu', 'mainmenu' );

	mosRedirect( 'index2.php?option=com_menus&menutype='. $menu );
}

function go2menuitem() {
	$menu 	= mosGetParam( $_POST, 'menu', 'mainmenu' );
	$id		= mosGetParam( $_POST, 'menuid', 0 );

	mosRedirect( 'index2.php?option=com_menus&menutype='. $menu .'&task=edit&hidemainmenu=1&id='. $id );
}

function saveOrder( &$cid ) {
	global $database, $adminLanguage;

	$total		= count( $cid );
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$redirect 	= mosGetParam( $_POST, 'redirect', 0 );
	$rettask	= mosGetParam( $_POST, 'returntask', '' );
	$row 		= new mosContent( $database );
	$conditions = array();

	// update ordering values
	for( $i=0; $i < $total; $i++ ) {
		$row->load( $cid[$i] );
		if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
			if (!$row->store()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			} // if
			// remember to updateOrder this group
			$condition = "catid='$row->catid' AND state>=0";
			$found = false;
			foreach ( $conditions as $cond )
				if ($cond[1]==$condition) {
					$found = true;
					break;
				} // if
			if (!$found) $conditions[] = array($row->id, $condition);
		} // if
	} // for

	// execute updateOrder for each group
	foreach ( $conditions as $cond ) {
		$row->load( $cond[0] );
		$row->updateOrder( $cond[1] );
	} // foreach

	$msg 	= $adminLanguage->A_COMP_ORDER_SAVED;
	mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect, $msg );
} // saveOrder
?>

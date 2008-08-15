<?php /* mysplitcssmenu.php based on mod_mainmenu.class.php,v 1.13 */
/**
* recoded by Konlong
* produces two variable strings in unordered list format
*		$mycssONLY_SUB_menu  == just the sub-menu items
*		$mycssONLY_PRI_menu  == just the top level items of the menu
*
* This file sould be placed in your templates own directory
* & the following should be at the top of your index.php
*
* NOTE: replace 'XXXXXX' with the name of your template
*
* <?php
* defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
* include($mosConfig_absolute_path."/templates/XXXXXX/mysplitcssmenu.php");
* ?>
*
**/

/* $Id: mod_mainmenu.class.php,v 1.13 2004/01/13 20:36:55 ronbakker Exp $ */
/**
* Menu handling functions
* @package Mambo Open Source
* @Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.13 $
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if (defined( '_VALID_MYSPLITCSSMENU' )) return;

/**
* Menu List
*/
	global $database, $my, $cur_template, $Itemid;
	global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_shownoauth;
	
	$menutype = @$params->menutype ? $params->menutype : 'mainmenu';
  $class_sfx = @$params->class_suffix ? $params->class_suffix : '';

	$mycssSSPLITmenu_content = '';
	$mycssPSPLITmenu_content = '';
	$mycssPATHmenu_content = "";
	/* If a user has signed in, get their user type */
	$intUserType = 0;
	if($my->gid){
		switch ($my->usertype)
		{
			case 'Super Administrator':
			$intUserType = 0;
			break;
			case 'Administrator':
			$intUserType = 1;
			break;
			case 'Editor':
			$intUserType = 2;
			break;
			case 'Registered':
			$intUserType = 3;
			break;
			case 'Author':
			$intUserType = 4;
			break;
			case 'Publisher':
			$intUserType = 5;
			break;
			case 'Manager':
			$intUserType = 6;
			break;
		}
	}
	else
	{
		/* user isn't logged in so make their usertype 0 */
		$intUserType = 0;
	}
	
	if ($mosConfig_shownoauth) {
		$sql = "SELECT m.* FROM #__menu AS m"
		. "\nWHERE menutype='$menutype' AND published='1'"
		//. "\nAND utaccess >= '$intUserType' "
		. "\nORDER BY parent,ordering";
	} else {
		$sql = "SELECT m.* FROM #__menu AS m"
		. "\nWHERE menutype='$menutype' AND published='1' AND access <= '$my->gid'"
		//. "\nAND utaccess >= '$intUserType' "
		. "\nORDER BY parent,ordering";
	}
	$database->setQuery( $sql	);
	
	$rows = $database->loadObjectList( 'id' );
	echo $database->getErrorMsg();
	
	// establish the hierarchy of the menu
	$children = array();
	// first pass - collect children
	foreach ($rows as $v ) {
		$pt = $v->parent;
		$list = @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
		$children[$pt] = $list;
	}
	
	// second pass - collect 'open' menus
	$open = array( $Itemid );
	$count = 20; // maximum levels - to prevent runaway loop
	$x_id = $Itemid;
	while (--$count) {
		if (isset($rows[$x_id]) && $rows[$x_id]->parent > 0) {
			$x_id = $rows[$x_id]->parent;
			$open[] = $x_id;
		} else {
			break;
		}
	}
	cssSPLITRecurseMenu( 0, 0, $children, $open, $class_sfx, $mycssSSPLITmenu_content, $mycssPSPLITmenu_content, $mycssPATHmenu_content );
	


$mycssONLY_SUB_menu = $mycssSSPLITmenu_content;
$mycssONLY_PRI_menu = $mycssPSPLITmenu_content;
$mycssSSPLITmenu_content = "\n".'<div id="subnavcontainer">'. $mycssONLY_SUB_menu  . "\n</div>\n";
$mycssPSPLITmenu_content = "\n".'<div id="navcontainer">' .   $mycssONLY_PRI_menu  . "\n</div>\n";
$mycssPATHmenu_content = substr($mycssPATHmenu_content,0,strlen($mycssPATHmenu_content)-4);

define( '_VALID_MYSPLITCSSMENU', true );
/**
* Utility function to recursively work through a hierarchial menu
*/
function cssSPLITRecurseMenu( $p_id, $level, &$children, &$open, $class_sfx, &$navVIR_cont, &$navHOR_cont, &$navPATH_cont) {
	global $Itemid;
	if (@$children[$p_id]) {
		
    if ($level)
		{
			$navVIR_cont .= "\n".'';
		} else
		{
			$navHOR_cont .= "\n".'<table align="left" class="moduletable-topnav" cellpadding="0" cellspacing="0" ><tr><td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td nowrap="nowrap" valign="bottom">';
		}
		foreach ($children[$p_id] as $row) {
			
			$hidclass = '';
			$vidclass = 'id="submenu"';
			
			if (!$level)
			{
				$navHOR_cont .= "\n";
			} else
			{
				$navVIR_cont .= "\n";
			}
			if ($Itemid == $row->id)
			{
				if ($level)
				{
					$navVIR_cont .= '';
					$vidclass = 'id="subcurrent"';
				} else
				{
					$navHOR_cont .= '';
					$hidclass = 'id="current"';
				}
			} else
			{
				if ($level)
				{
					$navVIR_cont .= ' ';
				}
			}
			if (!$level)
			{
				$navHOR_cont .= "";
			} else
			{
				$navVIR_cont .= '';
			}
//			$nav_cont .= (in_array( $row->id, $open ) ? '-X-': ''); //testing code
			if (in_array( $row->id, $open ))
			{
				$navPATH_cont .= $row->name . ' :: ';
				
			}
			if (!$level)
			{
				$navLink = cssSPLITGetMenuLink( $row, $level, $class_sfx, $hidclass);
				$navHOR_cont .= $navLink.'';
			} else
			{
				$navLink = cssSPLITGetMenuLink( $row, $level, $class_sfx, $vidclass);
				$navVIR_cont .= $navLink.'';
			}
			
			if (in_array( $row->id, $open )) {
				cssSPLITRecurseMenu( $row->id, $level+1, $children, $open, $class_sfx, $navVIR_cont, $navHOR_cont, $navPATH_cont);
			}
		}
		if (!$level)
		{
			$navHOR_cont .= "\n</td></tr></table></td></tr></table>";
		} else
		{
			$navVIR_cont .= "\n";
		}
	}
}

/**
* Utility function for writing a menu link
*/
function cssSPLITGetMenuLink( $mitem, $level=0, $class_sfx='', $idclass='') {
	global $Itemid, $mosConfig_live_site;
	$txt = '';
	
	switch ($mitem->type) {
		case 'separator';
		// do nothing
		break;
		
		case 'url':
		if (eregi( "index.php\?", $mitem->link )) {
			//$mitem->link .= "&Returnid=$Itemid";
			if (!eregi( "Itemid=", $mitem->link )) {
				$mitem->link .= "&Itemid=$mitem->id";
			}
		}
		break;
		
		default:
		$mitem->link .= "&Itemid=$mitem->id";
		break;
	}
	//$mitem->link .= "&ytw=ytw_splitmenu";
	
	$mitem->link = str_replace( '&', '&amp;', $mitem->link );
	
	if (strcasecmp(substr($mitem->link,0,4),"http")) {
		$mitem->link = sefRelToAbs($mitem->link);
	}
	
	$menuclass = "mainlevel$class_sfx";
	if ($level > 0) {
		$menuclass = "sublevel$class_sfx";
	}
	$menuclass = "topnav";
	switch ($mitem->browserNav) {
		// cases are slightly different
		case 1:
		// open in a new window
		$txt = "<a href=\"$mitem->link\" target=\"_window\" class=\"$menuclass\" $idclass>$mitem->name</a>";
		break;
		
		case 2:
		// open in a popup window
		$txt = "<a href=\"#\" onClick=\"javascript: window.open('$mitem->link', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\" $idclass>$mitem->name</a>";
		break;
		
		case 3:
		// don't link it
		$txt = "<span class=\"$menuclass\" $idclass>$mitem->name</span>";
		break;
		
		default:	// formerly case 2
		// open in parent window
		$txt = "<a href=\"$mitem->link\" class=\"$menuclass\" $idclass>$mitem->name</a>";
		break;
	}
	
	return $txt;
}
?>

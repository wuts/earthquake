<?php
/**
* @version $Id: sef.php,v 1.0 2008-04-18 15:33:20 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2008 mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software
*/

/*
index.php?option=com_contact&Itemid=3
index.php?option=com_contact&catid=12&Itemid=3
index.php?option=com_contact&task=view&contact_id=1&Itemid=3
index.php?option=com_contact&task=view&catid=12&contact_id=1&Itemid=3
*/

/**
 * @param	array reference: urlVars
 * @return	string (/)catname/contactid.html
 */
function contactBuildPath( $url, &$urlVars )
{
	global $Itemid, $menuIdVars, $menuPathVars;
	global $catIdVars, $catPathVars;
	global $htmlsuffix, $dirsuffix;
	
	$aItemid = (isset($urlVars['Itemid']) && $urlVars['Itemid']) ? $urlVars['Itemid'] : $Itemid;
	$aTask = isset($urlVars['task']) ? $urlVars['task'] : 'notask';
	if (!isset($menuIdVars[$aItemid]) || $menuIdVars[$aItemid]->componentname != 'com_contact')
		return $url;
	
	$string = $url;
	switch ($menuIdVars[$aItemid]->type) {
		case 'components':
			switch ($aTask) {
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['contact_id'];
					if (isset($urlVars['catid']) && $urlVars['catid']) {
						$catid = $urlVars['catid'];
						$string .= $catIdVars[$catid]->path;
					}
					$string .= $id . $htmlsuffix;
					break;
				
				case 'notask':
					$string = $menuIdVars[$aItemid]->path;
					if (isset($urlVars['catid']) && $urlVars['catid']) {
						$catid = $urlVars['catid'];
						$string .= $catIdVars[$catid]->path;
					}
					break;
					
				default:
					break;
			}
			break;
				
		case 'contact_category_table':
			$catid_orig = $menuIdVars[$aItemid]->componentid;
			switch ($aTask) {
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['contact_id'];
					if (isset($urlVars['catid']) && $urlVars['catid'] && ($urlVars['catid'] != $catid_orig)) {
						$catid = $urlVars['catid'];
						$string .= $catIdVars[$catid]->path;
					}
					$string .= $id . $htmlsuffix;
					break;
				
				case 'notask':
					$string = $menuIdVars[$aItemid]->path;
					if (isset($urlVars['catid']) && $urlVars['catid'] && ($urlVars['catid'] != $catid_orig)) {
						$catid = $urlVars['catid'];
						$string .= $catIdVars[$catid]->path;
					}
					break;
					
				default:
					break;
			}
			break;
			
		case 'contact_item_link':
			$contact_id_orig = $menuIdVars[$aItemid]->componentid;
			switch ($aTask) {
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['contact_id'];
					if ($contact_id_orig != $id) {
						if (isset($urlVars['catid']) && $urlVars['catid'] && ($urlVars['catid'] != $catid_orig)) {
							$catid = $urlVars['catid'];
							$string .= $catIdVars[$catid]->path;
						}
						$string .= $id . $htmlsuffix;
					}
					break;
				
				case 'notask':
					$string = $menuIdVars[$aItemid]->path;
					if (isset($urlVars['catid']) && $urlVars['catid']) {
						$catid = $urlVars['catid'];
						$string .= $catIdVars[$catid]->path;
					}
					break;
					
				default:
					break;
			}
			break;
	
		default:
			break;
	}
	
	
	return $string;
}

/**
 * @param	int	A menu item id
 * @param	string	the remained path string after get rid of the menu path
 * @param	array reference: extraVars
 * @return	bool
 *
 * path Formats: (/)catname/contactid.html
 */
function contactParsePath( $aItemid, $matchedURI, $path, &$queryVars )
{
	global $mosConfig_live_site;
	global $menuIdVars, $secPathVars, $catIdVars, $catPathVars;
	global $curPathway, $pathwaySeperator;
	
	switch ($menuIdVars[$aItemid]->type) {
		case 'components':
		case 'contact_category_table':
		case 'contact_item_link':
			// path format: 
			// 1. menuitempath/categorypath/
			// 2. menuitempath/(categorypath/)$contentid.html
			
			if (preg_match("/^\/([^\/\f\n\r]+\/)?(\d+)\.html/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = 'view';
				
				$catPath = $matches[1];
				if ($catPath) {
					$queryVars['catid'] = $catPathVars[$queryVars['option']][$catPath]->id;
				}
				$queryVars['contact_id'] = $matches[2];
				$queryVars['Itemid'] = $aItemid;
				return true;
			}

			if (preg_match("/^\/([^\/\f\n\r]+\/)/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$catPath = $matches[1];
				$queryVars['catid'] = $catPathVars[$queryVars['option']][$catPath]->id;
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			break;

		default:
			break;
	}
	
	return false;
}
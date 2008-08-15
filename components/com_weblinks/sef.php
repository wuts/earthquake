<?php
/**
* @version $Id: sef.php,v 1.0 2008-04-20 1:23:20 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2008 mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software
*/

/*
index.php?option=com_weblinks&Itemid=23
index.php?option=com_weblinks&catid=21&Itemid=23
index.php?option=com_weblinks&task=view&catid=21&id=12&Itemid=23
*/

/**
 * @param	array reference: urlVars
 * @return	string (/)catname/id.html
 */
function weblinksBuildPath( $url, &$urlVars )
{
	global $Itemid, $menuIdVars, $menuPathVars;
	global $catIdVars, $catPathVars;
	global $htmlsuffix, $dirsuffix;
	
	$aItemid = (isset($urlVars['Itemid']) && $urlVars['Itemid']) ? $urlVars['Itemid'] : $Itemid;
	$aTask = isset($urlVars['task']) ? $urlVars['task'] : 'notask';
	if (!isset($menuIdVars[$aItemid]) || $menuIdVars[$aItemid]->componentname != 'com_weblinks')
		return $url;
	
	$string = $url;
	switch ($menuIdVars[$aItemid]->type) {
		case 'components':
			switch ($aTask) {
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['id'];
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
				
		case 'weblink_category_table':
			$catid_orig = $menuIdVars[$aItemid]->componentid;
			switch ($aTask) {
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['id'];
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
 * path Formats: (/)catname/id.html
 */
function weblinksParsePath( $aItemid, $matchedURI, $path, &$queryVars )
{
	global $mosConfig_live_site;
	global $menuIdVars, $secPathVars, $catIdVars, $catPathVars;
	global $curPathway, $pathwaySeperator;
	
	switch ($menuIdVars[$aItemid]->type) {
		case 'components':
		case 'weblink_category_table':
			// path format: 
			// 1. menuitempath/categorypath/
			// 2. menuitempath/(categorypath/)$id.html
			
			if (preg_match("/^\/([^\/\f\n\r]+\/)?(\d+)\.html/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = 'view';
				
				$catPath = $matches[1];
				if ($catPath) {
					$queryVars['catid'] = $catPathVars[$queryVars['option']][$catPath]->id;
				}
				$queryVars['id'] = $matches[2];
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
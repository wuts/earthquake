<?php
/**
* @version $Id: sef.php,v 1.0 2008-02-28 22:34:20 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2008 mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software
*/

/**
 * @param	array reference: urlVars
 * @return	string
 */
function contentBuildPath( $url, &$urlVars )
{
	global $Itemid, $menuIdVars, $menuPathVars;
	global $secIdVars, $secPathVars, $catIdVars, $catPathVars;
	global $htmlsuffix, $dirsuffix;
	
	$aItemid = isset($urlVars['Itemid']) && !empty($urlVars['Itemid']) ? $urlVars['Itemid'] : $Itemid;
	$aTask = $urlVars['task'];
	if (!isset($menuIdVars[$aItemid]) || $menuIdVars[$aItemid]->componentname != 'com_content')
		return $url;
	
	//allowed task: 'view' 'wrapper' 'section' 'category' 'blogsection' 'blogcategory'
	$string = $url;
	switch ($menuIdVars[$aItemid]->type) {
		case 'content_blog_section':
		case 'content_section':
			switch ($aTask) {
				case 'blogsection':
				case 'section':
					$string = $menuIdVars[$aItemid]->path;
					if (isset($urlVars['limitstart']) && !empty($urlVars['limitstart'])) {
						$string .= 'limitstart_' . $urlVars['limitstart'] . $dirsuffix;
					}
					if (isset($urlVars['begindate']) && !empty($urlVars['begindate'])
					   && isset($urlVars['enddate']) && !empty($urlVars['enddate'])) {
						$string .= 'begindate' . $urlVars['begindate'] . $dirsuffix . 'enddate' . $urlVars['enddate'] . $dirsuffix;
					}
					break;
					
				case 'blogcategory':
				case 'category':
					$string = $menuIdVars[$aItemid]->path;
					$catid = $urlVars['id'];
					$string .= $catIdVars[$catid]->path;
					if (isset($urlVars['limitstart']) && !empty($urlVars['limitstart'])) {
						$string .= 'limitstart_' . $urlVars['limitstart'] . $dirsuffix;
					}
					if (isset($urlVars['begindate']) && !empty($urlVars['begindate'])
					   && isset($urlVars['enddate']) && !empty($urlVars['enddate'])) {
						$string .= 'begindate' . $urlVars['begindate'] . $dirsuffix . 'enddate' . $urlVars['enddate'] . $dirsuffix;
					}
					break;
					
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['id'];
					if (isset($urlVars['catid']) && !empty($urlVars['catid'])) {
						$catid = $urlVars['catid'];
						$string .= $catIdVars[$catid]->path;
					}
					$string .= $id . $htmlsuffix;
					if (isset($urlVars['limitstart']) && !empty($urlVars['limitstart'])) {
						$string .= $dirsuffix . 'limitstart_' . $urlVars['limitstart'] . $dirsuffix;
					}
					break;
				
				case 'wrapper':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['id'];
					if (isset($urlVars['catid']) && !empty($urlVars['catid'])) {
						$catid = $urlVars['catid'];
						$string .= $catIdVars[$catid]->path;
					}
					$string .= 'wrapper_' . $id . $htmlsuffix;
					break;
					
				default:
					break;
			}
			break;
				
		case 'content_blog_category':
		case 'content_category':
			switch ($aTask) {
				case 'blogcategory':
				case 'category':
					$string = $menuIdVars[$aItemid]->path;
					if (isset($urlVars['limitstart']) && !empty($urlVars['limitstart'])) {
						$string .= 'limitstart_' . $urlVars['limitstart'] . $dirsuffix;
					}
					if (isset($urlVars['begindate']) && !empty($urlVars['begindate'])
					   && isset($urlVars['enddate']) && !empty($urlVars['enddate'])) {
						$string .= 'begindate' . $urlVars['begindate'] . $dirsuffix . 'enddate' . $urlVars['enddate'] . $dirsuffix;
					}
					break;
					
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['id'];
					$string .= $id . $htmlsuffix;
					if (isset($urlVars['limitstart']) && !empty($urlVars['limitstart'])) {
						$string .= $dirsuffix . 'limitstart_' . $urlVars['limitstart'] . $dirsuffix;
					}
					break;
				
				case 'wrapper':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['id'];
					$string .= 'wrapper_' . $id . $htmlsuffix;
					break;
					
				default:
					break;
			}
			break;
			
		case 'content_item_link':
		case 'content_typed':
			switch ($aTask) {
				case 'view':
					$string = $menuIdVars[$aItemid]->path;
					if (isset($urlVars['limitstart']) && !empty($urlVars['limitstart'])) {
						$string .= $dirsuffix . 'limitstart_' . $urlVars['limitstart'] . $dirsuffix;
					}
					break;
				
				case 'wrapper':
					$string = $menuIdVars[$aItemid]->path;
					$id = $urlVars['id'];
					$string .= 'wrapper_' . $id . $htmlsuffix;
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
 * path Formats: (/)limitstart_number
 */
function contentParsePath( $aItemid, $matchedURI, $path, &$queryVars )
{
	global $mosConfig_live_site;
	global $menuIdVars, $secPathVars, $catIdVars, $catPathVars;
	global $curPathway, $pathwaySeperator;
	
	switch ($menuIdVars[$aItemid]->type) {
		case 'content_blog_section':
		case 'content_section':
			// path format: 
			// 1. menuitempath/limitstart_$limitstart/(begindate$begindate/enddate$enddate/)
			// 2. menuitempath/(categorypath/)$contentid.html(/limitstart_$limitstart/)
			// 3. menuitempath/(categorypath/)wrapper_$contentid.html
			// 4. menuitempath/categorypath/(limitstart_$limitstart/)(begindate$begindate/enddate$enddate/)
			$sectionid = $menuIdVars[$aItemid]->linkvars['id'];
			if (preg_match("/^\/limitstart_(\d+)\/(begindate(\d{4}-\d{2}-\d{2})\/enddate(\d{4}-\d{2}-\d{2})\/)?/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = $menuIdVars[$aItemid]->linkvars['task'];
				$queryVars['id'] = $sectionid;
				$queryVars['limitstart'] = $matches[1];
				if (isset($matches[3]) && isset($matches[4])) {
					$queryVars['begindate'] = $matches[3];
					$queryVars['enddate'] = $matches[4];
				}
				$queryVars['Itemid'] = $aItemid;
				$curPathway = getMenuPathway($aItemid, true) . $pathwaySeperator . 'limitstart ' . $matches[1];
				return true;
			}
			
			if (preg_match("/^\/([^\/\f\n\r]+\/)?(\d+)\.html(\/limitstart_(\d+)\/)?/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = 'view';
				$queryVars['sectionid'] = $sectionid;
				
				$mcount = count($matches);
				switch ($mcount) {
					case 2:
					case 4:
						$queryVars['id'] = $matches[1];
						if ($mcount == 4) {
							$queryVars['limitstart'] = $matches[3];
						}
						break;
					case 3:
					case 5:
						$catPath = $matches[1];
						$queryVars['catid'] = $catPathVars[$sectionid][$catPath]->id;
						$queryVars['id'] = $matches[2];
						if ($mcount == 5) {
							$queryVars['limitstart'] = $matches[4];
						}
						break;
					default:
						return false;
						break;
				}
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			if (preg_match("/^\/([^\/\f\n\r]+\/)?wrapper_(\d+)\.html/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = 'wrapper';
				$queryVars['sectionid'] = $sectionid;
				
				$mcount = count($matches);
				switch ($mcount) {
					case 2:
						$queryVars['id'] = $matches[1];
						break;
					case 3:
						$catPath = $matches[1];
						$queryVars['catid'] = $catPathVars[$sectionid][$catPath]->id;
						$queryVars['id'] = $matches[2];
						break;
					default:
						return false;
						break;
				}
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			if (preg_match("/^\/([^\/\f\n\r]+\/)(limitstart_(\d+)\/)?(begindate(\d{4}-\d{2}-\d{2})\/enddate(\d{4}-\d{2}-\d{2})\/)?/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = str_replace('section', 'category', $menuIdVars[$aItemid]->linkvars['task']);
				$queryVars['sectionid'] = $sectionid;
				$catPath = $matches[1];
				$queryVars['id'] = $catPathVars[$sectionid][$catPath]->id;
				$mcount = count($matches);
				switch ($mcount) {
					case 4:
						$queryVars['limitstart'] = $matches[3];
						break;
					case 5:
						$queryVars['begindate'] = $matches[3];
						$queryVars['enddate'] = $matches[4];
						break;
					case 7:
						$queryVars['limitstart'] = $matches[3];
						$queryVars['begindate'] = $matches[5];
						$queryVars['enddate'] = $matches[6];
						break;
					default:
						break;
				}
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			break;

		case 'content_blog_category':
		case 'content_category':
			// path format: 
			// 1. menuitempath/limitstart_$limitstart/(begindate$begindate/enddate$enddate/)
			// 2. menuitempath/$contentid.html(/limitstart_$limitstart/)
			// 3. menuitempath/wrapper_$contentid.html
			$catid = $menuIdVars[$aItemid]->linkvars['id'];
			$sectionid = $catIdVars[$catid]->section;
			if (preg_match("/^\/limitstart_(\d+)\/(begindate(\d{4}-\d{2}-\d{2})\/enddate(\d{4}-\d{2}-\d{2})\/)?/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = $menuIdVars[$aItemid]->linkvars['task'];
				$queryVars['sectionid'] = $sectionid;
				$queryVars['id'] = $catid;
				$queryVars['limitstart'] = $matches[1];
				if (isset($matches[3]) && isset($matches[4])) {
					$queryVars['begindate'] = $matches[3];
					$queryVars['enddate'] = $matches[4];
				}
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			if (preg_match("/^\/(\d+)\.html(\/limitstart_(\d+)\/)?/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = 'view';
				$queryVars['sectionid'] = $sectionid;
				$queryVars['catid'] = $catid;
				$queryVars['id'] = $matches[1];
				if (isset($matches[3])) {
					$queryVars['limitstart'] = $matches[3];
				}
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			if (preg_match("/^\/wrapper_(\d+)\.html/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = 'wrapper';
				$queryVars['sectionid'] = $sectionid;
				$queryVars['catid'] = $catid;
				$queryVars['id'] = $matches[1];
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			break;
			
		case 'content_item_link':
		case 'content_typed':
			// path format: 
			// 1. menuitempath/limitstart_$limitstart/
			// 3. menuitempath/wrapper_$contentid.html
			if (isset($menuIdVars[$aItemid]->linkvars['sectionid'])) {
				$sectionid = $menuIdVars[$aItemid]->linkvars['sectionid'];
			}
			if (isset($menuIdVars[$aItemid]->linkvars['catid'])) {
				$catid = $menuIdVars[$aItemid]->linkvars['catid'];
			}
			$id = $menuIdVars[$aItemid]->linkvars['id'];
			if (preg_match("/^\/limitstart_(\d+)\//i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = $menuIdVars[$aItemid]->linkvars['task'];
				if (isset($sectionid))	$queryVars['sectionid'] = $sectionid;
				if (isset($catid))	$queryVars['catid'] = $catid;
				$queryVars['id'] = $id;
				$queryVars['limitstart'] = $matches[1];
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			if (preg_match("/^\/wrapper_(\d+)\.html/i", $path, $matches)) {
				$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
				$queryVars['task'] = 'wrapper';
				if (isset($sectionid))	$queryVars['sectionid'] = $sectionid;
				if (isset($catid))	$queryVars['catid'] = $catid;
				$queryVars['id'] = $id;
				$queryVars['Itemid'] = $aItemid;
				return true;
			}
			
			break;
			
		default:
			break;
	}
	
	return false;
}
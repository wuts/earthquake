<?php
/**
* @version $Id: sef.php,v 1.0 2008-01-29 11:57:20 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2008 mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software
*/

/**
 * @param	array reference: urlVars
 * @return	string
 */
function frontpageBuildPath( $url, &$urlVars )
{
	$string = '';

	if (isset($urlVars['limitstart']) && !empty($urlVars['limitstart'])) {
		$string = '/limitstart_' . $urlVars['limitstart'] . '/';
	}

	return $string;
}

/**
 * @param	int	A menu item id
 * @param	string	A path string
 * @param	array reference: extraVars
 * @return	bool
 *
 * path Formats: (/)limitstart_number
 */
function frontpageParsePath( $aItemid, $matchedURI, $path, &$queryVars )
{
	global $menuIdVars, $curPathway, $pathwaySeperator;
	$result = false;
	if (preg_match("/^\/limitstart_(\d+)/i", $path, $matches)) {
		$queryVars['option'] = $menuIdVars[$aItemid]->linkvars['option'];
		$queryVars['limitstart'] = $matches[1];
		$queryVars['Itemid'] = $aItemid;
		$result = true;
		$curPathway = getMenuPathway($aItemid, true) . $pathwaySeperator . 'limitstart ' . $matches[1];
	}
	return $result;
}
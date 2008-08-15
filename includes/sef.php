<?php
/**
* @version $Id: sef.php,v 3.2  2008-04-14
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2008 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if ($mosConfig_sef) {
	global $curPathway;
	$sessionid = '';
	$fullURI = str_replace('//', '/', $_SERVER['REQUEST_URI']);
	$live_site_section = parse_url($mosConfig_live_site.'/');
	$reletivePath = isset($live_site_section['path']) ? $live_site_section['path'] : '/';
	$reletivePath = str_replace('//', '/', $reletivePath);
	if ($reletivePath && $reletivePath != '/') {
		$fullURI = '/' . substr($fullURI, strlen($reletivePath));
		//$fullURI = str_replace('//', '/', $fullURI);
	}
	$matchedURI = $fullURI;
	while (true) {
		$menuitem = getMenuItemByPath($matchedURI);
		if ( (isset($menuitem) && $menuitem) || ($matchedURI == '/') ) {
			break;
		}
		$matchedURI = substr($matchedURI, 0, strlen($matchedURI) - 1);
		$bpos = strrpos($matchedURI, '/');
		if ($bpos === false) {
			$matchedURI = '/';
		}
		else {
			$matchedURI = substr($matchedURI, 0, $bpos) . '/';
		}
	}

	// match menuitem
	if ($matchedURI == $fullURI) {
		foreach ($menuitem->linkvars as $key => $value) {
			$_GET[$key] = $value;
			$_REQUEST[$key] = $value;
		}
		$Itemid = $menuitem->id;
		$_GET['Itemid'] = $menuitem->id;
		$_REQUEST['Itemid'] = $menuitem->id;
		$QUERY_STRING = substr($menuitem->link, 10); // remove index.php?
		$QUERY_STRING .= "&Itemid=$Itemid";
		$_SERVER['QUERY_STRING'] = $QUERY_STRING;
		$_SERVER['REQUEST_URI'] = $reletivePath . "index.php?$QUERY_STRING";
		$curPathway = getMenuPathway($Itemid);
	}
	else {
		$URIremains = '/' . substr($fullURI, strlen($matchedURI));
		//$URIremains = str_replace('//', '/', $URIremains);
		$comName = $menuitem->componentname;
		$comFuncName = substr($comName,4) . 'ParsePath';
		$comSefFilename = $mosConfig_absolute_path . "/components/$comName/sef.php";
		if (file_exists($comSefFilename)) {
			require_once($comSefFilename);
		}
		$queryVars = array();
		if (function_exists($comFuncName) && $comFuncName($menuitem->id, $matchedURI, $URIremains, $queryVars)) {
			$QUERY_STRING = '';
			$ii = 0;
			foreach ($queryVars as $key => $value) {
				$_GET[$key] = $value;
				$_REQUEST[$key] = $value;
				if ($ii == 0) {
					$QUERY_STRING .= "$key=$value";
					$ii = 1;
				}
				else {
					$QUERY_STRING .= "&$key=$value";
				}
			}
			$Itemid = $menuitem->id;
			$_SERVER['QUERY_STRING'] = $QUERY_STRING;
			$_SERVER['REQUEST_URI'] = $reletivePath . "index.php?$QUERY_STRING";
		}
		else {
			/**
			* Content
			* http://www.domain.com/$option/$task/$sectionid/$id/$Itemid/$limit/$limitstart
			*/
			if ( eregi("/content/",$_SERVER['REQUEST_URI']) ) {
				$string = preg_replace("/(\S+)_(\w+).html$/", "\${1}/\${2}/", $_SERVER['REQUEST_URI']);
				
				if (preg_match("/(begindate)(\d{4}-\d{2}-\d{2})\/(enddate)(\d{4}-\d{2}-\d{2})\//i", $string, $matches)) {
					$string = str_replace($matches[0], '', $string);
					$begindate = $matches[2];
					$enddate = $matches[4];
					$_GET['begindate'] = $begindate;
					$_REQUEST['begindate'] = $begindate;
					$_GET['enddate'] = $enddate;
					$_REQUEST['enddate'] = $enddate;
				}
				
				$url_array = explode("/", $string);
				if (in_array("sid", $url_array)){
					$uri = explode("sid/", $string);
					$uri = explode("/", $uri[1]);
					$sessionid = $uri[0];
				}
				while (in_array("sid", $url_array)){
					array_pop ($url_array);
				}
				$uri = explode("content/", $_SERVER['REQUEST_URI']);
				$option = "com_content";
				$_GET['option'] = $option;
				$_REQUEST['option'] = $option;
				$pos = array_search ("content", $url_array);
		
				// language hook for content
				$lang = "";
				foreach($url_array as $key=>$value) {
					if ( !strcasecmp(substr($value,0,5),"lang,") ) {
						$temp = explode(",", $value);
						if (isset($temp[0]) && $temp[0]!="" && isset($temp[1]) && $temp[1]!="") {
							$_GET['lang'] = $temp[1];
							$_REQUEST['lang'] = $temp[1];
							$lang = $temp[1];
						}
						unset($url_array[$key]);
					}
				}
		
				// $option/$task/$sectionid/$id/$Itemid/$limit/$limitstart
				if (isset($url_array[$pos+6]) && $url_array[$pos+6]!="") {
					$task = $url_array[$pos+1];
					$sectionid = $url_array[$pos+2];
					$id = $url_array[$pos+3];
					$Itemid = $url_array[$pos+4];
					$limit = $url_array[$pos+5];
					$limitstart = $url_array[$pos+6];
					$_GET['task'] = $task;
					$_REQUEST['task'] = $task;
					$_GET['sectionid'] = $sectionid;
					$_REQUEST['sectionid'] = $sectionid;
					$_GET['id'] = $id;
					$_REQUEST['id'] = $id;
					$_GET['Itemid'] = $Itemid;
					$_REQUEST['Itemid'] = $Itemid;
					$_GET['limit'] = $limit;
					$_REQUEST['limit'] = $limit;
					$_GET['limitstart'] = $limitstart;
					$_REQUEST['limitstart'] = $limitstart;
					$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart";
					// $option/$task/$id/$Itemid/$limit/$limitstart
				} else if (isset($url_array[$pos+5]) && $url_array[$pos+5]!="") {
					$task = $url_array[$pos+1];
					$id = $url_array[$pos+2];
					$Itemid = $url_array[$pos+3];
					$limit = $url_array[$pos+4];
					$limitstart = $url_array[$pos+5];
					$_GET['task'] = $task;
					$_REQUEST['task'] = $task;
					$_GET['id'] = $id;
					$_REQUEST['id'] = $id;
					$_GET['Itemid'] = $Itemid;
					$_REQUEST['Itemid'] = $Itemid;
					$_GET['limit'] = $limit;
					$_REQUEST['limit'] = $limit;
					$_GET['limitstart'] = $limitstart;
					$_REQUEST['limitstart'] = $limitstart;
					$QUERY_STRING = "option=com_content&task=$task&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart";
					// $option/$task/$sectionid/$id/$Itemid
				} else if (!(isset($url_array[$pos+5]) && $url_array[$pos+5]!="") && isset($url_array[$pos+4]) && $url_array[$pos+4]!="") {
					$task = $url_array[$pos+1];
					$sectionid = $url_array[$pos+2];
					$id = $url_array[$pos+3];
					$Itemid = $url_array[$pos+4];
					$_GET['task'] = $task;
					$_REQUEST['task'] = $task;
					$_GET['sectionid'] = $sectionid;
					$_REQUEST['sectionid'] = $sectionid;
					$_GET['id'] = $id;
					$_REQUEST['id'] = $id;
					$_GET['Itemid'] = $Itemid;
					$_REQUEST['Itemid'] = $Itemid;
					$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid";
					// $option/$task/$id/$Itemid
				} else if (!(isset($url_array[$pos+4]) && $url_array[$pos+4]!="") && (isset($url_array[$pos+3]) && $url_array[$pos+3]!="")) {
					$task = $url_array[$pos+1];
					$id = $url_array[$pos+2];
					$Itemid = $url_array[$pos+3];
					$_GET['task'] = $task;
					$_REQUEST['task'] = $task;
					$_GET['id'] = $id;
					$_REQUEST['id'] = $id;
					$_GET['Itemid'] = $Itemid;
					$_REQUEST['Itemid'] = $Itemid;
					$QUERY_STRING = "option=com_content&task=$task&id=$id&Itemid=$Itemid";
					// $option/$task/$id
				} else if (!(isset($url_array[$pos+3]) && $url_array[$pos+3]!="") && (isset($url_array[$pos+2]) && $url_array[$pos+2]!="")) {
					$task = $url_array[$pos+1];
					$id = $url_array[$pos+2];
					$_GET['task'] = $task;
					$_REQUEST['task'] = $task;
					$_GET['id'] = $id;
					$_REQUEST['id'] = $id;
					$QUERY_STRING = "option=com_content&task=$task&id=$id";
					// $option/$task
				} else if (!(isset($url_array[$pos+2]) && $url_array[$pos+2]!="") && (isset($url_array[$pos+1]) && $url_array[$pos+1]!="")) {
					$task = $url_array[$pos+1];
					$_GET['task'] = $task;
					$_REQUEST['task'] = $task;
					$QUERY_STRING = "option=com_content&task=$task";
				}
		
				if ($lang!="") {
					$QUERY_STRING .= "&lang=$lang";
				}
				if ($sessionid) {
					$_GET['sid'] = $sessionid;
					$_REQUEST['sid'] = $sessionid;
					$QUERY_STRING .= "&sid=$sessionid";
				}
		
				$_SERVER['QUERY_STRING'] = $QUERY_STRING;
				$REQUEST_URI = $uri[0]."index.php?".$QUERY_STRING;
				$_SERVER['REQUEST_URI'] = $REQUEST_URI;
			}
		
			/*
			Components
			http://www.domain.com/option,component/$name,$value
			*/
			elseif ( eregi("/option,",$_SERVER['REQUEST_URI']) ) {
				$uri = explode("/option,", $_SERVER['REQUEST_URI']);
				$string = preg_replace("/(\S+)_(\w+)(.html)$/", "\${1},\${2}/", $uri[1]);
				$uri_array = explode("/", $string);
				$option = array_shift ($uri_array);
		
				$_GET['option'] = $option;
				$_REQUEST['option'] = $option;
				$QUERY_STRING = "option=$option";
		
				foreach($uri_array as $value) {
					$temp = explode(",", $value);
					if (isset($temp[0]) && $temp[0]!="" && isset($temp[1]) && $temp[1]!="") {
						$_GET[$temp[0]] = $temp[1];
						$_REQUEST[$temp[0]] = $temp[1];
						
						$QUERY_STRING .= "&$temp[0]=$temp[1]";
					}
				}
		
				$_SERVER['QUERY_STRING'] = $QUERY_STRING;
				$REQUEST_URI = $uri[0]."/index.php?".$QUERY_STRING;
				$_SERVER['REQUEST_URI'] = $REQUEST_URI;
			}
			else {
				$string = preg_replace("/(\S+)_(\w+).html$/", "\${1}/\${2}/", $_SERVER['REQUEST_URI']);
				if ( eregi("sid/",$string) ) {
					$uri = explode("sid/",$string);
					$uri1 = explode("/", $uri[1]);
					$sessionid = $uri1[0];
					$QUERY_STRING = "";
					if ($sessionid) {
						$_GET['sid'] = $sessionid;
						$_REQUEST['sid'] = $sessionid;
						$QUERY_STRING = "sid=$sessionid";
					}
					
					$_SERVER['QUERY_STRING'] = $QUERY_STRING;
					$REQUEST_URI = $uri[0]."index.php?".$QUERY_STRING;
					$_SERVER['REQUEST_URI'] = $REQUEST_URI;
				}
			}
		}
	}
	
	if ($mosConfig_register_globals) {
        // Extract to globals
        while(list($key,$value)=each($_GET)) {
            if (!isset($GLOBALS[$key])) $GLOBALS[$key]=$value;
        }
    }
}

function sefRelToAbs( $string ) {
	global $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_sef, $Itemid;
	global $menuIdVars;
	
	$string = trim($string);

	if ($mosConfig_sef && preg_match("/^index\.php/", $string)) {
		// Replace all &amp; with &
		$string = trim(str_replace( '&amp;', '&', $string ));
		
		$url = getMenuPathByURL($string);
		if ($url) {
			$string = $url;
		}
		else {
			$temps = explode("?", $string);
			if (isset($temps[1])) {
				parse_str($temps[1], $urlVars);
			}
			if (isset($urlVars['option']) && !empty($urlVars['option'])) {
				$comName = $urlVars['option'];
				$comFuncName = substr($comName,4) . 'BuildPath';
				$comSefFilename = $mosConfig_absolute_path . "/components/$comName/sef.php";
				if (file_exists($comSefFilename)) {
					require_once($comSefFilename);
				}
				if (function_exists($comFuncName)) {
					$string = $comFuncName($string, $urlVars);
				}
				else {
					$string = sefRelToAbs_orig ($string);
				}
			}
		}
		$string = '/' . $string;
		$string = $mosConfig_live_site . str_replace('//','/', $string);
	}
	return $string;
}

function sefRelToAbs_orig( $string ) {
	global $Itemid;
	
	// Home : index.php
	if ($string=="index.php") {
		$string="";
	}

	$sefstring = "";
	if ( eregi("option=com_frontpage",$string) ) {
		$url_array = explode("&", $string);
		if ( ( count($url_array) == 2 ) ){
			$string = "";
		}
	}

	if ( (eregi("option=com_content",$string) || eregi("option=content",$string) ) && !eregi("task=new",$string) && !eregi("task=edit",$string) ) {
		/*
		Content
		index.php?option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&begindate=$begindate&enddate=$enddate&limit=$limit&limitstart=$limitstart
		*/
		$sefstring .= "content/";
		if (eregi("&task=",$string)) {
			$temp = split("&task=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= $temp[0]."/";
		}
		if (eregi("&sectionid=",$string)) {
			$temp = split("&sectionid=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= $temp[0]."/";
		}
		if (eregi("&id=",$string)) {
			$temp = split("&id=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= $temp[0]."/";
		}
		if (eregi("&Itemid=",$string)) {
			$temp = split("&Itemid=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= $temp[0]."/";
		}
		if (eregi("&begindate=",$string) && eregi("&enddate=",$string)) {
			$temp = split("&begindate=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= "begindate" . $temp[0]."/";
			
			$temp = split("&enddate=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= "enddate" . $temp[0]."/";
		}
		elseif (eregi("&task=.+category",$string) || eregi("&task=blogsection",$string) ) {
			$Itemidnid = "Itemid$Itemid";
			if (isset($_SESSION[$Itemidnid . '_begindate']) && isset($_SESSION[$Itemidnid . '_enddate']) && !empty($_SESSION[$Itemidnid . '_begindate']) && !empty($_SESSION[$Itemidnid . '_begindate'])) {
				$sefstring .= "begindate" . $_SESSION[$Itemidnid . '_begindate']."/";
				$sefstring .= "enddate" . $_SESSION[$Itemidnid . '_enddate']."/";
			}
		}
		if (eregi("&limit=",$string)) {
			$temp = split("&limit=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= $temp[0]."/";
		}
		if (eregi("&limitstart=",$string)) {
			$temp = split("&limitstart=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= $temp[0]."/";
		}
		if (eregi("&lang=",$string)) {
			$temp = split("&lang=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= "lang,".$temp[0]."/";
		}
		$string = $sefstring;
		$string = preg_replace("/(\S+)\/(\w+)(\/)$/", "\${1}_\${2}.html", $string);
	}
	elseif (eregi("option=com_",$string) && !eregi("option=com_registration",$string) && !eregi("task=new",$string) && !eregi("task=edit",$string)) {
		/*
		Components
		index.php?option=com_xxxx&...
		*/
		//$sefstring = "component/";
		$sefstring = "";
		$temp = split("\?", $string);
		$temp = split("&", $temp[1]);
		foreach($temp as $key => $value) {
			if ( eregi("option=",$value) ) {
				$sefstring = $value."/" . $sefstring;
			}
			else {
				$sefstring .= $value."/";
			}
		}
		$string = str_replace( '=', ',', $sefstring );
		$string = preg_replace("/(\S+),(\w+)(\/)$/", "\${1}_\${2}.html", $string);
	}
	return '/'.$string;
}

?>

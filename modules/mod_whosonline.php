<?php
/**
* @version $Id: mod_whosonline.php,v 1.2 2007/05/24 01:58:30 lang3 Exp $
* @package Mambo
* @copyright (C) 2004 - 2007 mamhoo.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @ for use with com_mamhoo
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$online = $params->get( 'online', 1 );
$users = $params->get( 'users', 1 );
$stat_time = $params->get( 'stat_time', 300 ); //统计时间间隔，默认为300秒，即5分钟
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );

$content="";
$StartTime = time () - $stat_time;

if ($online) {
	$query1 = "SELECT count(session_id) as guest_online FROM #__session WHERE guest=1 AND time > $StartTime AND (usertype is NULL OR usertype='') ";
	$database->setQuery($query1);
	$guest_array = $database->loadResult();

	$query2 = "SELECT count(DISTINCT userid) as user_online FROM #__session WHERE guest=0 AND time > $StartTime ";
	$database->setQuery($query2);
	$user_array = $database->loadResult();

	if ($guest_array<>0 && $user_array==0) {
		if ($guest_array==1) {
			$content.=_WE_HAVE;
			$content.=_GUEST_COUNT;
			$content.=_ONLINE;
			eval ("\$content = \"$content\";");
		} else {
			$content.=_WE_HAVE;
			$content.=_GUESTS_COUNT;
			$content.=_ONLINE;
			eval ("\$content = \"$content\";");
		}
	}

	if ($guest_array==0 && $user_array<>0) {
		if ($user_array==1) {
			$content.=_WE_HAVE;
			$content.=_MEMBER_COUNT;
			$content.=_ONLINE;
			eval ("\$content = \"$content\";");
		} else {
			$content.=_WE_HAVE;
			$content.=_MEMBERS_COUNT;
			$content.=_ONLINE;
			eval ("\$content = \"$content\";");
		}
	}

	if ($guest_array<>0 && $user_array<>0) {
		if ($user_array==1) {
			$content.=_WE_HAVE;
			$content.=_MEMBER_COUNT;
			$content.=_AND;
			eval ("\$content = \"$content\";");
		} else {
			$content.=_WE_HAVE;
			$content.=_MEMBERS_COUNT;
			$content.=_AND;
			eval ("\$content = \"$content\";");
		}

		if ($guest_array==1) {
			$content.=_GUEST_COUNT;
			$content.=_ONLINE;
			eval ("\$content = \"$content\";");
		} else {
			$content.=_GUESTS_COUNT;
			$content.=_ONLINE;
			eval ("\$content = \"$content\";");
		}
	}
}

if ($users) {
	$query = "SELECT DISTINCT userid, username FROM #__session 
	          WHERE guest=0 AND time > $StartTime";
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	if ( count ($rows) ) {
		$i = 0;
		foreach($rows as $row) {
			$url = sefRelToAbs ("index.php?option=com_mamhoo&amp;task=UserView&amp;userid=$row->userid");
			if ( $i == 0) {
				$i = 1;
				$content .= "<BR /><strong><a href='$url'>$row->username</a></strong>";
			}
			else {
				$content .= ", <strong><a href='$url'>$row->username</a></strong>";
			}
		}
  }
	else {
		if ($content == "") {
			echo _NONE ."\n";
		}
	}
}

?>
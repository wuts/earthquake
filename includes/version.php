<?php
/**
* @version $Id: version.php,v 1.9 2008/04/22 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2008 mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software
*/

/** Version information */
class version {
	/** @var string Product */
	var $PRODUCT = 'Mambors';
	/** @var int Main Release Level */
	var $RELEASE = '5.5';
	/** @var string Development Status */
	var $DEV_STATUS = 'Stable';
	/** @var int Sub Release Level */
	var $DEV_LEVEL = '0';
	/** @var string Codename */
	var $CODENAME = 'Beautiful Mouse';
	/** @var string Date */
	var $RELDATE = '2008-04-22';
	/** @var string Time */
	var $RELTIME = '18:18';
	/** @var string Timezone */
	var $RELTZ = 'GMT';
	/** @var string Copyright Text */
	var $COPYRIGHT = 'Copyright 2004 - 2008 Mambochina.net.  All rights reserved.';
	/** @var string URL */
	var $URL = '<a href="http://www.mambochina.net">Mambors</a> based on <a href="http://mambo-foundation.org">Mambo</a> is Free Software released under the GNU/GPL License. ';
}
$_VERSION =& new version();

$version = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '
. $_VERSION->DEV_STATUS
.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '
. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;
?>

<?php
/**
* @version $Id: toolbar.frontpage.html.php,v 1.1 2005/07/22 01:52:17 eddieajau Exp $
* @package Mambo
* @subpackage Content
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Content
*/
class TOOLBAR_FrontPage {
	function _DEFAULT() {
		global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::custom('remove','delete.png','delete_f2.png',$adminLanguage->A_COMP_FRONT_REMOVE, true);
		mosMenuBar::spacer();
		mosMenuBar::help( '454.screen.frontpage' );
		mosMenuBar::endTable();
	}
}
?>
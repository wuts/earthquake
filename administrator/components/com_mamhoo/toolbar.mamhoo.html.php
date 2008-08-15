<?php
/**
* $Id: toolbar.mamhoo.html.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

class TOOLBAR_MAMHOO {

	function CONFIG_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save('saveconfig');
		mosMenuBar::divider();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function NEW_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::divider();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function EDIT_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::divider();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}


	function ABOUT_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function INSTALLER_MENU()	{
		mosMenuBar::startTable();
		mosMenuBar::deleteList( '', 'remove', 'Uninstall' );
		//mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.installer2' );
		mosMenuBar::endTable();
	}
	
	function DEFAULT_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::addNew();
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::custom( 'logout', 'cancel.png', 'cancel_f2.png', '&nbsp;'. _MAMHOO_FLOGOUT );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

}
?>
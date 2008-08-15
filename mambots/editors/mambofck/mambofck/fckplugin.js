/**
* FCKeditor - The text editor for internet
* Copyright (C) 2003-2006 Frederico Caldeira Knabben
* 
* Licensed under the terms of the GNU Lesser General Public License:
* 		http://www.opensource.org/licenses/lgpl-license.php
* 
* For further information visit:
* 		http://www.fckeditor.net/
* 
* "Support Open Source software. What about a donation today?"
* 
* File Name: fckplugin.js
* 	Mambo plugin.
* 	See the documentation for more info.
* 
* File Authors:
* 		Claudiu Cristea (clau.cristea@gmail.com)
*
* $Id: fckplugin.js,v 1.4 2006/09/16 21:59:10 cristea Exp $
*
*/

var mos_command = function(mos) {
	this.mos = mos;
}
mos_command.prototype.Execute = function() {  
	FCK.InsertHtml('{' + this.mos + '}'); 
} 
mos_command.prototype.GetState = function() { 
	return; 
} 

FCKCommands.RegisterCommand('mosimage', new mos_command('mosimage'));
FCKCommands.RegisterCommand('mospage', new mos_command('mospagebreak'));

var mos_images_path = FCKConfig.BasePath.replace(new RegExp('FCKeditor\/editor\/$', 'gi'), '') + 'mambofck/';

var oMOSItem = new FCKToolbarButton('mosimage', FCKLang['mosimage']);
oMOSItem.IconPath = mos_images_path + 'mosimage.gif' ;
FCKToolbarItems.RegisterItem( 'mosimage', oMOSItem ) ;

var oMOSItem = new FCKToolbarButton('mospage', FCKLang['mospage']);
oMOSItem.IconPath = mos_images_path + 'mospage.gif' ;
FCKToolbarItems.RegisterItem( 'mospage', oMOSItem ) ;

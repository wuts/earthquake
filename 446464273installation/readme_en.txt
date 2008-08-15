***************************************
** Title........: Mambo Multi Language Installer
** Description..: Installs mambo 4.5.2.x in users language (as defined in the installer)
** Author.......: mic
** Version......: 2.0 - Dalaas
** Created......: 2005.02.20
** Contact......: developer@mamboworld.net
** Url..........: http://mamboworld.net
** Mambo Version: 4.5.2.x
** Updated for Mambo 4.5.3 by  Akarawuth Tamrareang
** http://www.mambohub.com   email  ninekrit@mambohub.com
***************************************

***************************************
** Introduction
***************************************

MMLI will install Mambo (4.5.2.x) in the language as the user defines.

***************************************
** Explaination to Version [2.x]
***************************************

Dalaas - not Dallas! Daalas exists since 1300 a.d. and is in Vorarlberg - the most west country of austria, nearby swiss. Famous in wintertime for those amazing ski areas, but also recommended for a visit in summertime.

***************************************
** Explaination to the version [1.3.x]
***************************************

Baden: a small town in the south of vienna, approx. 30 km far away. Famous for his baths and the gambling casino. There is also Austria's only bath with real sand from the sea!

***************************************
** Explaination to the version [1.2.x]
***************************************

Alpbach: a small village in lower tyrol, nearly 600 inhabitants, but famous since 25 years for the yearly convent "Alpbacher Tage" (in english like: "days of Alpbach") which means, that every summer for 2 weeks from all countries of this world famous people will sit together and discuss the future of this planet.

***************************************
** Explaination to the version [1.1.x]
***************************************

Absam: a small town in Austria, Tyrol, nearby Innsbruck (from where i am).

In Absam is the famous school for alpine skijumpers, which won so many medails and titles in the last 30 years
at world- and other championships as well at the olympic games. All for Austria.

This is my contribution to them
(mic)

>> DEVELOPERS: see also the note below and dont delete earlier comments!

Legende:
# -> Bug Fix
+ -> Addition
! -> Change
- -> Removed
! -> Note

***************************************
** History
***************************************
------ 2.1 [2005.12.12]
+ Mambo 4.5.3
------ 2.0 [2005.02.20]
+ Mambo 4.5.2.x
! minor improvement in all scripts

------ 1.3.1 [2005.02.04]
# /installation/sql/mambo_german*.sql	- last comment caused cancelation of installation
# /installation/sql/mambo.sql		- last comment caused cancelation of installation

------ 1.3.0 [2005.02.03]
! code optimizations mainly js
+ polnische Spache

------ 1.2.2 [2005.01.24]
# if phpversion < 4.3 html_entity_decode will be changed by another function

------ 1.2.1 [2005.01.23[
# if php < 4.3 no check of serversettings for language (not supported by versions < 4.3)
+ renaming of install folder with random letters (increased security)
+ additional language variables in language files

------ 1.2.0 [2005.01.11]

# typo in german sample sql files at menue entry
# wrong call for images in css
+ MMLi 1.2.0
  ! folder "Installation" will be renamed and changing rights to avoid misusage

------ 1.1.3 [2005.01.07]

-fix	: missing language variable added in index.php
		: cleaned sql sample files

------ 1.1.2 [2004.12.31]

- new	: interface for language chooser
- fix	: check for db entries and switching back to former site if failure

------ 1.1.1 [2004.12.30]

- fix	: minor changes


------ 1.1 [2004.12.30]

- new	: ISO is called by installation language
	: Czech as language for installation (ISO & windows-1250)
	: Czech as language for front- & backend

------ 1.0 -------

Initial release ]2004.12.28]

	: this installer uses parts of the script of the MamboForge project "Install MultiLanguage" from Arnaud Yvis

-changes:
	: replacement of the not working "detect language" script - supports now many languages
	: language during installation process can be different then front- & backend language
	: install frontend (user) and backend (admin) language (can be different)
	: checks additonal important values from php.ini
	: shows the result of above checking
	: shows possible language setting as defined at servers side
	: An email is sent to the address given during the installation with the most important settings

***************************************
** Installation
***************************************

1. Unzip all files locally
2. Copy with FTP to your server space
3. In your browser type: http://www.yourdomainname.com/installation/index.php
4. Follow the instructions in screen

***************************************
** Supported Languages (during Installation)
***************************************

- Czech
- German
- Danish
- English

***************************************
** Supported Languages Frontend (after Installation)
***************************************

- Czech
- Croatian
- German
- Danish
- English
- Finnish
- French
- Hungarian
- Italian
- Norwegian
- Polish
- Serbian
- Swedish


***************************************
** Supported Languages Backend (after Installation)
***************************************

- Czech (*)
- German
- Danisch (*)
- English (*)

(*) For these languages the correct translations for components and modules must be installed, admin language is shown in above language.

***************************************
** Developers Note
***************************************

If you want to make enhancements, additions, etc. please give the installer a name from a city of your country.
This must not a big one, it should be one with history, or one you want to present to the world.

Always with the beginning of the next letter in the alphabet.

***************************************
** License
***************************************

 MMLI

 Copyright (C) 2004 mic (developer@mamboworld.net)
 All rights reserved.

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 Please note that the GPL states that any headers in files and
 Copyright notices as well as credits in headers, source files
 and output (screens, prints, etc.) can not be removed.
 You can extend them with your own credits, though...

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 The "GNU General Public License" (GPL) is available at
 http://www.gnu.org/copyleft/gpl.html.

 If you are using this module we would like to here from you
 and on which site you are using it.
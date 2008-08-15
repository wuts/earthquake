<?php
/**
* @version $Id: mod_fullmenu.php,v 1.1 2005/07/22 01:53:57 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Full DHTML Admnistrator Menus
* @package Mambo
*/
class mosFullAdminMenu {
	/**
	* Show the menu
	* @param string The current user type
	*/
	function show( $usertype='' ) {
		global $acl, $database;
		global $mosConfig_live_site, $mosConfig_enable_stats, $mosConfig_caching, $adminLanguage;

		// cache some acl checks
		$canConfig 			= $acl->acl_check( 'administration', 'config', 'users', $usertype );

		$manageTemplates 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_templates' );
		$manageMenuMan 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_menumanager' );
		$manageLanguages 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_languages' );
		$installModules 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
		$editAllModules 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
		$installMambots 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
		$editAllMambots 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
		$installComponents 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
		$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
		$canMassMail 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
		$canManageUsers 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );

        $query = "SELECT a.id, a.title, a.name,"
        . "\nCOUNT(DISTINCT c.id) AS numcat"
        . "\n FROM #__sections AS a"
        . "\n LEFT JOIN #__categories AS c ON c.section=a.id"
        . "\n WHERE a.scope='content'"
        . "\n GROUP BY a.id"
        . "\n ORDER BY a.ordering"
        ;
        $database->setQuery( $query );
        $sections = $database->loadObjectList();
		$nonemptySections = 0;
		foreach ($sections as $section)
			if ($section->numcat > 0)
				$nonemptySections++;
		$menuTypes = mosAdminMenus::menutypes();
?>
		<div id="myMenuID"></div>
		<script language="JavaScript" type="text/javascript">
		var myMenu =
		[
<?php
	// Home Sub-Menu
?>			[null,'<?php echo $adminLanguage->A_MENU_HOME;?>','index2.php',null,'<?php echo $adminLanguage->A_MENU_CTRL_PANEL;?>'],
			_cmSplit,
<?php
	// Site Sub-Menu
?>			[null,'<?php echo $adminLanguage->A_MENU_SITE;?>',null,null,'<?php echo $adminLanguage->A_MENU_SITE_MANAGEMENT;?>',
<?php
			if ($canConfig) {
?>				['<img src="../includes/js/ThemeOffice/config.png" />','<?php echo $adminLanguage->A_GLOBAL_CONF;?>','index2.php?option=com_config&hidemainmenu=1',null,'<?php echo $adminLanguage->A_MENU_CONFIGURATION;?>'],
<?php
			}
			if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/language.png" />','<?php echo $adminLanguage->A_MENU_LANGUAGES;?>',null,null,'<?php echo $adminLanguage->A_MENU_MANAGE_LANG;?>',
					['<img src="../includes/js/ThemeOffice/language.png" />','<?php echo $adminLanguage->A_MENU_LANG_MANAGE;?>','index2.php?option=com_languages',null,'<?php echo $adminLanguage->A_MENU_MANAGE_LANG;?>'],
					['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $adminLanguage->A_MENU_INSTALL;?>','index2.php?option=com_installer&element=language',null,'<?php echo $adminLanguage->A_MENU_INSTALL_LANG;?>'],
  				],
<?php
			}
?>				['<img src="../includes/js/ThemeOffice/media.png" />','<?php echo $adminLanguage->A_MENU_MEDIA_MANAGE;?>','index2.php?option=com_media',null,'<?php echo $adminLanguage->A_MENU_MANAGE_MEDIA;?>'],
				
				['<img src="../includes/js/ThemeOffice/globe1.png" />', '<?php echo $adminLanguage->A_MENU_STATISTICS;?>', null, null, '<?php echo $adminLanguage->A_MENU_STATISTICS_SITE;?>',
<?php
			if ($mosConfig_enable_stats == 1) {
?>					['<img src="../includes/js/ThemeOffice/globe4.png" />', '<?php echo $adminLanguage->A_MENU_BROWSER;?>', 'index2.php?option=com_statistics', null, '<?php echo $adminLanguage->A_MENU_BROWSER;?>'],
					['<img src="../includes/js/ThemeOffice/globe3.png" />', '<?php echo $adminLanguage->A_MENU_PAGE_IMP;?>', 'index2.php?option=com_statistics&task=pageimp', null, '<?php echo $adminLanguage->A_MENU_PAGE_IMP;?>'],
<?php
			}
?>					['<img src="../includes/js/ThemeOffice/search_text.png" />', '<?php echo $adminLanguage->A_MENU_SEARCH_TEXT;?>', 'index2.php?option=com_statistics&task=searches', null, '<?php echo $adminLanguage->A_MENU_SEARCH_TEXT;?>']
				],
<?php
			if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $adminLanguage->A_MENU_TEMP_MANAGE;?>',null,null,'<?php echo $adminLanguage->A_MENU_TEMP_CHANGE;?>',
					['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $adminLanguage->A_MENU_SITE_TEMP;?>','index2.php?option=com_templates',null,'<?php echo $adminLanguage->A_MENU_TEMP_CHANGE;?>'],
					['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $adminLanguage->A_MENU_INSTALL;?>','index2.php?option=com_installer&element=template&client=',null,'<?php echo $adminLanguage->A_MENU_INSTALL_TEMPLATES;?>'],
  					_cmSplit,
					['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $adminLanguage->A_MENU_ADMIN_TEMP;?>','index2.php?option=com_templates&client=admin',null,'<?php echo $adminLanguage->A_MENU_ADMIN_CHANGE_TEMP;?>'],
					['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $adminLanguage->A_MENU_INSTALL;?>','index2.php?option=com_installer&element=template&client=admin',null,'<?php echo $adminLanguage->A_MENU_INSTALL_ADMIN_TEMPLATES;?>'],
  					_cmSplit,
					['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $adminLanguage->A_MENU_MODUL_POS;?>','index2.php?option=com_templates&task=positions',null,'<?php echo $adminLanguage->A_MENU_TEMP_POS;?>']
  				],
<?php
			}
			if ($canManageUsers || $canMassMail) {
?>				['<img src="../includes/js/ThemeOffice/users.png" />','<?php echo $adminLanguage->A_MENU_USER_MANAGE;?>','index2.php?option=com_users&task=view',null,'<?php echo $adminLanguage->A_MENU_MANAGE_USER;?>'],
<?php
				}
?>
				['<img src="../includes/js/ThemeOffice/sysinfo.png" />', '<?php echo $adminLanguage->A_COMP_ADMIN_SYSTEM;?>', 'index2.php?option=com_admin&task=sysinfo', null, 'View System Information'],
			],
<?php
	// Menu Sub-Menu
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_COMP_MENU;?>',null,null,'<?php echo $adminLanguage->A_MENU_MANAGEMENT;?>',
<?php
			if ($manageMenuMan) {
?>				['<img src="../includes/js/ThemeOffice/menus.png" />','<?php echo $adminLanguage->A_MENU_MANAGER;?>','index2.php?option=com_menumanager',null,'<?php echo $adminLanguage->A_MENU_MANAGER;?>'],
				_cmSplit,
<?php
			}
			foreach ( $menuTypes as $menuType ) {
				$menuCaption = tr($menuType);
?>				['<img src="../includes/js/ThemeOffice/menus.png" />','<?php echo $menuCaption;?>','index2.php?option=com_menus&menutype=<?php echo $menuType;?>',null,''],
<?php
			}
?>			],
			_cmSplit,
<?php
	// Content Sub-Menu
?>			[null,'<?php echo $adminLanguage->A_MENU_CONTENT;?>',null,null,'<?php echo $adminLanguage->A_MENU_CONTENT_MANAGE;?>',
  				['<img src="../includes/js/ThemeOffice/add_section.png" />','<?php echo $adminLanguage->A_COMP_SECT_MANAGER;?>','index2.php?option=com_sections&scope=content',null,'<?php echo $adminLanguage->A_MENU_CONTENT_SEC;?>'],
<?php
			if (count($sections) > 0) {
?>				['<img src="../includes/js/ThemeOffice/add_section.png" />','<?php echo $adminLanguage->A_CATEGORY_MANAGER;?>','index2.php?option=com_categories&section=content',null,'<?php echo $adminLanguage->A_MENU_CONTENT_CAT;?>'],
<?php
			}
?>				_cmSplit,
				['<img src="../includes/js/ThemeOffice/edit.png" />','<?php echo $adminLanguage->A_ALL_MANAGER;?>','index2.php?option=com_content&sectionid=0',null,'<?php echo $adminLanguage->A_MENU_MANAGE_CONTENT;?>'],
  				['<img src="../includes/js/ThemeOffice/edit.png" />','<?php echo $adminLanguage->A_STATIC_MANAGER;?>','index2.php?option=com_typedcontent',null,'<?php echo $adminLanguage->A_MENU_ITEMS_CONTENT;?>'],
  				_cmSplit,
  				['<img src="../includes/js/ThemeOffice/home.png" />','<?php echo $adminLanguage->A_FRONTPAGE_MANAGER;?>','index2.php?option=com_frontpage',null,'<?php echo $adminLanguage->A_MENU_ITEMS_FRONT;?>'],
			],
<?php
	// Components Sub-Menu
	if ($installComponents) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_COMPONENTS;?>',null,null,'<?php echo $adminLanguage->A_MENU_COMPONENTS_MANAGEMENT;?>',
				['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $adminLanguage->A_MENU_INST_UNST;?>','index2.php?option=com_installer&element=component',null,'<?php echo $adminLanguage->A_MENU_INST_UNST_COMPONENTS;?>'],
  				_cmSplit,
<?php
        $query = "SELECT * FROM #__components WHERE name <> 'frontpage' and name <> 'media manager' ORDER BY ordering,name"
        ;
        $database->setQuery( $query );
        $comps = $database->loadObjectList();   // component list
        $subs = array();    // sub menus
        // first pass to collect sub-menu items
        foreach ($comps as $row) {
            if ($row->parent) {
                if (!array_key_exists( $row->parent, $subs )) {
                    $subs[$row->parent] = array();
                }
                $subs[$row->parent][] = $row;
            }
        }
        $topLevelLimit = 19; //You can get 19 top levels on a 800x600 Resolution
        $topLevelCount = 0;
        foreach ($comps as $row) {
            if ($editAllComponents | $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', $row->option )) {
                if ($row->parent == 0 && (trim( $row->admin_menu_link ) || array_key_exists( $row->id, $subs ))) {
                    $topLevelCount++;
                    if ($topLevelCount > $topLevelLimit) {
                        continue;
                    }
                    $name = addslashes( tr($row->name) );
                    $alt = addslashes( tr($row->admin_menu_alt) );
                    $link = $row->admin_menu_link ? "'index2.php?$row->admin_menu_link'" : "null";
                    echo "\t\t\t\t['<img src=\"../includes/$row->admin_menu_img\" />','$name',$link,null,'$alt'";
                    if (array_key_exists( $row->id, $subs )) {
                        foreach ($subs[$row->id] as $sub) {
	                        echo ",\n";
                            $name = addslashes( tr($sub->name) );
                            $alt = addslashes( tr($sub->admin_menu_alt) );
                            $link = $sub->admin_menu_link ? "'index2.php?$sub->admin_menu_link'" : "null";
                            echo "\t\t\t\t\t['<img src=\"../includes/$sub->admin_menu_img\" />','$name',$link,null,'$alt']";
                        }
                    }
                    echo "\n\t\t\t\t],\n";
                }
            }
        }
        if ($topLevelLimit < $topLevelCount) {
            echo "\t\t\t\t['<img src=\"../includes/js/ThemeOffice/sections.png\" />','<?php echo $adminLanguage->A_MENU_MORE_COMP2;?>','index2.php?option=com_admin&task=listcomponents',null,'<?php echo $adminLanguage->A_MENU_MORE_COMP;?>'],\n";
        }
?>
			],
<?php
	// Modules Sub-Menu
		if ($installModules | $editAllModules) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_MODULES;?>',null,null,'<?php echo $adminLanguage->A_MENU_MODULES_MANAGEMENT;?>',
<?php
			if ($installModules) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $adminLanguage->A_MENU_INST_UNST;?>', 'index2.php?option=com_installer&element=module', null, '<?php echo $adminLanguage->A_MENU_INSTALL_CUST;?>'],
				_cmSplit,
<?php
			}
			if ($editAllModules) {
?>				['<img src="../includes/js/ThemeOffice/module.png" />', '<?php echo $adminLanguage->A_MENU_SITE_MOD;?>', "index2.php?option=com_modules", null, '<?php echo $adminLanguage->A_MENU_SITE_MOD_MANAGE;?>'],
				['<img src="../includes/js/ThemeOffice/module.png" />', '<?php echo $adminLanguage->A_MENU_ADMIN_MOD;?>', "index2.php?option=com_modules&client=admin", null, '<?php echo $adminLanguage->A_MENU_ADMIN_MOD_MANAGE;?>'],
<?php
			}
?>			],
<?php
		} // if ($installModules | $editAllModules)
	} // if $installComponents
	// Mambots Sub-Menu
	if ($installMambots | $editAllMambots) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_MAMBOTS;?>',null,null,'<?php echo $adminLanguage->A_MENU_MAMBOTS_MANAGE;?>',
<?php
		if ($installMambots) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $adminLanguage->A_MENU_INST_UNST;?>', 'index2.php?option=com_installer&element=mambot', null, '<?php echo $adminLanguage->A_MENU_CUSTOM_MAMBOT;?>'],
				_cmSplit,
<?php
		}
		if ($editAllMambots) {
?>				['<img src="../includes/js/ThemeOffice/module.png" />', '<?php echo $adminLanguage->A_MENU_SITE_MAMBOTS;?>', "index2.php?option=com_mambots", null, '<?php echo $adminLanguage->A_MENU_MAMBOT_MANAGE;?>'],
<?php
		}
?>			],
<?php
	}
?>
<?php
	// Installer Sub-Menu
	if ($installModules) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_INSTALLERS;?>',null,null,'<?php echo $adminLanguage->A_MENU_INSTALLERS_LIST;?>',
<?php
		if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $adminLanguage->A_MENU_TEMPLATES_SITE;?>','index2.php?option=com_installer&element=template&client=',null,'<?php echo $adminLanguage->A_MENU_TEMPLATES_SITE_INST;?>'],
				['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $adminLanguage->A_MENU_TEMPLATES_ADMIN;?>','index2.php?option=com_installer&element=template&client=admin',null,'<?php echo $adminLanguage->A_MENU_TEMPLATES_ADMIN_INST;?>'],
<?php
		}
		if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $adminLanguage->A_MENU_LANGUAGES;?>','index2.php?option=com_installer&element=language',null,'<?php echo $adminLanguage->A_MENU_INSTALL_LANG;?>'],
				_cmSplit,
<?php
		}
?>				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $adminLanguage->A_MENU_COMPONENTS;?>','index2.php?option=com_installer&element=component',null,'<?php echo $adminLanguage->A_MENU_INST_UNST_COMPONENTS;?>'],
				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $adminLanguage->A_MENU_MODULES;?>', 'index2.php?option=com_installer&element=module', null, '<?php echo $adminLanguage->A_MENU_INST_UNST_MODULES;?>'],
				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $adminLanguage->A_MENU_MAMBOTS;?>', 'index2.php?option=com_installer&element=mambot', null, '<?php echo $adminLanguage->A_MENU_INST_UNST_MAMBOTS;?>'],
			],
<?php
	} // if ($installModules)
?>			_cmSplit,
<?php
	// Help Sub-Menu
?>			[null,'<?php echo $adminLanguage->A_HELP;?>','index2.php?option=com_admin&task=help',null,null],
<?php
?>			_cmSplit,
<?php
	// Preview Sub-Menu
?>			[null,'<?php echo $adminLanguage->A_MENU_PREVIEW;?>', null, null, null,
					['<img src="../includes/js/ThemeOffice/preview.png" />','<?php echo $adminLanguage->A_MENU_NEW_WINDOW;?>','<?php echo $mosConfig_live_site; ?>','_blank','<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" />','<?php echo $adminLanguage->A_MENU_INLINE;?>','index2.php?option=com_admin&task=preview',null,'<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" />','<?php echo $adminLanguage->A_MENU_INLINE_POS;?>','index2.php?option=com_admin&task=preview2',null,'<?php echo $mosConfig_live_site; ?>'],
				],
		];
		cmDraw ('myMenuID', myMenu, '<?php echo ($adminLanguage->RTLsupport ? "hbl" : "hbr"); ?>', cmThemeOffice, 'ThemeOffice'); <!-- rtl change -->
		</script>
<?php
	}
}

mosFullAdminMenu::show( $my->usertype );
?>
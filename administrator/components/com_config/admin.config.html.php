<?php
/**
* @version $Id: admin.config.html.php,v 1.5 2005/11/27 16:33:25 csouza Exp $
* @package Mambo
* @subpackage Config
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Config
*/
class HTML_config {

	function showconfig( &$row, &$lists, $option) {
		global $mosConfig_absolute_path, $mosConfig_live_site, $adminLanguage;
		$tabs = new mosTabs(1);
?>
		<script type="text/javascript">
		<!--
	        function saveFilePerms()
	        {
				var f = document.adminForm;
				if (f.filePermsMode0.checked)
					f.config_fileperms.value = '';
				else {
					var perms = 0;
		        	if (f.filePermsUserRead.checked) perms += 400;
					if (f.filePermsUserWrite.checked) perms += 200;
					if (f.filePermsUserExecute.checked) perms += 100;
					if (f.filePermsGroupRead.checked) perms += 40;
					if (f.filePermsGroupWrite.checked) perms += 20;
					if (f.filePermsGroupExecute.checked) perms += 10;
					if (f.filePermsWorldRead.checked) perms += 4;
					if (f.filePermsWorldWrite.checked) perms += 2;
					if (f.filePermsWorldExecute.checked) perms += 1;
					f.config_fileperms.value = '0'+''+perms;
				}
	        }
	        function changeFilePermsMode(mode)
	        {
	            if(document.getElementById) {
	                switch (mode) {
	                    case 0:
	                        document.getElementById('filePermsValue').style.display = 'none';
	                        document.getElementById('filePermsTooltip').style.display = '';
	                        document.getElementById('filePermsFlags').style.display = 'none';
	                        break;
	                    default:
	                        document.getElementById('filePermsValue').style.display = '';
	                        document.getElementById('filePermsTooltip').style.display = 'none';
	                        document.getElementById('filePermsFlags').style.display = '';
	                } // switch
	            } // if
				saveFilePerms();
	        }
	        function saveDirPerms()
	        {
				var f = document.adminForm;
				if (f.dirPermsMode0.checked)
					f.config_dirperms.value = '';
				else {
					var perms = 0;
		        	if (f.dirPermsUserRead.checked) perms += 400;
					if (f.dirPermsUserWrite.checked) perms += 200;
					if (f.dirPermsUserSearch.checked) perms += 100;
					if (f.dirPermsGroupRead.checked) perms += 40;
					if (f.dirPermsGroupWrite.checked) perms += 20;
					if (f.dirPermsGroupSearch.checked) perms += 10;
					if (f.dirPermsWorldRead.checked) perms += 4;
					if (f.dirPermsWorldWrite.checked) perms += 2;
					if (f.dirPermsWorldSearch.checked) perms += 1;
					f.config_dirperms.value = '0'+''+perms;
				}
	        }
	        function changeDirPermsMode(mode)
	        {
	            if(document.getElementById) {
	                switch (mode) {
	                    case 0:
	                        document.getElementById('dirPermsValue').style.display = 'none';
	                        document.getElementById('dirPermsTooltip').style.display = '';
	                        document.getElementById('dirPermsFlags').style.display = 'none';
	                        break;
	                    default:
	                        document.getElementById('dirPermsValue').style.display = '';
	                        document.getElementById('dirPermsTooltip').style.display = 'none';
	                        document.getElementById('dirPermsFlags').style.display = '';
	                } // switch
	            } // if
				saveDirPerms();
	        }
        //-->
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
	    <tr>
	        <td width="250"><table class="adminheading"><tr><th nowrap class="config"><?php echo $adminLanguage->A_COMP_CONF_GC;?></th></tr></table></td>
	        <td width="270">
	            <span class="componentheading">configuration.php <?php echo $adminLanguage->A_COMP_CONF_IS;?> :
	            <?php echo is_writable( '../configuration.php' ) ? '<b><font color="green">'. $adminLanguage->A_COMP_CONF_WRT .'</font></b>' : '<b><font color="red">'. $adminLanguage->A_COMP_CONF_UNWRT .'</font></b>' ?>
	            </span>
	        </td>
<?php
	        if (mosIsChmodable('../configuration.php')) {
	            if (is_writable('../configuration.php')) {
?>
	        <td>
	            <input type="checkbox" id="disable_write" name="disable_write" value="1"/>
	            <label for="disable_write"><?php echo $adminLanguage->A_COMP_SAVE_UNWRT;?></label>
	        </td>
<?php
	            } else {
?>
	        <td>
	            <input type="checkbox" id="enable_write" name="enable_write" value="1"/>
	            <label for="enable_write"><?php echo $adminLanguage->A_COMP_OVERRIDE_SAVE;?></label>
	        </td>
<?php
	            } // if
	        } // if
?>
	    </tr>
	    </table>
<?php
		$tabs->startPane("configPane");
		$tabs->startTab($adminLanguage->A_COMP_MAMB_SITE, "site-page" );
?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_OFFLINE;?>:</td>
			<td><?php echo $lists['offline']; ?></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_OFFMESSAGE;?>:</td>
			<td><textarea class="text_area" cols="60" rows="2" style="width:500px; height:40px" name="config_offline_message"><?php echo htmlspecialchars($row->config_offline_message, ENT_QUOTES); ?></textarea><?php
				$tip = $adminLanguage->A_COMP_CONF_OFFMESSAGE_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_ERR_MESSAGE;?>:</td>
			<td><textarea class="text_area" cols="60" rows="2" style="width:500px; height:40px" name="config_error_message"><?php echo htmlspecialchars($row->config_error_message, ENT_QUOTES); ?></textarea><?php
				$tip = $adminLanguage->A_COMP_CONF_ERR_MESSAGE_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_SITE_NAME;?>:</td>
			<td><input class="text_area" type="text" name="config_sitename" size="50" value="<?php echo $row->config_sitename; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_UN_LINKS;?>:</td>
			<td><?php echo $lists['auth']; ?><?php
				$tip = $adminLanguage->A_COMP_CONF_UN_LINKS_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_USER_REG;?>:</td>
			<td><?php echo $lists['allowuserregistration']; ?><?php
				$tip = $adminLanguage->A_COMP_CONF_USER_REG_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_AC_ACT;?>:</td>
			<td><?php echo $lists['useractivation']; ?>
			<?php
				$tip = $adminLanguage->A_COMP_CONF_AC_ACT_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_REQ_EMAIL;?>:</td>
			<td><?php echo $lists['uniquemail']; ?><?php
				$tip = $adminLanguage->A_COMP_CONF_REQ_EMAIL_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_REG_SUBMIT;?>:</td>
			<td><?php echo $lists['allowregisteredsubmitcontent']; ?><?php
				$tip = $adminLanguage->A_COMP_CONF_REG_SUBMIT_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_DEBUG;?>:</td>
			<td><?php echo $lists['debug']; ?><?php
				$tip = $adminLanguage->A_COMP_CONF_DEBUG_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_EDITOR;?>:</td>
			<td><?php echo $lists['editor']; ?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_LENGTH;?>:</td>
			<td><?php echo $lists['list_length']; ?><?php
				$tip = $adminLanguage->A_COMP_CONF_LENGTH_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_SITE_ICON;?>:</td>
			<td>
			<input class="text_area" type="text" name="config_favicon" size="20" value="<?php echo $row->config_favicon; ?>"/>
<?php
			$tip = $adminLanguage->A_COMP_CONF_SITE_ICON_TIP;
			echo mosToolTip( $tip, 'Favourite Icon' );
?>			</td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_LOCALE, "Locale-page" );
?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_LANG;?>:</td>
			<td><?php echo $lists['lang']; ?></td>
		</tr>
		<tr>
			<td width="185">
			<?php echo $adminLanguage->A_COMP_CONF_ALANG;?>:
			</td>
			<td> 
			<?php echo $lists['alang']; ?> 
			</td>
		</tr>
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_TIME_SET;?>:</td>
			<td>
			<?php echo $lists['offset']; ?>
<?php
			$tip = $adminLanguage->A_COMP_CONF_DATE .": ". mosCurrentDate(_DATE_FORMAT_LC2);
			echo mosToolTip($tip);
?>			</td>
		</tr>
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_LOCAL;?>:</td>
			<td><input class="text_area" type="text" name="config_locale" size="15" value="<?php echo $row->config_locale; ?>"/></td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_MOD_CONTENT, "content-page" );
?>
		<table class="adminform">
		<tr>
			<td colspan="3"><?php echo $adminLanguage->A_COMP_CONF_CONTROL;?><br/><br/></td>
		</tr>
		<tr>
			<td width="200"><?php echo $adminLanguage->A_COMP_CONF_LINK_TITLES;?>:</td>
			<td width="120"><?php echo $lists['link_titles']; ?></td>
			<td><?php
				$tip = $adminLanguage->A_COMP_CONF_HYPER;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td width="200"><?php echo $adminLanguage->A_COMP_CONF_MORE_LINK;?>:</td>
			<td width="100"><?php echo $lists['readmore']; ?></td>
			<td><?php
				$tip = $adminLanguage->A_COMP_CONF_MORE_LINK_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_RATE_VOTE;?>:</td>
			<td><?php echo $lists['vote']; ?></td>
			<td><?php
				$tip = $adminLanguage->A_COMP_CONF_RATE_VOTE_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_AUTHOR;?>:</td>
			<td><?php echo $lists['hideauthor']; ?></td>
			<td><?php
				$tip = $adminLanguage->A_COMP_CONF_AUTHOR_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_CREATED;?>:</td>
			<td><?php echo $lists['hidecreate']; ?></td>
			<td><?php
				$tip = $adminLanguage->A_COMP_CONF_CREATED_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MOD_DATE;?>:</td>
			<td><?php echo $lists['hidemodify']; ?></td>
			<td><?php
				$tip = $adminLanguage->A_COMP_CONF_MOD_DATE_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_HITS;?>:</td>
			<td><?php echo $lists['hits']; ?></td>
			<td><?php
				$tip = $adminLanguage->A_COMP_CONF_HITS_TIP;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_PDF;?>:</td>
			<td><?php echo $lists['hidepdf']; ?></td>
<?php
			if (!is_writable( "$mosConfig_absolute_path/media/" )) {
				echo "<td align=\"left\">";
				echo mosToolTip( $adminLanguage->A_COMP_CONF_OPT_MEDIA );
				echo "</td>";
			} else {
?>				<td>&nbsp;</td>
<?php
			}
?>		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_PRINT_ICON;?>:</td>
			<td><?php echo $lists['hideprint']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_EMAIL_ICON;?>:</td>
			<td><?php echo $lists['hideemail']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_ICONS;?>:</td>
			<td><?php echo $lists['icons']; ?></td>
			<td><?php echo mosToolTip( $adminLanguage->A_COMP_CONF_USE_OR_TEXT ); ?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_TBL_CONTENTS;?>:</td>
			<td><?php echo $lists['multipage_toc']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_BACK_BUTTON;?>:</td>
			<td><?php echo $lists['back_button']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_CONTENT_NAV;?>:</td>
			<td><?php echo $lists['item_navigation']; ?></td>
			<td>&nbsp;</td>
		</tr>
<!-- prepared for future releases
		<tr>
			<td>Multi lingual content support:</td>
			<td><?php //echo $lists['ml_support']; ?></td>
			<td><?php //echo mosToolTip('In order to use multi lingual content you MUST have installed the MambelFish component.'); ?></td>
		</tr>
-->
		<input type="hidden" name="config_ml_support" value="<?php echo $row->config_ml_support?>">
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_DB_NAME, "db-page" );
?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_HOSTNAME;?>:</td>
			<td><?php echo $row->config_host; ?><input type="hidden" name="config_host" value="<?php echo $row->config_host; ?>"/></td>
		</tr>
		<tr>
			<td>MySQL <?php echo $adminLanguage->A_COMP_CONF_DB_USERNAME;?>:</td>
			<td><?php echo $row->config_user; ?><input type="hidden" name="config_user" value="<?php echo $row->config_user; ?>"/></td>
		</tr>
		<tr>
			<td>MySQL <?php echo $adminLanguage->A_COMP_CONF_DB_PW;?>:</td>
			<td>********<input type="hidden" name="config_password" value="<?php echo $row->config_password; ?>"/></td>
		</tr>
		<tr>
			<td>MySQL <?php echo $adminLanguage->A_COMP_CONF_DB_NAME;?>:</td>
			<td><?php echo $row->config_db; ?><input type="hidden" name="config_db" value="<?php echo $row->config_db; ?>"/></td>
		</tr>
		<tr>
			<td>MySQL <?php echo $adminLanguage->A_COMP_CONF_DB_PREFIX;?>:</td>
			<td><?php echo $row->config_dbprefix; ?><input type="hidden" name="config_dbprefix" value="<?php echo $row->config_dbprefix; ?>"/></td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_SERVER, "server-page" );
?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_ABS_PATH;?>:</td>
			<td width="450"><strong><?php echo $row->config_path; ?></strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_LIVE;?>:</td>
			<td><strong><?php echo $row->config_live_site; ?></strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_SECRET;?>:</td>
			<td><strong><?php echo $row->config_secret; ?></strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_GZIP;?>:</td>
			<td>
			<?php echo $lists['gzip']; ?>
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_CP_BUFFER ); ?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_SESSION_TIME;?>:</td>
			<td>
			<input class="text_area" type="text" name="config_lifetime" size="10" value="<?php echo $row->config_lifetime; ?>"/>
			&nbsp;<?php echo $adminLanguage->A_COMP_CONF_SEC;?>&nbsp;
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_AUTO_LOGOUT ); ?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_ERR_REPORT;?>:</td>
			<td><?php echo $lists['error_reporting']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_REG_GLOBALS_EMU;?>:</td>
			<td>
			<?php echo $lists['register_globals']; ?>
			<?php 
			$rg = ini_get('register_globals') == 1 ? 'On' : 'Off';
			echo mosToolTip(sprintf($adminLanguage->A_COMP_CONF_REG_GLOBALS_EMU_DESC)); 
			?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_HELP_SERVER;?>:</td>
			<td><input class="text_area" type="text" name="config_helpurl" size="50" value="<?php echo $row->config_helpurl; ?>"/></td>
		</tr>
		<tr>
<?php
	$mode = 0;
	$flags = 0644;
	if ($row->config_fileperms!='') {
		$mode = 1;
		$flags = octdec($row->config_fileperms);
	} // if
?>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_FILE_CREATION;?>:</td>
	        <td>
	            <fieldset><legend><?php echo $adminLanguage->A_COMP_CONF_FILE_PERM;?></legend>
	                <table cellpadding="1" cellspacing="1" border="0">
	                    <tr>
	                        <td><input type="radio" id="filePermsMode0" name="filePermsMode" value="0" onclick="changeFilePermsMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/></td>
	                        <td><label for="filePermsMode0"><?php echo $adminLanguage->A_COMP_CONF_FILE_DONT_CHMOD;?></label></td>
	                    </tr>
	                    <tr>
	                        <td><input type="radio" id="filePermsMode1" name="filePermsMode" value="1" onclick="changeFilePermsMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/></td>
	                        <td>
								<label for="filePermsMode1"><?php echo $adminLanguage->A_COMP_CONF_FILE_CHMOD;?></label>
								<span id="filePermsValue"<?php if (!$mode) echo ' style="display:none"'; ?>>
								to:	<input class="text_area" type="text" readonly="readonly" name="config_fileperms" size="4" value="<?php echo $row->config_fileperms; ?>"/>
								</span>
								<span id="filePermsTooltip"<?php if ($mode) echo ' style="display:none"'; ?>>
								&nbsp;<?php echo mosToolTip($adminLanguage->A_COMP_CONF_FILE_CHMOD_TIP); ?>
								</span>
							</td>
	                    </tr>
	                    <tr id="filePermsFlags"<?php if (!$mode) echo ' style="display:none"'; ?>>
	                        <td>&nbsp;</td>
	                        <td>
	                            <table cellpadding="0" cellspacing="1" border="0">
	                                <tr>
	                                    <td style="padding:0px"><?php echo $adminLanguage->A_COMP_CONF_USER;?>:</td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsUserRead" name="filePermsUserRead" value="1" onclick="saveFilePerms()"<?php if ($flags & 0400) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="filePermsUserRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsUserWrite" name="filePermsUserWrite" value="1" onclick="saveFilePerms()"<?php if ($flags & 0200) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="filePermsUserWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsUserExecute" name="filePermsUserExecute" value="1" onclick="saveFilePerms()"<?php if ($flags & 0100) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px" colspan="3"><label for="filePermsUserExecute"><?php echo $adminLanguage->A_COMP_CONF_EXECUTE;?></label></td>
	                                </tr>
	                                <tr>
	                                    <td style="padding:0px"><?php echo $adminLanguage->A_COMP_CONF_GROUP;?>:</td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsGroupRead" name="filePermsGroupRead" value="1" onclick="saveFilePerms()"<?php if ($flags & 040) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="filePermsGroupRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsGroupWrite" name="filePermsGroupWrite" value="1" onclick="saveFilePerms()"<?php if ($flags & 020) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="filePermsGroupWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsGroupExecute" name="filePermsGroupExecute" value="1" onclick="saveFilePerms()"<?php if ($flags & 010) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px" width="70"><label for="filePermsGroupExecute"><?php echo $adminLanguage->A_COMP_CONF_EXECUTE;?></label></td>
										<td><input type="checkbox" id="applyFilePerms" name="applyFilePerms" value="1"/></td>
	                                    <td nowrap="nowrap">
											<label for="applyFilePerms">
												<?php echo $adminLanguage->A_COMP_CONF_APPLY_FILE;?>
												&nbsp;<?php
												echo mosWarning($adminLanguage->A_COMP_CONF_APPLY_FILE_TIP);?>
											</label>
										</td>
	                                </tr>
	                                <tr>
	                                    <td style="padding:0px"><?php echo $adminLanguage->A_COMP_CONF_WORLD;?>:</td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsWorldRead" name="filePermsWorldRead" value="1" onclick="saveFilePerms()"<?php if ($flags & 04) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="filePermsWorldRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsWorldWrite" name="filePermsWorldWrite" value="1" onclick="saveFilePerms()"<?php if ($flags & 02) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="filePermsWorldWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="filePermsWorldExecute" name="filePermsWorldExecute" value="1" onclick="saveFilePerms()"<?php if ($flags & 01) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px" colspan="4"><label for="filePermsWorldExecute"><?php echo $adminLanguage->A_COMP_CONF_EXECUTE;?></label></td>
	                                </tr>
	                            </table>
	                        </td>
	                    </tr>
	                </table>
	            </fieldset>
	        </td>
			<td>&nbsp;</td>
	    </tr>
	    <tr>
<?php
	$mode = 0;
	$flags = 0755;
	if ($row->config_dirperms!='') {
		$mode = 1;
		$flags = octdec($row->config_dirperms);
	} // if
?>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_DIR_CREATION;?>:</td>
	        <td>
	            <fieldset><legend><?php echo $adminLanguage->A_COMP_CONF_DIR_PERM;?></legend>
	                <table cellpadding="1" cellspacing="1" border="0">
	                    <tr>
	                        <td><input type="radio" id="dirPermsMode0" name="dirPermsMode" value="0" onclick="changeDirPermsMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/></td>
	                        <td><label for="dirPermsMode0"><?php echo $adminLanguage->A_COMP_CONF_DIR_DONT_CHMOD;?></label></td>
	                    </tr>
	                    <tr>
	                        <td><input type="radio" id="dirPermsMode1" name="dirPermsMode" value="1" onclick="changeDirPermsMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/></td>
	                        <td>
								<label for="dirPermsMode1"><?php echo $adminLanguage->A_COMP_CONF_DIR_CHMOD;?></label>
								<span id="dirPermsValue"<?php if (!$mode) echo ' style="display:none"'; ?>>
   							    to: <input class="text_area" type="text" readonly="readonly" name="config_dirperms" size="4" value="<?php echo $row->config_dirperms; ?>"/>
								</span>
								<span id="dirPermsTooltip"<?php if ($mode) echo ' style="display:none"'; ?>>
								&nbsp;<?php echo mosToolTip($adminLanguage->A_COMP_CONF_DIR_CHMOD_TIP); ?>
								</span>
							</td>
	                    </tr>
	                    <tr id="dirPermsFlags"<?php if (!$mode) echo ' style="display:none"'; ?>>
	                        <td>&nbsp;</td>
	                        <td>
	                            <table cellpadding="1" cellspacing="0" border="0">
	                                <tr>
	                                    <td style="padding:0px"><?php echo $adminLanguage->A_COMP_CONF_USER;?>:</td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsUserRead" name="dirPermsUserRead" value="1" onclick="saveDirPerms()"<?php if ($flags & 0400) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="dirPermsUserRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsUserWrite" name="dirPermsUserWrite" value="1" onclick="saveDirPerms()"<?php if ($flags & 0200) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="dirPermsUserWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsUserSearch" name="dirPermsUserSearch" value="1" onclick="saveDirPerms()"<?php if ($flags & 0100) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px" colspan="3"><label for="dirPermsUserSearch"><?php echo $adminLanguage->A_COMP_CONF_SEARCH;?></label></td>
	                                </tr>
	                                <tr>
	                                    <td style="padding:0px"><?php echo $adminLanguage->A_COMP_CONF_GROUP;?>:</td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsGroupRead" name="dirPermsGroupRead" value="1" onclick="saveDirPerms()"<?php if ($flags & 040) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="dirPermsGroupRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsGroupWrite" name="dirPermsGroupWrite" value="1" onclick="saveDirPerms()"<?php if ($flags & 020) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="dirPermsGroupWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsGroupSearch" name="dirPermsGroupSearch" value="1" onclick="saveDirPerms()"<?php if ($flags & 010) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px" width="70"><label for="dirPermsGroupSearch"><?php echo $adminLanguage->A_COMP_CONF_SEARCH;?></label></td>
										<td><input type="checkbox" id="applyDirPerms" name="applyDirPerms" value="1"/></td>
	                                    <td nowrap="nowrap">
											<label for="applyDirPerms">
												<?php echo $adminLanguage->A_COMP_CONF_APPLY_DIR;?>
												&nbsp;<?php
												echo mosWarning($adminLanguage->A_COMP_CONF_APPLY_DIR_TIP);?>
											</label>
										</td>
	                                </tr>
	                                <tr>
	                                    <td style="padding:0px"><?php echo $adminLanguage->A_COMP_CONF_WORLD;?>:</td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsWorldRead" name="dirPermsWorldRead" value="1" onclick="saveDirPerms()"<?php if ($flags & 04) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="dirPermsWorldRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsWorldWrite" name="dirPermsWorldWrite" value="1" onclick="saveDirPerms()"<?php if ($flags & 02) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px"><label for="dirPermsWorldWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding:0px"><input type="checkbox" id="dirPermsWorldSearch" name="dirPermsWorldSearch" value="1" onclick="saveDirPerms()"<?php if ($flags & 01) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding:0px" colspan="3"><label for="dirPermsWorldSearch"><?php echo $adminLanguage->A_COMP_CONF_SEARCH;?></label></td>
	                                </tr>
	                            </table>
	                        </td>
	                    </tr>
	                </table>
	            </fieldset>
	        </td>
			<td>&nbsp;</td>
	      </tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_METADATA, "metadata-page" );
?>
		<table class="adminform">
		<tr>
			<td width="185" valign="top"><?php echo $adminLanguage->A_COMP_CONF_META_DESC;?>:</td>
			<td><textarea class="text_area" cols="50" rows="3" style="width:500px; height:50px" name="config_metadesc"><?php echo htmlspecialchars($row->config_metadesc, ENT_QUOTES); ?></textarea></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_META_KEY;?>:</td>
			<td><textarea class="text_area" cols="50" rows="3" style="width:500px; height:50px" name="config_metakeys"><?php echo htmlspecialchars($row->config_metakeys, ENT_QUOTES); ?></textarea></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_META_TITLE;?>:</td>
			<td>
			<?php echo $lists['metatitle']; ?>
			&nbsp;&nbsp;&nbsp;
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_META_ITEMS ); ?>
			</td>
		  	</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_META_AUTHOR;?>:</td>
			<td>
			<?php echo $lists['metaauthor']; ?>
			&nbsp;&nbsp;&nbsp;
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_META_AUTHOR_TIP ); ?>
			</td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_EMAIL, "mail-page" );
?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_MAIL;?>:</td>
			<td><?php echo $lists['mailer']; ?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MAIL_FROM;?>:</td>
			<td><input class="text_area" type="text" name="config_mailfrom" size="50" value="<?php echo $row->config_mailfrom; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MAIL_FROM_NAME;?>:</td>
			<td><input class="text_area" type="text" name="config_fromname" size="50" value="<?php echo $row->config_fromname; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MAIL_SENDMAIL_PATH;?>:</td>
			<td><input class="text_area" type="text" name="config_sendmail" size="50" value="<?php echo $row->config_sendmail; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_AUTH;?>:</td>
			<td><?php echo $lists['smtpauth']; ?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_USER;?>:</td>
			<td><input class="text_area" type="text" name="config_smtpuser" size="50" value="<?php echo $row->config_smtpuser; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_PASS;?>:</td>
			<td><input class="text_area" type="password" name="config_smtppass" size="50" value="<?php echo $row->config_smtppass; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_HOST;?>:</td>
			<td><input class="text_area" type="text" name="config_smtphost" size="50" value="<?php echo $row->config_smtphost; ?>"/></td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_CACHE_TAB, "cache-page" );
?>
		<table class="adminform" border="0">
		<?php
		if (is_writeable($row->config_cachepath)) {
			?>
			<tr>
				<td width="185"><?php echo $adminLanguage->A_COMP_CONF_CACHE;?>:</td>
				<td width="500"><?php echo $lists['caching']; ?></td>
				<td>&nbsp;</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_CACHE_FOLDER;?>:</td>
			<td>
			<input class="text_area" type="text" name="config_cachepath" size="50" value="<?php echo $row->config_cachepath; ?>"/>
<?php
			if (is_writeable($row->config_cachepath)) {
				echo mosToolTip( $adminLanguage->A_COMP_CONF_CACHE_DIR ." <b>". $adminLanguage->A_COMP_CONF_WRT ."</b>");
			} else {
				echo mosWarning( $adminLanguage->A_COMP_CONF_CACHE_DIR_UNWRT );
			}
?>			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_CACHE_TIME; ?>:</td>
			<td><input class="text_area" type="text" name="config_cachetime" size="5" value="<?php echo $row->config_cachetime; ?>"/> <?php echo $adminLanguage->A_COMP_CONF_SEC;?></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_MENU_STATISTICS, "stats-page" );
		?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_STATS;?>:</td>
			<td width="120"><?php echo $lists['enable_stats']; ?></td>
			<td><?php echo mostooltip($adminLanguage->A_COMP_CONF_STATS_ENABLE); ?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_STATS_LOG_HITS;?>:</td>
			<td><?php echo $lists['log_items']; ?></td>
			<td><span class="error"><?php echo mosWarning($adminLanguage->A_COMP_CONF_STATS_WARN_DATA); ?></span></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_STATS_LOG_SEARCH;?>:</td>
			<td><?php echo $lists['log_searches']; ?></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_SEO_LBL, "seo-page" );
		?>
		<table class="adminform">
		<tr>
			<td width="200"><strong><?php echo $adminLanguage->A_COMP_CONF_SEO;?></strong></td>
			<td width="120">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_SEO_SEFU;?>:</td>
			<td><?php echo $lists['sef']; ?>&nbsp;</td>
			<td><span class="error"><?php echo mosWarning($adminLanguage->A_COMP_CONF_SEO_APACHE); ?></span></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_SEO_DYN;?>:</td>
			<td><?php echo $lists['pagetitles']; ?></td>
			<td><?php echo mosToolTip($adminLanguage->A_COMP_CONF_SEO_DYN_TITLE); ?></td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->endPane();
?>
		<input type="hidden" name="option" value="<?php echo $option; ?>"/>
		<input type="hidden" name="config_path" value="<?php echo $row->config_path; ?>"/>
		<input type="hidden" name="config_live_site" value="<?php echo $row->config_live_site; ?>"/>
		<input type="hidden" name="config_secret" value="<?php echo $row->config_secret; ?>"/>
	  	<input type="hidden" name="task" value=""/>
		</form>
		<script  type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
<?php
	}

}
?>
<?php
/**
* @version $Id: index.php,v 1.5 2005/02/20 21:44:16 mic Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @edited bymic (developer@mamboworld.net) www.mamboworld.net
*/

/**
* >> for future developers: please change version number, date and version name to a city (next letter in alphabet) from your country and explain here the reason why this city and maybe important facts about
**/

/**
* Version 2.1
* Add Thai Language & Modify for Mambo 4.5.3 by Akarawuth Tamrareang http://www.mambohub.com
*
* version 2.x
* Dalaas - nicht Dallas! Dallas besteht seit zirka 1300 a.d. un dbefindet sich in Vorarlberg, genauer gesagt im
* Klostertal. Berühmt im Winter für die herrlichen Skigebiete in und rundum Dalaas.
*
* version 1.3.x
* Baden: eine kleine Stadt, ca. 30 km südlich von Wien. Berühmt für seine Kurbäder und das Spielcasino. Österreichs
* einziges Strandbad mit echtem Meersand!
*
* version 1.2.x
* Alpbach: ein kleiner Ort mit knapp 600 Einwohnern in Tirol. Aber berühmt seit 25 Jahren für die "Alpbacher Tage",
* wobei jährlich im sommer für 14 Tage von und mit berühmten Personen aus aller Welt über die Zukunft dieses Planeten
* diskutiert wird.
*
* version 1.1.x
* Absam: a small town in Austria, Tyrol, nearby Innsbruck (from where i am).
* In Absam is the famous school for alpine skijumpers, which won so many medails and titles in the last 30 years
* at world and other championships as well at the olympic games. All for Austria.
*
* Modify for Mambo 4.5.3 by Akarawuth Tamrareang
* http://www.mambohub.com
*/

/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );

/** Include common.php */
require_once ( 'common.php' );

if (file_exists( '../configuration.php' ) && filesize( '../configuration.php' ) > 10) {
	header( 'Location: ../index.php' );
	exit();
}

$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$install_iso = trim( mosGetParam( $_POST, 'install_iso', '' ) );

include_once ( 'language_detection.php' );

if ( file_exists( 'language/install_'.$language_install.'.php')) {
	require_once( '../language/'.$language_install.'.php' );
	require_once( 'language/install_'.$language_install.'.php' );
} else {
	require_once( '../language/english.php' );
	require_once( 'language/install_english.php' );
}

$lng_choose = array(999 => _INSTALL_LANGUAGE_CHOOSE );

echo "<?xml version=\"1.0\" encoding=\"" . $install_iso . "\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $install_iso; ?>" />
<title><?php echo _MAMBO_WEB_INSTALLER._INSTALL_STEP_PRECHECK; ?></title>
<link rel="shortcut icon" href="../../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<?php
if( file_exists( 'images/header_' . substr( $language_install, 0, 3 ) . '_install.png' ) ){
	$install_img = 'images/header_' . substr( $language_install, 0, 3 ) . '_install.png';
}else $install_img = 'images/header_eng_install.png'; ?>
<div id="wrapper">
	<div id="header">
		<div id="mambo">
    		<img src="<?php echo $install_img; ?>" alt="<?php echo _INSTALL_MAMBO; ?>" />
    		<?php echo '<font color="#FF9900"><strong><a href="http://www.mambochina.net" target="_blank">' . _MAMBORS_VERSION . '</a></strong></font>'; ?>
    	</div>
	</div>
</div>

<div id="ctr" align="center">
	<div class="install">
		<div id="stepbar">
			<div class="step-on"><?php echo _INSTALL_STEP_PRECHECK; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_LICENSE; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_1; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_2; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_3; ?></div>
		</div>

		<div id="right">
			<form action="install.php" method="post" name="form" id="form">
				<div id="step"><?php echo _INSTALL_PRECHECK_TITLE; ?></div>
				<div class="far-right">
					<input type="hidden" name="language_install" value="<?php echo $language_install; ?>" />
					<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
					<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
					<input name="Button2" type="submit" class="button" value="<?php echo _INSTALL_NEXT; ?>" onclick="window.location='install.php';" />
				</div>
				<div class="clr"></div>
			</form>

			<form action="index.php" method="post" name="Langue">
				<h1><?php echo _INSTALL_LANGUAGE_SECTION; ?>:</h1>
				<div class="install-text"> <?php echo _INSTALL_LANGUAGE_DESCRIPTION; ?>
					<div class="ctr"></div>
				</div>

				<div class="install-form">
					<div class="form-block">
						<table class="content">
							<tr>
								<td class="item"> <?php echo _INSTALL_LANGUAGE_LABEL; ?> </td>
								<td align="left">
									<?php
									$handle = @opendir( 'language' );
									$tmp_lang = array();
									while ( $file = @readdir ( $handle ) ) {
										if( strtolower( substr( $file, 0, 8 )) == 'install_' ){
											$file = str_replace( 'install_', '', $file );
											$file = str_replace( '.php', '', $file );
											$tmp_lang[] = strtolower( $file );
										} // end if
									} // end while
									@closedir( $handle );
									sort( $tmp_lang );
									echo '<select size="1" name="language_install" type="submit" onchange="this.form.submit();">';
									foreach ( $tmp_lang as $lang_found ){
										if( $lang_found == $language_install ){
											echo '<option value ="'.$lang_found.'" Selected>'.$lang_found."</option>\n";
										}else{
											echo '<option value ="'.$lang_found.'">'.$lang_found."</option>\n";
										}
									}
									echo '</select>';
									?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="install-form">
					<div class="form-block">
						<table class="content">
							<tr>
								<td><strong><?php echo _INSTALL_LANGUAGE_CHECK; ?></strong></td>
							<tr>
								<td><?php echo _INSTALL_LANGUAGE_LABEL; ?></td>
								<td>
									<font color="green"><strong><?php echo $language_install; ?></strong></font>
								</td>
							</tr>
							<tr>
								<td>ISO</td>
								<td>
									<font color="green"><strong><?php echo $install_iso; ?></strong></font>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</form>

			<div class="clr"></div>
			<h1><?php echo _INSTALL_PRECHECK_SECTION; ?></h1>
			<div class="install-text"> <?php echo _INSTALL_PRECHECK_DESCRIPTION; ?>
				<div class="ctr"></div>
			</div>

			<div class="install-form">
				<div class="form-block">
					<table class="content">
						<tr>
							<td class="item"><?php echo _INSTALL_PHP_VERSION; ?></td>
							<td align="left">
								<?php echo phpversion() < '4.1' ? '<strong><font color="red">'._INSTALL_NO.'</font></strong>' : '<strong><font color="green">'._INSTALL_YES.'</font></strong>'; ?>
								&nbsp;(<strong> <?php echo phpversion(); ?></strong> )
							</td>
						</tr>

						<tr>
							<td><?php echo _INSTALL_PHP_ZLIB; ?></td>
							<td align="left">
								<?php echo extension_loaded('zlib') ? '<strong><font color="green">'._INSTALL_AVAILABLE.'</font></strong>' : '<strong><font color="red">'._INSTALL_UNAVAILABLE.'</font></strong>'; ?>
							</td>
						</tr>

						<tr>
							<td><?php echo _INSTALL_PHP_XML; ?></td>
							<td align="left">
								<?php echo extension_loaded('xml') ? '<strong><font color="green">'._INSTALL_AVAILABLE.'</font></strong>' : '<strong><font color="red">'._INSTALL_UNAVAILABLE.'</font></strong>'; ?>
							</td>
						</tr>

						<tr>
							<td><?php echo _INSTALL_PHP_MYSQL; ?></td>
							<td align="left">
								<?php echo function_exists( 'mysql_connect' ) ? '<strong><font color="green">'._INSTALL_AVAILABLE.'</font></strong>' : '<strong><font color="red">'._INSTALL_UNAVAILABLE.'</font></strong>'; ?>
							</td>
						</tr>

						<tr>
							<td valign="top" class="item"><?php echo _INSTALL_CONFIG_FILE; ?></td>
							<td align="left">
								<?php
								if (@file_exists('../configuration.php') && @is_writable( '../configuration.php' )){
									echo '<strong><font color="green">'._INSTALL_WRITABLE.'</font></strong>';
								} else if ( @is_writable( '..' ) ) {
									echo '<strong><font color="green">'._INSTALL_WRITABLE.'</font></strong>';
								} else {
									echo '<strong>configuration.php<br /><font color="red">'._INSTALL_UNWRITABLE.'</font></strong><br /><span class="small">'._INSTALL_PHP_CONF.'</span>';
								} ?>
							</td>
						</tr>

						<tr>
							<td class="item"><?php echo _INSTALL_SESSION; ?></td>
							<td align="left">
								<strong><?php echo (( $sp=ini_get('session.save_path')) ? '' : _INSTALL_SESSION_NOT_SET ); ?></strong>
								<?php echo is_writable( $sp ) ? '<strong><font color="green">'._INSTALL_WRITABLE.'</font></strong>' : '<strong>'.$sp.'<br /><font color="red">'._INSTALL_UNWRITABLE.'</font></strong>'; ?>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="clr"></div>
			<h1><?php echo _INSTALL_PHP_SETTINGS_TITLE; ?></h1>
			<div class="install-text"> <?php echo _INSTALL_PHP_SETTINGS_DESCRIPTION; ?>
				<div class="ctr"></div>
			</div>

			<div class="install-form">
				<div class="form-block">
					<table class="content">
						<tr>
							<td class="toggle"><?php echo _INSTALL_PHP_FONCTION; ?></td>
							<td class="toggle"><?php echo _INSTALL_PHP_FONCTION_IDEAL; ?></td>
							<td class="toggle"><?php echo _INSTALL_PHP_FONCTION_ACTUAL; ?></td>
						</tr>

						<?php
						$php_recommended_settings = array(
							array (_INSTALL_PHP_MODE, 'safe_mode', _INSTALL_OFF),
							array (_INSTALL_PHP_ERRORS, 'display_errors', _INSTALL_ON),
							array (_INSTALL_PHP_UPLOAD, 'file_uploads', _INSTALL_ON),
							array (_INSTALL_PHP_QUOTES_GPC, 'magic_quotes_gpc', _INSTALL_ON),
							array (_INSTALL_PHP_QUOTES_RUNTIME, 'magic_quotes_runtime', _INSTALL_OFF),
							array (_INSTALL_PHP_GLOBALS, 'register_globals', _INSTALL_OFF),
							array (_INSTALL_PHP_OUTBUFFER, 'output_buffering', _INSTALL_OFF),
							array (_INSTALL_PHP_AUTOSTART_SESSION, 'session.auto_start', _INSTALL_OFF),
						);

						foreach ($php_recommended_settings as $phprec) { ?>
							<tr>
								<td class="item"><?php echo $phprec[0]; ?></td>
								<td class="toggle"><?php echo $phprec[2]; ?></td>
								<td>
									<?php
									if ( get_php_setting($phprec[1]) == $phprec[2] ) { ?>
										<font color="green"><strong>
										<?php
									} else { ?>
										<font color="red"><strong>
										<?php
									}
									echo get_php_setting($phprec[1]); ?>
									</strong></font>
								</td>
							</tr>
							<?php
						} // end foreach
						?>
					</table>
				</div>
			</div>

			<div class="clr"></div>
			<h1><?php echo _INSTALL_DIRFILE_PERMS; ?></h1>
			<div class="install-text"> <?php echo _INSTALL_DIRFILE_PERMS_INFO; ?>
				<div class="clr">&nbsp;&nbsp;</div>
				<div class="ctr"></div>
			</div>

			<div class="install-form">
				<div class="form-block">
			    	<table class="content">
						<?php
						writableCell( 'administrator/backups' );
						writableCell( 'administrator/components' );
						writableCell( 'administrator/modules' );
						writableCell( 'administrator/templates' );
						writableCell( 'cache' );
						writableCell( 'components' );
						writableCell( 'images' );
						writableCell( 'images/banners' );
						writableCell( 'images/stories' );
						writableCell( 'language' );
						writableCell( 'mambots' );
						writableCell( 'mambots/content' );
						writableCell( 'mambots/search' );
						writableCell( 'media' );
						writableCell( 'modules' );
						writableCell( 'templates' );
						?>
					</table>
				</div>

				<div class="clr"></div>
			</div>

			<div class="clr"></div>
		</div>
	<div class="clr"></div>
  </div>
<div class="clr"></div>
</div>

<div class="ctr">
	<?php echo _D_MAMBORS; ?>
</div>
</body>
</html>
                                                                                                    

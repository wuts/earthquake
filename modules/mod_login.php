<?php
/**
* @version $Id: mod_login.php,v 1.1 2005/07/22 01:58:29 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$return = mosGetParam( $_SERVER, 'REQUEST_URI', null );
// converts & to &amp; for xtml compliance
$return = str_replace( '&', '&amp;', $return );

$registration_enabled = $mainframe->getCfg( 'allowUserRegistration' );

$class_sfx	= trim( $params->get( 'moduleclass_sfx' ) );
$layout = $params->get( 'layout', 0 );

$message_login = $params->def( 'login_message', 0 );
$message_logout = $params->def( 'logout_message', 0 );
$login = $params->def( 'login', $return );
$logout = $params->def( 'logout', $return );
$greeting = $params->def( 'greeting', 1 );
$name = $params->def( 'name', 1 );

$registerlink = sefRelToAbs( 'index.php?option=com_mamhoo&amp;task=register' );
$lostpasswordlink = sefRelToAbs( 'index.php?option=com_mamhoo&amp;task=lostPassword' );

if ( $name ) {
	$query = "SELECT name FROM #__users WHERE id = ". $my->id;
	$database->setQuery( $query );
	$name = $database->loadResult();
} else {
	$name = $my->username;
}

if ( $my->id ) {
	?>
	<form action="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>" method="post" name="login" >
	<?php
	if ( $greeting ) {
		echo _HI . $name;
	}
	if ($layout<2) {
		echo '<br />';
	}
	?>
	<input type="submit" name="Submit" class="button" value="<?php echo _BUTTON_LOGOUT; ?>" />
	<input type="hidden" name="op2" value="logout" />
	<input type="hidden" name="lang" value="<?php echo $mosConfig_lang; ?>" />
	<input type="hidden" name="return" value="<?php echo sefRelToAbs( $logout ); ?>" />
	<input type="hidden" name="message" value="<?php echo $message_logout; ?>" />
	</form>
	<?php
}
else {
	?>
	<form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="login" >
<?php if ( $layout == 2) {?>
	<?php echo _USERNAME; ?>
	<input name="username" type="text" class="inputbox" alt="username" size="10" />
	&nbsp;<?php echo _PASSWORD; ?>
	<input type="password" name="passwd" class="inputbox" size="10" alt="password" />
		<input type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" /> 
		<?php echo _REMEMBER_ME; ?>
	
		<input type="hidden" name="option" value="login" />
		<input type="submit" name="Submit" class="button" value="<?php echo _BUTTON_LOGIN; ?>" />

		<?php if ( $registration_enabled ) {?>
			<a href="<?php echo $registerlink; ?>">
			<?php echo _CREATE_ACCOUNT; ?>
			</a>
			&nbsp;
		<?php }?>
		<a href="<?php echo $lostpasswordlink; ?>">
		<?php echo _LOST_PASSWORD; ?>
		</a>
<?php }
	  else {
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td><?php echo _USERNAME; ?></td>
		<td><input name="username" type="text" class="inputbox" alt="username" size="10" /></td>
		<td>
		<?php if ( $registration_enabled && $layout == 1) {?>
			<a href="<?php echo $registerlink; ?>">
			<?php echo _CREATE_ACCOUNT; ?>
			</a>
		<?php }?>
		</td>
	</tr>
	<tr>
		<td><?php echo _PASSWORD; ?></td>
		<td><input type="password" name="passwd" class="inputbox" size="10" alt="password" /></td>
		<td>
		<?php if ( $layout == 1) {?>
		<a href="<?php echo $lostpasswordlink; ?>">
		<?php echo _LOST_PASSWORD; ?>
		</a>
		<?php }?>
		</td>
	</tr>

	<tr>
		<td colspan="3">
		<input type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" /> 
		<?php echo _REMEMBER_ME; ?>
		&nbsp;&nbsp;
		<input type="hidden" name="option" value="login" />
		<input type="submit" name="Submit" class="button" value="<?php echo _BUTTON_LOGIN; ?>" />

		<?php if ( $layout == 0) {?>
			<br />
			<?php if ( $registration_enabled ) {?>
				<a href="<?php echo $registerlink; ?>">
				<?php echo _CREATE_ACCOUNT; ?>
				</a>
				&nbsp;&nbsp;
			<?php }?>

			<a href="<?php echo $lostpasswordlink; ?>">
			<?php echo _LOST_PASSWORD; ?>
			</a>
		<?php }?>
		</td>
	</tr>
	</table>
	<?php }?>
	<input type="hidden" name="op2" value="login" />
	<input type="hidden" name="lang" value="<?php echo $mosConfig_lang; ?>" />
	<input type="hidden" name="return" value="<?php echo sefRelToAbs( $login ); ?>" />
	<input type="hidden" name="message" value="<?php echo $message_login; ?>" />
	</form>
	<?php
}
?>

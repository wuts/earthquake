<?php
/**
* @version $Id: mamhoo.html.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_mamhoo {

	function frontpage() {
?>
<div class="componentheading">
	<?php echo _WELCOME; ?>
</div> 

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="80%"><?php echo _WELCOME_DESC; ?></td>
		</tr>
	</table>
<?php
	}

  function lostPassForm($option) {
  ?>
  <div class="componentheading">
    <?php echo _PROMPT_PASSWORD; ?>
  </div>
  <form action="index.php" method="post">
  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
    <tr>
      <td colspan="2"><?php echo _NEW_PASS_DESC; ?></td>
    </tr>
    <tr>
      <td><?php echo _PROMPT_UNAME; ?></td>
      <td><input type="text" name="checkusername" class="inputbox" size="40" maxlength="25" /></td>
    </tr>
    <tr>
      <td><?php echo _PROMPT_EMAIL; ?></td>
      <td><input type="text" name="confirmEmail" class="inputbox" size="40" /></td>
    </tr>
    <tr>
      <td colspan="2"> <input type="hidden" name="option" value="<?php echo $option;?>" />
        <input type="hidden" name="task" value="sendNewPass" /> <input type="submit" class="button" value="<?php echo _BUTTON_SEND_PASS; ?>" /></td>
    </tr>
  </table>
  </form>
  <?php
  }


  function registerForm(&$mamhoo_configs, $option, $useractivation) {
  ?>
  <script language="javascript" type="text/javascript">
    function submitbutton() {
      var form = document.mosForm;
      var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

      // do field validation
      if (form.username.value == "") {
        alert( "<?php echo html_entity_decode(_REGWARN_UNAME);?>" );
      } else if (form.email.value == "") {
        alert( "<?php echo html_entity_decode(_REGWARN_MAIL);?>" );
      } else if (form.password.value.length < 6) {
        alert( "<?php echo html_entity_decode(_REGWARN_PASS);?>" );
      } else if (form.password2.value == "") {
        alert( "<?php echo html_entity_decode(_REGWARN_VPASS1);?>" );
      } else if ((form.password.value != "") && (form.password.value != form.password2.value)){
        alert( "<?php echo html_entity_decode(_REGWARN_VPASS2);?>" );
      } else if (r.exec(form.password.value)) {
        alert( "<?php printf( html_entity_decode(_VALID_AZ09), html_entity_decode(_REGISTER_PASS), 6 );?>" );

      <?php
      // form validation for mamhoo required fields
      foreach ( $mamhoo_configs as $mamhoo_config )
      {
        if ( $mamhoo_config->fieldrequired ) {
      ?>
      } else if (form.<?php echo $mamhoo_config->fieldname; ?>.value == "") {
        alert( "<?php echo $mamhoo_config->fieldlabel . _MAMHOO_ISREQUIRED; ?>" );
      <?php
        }
      }
      // end custom form validation
      ?>

      } else {
        form.submit();
      }
    }
  </script>

  <div class="componentheading">
    <?php echo _REGISTER_TITLE; ?>
  </div>
  <form action="index.php" method="post" name="mosForm">
  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
    <tr>
      <td colspan="2"><?php echo _REGISTER_REQUIRED; ?></td>
    </tr>
    <tr>
      <td><?php echo _REGISTER_UNAME; ?></td>
      <td><input type="text" name="username" size="40" value="" class="inputbox" />
      <span class="error"> * </span></td>
    </tr>
    <tr>
      <td><?php echo _REGISTER_EMAIL; ?></td>
      <td><input type="text" name="email" size="40" value="" class="inputbox" />
      <span class="error"> * </span></td>
    </tr>
    <tr>
      <td><?php echo _REGISTER_PASS; ?></td>
      <td><input class="inputbox" type="password" name="password" size="40" value="" />
      <span class="error"> * </span></td>
    </tr>
    <tr>
      <td><?php echo _REGISTER_VPASS; ?></td>
      <td><input class="inputbox" type="password" name="password2" size="40" value="" />
      <span class="error"> * </span></td>
    </tr>

    <!-- mamhoo -->
    <?php
    if ( count($mamhoo_configs) > 0) {
    ?>
    <tr>
      <td colspan="2" class="componentheading"><?php echo _MAMHOO_EXTENDED_DETAILS; ?></td>
    </tr>
    <?php
      // form field for mamhoo show fields
      foreach ( $mamhoo_configs as $mamhoo_config )
      {
        if ( $mamhoo_config->fieldshow ) {
          $aField = $mamhoo_config->fieldname;
          $aLabel = $mamhoo_config->fieldlabel;
    ?>
    <tr>
       <td><?php echo $aLabel; ?> </td>
       <td><input type="text" name="<?php echo $aField; ?>" class="inputbox" size="40" ">
       <span class="error"><?php if ($mamhoo_config->fieldrequired =="1") { echo " * "; } ?></span></td>
    </tr>
    <?php
        }
      }
    }
    ?>
    <!-- mamhoo -->
  </table>

  <input type="hidden" name="id" value="0" />
  <input type="hidden" name="gid" value="0" />
  <input type="hidden" name="useractivation" value="<?php echo $useractivation;?>" />
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="saveRegistration" />
  <input type="button" value="<?php echo _BUTTON_SEND_REG; ?>" class="button" onclick="submitbutton()" />
  </form>
  <?php
  }


  function userEdit(&$row, &$mamhoo_configs, $option,$submitvalue) {
  ?>
  <script language="javascript" type="text/javascript">
    function submitbutton() {
      var form = document.EditUser;
      var r = new RegExp("[^0-9A-Za-z]", "i");

      if (form.username.value == "") {
        alert( "<?php echo _REGWARN_UNAME;?>" );
      } else if (form.email.value == "") {
        alert( "<?php echo _REGWARN_MAIL;?>" );
      } else if ((form.password.value != "") && (form.password.value != form.verifyPass.value)){
        alert( "<?php echo _REGWARN_VPASS2;?>" );
      } else if (r.exec(form.password.value)) {
        alert( "<?php printf( _VALID_AZ09, _REGISTER_PASS, 4 );?>" );
      <?php
      // form validation for mamhoo required fields
      foreach ( $mamhoo_configs as $mamhoo_config )
      {
        if ( $mamhoo_config->fieldrequired ) {
      ?>
      } else if (form.<?php echo $mamhoo_config->fieldname; ?>.value == "") {
        alert( "<?php echo $mamhoo_config->fieldlabel . _MAMHOO_ISREQUIRED; ?>" );
      <?php
        }
      }
      // end custom form validation
      ?>
      } else {
        form.submit();
      }
  }
  </script>

  <div class="componentheading">
    <?php echo _EDIT_TITLE; ?>
  </div>
  <form action="index.php" method="post" name="EditUser">
  <table cellpadding="5" cellspacing="0" border="0" width="100%">
    <tr>
      <td colspan="2"><?php echo _REGISTER_REQUIRED; ?></td>
    </tr>
    <tr>
      <td><?php echo _UNAME; ?></td>
      <td><input class="inputbox" type="text" name="username" size="40" value="<?php echo $row->username;?>" />
      <span class="error"> * </span></td>
    </tr>
    <tr>
      <td><?php echo _EMAIL; ?></td>
      <td><input class="inputbox" type="text" name="email" size="40" value="<?php echo $row->email;?>" size="30" />
      <span class="error"> * </span></td>
    </tr>
    <tr>
      <td><?php echo _PASS; ?></td>
      <td><input class="inputbox" type="password" name="password" size="40" value="" /></td>
    </tr>
    <tr>
      <td><?php echo _VPASS; ?></td>
      <td><input class="inputbox" type="password" name="verifyPass" size="40" value="" /></td>
    </tr>

    <!-- mamhoo -->
    <?php
    if ( count($mamhoo_configs) > 0) {
    ?>
    <tr>
      <td colspan="2" class="componentheading"><?php echo _MAMHOO_DETAILS; ?></td>
    </tr>
    <?php
      // form field for mamhoo show fields
      foreach ( $mamhoo_configs as $mamhoo_config )
      {
        if ( $mamhoo_config->fieldshow ) {
          $aField = $mamhoo_config->fieldname;
          $aLabel = $mamhoo_config->fieldlabel;
    ?>
    <tr>
       <td width="80"><?php echo $aLabel; ?> </td>
       <td><input type="text" name="<?php echo $aField; ?>" class="inputbox" size="40" value="<?php echo $row->$aField;?>">
       <span class="error"><?php if ($mamhoo_config->fieldrequired =="1") { echo " * "; } ?></span></td>
    </tr>
    <?php
        }
      }
    }
    ?>
    <!-- mamhoo -->
  </table>

  <input type="hidden" name="id" value="<?php echo $row->id;?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>">
  <input type="hidden" name="task" value="saveUserEdit" />
  <input class="button" type="button" value="<?php echo $submitvalue; ?>" onclick="submitbutton()"/>
  </form>
  <?php
  }


  function confirmation() {
  ?>
  <table>
    <tr>
      <td class="componentheading"><?php echo _SUBMIT_SUCCESS; ?></td>
    </tr>
    <tr>
      <td><?php echo _SUBMIT_SUCCESS_DESC; ?></td>
    </tr>
  </table>
  <?php
  }


  function UserView( &$row, &$mamhoo_configs, $option ) {
  ?>
  <div class="componentheading">
    <?php echo _MAMHOO_DETAILS; ?>
  </div>
  <table cellpadding="5" cellspacing="0" border="0" width="100%">
	<tr>
	  <td width="80"><?php echo _REGISTER_UNAME; ?></td>
	  <td><?php echo $row->username; ?></td>
	</tr>
	<tr>
	  <td><?php echo _REGISTER_EMAIL; ?></td>
	  <td><?php echo $row->email; ?> </td>
	</tr>
	
	<!-- mamhoo -->
	<?php
	  // mamhoo User details
	  foreach ( $mamhoo_configs as $mamhoo_config )
	  {
	    if ( $mamhoo_config->fieldshow ) {
	      $aField = $mamhoo_config->fieldname;
	      $aLabel = $mamhoo_config->fieldlabel;
	?>
	<tr>
	   <td><?php echo $aLabel; ?> </td>
	   <td><?php echo $row->$aField;?> </td>
	</tr>
	<?php
	    }
	  }
	?>
	<!-- mamhoo -->
  </table>
  <?php
  }
}

############################################################################
?>
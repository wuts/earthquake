<?php
/**
* $Id: admin.mamhoo.html.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

class HTML_mamhoo {

	function showUsers( &$rows, $pageNav, $search, $option, $lists ) {
		global $mosConfig_offset;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="user">
			<?php echo _MAMHOO_USER_MANAGE;?>
			</th>
			<td>
			<?php echo _MAMHOO_FILTER;?>:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
			</td>
			<td width="right">
			<?php echo $lists['type'];?>
			</td>
			<td width="right">
			<?php echo $lists['logged'];?>
			</td>
		</tr>
		</table>
  <table class="adminlist">
    <tr>
      <th width="2%" class="title">
      <?php echo _MAMHOO_NB;?>
      </th>
      <th width="3%" class="title">
      <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
      </th>
      <th width="15%" class="title">
      <?php echo _MAMHOO_USERS_NAME;?>
      </th>
      <th width="10%" class="title">
      <?php echo _MAMHOO_USERS_USERNAME;?>
      </th>
      <th width="12%" class="title">
      <?php echo _MAMHOO_USERS_GROUP;?>
      </th>
      <th width="15%" class="title">
      <?php echo _MAMHOO_USERS_EMAIL;?>
      </th>
      <th width="15%" class="title">
      <?php echo _MAMHOO_USERS_REGISTER;?>
      </th>
      <th width="15%" class="title">
      <?php echo _MAMHOO_USERS_LAST;?>
      </th>
      <th width="8%" class="title">
      <?php echo _MAMHOO_USERS_LOG_IN;?>
      </th>
      <th width="5%" class="title">
      <?php echo _MAMHOO_USERS_ENABLED;?>
      </th>
    </tr>
    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++) {
      $row =& $rows[$i];
      $img = $row->block ? 'publish_x.png' : 'tick.png';
      $task = $row->block ? 'unblock' : 'block';
      $alt = $row->block ? _MAMHOO_USERS_ENABLED : _MAMHOO_USERS_BLOCKED;
      ?>
      <tr class="<?php echo "row$k"; ?>">
      <td>
      <?php echo $i+1+$pageNav->limitstart;?>
      </td>
      <td>
      <?php echo mosHTML::idBox( $i, $row->id ); ?>
      </td>
      <td>
      <a href="#edit" onClick="return listItemTask('cb<?php echo $i;?>','edit')">
      <?php echo $row->name; ?>
      </a>
      </td>
      <td>
      <?php echo $row->username; ?>
      </td>
      <td>
      <?php echo $row->groupname; ?>
      </td>
      <td>
      <a href="mailto:<?php echo $row->email; ?>">
      <?php echo $row->email; ?>
      </a>
      </td>
      <td>
      <?php echo mosFormatDate( $row->registerDate, "%Y-%m-%d %H:%M:%S" ); ?>
      </td>
      <td>
      <?php echo mosFormatDate( $row->lastvisitDate, "%Y-%m-%d %H:%M:%S" ); ?>
      </td>
      <td align="center">
      <?php echo $row->loggedin ? '<img src="images/tick.png" width="12" height="12" border="0" alt="" />': ''; ?>
      </td>
      <td align="center">
      <a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')">
      <img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
      </a>
      </td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
    </table>
    <?php echo $pageNav->getListFooter(); ?>

    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    </form>
<?php
  }


  function edituser( &$row, &$mamhoo_configs, &$contact, &$lists, $option, $uid ) {
		global $my, $acl;
		global $mosConfig_live_site;
		
    $canBlockUser = $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'user properties', 'block_user' );
    $canEmailEvents = $acl->acl_check( 'workflow', 'email_events', 'user', $acl->get_group_name( $row->gid, 'ARO' ) );
?>
  <script language="javascript" type="text/javascript">
    function submitbutton(pressbutton) {
      var form = document.adminForm;
      if (pressbutton == 'cancel') {
        submitform( pressbutton );
        return;
      }
      var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

      // do field validation
      if (trim(form.name.value) == "") {
        alert( "<?php echo _MAMHOO_USERS_NAME_MUST;?>" );
      } else if (form.username.value == "") {
        alert( "<?php echo _MAMHOO_USERS_USERNAME_MUST;?>" );
      } else if (trim(form.email.value) == "") {
        alert( "<?php echo _MAMHOO_USERS_EMAIL_MUST;?>" );
      } else if (form.gid.value == "") {
        alert( "<?php echo _MAMHOO_USERS_ASSIGN;?>" );
      } else if (trim(form.password.value) != "" && form.password.value != form.password2.value){
        alert( "<?php echo _MAMHOO_USERS_NO_MATCH;?>" );

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
        submitform( pressbutton );
      }
      return;
    }
  </script>

	<table class="adminheading">
	<tr>
		<th>
		<?php echo $row->id ? _MAMHOO_EDIT : _MAMHOO_NEW;?> <?php echo _MAMHOO_USERS_USERINFO;?>
		</th>
	</tr>
	</table>

  <form action="index2.php" method="POST" name="adminForm">
  <table width="100%" border="1">
    <tr>
      <td width="50%" valign="top">
        <table class="adminform" border="0">
        <tr>
          <th colspan="2">
          <?php echo _MAMHOO_CORE_DETAILS;?>
          </th>
        </tr>
        <tr>
          <td width="100">
          <?php echo _MAMHOO_USERS_NAME;?>:
          </td>
          <td width="85%">
          <input type="text" name="name" class="inputbox" size="40" value="<?php echo $row->name; ?>" />
          </td>
        </tr>
        <tr>
          <td>
          <?php echo _MAMHOO_USERS_USERNAME;?>:
          </td>
          <td>
          <input type="text" name="username" class="inputbox" size="40" value="<?php echo $row->username; ?>" />
          </td>
        <tr>
          <td>
          <?php echo _MAMHOO_USERS_EMAIL;?>:
          </td>
          <td>
          <input class="inputbox" type="text" name="email" size="40" value="<?php echo $row->email; ?>" />
          </td>
        </tr>
        <tr>
          <td>
          <?php echo _MAMHOO_USERS_PASS;?>:
          </td>
          <td>
          <input class="inputbox" type="password" name="password" size="40" value="" />
          </td>
        </tr>
        <tr>
          <td>
          <?php echo _MAMHOO_USERS_VERIFY;?>:
          </td>
          <td>
          <input class="inputbox" type="password" name="password2" size="40" value="" />
          </td>
        </tr>
        <tr>
          <td valign="top">
          <?php echo _MAMHOO_USERS_GROUP;?>:
          </td>
          <td>
          <?php echo $lists['gid']; ?>
          </td>
        </tr>
        <?php
        if ($canBlockUser) {
          ?>
          <tr>
            <td>
            <?php echo _MAMHOO_USERS_BLOCK;?>
            </td>
            <td>
            <?php echo $lists['block']; ?>
            </td>
          </tr>
          <?php
        }
        if ($canEmailEvents) {
          ?>
          <tr>
            <td>
            <?php echo _MAMHOO_USERS_SUBMI;?>
            </td>
            <td>
            <?php echo $lists['sendEmail']; ?>
            </td>
          </tr>
          <?php
        }
        if( $uid ) {
          ?>
          <tr>
            <td>
            <?php echo _MAMHOO_USERS_REG_DATE;?>
            </td>
            <td>
            <?php echo $row->registerDate;?>
            </td>
          </tr>
        <tr>
          <td>
          <?php echo _MAMHOO_USERS_VISIT_DATE;?>
          </td>
          <td>
          <?php echo $row->lastvisitDate;?>
          </td>
        </tr>
          <?php
        }
        ?>
        <tr>
          <td colspan="2">&nbsp;

          </td>
        </tr>
        </table>
      </td>
      <td width="50%" valign="top">
      	<table class="adminform" border="0">
		    <tr>
		      <th colspan="2"><?php echo _MAMHOO_EXTENDED_DETAILS; ?></th>
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
		       <td width="100"><?php echo $aLabel; ?> </td>
		       <td width="85%"><input type="text" name="<?php echo $aField; ?>" class="inputbox" value="<?php echo $row->$aField;?>">
		       &nbsp;&nbsp;<span class="error"><?php if ($mamhoo_config->fieldrequired =="1") { echo " * "; } ?></span></td>
		    </tr>
		      <?php
		        }
		      }
		      ?>
		
		    <tr>
		      <td>&nbsp;</td>
		      <td>&nbsp;</td>
		    </tr>
		  </table>
      </td>
    </tr>
    </table>

  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
   <input type="hidden" name="user_id" value="<?php echo $row->id; ?>" />
<?php  if (!$canEmailEvents) { ?>
  <input type="hidden" name="sendEmail" value="0" />
<?php } ?>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="" />

</form>
<script language="javascript" type="text/javascript">
    dhtml.cycleTab('tab1');
    </script>
<?php }


  function showAbout() {
  	global $mosConfig_absolute_path;
  	$Readmefile = $mosConfig_absolute_path . "/administrator/components/com_mamhoo/README_" . _LANGUAGE . ".txt";
  	if ( !file_exists ( $Readmefile ) ) {
  		$Readmefile = $mosConfig_absolute_path . "/administrator/components/com_mamhoo/README.txt";
  	}
?>
  <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td class="sectionname"><?php echo _MAMHOO_ABOUT; ?></td>
    </tr>
    <tr>
      <td>
        <pre><?php include ( $Readmefile ); ?></pre>
       </td>
    </tr>
  </table>
<?php
  }



  function Config( &$rows, $option ){
    global $customfields;
  ?>
  <table class="adminheading">
    <tr>
      <th><?php echo _MAMHOO_CONFIG; ?></th>
    </tr>
  </table>
  <form action="index2.php" method="POST" name="adminForm">
  <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
    <tr>
      <th width="20">#</th>
      <th width="100"><div align="center"><?php echo _MAMHOO_LABEL; ?></div></th>
      <th width="15%"><div align="center"><?php echo _MAMHOO_SHOW; ?></div></th>
      <th width="15%"><div align="center"><?php echo _MAMHOO_REQUIRED; ?></div></th>
      <th width="15%"><div align="center"><?php echo _MAMHOO_SIZE; ?></div></th>
      <th width="15%"><div align="center"><?php echo _MAMHOO_TYPE; ?></div></th>
      <th width="15%"><div align="center"><?php echo _MAMHOO_INITIAL; ?></div></th>
    </tr>

  <!-- ROW -->
  <?php
    for ($i = 1; $i <= $customfields; $i++) {
      if ( $i < 10 ) {
        $fieldname = "f0$i";
      }
      else {
        $fieldname = "f$i";
      }

      $id = $i;
      $fieldlabel = $fieldname;
      $fieldshow = 0;
      $fieldtype = '';
      $fieldrequired = 0;
      $fieldsize = 30;
      $fieldvalue = '';

      $rowcount = count( $rows );
      for ( $j = 0; $j < $rowcount; $j++ ) {
        if ( $rows[$j]->fieldname == $fieldname ) {
          $fieldlabel = $rows[$j]->fieldlabel;
          $fieldshow = $rows[$j]->fieldshow;
          $fieldtype = $rows[$j]->fieldtype;
          $fieldrequired = $rows[$j]->fieldrequired;
          $fieldsize = $rows[$j]->fieldsize;
          $fieldvalue = $rows[$j]->fieldvalue;
          break;
        }
      }
    ?>
    <tr>
       <td> <?php echo $id; ?>
         <input type="hidden" name="id<?php echo $id; ?>" value="<?php echo $id; ?>" />
         <input type="hidden" name="fieldname<?php echo $id; ?>" value="<?php echo $fieldname; ?>" />
       </td>
       <td><input name="fieldlabel<?php echo $id; ?>" type="text" class="inputbox" value="<?php echo $fieldlabel ?>"></td>
       <td>  <div align="center">
         <INPUT name="fieldshow<?php echo $id; ?>" TYPE="CHECKBOX" value="1" <?php if ($fieldshow == "1") { echo "checked"; }?>>
           </div>
       </td>
       <td>  <div align="center">
         <INPUT name="fieldrequired<?php echo $id; ?>" TYPE="CHECKBOX" value="1" <?php if ($fieldrequired == "1") { echo "checked"; }?>>
            </div>
        </td>
        <td><input name="fieldsize<?php echo $id; ?>" type="text" class="inputbox" value="<?php echo $fieldsize ?>"></td>
        <td> <div align="center">
          <input type="hidden" name="fieldtype<?php echo $id; ?>" value="<?php echo $fieldtype; ?>" />
          </div>
        </td>
        <td> <div align="center">
          <input type="hidden" name="fieldvalue<?php echo $id; ?>" value="<?php echo $fieldvalue; ?>" />
          </div>
        </td>
    </tr>
  <?php
    }
  ?>
    <!-- end row --><!-- ROW -->
  </table>

  <input type="hidden" name="option" value="com_mamhoo" />
  <input type="hidden" name="task" value="saveconfig" />
</form>
  <?php
  }
}

?>
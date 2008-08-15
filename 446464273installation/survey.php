<?php
/**
* @package Mambo Open Source
* @copyright (C) 2005 - 2006 Mambo Foundation Inc.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* Mambo was originally developed by Miro (www.miro.com.au) in 2000. Miro assigned the copyright in Mambo to The Mambo Foundation in 2005 to ensure
* that Mambo remained free Open Source software owned and managed by the community.
* Mambo is Free Software
*/ 

// Set flag that this is a parent file
define( "_VALID_MOS", 1 );

// Test to see if the user has submitted the survey
if (isset($_POST['submit'])) {

// Include common.php
require_once( 'common.php' );

// Collect the survey information
$name = mosGetParam( $_POST, 'name', '' );
$email = mosGetParam( $_POST, 'email', '' );
$company = mosGetParam( $_POST, 'company', '' );
$category = mosGetParam( $_POST, 'category', '' );
$security = mosGetParam( $_POST, 'security', '' );
$teammambo = mosGetParam( $_POST, 'teammambo', '' );
$comments = mosGetParam( $_POST, 'comments', '' );

// Check for user's name and a valid email address
if (empty($name) || empty($email) || (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))) {
   $response = 0;}
else {
   $response = 1;}

// Check to see if the user asked for a security distro subscription and process
if ($security && $response) {
$subject = "Mambo Installation - Security List Addition";
$message = "$name wants to signup for the Mambo security email list.  " 
           . "Here are the details of the installation survey:\n"
	   . "\n"
           . "Name: $name\n"
           . "Email: $email\n"
           . "Company: $company";

// OK lets send the security list email
mail('security@mambo-foundation.org', $subject, $message);
}

// Check to see if the user is interested in joining Team Mambo and process
if ($teammambo && $response) {
$subject = "Mambo Installation - Possible New Team Member";
$message = "$name is interested in being a member of Team Mambo.  " 
	   . "Here are the details of the installation survey:\n"
	   . "\n" 
           . "Name: $name\n"
           . "Email: $email\n"
           . "Company: $company";

//OK lets send the notice of interest
mail('membership@mambo-foundation.org', $subject, $message);
}

// Check to see if the user left any comments and process
if ($response && $comments) {
$subject = "Mambo Installation - User Comments";
$message = "$name left some comments on the installation survey.  " 
           . "Here are the comments:\n"
	   . "\n"
           . "Name: $name\n"
           . "Email: $email\n"
	   . "Category: $category\n"
           . "Company: $company\n"
           . "Comments: $comments";

// OK lets send the feedback email
mail('feedback@mambo-foundation.org', $subject, $message);
}

}
 
//Redirect user to the frontpage
Header('Location: ../index.php');

?> 

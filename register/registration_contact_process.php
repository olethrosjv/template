<?php

// Gets posted data from the HTML form fields and creates local variables. The items with the ' marks around them are the name values from the fields in the HTML form example above. Note, the first three variables are required for all email messages (as described above).

$EmailFrom = trim(stripslashes($_POST['email'])); 
$EmailTo = "joseph.vaughn1@pcc.edu";
$Subject = "Test";
$User = trim(stripslashes($_POST['name']));
$Age = trim(stripslashes($_POST['age'])); 
$ContactName = trim(stripslashes($_POST['contact-name'])); 
$ContactPhone = trim(stripslashes($_POST['contact-telephone']));
$Gender = trim(stripslashes($_POST['gender']));
$Registration = trim(stripslashes($_POST['registration']));
$Event = trim(stripslashes($_POST['event']));
$Accommodations = trim(stripslashes($_POST['accommodations']));
$current_date = date("Y-m-d"); // This date is created when the form is submitted.

// Instructor Note -- with variable names (above beginning with $), I usually used mixed case to distinguish them from the all lower case HTML input field names (the POST fields above). Variable names can be called anything, but cannot use spaces. For example, if you are pulling data from a name field in an HTML form, you may want to call the PHP variable $Name and if you are pulling data from a comments field, you may want to call the variable $Comments. 

// This section below validates the $EmailFrom (data from the Email From field) and $ContactPhone (data from the Telephone field).

// Instructor Note -- you should always validate at least one field you use from your form so your form doesn't get "Submit Spam" (in other words, people continuous clicking submit and spamming your email without sending data). Even if you are using Javascript or Spry validation, it's still a very good idea to do this. Javascript and Spry (which is also Javascript) can easily be bypassed if the user doesn't allow Javascript to be active through their browser -- and it can easily be turned off through most browser preferences. 

// The fields being validated here, from the form example above, are the email and telephone fields. Those must contain some form of data for the PHP to accept them, otherwise the error.html page is generated to the form user.

$validationOK=true;
if ($User=="") $validationOK=false;
if ($EmailFrom=="") $validationOK=false;
if ($Age=="") $validationOK=false;
if ($ContactName=="") $validationOK=false;
if ($ContactPhone=="") $validationOK=false;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
  exit;
}



// This section of PHP prepares the email body text. This is the fourth and final required element to compose and send an email message from a server-side script. 

$Body = "";
$Body .= "The entrant's name: ";
$Body .= $User;
$Body .= "\n";
$Body .= "The entrant's email: ";
$Body .= $EmailFrom;
$Body .= "\n";
$Body .= "The entrant's age: ";
$Body .= $Age;
$Body .= "\n";
$Body .= "The entrant's emergency contact name: ";
$Body .= $ContactName;
$Body .= "\n";
$Body .= "The entrant's emergency contact telephone number: ";
$Body .= $ContactPhone;
$Body .= "\n";
$Body .= "The entrant's gender identification: ";
$Body .= $Gender;
$Body .= "\n";
$Body .= "The entrant's registration status: ";
$Body .= $Registration;
$Body .= "\n";
$Body .= "The entrant's event is: ";
$Body .= $Event;
$Body .= "\n";
$Body .= "The entrant's special accommodations needed are: ";
$Body .= $Accommodations;
$Body .= "\n";

// Instructor Note -- The ".=" means to append to (added to) the previous variable. So there is only one $Body variable, and all the other parts are appended to that one. The "\n" means to place a hard return between these lines in the email message. If the "\n" weren't included, all the items would be run together on one long line.

// This is the sendmail function which send an email message from the server to the email address listed in the $EmailTo variable above.

$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");


// If the page validates and there are no errors in the PHP, this line redirect to ok.html page, which is the "success page" for the form submission.

if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=ok.html\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
}


?>
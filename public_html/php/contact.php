<?php
if (isset($_POST['submit'])){
  $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
      $email=$_POST['email'];
        $message=$_POST['message'];
          $userid=$_POST['userid'];
          $to="at2187338@gmail.com";
          $headers="reply-to:$email";
          $subject="Contact From ";
          $body= "Firstname:$firstname\n Lastname:$lastname\n Email:$email\n UserID:$userid \n Message: $message\n File:$file";


 mail($to,$subject,$body,$headers);

}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="/css/contact.css">
<head>
<title> Contact us</title>
<h1> Contact Us </h1>
</head>
<body>

  <div class="contact_box">
  <form id="contact" action="" method="post">
    <h4> Send Us A Message </h4>

    <fieldset>
      <input placeholder=" First Name" name="firstname" type="text" tabindex="1" required >
    </fieldset>

    <fieldset>
      <input placeholder=" Last Name"  name= "lastname" type="text" tabindex="2" required >
    </fieldset>

    <fieldset>
      <input placeholder=" Email Address" name="email" type="email" tabindex="3" required>
    </fieldset>

    <fieldset>
      <input placeholder="User name (if you have one)" name="userid" type="text" tabindex="5" >
    </fieldset>
    <fieldset>
      <textarea placeholder="Type your Message Here...." tabindex="6" name="message"required></textarea>
    </fieldset>

<fieldset>
       <input id ="drop"tabindex="7" type="file" name="file" multiple >
  </fieldset>


    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
</div>

</body>
</html>

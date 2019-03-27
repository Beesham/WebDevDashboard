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
          $body= "Firstname:$firstname\n Lastname:$lastname\n Email:$email\n UserID:$userid \n Message: $message\n";


 if (mail($to,$subject,$body,$headers)){
   header( "Location: success.html" );
 }
 else {
   header( "Location: error.html" );
 }

}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="contact.css">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<head>
<title> Contact us</title>
<h1> Contact Us </h1>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</head>
<body>

  <div class="menu">
  <a href="homepage.php">Home</a>
  <a href="mainpage.php"> Main</a>
  <a class="active" href="/php/contact.php">Contact</a>
  </div>

  <br>
  <div class="contact_box">
  <form id="contact" action="/php/contact.php" method="post">
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
      <div id="editor"></div>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" onclick="getMessage()">Submit</button>
    </fieldset>
  </form>
</div>

<textarea hidden name="message" id="message"></textarea>

<script> //initializing quillJS editor
  var toolbarOptions = [{'font':[]},
  {'size': ['small', false, 'large', 'huge']},
  'bold', 'italic', {'script': 'sub'}, {'script': 'super'},
  { 'indent': '-1'}, { 'indent': '+1' },
  {'background': []}, {'color': []}, {'align': []},
  'link', 'image', 'video'
  ];

  var quill = new Quill('#editor', {
    modules: {
      toolbar: toolbarOptions,

    },
    placeholder: 'Type your Message Here....',
    theme: 'snow'
  });
</script>

<script> //POST only works with textareas & majority of WYSIWYG editors use contenteditable divs
         //on submit button click, populate hidden textarea with contents of contenteditable div, which lets POST get message
  function getMessage(){
    var x = document.getElementById("editor").textContent;
    document.getElementById("message").textContent = x;
  }
</script>

</body>
</html>

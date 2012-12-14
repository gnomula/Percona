<?php
    /*

    Places where you need to change code are marked by FIXME comments. There also are some not
    marked defects and drawbacks in the code. Do as many fixes and improvements as you can. 
    Please be ready to explain why you choose certain solutions. Feel free to ask any questions to mauricio.stekl@percona.com or andrey.maksimov@percona.com.
    
    Create a new repository on Github/Bitbucket/Launchpad/etc with the php file attached. (Use your favorite 
    version control software Git/Mercurial/Bzr/etc)
    After you finish making the corrections, please commit the changes and share the repo with us.
    We will be reviewing the code on the following days.


    */
$err_str="";
$code_guessed = false;
//function for logging
function logWork($logMessage)
{
    $file_name = "test". date("Ymd") . ".audit.log";
          $fp = fopen($file_name ,"a");
         if($fp){
              fwrite($fp,$logMessage."\r\n");
              fclose($fp);
         } 

}
//function to send email
function sendMail($fromEmail, $fromName, $message)
  {
	$to      = 'nomula.geeta@gmail.com';
	$subject = 'New contact message from '.$fromName;
	$headers = 'From: noreply@email.com'."\r\n" .
	    'Reply-To: noreply@email.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
    $message = 'Email from '.$fromEmail. "\r\n".
               'Below is the message'. "\r\n".
                $message;
	
	if(!mail($to, $subject, $message, $headers))
        {
            $err_str="ERROR: Internal error. Please try again later";
            logWork("ERROR: Unable to send email to ".$to); 
        }
        else
            logWork ("INFO: Successfully sent email to ".$to);
        
  }

if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['message']))   
{
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $message = $_REQUEST['message'];
    if ($name) {
        if ($email) { 
            // // FIXME check existense of "@" sign
            // FIXME: do other necessary validations
            //        If everything looked ok, send the contact form content by email to a defined address
             //BONUS: PHP) add some very basic logging system;
       
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      sendMail($email, $name, $message);
    
} else {
    $err_str="this email address is not valid";
    logWork("ERROR: Invalid email address ".$email);
}
        }
    } 
    
}    
    if (!$code_guessed) {
?>
<!-- // ensure STRICT XHTML compliance -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">    
    <title>Task for Hire</title>
    <script scr="http://ajax.googleapis.com/ajax/libs/jquery/1.4.99/jquery.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="myjavascript.js"></script>
</head>
<body>
       <!--FIXME: Make this title change when switching between sections
            //  BONUS: CSS) use a nice font for this title. -->
   <h1 id="headername">Example</h1>   
   <div class="menu">
<!-- BONUS: CSS) make this an horizontal menu with rounded buttons ; JS) make the transition between sections look really nice
    -->
        <ul>
          <li><a onclick=toggle("about") href="#about">about</a>
          <li><a onclick=toggle("services") href="#services">services</a>
          <li><a onclick=toggle("customers") href="#customers">customers</a>
          <li><a onclick=toggle("contacts") href="#contacts">contacts</a>
        </ul>
    </div><br><br><br>
    
    <!-- BONUS: DESIGN/CSS) improve how the section contents looks-->
    <div id="about" class="hidden">Here you will more information about us</div>
    <div id="services" class="hidden">Here you will see list of services we provide</div>
    <div id="customers" class="hidden">Here you will see list of customers</div>
    <div id="contacts" class="hidden">
      <form id="form" method="post" action="">
        <p>
          <label for="name">Name:</label>
          <input name="name" id="name" type="text" maxlength="25" placeholder="Enter your Name" required>
        </p><br>
        <p>
          <label for="email">Email:</label>
          <input name="email" id="email" type="text" maxlength="25"  placeholder="Enter your Email" required>            
        </p><br>
        <p>
          <label for="message" vertical-align="top" >Message:</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <textarea name="message" id="message" col="75" rows="5"  maxlength="255" required></textarea>
        </p><br>         
           <input name="submit" id="submit" type="submit" value="send" align="center">         
       </form>
    </div><br>
<?php
    } // end $code_guessed 
 ?>
    <div id="error" class="hidden"><?php echo $err_str ?></div>
    <script>
        toggle('about');

        var obj = document.getElementById("error");
        if(obj.innerHTML!=null || obj.innerHTML!="")
            {
                obj.className="visible";
            }

    </script>
</body>
</html>

<!-- PHP Form validation and processing  -->
<?php
include('header.php');

ob_start();
if (session_status() === PHP_SESSION_NONE) session_start();
require 'core/pdo.php';
require('core/mail.php');
require 'PHP/octaValidate-PHP-main/src/Validate.php';


use Validate\octaValidate;

$db = new DatabaseClass();

//set configuration
$options = array(
     "stripTags" => true,
     "strictMode" => true
);
//create new instance
$myForm = new octaValidate('register', $options);
//define rules for each form input name
$valRules = array(
     "email" => array(
          ["R", "Your Email Address is required"],
          ["EMAIL", "Your Email Address is invalid!"]
     ),
     "fullName" => array(
          ["R", "Your full name is required"],
          ["ALPHA_SPACES", "full name must have spaces"]
     ),
     "pass" => array(
          ["R", "Your password is required"],
          ["PWD", "Password must contain a capital, lowercase and unique character or specail character"]
     ),
     "confirmPass" => array(
          ["R", "Your password is required"],
          ["EQUALTO", "pass", "password must equal to password",]
     ),
);
// validate the form //
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     //begin validation on form fields from $_POST array
     if ($myForm->validateFields($valRules, $_POST)) {

          // check if the email exists//
          $email = strtolower($_POST['email']);
          $result = $db->SelectOne("SELECT email FROM users WHERE email = :email", ['email' => $email]);

          //If $row is FALSE, then no row was returned.
          if ($result) {
               $_SESSION['error'] = 1;
               $_SESSION['errorMassage'] = "Email has been taken";
               $errMsg = array(
                    'register' => array(
                         'email' => 'Email has been taken'
                    )
               );
               print('<script>
                    document.addEventListener("DOMContentLoaded", function(){
                         showErrors(' . json_encode($errMsg) . ');
                    });</script>');
          } else {
               //process form data here //
               $fullName = $_POST['fullName'];
               $password = $_POST['pass'];
               $user_id = md5(time() . $email);

               $query = "INSERT INTO users (	user_id, fullName,	email, password)
               VALUES(:user_id, :fullname, :email, :password)";
               $data = [
                    'user_id' => $user_id,
                    'fullname' => $fullName,
                    'email' => $email,
                    'password' => $password,
               ];

               $result = $db->Insert($query, $data);
               if ($result) {
                    $_SESSION['auth'] = true;
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (40 * 60);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['fullName'] = $fullName;
                    $subject = "Thanks for signing up";
                    sendMail($email, $surname, $subject, str_replace(["##fullname##", "##username##", '##password##'], [$fullName, $username, $password], file_get_contents("welcom-email.php")));
                    header("Location:index.php");
                    exit();
               } else {
                    $_SESSION['error'] = 1;
                    $_SESSION['errorMassage '] = "Signup was not successful";
                    header("Location:signup.php");
                    exit();
               };
          };
     } else {
          //return errors

          print('<script>
               document.addEventListener("DOMContentLoaded", function(){
                    showErrors(' . json_encode($myForm->getErrors()) . ');
          });</script>');
     }
}
?>
<!-- Backend ends here -->

<div class="wrapper fadeInDown formSection">
     <div id="formContent">
          <!-- Tabs Titles -->

          <!-- Icon -->
          <div class="fadeIn first">
               <div class="site-logo">
                    <a href="index.html" class="js-logo-clone">Pharma</a>
               </div>
          </div>

          <!-- Login Form -->
          <form id="register" action="" method="post" autocomplete="off">
               <input type="email" id="email" class="fadeIn second" name="email" placeholder="email" value="<?php (isset($_POST) && isset($_POST['email'])) ? print($_POST['email']) : '' ?>">
               <input type="text" id="fName" class="fadeIn second" name="fullName" placeholder="Full-Name" value="<?php (isset($_POST) && isset($_POST['fullName'])) ? print($_POST['fullName']) : '' ?>">
               <input type="password" id="password" class="fadeIn third" name="pass" placeholder="password">
               <input type="password" id="password" class="fadeIn third" name="confirmPass" placeholder="Confirm your password">
               <input type="submit" class="fadeIn fourth mt-3" value="Log In"><br>
          </form>

          <!-- Remind Password -->
          <div id="formFooter">
               <a class="underlineHover" href="login.php">Login instead</a>
          </div>

     </div>
</div>



<?php

include("footer.php");

?>
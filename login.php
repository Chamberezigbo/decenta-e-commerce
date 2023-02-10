<?php
include('auth.php');

//check if session is started already
if (session_status() === PHP_SESSION_NONE)
     session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $email = trim($_POST['email']);
     $password = $_POST['password'];

     if ($email == "myadmin@admain.com" && $password == "admin12345") {
          $_SESSION['admin-auth'] = true;
          $_SESSION['start'] = time();
          $_SESSION['expire'] = $_SESSION['start'] + (40 * 60);
          header("Location:admin/");
          exit();
     } else {
          $result = $db->SelectOne("SELECT * FROM users WHERE email = :email", ['email' => $email]);
          if (($result)) {
               if ($password == $result['password']) {
                    $_SESSION['auth'] = true;
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (40 * 60);
                    $_SESSION["user_id"] = $result['user_id'];
                    $_SESSION["email"] = $result['email'];
                    $_SESSION["fullName"] = $result['fullName'];
                    print(
                    '<script>
                              setTimeout(() => {
                                   toastr.success("Welcome youve been logged in");
                                   console.log("Delayed for 1 second.");
                              },5000)
                              window.location = "index.php";
                         </script>');
               } else {
                    print('<script>
                                   document.addEventListener("DOMContentLoaded", function() {
                                   toastr.error("Wrong password",{timeOut: 5000});
                              })
                         </script>');
               }
          } else {
               print('<script>
                         document.addEventListener("DOMContentLoaded", function() {
                         toastr.error("Wrong password",{timeOut: 5000});    
                    })
               </script>');
          }
     }
}
?>

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
          <form autocomplete="off" action="" method="post">
               <input type="email" id="login" class="fadeIn second" name="email" placeholder="email" required>
               <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required>
               <input type="submit" class="fadeIn fourth mt-3" value="Log In"><br>
               <a href="signup.php">Dont have an account yet</a>
          </form>

          <!-- Remind Passowrd -->
          <div id="formFooter">
               <a class="underlineHover" href="#">Forgot Password?</a>
          </div>

     </div>
</div>


<?php
include('footer.php');
?>
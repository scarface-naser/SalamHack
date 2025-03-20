<?php
    if (@$_COOKIE['login'] == '1') {
      echo '
          <link href="style.css" rel="stylesheet" />
          <div class="session-message">
              <img width="250px" src="resources/img_logo/error_scarface (1).gif" />
              <p>Sorry, you are already logged in</p>
          </div>
          <meta http-equiv="refresh" content="0, url=index.php" />
      ';
      exit();
  }

    require "ai_style.php"; 
    global $home;
    mysqli_set_charset($home, 'utf8'); 

    @$post01 = $_POST['get01'];
    @$post02 = $_POST['get02'];
    @$post03 = $_POST['get03'];
    @$post04 = $_POST['get04'];
    $Welcome = "<p class='Greeting'> Welcome to our website  </p>";

    $Token = date("ymdhis");
    $RandomNumber = rand(100,200);
    $NewToken = $Token . $RandomNumber;
    

    if(isset($_POST['AddUser'])){
        if(empty($post01) || empty($post04)){
            $Error = '<p class="fillinput"> Please fill in all data  </p>';
            $Welcome = '';
        }else{
        
            $naser = "SELECT * FROM users WHERE user_name='$post01'";
            $Runnaser = mysqli_query($home, $naser);
            $Rownaser = mysqli_fetch_array($Runnaser);
            @$UserName = $Rownaser['user_name'];
            @$post01 = $_POST['get01'];

            $jamal = "SELECT * FROM users WHERE user_email='$post02'";
            $Runjamal = mysqli_query($home, $jamal);
            $Rowjamal = mysqli_fetch_array($Runjamal);
            @$EmailUser = $Rowjamal['user_email'];
            @$post02 = $_POST['get02'];

            if($post01 == $UserName){
                $Error = '<p class="message-already-haveacount"> Sorry, the name is already in use.  </p>';
                $Welcome = '';
            }elseif($post02 == $EmailUser){
                $Error = '<p class="message-already-haveacount"> Sorry, the password number is already in use. </p>';
                $Welcome = '';
            }else{
                $Insert = "INSERT INTO users
                    (
                        user_token,
                        user_name,
                        user_email,
                        user_phone,
                        user_pass
                    )VALUES
                    (
                        '$NewToken',
                        '$post01',
                        '$post02',
                        '$post03',
                        '$post04'
                    )
                ";
                if(mysqli_query($home, $Insert)){
                    
                    echo'
                        <link href="style.css" rel="stylesheet" />
                        <div class="session-message">
                            <img width="150px" src="resources/img_logo/done_scarface (2).gif" />
                            <p>Thank you <span style="color:cyan;">'.$post01.' </span> The account has been created</p>
                        </div>
                        <meta http-equiv="refresh" content="2, url=index.php" />
                    ';
                    exit();
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<div class="signup-container">
    <div class="signup-card">
        <h2 class="signup-title">Create an Account</h2><br/>
         <?php echo @$Welcome; echo @$Error; ?><br/>

        <form id="signup-form" action="" method="post">
            <div class="signup-input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="get01" id="signup-username" placeholder="Username" required autocapitalize="off">
            </div>

            <div class="signup-input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="get02" id="signup-email" placeholder="Email" required autocapitalize="off">
            </div>

            <div class="signup-input-group">
                <i class="fa-solid fa-phone"></i>
                <input type="text" name="get03" id="signup-phone" placeholder="Phone Number" required autocapitalize="off">
            </div>

            <div class="signup-input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="get04" id="signup-password" placeholder="Password" required autocapitalize="off">
            </div>

            <p id="signup-error-message" class="signup-error"></p>
            <div ><input name="AddUser" class="signup-btn" type="submit" value="Sign Up"/></div>
        </form>

        <div class="signup-divider">OR</div>

        <button class="signup-google-btn">
        <img src="resources\img_logo\Google_Icons.webp" 
        alt="Google Logo" class="login-google-icon"> Sign Up with Google
        </button>

        <p class="signup-footer">Already have an account? <a href="login.php">Log in</a></p>
    </div>
</div>

</body>
</html>

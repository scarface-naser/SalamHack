<?php
    if(@$_COOKIE['login'] == '1'){
        echo'
            <link href="style.css" rel="stylesheet" />
            <div class="session-message">
                <img width="250px" src="resources/img_logo/done_scarface (2).gif" />
                <p>Sorry, you are already logged in</p>
            </div>
            <meta http-equiv="refresh" content="5, url=index.php" />
        ';
        exit();
    }
    require "ai_style.php"; 
    global $home; 
    mysqli_set_charset($home, 'utf8'); 
    @$post01 = $_POST['get01'];
    @$post02 = $_POST['get02']; 
    $Welcome = "<p class='EnteremailTologin'>Please enter your email to log in.</p>";

    if(isset($_POST['login'])){
        if(empty($post01) ){
            $Error = '<p class="message-already-haveacount"> Please Enter your email correctly .</p>';
            $Welcome = "";
        }else{
            $naser = "SELECT * FROM users WHERE user_email='$post01'";
            $Runnaser = mysqli_query($home, $naser);
            if(mysqli_num_rows($Runnaser) > '0'){
                $Rownaser = mysqli_fetch_array($Runnaser);
                $UserEmail = $Rownaser['user_email'];
                $UserName = $Rownaser['user_name'];
                $pass = $Rownaser['user_pass'];
                $token = $Rownaser['user_token'];
                if( $UserEmail != $post01 ){
                    $Error = '<p class="message-already-haveacount"> Sorry, the Email is incorrect. </p>';
                    $Welcome = "";
                }else if($pass != $post02){
                  $Error = '<p class="message-already-haveacount"> Password dose not match </p>';
                  $Welcome = "";
                }  else{
                  
                    setcookie("Token",$token, time() + (86400), "/");
                    setcookie("nameuser",$UserName, time() + (86400), "/");
                    setcookie("login","1", time() + (86400), "/");
                    echo'
                        <meta http-equiv="refresh" content="0 , url=index.php" />
                    ';
                    exit();
                }
            }else{
                $Error = '<p class="message-already-haveacount"> Sorry, there is no account with this Email. </p>';
                $Welcome = '';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">Welcome Back</h2><br>
        <?php echo @$Welcome; echo @$Error; ?><br>

        <form id="login-form" action="" method="post">
            <div class="login-input-group">
                <i class="fa-solid fa-envelope"></i>
                <input name="get01" type="email" id="login-email" placeholder="Email" required autocomplete="off">
            </div>

            <div class="login-input-group">
                <i class="fa-solid fa-lock"></i>
                <input name="get02" type="password" id="login-password" placeholder="Password" required autocomplete="off">
            </div>
            <div><input name="login" class="login-btn"type="submit" value="Log in"/></div>
      
        </form>

        <div class="login-divider">OR</div>

        <button class="login-google-btn">
            <img src="resources\img_logo\Google_Icons.webp" 
                 alt="Google Logo" class="login-google-icon">
                 Login with Google
        </button>

        <p class="login-footer">Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</div>


</body>
</html>

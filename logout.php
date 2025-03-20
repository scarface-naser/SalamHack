<?php
    setcookie("Token", null, -1, "/");
    setcookie("nameuser", null, -1, "/");
    setcookie("login", null, -1, "/");
    echo '
    <link href="style.css" rel="stylesheet" />
    <div class="session-message">
        <img width="250px" src="resources/img_logo/delete.gif" />
        <p>Thank you, you are checked out</p>
    </div>
    <meta http-equiv="refresh" content="2, url=index.php" />
';
?>
<?php
  if(@$_COOKIE['login'] != '1'){
    echo'
        <link href="style.css" rel="stylesheet" />
        <div class="session-message">
            <img width="250px" src="Files/DrPHP_ErrorEnter.gif" />
            <p>Sorry, you need to log in</p>
        </div>
        <meta http-equiv="refresh" content="2, url=login.php" />
    ';
    exit();
}
require "ai_style.php";
global $home;
mysqli_set_charset($home, 'utf8');
if (isset($_COOKIE['Token']) && isset($_GET['category'])) {
  $user_token = $_COOKIE['Token'];
  $CategoryToken = $_GET['category'];
  $query = "SELECT * FROM tools WHERE  added_by_token ='$user_token' and category_token = '$CategoryToken'  ORDER BY tool_id DESC";
  $result = mysqli_query($home, $query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tools</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="tools_body">
  <header class="tools_header">
    <nav class="tools_nav">
      <a href="index.php">Home</a>
      <a href="dashboard.php">Category</a>
    </nav>
  </header>
  
  <h2 class="tools_category_header">Your AI Toll and Websites</h2>
  <div class="tools-grid">

  <?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="tool-card" data-tool="' . htmlspecialchars($row["tool_token"]) . '">
            <img src="resources/toolPictures/' . htmlspecialchars($row["tool_img"]) . '" alt="' . htmlspecialchars($row["tool_name"]) . '">
            <h3>' . htmlspecialchars($row["tool_name"]) . '</h3>
            <div class="tool_buttons">
                <a href="' . htmlspecialchars($row["tool_link"]) . '"  class="btn try-btn">Try it</a>
                <button class="btn remove-btn"><i class="fa-solid fa-trash"></i><span style="color:aqua; font-size:18px;"> Remove</span></button>
            </div>
        </div>
        ';
    }
} else {
    echo '<p style="color:white;">No Tools available.</p>';
}
?>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".remove-btn").forEach(button => {
        button.addEventListener("click", function () {
            let toolCard = this.closest(".tool-card");
            let toolToken = toolCard.getAttribute("data-tool");

          
            if (!confirm("Are you sure you want to delete this tool?")) return;

          
            let jsonData = JSON.stringify({
                tool_Token: toolToken
            });

            fetch("delete_tool.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: jsonData
            })
            .then(response => response.json())
            .then(data => { 
                if (data.success) {
                    toolCard.remove(); 
                } else {
                    alert("Error: " + data.message);
                }
            })    
            .catch(error => console.error("Error:", error));
        });
    });
});

  </script>
</body>

</html>
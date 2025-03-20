<?php
if (@$_COOKIE['login'] != '1') {
  echo '
        <link href="style.css" rel="stylesheet" />
        <div class="session-message">
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
  $query = "SELECT * FROM tools WHERE  is_public ='1' and category_token ='$CategoryToken'  ORDER BY tool_id DESC";
  $result = mysqli_query($home, $query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coding AI Tool</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="tools_body">
  <header class="tools_header">
    <nav class="tools_nav">
      <a href="index.php">Home</a>
      <a href="favorites.php">Your favorites</a>
      <a href="user_category.php">Your Categories</a>

    </nav>
  </header>

  <h2 class="tools_category_header">AI Toll and Websites</h2>
  <div class="tools-grid">
    <?php 
    // Loop through categories and display them
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="tool-card">
    <img src="resources/toolPictures/' . htmlspecialchars($row["tool_img"]) . '" alt="' . htmlspecialchars($row["tool_name"]) . '">
    <h3>' . htmlspecialchars($row["tool_name"]) . '</h3>
    <div class="tool_buttons">
    <a href="' . htmlspecialchars($row["tool_link"]) . '"  class="btn try-btn">Try it</a>
        
<button class="btn save-btn" 
     tool_token="' . htmlspecialchars($row['tool_token']) . '">
    <i class="fa-solid fa-bookmark"></i>
    <span style="color:aqua; font-size:18px;">Save</span>
</button>
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
    document.querySelectorAll(".save-btn").forEach(button => {
        button.addEventListener("click", function () {
            let toolToken = this.getAttribute("tool_token");
            console.log(toolToken)
            

            // Prepare JSON data
            let jsonData = JSON.stringify({
                tool_Token: toolToken
            });

            fetch("save_favorite.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: jsonData
            })
            .then(response => response.json())
            .then(data => { 
                if (data.success) {
                    this.innerHTML = '<i class="fa-solid fa-heart"></i> Saved';
                    this.classList.add("saved");
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
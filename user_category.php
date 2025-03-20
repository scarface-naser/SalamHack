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
if (isset($_COOKIE['Token']) && isset($_COOKIE['nameuser'])) {
  $user_token = $_COOKIE['Token'];
  $user_name = $_COOKIE['nameuser'];
  // Fetch categories added by admin (is_public = 1)
  $query = "SELECT * FROM categories WHERE is_public = 0 and created_by_token ='$user_token'  ORDER BY category_id DESC";
  $result = mysqli_query($home, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Categories</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
  <header class="user_category_header">
    <nav class="user_category_tools_nav">
      <a href="index.php">Home</a>
      <a href="add_category.php">Add Category</a>
      <a href="favorites.php">Favorites</a>
    </nav>
  </header>

  <br style="clear: both;" />
  <main>
    <section class="categories-section">
      <h2 class="section-title">Your Categories</h2>
      <div class="categories-container">
        
        <?php
        // Loop through categories and display them
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="category-card">
                  <img src="resources/categoryPictures/' . htmlspecialchars($row["category_img"]) . '" alt="' . htmlspecialchars($row["category_name"]) . '">
                  <h3>' . htmlspecialchars($row["category_name"]) . '</h3>
                  <p>' . htmlspecialchars($row["category_desc"]) . '</p>
                  <div class="category-actions">
                    <a href="user_tools.php?category=' . urlencode($row["category_token"]) . '" class="edit-btn">View Tools</a>
                    <a href="add_tool.php?category=' . urlencode($row["category_token"]) . '" class="add-btn">Add Tool</a>
                  </div>
                </div>';
            }
        } else {
            echo '<p style="color:white;">No categories available.</p>';
        }
        ?>
        
      </div>
    </section>
  </main>

</body>

</html>

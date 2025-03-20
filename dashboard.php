<?php
require "ai_style.php";
global $home;
mysqli_set_charset($home, 'utf8');


$query = "SELECT * FROM categories WHERE is_public = 1 ORDER BY category_id DESC";
$result = mysqli_query($home, $query);
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
    </nav>
  </header>

  <br style="clear: both;" />
  <main>
    <section class="categories-section">
      <h2 class="section-title">Admin Dashboard</h2>
      <div class="categories-container">
        
        <?php
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="category-card">
                  <img src="resources/categoryPictures/' . htmlspecialchars($row["category_img"]) . '" alt="' . htmlspecialchars($row["category_name"]) . '">
                  <h3>' . htmlspecialchars($row["category_name"]) . '</h3>
                  <p>' . htmlspecialchars($row["category_desc"]) . '</p>
                  <div class="category-actions">
                    <a href="adminTools.php?category=' . urlencode($row["category_token"]) . '" class="edit-btn">View Tools</a>
                    <a href="add_tool.php?category=' . urlencode($row["category_token"]) . '" class="add-btn">Add Tool</a>
                  </div>
                </div>';
            }
        } else {
            echo "<p>No categories available.</p>";
        }
        ?>
        
      </div>
    </section>
  </main>

</body>

</html>

<?php
require "ai_style.php";
mysqli_set_charset($home, 'utf8');

if (!isset($_COOKIE['Token'])) {
    echo "You must be logged in to view favorites.";
    exit();
}

$user_token = $_COOKIE['Token'];
$query = "SELECT tools.* FROM favorites
          JOIN tools ON favorites.tool_token = tools.tool_token
          WHERE favorites.user_token = '$user_token'";
$result = mysqli_query($home, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Tools</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="tools_body">
  <header class="tools_header">
    <nav class="tools_nav">
      <a href="index.php">Home</a>
      <a href="user_category.php">Category</a>
    </nav>
  </header>
  
  <h2 class="tools_category_header">Saved Websites</h2>
  <div class="tools-grid">
  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="tool-card">
            <img src="resources/toolPictures/<?php echo $row['tool_img']; ?>" alt="<?php echo $row['tool_name']; ?>">
            <h3><?php echo $row['tool_name']; ?></h3>
            <p><?php echo $row['tool_desc']; ?></p>
            <div class="tool_buttons">
                <a href="<?php echo $row['tool_link']; ?>" class="btn try-btn">Try Now</a>
                <button class="btn remove-btn" tool_token="<?php echo $row['tool_token']; ?>">
                    <i class="fa-solid fa-trash"></i>
                    <span style="color:aqua; font-size:18px;">Remove</span>
                </button>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align: center; color: gray; font-size: 18px;">No tools added to favorites.</p>
<?php endif; ?>

    </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".remove-btn").forEach(button => {
        button.addEventListener("click", function () {
            let toolToken = this.getAttribute("tool_token");

      
            let jsonData = JSON.stringify({
                tool_Token: toolToken
            });

            fetch("remove_favorite.php", { 
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: jsonData
            })
            .then(response => response.json())
            .then(data => { 
                if (data.success) {
                    this.closest(".tool-card").remove(); // 🔹 Remove the tool from the page
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

<?php
require "ai_style.php";
global $home;
mysqli_set_charset($home, 'utf8');

if (isset($_COOKIE['Token']) && isset($_COOKIE['nameuser'])) {
  $user_token = $_COOKIE['Token'];
  $user_name = $_COOKIE['nameuser'];
  $naser = "SELECT * FROM users WHERE user_token='$user_token' AND user_name='$user_name'";
  $Runnaser = mysqli_query($home, $naser);
  if (mysqli_num_rows($Runnaser) > '0') {
    $Rownaser = mysqli_fetch_array($Runnaser);
    $Useradmin = $Rownaser['is_admin'];
  }
} else {
  $user_name = "Guest";
  $user_email = "";
}

$query = "SELECT * FROM categories WHERE is_public = 1 ORDER BY category_id DESC";
$result = mysqli_query($home, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Directory</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">





</head>

<body>
  <header>
    <div class="header_logo_name">
      <img src="resources/img_logo/logoDone-removebg-preview.png" alt="Logo" class="logo">
      <h2 class="logo_name">HANG IT</h2>
    </div>

    <nav>
    
      <div class="header_search-container">
      <input type="text" id="search-bar" placeholder="Search" class="search-input" />
        <i class="bi bi-search search-icon"></i>
      </div>

    
      <ul class="nav-links">
        <?php
        if (@$Useradmin == '0101') {
          echo '<li><a href="dashboard.php">Dashboard</a></li>';
        }
        ?>
        <li><a href="#explore">Categories</a></li>
        <li><a href="user_category.php">Favorite</a></li>
        <li><a href="#ainews">AI News</a></li>
        <?php
        if (@$_COOKIE['login'] == 1) {
          echo '<li><a href="logout.php">Log out </a></li>';
        } else {
          echo '<li><a href="login.php"> Log in </a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>

  <br style="clear: both;" />

  <section class="Naser_section">
    <div class="left_opacity">
      <div class="video_div">
        <video autoplay muted loop>
          <source src="resources/img_logo/section_video.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
    <div class="right_opacity">
      <h1>Discover the Best AI Tools in One Place!</h1>
      <p>
        Explore a curated collection of AI-powered applications designed to boost productivity, creativity, and efficiency.
        Save your favorite tools, contribute by adding missing ones, and stay ahead with the latest AI innovations.
      </p>
      <a href="#explore" class="browse-btn">Browse it now</a>
    </div>
  </section>

  <main>
    <section class="categories-section">
      <h2 class="section-title" id="explore">Explore AI Tool Categories</h2>
      <div class="categories-container">


        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '
             <div class="category-card">
               <img src="resources/categoryPictures/' . htmlspecialchars($row["category_img"]) . '" alt="' . htmlspecialchars($row["category_name"]) . '">
               <h3>' . htmlspecialchars($row["category_name"]) . '</h3>
               <p>' . htmlspecialchars($row["category_desc"]) . '</p>
               <a href="tools.php?category=' . urlencode($row["category_token"]) . '" class="edit-btn">Explore</a>
             </div> ';
          }
        } else {
          echo "<p>No categories available.</p>";
        }
        ?>
      </div>
    </section>
  </main>
  <section id="ai-news">
    <h2 id="ainews">Latest AI News</h2>
    <div class="news-container" id="news-container">
      <!-- AI news articles will be dynamically loaded here -->
    </div>
  </section>





  <footer>
    <div class="footer-bottom">
      <p>© 2025 Scarface Group | All rights reserved.</p>
    </div>
  </footer>



  <div id="chat-icon">
    💬
  </div>

  <div id="chat-container">
    <div id="chat-header">
      <span>AI Chatbot</span>
      <button id="close-chat">✖</button>
    </div>
    <div id="chat-box">
      <div class="chat-message bot">Hello! Ask me anything.</div>
    </div>
    <input type="text" id="user-input" placeholder="Type your message..." />
    <button id="send-btn">Send</button>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const chatIcon = document.getElementById("chat-icon");
      const chatContainer = document.getElementById("chat-container");
      const closeChat = document.getElementById("close-chat");
      const sendButton = document.getElementById("send-btn");
      const userInput = document.getElementById("user-input");
      const chatBox = document.getElementById("chat-box");

      
      chatIcon.addEventListener("click", function() {
        chatContainer.style.display = "flex";
        chatIcon.style.display = "none";
      });

      
      closeChat.addEventListener("click", function() {
        chatContainer.style.display = "none";
        chatIcon.style.display = "block"; 
      });

      
      sendButton.addEventListener("click", function() {
        let userMessage = userInput.value.trim();
        if (userMessage === "") return;

        
        chatBox.innerHTML += `<div class="chat-message user">${userMessage}</div>`;
        userInput.value = ""; 

      
        fetch("chatbot.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({
              message: userMessage
            })
          })
          .then(response => response.json())
          .then(data => {
          
            chatBox.innerHTML += `<div class="chat-message bot">${data.reply}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight;
          })
          .catch(error => console.error("Error:", error));
      });

    
      userInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
          sendButton.click();
        }
      });
    });
  </script>

  <!-- for ai news -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const newsContainer = document.getElementById("news-container");
      const API_KEY = "45dd6fb9677d435c9370aa4f71fe86f0"; 
      const NEWS_URL = `https://newsapi.org/v2/everything?q=artificial-intelligence&language=en&sortBy=publishedAt&apiKey=${API_KEY}`;

      fetch(NEWS_URL)
        .then(response => response.json())
        .then(data => {
          newsContainer.innerHTML = "";
          data.articles.slice(0, 6).forEach(article => {
            const defaultImage = "resources/img_logo/new_ai.jpeg";

            let imageUrl = article.urlToImage ? article.urlToImage : defaultImage;

            if (article.title && article.description) {
              let newsItem = document.createElement("div");
              newsItem.classList.add("news-card");
              newsItem.innerHTML = `
                        <img src="${imageUrl}" alt="News Image" onerror="this.onerror=null; this.src='${defaultImage}';">
                        <h3>${article.title}</h3>
                        <p>${article.description.length > 100 ? article.description.substring(0, 100) + "..." : article.description}</p>
                        <a href="${article.url}" target="_blank">Read more</a>
                    `;
              newsContainer.appendChild(newsItem);
            }
          });
        })
        .catch(error => console.error("Error fetching AI news:", error));
    });


  </script>





</body>

</html>
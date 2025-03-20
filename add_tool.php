<?php
require "ai_style.php";
global $home;
mysqli_set_charset($home, 'utf8');
session_start();
if (!isset($_COOKIE['Token']) || !isset($_COOKIE['nameuser'])) {
  die("Error: You must be logged in to add a category.");
}
@$user_token = $_COOKIE['Token'];
@$user_name = $_COOKIE['nameuser'];
// Check if user is an admin
$naser = "SELECT * FROM users WHERE user_token='$user_token' AND user_name='$user_name'";
$Runnaser = mysqli_query($home, $naser);
if (mysqli_num_rows($Runnaser) > 0) {
  $Rownaser = mysqli_fetch_array($Runnaser);
  $Useradmin = $Rownaser['is_admin'];
  $is_public = ($Useradmin == '0101') ? 1 : 0;
} else {
  die("Error: Unauthorized user.");
}


@$ToolName = $_POST['ToolName'];
@$ToolUrl = $_POST['Url'];
@$ToolDescription = $_POST['description'];
@$CategoryToken = $_GET['category'];
$TimeNow = date('Y-m-d');
$Token = date("ymdhis");
$RandomNumber = rand(100, 200);
$NewToken = $Token . $RandomNumber;

// to upload an image
$u_img2 = @$_FILES['show_img2']['name'];
$u_img_tmp2 = @$_FILES['show_img2']['tmp_name'];
$target_dir = "resources/toolPictures/";
@$target_file2 = $target_dir . basename($_FILES["show_img2"]["name"]);
$imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
$uploadOk = 1;
@$newimgproblem2 = uniqid('naser-', true)
  . '.' . strtolower(pathinfo($_FILES['show_img2']['name'], PATHINFO_EXTENSION));



if (isset($_POST['AddTool'])) {
  if (empty($ToolUrl) ) {
    $Error = '<p style="color:white;">Please fill in all data</p>';
  } else {
    if ($imageFileType2 != "" && $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "gif" && $imageFileType2 != "pdf") {
      $Error = "<p class='style09'> Please select the allowed extension.</p>";
      # Set upload check to 0.
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      // wrong message
      $Error = "<p class='style09'>Sorry, no product images have been added.</p>";
    }
    if ($uploadOk == 1) {
      move_uploaded_file($u_img_tmp2, "resources/toolPictures/$newimgproblem2");
      # Check size image, number in bit.
      if ($_FILES["show_img2"]["size"] > 500000) {
        # IF Image png type.
        if ($imageFileType2 == "png") {
          # Read images to Resize it.
          function aborahaf($filename, $percent)
          {
            list($width, $height) = getimagesize($filename);
            $newwidth = $width * $percent;
            $newheight = $height * $percent;
            @$thumb = imagecreatetruecolor($newwidth, $newheight);
            @$source = imagecreatefrompng($filename);
            // preserve transparency START
            imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
            // preserve transparency end
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagepng($thumb, $filename);
          }
          # location images, Resize images to half 0.5.
          @aborahaf('resources/toolPictures/' . $newimgproblem2, 0.5);
        }
        # IF Image gif type.
        if ($imageFileType2 == "gif") {
          # Read images to Resize it.
          function aborahaf($filename, $percent)
          {
            list($width, $height) = getimagesize($filename);
            $newwidth = $width * $percent;
            $newheight = $height * $percent;
            @$thumb = imagecreatetruecolor($newwidth, $newheight);
            @$source = imagecreatefromgif($filename);
            // preserve transparency START
            imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
            // preserve transparency end
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagegif($thumb, $filename);
          }
          # location images, Resize images to half 0.5.
          @aborahaf('resources/toolPictures/' . $newimgproblem2, 0.5);
        }
        # IF Image jpg type or jpeg type.
        if ($imageFileType2 == "jpg" || $imageFileType2 == "jpeg") {
          # Read images to Resize it.
          function aborahaf($filename, $percent)
          {
            list($width, $height) = getimagesize($filename);
            $newwidth = $width * $percent;
            $newheight = $height * $percent;
            @$thumb = imagecreatetruecolor($newwidth, $newheight);
            @$source = imagecreatefromjpeg($filename);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg($thumb, $filename);
          }
          # location images, Resize images to half 0.5.
          @aborahaf('resources/toolPictures/' . $newimgproblem2, 0.5);
        }
      }
    }
    $naser = "INSERT INTO tools
          (
          tool_token,
          tool_name,
          category_token,
          tool_desc	,
          tool_img,
          tool_link,
          added_by_token,
          is_public
          )VALUES(
              '$NewToken',
              '$ToolName',
              '$CategoryToken',
              '$ToolDescription',
              '$newimgproblem2',
              '$ToolUrl',
              '$user_token',
              '$is_public'

          )";
    if (mysqli_query($home, $naser)) {
      echo '
                      <link href="style.css" rel="stylesheet" />
                      <div class="session-message">
                          <p>Thank you, the tool has been added successfully</p>
                      </div>
                      <meta http-equiv="refresh" content="2, url=' . ($Useradmin == '0101' ? 'dashboard.php' : 'user_category.php') . '" />
                  ';
      exit();
    }
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Tool</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css"> 

</head>

<body>

  <header class="useraddtool-header">
    <nav>
      <a href="index.php">Home</a>
      <a href="add_category.php">Add Category</a>
      <?php
      if (@$Useradmin == '0101') {
        echo '<a href="dashboard.php">Dashboard</a>';
      }
      ?>
    </nav>
  </header>

  <div class="useraddtool-container">
    <div class="useraddtool-card">
      <br>
      <form id="useraddtool-form" action="" method="post" enctype="multipart/form-data">
        <br>
        <?php echo @$Error; ?>
        <br>
        <div class="useraddtool-upload-container" id="useraddtool-drop-area">
          <input id="useraddtool-tool-image" type="file" name="show_img2" autocomplete="0ff" accept="image/*" hidden />
          <label for="useraddtool-tool-image" class="useraddtool-upload-box">
            <p>Upload Image</p>
            <span style="margin-top: 5px; font-size:14px;">Or drop a file</span>
          </label>
        </div>
        <div class="useraddtool-input-group">
          <i class="fa-solid fa-file-signature"></i>
          <input type="text" name="ToolName" id="useraddtool-tool-name" placeholder="Tool Name" required>
        </div>

        <div class="useraddtool-input-group">
          <i class="fa-solid fa-link"></i>
          <input type="url" name="Url" id="useraddtool-tool-url" placeholder="URL" required>
        </div>

        <div class="useraddtool-input-group">
          <i class="fa-solid fa-audio-description"></i>
          <textarea id="useraddtool-tool-description" name="description" placeholder="Description" required></textarea>
        </div>
        <input name="AddTool" class="useraddtool-add-btn" type="submit" value="Add Tool" />
      </form>
    </div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById("useraddtool-tool-image");
    const dropArea = document.getElementById("useraddtool-drop-area");
    const uploadBox = dropArea.querySelector(".useraddtool-upload-box"); 

    fileInput.addEventListener("change", function() {
      if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function(event) {
          uploadBox.innerHTML = ""; 

        
          const img = document.createElement("img");
          img.src = event.target.result;
          img.classList.add("useraddtool-image-preview"); 
          img.style.width = "100%";
          img.style.height = "100%";
          img.style.objectFit = "cover"; 
          img.style.borderRadius = "5px";

          uploadBox.appendChild(img);
        };

        reader.readAsDataURL(file);
      }
    });
  });
</script>
</body>

</html>
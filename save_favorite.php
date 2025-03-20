<?php
header("Content-Type: application/json");
require "ai_style.php";
mysqli_set_charset($home, 'utf8');

if (!isset($_COOKIE['Token'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit();
}

$user_token = $_COOKIE['Token'];

$data = json_decode(file_get_contents("php://input"), true);
$tool_token = isset($data['tool_Token']) ? mysqli_real_escape_string($home, $data['tool_Token']) : '';

if (empty($tool_token)) {
    echo json_encode(["success" => false, "message" => "Invalid tool"]);
    exit();
}

$checkQuery = "SELECT * FROM favorites WHERE user_token='$user_token' AND tool_token='$tool_token'";
$checkResult = mysqli_query($home, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo json_encode(["success" => false, "message" => "Already saved"]);
    exit();
}

$query = "INSERT INTO favorites (user_token, tool_token) VALUES ('$user_token', '$tool_token')";
if (mysqli_query($home, $query)) {
    echo json_encode(["success" => true, "message" => "Tool saved"]);
} else {
    echo json_encode(["success" => false, "message" => "Database error"]);
}
?>

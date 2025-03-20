<?php
require "ai_style.php";
mysqli_set_charset($home, 'utf8');

if (!isset($_COOKIE['Token'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit();
}

$user_token = $_COOKIE['Token'];


$data = json_decode(file_get_contents("php://input"), true);
$tool_token = isset($data['tool_Token']) ? mysqli_real_escape_string($home, $data['tool_Token']) : '';

if (!$tool_token) {
    echo json_encode(["success" => false, "message" => "Invalid tool"]);
    exit();
}


$checkQuery = "SELECT * FROM tools WHERE tool_token='$tool_token' AND added_by_token='$user_token'";
$checkResult = mysqli_query($home, $checkQuery);

if (mysqli_num_rows($checkResult) == 0) {
    echo json_encode(["success" => false, "message" => "You do not have permission to delete this tool"]);
    exit();
}


$deleteQuery = "DELETE FROM tools WHERE tool_token='$tool_token'";
if (mysqli_query($home, $deleteQuery)) {
    echo json_encode(["success" => true, "message" => "Tool deleted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Database error"]);
}
?>

<?php
header("Content-Type: application/json");

$api_key = "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"; 


$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data["message"])) {
    echo json_encode(["reply" => "Error: No message provided"]);
    exit();
}
$user_input = $data["message"];


$payload = json_encode([
  "inputs" => "You are an AI assistant. Answer questions concisely and accurately. 
               If asked about AI tools, provide real website links. 
               Do NOT include personal experiences or casual conversation. 
               User: $user_input"
]);


$ch = curl_init("https://api-inference.huggingface.co/models/mistralai/Mistral-7B-Instruct-v0.1");


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $api_key,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$max_retries = 3;  
$retry_delay = 5; 

for ($attempt = 1; $attempt <= $max_retries; $attempt++) {
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($http_code == 200) {
        break; 
    }

    if ($attempt < $max_retries) {
        sleep($retry_delay); 
    }
}

curl_close($ch);



if ($http_code !== 200) {
    echo json_encode(["reply" => "Error: API Request Failed (HTTP Code: $http_code)", "response" => $response]);
    exit();
}

$response_data = json_decode($response, true);


if (!isset($response_data[0]["generated_text"])) {
    echo json_encode(["reply" => "Error: Invalid API response", "api_response" => $response_data]);
    exit();
}

$full_reply = $response_data[0]["generated_text"] ?? "Sorry, I couldn't process your request.";


if (strpos($full_reply, 'User:') !== false) {
    $reply_parts = explode("User:", $full_reply);
    $reply = trim(end($reply_parts)); 
} else {
    $reply = trim($full_reply);
}


$reply = str_replace(["AI:", "Chatbot:"], "", $reply);
$reply = trim($reply) ?: "I couldn't understand that. Please ask again!";

echo json_encode(["reply" => $reply]);
exit();





?>
<?php

// Load configuration file (contains API keys)
$config = require __DIR__ . '/config.php';

// Read JSON input sent from frontend
$data = json_decode(file_get_contents("php://input"), true);

// Extract and trim the pasted code
$code = trim($data['code'] ?? '');

// Stop execution if no code is provided
if ($code === '') {
    exit("No code provided");
}

// Get Mistral API key from config
$apiKey = $config['MISTRAL_API_KEY'] ?? null;

// Stop execution if API key is missing
if (!$apiKey) {
    exit("API key not configured");
}

// Prompt sent to the AI model
$prompt = <<<PROMPT
You are a senior software engineer.

Tasks:
1. Explain the following code in simple English (2–4 sentences).
2. List the key parts of the code (functions, loops, conditions).
3. Mention time and space complexity if clearly detectable.
4. If unsure, say so clearly and do not hallucinate.

Code:
$code
PROMPT;

// Request payload for Mistral API
$postData = [
    "model" => "mistral-small",
    "messages" => [
        ["role" => "user", "content" => $prompt]
    ]
];

// Initialize cURL request
$ch = curl_init("https://api.mistral.ai/v1/chat/completions");

// Configure cURL options
curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($postData),
    CURLOPT_RETURNTRANSFER => true
]);

// Execute API request
$response = curl_exec($ch);

// Handle cURL errors
if ($response === false) {
    exit("cURL Error: " . curl_error($ch));
}

// Close cURL connection
curl_close($ch);

// Decode AI response
$result = json_decode($response, true);

// Output explanation text or fallback message
echo $result['choices'][0]['message']['content']
     ?? "Unable to generate explanation at this time.";

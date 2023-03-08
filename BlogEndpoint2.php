<?php
$id = $_GET['id'] ?? null;

if (!$id) {
  http_response_code(400);
  die("Post ID is required");
}

$file = "filestore/text{$id}.json";
if (!file_exists($file)) {
  http_response_code(404);
  die("Post not found");
}
$data = json_decode(file_get_contents($file), true);

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  parse_str(file_get_contents('php://input'), $requestBody);


  if (isset($requestBody['comment'])) {
    $data['comment'] = $requestBody['comment'];
    $data['date'] = date('Y-m-d H:i:s');
    file_put_contents($file, json_encode($data));
    http_response_code(200);
    die("Post updated successfully");
  } else {
    http_response_code(400);
    die("Comment is required");
  }
}

header('Content-Type: application/json');
echo json_encode($data);

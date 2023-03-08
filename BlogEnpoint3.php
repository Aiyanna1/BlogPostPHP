<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  
  $commentId = $_POST['id'] ?? '';
  
 
  if (!empty($commentId)) {
    
    $filePath = 'filestore/text.json' . $commentId . '.json';
    
    
    if (file_exists($filePath)) {
      
      
      unlink($filePath);
      
      
      $metadata = json_decode(file_get_contents('filestore/metadata.json'), true) ?? [];
      
      if (($key = array_search($filePath, $metadata)) !== false) {
        unset($metadata[$key]);
      } 
      file_put_contents('filestore/metadata.json', json_encode($metadata));
      http_response_code(200);
      echo json_encode(array('message' => 'Comment deleted successfully.'));
      
    } else { 
      http_response_code(404);
      echo json_encode(array('message' => 'Comment not found.'));
    }
  } else {
    http_response_code(400);
    echo json_encode(array('message' => 'Comment ID is required.'));
  }
} else {
  http_response_code(405);
  echo json_encode(array('message' => 'Method not allowed.'));
}

?>

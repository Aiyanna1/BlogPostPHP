<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') { //checks if the method used is the Post method
  $commentId = $_POST['id'] ?? '';  // This will get the ID of the coment from the request parameter
  
  if (!empty($commentId)) {  //sees if comment ID is a valid ID
    $filePath = 'filestore/text.json' . $commentId . '.json'; // this creates a path to the file that contains the comment
    
    if (file_exists($filePath)) {  // if the file exists
      unlink($filePath);  // if exists this will delete the file
      $metadata = json_decode(file_get_contents('filestore/metadata.json'), true) ?? [];//This will get the metadata
       if (($key = array_search($filePath, $metadata)) !== false) { //This will remove the comment file name from the metadata
        unset($metadata[$key]);
      } 
      file_put_contents('filestore/metadata.json', json_encode($metadata)); //This will save the new metadata file
      http_response_code(200);
      echo json_encode(array('message' => 'Comment deleted successfully.'));//and will then send a success message
      
    } else { 
      http_response_code(404);
      echo json_encode(array('message' => 'Comment not found.')); //if above not available or the comment ID doesnt exist, it will give this error message
    }
  } else {
    http_response_code(400);
    echo json_encode(array('message' => 'Comment ID is required.'));//If the person didnt enter the comment ID this error message will appear
  }
}

?>

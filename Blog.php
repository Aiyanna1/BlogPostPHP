<?php

$Username = trim($_POST['uname']) ?? '';
$Usernames = ['Aiyanna', 'Annery', 'Kondwani'];
$Comment = $_POST['comment'] ?? '';


if (in_array($Username, $Usernames)){
    echo "Thank you $Username, your comment has been submitted.";
} else {
    die ('Please sign up to leave a comment.');
}

$data = [
    'uname' => $Usernames,
    'comment' => $Comment,
    'date' => date('Y-m-d H:i:s'),
    'id' => time()
];


$file = fopen('filestore/text'.$data['id'].'.json', 'w');

fwrite($file, json_encode($data));

fclose($file);

$metadata = json_decode(file_get_contents('filestore/metadata.json'), true)??[];
array_push($metadata, 'filestore/text'.$data['id'].'.json');
file_put_contents('filestore/metadata.json', json_encode($metadata));  // this whole thing pasted afer the file so that if an error happens it doesnt get saved.





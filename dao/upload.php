<?php
$target_path = "../src/img/";
$target_path = $target_path . basename( $_FILES['userfile']['name']); 
// move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path);

// // $_FILES['userfile']['tmp_name']; 
// if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path))
// echo "The file ". basename( $_FILES['userfile']['name']). " has been 
// uploaded";
// else
// echo " <!>: error uploading the file!";

copy("../src/ico/plus-ico.png", "../src/img/wtf.png");
var_dump($_FILES);
?>
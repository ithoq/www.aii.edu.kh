<?php

$directory_name = "uploads";
$temp_folder = $_FILES['file']['tmp_name'];
$image_name = basename($_FILES['file']['name']);

move_uploaded_file($temp_folder, $directory_name."/".$image_name);
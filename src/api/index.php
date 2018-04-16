<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';

// $detect = new Mobile_Detect;


$gallery  = new StreamGallery($_SERVER['DOCUMENT_ROOT'] . '/gallery', '/gallery');
echo json_encode(['images' => $gallery->getData(),'stream' =>$gallery->getStream()]);
?>

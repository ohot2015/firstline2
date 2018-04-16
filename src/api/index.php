<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';

// $detect = new Mobile_Detect;

echo $_SERVER['DOCUMENT_ROOT'] . 'firstline2/gallery';
exit;
$gallery  = new StreamGallery($_SERVER['DOCUMENT_ROOT'] . 'firstline2/gallery', '/gallery');
echo json_encode(['images' => $gallery->getData(),'stream' =>$gallery->getStream()]);
?>

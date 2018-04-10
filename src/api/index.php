<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';

// $detect = new Mobile_Detect;
// $gallery  = new StreamGallery($_SERVER['DOCUMENT_ROOT'] . '/gallery');
$config = Symfony\Component\Yaml\Yaml::parseFile( '/config/config.yaml');

if (empty($config['crm_api_token'])) {

}
$crm = new ApiCrm($config['crm_api_token']);
$return = $crm->api('getRealtysByHouseId', [
    'id'=> 16
]);


dump($return);exit;
?>

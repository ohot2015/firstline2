<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';
$config = Symfony\Component\Yaml\Yaml::parseFile('../../config/config.yaml');

$crm = new ApiCrm($config['crm_api_token']);
$return = $crm->api('getHousesByDistrictId', [
    'id'=> 15
]);
echo json_encode($return);
?>
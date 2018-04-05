<?php

require_once './class/_autoload.php';

$crm = new ApiCrm($config['crm_api_token']);
$return = $crm->api('getRealtysByHouseId', [
    'id'=> 16
]);
echo json_encode($return);
?>
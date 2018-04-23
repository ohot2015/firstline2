<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';
$config = Symfony\Component\Yaml\Yaml::parseFile('../../config/config.yaml');

$crm = new ApiCrm($config['crm_api_token']);
$rs = $crm->api('getRealtysByHouseId', [
    'id'=> 14
]);


if (empty($rs['response']) && $_REQUEST['realty_id']) {
    echo json_encode('server error');
}

$r_id = $_REQUEST['realty_id'];
$house = $rs['response']['house'];
$realtys = $rs['response']['realty'];
$realty = [];

foreach ($realtys as $v) {
    if ($v['id'] == $r_id) {
        $realty = $v;
    }
}

echo json_encode(['house'=>$house, 'realty'=>$realty]);
?>
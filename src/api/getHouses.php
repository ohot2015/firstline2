<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';
$config = Symfony\Component\Yaml\Yaml::parseFile('../../config/config.yaml');

$crm = new ApiCrm($config['crm_api_token']);

switch (end(explode('/',$_SERVER['REQUEST_URI']))) {
    case 'getHousesByDistrictId.php':
        $return = $crm->api('getHousesByDistrictId', [
            'id'=> 15
        ]);
        break;
    case 'getFloorsByHouseId.php':
        $return = $crm->api('getFloorsByHouseId', [
            'id'=> 14
        ]);
        break;
    case 'getRealtysByHouseId.php':
        $return = $crm->api('getRealtysByHouseId', [
            'id'=> 14
        ]);
        break;
    case 'getFloorsByHouseId.php':
        $gallery  = new StreamGallery($_SERVER['DOCUMENT_ROOT'] . '/gallery', '/gallery');
        $return = ['images' => $gallery->getData(),'stream' =>$gallery->getStream()]);
        break;
    case 'realty.php':
        $rs = $crm->api('getRealtysByHouseId', [
            'id'=> 14
        ]);

        if (empty($rs['response']) && $_REQUEST['realty_id']) {
            $return = ('server error');
            break;
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
        $return = ['house'=>$house, 'realty'=>$realty])
        break;

    default:
        # code...
        break;
}
echo json_encode($return);

?>
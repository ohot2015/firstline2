<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';
$config = Symfony\Component\Yaml\Yaml::parseFile('../../config/config.yaml');

$crm = new ApiCrm($config['crm_api_token']);

$return='error';

$url = explode('/', $_SERVER['REQUEST_URI']);
$method_str = end($url);
$method_arr = explode('?',$method_str);
$param_str = !empty($method_arr[1])?$method_arr[1]:'';
parse_str($param_str,$param);
$route = $method_arr[0];

switch ($route) {
    case 'getHousesByDistrictId':
        $return = $crm->api('getHousesByDistrictId', [
            'id'=> 15
        ]);
        break;
    case 'getFloorsByHouseId':
        $return = $crm->api('getFloorsByHouseId', [
            'id'=> 14
        ]);
        break;
    case 'getRealtysByHouseId':
        $return = $crm->api('getRealtysByHouseId', [
            'id'=> 14
        ]);
        break;
    case 'gallery':
        $gallery  = new StreamGallery($_SERVER['DOCUMENT_ROOT'] . '/gallery', '/gallery');
        $return = ['images' => $gallery->getData(),'stream' => $gallery->getStream()];
        break;
    case 'realty':
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
        $return = ['house'=>$house, 'realty'=>$realty];
        break;

    default:
        # code...
        break;
}
echo json_encode($return);

?>
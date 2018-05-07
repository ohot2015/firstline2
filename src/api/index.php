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
    case 'sendMail':

        $name = $_REQUEST['name'];
        $phone = $_REQUEST['phone'];
        $r_id = $_REQUEST['rId'];
$tempalte = <<<END
    <table>
        <tr>
            <td>
            <a href="http://m2metr.com/advert/$r_id" target="_blank">Оставлена заявка на бронь квартиры, посмотреть заявку </a>
            </td>
        </tr>
        <tr>
            <td>Имя:</td>
            <td>$name</td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td>$phone</td>
        </tr>
    </table>
END;

$return = @mail( 'ohot2015@gmail.com' , 'Первая линия' , $tempalte, "From:noreply@line12.ru\r\n"
."Content-type: text/html; charset=utf-8\r\n"
."X-Mailer: PHP mail script" );
        $return = @mail( 'info@line12.ru' , 'Первая линия' , $tempalte, "From:noreply@line12.ru\r\n"
            ."Content-type: text/html; charset=utf-8\r\n"
            ."X-Mailer: PHP mail script" );
        break;
    default:
        # code...
        break;
}
echo json_encode($return);

?>
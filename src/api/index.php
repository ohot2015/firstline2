<?php
require_once '../../vendor/autoload.php';
require_once 'class/_autoload.php';
$config = Symfony\Component\Yaml\Yaml::parseFile('../../config/config.yaml');

try {
    $crm = new ApiCrm($config['crm_api_token'], $config['env']);
} catch (ApiCrmException $exception) {
    if ($config['env'] === 'dev' || $config['env'] === 'local') {
        dump($exception->getMessage());exit;
    }
}

$return='error';

$url = explode('/', $_SERVER['REQUEST_URI']);
$method_str = end($url);
$method_arr = explode('?',$method_str);
$param_str = !empty($method_arr[1])?$method_arr[1]:'';
parse_str($param_str,$param);
$route = $method_arr[0];


switch ($route) {
    case 'getHousesByDistrictId':
    case 'getFloorsByHouseId':
    case 'getRealtysByHouseId':
    case 'getFasadByHouseId':
        $return = $crm->api($route, $param);
        break;
    case 'gallery':
        $gallery  = new StreamGallery($_SERVER['DOCUMENT_ROOT'] . '/gallery', '/gallery');
        $return = ['images' => $gallery->getData(),'stream' => $gallery->getStream()];
        break;
    case 'realty':
        $rs = $crm->api('getRealtysByHouseId', $param);

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

        $loader = new Twig_Loader_Filesystem('template');
        $twig = new Twig_Environment($loader, array(
            'cache' => '../../var/twig/cache',
            'debug' => true
        ));
        $twig->addExtension(new Twig_Extension_Debug());

        $template = $twig->render('sendMail.html.twig', [
            'name' => $name,
            'phone' => $phone,
            'rId' => $r_id
        ]);
       
        $return = @mail( 'ohot2015@gmail.com' , 'Первая линия' , $template, "From:noreply@line12.ru\r\n"
        ."Content-type: text/html; charset=utf-8\r\n"
        ."X-Mailer: PHP mail script" );
        $return = @mail( 'info@line12.ru' , 'Первая линия' , $template, "From:noreply@line12.ru\r\n"
            ."Content-type: text/html; charset=utf-8\r\n"
            ."X-Mailer: PHP mail script" );
        break;
    default:
        # code...
        break;
}

echo json_encode($return);

?>
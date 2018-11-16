<?php
class ApiCrm {

    private $var_cache = '';
    private $time_cahe_live = 60*10;

    private $cache_on;
    private $access_token;
    private $crm_url;
    private $urls = [
        'local' => 'http://crm/app_dev.php/api/',
        'dev' => 'http://devcrm.m2metr.com/api/',
        'prod' => 'https://crm.m2metr.com/api/',
    ];
    /**
     * Authorization status.
     * @var bool
     */
    private $auth = false;

    /**
     * Instance curl.
     * @var Resource
     */
    private $ch;

    /**
     * Constructor.
     * @param   string $app_id
     * @param   string $api_secret
     * @param   string $access_token
     * @throws  VKException
     */
    public function __construct($access_token = null, $mode = "dev")
    {
        $this->Env($mode);
        $this->setAccessToken($access_token);
        $this->setCacheDir('/var/cache/apiCrm/');
        $this->ch = curl_init();
    }

    private function getCaheOn () {
        return $this->cache_on;
    }

    private function setCacheDir ($dir) {
        $this->var_cache = $_SERVER['DOCUMENT_ROOT'].$dir;
    }

    private function setCacheOn ($on = true) {
        $this->cache_on = $on;
    }

    private function Env ($mode) {
        if (!empty($mode)) {
            $mods = array_keys($this->urls);
            if (in_array($mode,$mods)) {
                $this->crm_url = $this->urls[$mode];
                if ($this->crm_url === 'prod') {
                    $this->cache_on = true;
                }
                else {
                    $this->cache_on = false;
                }
            }
            else {
                throw new ApiCrmException('mode does not exist' );
            }
        }
        else {
            throw new ApiCrmException('mode does not exist');
        }
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }

    /**
     * Set Access Token.
     * @param   string $access_token
     * @throws  VKException
     * @return  void
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Returns base API url.
     * @param   string $method
     * @param   string $response_format
     * @return  string
     */
    public function getApiUrl($method, $response_format = 'json')
    {
        return $this->crm_url . $method . '.' . $response_format;
    }
    //https://i-notes.org/php-funkciya-okrugleniya-vremeni/
    private function round_time($ts, $step) {
        return(floor(floor($ts/60)/60)*3600+floor(date("i",$ts)/$step)*$step*60);
    }

    public function cache($url, $requestMethod = 'get') {
        if (false === $this->cache_on) {
            return $this->request($url, $requestMethod = 'get');
        };

        $cache_time = $this->round_time(time(),$this->time_cahe_live) ;
        $name_cache = sprintf('%s.json', md5($url.$cache_time));

        if (false === $rs = @file_get_contents($this->var_cache.$name_cache)) {
            $rs = $this->request($url, $requestMethod = 'get');
            file_put_contents($this->var_cache.$name_cache, json_encode($rs));
        }
        else {
            $rs = json_decode($rs);
        }
        return $rs;
    }

    /**
     * Execute API method with parameters and return result.
     * @param   string $method
     * @param   array $parameters
     * @param   string $format
     * @param   string $requestMethod
     * @return  mixed
     */
    public function api($method, $parameters = array(), $format = 'array', $requestMethod = 'get')
    {
        //$parameters['timestamp'] = time();
        if (!array_key_exists('token', $parameters) && !is_null($this->access_token)) {
            $parameters['token'] = $this->access_token;
        }
        ksort($parameters);
        $url = $this->createUrl( $this->crm_url . $method ,$parameters);
        $rs = $this->cache($url, $requestMethod);

        return $format == 'array' ? json_decode($rs, true) : $rs;
    }

    /**
     * Concatenate keys and values to url format and return url.
     * @param   string $url
     * @param   array $parameters
     * @return  string
     */
    private function createUrl($url, $parameters)
    {
        $url .= '?' . http_build_query($parameters);
        return $url;
    }

    /**
     * Executes request on link.
     * @param   string $url
     * @param   string $method
     * @param   array $postfields
     * @return  string
     */
    private function request($url, $method = 'GET', $postfields = array())
    {
        curl_setopt_array($this->ch, array(
            CURLOPT_USERAGENT => 'm2Lab Production',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POST => ($method == 'POST'),
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_URL => $url
        ));
        $dump = curl_exec($this->ch);
        //var_dump($url,$dump);
        return $dump;
    }
}

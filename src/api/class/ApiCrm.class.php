<?php
class ApiCrm {
    private $dev = true;
    private $access_token;

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

    private $crm_url;

    /**
     * Constructor.
     * @param   string $app_id
     * @param   string $api_secret
     * @param   string $access_token
     * @throws  VKException
     */
    public function __construct($access_token = null)
    {
        $this->Env();
        $this->setAccessToken($access_token);
        $this->ch = curl_init();
    }
    private function Env () {
        $this->crm_url = ($this->dev) ?  'http://crm/app_dev.php/api/' :'http://crm.m2metr.com/api/';
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
        $parameters['timestamp'] = time();

        if (!array_key_exists('token', $parameters) && !is_null($this->access_token)) {
            $parameters['token'] = $this->access_token;
        }

        ksort($parameters);
        $rs = $this->request($this->createUrl( $this->crm_url . $method ,$parameters), $requestMethod );
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

        return curl_exec($this->ch);
    }

}

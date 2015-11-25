<?php
namespace JWhy\JodelPHP;

require __DIR__ . '/../vendor/autoload.php';

use \Httpful\Request;

class JodelClient
{

    private $api_url;

    private $template;

    private $default_template;

    function __construct($api_url)
    {
        $this->default_template = Request::init()->addHeader('Connection', 'keep-alive')
            ->addHeader('Accept-Encoding', 'gzip')
            ->addHeader('Content-Type', 'application/json; charset=UTF-8')
            ->addHeader('User-Agent', 'Jodel/65000 Dalvik/2.1.0 (Linux; U; Android 5.1.1; D6503 Build/23.4.A.1.232)');
        $this->set_template($this->default_template);
    }

    /**
     *
     * @return the API Url.
     */
    public function get_api_url()
    {
        return $this->api_url;
    }

    /**
     * Sets the API URL.
     *
     * @param string $api_url            
     */
    public function set_api_url($api_url)
    {
        $this->api_url = $api_url;
    }

    /**
     * Returns the currently used Request template.
     *
     * @return the $template
     */
    public function get_template()
    {
        return $this->template;
    }

    /**
     * Applies a Request template.
     * If you don't specify the $template parameter, the default template will be applied.
     *
     * @param \Httpful\Request $template            
     */
    public function set_template($template)
    {
        $this->template = ($template instanceof Request) ? $template : Request::init();
        Request::ini($this->template);
    }

    public function login()
    {
        Request::get();
    }

    private function request_access_token()
    {}
}

?>
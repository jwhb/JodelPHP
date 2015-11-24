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
        $this->default_template = Request::init();
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
    {}
}

?>
<?php
namespace JWhy\JodelPHP;

use Httpful\Request;

class JodelREST
{

    private $api_url;

    /**
     *
     * @param string $api_url
     *            the API URL
     */
    function __construct($api_url)
    {
        $this->set_api_url($api_url);
    }

    /**
     * Returns the API URL.
     *
     * @return string the API URL
     */
    public function get_api_url()
    {
        return $this->api_url;
    }

    /**
     * Sets the API URL.
     *
     * @param string $api_url
     *            the API URL
     */
    public function set_api_url($api_url)
    {
        $this->api_url = $api_url;
    }

    /**
     * Performs a HTTP GET request.
     *
     * @param string $resource
     *            the requested resource
     * @param string $mime
     *            the expected MIME type (optional)
     * @return \Httpful\Request the API's response
     */
    public function do_get($resource, $mime = NULL)
    {
        $uri = $this->make_uri($resource);
        $result = Request::get($uri, $mime)->send();
        return $result;
    }

    /**
     * Performs a HTTP POST request.
     *
     * @param string $resource
     *            the requested resource
     * @param string $payload
     *            extra data (optional)
     * @param string $mime
     *            the expected MIME type (optional)
     * @return \Httpful\Request the API's response
     */
    public function do_post($resource, $payload = NULL, $mime = 'application/json')
    {
        $uri = $this->make_uri($resource);
        $result = Request::post($uri, $payload, $mime)->send();
        return $result;
    }

    /**
     * Performs a HTTP PUT request.
     *
     * @param string $resource
     *            the requested resource
     * @param string $payload
     *            extra data (optional)
     * @param string $mime
     *            the expected MIME type (optional)
     * @return \Httpful\Request the API's response
     */
    public function do_put($resource, $payload = NULL, $mime = NULL)
    {
        $uri = $this->make_uri($resource);
        $result = Request::put($uri, $payload, $mime)->send();
        return $result;
    }

    /**
     * Makes a complete API URL
     *
     * @param string $resource
     *            the URL's resource part (ex. '/users/')
     *            
     * @return string the complete resource URL
     */
    public function make_uri($resource)
    {
        return $this->api_url . $resource;
    }
}

?>
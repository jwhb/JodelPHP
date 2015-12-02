<?php
namespace JWhy\JodelPHP;

require __DIR__ . '/../vendor/autoload.php';

use \Httpful\Request;

class JodelClient
{

    private $api_url, $user, $rest, $template, $default_template;

    function __construct($api_url, $user)
    {
        $this->user = $user;
        $this->rest = new JodelREST($api_url);
        $this->default_template = Request::init()->addHeader('Connection', 'keep-alive')
            ->addHeader('Accept-Encoding', 'gzip')
            ->addHeader('Content-Type', 'application/json; charset=UTF-8')
            ->addHeader('User-Agent', 'Jodel/65000 Dalvik/2.1.0 (Linux; U; Android 5.1.1; D6503 Build/23.4.A.1.232)');
        $this->set_template($this->default_template);
    }

    /**
     * Returns the API URL.
     *
     * @return string the API URL
     */
    public function get_api_url()
    {
        return $this->rest->get_api_url();
    }

    /**
     * Sets the API URL.
     *
     * @param string $api_url
     *            the API URL
     */
    public function set_api_url($api_url)
    {
        $this->rest->set_api_url($api_url);
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

    /**
     * Returns the active user.
     *
     * @return JodelUser $user
     */
    public function get_user()
    {
        return $this->user;
    }

    /**
     * Sets the active user.
     *
     * @param JodelUser $user            
     */
    public function set_user($user)
    {
        $this->user = $user;
    }

    /**
     * Ensures that the user has an access token.
     */
    public function login($force_new_token = false)
    {
        if ($force_new_token || ! $this->user->is_registered())
            $this->request_access_token();
    }

    /**
     */
    public function is_logged_in()
    {
        return $this->user->is_registered();
    }

    /**
     * Register to the Jodel API.
     * The received access token will be assigned to the current user and is returned.
     *
     * @return string the received access token
     */
    private function request_access_token()
    {
        $data = json_encode(array(
            'client_id' => $this->user->get_client_id(),
            'device_uid' => $this->user->get_device_uid(),
            'location' => $this->user->get_location()
        ));
        $result = $this->rest->do_post('/users/', $data);
        $token = (isset($result->body->access_token)) ? $result->body->access_token : NULL;
        if ($token != NULL) {
            $this->user->set_access_token($token);
            return $token;
        } else {
            return false;
        }
    }
}

?>
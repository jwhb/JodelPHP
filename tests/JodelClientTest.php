<?php
use Httpful\Request;
use JWhy\JodelPHP\JodelClient;
use JWhy\JodelPHP\JodelUser;

class JodelClientTest extends PHPUnit_Framework_TestCase
{

    public function testApplyTemplateEmpty()
    {
        $client = $this->make_client();
        $client->set_template(Request::init());
        $this->assertInstanceOf('Httpful\Request', $client->get_template(), 'Could not set empty Request template.');
    }

    public function testApplyTemplateNull()
    {
        $client = $this->make_client();
        $client->set_template(null);
        $this->assertInstanceOf('Httpful\Request', $client->get_template(), 'Could not set "null" Request template.');
    }

    public function testLogin()
    {
        $client = $this->make_client();
        $client->login();
        $this->assertTrue($client->is_logged_in(), 'Could not log user in.');
    }

    private function make_user()
    {
        return new JodelUser('53.107', '8.853', 19, 'Bremen', 'DE');
    }

    private function make_client()
    {
        return new JodelClient(JODEL_API_URL, $this->make_user());
    }
}

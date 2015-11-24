<?php
use JWhy\JodelPHP\JodelClient;
use Httpful\Request;

class JodelClientTest extends PHPUnit_Framework_TestCase
{

    public function testApplyTemplateEmpty()
    {
        $jodelclient = new JodelClient(JODEL_API_URL);
        $jodelclient->set_template(Request::init());
        $this->assertInstanceOf('Httpful\Request', $jodelclient->get_template(), 'Could not set empty Request template.');
    }

    public function testApplyTemplateNull()
    {
        $jodelclient = new JodelClient(JODEL_API_URL);
        $jodelclient->set_template(null);
        $this->assertInstanceOf('Httpful\Request', $jodelclient->get_template(), 'Could not set "null" Request template.');
    }

    public function testLogin()
    {
        $jodelclient = new JodelClient(JODEL_API_URL);
        $jodelclient->login();
    }
}

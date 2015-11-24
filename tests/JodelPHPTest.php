<?php
 
use JWhy\JodelPHP\JodelPost;
 
class JodelPostTest extends PHPUnit_Framework_TestCase {
 
  public function testTheTest()
  {
    $jodelpost = new JodelPost();
    $this->assertEquals($jodelpost->theTest(), 'verify');
  }
 
}

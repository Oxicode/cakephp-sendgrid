<?php

namespace Sendgrid\Test\TestCase\Mailer\Transport;

use Cake\Mailer\Email;
use Cake\TestSuite\TestCase;
use Sendgrid\Mailer\Transport\SendgridTransport;

class SendgridTransportTest extends TestCase
{

    public $fixtures = false;

    public function setUp()
    {
        parent::setUp();
        $this->SendgridTransport = new SendgridTransport();
        $this->validConfig = [
            'api_key' => 'My-Super-Awesome-API-Key',
        ];
        $this->invalidConfig = [
            'api_Key' => '',
            'domain' => ''
        ];
    }
    public function testAddContents() {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testAddFrom() {
        $this->SendgridTransport->addFrom([
            'christian.quispeh@gmail.com' => 'Oxicode'
        ]);

        $expected = $this->SendgridTransport->getRequest()['from'];

        $this->assertEquals(['email' => 'christian.quispeh@gmail.com', 'name' => 'Oxicode'], $expected);
    }

    public function testAddCategories() {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testAddSubject() {
        $email = new Email();
        $email->transport($this->SendgridTransport);
        $email->setSubject('pepe el grillo');

        $this->SendgridTransport->addSubject($email);
        $expected = $this->SendgridTransport->getRequest()['personalizations'][0]['subject'];

        $this->assertEquals('pepe el grillo', $expected);
    }

    public function testSend() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}

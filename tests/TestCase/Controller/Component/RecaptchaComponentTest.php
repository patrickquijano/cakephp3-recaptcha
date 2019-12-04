<?php

namespace Recaptcha\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Recaptcha\Controller\Component\RecaptchaComponent;

class RecaptchaComponentTest extends TestCase {

    /**
     * @var \Recaptcha\Controller\Component\RecaptchaComponent
     */
    public $Recaptcha;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Recaptcha = new RecaptchaComponent($registry);
    }

    /**
     * @return void
     */
    public function tearDown() {
        unset($this->Recaptcha);
        parent::tearDown();
    }

    /**
     * @return void
     */
    public function testInitialization() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}

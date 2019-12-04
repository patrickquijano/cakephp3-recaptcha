<?php

namespace Recaptcha\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Recaptcha\View\Helper\RecaptchaHelper;

class RecaptchaHelperTest extends TestCase {

    /**
     * @var \Recaptcha\View\Helper\RecaptchaHelper
     */
    public $Recaptcha;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $view = new View();
        $this->Recaptcha = new RecaptchaHelper($view);
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

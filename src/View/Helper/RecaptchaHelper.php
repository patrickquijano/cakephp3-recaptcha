<?php

namespace Recaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\View\Helper;

/**
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class RecaptchaHelper extends Helper {

    /**
     * @var array
     */
    protected $_defaultConfig = [
        'theme' => '',
        'size' => '',
        'script' => [
            'url' => 'https://www.google.com/recaptcha/api.js',
        ],
    ];

    /**
     * @var array
     */
    public $helpers = ['Html'];

    /**
     * @param array $options
     * @return string|null
     */
    public function script(array $options = []) {
        if (!isset($options['block'])) {
            $options['block'] = false;
        }
        $options['once'] = true;
        return $this->Html->script($this->getConfig('script.url'), $options);
    }

    /**
     * @return string
     */
    public function widget() {
        $siteKey = Configure::read('Recaptcha.siteKey');
        if (empty($siteKey)) {
            throw new Exception('Recaptcha Site Key not configured.');
        }
        $options = ['data-sitekey' => $siteKey];
        if ($this->getConfig('theme')) {
            $options['data-theme'] = $this->getConfig('theme');
        }
        if ($this->getConfig('size')) {
            $options['data-size'] = $this->getConfig('size');
        }
        return $this->Html->div('g-recaptcha', '', $options);
    }

}

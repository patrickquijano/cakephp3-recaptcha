<?php

namespace Recaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Http\Client;

class RecaptchaComponent extends Component {

    /**
     * @var array
     */
    private $_errors = [];

    /**
     * @var array
     */
    protected $_defaultConfig = [
        'apiUrl' => 'https://www.google.com/recaptcha/api/siteverify',
    ];

    /**
     * @return boolean
     */
    public function verify() {
        $request = $this->getController()->request;
        $client = new Client();
        $secretKey = Configure::read('Recaptcha.secretKey');
        if (empty($secretKey)) {
            throw new Exception('Recaptcha Secret Key not configured.');
        }
        $response = $client->post($this->getConfig('apiUrl'), [
            'secret' => $secretKey,
            'response' => $request->getData('g-recaptcha-response'),
            'remoteip' => $request->clientIp(),
        ]);
        $jsonResponse = json_decode($response->getStringBody(), true);
        if (!$jsonResponse['success']) {
            $this->_setErrors($jsonResponse['error-codes']);
        }
        return $jsonResponse['success'];
    }

    /**
     * @return boolean
     */
    public function hasErrors() {
        return !empty($this->_errors);
    }

    /*
     * @return array
     */

    public function errors() {
        return $this->hasErrors() ? $this->_errors : null;
    }

    /**
     * @param array $errors
     */
    private function _setErrors(array $errors) {
        foreach ($errors as $error) {
            $errorDefinition = $this->_errorDefinition($error);
            if (!empty($errorDefinition)) {
                $this->_errors[] = $errorDefinition;
            }
        }
    }

    /**
     * @param string $error
     * @return string|null
     */
    private function _errorDefinition($error) {
        switch ($error) {
            case 'missing-input-secret':
                return __('The secret parameter is missing.');
            case 'invalid-input-secret':
                return __('The secret parameter is invalid or malformed.');
            case 'missing-input-response':
                return __('	The response parameter is missing.');
            case 'invalid-input-response':
                return __('The response parameter is invalid or malformed.');
            case 'bad-request':
                return __('The request is invalid or malformed.');
            default:
                return null;
        }
    }

}

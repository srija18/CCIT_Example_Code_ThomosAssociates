<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

    /**
     * Reference to the CI singleton
     *
     * @var	object
     */
    private static $instance;

    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct() {
        self::$instance = & $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = & load_class($class);
        }

        $this->load = & load_class('Loader', 'core');
        $this->load->initialize();
        log_message('info', 'Controller Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Get the CI singleton
     *
     * @static
     * @return	object
     */
    public static function &get_instance() {
        return self::$instance;
    }

    private function _templetData($parameter) {
        $argCount = count($parameter);
        // html content
        if ($argCount > 1) {
            $data['html'] = $parameter[1];
        } else {
            $data['html'] = '';
        }
        // aditional css
        if ($argCount > 2) {
            $data['adonCss'] = $this->AppManageModel->formCssLinks($parameter[2]);
        } else {
            $data['adonCss'] = '';
        }
        // error mssages from validation rules and others
        if (($argCount > 3) && (!empty($parameter[3]))) {
            $data['error'] = '<p class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    ' . $parameter[3] . '
                                </p>';
        } else {
            $data['error'] = '';
        }
        // success msg for updation / addition
        if (($argCount >= 4) && (!empty($parameter[4]))) {
            $data['msg'] = '<p class="alert alert-success text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                ' . $parameter[4] . '
                            </p>';
        } else {
            $data['msg'] = '';
        }

        return $data;
    }

    final public function __call($method_name, $parameter) {
//        echo '<pre>';
//        print_r($parameter); 
        /*
         * total 5 parameters allowed. 
         * 1=> templet name templet name 
         * 2=> additional contant added to content $html
         * 3=> addon Css should be in array format. eg.: array('style.css','asdhfj.css');
         * 4=> Error message display method. Allowed only plain text.
         * 5=> success message display mode. Allowed only plain text.          
         */
        if ($method_name == "templet") {
            $data1 = array(
                'pageTitle' => $this->AppManageModel->pageTitle(),
                'metaTags' => $this->AppManageModel->metaTags(),
                'css' => $this->AppManageModel->defaultCss(),
                'js' => $this->AppManageModel->defaultJs()
            );
              switch ($parameter[0]) {
                case 'home':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/basic', $data);
                    break;
                case 'basic':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/no-banner', $data);
                    break;
                case 'user':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/user-profile', $data);
                    break;

                default:
                    return $data1;
                    break;
            }
             } else if ($method_name == "adminTemplet") {
            $data1 = array(
                'pageTitle' => $this->AppManageModel->pageTitle(),
                'metaTags' => $this->AppManageModel->metaTags(),
                'css' => $this->AppManageModel->defaultCss()
            );
           switch ($parameter[0]) {
                case 'list':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/list', $data);
                    break;

                case 'home':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/common/basic', $data);
                    break;
                case 'user':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/user/basic', $data);
                    break;
                 case 'dashboard':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/dashboard/basic', $data);
                    break;
                 case 'doctor':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/doctor/basic', $data);
                    break;
                case 'doctorAdmin':
                    $data2 = $this->_templetData($parameter);
                    $data = $data1 + $data2;
                    $this->parser->parse('layouts/doctor/admin', $data);
                    break;
                default:
                    return $data1;
                    break;
            }
     
        }
    }
    
      protected function adminAccessCheckUp() {
        if (($this->session->userdata('aWebStatus') == NULL)) {
            redirect('authenticate/index');
        }
    }

    protected function userAccessCheckUp() {
        if (($this->session->userdata('uWebStatus') == NULL)) {
            redirect('Ushodaya/check');
        }
    }
    protected function userAccessCheck() {
        if (($this->session->userdata('userWebStatus') == NULL)) {
            redirect('User/signIn');
        }
    }
        protected  function encrypt($plainText, $key) {
        $secretKey = self::hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad = $this->pkcs5_pad($plainText, $blockSize);
        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
            $encryptedText = mcrypt_generic($openMode, $plainPad);
            mcrypt_generic_deinit($openMode);
        }
        return bin2hex($encryptedText);
    }

    protected  function decrypt($encryptedText, $key) {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = $this->hextobin($encryptedText);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        mcrypt_generic_init($openMode, $secretKey, $initVector);
        $decryptedText = mdecrypt_generic($openMode, $encryptedText);
        $decryptedText = rtrim($decryptedText, "\0");
        mcrypt_generic_deinit($openMode);
        return $decryptedText;
    }
      protected function pkcs5_pad($plainText, $blockSize) {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

    protected function hextobin($hexString) {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString.=$packedString;
            }

            $count+=2;
        }
        return $binString;
    }

}

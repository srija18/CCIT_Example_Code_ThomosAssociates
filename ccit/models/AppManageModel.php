<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AppManageModel extends CI_Model {

    function pageTitle() {
        return $this->uri->segment(2, '');
    }

    function metaTags() {
        $meta = array(
            array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1.0'
            ),
            array(
                'name' => 'keywords',
                'content' => 'veterinary, pets care'
            ),
            array(
                'name' => 'description',
                'content' => 'Taking care of pets is loving them.'
            ),
            array(
                'name' => 'author',
                'content' => 'Akurathi Anand Kumar'
            ),
            array(
                'name' => 'organisation',
                'content' => 'Abhi Tech Soft'
            )
        );
        return meta($meta);
    }

    function minifyCss($param) {
        $cssLink = '';
        if (file_exists('public/css/cubsvet.minified.css')) {
            $cssLink .= link_tag('public/css/cubsvet.minified.css');
        } else {
            $this->load->library('minify');
            $this->minify->css($param);
            $cssLink .= $this->minify->deploy_css();
        }
        return $cssLink;
    }

    function formCssLinks($links = '') {
        $cssLink = '';
        if (!empty($links)) {
            foreach ($links as $value) {
                $cssLink .= link_tag($value);
            }
        } else {
            $cssLink = '';
        }
        return $cssLink;
    }

    function defaultCss() {
        $links = array(
            'css-index.css',           
             
          
        );
        return $this->minifyCss($links);
    }

    function minifyJs($jsFiles) {
        $js = '';
        $my_file = 'public/js/cubsvet.minified.js';
        if (file_exists($my_file)) {
            $js .= '<script src="' . adminUrl . $my_file . '" type="text/javascript"></script>';
        } else {
            $handle = fopen($my_file, 'a') or die('Cannot open file:  ' . $my_file);
            foreach ($jsFiles as $value) {
                if (file_exists($value) && is_readable($value)) {
                    $handle1 = fopen($value, 'r');
                    $data = fread($handle1, filesize($value));
                    fwrite($handle, $data . "\n/* -------------------- $value -------------------------- */\n");
                }
            }
            $js .= '<script src="' . adminUrl . $my_file . '" type="text/javascript"></script>';
        }
        return $js;
    }

    function defaultJs() {
        $links = array(
                 
            'public/js/custom.js',        
         
       
        );
        return $this->minifyJs($links);
    }

}

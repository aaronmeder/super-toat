<?php

    /*
    * Returns True if site is loaded on dev server
    */
    function is_dev_env () {
        $host = $_SERVER['HTTP_HOST'];
        if ($host == 'telltec.local') {
            return true;
        } else {
            return false;
        }
    }

    /*
    * Returns True if ACF is enabled
    */
    function acf_is_enabled () {
        if( class_exists('acf') ) {
            return true;
        } else {
            return false;
        }
    }
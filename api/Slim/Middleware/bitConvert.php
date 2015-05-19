<?php
/**
 * Bit Conversion Class for the Slim Framework
 *
 * @author  Andrew Fernandez <afernandez@nimbletv.com>
 * @since  04-08-2013
 *
 * Simple class to rewrite unicode bits from mysql into true or false values
 * 
 *
 * Usage
 * ====
 * 
 * $app = new \Slim\Slim();
 * $app->add(new \Slim\Extras\Middleware\BitConvertMiddleware());
 * 
 */

namespace Slim\Middleware;

class BitConvertMiddleware extends \Slim\Middleware
{
    public function call()
    {
        //Fetch the body first
        $this->next->call();
            $jsonp_response = str_replace('\\u0000', '0', $this->app->response()->body());
            $jsonp_response = str_replace('\\u0001', '1', $jsonp_response);
            $this->app->response()->body($jsonp_response);
       
    }
}

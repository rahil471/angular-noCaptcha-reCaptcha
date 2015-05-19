<?php
/**
 *  A BasicAuth middleware that works only against a certain path
 *  @author erachitskiy
 */
namespace Slim\Extras\Middleware;
require_once 'HttpBasicAuth.php';
class HttpBasicAuthRoute extends HttpBasicAuth {
    /**
     * @var string route to protect
     */
    protected $route;
   
    public function __construct($username, $password, $realm = 'Protected Area', $route = '') {
        $this->route = $route;
        parent::__construct($username, $password, $realm);        
    }
   
    public function call() {
        if(strpos($this->app->request()->getPathInfo(), $this->route) !== false) {
            parent::call();
            return;
        }
        $this->next->call();
    }
}
?>
<?php 
namespace App\Services;

use AltoRouter;

/**
 * Router
 * Allows you to format URLs
 */
class Router
{
    private $path_views;
    private $path_controller;
    private $altorouter;
    
    /**
     * __construct
     *
     * @param  mixed $path_views must contain the views folder path
     * @return void
     */
    public function __construct(string $path_views)
    {
        $this->path_views = $path_views;
        $this->path_controller = dirname(__DIR__,2). DIRECTORY_SEPARATOR. "Controller". DIRECTORY_SEPARATOR;
        $this->altorouter = new AltoRouter();
        
    }
    
    /**
     * map
     *
     * @param  mixed $methode Must contain POST,GET or POST|GET
     * @param  mixed $route must contain the address example / for root or /login possibility of doing regex
     * Doc : https://dannyvankooten.github.io/AltoRouter/usage/mapping-routes.html
     * @param  mixed $name_file must contain the file name without the .php example login
     * @return void
     */
    public function map(string $methode,string $route,string $name_file)
    {
        $this->altorouter->map($methode,$route,$name_file);
        return $this;
    }
    
    /**
     * run  lets start the journey
     *
     * @return void
     */
    public function run()
    {
        $altorouter = $this->altorouter;
        $match = $altorouter->match();
        $file_layout = $this->path_views."layout_template". DIRECTORY_SEPARATOR. "layout.php";
        if(!empty($match['target']) )
        {
            $file_controller = $this->path_controller.$match['target']."Controller.php";
            $file_views = $this->path_views.$match['target'].".php"; 
            if(!file_exists($file_views))
            {
                touch($file_views);
            } 
            if(!file_exists($file_controller))
            {
                touch($file_controller);
            }
            ob_start();
            require_once $this->path_controller.$match['target']."Controller.php";
            require_once $this->path_views.$match['target'].".php";
            
          $content =  ob_get_clean();
          require_once $file_layout;
        }

    }
}
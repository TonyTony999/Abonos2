<?php
declare(strict_types=1);

namespace App;

use App\Exceptions;
use App\DB;

use PDO;


class App
{

    private static DB $db;

    public function __construct(
        protected Router $router,
       protected $config
    ) {
        static::$db= new DB($config->db ?? []);

    }
    
    public static function db():DB
    {
        return static::$db;

        //we use static and prop name because we cannot use $this in static 
        //methods so other classes can have acces to the PDO object 
        //that has access to the database
    }
    

    public function run()
    {

        try {
            echo $this->router->resolve($_SERVER["REQUEST_METHOD"],$_SERVER["REQUEST_URI"]);
        } catch (Exceptions\RouterNotFoundException $e) {
            http_response_code(404);
            echo (new View("error/404", ""))->render();
        }
    }
}

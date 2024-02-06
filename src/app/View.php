<?php

declare(strict_types=1);

namespace App;

use App\Layout;

class View
{


   public function __construct(public string $path, public string $stylePath , public array $dbcontent=[""], public string $scriptPath="" )
   {
      $this->path = $path;
      //$this->stylePath = $stylePath ?? "style.css";
   }

   public function render(): string
   {

      ob_start();

      define("DB_DATA", $this->dbcontent);
      include VIEW_PATH . "/" . $this->path . "/" . $this->path . ".php";
     
      $output = (string)ob_get_clean();
      $layout = new Layout($output, $this->stylePath, $this->scriptPath);
      return $layout->render();
   }
}

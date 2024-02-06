<?php

declare(strict_types=1);

namespace App;

class Layout
{

   public function __construct(public string $child, public string $stylePath, public string $scriptPath="")
   {
      
   }
   
   public function render(){

    return <<<EOD
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <link rel="stylesheet" href={$this->stylePath}>
    <script src="{$this->scriptPath}"></script>
    </head>
    <body>
    <script src="index.js">
    </script>
    {$this->child}
    </body>
    </html>
    EOD;
   }

}

/**added initial html tag */
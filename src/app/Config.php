<?php

declare(strict_types=1);

namespace App;

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            "db" =>
            [
                'driver' => $env['DB_DRIVER'],
                'user' => $env['DB_USER'],
                'pass' => $env['DB_PASS'],
                'database' => $env['DB_DATABASE'],
                'host' => $env['DB_HOST'],
            ]

        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
        //we overwrite the magic get method to route any unknown property 
        //to the __get method execution
        //eg in the app  class
    }
}
<?php

namespace App\Exceptions;

class RouterNotFoundException extends \Exception {

  protected $message= "404 not found";
  //here we override the default message property from the 
  //exceptions class that extends this class


}
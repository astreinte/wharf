<?php namespace Wharf\Loadroutes;
 
class Loadroutes {
 
  public function from($file)
  {
  	return require_once app_path().'/routes/'.$file.'.php';
  }
 
}
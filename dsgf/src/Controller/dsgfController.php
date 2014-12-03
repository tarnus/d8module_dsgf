<?php
namespace Drupal\dsgf\Controller;
use Drupal\Core\Controller\ControllerBase;

class dsgfController extends ControllerBase{
  public function helloworld(){
    $message=$this->t("Hello World I am here");
    return [
      '#theme' => 'hello_page',
      '#message' => $message,
    ];
  }
}
<?php
namespace Drupal\dsgf\Controller;
use Drupal\Core\Controller\ControllerBase;

class dsgfController extends ControllerBase{
  public function helloworld(){
    $message=$this->t("Hello World");
    return array(
      '#markup' =>$message,
    );
  }
}
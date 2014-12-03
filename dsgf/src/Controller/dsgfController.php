<?php
namespace Drupal\dsgf\Controller;
use Drupal\Core\Controller\ControllerBase;

class dsgfController extends ControllerBase{
  public function helloworld($to, $from){
    //$message=$this->t("Hello World I am here");
    $message = $this->config('dsgf.settings')->get('default_text');
    return [
      '#theme' => 'hello_page',
      '#message' => $message,
      '#to' => $to,
      '#from' => $from,
    ];
  }
}
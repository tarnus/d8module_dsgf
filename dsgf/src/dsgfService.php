<?php
/**
 * @file
 * Contains \Drupal\dsgf\dsgfservice.
 */

namespace Drupal\dsgf;

use Drupal\Core\Http\Client;
use Drupal\Core\State\State;

class dsgfService {


  /**
   * Drupal\Core\Http\Client definition.
   *
   * @var Drupal\Core\Http\Client
   */
  protected $http_client;

  /**
   * Drupal\Core\State\State definition.
   *
   * @var Drupal\Core\State\State
   */
  protected $state;

  public function __construct(Client $http_client, State $state)
  {
    $this->http_client = $http_client;
    $this->state = $state;
  }


  public function getTagline() {

  // get json to generate loremipson data
    $request_url="https://ponyipsum.com/api/?type=all-pony&paras=1&start-with-lorem=1";
    $request= $this->http_client->get($request_url);
    $json=$request->json();
    if(isset($json[0])){
      $output=$json[0];
      $count= $this->state->get('dsgf.count');
      if (!isset($count)){
        $this->state->set('dsgf.count',0);
      }else{
        $this->state->set('dsgf.count',$count +1);
      }

    }else{
      $output="Default text";
    }


    return t($output);
  }
}
<?php

/**
 * @file
 * Contains Drupal\dsgf\DemoService.
 */

namespace Drupal\dsgf;

class DemoService {

  protected $demo_value;

  public function __construct() {
    $this->demo_value = 'Upchuk';
  }

  public function getDemoValue() {
    return $this->demo_value;
  }

}
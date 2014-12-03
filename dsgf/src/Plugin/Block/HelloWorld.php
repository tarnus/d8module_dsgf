<?php
/**
 * @file
 * A Custom Hello World block
 */
namespace Drupal\dsgf\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Hello World Block
 *
 * @Block(
 *  id = "hello_world",
 *  admin_label = @Translation("Hello World"),
 *  category = @Translation("Blocks")
 * )
 */
class HelloWorld extends BlockBase{
  public function build(){
    return array('#markup' => 'Hello World Block Test');
  }
}
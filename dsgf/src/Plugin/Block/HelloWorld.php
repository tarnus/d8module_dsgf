<?php
/**
 * @file
 * A Custom Hellow World block
 */
namespace Drupal\dsgf\Plugin\Block;
use Drupal\Core\Form\FormStateInterface;
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
  public function defaultConfiguration(){
    return ['enabled' => 1];
  }
  public function blockForm($form, FormStateInterface $form_state){
    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hello enabled'),
      '#default_value' => $this->configuration['enabled'],
    ];
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state){
    $this->configuration['enabled']=(bool)$form_state->getValue('enabled');
  }
  public function build(){
    if ($this->configuration['enabled']){
      $message="Yes its the hello World Block and we are enabled";
    }else{
      $message="Hello World Block Test";
    }

    return array(
      '#message' => $message,
      '#theme' => 'hello_block',
    );
  }
}
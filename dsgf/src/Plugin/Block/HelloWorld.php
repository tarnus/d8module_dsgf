<?php
/**
 * @file
 * A Custom Hellow World block
 */
namespace Drupal\dsgf\Plugin\Block;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dsgf\dsgfService;
use Drupal\Core\State\State;

/**
 * Hello World Block
 *
 * @Block(
 *  id = "hello_world",
 *  admin_label = @Translation("Hello World"),
 *  category = @Translation("Blocks")
 * ) 
 */

class HelloWorld extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\hostdns\getDomainIP definition.
   *
   * @var Drupal\dsgf\dsgfService
   */
  protected $dsgf_service;


  /**
   * Drupal\Core\State\State definition.
   *
   * @var Drupal\Core\State\State
   */
  protected $state;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, dsgfService $dsgf_service, State $state ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->dsgf_service=$dsgf_service;
    $this->state = $state;
  }
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('dsgf.dsgf_service'),
      $container->get('state')
    );
  }




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
    $output=$this->dsgf_service->getTagline();
    $count=$this->state->get('dsgf.count');
    return array(
      '#message' => $message,
      '#count' => $count,
      '#output' =>$output,
      '#theme' => 'hello_block',
    );
  }
}
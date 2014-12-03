<?php
namespace Drupal\dsgf\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class dsgfController extends ControllerBase{
  protected $demoService;
  /**
   * Class constructor.
   */
  public function __construct($demoService) {
    $this->demoService = $demoService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('dsgf.demo_service')
    );
  }

  public function helloworld($to, $from){
    //$message=$this->t("Hello World I am here");
    $message = $this->config('dsgf.settings')->get('default_text');

    $account = \Drupal::currentUser();  // another way is \Drupal::service('current_user');
    $name= $account->getUsername();
    $email = \Drupal::config('system.site')->get('mail');
    // Entity field query
    $query= \Drupal::entityQuery('node')
      ->condition('status' , 1);
    $nids = $query->execute();
    $node = entity_load('node', $nids[1]);
    $title=$node->title->value;
    kint($node);  //use of devel module... uses kint instead of dpm
    $service = \Drupal::service('dsgf.demo_service');
    kint($service);

    $demo_service=$this->demoService->getDemoValue();

    return [
      '#theme' => 'hello_page',
      '#message' => $message,
      '#to' => $to,
      '#from' => $from,
      '#name' => $name,
      '#mytitle'=>$title,
      '#email'=>$email,
      '#demoservice' => $demo_service,
    ];
  }
}
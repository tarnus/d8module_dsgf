<?php
namespace Drupal\dsgf\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dsgf\DemoService;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Entity\Query\QueryFactory;


class dsgfController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Drupal\dsgf\DemoService definition.
   *
   * @var Drupal\dsgf\DemoService
   */
  protected $dsgf_demo_service;

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var Drupal\Core\Session\AccountProxy
   */
  protected $current_user;

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var Drupal\Core\Entity\EntityManager
   */
  protected $entity_manager;

  /**
   * Drupal\Core\Entity\Query\QueryFactory definition.
   *
   * @var Drupal\Core\Entity\Query\QueryFactory
   */
  protected $entity_query;

  public function __construct(DemoService $dsgf_demo_service, AccountProxy $current_user, EntityManager $entity_manager, QueryFactory $entity_query) {
    $this->dsgf_demo_service = $dsgf_demo_service;
    $this->current_user = $current_user;
    $this->entity_manager = $entity_manager;
    $this->entity_query = $entity_query;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('dsgf.demo_service'),
      $container->get('current_user'),
      $container->get('entity.manager'),
      $container->get('entity.query')
    );
  }

  public function helloworld($to, $from){
    //$message=$this->t("Hello World I am here");
    $message = $this->config('dsgf.settings')->get('default_text');

    // Get account via service container
    $account = $this->current_user; // another way is \Drupal::service('current_user');
    $name= $account->getUsername();

    $email = \Drupal::config('system.site')->get('mail');

    // Get Demo service via service container
    $demo_service=$this->dsgf_demo_service->getDemoValue();

    // Entity field query via service container
    $query=$this->entity_query->get('node')
      ->condition('status' , 1);
    $nids = $query->execute();

    $node_storage=$this->entity_manager->getStorage('node');

    $node = $node_storage->load($nids[1]);

    $title=$node->title->value;

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
<?php

/**
 * @file
 * Contains Drupal\dsgf\Plugin\Block\DemoBlock.
 */

namespace Drupal\dsgf\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dsgf\DemoService;

/**
 * Provides a 'DemoBlock' block.
 *
 * @Block(
 *  id = "demo_block",
 *  admin_label = @Translation("demo_block")
 * )
 */
class DemoBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\dsgf\DemoService definition.
   *
   * @var Drupal\dsgf\DemoService
   */
  protected $dsgf_demo_service;

  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        DemoService $dsgf_demo_service
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->dsgf_demo_service = $dsgf_demo_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('dsgf.demo_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => 'demo_block',
    ];
  }

  /**
   * Overrides \Drupal\block\BlockBase::blockForm().
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['phrase'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phrase'),
      '#description' => $this->t(''),
      '#default_value' => $this->configuration['phrase'],
    ];
    return $form;
  }

  /**
   * Overrides \Drupal\block\BlockBase::blockSubmit().
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['phrase'] = $form_state->getValue('phrase');
  }
}

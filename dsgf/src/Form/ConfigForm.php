<?php
namespace Drupal\dsgf\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
class ConfigForm extends ConfigFormBase {
  public function getFormId(){
    return 'dsgf_config';
  }
  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('dsgf.settings');
    $form['default_text'] = [
      '#type' => textfield,
      '#title' => $this->t('Default text'),
      '#default_value' => $config->get('default_text'),
    ];
    return parent::buildForm($form, $form_state);
  }
  public function submitForm(array &$form, FormStateInterface $form_state){
    parent::submitForm($form, $form_state);
    $config = $this->config('dsgf.settings');
    $config->set('default_text', $form_state->getValue('default_text'));
    $config->save();
  }
}
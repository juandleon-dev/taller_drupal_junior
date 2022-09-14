<?php

namespace Drupal\entrenamiento_bits\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ApiConfigurationForm extends ConfigFormBase {

  public function getFormId(): string {
    return 'api_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['clave_api_bits'] = [
      '#type' => 'textfield',
      '#title' => $this->t('clave de Api de Bits'),
      '#maxlenght' => 255,
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('entrenamiento_bits.clave_api_bits')
      ->set('clave_api', $form_state->getValue('clave_api_bits'))
      ->save();

    parent::submitForm($form, $form_state);
  }

  protected function getEditableConfigNames(): array {
    return ['entrenamiento_bits.clave_api_bits'];
  }

}

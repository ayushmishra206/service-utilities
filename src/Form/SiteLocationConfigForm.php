<?php

namespace Drupal\site_utilities\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SiteLocationConfigForm builds all fields to set site location.
 *
 * @package Drupal\site_utilities\Form
 */
class SiteLocationConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'site_utilities.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'site_location_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('site_utilities.settings');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
      '#required' => TRUE,
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
      '#required' => TRUE,
    ];
    $form['time_options'] = [
      '#type' => 'value',
      '#value' => [
        'America/Chicago' => t('America/Chicago'),
        'America/New_York' => t('America/New_York'),
        'Asia/Tokyo' => t('Asia/Tokyo'),
        'Asia/Dubai' => t('Asia/Dubai'),
        'Asia/Kolkata' => t('Asia/Kolkata'),
        'Europe/Amsterdam' => t('Europe/Amsterdam'),
        'Europe/Oslo' => t('Europe/Oslo'),
        'Europe/London' => t('Europe/London'),
      ],
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#description' => "Select the Timezone.",
      '#options' => $form['time_options']['#value'],
      '#default_value' => $config->get('timezone'),
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('site_utilities.settings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}

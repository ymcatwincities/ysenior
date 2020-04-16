<?php

namespace Drupal\brand_referral\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Settings Form for Referral form.
 */
class ReferralSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'brand_referral_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'brand_referral.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('brand_referral.settings');

    $form['white_list'] = [
      '#type' => 'textarea',
      '#default_value' => $config->get('white_list'),
      '#description' => t('List of whitelisted partners'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    /* @var $config \Drupal\Core\Config\Config */
    $config = $this->configFactory->getEditable('brand_referral.settings');
    $config->set('white_list', $form_state->getValue('white_list'))->save();
    parent::submitForm($form, $form_state);
  }
}

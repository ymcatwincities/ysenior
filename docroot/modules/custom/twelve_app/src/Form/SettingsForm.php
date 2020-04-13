<?php

namespace Drupal\twelve_app\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Settings Form for openy_programs_search.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'twelve_app_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'twelve_app.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('twelve_app.settings');

    $form_state->setCached(FALSE);
    $form['actions'] = [
      '#type' => 'actions',
    ];

    $node_id = $config->get('node_id');
    $page = NULL;
    if (!empty($node_id)) {
      /** @var Node $page */
      $page = Node::load($node_id);
    }

    $form['node_id'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
      '#title' => t('Today exercises list page'),
      '#default_value' => $page,
      '#size' => 40,
      '#selection_settings' => [
        'target_bundles' => ['landing_page'],
      ],
      '#description' => t('Search by title'),
    ];

    $completion_node_id = $config->get('completion_node_id');
    $completion_node = NULL;
    if (!empty($completion_node_id)) {
      /** @var Node $page */
      $completion_node = Node::load($completion_node_id);
    }

    $form['completion_node_id'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
      '#title' => t('Completion page'),
      '#default_value' => $completion_node,
      '#size' => 40,
      '#selection_settings' => [
        'target_bundles' => ['landing_page'],
      ],
      '#description' => t('Search by title'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    /* @var $config \Drupal\Core\Config\Config */
    $config = $this->configFactory->getEditable('twelve_app.settings');
    $config->set('node_id', $form_state->getValue('node_id'))->save();
    $config->set('completion_node_id', $form_state->getValue('completion_node_id'))->save();
    parent::submitForm($form, $form_state);
  }
}

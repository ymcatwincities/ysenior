<?php

namespace Drupal\blazy\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\blazy\Dejavu\BlazyVideoBase;
use Drupal\blazy\Dejavu\BlazyVideoTrait;
use Drupal\blazy\BlazyFormatterManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'Blazy Video' to get VEF videos.
 *
 * @deprecated for \Drupal\blazy\Plugin\Field\FieldFormatter\BlazyMediaFormatter
 * @todo remove prior to full release. This means Slick Video which depends
 * on VEF is deprecated for Slick Media at Blazy 8.2.x with core Media only.
 */
class BlazyVideoFormatter extends BlazyVideoBase implements ContainerFactoryPluginInterface {

  use BlazyFormatterBaseTrait;
  use BlazyVideoTrait;

  /**
   * Constructs a BlazyFormatter object.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, BlazyFormatterManager $blazy_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->blazyManager = $blazy_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('blazy.formatter.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $build = [];

    // Early opt-out if the field is empty.
    if ($items->isEmpty()) {
      return $build;
    }

    // Collects specific settings to this formatter.
    $settings              = $this->buildSettings();
    $settings['blazy']     = TRUE;
    $settings['namespace'] = $settings['item_id'] = $settings['lazy'] = 'blazy';

    // Build the settings.
    $build = ['settings' => $settings];

    // Modifies settings.
    $this->blazyManager->buildSettings($build, $items);

    // Fecthes URI from the first item to build dimensions once.
    $this->buildVideo($build['settings'], $items[0]->value);

    // Build the elements.
    $this->buildElements($build, $items);

    // Updates settings.
    $settings = $build['settings'];
    unset($build['settings']);

    // Supports Blazy multi-breakpoint images if provided.
    if (!empty($settings['uri'])) {
      $this->blazyManager->isBlazy($settings, $build[0]['#build']);
    }

    $build['#blazy'] = $settings;
    $build['#attached'] = $this->blazyManager->attach($settings);
    return $build;
  }

  /**
   * Build the blazy elements.
   */
  public function buildElements(array &$build, $items) {
    $settings = $build['settings'];

    foreach ($items as $delta => $item) {
      $settings['input_url'] = strip_tags($item->value);

      $settings['delta'] = $delta;
      if (empty($settings['input_url'])) {
        continue;
      }

      $this->buildVideo($settings);

      $box = ['item' => $item, 'settings' => $settings];

      // Image with responsive image, lazyLoad, and lightbox supports.
      $build[$delta] = $this->blazyManager->getImage($box);
      unset($box);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getScopedFormElements() {
    return [
      'fieldable_form' => TRUE,
      'multimedia'     => TRUE,
      'view_mode'      => $this->viewMode,
    ] + parent::getScopedFormElements();
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    return $field_definition->getFieldStorageDefinition()->getType() === 'video_embed_field';
  }

}

<?php

namespace Drupal\media_directories_ui\Form;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Drupal\Core\Render\ElementInfoManagerInterface;
use Drupal\Component\Utility\Environment;
use Drupal\Core\Utility\Token;
use Drupal\media\MediaInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FileUploadForm extends AddMediaFormBase {

  /**
   * The element info discovery service.
   *
   * @var \Drupal\Core\Render\ElementInfoManagerInterface
   */
  protected $elementInfo;

  /**
   * AddMediaFormBase constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   * @param \Drupal\Core\Utility\Token $token
   * @param \Drupal\Core\Render\ElementInfoManagerInterface $element_info
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, AccountProxyInterface $current_user, Token $token, ElementInfoManagerInterface $element_info) {
    parent::__construct($entity_type_manager, $current_user, $token);
    $this->elementInfo = $element_info;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return \Drupal\Core\Form\FormBase|\Drupal\media_directories_ui\Form\AddMediaFormBase
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('current_user'),
      $container->get('token'),
      $container->get('element_info')
    );
  }

  protected function buildInputElement(array $form, FormStateInterface $form_state) {
    $max_filesize = Environment::getUploadMaxSize();
    $media_type = $this->getMediaType($form_state);

    $process = (array) $this->elementInfo->getInfoProperty('managed_file', '#process', []);


    $source_field = $media_type->getSource()->getConfiguration()['source_field'];
    $field_config = $this->entityTypeManager->getStorage('field_config')->load('media.' . $media_type->id() .'.' . $source_field);

    $form['container']['upload'] = [
      '#type' => 'managed_file',
      '#title' => $field_config->label(),
      '#description' => $this->t('Allowed file extensions: @extensions', ['@extensions' => $field_config->getSetting('file_extensions')]),
      '#upload_validators' => [
        'file_validate_extensions' => [$field_config->getSetting('file_extensions')],
      ],
      '#multiple' => TRUE,
      '#upload_location' => $this->getUploadLocation($field_config->getSettings()),
      '#process' => array_merge(['::validateUploadElement'], $process, ['::processUploadElement']),
    ];

    return $form;
  }

  /**
   * Validates the upload element.
   *
   * @param array $element
   *   The upload element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return array
   *   The processed upload element.
   */
  public function validateUploadElement(array $element, FormStateInterface $form_state) {
/*    if ($form_state::hasAnyErrors()) {
      // When an error occurs during uploading files, remove all files so the
      // user can re-upload the files.
      $element['#value'] = [];
    }
    $values = $form_state->getValue('upload', []);
    if (count($values['fids']) > $element['#cardinality'] && $element['#cardinality'] !== FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED) {
      $form_state->setError($element, $this->t('A maximum of @count files can be uploaded.', [
        '@count' => $element['#cardinality'],
      ]));
      $form_state->setValue('upload', []);
      $element['#value'] = [];
    }*/
    return $element;
  }

  /**
   * Processes an upload (managed_file) element.
   *
   * @param array $element
   *   The upload element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return array
   *   The processed upload element.
   */
  public function processUploadElement(array $element, FormStateInterface $form_state) {
    $element['upload_button']['#submit'] = ['::uploadButtonSubmit'];
    // Limit the validation errors to make sure
    // FormValidator::handleErrorsWithLimitedValidation doesn't remove the
    // current selection from the form state.
    // @see Drupal\Core\Form\FormValidator::handleErrorsWithLimitedValidation()
    $element['upload_button']['#limit_validation_errors'] = [
      ['upload'],
      ['current_selection'],
    ];
    $element['upload_button']['#ajax'] = [
      'callback' => '::updateFormCallback',
      'wrapper' => 'media-library-wrapper',
      // Add a fixed URL to post the form since AJAX forms are automatically
      // posted to <current> instead of $form['#action'].
      // @todo Remove when https://www.drupal.org/project/drupal/issues/2504115
      //   is fixed.
      'url' => Url::fromRoute('media_directories_ui.media.add'),
        'options' => [
          'query' => [
              'media_type' => ($form_state->get('media_type') ? $form_state->get('media_type')->id() : $form_state->get('selected_type')),
              'target_bundles' => $this->getTargetBundles($form_state),
              'active_directory' => $this->getDirectory($form_state),
              FormBuilderInterface::AJAX_FORM_REQUEST => TRUE,
            ],
        ],
    ];
    return $element;
  }

  /**
   * Submit handler for the upload button, inside the managed_file element.
   *
   * @param array $form
   *   The form render array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function uploadButtonSubmit(array $form, FormStateInterface $form_state) {
    $files = $this->entityTypeManager
      ->getStorage('file')
      ->loadMultiple($form_state->getValue('upload', []));
    $this->processInputValues($files, $form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function prepareMediaEntityForSave(MediaInterface $media) {
    /** @var \Drupal\file\FileInterface $file */
    $file = $media->get($this->getSourceFieldName($media->bundle->entity))->entity;
    $file->setPermanent();
    $file->save();
  }
}

<?php

namespace Drupal\openy_node_alert\Plugin\rest\resource;

use Drupal\Component\Utility\Unicode;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\path_alias\AliasManagerInterface;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Path\PathMatcherInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "alerts_rest_resource",
 *   label = @Translation("OpenY Alerts resource"),
 *   uri_paths = {
 *     "canonical" = "/alerts"
 *   }
 * )
 */
class AlertsRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The alias manager that caches alias lookups based on the request.
   *
   * @var \Drupal\path_alias\AliasManagerInterface
   */
  protected $aliasManager;

  /**
   * The Path Matcher.
   *
   * @var \Drupal\Core\Path\PathMatcherInterface
   */
  protected $pathMatcher;

  /**
   * The current path.
   *
   * @var \Drupal\Core\Path\CurrentPathStack
   */
  protected $currentPath;

  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Constructs a new AlertsRestResource object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   * @param \Drupal\path_alias\AliasManagerInterface $alias_manager
   *   The alias manager.
   * @param \Drupal\Core\Path\PathMatcherInterface $path_matcher
   *   The Path Matcher.
   * @param \Drupal\Core\Path\CurrentPathStack $current_path
   *   The current path.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user,
    AliasManagerInterface $alias_manager,
    PathMatcherInterface $path_matcher,
    CurrentPathStack $current_path,
    EntityTypeManagerInterface $entity_type_manager,
    ModuleHandlerInterface $module_handler) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->aliasManager = $alias_manager;
    $this->pathMatcher = $path_matcher;
    $this->currentPath = $current_path;
    $this->entityTypeManager = $entity_type_manager;
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('openy_node_alert'),
      $container->get('current_user'),
      $container->get('path_alias.manager'),
      $container->get('path.matcher'),
      $container->get('path.current'),
      $container->get('entity_type.manager'),
      $container->get('module_handler')
    );
  }

  /**
   * Responds to GET requests.
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   *   The HTTP response object.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   * @throws \HttpException
   */
  public function get() {

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    // Get data from draggableviews_structure table.
    $query = \Drupal::database()->select('draggableviews_structure', 'dvs');
    $query->fields('dvs', ['view_name', 'view_display', 'entity_id', 'weight']);
    $query->condition('dvs.view_name', 'alerts_rearrange');
    $query->condition('dvs.view_display', 'page_1');
    $query->orderBy('dvs.weight');
    $weights = $query->execute()->fetchAll();

    // If draggableviews_structure table is not pre-populated we load all nids with default sort.
    $loadByProperties = ['type' => 'alert', 'status' => 1];
    if (!empty($weights)) {
      foreach ($weights as $row) {
        $nids[] = $row->entity_id;
      }
      $loadByProperties = ['type' => 'alert', 'nid' => $nids, 'status' => 1];
    }

    $alerts_entities = $this->entityTypeManager
      ->getStorage('node')
      ->loadByProperties($loadByProperties);

    $alerts = $alerts_entities;

    // Sort alert based on draggable_views data.
    if (!empty($weights)) {
      $alerts = [];
      foreach ($weights as $row) {
        if (!isset($alerts_entities[(int)$row->entity_id])) {
          continue;
        }
        $alerts[(int)$row->entity_id] = $alerts_entities[(int)$row->entity_id];
      }
    }

    $sendAlerts = [];
    /** @var \Drupal\node\Entity\Node $alert */
    foreach ($alerts as $alert) {
      if (!$alert->hasField('field_alert_visibility_pages')) {
        if ($alert->hasField('field_alert_belongs') && !$alert->field_alert_belongs->isEmpty() && !$alert->field_alert_place->isEmpty()) {
          $refid = $alert->field_alert_belongs->target_id;
          $alias = $this->aliasManager->getAliasByPath('/node/' . $refid);
          if ($_GET['uri'] != $alias) {
            // Do not show alerts for current page.
            continue;
          }
          $sendAlerts[$alert->field_alert_place->value]['local'][] = self::formatAlert($alert);
        }
        elseif ($alert->hasField('field_alert_belongs') && $alert->field_alert_belongs->isEmpty() && !$alert->field_alert_place->isEmpty()) {
          $sendAlerts[$alert->field_alert_place->value]['global'][] = self::formatAlert($alert);
        }
        else {
          throw new \HttpException('Field configuration for alerts is wrong');
        }
      }
      else {
        if ($this->checkVisibility($alert)) {
          $sendAlerts[$alert->field_alert_place->value]['local'][] = self::formatAlert($alert);
        }
      }
    }

    $this->moduleHandler->alter('openy_node_alert_get', $sendAlerts, $alerts);

    return new ModifiedResourceResponse($sendAlerts, 200);
  }

  /**
   * Helper function for alerts formatting.
   *
   * @param \Drupal\node\NodeInterface $alert
   *   Alert node.
   *
   * @return array
   *   Formatted alert.
   */
  public static function formatAlert(NodeInterface $alert) {
    $url = $alert->field_alert_link->uri != NULL ? Url::fromUri($alert->field_alert_link->uri)
      ->setAbsolute()
      ->toString() : NULL;

    $iconColor = '';
    if ($alert->field_alert_icon_color && $alert->field_alert_icon_color->entity && $alert->field_alert_icon_color->entity->field_color && $alert->field_alert_icon_color->entity->field_color->value) {
      $iconColor = $alert->field_alert_icon_color->entity->field_color->value;
    }

    return [
      'title' => $alert->getTitle(),
      'textColor' => $alert->field_alert_text_color->entity->field_color->value,
      'bgColor' => $alert->field_alert_color->entity->field_color->value,
      'description' => $alert->field_alert_description->value,
      'iconColor' => $iconColor,
      'linkUrl' => $url,
      'linkText' => $alert->field_alert_link->title,
      'id' => $alert->id(),
    ];
  }

  /**
   * Check visibility of alert.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Alert node.
   *
   * @return bool
   *   Visibility status, TRUE if visible.
   */
  private function checkVisibility(NodeInterface $node) {

    $pages = '';
    if ($node->hasField('field_alert_visibility_pages')) {
      $pages = $node->get('field_alert_visibility_pages')->value;
    }

    $state = 'include';
    if ($node->hasField('field_alert_visibility_state')) {
      $state = $node->get('field_alert_visibility_state')->value;
    }

    $pages = Unicode::strtolower($pages);
    if (!$pages) {
      // Global alert.
      return TRUE;
    }


    // Convert path to lowercase. This allows comparison of the same path.
    // with different case. Ex: /Page, /page, /PAGE.
    // Compare the lowercase path alias (if any) and internal path.
    $current_path = $_GET['uri'];
    $path = $this->aliasManager->getAliasByPath($current_path);
    $path = Unicode::strtolower($path);

    // Do not trim a trailing slash if that is the complete path.
    $path = $path === '/' ? $path : rtrim($path, '/');

    $is_path_match = $this->pathMatcher->matchPath($path, $pages);
    if ($state == 'include' && $is_path_match || $state == 'exclude' && !$is_path_match) {
      // Local alert.
      return TRUE;
    }

    return FALSE;
  }

}

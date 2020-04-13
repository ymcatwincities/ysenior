<?php

namespace Drupal\openy_myy\Plugin\rest\resource;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\personify\PersonifySSO;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Drupal\openy_myy\PluginManager\MyYDataProfile;

/**
 * Family list resource
 *
 * @RestResource(
 *   id = "myy_profile_family_list",
 *   label = @Translation("List of Family members"),
 *   uri_paths = {
 *     "canonical" = "/myy-model/data/profile/family-list"
 *   }
 * )
 */
class MyYProfileFamilyList extends ResourceBase {


  /**
   * @var \Drupal\openy_myy\PluginManager\MyYDataProfile
   */
  protected $myYDataProfile;

  /**
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * @var \Drupal\personify\PersonifySSO
   */
  protected $personifySSO;

  /**
   * MyYProfileFamilyList constructor.
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param array $serializer_formats
   * @param \Psr\Log\LoggerInterface $logger
   * @param \Drupal\openy_myy\PluginManager\MyYDataProfile $myYDataProfile
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   * @param \Drupal\personify\PersonifySSO $personifySSO
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    MyYDataProfile $myYDataProfile,
    ConfigFactoryInterface $configFactory,
    PersonifySSO $personifySSO
   ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->config = $configFactory->get('openy_myy.settings');
    $this->myYDataProfile = $myYDataProfile;
    $this->personifySSO = $personifySSO;
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
      $container->get('logger.factory')->get('openy_myy_data_profile'),
      $container->get('plugin.manager.myy_data_profile'),
      $container->get('config.factory'),
      $container->get('personify.sso_client')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function get() {

    $myy_config = $this->config->getRawData();
    $myy_authenticator_instances = $this->myYDataProfile->getDefinitions();
    if (array_key_exists($myy_config['myy_data_profile'], $myy_authenticator_instances)) {

      $id = $this->personifySSO->getCustomerIdentifier($_COOKIE['Drupal_visitor_personify_authorized']);
      $cid = 'myy_data_profile:' . $id;

      if ($cache = \Drupal::cache()->get($cid)) {
        $response = $cache->data;
      } else {
        $response = $this
          ->myYDataProfile
          ->createInstance($myy_config['myy_data_profile'])
          ->getFamilyInfo();
        \Drupal::cache()->set($cid, $response, REQUEST_TIME + 3600);
      }

    } else {
      return new NotFoundHttpException();
    }

    $result = new ResourceResponse($response);

    $result->addCacheableDependency($response);

    return $result;

  }

}

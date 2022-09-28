<?php

namespace Drupal\site_location\Plugin\Block;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\site_location\SiteLocationInterface;


/**
 * Provides a 'Timezone' Block.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Timezone block")
 * )
 */
class TimezoneBlock extends BlockBase implements  ContainerFactoryPluginInterface {

  /**
   * @var SiteLocationInterface|string
   */
  protected $customTimezone;
  /**
   * @var ConfigFactory
   */
  protected $configFactory;

    /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param string $customTimezone
   */
  public function __construct($configuration, $plugin_id, $plugin_definition, SiteLocationInterface $customTimezone, ConfigFactory $configFactory) 
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->customTimezone = $customTimezone;
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, $configuration, $plugin_id, $plugin_definition): static
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('site_location.timezone_services'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() 
  {
    return ['label_display' => FALSE];
  }

  /**
   * {@inheritdoc}
   */
  public function build() 
  {

    $custom_timezone = $this->configFactory->get('site_location.settings')->get('timezone');
    $country = $this->configFactory->get('site_location.settings')->get('country');
    $city = $this->configFactory->get('site_location.settings')->get('city');

    $dateTime = $this->customTimezone->getTimezoneData($custom_timezone);
    $timeStamp = strtotime($dateTime);
    $date = date('l, d F Y', $timeStamp);
    $time = date('h:i A', $timeStamp);
    return array (
      '#theme' => 'custom_timezone',
      '#date' => $date,
      '#time' => $time,
      '#country' => $country,
      '#city' => $city,
      '#cache' => [
        'max-age' => 1,
      ]
    );

}
}
<?php

namespace Drupal\site_location\Services;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\site_location\SiteLocationInterface;

/**
 * Class CustomService.
 */
class TimezoneService implements SiteLocationInterface 
{

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructs a Timezone Object
   *
   * @param \Drupal\Core\Config\ConfigFactory $configFactory
   * The config factory
   */
  public function __construct(ConfigFactory $configFactory) 
  {
    $this->configFactory = $configFactory;
  }

  /**
   * Returns date and time of a timezone
   */
  public function getTimezoneData($custom_timezone) 
  {
    
    $siteSettings = $this->configFactory->get('system.date')->get('timezone');
    $test_timezone = ($custom_timezone != 'none') ? $custom_timezone : $default_timezone;
    $date_time = new DrupalDateTime('now', $test_timezone);

    return $date_time->format("dS M Y H:i");

  }

}
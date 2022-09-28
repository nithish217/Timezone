<?php

namespace Drupal\site_location;

/**
 * Provides an interface.
 */
interface SiteLocationInterface 
{
  /**
   * Returns the date and time
   *   
   * @return string
   */
  public function getTimezoneData($custom_timezone);
  
}

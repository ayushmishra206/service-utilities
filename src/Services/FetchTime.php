<?php

namespace Drupal\site_utilities\Services;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a service which returns time based on the timezone.
 */
class FetchTime {

  /**
   * {@inheritdoc}
   */
  public function setTime() {
    $config = \Drupal::configFactory();
    $timezone = $config->getEditable('site_utilities.settings')->get('timezone');
    $date = new DrupalDateTime("now", new \DateTimeZone($timezone));
    $date = $date->format('jS M Y - g:i A');
    return $date;
  }

}

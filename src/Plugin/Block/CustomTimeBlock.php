<?php

namespace Drupal\site_utilities\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom Block which renders time from a custom service.
 *
 * @Block(
 *   id = "custom_time_block",
 *   admin_label = @Translation("Custom Time Block"),
 *   category = @Translation("Custom"),
 * )
 */
class CustomTimeBlock extends BlockBase {

  /**
   * Used to save the current date and time.
   *
   * @var date
   */
  protected $date;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->$date = \Drupal::service('site_utilities.fetch_time');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $time = $this->$date->setTime();
    return [
      '#theme' => 'time-block',
      '#time' => $time,
      '#cache' => [
        'max-age' => 60,
      ],
    ];
  }

}

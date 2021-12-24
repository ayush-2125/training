<?php

namespace Drupal\temp_mod\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
/**
 * Processes Tasks for temp_mod.
 *
 * @QueueWorker(
 *   id = "temp_queue",
 *   title = @Translation("temp_mod task worker: temp queue"),
 *   cron = {"time" = 10}
 * )
 */
class TempQueue extends QueueWorkerBase {
  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
  }
}
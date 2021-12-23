<?php

namespace Drupal\node_delete\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\node\Entity\Node;

/**
 * Processes Node Tasks.
 *
 * @QueueWorker(
 *   id = "node_delete_processor",
 *   title = @Translation("Task Worker: Node"),
 *   cron = {"time" = 10}
 * )
 */
class NodeDeleteProcessor extends QueueWorkerBase {

  /**
   * {@inheritdoc}
   */
  public function processItem($response) {
    \Drupal::logger('node_delete')->notice('Cron ran');
    $storage_handler = \Drupal::entityTypeManager()->getStorage('node');
    $entities = $storage_handler->loadMultiple($smaller_batch_data);
    $storage_handler->delete($entities);
  }
}
<?php

namespace Drupal\custom_cron;

use Drupal\node\Entity\Node;

class SendEmail {

  public static function sendManagerEmail($unpublishedId, &$context){
    $message = 'Sending Email...';
    $results = array();
    foreach ($unpublishedId as $unpublishedId) {
      array(
        '\Drupal\custom_cron\EmailProcess::emailProcessing',);
    }
    $context['message'] = $message;
    $context['results'] = $results;
  }

  public static function sendManagerEmailFinishedCallback($success, $results, $operations) {
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'One Project processed.', '@count Project processed.'
      );
    }
    else {
      $message = t('Finished with an error.');
    }
    \Drupal::messenger()->addMessage($message);
  }
}
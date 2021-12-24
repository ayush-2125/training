<?php

namespace Drupal\custom_cron\Email;

use Drupal\node\Entity\Node;
use Drupal\user\Entity\User;

/**
* Class for e-mail processing.
*/

class EmailProcess {
  public static function emailProcessing() {
    //Getting emails by role : manager
    $ids = \Drupal::entityQuery('user')
           ->condition('status', 1)
           ->condition('roles', 'manager')
           ->condition('field_product_owner', 'user')
           ->execute();
    $users = User::loadMultiple($ids);
    foreach($users as $user){
      $manageremails = $user->get('mail')->getString();
    }
      // Mail Function
    foreach($manageremails as $manageremail){
      // Invokes Drupal mail module    
      $mailManager = \Drupal::service('plugin.manager.mail');
      $module = 'custom_cron';
      $key = 'project_delete';
      $to = $manageremail;
      $langcode = \Drupal::currentUser()->getPreferredLangcode();
      $send = TRUE;
      $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
      if ($result['result'] !== TRUE) {
        $message = t('There was a problem sending your email ', array('@email' => $to, '@id' => $entity->id()));
        \Drupal::messenger()->addMessage($message, 'error');
        \Drupal::logger('custom_cron')->error($message);
        return;
      }
      $message = t('An email notification has been sent to @email for creating node @id.', array('@email' => $to, '@id' => $entity->id()));
      \Drupal::messenger()->addMessage($message);
      \Drupal::logger('custom_mail')->notice($message);
    }
  }
}

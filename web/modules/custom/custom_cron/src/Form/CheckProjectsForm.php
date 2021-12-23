<?php

namespace Drupal\custom_cron\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CheckProjectsForm.
 *
 * @package Drupal\custom_cron\Form
 */
class CheckProjectsForm extends FormBase {

/**
* {@inheritdoc}
*/
  public function getFormId() {
    return 'check_projects_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['check_projects'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Check Projects'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  //Checking Unpublished Projects
      $unpublished = \Drupal::entityQuery('node')
                    ->condition('type', 'project')
                    ->condition('status', '0')
                    ->execute();
      $unpublishedId = $unpublished->id();
    //Checking related Tasks
      foreach($unpublishedId as $unpublishedId){
        $unpublishedTasks = \Drupal::entityQuery('node')
                            ->condition('type', 'tasks')
                            ->condition('field_task_project', $unpublishedId)
                            ->execute();
      }
    $batch = array(
      'title' => t('Sending Emails...'),
      'operations' => array(
        array(
          '\Drupal\custom_cron\SendEmail::sendManagerEmail',
        ),
      ),
      'finished' => '\Drupal\custom_cron\SendEmail::sendManagerEmailFinishedCallback',
    );

    batch_set($batch);
  }

}

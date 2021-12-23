<?php
/**
 * @file
 * Contains \Drupal\temp_mod\Form\FormQueue.
 */

namespace Drupal\temp_mod\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class FormQueue extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
     return 'queue_forms';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $data['queueItem'] = \Drupal::logger('temp_mod')->notice('Queue functtioning'); 
    $queue = \Drupal::queue('temp_queue');
    $queue->createQueue();
    $queue->createItem($data);
  }
}
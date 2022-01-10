<?php

namespace Drupal\node_deletion\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DeleteNodeForm.
 *
 * @package Drupal\node_deletion\Form
 */
class DeleteNodeForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'delete_node_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['from_nid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('From node ID'),
      '#required' => TRUE,
    ];
    $form['to_nid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('To node ID'),
      '#required' => TRUE,
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Delete nodes in batches'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $from_nid = $form_state->getValue('from_nid');
    $to_nid = $form_state->getValue('to_nid');
    $nids = \Drupal::entityQuery('node')
      ->condition('type', 'article')
      ->condition('nid', $from_nid, '>=')
      ->condition('nid', $to_nid, '<=')
      ->execute();

    $batch = [
      'title' => t('Deleting Node...'),
      'operations' => [
        [
          '\Drupal\node_deletion\DeleteNode::deleteNodeProcess',
          [$nids],
        ],
      ],
      'finished' => '\Drupal\node_deletion\DeleteNode::deleteNodeProcessFinishedCallback',
    ];

    batch_set($batch);
  }

}

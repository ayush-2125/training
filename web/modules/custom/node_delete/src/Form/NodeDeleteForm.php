<?php

namespace Drupal\node_delete\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class NodeDeleteForm.
 */
class NodeDeleteForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'node_delete.nodedeletesettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'node_delete_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('node_delete.nodedeletesettings');
    $form['from_node'] = [
      '#type' => 'textfield',
      '#title' => $this->t('From Node'),
      '#description' => $this->t('Enter starting node id'),
    ];
    $form['to_node'] = [
      '#type' => 'textfield',
      '#title' => $this->t('To Node'),
      '#description' => $this->t('Enter Ending node id'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('node_delete.nodedeletesettings')
      ->set('from_node', $form_state->getValue('from_node'))
      ->set('to_node', $form_state->getValue('to_node'))
      ->save();
  }
}
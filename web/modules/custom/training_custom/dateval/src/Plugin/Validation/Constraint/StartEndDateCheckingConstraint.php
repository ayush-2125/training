<?php

namespace Drupal\dateval\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks if "End Date" not empty.
 *
 * "Start Date" must be not empty
 * and "End Date" must be greater then "Start Date".
 *
 * @Constraint(
 *   id = "StartEndDateChecking",
 *   label = @Translation("Start/End Date checking", context = "Validation")
 * )
 */
class StartEndDateCheckingConstraint extends Constraint {
  /**
   * Error Message.
   */
  public $message = '"End Date" may not be less than "Start Date".';

}
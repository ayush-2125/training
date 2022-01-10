<?php

namespace Drupal\dateval\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Validates start/end date.
 */
class StartEndDateCheckingConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($entity, Constraint $constraint) {

    $entity = $entity->getEntity();
    $start_date = $entity->get('field_project_start_date')->getString();
    $end_date = $entity->get('field_project_end_date')->getString();
    if ($end_date == '') {
      return;
    }

    $tz = date_default_timezone_get();
    $start_date = new DrupalDateTime($start_date, $tz);
    $end_date = new DrupalDateTime($end_date, $tz);

    if ($start_date > $end_date) {
      $this->context->addViolation($constraint->message);
    }
  }

}

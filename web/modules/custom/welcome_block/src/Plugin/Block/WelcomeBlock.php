<?php

namespace Drupal\Welcome_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;

/**
 * Provides a 'Welcome Block' Block.
 *
 * @Block(
 *   id = "welcome_block",
 *   admin_label = @Translation("Welcome block"),
 *   category = @Translation("Our Welcome text block"),
 * )
 */
class WelcomeBlock extends BlockBase {

  /**
   * Provides function for caching, and output.
   */
  public function build() {
    return [
      '#markup' => $this->welcometext(),
      '#cache' => [
        'contexts' => ['user'],
        'tags' => ['user:' . \Drupal::currentUser()->id()],
      ],
    ];
  }

  /**
   * Gets user variables (gender,name) and gives output accordingly.
   */
  private function welcometext() {
    $user = User::load(\Drupal::currentUser()->id());
    $gender = $user->field_user_gender->value;
    $name = $user->get('name')->value;
    $male = "Welcome Sir $name !";
    $female = "Welcome Ma'am $name !";
    $unknown = "Welcome Sir/Ma'am $name !" ;

    if ($gender == 'Male') {
      return '<h1>' . $male . '</h1>';
    }
    elseif($gender == 'Female') {
      return '<h1>' . $female . '</h1>';
    }
    else {
      return '<h1>' . $unknown . '</h1>';
    }
  }

}

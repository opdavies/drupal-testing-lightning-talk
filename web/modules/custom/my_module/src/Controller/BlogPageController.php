<?php

declare(strict_types=1);

namespace Drupal\my_module\Controller;

use Drupal\Core\StringTranslation\StringTranslationTrait;

final class BlogPageController {

  use StringTranslationTrait;

  /**
   * @return array<string, mixed>
   */
  public function __invoke(): array {
    return [
      '#markup' => $this->t('Welcome to my blog!'),
    ];
  }

}

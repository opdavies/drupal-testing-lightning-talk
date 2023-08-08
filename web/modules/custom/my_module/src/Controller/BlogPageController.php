<?php

declare(strict_types=1);

namespace Drupal\my_module\Controller;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\EntityViewBuilderInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\my_module\Repository\ArticleRepository;

final class BlogPageController {

  use StringTranslationTrait;

  private EntityViewBuilderInterface $nodeViewBuilder;

  public function __construct(
    private RendererInterface $renderer,
    EntityTypeManagerInterface $entityTypeManager,
    private ArticleRepository $articleRepository,
  ) {
    $this->nodeViewBuilder = $entityTypeManager->getViewBuilder(entity_type_id: 'node');
  }

  /**
   * @return array<string, mixed>
   */
  public function __invoke(): array {
    $articles = $this->articleRepository->getAll();

    if ($articles === []) {
      return ['#markup' => $this->t('Welcome to my blog!')];
    }

    $build = [];

    foreach ($articles as $article) {
      $build[] = $this->nodeViewBuilder->view(
        entity: $article,
        view_mode: 'teaser',
      );
    }

    return [
      '#markup' => $this->renderer->render($build),
    ];
  }

}

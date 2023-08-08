<?php

declare(strict_types=1);

namespace Drupal\my_module\Repository;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

final class ArticleRepository {

  private EntityStorageInterface $nodeStorage;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->nodeStorage = $entityTypeManager->getStorage(entity_type_id: 'node');
  }

  /**
   * @return array<int, NodeInterface>
   */
  public function getAll(): array {
    /** @var array<int, NodeInterface> */
    $articles = $this->nodeStorage->loadByProperties([
      'status' => NodeInterface::PUBLISHED,
      'type' => 'article',
    ]);

    // Sort the articles by their created time.
    uasort($articles, function (NodeInterface $a, NodeInterface $b): int {
      return $a->getCreatedTime() < $b->getCreatedTime() ? 1 : -1;
    });

    return $articles;
  }

}

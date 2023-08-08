<?php

declare(strict_types=1);

namespace Drupal\Tests\my_module\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

final class BlogPageTest extends BrowserTestBase {

  public $defaultTheme = 'stark';

  protected static $modules = [
    // Core.
    'node',

    // Custom.
    'my_module',
  ];

  /** @test */
  public function the_blog_page_loads_for_anonymous_users_and_contains_the_right_text(): void {
    $this->drupalGet('/blog');

    $assert = $this->assertSession();

    $assert->statusCodeEquals(Response::HTTP_OK);
    $assert->responseContains('<h1>Blog</h1>');
    $assert->pageTextContains('Welcome to my blog!');
  }

}

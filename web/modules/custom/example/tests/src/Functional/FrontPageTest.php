<?php

declare(strict_types=1);

namespace Drupal\Tests\example\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

final class FrontPageTest extends BrowserTestBase {

  public $defaultTheme = 'stark';

  protected static $modules = ['node', 'views'];

  /** @test */
  public function the_front_page_loads_for_anonymous_users(): void {
    $this->config('system.site')
      ->set('page.front', '/node')
      ->save(TRUE);

    $this->drupalGet('<front>');

    $assert = $this->assertSession();

    $assert->statusCodeEquals(Response::HTTP_OK);
    $assert->pageTextContains('No front page content has been created yet.');
  }

}

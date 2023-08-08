<?php

declare(strict_types=1);

namespace Drupal\Tests\example\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

final class AdminPageTest extends BrowserTestBase {

  public $defaultTheme = 'stark';

  /** @test */
  public function the_admin_page_is_not_accessible_to_anonymous_users(): void {
    $this->drupalGet(path: '/admin');

    $assert = $this->assertSession();

    $assert->statusCodeEquals(Response::HTTP_FORBIDDEN);
  }

  /** @test */
  public function the_admin_page_is_accessible_by_admin_users(): void {
    $adminUser = $this->createUser(
      permissions: [
        'access administration pages',
      ],
    );

    $this->drupalLogin(account: $adminUser);

    $this->drupalGet(path: '/admin');

    $assert = $this->assertSession();

    $assert->statusCodeEquals(Response::HTTP_OK);
  }

}

<?php

namespace Drupal\Tests\localgov_directories_venue\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\node\Traits\NodeCreationTrait;
use Drupal\Tests\system\Functional\Menu\AssertBreadcrumbTrait;

/**
 * Tests localgov step by step pages working together.
 *
 * @group localgov_step_by_step
 */
class DirectoryVenueTest extends BrowserTestBase {

  use NodeCreationTrait;
  use AssertBreadcrumbTrait;

  /**
   * Test breadcrumbs in the Standard profile.
   *
   * @var string
   */
  protected $profile = 'standard';

  /**
   * A user with permission to bypass content access checks.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * The node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  protected $nodeStorage;

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = [
    'localgov_directories_venue',
    'field_ui',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->adminUser = $this->drupalCreateUser([
      'bypass node access',
      'administer nodes',
      'administer node fields',
    ]);
  }

  /**
   * Verifies basic functionality with all modules.
   */
  public function testDirectoryVenueFields() {
    $this->drupalLogin($this->adminUser);
    $this->drupalGet('/admin/structure/types/manage/localgov_directories_venue/fields');
    $this->assertSession()->pageTextContains('body');
    $this->assertSession()->pageTextContains('localgov_directory_job_title');
    $this->assertSession()->pageTextContains('localgov_directory_name');
    $this->assertSession()->pageTextContains('localgov_directory_phone');
    $this->assertSession()->pageTextContains('localgov_directory_channels');
    $this->assertSession()->pageTextContains('localgov_directory_email');
    $this->assertSession()->pageTextContains('localgov_directory_website');
    $this->assertSession()->pageTextContains('localgov_directory_facets_select');
    $this->assertSession()->pageTextContains('localgov_directory_files');
    $this->assertSession()->pageTextContains('localgov_directory_notes');
    $this->assertSession()->pageTextContains('localgov_directory_opening_times');
  }

}

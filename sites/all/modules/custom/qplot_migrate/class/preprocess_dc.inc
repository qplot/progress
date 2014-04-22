<?php

/**
 * @file
 * Preprocesses CSV data so it can be imported by the Migration.
 */

class DCPreprocessMigration extends MigrationBase {
  /**
   * API settings.
   */
  public $api = array(
    'url' => 'https://drupalconnect.teamworkpm.net',
    // 'token' => 'atom614guitar'
  );

  /**
   * Source path.
   */
  public $migratePath = '';

  /**
   * Phantom JS
   */
  protected $phantomjs = '';

  /**
   * Constructor.
   */
  public function __construct($arguments) {
    parent::__construct($arguments);

    $this->phantomjs = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/phantomjs/pull.js';

    // $this->migratePath = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate');
    $this->migratePath = PROGRESS_MIGRATE_DATA_DIR;
  }

  /**
   * IsComplete.
   */
  public function isComplete() {
    return FALSE;
    // $path = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/compiled';

    // $directory = new DirectoryIterator($path);
    // return count($directory) > 0;
  }

  /**
   * Performs preprocessing step, combining separate CSV files into a single file for each migration.
   *
   * @return MigrationBase::RESULT
   *   A result specifier. Uses static constants defined in MIgrationBase.
   *
   * @author Jay Roberts <jay@designhammer.com>
   */
  public function import() {
    $use_phantomjs = TRUE;

    $data_path = $this->migratePath . '/data';
    $compiled_path = $this->migratePath . '/compiled';

    // Ensure 'compiled' folder exists.
    if (!is_dir($compiled_path)) {
      $result = @mkdir($compiled_path);
      if ($result === FALSE) {
        self::displayMessage('Compiled folder does not exist.');
        return MigrationBase::RESULT_FAILED;
      }
    }

    // Compile the CSV files in each of these folders into a single file for each folder.
    $dirs = array(
      'company_dc',
      'user_dc',
    );
    // Make sure all folder exists.
    foreach ($dirs as $dir) {
      if (is_dir($data_path . '/' . $dir)) {

        $saved_dir = $compiled_path . '/' . $dir;
        if (!is_dir($saved_dir)) {
          $result = @mkdir($saved_dir);
          if ($result === FALSE) {
            self::displayMessage('Compiled folder does not exist.');
            return MigrationBase::RESULT_FAILED;
          }
        }
      }
    }

    $processed_dir = array(
      // Prepare users.
      'user_dc' => array('path' => 'data/company_dc'),
    );

    $project_lists = array();

    foreach ($processed_dir as $dir => $source_path) {
      $i = 0;
      $parts = explode('-', $dir);
      // Preprocess.
      if ($parts[0] == 'pre') {
      }
      else {
        $saved_dir = $compiled_path . '/' . $dir;
        $source_dir = $data_path . '/' . $dir;
        if (!empty($source_path)) {
          $source_dir = $this->migratePath . '/' . $source_path['path'];
        }
        $directory = new DirectoryIterator($source_dir);
        foreach ($directory as $fileinfo) {
          if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
            $file = file_get_contents($fileinfo->getPathname());
            $xml = simplexml_load_string($file);

            switch ($dir) {

              case 'user_dc':
                foreach ($xml->company as $company) {
                  $id = (string) $company->id;
                  $output = $saved_dir . '/' . $id . '.xml';

                  if (!file_exists($output)) {
                    $this->downloadXML('companies/' . $id . '/people.xml', $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' companies saved to user_dc/' . $fileinfo->getFilename());
                }
                break;
            }
          }
        }
      }
    }

    return MigrationBase::RESULT_COMPLETED;
  }

  /**
   * Download xml use api syntax.
   */
  protected function downloadXml($command, $output) {
    $link = $this->api['url'] . '/' . $command;

    // Save directly to disk.
    // $page = file_get_contents($link);
    // file_put_contents($saved_dir . '/' . $id . '.xml', $page);

    // Use phantomjs to help us get around the https issue.
    $exec = 'sudo -u fjin /usr/local/bin/phantomjs ' . $this->phantomjs . ' ' .
      escapeshellarg($link) . ' ' . escapeshellarg($output);
    // dsm($exec);
    exec($exec);
  }

}

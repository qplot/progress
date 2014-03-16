<?php

/**
 * @file
 * Preprocesses CSV data so it can be imported by the Migration.
 */

class DHPreprocessMigration extends MigrationBase {

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
    $phantomjs = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/phantomjs/pull.js';

    $data_path = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data';
    $compiled_path = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/compiled';

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
      'company',
      'user',
      'project',
    );
    $api = array(
      // 'url' => 'https://qplot.manageprojects.com/api.php',
      // 'token' => '1-bm4xON3HasMFpm7qg9oea9sUvfy1j1WkbOHPqzmr',
      'url' => 'https://ac.designhammer.net/api.php',
      'token' => '217-qUrX6d8cJVc69tPndSrqtgcDI2meGkXW5eIZiF2S',
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
      // 'company',
      // 'user',
      'project',
    );

    foreach ($processed_dir as $dir) {
      $saved_dir = $compiled_path . '/' . $dir; 
      $directory = new DirectoryIterator($data_path . '/' . $dir);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $file = file_get_contents($fileinfo->getPathname());
          $xml = simplexml_load_string($file);

          switch ($dir) {

            case 'company':
              foreach ($xml->company as $company) {
                $id = (string)$company->id;
                $output = $saved_dir . '/' . $id . '.xml';

                if (!file_exists($output)) {
                  $link = $api['url'] . '?path_info=people/' . $id . '&auth_api_token=' . $api['token'];

                  // save directly to disk
                  // $page = file_get_contents($link);
                  // file_put_contents($saved_dir . '/' . $id . '.xml', $page);

                  // use phantomjs to help us get around the https issue
                  $exec = 'sudo -u fjin /usr/local/bin/phantomjs ' . $phantomjs . ' ' . escapeshellarg($link) . ' ' . escapeshellarg($output);
                  exec($exec);
                }

              }
              break;

            // User uses company raw data folder
            case 'user':
              $id = (string)$xml->id;
              foreach ($xml->users->children() as $user) {
                $uid = (string)$user->id;
                $output = $saved_dir . '/' . $uid . '.xml';

                if (!file_exists($output)) {
                  $link = $api['url'] . '?path_info=people/' . $id . '/users/' . $uid . '&auth_api_token=' . $api['token'];
                  // dsm($link); break;
                  $exec = 'sudo -u fjin /usr/local/bin/phantomjs ' . $phantomjs . ' ' . escapeshellarg($link) . ' ' . escapeshellarg($output);
                  exec($exec);
                }
              }
              break;

            case 'project':
              foreach ($xml->project as $project) {
                $id = (string)$project->id;
                $output = $saved_dir . '/' . $id . '.xml';

                if (!file_exists($output)) {
                  $link = $api['url'] . '?path_info=projects/' . $id . '&auth_api_token=' . $api['token'];
                  // dsm($link); break;
                  $exec = 'sudo -u fjin /usr/local/bin/phantomjs ' . $phantomjs . ' ' . escapeshellarg($link) . ' ' . escapeshellarg($output);
                  exec($exec);
                }
              }
              break;
            
            default:
              # code...
              break;
          }

        }
      }
    }

    return MigrationBase::RESULT_COMPLETED;
  }

  public function rollback() {
    $compiled_path = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/compiled';
    if (!is_dir($compiled_path)) {
      return MigrationBase::RESULT_COMPLETED;
    }

    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($compiled_path, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
        $path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname());
    }
    // rmdir($compiled_path);
  }

}

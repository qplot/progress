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
    );

    $api = array(
      // 'url' => 'https://qplot.manageprojects.com/api.php',
      // 'token' => '1-bm4xON3HasMFpm7qg9oea9sUvfy1j1WkbOHPqzmr',
      'url' => 'https://ac.designhammer.net/api.php',
      'token' => '217-qUrX6d8cJVc69tPndSrqtgcDI2meGkXW5eIZiF2S',
    );
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

        $directory = new DirectoryIterator($data_path . '/' . $dir);
        foreach ($directory as $fileinfo) {
          if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
            // dsm($fileinfo->getFilename());

            $file = file_get_contents($fileinfo->getPathname());
            // file_put_contents($saved_dir . '/' . 'index.xml', $file);

            $xml = simplexml_load_string($file);
            foreach ($xml->company as $company) {
              $id = (string)$company->id;
              $link = $api['url'] . '?path_info=people/' . $id . '&auth_api_token=' . $api['token'];

              $page = file_get_contents($link);

              file_put_contents($saved_dir . '/' . $id . '.xml', $page);
            }
          }
        }
      }
    }
    //       if (preg_match('/\.csv$/', $fileinfo->getFilename())) {
    //         $csv_handle = @fopen($fileinfo->getPathname(), 'r');

    //         if ($csv_handle === FALSE) {
    //           self::displayMessage('Couldn\'t open CSV file for reading. ' . $fileinfo->getFilename());
    //           return MigrationBase::RESULT_FAILED;
    //         }

    //         // Build up the array of all rows in $csv_data. Skip the first line of each file.
    //         // Each file should have identical header rows. In any case, the header of the last
    //         // file read will be used as the header in the compiled file.
    //         $count = 0;
    //         while ($row = fgetcsv($csv_handle)) {
    //           if ($count == 0) {
    //             $csv_header = $row;
    //           }
    //           else {
    //             $csv_data[] = $row;
    //           }
    //           $count++;
    //         }
    //       }
    //     }

    //     // Put the header at the top.
    //     array_unshift($csv_data, $csv_header);

    //     // Write the data to the compiled folder.
    //     $output_handle = @fopen(PGH_MIGRATE_DATA_DIR . '/compiled/' . $dir . '.csv', 'w');
    //     if ($output_handle === FALSE) {
    //       self::displayMessage('Couldn\'t open CSV file for writing. ' . PGH_MIGRATE_DATA_DIR . '/compiled/' . $dir . '.csv');
    //       return MigrationBase::RESULT_FAILED;
    //     }

    //     foreach ($csv_data as $row) {
    //       fputcsv($output_handle, $row);
    //     }

    //     fclose($csv_handle);
    //     fclose($output_handle);
    //   }
    // }

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

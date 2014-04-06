<?php

/**
 * @file
 * Preprocesses CSV data so it can be imported by the Migration.
 */

class DHPreprocessMigration extends MigrationBase {
  /**
   * API settings.
   */
  public $api = array(
    // 'url' => 'https://qplot.manageprojects.com/api.php',
    // 'token' => '1-bm4xON3HasMFpm7qg9oea9sUvfy1j1WkbOHPqzmr',
    'url' => 'https://ac.designhammer.net/api.php',
    'token' => '217-qUrX6d8cJVc69tPndSrqtgcDI2meGkXW5eIZiF2S',
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
      'company',
      'user',
      'project',
      'milestone',
      'category',
      'task',
      'comment',
      'tag',
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
      // Download company list xml.
      'pre_company' => array(),
      // Read company xml and download each company xml.
      'company' => array(),
      // Read company xml and downlaod each user xml.
      'user' => array('path' => 'compiled/company'),
      // Download project category list xml.
      'pre_category' => array(),
      // Download project list xml.
      'pre_project' => array(),
      // Read project xml and download each project xml.
      'project' => array(),
      // Read project xml and download categories xml.
      'tag' => array('path' => 'data/project'),
      // Read project xml and download tasks list xml.
      'pre_task' => array('path' => 'data/project'),
      // Read task xml and download each task xml.
      'task' => array(),
      // Download milestone list xml.
      'pre_milestone' => array(),
      // Read project xml and download milestone xml.
      // 'milestone' => array('path' => 'data/project'),
      // Read task xml and download comment list xml.
      'comment' => array('path' => 'data/task'),
    );

    $project_lists = array(
      10,
    );

    foreach ($processed_dir as $dir => $source_path) {
      $i = 0;
      $parts = explode('_', $dir);
      // Preprocess.
      if ($parts[0] == 'pre') {
        $dir = $parts[1];
        $saved_dir = $data_path . '/' . $dir;
        $ops = array('', 'archive');
        switch ($dir) {
          case 'company':
            foreach ($ops as $op) {
              $filename = !empty($op) ? $op : $dir;
              $output = $saved_dir . '/' . $filename . '.xml';
              if (!file_exists($output)) {
                $this->downloadXML('people/' . $op, $output);
                $i += 1;
              }
            }
            drupal_set_message($i . ' company lists downloaded');
            break;

          case 'category':
            $output = $saved_dir . '/' . $dir . '.xml';
            if (!file_exists($output)) {
              $this->downloadXML('projects/categories', $output);
              $i += 1;
            }
            drupal_set_message($i . ' category lists downloaded');
            break;

          case 'project':
            foreach ($ops as $op) {
              $filename = !empty($op) ? $op : $dir;
              $output = $saved_dir . '/' . $filename . '.xml';
              if (!file_exists($output)) {
                $this->downloadXML('projects/' . $op, $output);
                $i += 1;
              }
            }
            drupal_set_message($i . ' project lists downloaded');
            break;

          case 'milestone':
            foreach ($project_lists as $pid) {
              foreach ($ops as $op) {
                $filename = $pid . '_' . (!empty($op) ? $op : $dir);
                $output = $saved_dir . '/' . $filename . '.xml';
                if (!file_exists($output)) {
                  $this->downloadXML('projects/' . $pid . '/milestones/' . $op, $output);
                  $i += 1;
                }
              }
            }
            drupal_set_message($i . ' milestone lists downloaded');
            break;

          case 'task':
            foreach ($project_lists as $pid) {
              foreach ($ops as $op) {
                $filename = $pid . '_' . (!empty($op) ? $op : $dir);
                $output = $saved_dir . '/' . $filename . '.xml';
                if (!file_exists($output)) {
                  $this->downloadXML('projects/' . $pid . '/tasks/' . $op, $output);
                  $i += 1;
                }
              }
            }
            drupal_set_message($i . ' tasks lists downloaded');
            break;
        }
      }
      // Process.
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

              case 'company':
                foreach ($xml->company as $company) {
                  $id = (string) $company->id;
                  $output = $saved_dir . '/' . $id . '.xml';

                  if (!file_exists($output)) {
                    $this->downloadXML('people/' . $id, $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' companies downloaded from company/' . $fileinfo->getFilename());
                }
                break;

              case 'user':
                $id = (string) $xml->id;
                foreach ($xml->users->children() as $user) {
                  $uid = (string) $user->id;
                  $output = $saved_dir . '/' . $uid . '.xml';
                  if (!file_exists($output)) {
                    $this->downloadXML('people/' . $id . '/users/' . $uid, $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' users downloaded from company/' . $fileinfo->getFilename());
                }
                break;

              case 'project':
                foreach ($xml->project as $project) {
                  $id = (string) $project->id;
                  $output = $saved_dir . '/' . $id . '.xml';

                  if (!file_exists($output)) {
                    $this->downloadXML('projects/' . $id, $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' projects downloaded from project/' . $fileinfo->getFilename());
                }
                break;

              case 'milestone':
                foreach ($xml->project as $project) {
                  $id = (string) $project->id;
                  $output = $saved_dir . '/' . $id . '.xml';

                  if (!file_exists($output)) {
                    $this->downloadXML('projects/' . $id . '/milestones', $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' milestones downloaded from project/' . $fileinfo->getFilename());
                }
                break;

              case 'tag':
                foreach ($xml->project as $project) {
                  $id = (string) $project->id;
                  $output = $saved_dir . '/' . $id . '.xml';

                  if (!file_exists($output)) {
                    $this->downloadXML('projects/' . $id . '/tasks/categories', $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' categories downloaded from project/' . $fileinfo->getFilename());
                }
                break;

              case 'task':
                foreach ($xml->task as $task) {
                  $id = (string) $task->id;
                  $task_id = (string) $task->task_id;
                  $pid = (string) $task->project_id;
                  $output = $saved_dir . '/' . $id . '.xml';

                  if (!file_exists($output)) {
                    $this->downloadXML('projects/' . $pid . '/tasks/' . $task_id, $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' tasks downloaded from task/' . $fileinfo->getFilename());
                }
                break;

              case 'comment':
                foreach ($xml->task as $task) {
                  $id = (string) $task->id;
                  $task_id = (string) $task->task_id;
                  $pid = (string) $task->project_id;
                  $output = $saved_dir . '/' . $id . '.xml';

                  if (!file_exists($output)) {
                    $this->downloadXML('projects/' . $pid . '/tasks/' . $task_id . '/comments', $output);
                    $i += 1;
                  }
                }
                if ($i) {
                  drupal_set_message($i . ' comments downloaded from task/' . $fileinfo->getFilename());
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
    $link = $this->api['url'] . '?path_info=' . $command .
      '&auth_api_token=' . $this->api['token'];

    // Save directly to disk.
    // $page = file_get_contents($link);
    // file_put_contents($saved_dir . '/' . $id . '.xml', $page);

    // Use phantomjs to help us get around the https issue.
    $exec = 'sudo -u fjin /usr/local/bin/phantomjs ' . $this->phantomjs . ' ' .
      escapeshellarg($link) . ' ' . escapeshellarg($output);
    exec($exec);
  }

}

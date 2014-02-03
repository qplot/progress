<?php
/**
 * @file
 * qplot_progress_rules.rules_defaults.inc
 */

/**
 * Implements hook_default_rules_configuration().
 */
function qplot_progress_rules_default_rules_configuration() {
  $items = array();
  $items['rules_update_phase_progress'] = entity_import('rules_config', '{ "rules_update_phase_progress" : {
      "LABEL" : "Update phase progress",
      "PLUGIN" : "reaction rule",
      "OWNER" : "rules",
      "REQUIRES" : [ "php", "rules" ],
      "ON" : {
        "node_insert--task" : { "bundle" : "task" },
        "node_update--task" : { "bundle" : "task" },
        "node_delete--task" : { "bundle" : "task" }
      },
      "DO" : [
        { "php_eval" : { "code" : "qplot_progress_update_phase_progress($node);" } }
      ]
    }
  }');
  return $items;
}

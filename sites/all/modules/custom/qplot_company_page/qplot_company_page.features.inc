<?php
/**
 * @file
 * qplot_company_page.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function qplot_company_page_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "page_manager" && $api == "pages_default") {
    return array("version" => "1");
  }
}

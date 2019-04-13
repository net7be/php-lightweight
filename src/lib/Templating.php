<?php

/**
 * This class groups a few static methods together to handle templates
 * using simple PHP logic (no template engine is required)
 */
class Templating {

  /**
   * Very basic way to pass variables to template files.
   * Variables passed as $vars will be directly accessible using their keys as their variable
   * names in the imported template PHP file.
   * @param string $filename Filename to include with no paths, slashes, etc. Just the filename
   * @param Array $vars The variables to send to the template, variable names as keys and values as variable values
   */
  public static function includeTemplate($filename, $vars = array()) {
    if (isset($vars)) extract($vars);
    include(dirname(__DIR__) . '/views/templates/' . $filename);
  }

  /**
   * Decodes the Webpack manifest JSON file into an array.
   * @return Object object with assets names (defined in Webpack entry config.) as keys 
   * - Careful, this is NOT an assoc
   */
  public static function getAssets() {
    $res = Array();
    if (($assetsRaw = file_get_contents(
      dirname(__DIR__) . '/../' . PUBLIC_DIR . '/' . MANIFEST)) !== FALSE
      ) {
        $decoded = json_decode($assetsRaw);
        // Add the assets path to ready everything for import in templates:
        foreach ($decoded as &$path) {
          $path = ASSETS_DIR . '/' . $path;
        }
        return $decoded;
    }
    return $res;
  }

}


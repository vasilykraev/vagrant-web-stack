<?php

/**
 * @file
 * Drupal debug utilites.
 * 
 */

/**
 * Drupal debugging class.
 */
class d {
  
  public static $output = 'message';
  public static $type = 'status';
  public static $repeat = TRUE;

  public static function __callStatic($method, $arguments) {

    // Initialize default arguments.
    $arguments += array(NULL, NULL, NULL);

    ob_start();

    if( $method == 'print_r' || $method == 'var_dump') {
      echo self::wrap('begin');
      call_user_func($method, $arguments[0], $arguments[1]);
      echo self::wrap('end');
    }
    else {
      require_once 'kint/Kint.class.php';
      if (method_exists ('Kint', $method)) {
        call_user_func(array('Kint', $method), $arguments[0]);
      }
      else {
        throw new Exception("Method '$method' doesn't exist!");
      }
    }

    $output = ob_get_contents();
    ob_end_clean();

    switch(self::$output) {

      case 'message':
        if (function_exists('drupal_set_message')) {
          drupal_set_message($output, self::$type, self::$repeat);
        }
        else {
          echo $output;
        }
        break;

      case 'echo':
        echo $output;
        break;

      case 'return':
        return $output;
        break;

    }
  }

  /**
   * Wrapper
   */
  private static function wrap($phase) {
    if($phase == 'begin') {
      return '<pre style="overflow:auto;text-align:left;background:#EEE;padding:5px;margin 5px; border: solid 1px #777">';
    }
    else if($phase == 'begin') {
      return '</pre>';
    }
  }

  /**
   * Prints a SQL string from a DBTNG SelectQuery object.
   */
  static function query($query) {
    $query->preExecute();
    $sql = (string) $query;
    $quoted = array();
    $connection = Database::getConnection();
    foreach ((array)$query->arguments() as $key => $val) {
      $quoted[$key] = $connection->quote($val);
    }
    $sql = strtr($sql, $quoted);
    require_once 'highlightSQL.inc';
    self::dsm(highlight_SQL($sql), 'none');
  }
  
  /**
   * Wrapper function for drupal_set_message().
   */
  static function dsm($message = NULL, $type = NULL, $repeat = NULL) {
    drupal_set_message(
      $message,
      isset($type) ? $type : self::$type,
      isset($repeat) ? $repeat : self::$repeat
    );
  }

}

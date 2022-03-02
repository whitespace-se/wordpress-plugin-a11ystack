<?php
/**
 * Plugin Name: Whitespace a11ystack integration
 * Plugin URI: -
 * Description: Adds a11ystack-specific enhancements and features to Wordpress
 * Version: 1.0.0
 * Author: Whitespace
 * Author URI: https://www.whitespace.se/
 * Text Domain: whitespace-a11ystack
 */

define("WHITESPACE_A11YSTACK_PLUGIN_FILE", __FILE__);
define("WHITESPACE_A11YSTACK_PATH", dirname(__FILE__));
define(
  "WHITESPACE_A11YSTACK_AUTOLOAD_PATH",
  WHITESPACE_A11YSTACK_PATH . "/autoload",
);

add_action("init", function () {
  $path = plugin_basename(dirname(__FILE__)) . "/languages";
  load_plugin_textdomain("whitespace-a11ystack", false, $path);
  load_muplugin_textdomain("whitespace-a11ystack", $path);
});

array_map(static function () {
  include_once func_get_args()[0];
}, glob(WHITESPACE_A11YSTACK_AUTOLOAD_PATH . "/*.php"));

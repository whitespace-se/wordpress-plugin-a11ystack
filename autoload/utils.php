<?php

function disable_taxonomy($taxonomy) {
  add_action("init", function () use ($taxonomy) {
    register_taxonomy($taxonomy, []);
  });
  add_filter("disabled_taxonomies", function ($disabled_taxonomies) use (
    $taxonomy
  ) {
    $disabled_taxonomies[] = $taxonomy;
    return $disabled_taxonomies;
  });
}

function get_disabled_taxonomies() {
  return apply_filters("disabled_taxonomies", []);
}

function taxonomy_disabled($taxonomy) {
  return in_array($taxonomy, get_disabled_taxonomies());
}

add_action(
  "init",
  function () {
    if (!function_exists("acf_get_local_store")) {
      return;
    }
    /**
     * @var $store ACF_Data
     */
    $store = acf_get_local_store("groups");
    $data = $store->get_data();
    foreach ($data as $key => $group) {
      $group = apply_filters("acf/load_group", $group, $key);
      $group = apply_filters("acf/load_group/key=$key", $group, $key);
      $store->set($key, $group);
    }
  },
  20, // Run after Municipio theme bootstrap
);

function whitespace_a11ystack_color_field($extra = [], $options = []) {
  $options = whitespace_a11ystack_get_color_choices($options);
  $field_theme_color_options = [
    "key" => "field_a11ystack_color",
    "label" => __("Color", "whitespace-a11ystack"),
    "name" => "color",
    "type" => count($options) > 7 ? "select" : "radio",
    // "parent" => "", // Intentionally left out
    "instructions" => "",
    "show_in_graphql" => true,
    "graphql_field_name" => "color",
    "choices" => $options,
    "default_value" => "auto",
    "allow_null" => false,
    "other_choice" => false,
    "save_other_choice" => false,
    "layout" => "horizontal",
    "return_format" => "value",
  ];
  return array_merge($field_theme_color_options, $extra);
}

function whitespace_a11ystack_get_color_choices($merge = []) {
  $options = [
    "auto" => __("Auto", "whitespace-a11ystack"),
    "transparent" => __("Transparent", "whitespace-a11ystack"),
  ];
  $options = apply_filters("whitespace-a11ystack/color_choices", $options);
  $options = array_merge($options, $merge);
  $options = array_filter($options);
  return $options;
}

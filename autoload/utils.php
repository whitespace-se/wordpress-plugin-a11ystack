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

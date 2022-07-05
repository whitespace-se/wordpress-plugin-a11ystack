<?php

/**
 * Hide all taxonomy metaboxes
 */
add_action(
  "init",
  function () {
    global $wp_taxonomies;
    foreach ($wp_taxonomies as &$taxonomy) {
      $taxonomy->meta_box_cb = false;
    }
  },
  20, // Run after registration of new taxonomies
);

/**
 * Replaces WP standard metaboxes for all taxonomies with ACF field group.
 * Runs on wp_loaded because languages aren't loaded yet on acf/init.
 */
add_action(
  "wp_loaded",
  function () {
    if (!function_exists("acf_add_local_field")) {
      return;
    }
    global $wp_taxonomies;
    global $wp_post_types;
    foreach ($wp_post_types as $post_type_name => $post_type) {
      $fields = [];
      foreach ($wp_taxonomies as $taxonomy_name => $taxonomy) {
        if (!$taxonomy->show_ui) {
          continue;
        }
        if (!in_array($post_type_name, (array) $taxonomy->object_type)) {
          continue;
        }
        $labels = get_taxonomy_labels($taxonomy);
        $field = [
          "key" =>
            "field_a11ystack_" .
            $post_type_name .
            "_taxonomy_" .
            $taxonomy_name,
          "label" => $labels->name,
          "name" => $taxonomy_name,
          "type" => "taxonomy",
          "required" => 0,
          "show_in_graphql" => 0,
          "taxonomy" => $taxonomy_name,
          "field_type" => "multi_select",
          "allow_null" => 0,
          "add_term" => 0,
          "save_terms" => 1,
          "load_terms" => 1,
          "return_format" => "id",
          "multiple" => 1,
        ];
        $field = apply_filters(
          "whitespace_a11ystack_term_field",
          $field,
          $taxonomy,
        );
        if ($field) {
          $fields[] = $field;
        }
      }
      if (empty($fields)) {
        continue;
      }
      acf_add_local_field_group([
        "key" => "group_mu_" . $post_type_name . "_taxonomy",
        "title" => __("Taxonomy", "whitespace-a11ystack"),
        "fields" => $fields,
        "location" => [
          [
            [
              "param" => "post_type",
              "operator" => "==",
              "value" => $post_type_name,
            ],
          ],
        ],
        "menu_order" => -5,
        "position" => "side",
        "style" => "default",
        "label_placement" => "top",
        "instruction_placement" => "label",
        "hide_on_screen" => "",
        "active" => true,
        "description" => "",
        "show_in_graphql" => 0,
        "map_graphql_types_from_location_rules" => 0,
        "graphql_types" => "",
      ]);
    }
  },
  9,
);

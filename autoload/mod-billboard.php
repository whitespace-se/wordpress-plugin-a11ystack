<?php

add_filter("Modularity/Modules", function ($modules) {
  $modules[WHITESPACE_A11YSTACK_PATH . "/src/Modularity"] = "ModBillboard";
  return $modules;
});

add_filter("Modularity/gatsby_supported_modules", function ($modules) {
  $modules[] = "mod-billboard";
  return $modules;
});

/**
 * Adds ACF fields to the billboard module.
 */
add_action("acf/init", function () {
  $formats = [
    "feature" => __("Featured story", "whitespace-a11ystack"),
    "hero" => __("Hero", "whitespace-a11ystack"),
  ];
  $formats = apply_filters("whitespace_a11ystack_billboard_formats", $formats);
  $fields = [
    [
      "key" => "field_mod_billboard_format",
      "label" => __("Format", "whitespace-a11ystack"),
      "name" => "format",
      "type" => "radio",
      "required" => 1,
      "choices" => $formats,
      "layout" => "horizontal",
      // Hide the field if there is only one choice
      "wrapper" => count($formats) > 1 ? [] : ["style" => "display:none;"],
      "default_value" => count($formats) > 1 ? null : array_keys($formats)[0],
    ],
    [
      "key" => "field_mod_billboard_image",
      "label" => __("Image", "whitespace-a11ystack"),
      "name" => "image",
      "type" => "image",
      "required" => 0,
      "return_format" => "array",
      "preview_size" => "medium",
      "library" => "all",
    ],
    [
      "key" => "field_mod_billboard_links",
      "label" => __("Buttons", "whitespace-a11ystack"),
      "name" => "links",
      "type" => "repeater",
      "required" => 0,
      "layout" => "table",
      "button_label" => __("Add link", "whitespace-a11ystack"),
      "sub_fields" => [
        [
          "key" => "field_mod_billboard_links_link",
          "label" => __("Link", "whitespace-a11ystack"),
          "name" => "link",
          "type" => "link",
          "required" => 1,
        ],
      ],
    ],
  ];
  $fields = apply_filters(
    "whitespace_a11ystack_billboard_fields",
    $fields,
    $formats,
  );
  acf_add_local_field_group([
    "key" => "group_mod_billboard",
    "title" => __("Billboard", "whitespace-a11ystack"),
    "fields" => $fields,
    "location" => [
      [
        [
          "param" => "post_type",
          "operator" => "==",
          "value" => "mod-billboard",
        ],
      ],
    ],
    "show_in_graphql" => 1,
    "graphql_field_name" => "modBillboard",
  ]);
});

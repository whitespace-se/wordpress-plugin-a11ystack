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
    "card" => __("Card", "whitespace-a11ystack"),
  ];
  $formats = apply_filters("whitespace_a11ystack_billboard_formats", $formats);

  $colors = whitespace_a11ystack_get_color_choices([]);
  $colors = apply_filters("whitespace_a11ystack_billboard_colors", $colors);

  $image_aspect_ratios = [
    "16/9" => __("Landscape 16:9", "whitespace-a11ystack"),
    "4/3" => __("Landscape 4:3", "whitespace-a11ystack"),
    "1/1" => __("Square", "whitespace-a11ystack"),
  ];
  $image_aspect_ratios = apply_filters(
    "whitespace_a11ystack_billboard_image_aspect_ratios",
    $image_aspect_ratios,
  );

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
      "wrapper" => [
        // Hide the field if there is only one choice
        "style" => count($formats) > 1 ? null : "display:none;",
      ],
      "default_value" => count($formats) > 1 ? null : array_keys($formats)[0],
    ],
    [
      "key" => "field_mod_billboard_color",
      "label" => __("Color", "whitespace-a11ystack"),
      "name" => "color",
      "type" => count($colors) > 5 ? "select" : "radio",
      "required" => 1,
      "choices" => $colors,
      "layout" => "horizontal",
      // Hide the field if there is only one choice
      "wrapper" => [
        // Hide the field if there is only one choice
        "style" => count($colors) > 1 ? null : "display:none;",
      ],
      "default_value" => count($colors) > 1 ? null : array_keys($colors)[0],
      // Show only for "card" format
      "conditional_logic" => [
        [
          [
            "field" => "field_mod_billboard_format",
            "operator" => "==",
            "value" => "card",
          ],
        ],
      ],
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
      "wrapper" => [
        "width" => "33",
        "class" => "",
        "id" => "",
      ],
    ],
    [
      "key" => "field_mod_billboard_image_aspect_ratio",
      "label" => __("Image aspect ratio", "whitespace-a11ystack"),
      "name" => "image_aspect_ratio",
      "type" => "select",
      "required" => 1,
      "choices" => $image_aspect_ratios,
      "wrapper" => [
        "width" => "33",
        // Hide the field if there is only one choice
        "style" => count($image_aspect_ratios) > 1 ? null : "display:none;",
      ],
      "default_value" =>
        count($image_aspect_ratios) > 1
          ? null
          : array_keys($image_aspect_ratios)[0],
      // Show only for "feature" format
      "conditional_logic" => [
        [
          [
            "field" => "field_mod_billboard_format",
            "operator" => "==",
            "value" => "feature",
          ],
        ],
      ],
    ],
    [
      "key" => "field_mod_billboard_image_placement",
      "label" => __("Image placement", "whitespace-a11ystack"),
      "name" => "image_placement",
      "type" => "select",
      "required" => 1,
      "choices" => [
        "left" => __("Left", "whitespace-a11ystack"),
        "right" => __("Right", "whitespace-a11ystack"),
      ],
      "wrapper" => [
        "width" => "33",
      ],
      "default_value" => "left",
    ],
    whitespace_a11ystack_acf_links_field(),
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

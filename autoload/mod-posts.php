<?php

add_action(
  "acf/init",
  function () {
    // Manual input > Link
    acf_add_local_field([
      "key" => "field_mod_posts_manual_input_link",
      "label" => __("Link", "municipio-gatsby"),
      "name" => "link",
      "parent" => "field_576258d3110b0",
      "type" => "link",
    ]);

    // Manual input > Icon
    $icons = whitespace_a11ystack_get_icons();
    $icons = array_combine($icons, $icons);
    acf_add_local_field([
      "parent" => "field_576258d3110b0",
      "key" => "field_mod_posts_manual_input_icon",
      "label" => __("Icon", "whitespace-a11ystack"),
      "name" => "icon",
      "type" => "select",
      "required" => 0,
      "choices" => $icons,
      "allow_null" => 1,
      "wrapper" => [
        // Hide the field if there is only one choice
        "style" => !empty($icons) ? null : "display:none;",
      ],
      "instructions" => "Only for <em>inline list</em> display mode.",
    ]);

    // Manual input > Image
    acf_add_local_field([
      "key" => "field_mod_posts_manual_input_image",
      "label" => __("Image", "municipio-gatsby"),
      "name" => "image",
      "parent" => "field_576258d3110b0",
      "type" => "image",
    ]);

    // Data Display > Heading position
    acf_add_local_field([
      "key" => "field_mod_posts_heading_position",
      "label" => __("Heading position", "municipio-gatsby"),
      "name" => "heading_position",
      "parent" => "group_571dfd3c07a77", // Data display
      "type" => "radio",
      "default_value" => "above",
      "layout" => "horizontal",
      "choices" => [
        "above" => "Above",
        "left" => "Left",
      ],
      "conditional_logic" => [
        [
          [
            "field" => "field_571dfd4c0d9d9",
            "operator" => "==",
            "value" => "inline-list",
          ],
        ],
      ],
    ]);
  },
  20,
);

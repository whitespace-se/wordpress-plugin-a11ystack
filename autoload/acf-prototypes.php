<?php

function whitespace_a11ystack_acf_links_field($extra = [], $options = []) {
  $variants = apply_filters("whitespace_a11ystack_acf_links_field_variants", [
    "auto" => __("Auto", "whitespace-a11ystack"),
  ]);
  $field = [
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
      [
        "key" => "field_mod_billboard_links_variant",
        "label" => __("Style", "whitespace-a11ystack"),
        "name" => "variant",
        "type" => "select",
        "choices" => $variants,
        "default_value" => array_keys($variants)[0],
        "wrapper" => [
          "width" => "20",
        ],
      ],
    ],
  ];
  $field = array_merge($field, $extra);
  $field = apply_filters(
    "whitespace_a11ystack_acf_links_field",
    $field,
    $options,
  );
  return $field;
}

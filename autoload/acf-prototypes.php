<?php

function whitespace_a11ystack_acf_links_field($extra = [], $options = []) {
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

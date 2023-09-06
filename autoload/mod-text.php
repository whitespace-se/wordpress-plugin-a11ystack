<?php

add_action(
  "admin_init",
  function () {
    if (function_exists("acf_remove_local_field")) {
      // Font size
      acf_remove_local_field("field_5891b4982999e");
      // Hide box frame
      acf_remove_local_field("field_5891b6038c120");
    }
  },
  20,
);

add_action("acf/init", function () {
  acf_add_local_field([
    "parent" => "group_5891b49127038",
    "key" => "field_mod_text_expandable",
    "name" => "expandable",
    "label" => __("Expandable", "whitespace-a11ystack"),
    "type" => "true_false",
    "wrapper" => [
      "width" => "50",
    ],
    "default_value" => 0,
  ]);
  acf_add_local_field(
    whitespace_a11ystack_color_field([
      "parent" => "group_5891b49127038",
      "default_value" => "transparent",
      "name" => "theme",
    ]),
  );
  acf_add_local_field(
    whitespace_a11ystack_acf_links_field([
      "parent" => "group_5891b49127038",
    ]),
  );
});

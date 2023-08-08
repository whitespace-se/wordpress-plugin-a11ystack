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
  acf_add_local_field(
    whitespace_a11ystack_color_field([
      "parent" => "group_5891b49127038",
      "default_value" => "transparent",
      "name" => "theme",
    ]),
  );
});

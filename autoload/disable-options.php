<?php

add_action(
  "init",
  function () {
    if (!function_exists("acf_remove_local_field")) {
      return;
    }
    // Custom color scheme
    acf_remove_local_field("field_5a9945a41d637");
    // Color scheme
    acf_remove_local_field("field_56a0a7e36365b");
    // Color scheme
    acf_remove_local_field("field_5a9946401d638");
  },
  20,
);

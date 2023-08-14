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
    // Logotype
    acf_remove_local_field_group("group_56a0f1f7826dd");
    // Cookie consent
    acf_remove_local_field_group("group_56bc6b6466df1");
    // Favicon
    acf_remove_local_field_group("group_56cc39aba8782");
    // GDPR
    acf_remove_local_field_group("group_5ac334058cc33");
    // 2.0 Enabler
    acf_remove_local_field_group("group_5aa14b41551ae");
  },
  20,
);

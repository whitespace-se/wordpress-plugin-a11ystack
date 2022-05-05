<?php

add_filter("Modularity/Modules", function ($modules) {
  if (whitespace_a11ystack_feature_enabled("feedback_module")) {
    $modules[WHITESPACE_A11YSTACK_PATH . "/src/Modularity"] = "ModFeedback";
  }
  return $modules;
});

<?php

add_filter("Modularity/Modules", function ($modules) {
  $modules[WHITESPACE_A11YSTACK_PATH . "/src/Modularity"] = "ModFeedback";
  return $modules;
});

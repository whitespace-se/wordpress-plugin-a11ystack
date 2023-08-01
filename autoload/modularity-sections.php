<?php

add_action("admin_enqueue_scripts", function () {
  $handle = "modularity-sections";
  $url = WHITESPACE_A11YSTACK_DIR_URL . "/assets/modularity-sections.js";
  wp_register_script(
    $handle,
    $url,
    ["modularity"],
    hash_file(
      "md5",
      WHITESPACE_A11YSTACK_PATH . "/assets/modularity-sections.js",
    ),
  );
  wp_enqueue_script($handle);

  $background_options = [];
  $background_options = apply_filters(
    "Modularity/backgroundOptions",
    $background_options,
  );
  $align_options = [
    "left" => __("Left"),
    "center" => __("Center"),
  ];
  $align_options = apply_filters("Modularity/alignOptions", $align_options);
  $modularity_sections_config = [
    "enableBackground" => !empty($background_options),
    "backgroundOptions" => $background_options,
    "enableAlign" => !empty($align_options),
    "alignOptions" => $align_options,
  ];
  wp_localize_script(
    $handle,
    "MODULARITY_SECTIONS_CONFIG",
    $modularity_sections_config,
  );

  $url = WHITESPACE_A11YSTACK_DIR_URL . "/assets/modularity-sections.css";
  wp_register_style($handle, $url, ["modularity"], "1.0");
  wp_enqueue_style($handle);
});

add_filter(
  "Modularity/Options/Editor/getModule",
  function ($module, $module_args) {
    if (!empty($module_args["background"])) {
      $module->background = $module_args["background"];
    }
    if (!empty($module_args["align"])) {
      $module->align = $module_args["align"];
    }
    return $module;
  },
  10,
  2,
);

add_action("graphql_register_types", function ($type_registry) {
  $type_registry->register_field("ModularityModuleInstance", "background", [
    "type" => "String",
    "resolve" => function ($module) {
      if (!empty($module["background"])) {
        return $module["background"];
      }
      return null;
    },
  ]);
  $type_registry->register_field("ModularityModuleInstance", "align", [
    "type" => "String",
    "resolve" => function ($module) {
      if (!empty($module["align"])) {
        return $module["align"];
      }
      return null;
    },
  ]);
});

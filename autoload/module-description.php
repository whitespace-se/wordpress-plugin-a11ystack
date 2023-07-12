<?php

function get_module_types_without_editor() {
  $mod_post_types = ["mod-text", "mod-image", "mod-notice"];

  $mod_post_types = apply_filters(
    "Modularity/module_types_without_editor",
    $mod_post_types,
  );

  return $mod_post_types;
}

add_filter(
  "register_post_type_args",
  function ($args, $post_type_name) {
    $mod_post_types = get_module_types_without_editor();

    if (
      strpos($post_type_name, "mod-") === 0 &&
      !in_array($post_type_name, $mod_post_types)
    ) {
      $args["supports"][] = "editor";
    }

    return $args;
  },
  10,
  2,
);

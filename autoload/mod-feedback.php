<?php

function register_feeback_panel($slug, $panel) {
  add_filter("feedback_panels", function ($panels) use ($slug, $panel) {
    $panels[$slug] = $panel;
    return $panels;
  });
}

function get_feedback_panels() {
  $panels = [];
  $panels = apply_filters("feedback_panels", $panels);
  return $panels;
}

add_filter("Modularity/Modules", function ($modules) {
  $modules[FEEDBACK_PATH . "/src/Modules/ModFeedback"] = "ModFeedback";
  return $modules;
});

add_action("acf/init", function () {
  if (function_exists("acf_add_local_field_group")) {
    $panels = get_feedback_panels();
    $choices = [];
    foreach ($panels as $slug => $panel) {
      $choices[$slug] = $panel["name"];
    }
    acf_add_local_field_group([
      "key" => "group_mod_feedback",
      "title" => __("Panel properties", "feedback"),
      "fields" => [
        [
          "key" => "field_mod_feedback_panel",
          "label" => __("Panel", "feedback"),
          "name" => "mod_feedback_panel",
          "type" => "select",
          "instructions" => "",
          // "required" => 0,
          "choices" => $choices,
          "graphql_field_name" => "panel",
        ],
      ],
      "location" => [
        [
          [
            "param" => "post_type",
            "operator" => "==",
            "value" => "mod-feedback",
          ],
        ],
      ],
      "show_in_graphql" => true,
      "graphql_field_name" => "modFeedbackOptions",
    ]);
  }
});

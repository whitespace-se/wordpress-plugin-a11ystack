<?php

/**
 * Adds POST /wp-json/whitespace-a11ystack/v1/feedback REST route
 */
add_action("rest_api_init", function () {
  if (whitespace_a11ystack_feature_enabled("feedback_module")) {
    register_rest_route("whitespace-a11ystack/v1", "/feedback", [
      "methods" => "POST",
      "callback" => "whitespace_a11ystack_feedback_post_callback",
    ]);
  }
});

/**
 * Enables comments so that feedback is visible in admin
 */
add_filter(
  "whitespace-headless-cms/disable_comments",
  function ($disable_comments) {
    if (whitespace_a11ystack_feature_enabled("feedback_module")) {
      $disable_comments = false;
    }
    return $disable_comments;
  },
  90,
);

/**
 * Adds feedback comment type to the admin dropdown
 */
add_filter("admin_comment_types_dropdown", function ($comment_types) {
  if (whitespace_a11ystack_feature_enabled("feedback_module")) {
    $comment_types["feedback"] = __("Content reaction", "whitespace-a11ystack");
  }
  return $comment_types;
});

// add_filter("manage_edit-comments_columns", function ($columns) {
//   $keys = array_keys($columns);
//   $index = array_search("comment", $keys);
//   $keys_before = array_slice($keys, 0, $index);
//   $keys_after = array_slice($keys, $index);
//   $columns["reaction"] = __("Reaction", "whitespace-a11ystack");
//   $keys = array_merge($keys_before, ["reaction"], $keys_after);
//   $new_columns = [];
//   foreach ($keys as $key) {
//     $new_columns[$key] = $columns[$key];
//   }
//   $columns = $new_columns;
//   return $columns;
// });

// add_action(
//   "manage_comments_custom_column",
//   function ($column, $comment_id) {
//     switch ($column) {
//       case "reaction":
//         echo esc_html(get_comment_meta($comment_id, "feedback_reaction", true));
//         break;
//     }
//   },
//   10,
//   2
// );

// add_action("current_screen", function () {
//   global $current_screen;
//   error_log(var_export($current_screen, true));
// });

function whitespace_a11ystack_feedback_post_callback(WP_REST_Request $request) {
  $comment_post_ID = $request["post_id"];
  $module_id = $request["module_id"];
  $reaction = $request["reaction"];
  $explanation = $request["explanation"];

  $module = get_post($module_id);

  $question = $module->post_title;

  $comment = [
    "comment_type" => "feedback",
    "comment_meta" => [
      "feedback_module_id" => $module_id,
      "feedback_reaction" => $reaction,
      "feedback_explanation" => $explanation,
    ],
    "comment_content" => "$question &mdash; $reaction $explanation",
    "comment_post_ID" => $comment_post_ID,
  ];

  wp_insert_comment($comment);
}

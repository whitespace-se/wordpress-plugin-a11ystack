<?php

add_action("init", function () {
  $labels = [
    "name" => _x("Alerts", "Post Type General Name", "whitespace-a11ystack"),
    "singular_name" => _x(
      "Alert",
      "Post Type Singular Name",
      "whitespace-a11ystack",
    ),
    "menu_name" => __("Alerts", "whitespace-a11ystack"),
    "name_admin_bar" => __("Alerts", "whitespace-a11ystack"),
    "archives" => _x("Alerts", "post type archive", "whitespace-a11ystack"),
    "all_items" => __("All alerts", "whitespace-a11ystack"),
    "add_new_item" => __("Add new alert", "whitespace-a11ystack"),
    "add_new" => __("Add new", "whitespace-a11ystack"),
    "new_item" => __("New alert", "whitespace-a11ystack"),
    "edit_item" => __("Edit alert", "whitespace-a11ystack"),
    "update_item" => __("Update alert", "whitespace-a11ystack"),
    "view_item" => __("View alert", "whitespace-a11ystack"),
    "view_items" => __("View alerts", "whitespace-a11ystack"),
  ];
  $args = [
    "label" => __("Alerts", "whitespace-a11ystack"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_rest" => true,
    "menu_icon" => "dashicons-megaphone",
    "query_var" => true,
    "rewrite" => [
      "slug" => _x("alerts", "Post Type Slug", "whitespace-a11ystack"),
      "with_front" => false,
    ],
    "capability_type" => "post",
    "has_archive" => false,
    "show_in_graphql" => true,
    "hierarchical" => false,
    "graphql_single_name" => "alert",
    "graphql_plural_name" => "alerts",
    "menu_position" => null,
    "supports" => ["title", "editor", "author", "revisions", "excerpt"],
    "optional_ui" => true,
  ];

  register_post_type("alert", $args);
});

add_action("acf/init", function () {
  acf_add_local_field_group([
    "key" => "group_alert_settings",
    "title" => __("Alert settings", "whitespace-a11ystack"),
    "fields" => [
      [
        "key" => "field_alert_settings_read_more_page",
        "label" => __("Read-more page", "whitespace-a11ystack"),
        "name" => "read-more-page",
        "type" => "link",
        "instructions" => __(
          "Use this setting to make a custom read-more button.",
          "whitespace-a11ystack",
        ),
        "show_in_graphql" => 1,
      ],
    ],
    "location" => [
      [
        [
          "param" => "post_type",
          "operator" => "==",
          "value" => "alert",
        ],
      ],
    ],
    "show_in_graphql" => 1,
    "graphql_field_name" => "alertSettings",
  ]);
});

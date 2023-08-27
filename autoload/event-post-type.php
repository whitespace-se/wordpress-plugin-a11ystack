<?php

add_action("init", function () {
  $labels = [
    "name" => _x("Events", "Post Type General Name", "whitespace-a11ystack"),
    "singular_name" => _x(
      "Event",
      "Post Type Singular Name",
      "whitespace-a11ystack",
    ),
    "menu_name" => __("Events", "whitespace-a11ystack"),
    "name_admin_bar" => __("Events", "whitespace-a11ystack"),
    "archives" => _x("Events", "post type archive", "whitespace-a11ystack"),
    "all_items" => __("All events", "whitespace-a11ystack"),
    "add_new_item" => __("Add new event", "whitespace-a11ystack"),
    "add_new" => __("Add new", "whitespace-a11ystack"),
    "new_item" => __("New event", "whitespace-a11ystack"),
    "edit_item" => __("Edit event", "whitespace-a11ystack"),
    "update_item" => __("Update event", "whitespace-a11ystack"),
    "view_item" => __("View event", "whitespace-a11ystack"),
    "view_items" => __("View events", "whitespace-a11ystack"),
  ];
  $args = [
    "label" => __("Events", "whitespace-a11ystack"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_rest" => true,
    "menu_icon" => "dashicons-calendar-alt",
    "query_var" => true,
    "rewrite" => [
      "slug" => _x("events", "Post Type Slug", "whitespace-a11ystack"),
      "with_front" => false,
    ],
    "capability_type" => "post",
    "has_archive" => false,
    "show_in_graphql" => true,
    "hierarchical" => false,
    "graphql_single_name" => "event",
    "graphql_plural_name" => "events",
    "menu_position" => null,
    "supports" => ["title", "editor", "author", "revisions", "thumbnail"],
    "optional_ui" => true,
  ];

  register_post_type("event", $args);
});

add_action("acf/init", function () {
  acf_add_local_field_group([
    "key" => "group_event",
    "title" => __("Event properties", "whitespace-a11ystack"),
    "fields" => [
      [
        "key" => "field_event_occasions",
        "label" => __("Occasions", "whitespace-a11ystack"),
        "name" => "event_occasions",
        "type" => "flexible_content",
        "layouts" => [
          "layout_event_occasion_single" => [
            "key" => "layout_event_occasion_single",
            "name" => "event_occasion_single",
            "label" => __("Single occasion", "whitespace-a11ystack"),
            "display" => "block",
            "button_label" => __("Add occasion", "whitespace-a11ystack"),
            "sub_fields" => [
              [
                "key" => "field_event_occasion_single_start_date",
                "label" => __("Start date", "whitespace-a11ystack"),
                "name" => "start_date",
                "type" => "date_time_picker",
                "required" => 1,
                "display_format" => "Y-m-d H:i",
                "return_format" => "Y-m-d H:i",
                "first_day" => 1,
                "wrapper" => [
                  "width" => "50%",
                ],
              ],
              [
                "key" => "field_event_occasion_single_end_date",
                "label" => __("End date", "whitespace-a11ystack"),
                "name" => "end_date",
                "type" => "date_time_picker",
                "required" => 1,
                "display_format" => "Y-m-d H:i",
                "return_format" => "Y-m-d H:i",
                "first_day" => 1,
                "wrapper" => [
                  "width" => "50%",
                ],
              ],
            ],
          ],
        ],
      ],
      [
        "key" => "field_event_location",
        "label" => __("Location", "whitespace-a11ystack"),
        "name" => "location",
        "type" => "google_map",
      ],
    ],
    "location" => [
      [
        [
          "param" => "post_type",
          "operator" => "==",
          "value" => "event",
        ],
      ],
    ],
    "show_in_graphql" => true,
    "graphql_field_name" => "eventProperties",
  ]);
});

function whitespace_a11ystack_get_event_dates($post_id) {
  $occasions = get_field("event_occasions", $post_id);
  $dates = [];
  foreach ($occasions as $occasion) {
    switch ($occasion["acf_fc_layout"]) {
      case "event_occasion_single":
        $start_date = strtotime($occasion["start_date"]);
        $end_date = strtotime($occasion["end_date"]);
        $date = $start_date;
        while ($date < $end_date) {
          $dates[] = $date;
          $date = strtotime("+1 day", $date);
        }
        break;
    }
  }
  return $dates;
}

/**
 * Adds `eventDates` field to Event GraphQL type.
 */
add_action("graphql_register_types", function ($type_registry) {
  $type_registry->register_field("Event", "eventDates", [
    "type" => ["list_of" => "String"],
    "description" => __("Dates for the event.", "whitespace-a11ystack"),
    "resolve" => function ($source) {
      $dates = whitespace_a11ystack_get_event_dates($source->ID);
      $dates = array_map(function ($date) {
        return date("Y-m-d", $date);
      }, $dates);
      $dates = array_unique($dates);
      sort($dates);
      return $dates;
    },
  ]);
});

<?php

use WPGraphQL\Model\Post;
use WPGraphQL\Data\Connection\PostObjectConnectionResolver;

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
    "has_archive" => true,
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
  $fields = [
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
              "required" => 0,
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
      "name" => "event_location",
      "type" => "textarea",
      "rows" => 3,
      "new_lines" => "br",
      "graphql_field_name" => "location",
    ],
  ];
  $fields = apply_filters("whitespace_a11ystack_event_fields", $fields);
  acf_add_local_field_group([
    "key" => "group_event",
    "title" => __("Event properties", "whitespace-a11ystack"),
    "fields" => $fields,
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
  if (empty($occasions)) {
    return [];
  }
  $dates = [];
  foreach ($occasions as $occasion) {
    switch ($occasion["acf_fc_layout"]) {
      case "event_occasion_single":
        $start_date = strtotime($occasion["start_date"]);
        $end_date = strtotime($occasion["end_date"] ?: $occasion["start_date"]);
        $date = $start_date;
        do {
          $dates[] = $date;
          $date = strtotime("+1 day", $date);
        } while ($date < $end_date);
        break;
    }
  }
  return $dates;
}

function whitespace_a11ystack_update_event_post_meta($post_id) {
  $dates = whitespace_a11ystack_get_event_dates($post_id);
  if (empty($dates)) {
    delete_post_meta($post_id, "event_dates");
    delete_post_meta($post_id, "next_event_date");
  } else {
    update_post_meta($post_id, "event_dates", $dates);
    $upcoming_dates = array_filter($dates, function ($date) {
      return $date >= strtotime("today");
    });
    if (empty($upcoming_dates)) {
      delete_post_meta($post_id, "next_event_date");
    } else {
      update_post_meta($post_id, "next_event_date", reset($upcoming_dates));
    }
  }
}

add_action("acf/save_post", function ($post_id) {
  whitespace_a11ystack_update_event_post_meta($post_id);
});

/**
 * Update event post meta on event posts after midnight.
 */
add_action("init", function () {
  if (wp_next_scheduled("whitespace_a11ystack_update_events_post_meta")) {
    return;
  }
  wp_schedule_event(
    strtotime("tomorrow midnight +3 hours"),
    "daily",
    "whitespace_a11ystack_update_events_post_meta",
  );
  do_action("whitespace_a11ystack_update_events_post_meta");
});
add_action("whitespace_a11ystack_update_events_post_meta", function () {
  $args = [
    "post_type" => "event",
    "posts_per_page" => -1,
    // 'post_status' => 'publish',
  ];
  $posts = get_posts($args);
  foreach ($posts as $post) {
    whitespace_a11ystack_update_event_post_meta($post->ID);
  }
});

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

/**
 * Adds `eventDates` field to Event GraphQL type.
 */
add_action("graphql_register_types", function ($type_registry) {
  $type_registry->register_field("Event", "nextEventDate", [
    "type" => "String",
    "description" => __(
      "Next date for the event, updated by cron.",
      "whitespace-a11ystack",
    ),
    "resolve" => function ($source) {
      $date = get_post_meta($source->ID, "next_event_date", true);
      if (empty($date)) {
        return null;
      }
      return date("Y-m-d", $date);
    },
  ]);
});

add_filter(
  "wp-graphql-extras/ContentNode/archiveDates/value",
  function ($value, Post $post) {
    if (get_post_type($post->ID) === "event") {
      $event_dates = whitespace_a11ystack_get_event_dates($post->ID);
      $event_dates = array_map(function ($event_date) {
        return date("Y-m-d\TH:i:s", $event_date);
      }, $event_dates);
      $event_dates = array_unique($event_dates);
      sort($event_dates);
      $value = $event_dates;
    }
    return $value;
  },
  10,
  2,
);

add_filter(
  "wp-graphql-extras/ContentNode/archiveDatesGmt/value",
  function ($value, Post $post) {
    if (get_post_type($post->ID) === "event") {
      $event_dates = whitespace_a11ystack_get_event_dates($post->ID);
      $event_dates = array_map(function ($event_date) {
        return gmdate("Y-m-d\TH:i:s", $event_date);
      }, $event_dates);
      $event_dates = array_unique($event_dates);
      sort($event_dates);
      $value = $event_dates;
    }
    return $value;
  },
  10,
  2,
);

/**
 * Sorts events by next event date and filters out events without next event date.
 */
add_filter(
  "modularity_graphql/ModPosts/contentNodes/PostObjectConnectionResolver",
  function (
    PostObjectConnectionResolver $resolver,
    $data_source,
    $parent_post,
    $root
  ) {
    if ($data_source != "posttype") {
      return $resolver;
    }

    $post_type = get_field("posts_data_post_type", $root->ID, false);
    if ($post_type != "event") {
      return $resolver;
    }

    $resolver->set_query_arg("meta_key", "next_event_date");
    $resolver->set_query_arg("meta_query", [
      "key" => "next_event_date",
      "compare" => "EXISTS",
    ]);
    $resolver->set_query_arg("orderby", "meta_value");
    $resolver->set_query_arg("order", "ASC");

    return $resolver;
  },
  10,
  4,
);

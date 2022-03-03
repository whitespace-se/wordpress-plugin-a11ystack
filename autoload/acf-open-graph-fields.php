<?php

function get_location() {
  $post_types = ["post", "page"];
  $post_types = apply_filters(
    "whitespace-a11ystack/open_graph/enabled_post_types",
    $post_types,
  );
  $location = array_map(function ($post_type) {
    return [
      [
        "param" => "post_type",
        "operator" => "==",
        "value" => $post_type,
      ],
    ];
  }, $post_types);
  return $location;
}

add_action("acf/init", function () {
  acf_add_local_field_group([
    "key" => "group_open_graph",
    "title" => __("Social media", "whitespace-a11ystack"),
    "fields" => [
      [
        "key" => "field_open_graph_title",
        "label" => __("Title", "whitespace-a11ystack"),
        "name" => "title",
        "type" => "text",
        "instructions" => __(
          "If other than the title of the page.",
          "whitespace-a11ystack",
        ),
        "wrapper" => [
          "width" => "30",
          "class" => "",
          "id" => "",
        ],
        "show_in_graphql" => 1,
      ],
      [
        "key" => "field_open_graph_description",
        "label" => __("Description", "whitespace-a11ystack"),
        "name" => "description",
        "type" => "textarea",
        "instructions" => __(
          "Summarize the content. Preferably 55 characters or fewer.",
          "whitespace-a11ystack",
        ),
        "required" => 0,
        "wrapper" => [
          "width" => "50",
          "class" => "",
          "id" => "",
        ],
        "show_in_graphql" => 1,
        "rows" => 1,
      ],
      [
        "key" => "field_open_graph_image",
        "label" => __("Image", "whitespace-a11ystack"),
        "name" => "image",
        "type" => "image",
        "instructions" => __(
          "If no image is uploaded, the featured image is used. In case of no featured image, a default fallback image will be used.",
          "whitespace-a11ystack",
        ),
        "wrapper" => [
          "width" => "20",
          "class" => "",
          "id" => "",
        ],
        "show_in_graphql" => 1,
        "return_format" => "array",
        "preview_size" => "thumbnail",
        "library" => "all",
      ],
    ],
    "location" => get_location(),
    "menu_order" => 0,
    "position" => "normal",
    "style" => "default",
    "label_placement" => "top",
    "instruction_placement" => "label",
    "hide_on_screen" => "",
    "active" => true,
    "description" => "",
    "show_in_graphql" => 1,
    "graphql_field_name" => "openGraph",
  ]);
});

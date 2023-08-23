<?php

use WPGraphQL\Model\Post;

/**
 * Adds `hasPageContent` field to ContentNode GraphQL type.
 */
add_action("graphql_register_types", function ($type_registry) {
  $type_registry->register_field("ContentNode", "hasPageContent", [
    "type" => "Boolean",
    "description" => __(
      "Whether the node has page content.",
      "whitespace-a11ystack",
    ),
    "resolve" => function (Post $node) {
      $post = get_post($node->ID);
      return trim($post->post_content) ||
        whitespace_a11ystack_post_has_modules($post);
    },
  ]);
});

/**
 * Adds `manualExcerpt` field to NodeWithExcerpt GraphQL interface.
 */
add_action("graphql_register_types", function ($type_registry) {
  $type_registry->register_field("NodeWithExcerpt", "manualExcerpt", [
    "type" => "String",
    "description" => __(
      "The manual excerpt of the post.",
      "whitespace-a11ystack",
    ),
    "args" => [
      "format" => [
        "type" => "PostObjectFieldFormatEnum",
        "description" => __(
          "Format of the field output",
          "whitespace-a11ystack",
        ),
      ],
    ],
    "resolve" => function ($source, $args) {
      if (!has_excerpt($source->ID)) {
        return null;
      }
      if (isset($args["format"]) && "raw" === $args["format"]) {
        return $source->excerptRaw;
      }
      return $source->excerptRendered;
    },
  ]);
});

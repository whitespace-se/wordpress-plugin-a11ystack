<?php

function whitespace_a11ystack_is_modularity_page($post_type) {
  return strpos($post_type, "mod-") === 0;
}

/**
 * Changes label for the publish button in module editor to "Save"
 */
add_action("init", function () {
  global $pagenow;

  if (
    isset($pagenow) &&
    $pagenow == "post-new.php" &&
    isset($_GET["post_type"]) &&
    whitespace_a11ystack_is_modularity_page($_GET["post_type"])
  ) {
    add_filter(
      "gettext",
      function ($translation, $text, $domain) {
        if ($text === "Publish") {
          return __("Save");
        }
        return $translation;
      },
      10,
      3,
    );
  }
});

/**
 * Hides the preview button in module editor
 */
add_action("admin_head", function () {
  global $current_screen;

  if (whitespace_a11ystack_is_modularity_page($current_screen->post_type)) {
    echo '<style type="text/css">#preview-action,.updated a{display:none;}</style>';
  }
});

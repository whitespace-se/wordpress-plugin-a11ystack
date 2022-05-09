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

<?php

function whitespace_a11ystack_feature_enabled($feature, $default = false) {
  $constant = "WHITESPACE_A11YSTACK_ENABLE_" . strtoupper($feature);
  if (defined($constant)) {
    $value = constant($constant);
    if (!is_null($value)) {
      return (bool) $value;
    }
  }
  return get_option("whitespace_a11ystack_feature_" . $feature, $default);
}

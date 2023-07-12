<?php

function whitespace_a11ystack_get_icons() {
  $icons = [];
  $icons = apply_filters("whitespace_a11ystack_icons", $icons);
  sort($icons);
  return $icons;
}

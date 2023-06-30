<?php

namespace Whitespace\A11ystack\Modularity;

class ModBillboard extends \Modularity\Module {
  public $slug = "billboard";
  public $supports = [];

  public function init() {
    $this->nameSingular = __("Billboard", "whitespace-a11ystack");
    $this->namePlural = __("Billboards", "whitespace-a11ystack");
    $this->description = __(
      "Outputs a hero, featured story, promo text etc.",
      "whitespace-a11ystack",
    );

    // Billboard icon by Phoenix Dungeon. https://thenounproject.com/icon/billboard-5730942/
    $icon_svg =
      '<svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 32 32" x="0px" y="0px"><circle cx="6.423" cy="11.025" r="1"/><circle cx="10.625" cy="11.025" r="1"/><path d="M18.291,24.068l-4.9-7.865c-.183-.293-.485-.475-.831-.497-.341-.021-.669,.117-.89,.383l-5.828,7.059-1.543-1.273,5.829-7.059c.637-.769,1.568-1.169,2.565-1.105,.994,.066,1.867,.59,2.395,1.436l4.9,7.866-1.697,1.057Z"/><path d="M25.494,23.469l-4.435-5.821c-.185-.243-.454-.39-.758-.415-.314-.023-.595,.078-.816,.288l-2.429,2.3-1.375-1.453,2.429-2.3c.63-.596,1.488-.9,2.353-.828,.864,.07,1.662,.506,2.188,1.195l4.436,5.821-1.592,1.213Z"/><rect x="6.768" y="1.133" width="5.911" height="2" rx="1" ry="1"/><rect x="19.321" y="1.133" width="5.911" height="2" rx="1" ry="1"/><rect x="5.953" y="28.951" width="20" height="2" rx="1" ry="1"/><path d="M26,23.998H6c-2.757,0-5-2.243-5-5V10c0-2.757,2.243-5,5-5H26c2.757,0,5,2.243,5,5v8.998c0,2.757-2.243,5-5,5ZM6,7c-1.654,0-3,1.346-3,3v8.998c0,1.654,1.346,3,3,3H26c1.654,0,3-1.346,3-3V10c0-1.654-1.346-3-3-3H6Z"/><path d="M19,31h-6v-9.002h6v9.002Zm-4-2h2v-5.002h-2v5.002Z"/><rect x="21.277" y="2.133" width="2" height="3.867"/><rect x="8.723" y="2.133" width="2" height="3.867"/><path d="M17.322,14.025c-1.654,0-3-1.346-3-3s1.346-3,3-3,3,1.346,3,3-1.346,3-3,3Zm0-4c-.552,0-1,.448-1,1s.448,1,1,1,1-.448,1-1-.448-1-1-1Z"/></svg>';

    $this->icon = "data:image/svg+xml;base64," . base64_encode($icon_svg);
  }
}

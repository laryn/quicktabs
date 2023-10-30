<?php

/**
 * Alter the Quicktabs instance before it gets rendered.
 *
 * @param object &$quicktabs
 *   A loaded Quicktabs object.
 */
function hook_quicktabs_alter(&$quicktabs) {
  // Add another tab.
  $quicktabs->tabs[] = array(
    'nid' => 1,
    'view_mode' => 'full',
    'hide_title' => 1,
    'title' => 'My first tab',
    'weight' => '-1000',
    'type' => 'node',
  );
}

/**
 * Alter the tablinks attributes before they get rendered.
 *
 * @param array &$attributes
 *   An array of tablink attributes.
 * @param object &$quickset
 *   The quickset that the tablink belongs to.
 * @param string $key
 *   The key of the set item.
 *
 */
function hook_quicktabs_tablinks_attributes_alter(&$attributes, &$quickset, $key) {
  // Add another class
  $attributes['class'][] = 'my-custom-class';
}

/**
 * This hook allows other modules to create additional tab styles for
 * the quicktabs module.
 *
 * @return array
 *   An array of key => value pairs suitable for inclusion as the #options in a
 *   select or radios form element. Each key must be the location of a css
 *   file for a quick tabs style. Each value should be the name of the style.
 */
function hook_quicktabs_tabstyles() {
  $tabstyles_directory = backdrop_get_path('module', 'my_tabstyles') . '/tabstyles';
  $files = file_scan_directory($tabstyles_directory, '/\.css$/');
  $tabstyles = array();
  foreach ($files as $file) {
    // Skip RTL files.
    if (!strpos($file->name, '-rtl')) {
      $tabstyles[$file->uri] = backdrop_ucfirst($file->name);
    }
  }
  return $tabstyles;
}


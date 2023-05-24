<?php

function oldb_render_template($template, $data) {
  if (!file_exists($template)) {
    return '';
  }

  foreach($data as $key => $value) {
    $$key = $data[$key];
  }

  ob_start();
  include $template;
  $output = ob_get_contents();
  ob_end_clean();

  return $output;
} 
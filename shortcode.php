<?php

add_shortcode('openligadb', function($atts = [], $content) {
  $atts = shortcode_atts([
		'league' => 'bl1',
    'season' => '2022',
    'compact' => true
	], $atts, 'openligadb');

  $template = 'standings';
  $league = $atts['league'];
  $season = $atts['season'] ?: (int) date("Y");

  $api_base = 'https://api.openligadb.de';
  $api_action = 'getbltable';
  $template_dir = __DIR__ . '/template';
  $template_file = sprintf('%s/%s.php', $template_dir, $template);
  
  $url = sprintf('%s/%s/%s/%s/12', $api_base, $api_action, $league, $season);
  $data = oldb_get_url($url);

  if ($data && !count($data) && !$atts['season']) {
    $url = sprintf('%s/%s/%s/%s/12', $api_base, $api_action, $league, $season - 1);
    $data = oldb_get_url($url);
  }

  print_r($data);

  if (!$data || $data->status == '404') {
    return '';
  }

  print_r($data);

  $output = oldb_render_template($template_file, [
    'atts' => $atts,
    'data' => $data
  ]);

  return $output;
});

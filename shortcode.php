<?php

add_shortcode('openligadb', function($atts = [], $content) {
  $atts = shortcode_atts([
		'league' => 'bl1',
    'season' => '',
    'compact' => false
	], $atts, 'openligadb');

  $template = 'standings';
  $league = $atts['league'];
  $season = $atts['season'] ?: (int) date("Y");

  $api_base = 'https://api.openligadb.de';
  $api_action = 'getbltable';
  $template_dir = __DIR__ . '/template';
  $template_file = sprintf('%s/%s.php', $template_dir, $template);
  
  $url = sprintf('%s/%s/%s/%s', $api_base, $api_action, $league, $season);
  $data = oldb_get_url($url);

  if (is_array($data) && !count($data) && !$atts['season']) {
    $url = sprintf('%s/%s/%s/%s', $api_base, $api_action, $league, $season - 1);
    $data = oldb_get_url($url);
  }

  if (!$data || $data->status == '404') {
    return '';
  }

  $output = oldb_render_template($template_file, [
    'atts' => $atts,
    'data' => $data
  ]);

  return $output;
});

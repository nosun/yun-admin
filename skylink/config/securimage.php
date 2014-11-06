<?php
$config['si_general'] = array(
	//'ttf_file'             => YUN_SHARE_PATH.'libraries/securimage/AHGBold.ttf',
	'image_signature'      => '',
	'signature_color'      => '#abcdef',
	'case_sensitive'       => false,
	'image_height'         => 40,
	'image_bg_color'       => '#888',
	'text_color'           => '#EAEAEA',
	'line_color'           => '#EAEAEA',
	'image_type'           => 'Securimage::SI_IMAGE_JPEG',	
	'use_wordlist'         => false,
	'text_transparency_percentage' => 90,
	'use_transparent_text' => false

);
$config['si_easy'] = array(
	'code_length'  => 6,
	'perturbation' => .75,
	'num_lines'    => '2',
	'image_width'  => 200,
	'noise_level' => 30
);

$config['si_medium'] = array(
	'code_length'  => 7,
	'perturbation' => .82,
	'num_lines'    => rand(8, 10),
	'image_width'  => 260,
);

$config['si_hard'] = array(
	'code_length'  => 9,
	'perturbation' => 1.1,
	'num_lines'    => rand(10, 12),
	'image_width'  => 320,
);
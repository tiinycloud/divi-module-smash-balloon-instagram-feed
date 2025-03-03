<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
$fields = '';
foreach($_GET as $key=>$value){
	if (strpos($key, 'wdfield_') !== false && $value != 'undefined') {
		$val = str_replace("_extra", "", $value); 
		$fields .= empty($val) ? '' : ' '.str_replace("wdfield_", "", $key).'="'.$val.'"';
	}
}
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="margin-bottom:50px;">
<?php 
echo ($_GET['wdfield_diagnostics'] == 'off') ? do_shortcode('[instagram-feed'.$fields.']') : '[instagram-feed'.$fields.']';
?>
<?php wp_footer(); ?>
</body>
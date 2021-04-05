.big-post-<?php echo $id; ?> .judul-text {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->color ); ?>;
}

<?php
FLBuilderCSS::typography_field_rule( array(
	'settings'     => $settings,
	'setting_name' => 'typography',
	'selector'     => ".fl-node-$id .judul-text",
) );

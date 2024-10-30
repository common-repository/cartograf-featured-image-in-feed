<?php

	add_action('admin_menu', 'cg_fi_admin_menu');

	function cg_fi_admin_menu() {
		add_options_page('Cartograf Featured-image in Feed', 'Cartograf Featured-image in Feed Settings', 'manage_options', 'cg_featured_image_feed', 'cg_fi_settings_page');
	}

	function cg_fi_settings_page(){
	?>
		<form method="POST" action="options.php">
		<?php
			settings_fields('cg_fi_options');
			do_settings_sections('cg_fi_options_form');
			submit_button();
		?>
		</form>
		<style>
			.radio-group {
				margin:0px;
			}
			textarea {
				width:450px;
				height:100px;
			}
			.form-table {
				clear:left;
				width:auto;
			}
                        .tip {
                            font-size:9px;
                            color:#999;
                        }
                </style>
	<?php
	}

	add_action( 'admin_init', 'cg_fi_admin_init' );

	function cg_fi_admin_init() {
		add_settings_section('cg_fi_main_config',
			'Cartograf Featured-image in Feed settings',
			'cg_fi_main_config_render',
			'cg_fi_options_form'
		);

		add_settings_field('cg_fi_backlink_active',
			'Check this box if you want the Image to be wrapped inside a backlink to your site',
			'cg_fi_backlink_active',
			'cg_fi_options_form',
			'cg_fi_main_config'
		);

		register_setting( 'cg_fi_options', 'cg_fi_backlink_active');
	}

	function cg_fi_main_config_render($attr){
		echo '<div style="display: block; float: right; max-width: 20%; width: 350px; padding: 10px; position: fixed; right: 0; background: #fff; text-align: center;" class="options right"><img src="' . plugins_url('cartograf-cookie-filter') . '/logo-cartograf.png' . '" /><p>';
		_e('This plugin is maintined by <a target="_blank" href="http://www.versvs.net/?utm_source=opcionesplugin&utm_medium=pluginwordpress&utm_campaign=cookiefilter">Jose Alcántara</a>. You can <a target="_blank" href="https://www.paypal.com/donate?token=CvC9gfB1JX93I8eSBIIwhVfgQzVlJLL5XRE-UID_98RzyTxg5TsPGzVp2djZUWgmx9PIiSMuAKDA0MGi">donate me a coffee</a>.');
		echo '</p></div>
				<div class="options left">';
		_e('Remember, if you think we can improve this plugin or have any suggestion, please<br />
			drop us a line using e-mail, twitter, or open an issue for this plugin in wordpress.org');
	}


	function cg_fi_backlink_active(){
		?>
    <input type="checkbox" name="cg_fi_backlink_active" value="1" <?php checked( '1', get_option( 'cg_fi_backlink_active' ) ); ?> />
		<?php
	} ?><?php //this last div in the previous line is needed to close the container
  //</div>
?>

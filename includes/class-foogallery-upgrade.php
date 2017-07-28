<?php
/**
 * Class used to upgrade internal gallery settings when needed
 * Date: 19/07/2017
 */
if ( ! class_exists( 'FooGallery_Upgrade' ) ) {

	class FooGallery_Upgrade {

		function __construct() {
			//intercept the gallery load and check if we need to upgrade a gallery
			add_action( 'foogallery_foogallery_instance_after_load', array( $this, 'upgrade_gallery' ), 10, 2 );
		}

		/**
		 * Checks if the gallery needs to be upgraded based on the settings version
		 *
		 * @param $foogallery FooGallery
		 * @param $post
		 */
		function upgrade_gallery( $foogallery, $post ) {
			//if ( FOOGALLERY_SETTINGS_VERSION !== $foogallery->settings_version ) {
				$this->perform_gallery_settings_upgrade( $foogallery );

				//update the settings version for the gallery
				//update_post_meta( $post->ID, FOOGALLERY_META_SETTINGS_VERSION, FOOGALLERY_SETTINGS_VERSION );
			//}
		}

		function perform_gallery_settings_upgrade( $foogallery ) {

			$mappings = array(
				array(
					'id' => 'border-style',
					'value' => 'border-style-square-white',
					'new' => array(
						array ( 'id' => 'theme', 'value' => 'fg-light' ),
						array ( 'id' => 'border-size', 'value' => 'fg-border-thin' ),
						array ( 'id' => 'drop-shadow', 'value' => 'fg-shadow-small' ),
						array ( 'id' => 'rounded-corners', 'value' => '' ),
						array ( 'id' => 'inset-shadow', 'value' => '' ),
					)
				),
				array(
					'id' => 'border-style',
					'value' => 'border-style-circle-white',
					'new' => array(
						array ( 'id' => 'theme', 'value' => 'fg-light' ),
						array ( 'id' => 'border-size', 'value' => 'fg-border-thin' ),
						array ( 'id' => 'drop-shadow', 'value' => 'fg-shadow-small' ),
						array ( 'id' => 'rounded-corners', 'value' => 'fg-round-full' ),
						array ( 'id' => 'inset-shadow', 'value' => '' ),
					)
				),
				array(
					'id' => 'border-style',
					'value' => 'border-style-square-black',
					'new' => array(
						array ( 'id' => 'theme', 'value' => 'fg-dark' ),
						array ( 'id' => 'border-size', 'value' => 'fg-border-thin' ),
						array ( 'id' => 'drop-shadow', 'value' => 'fg-shadow-small' ),
						array ( 'id' => 'rounded-corners', 'value' => '' ),
						array ( 'id' => 'inset-shadow', 'value' => '' ),
					)
				),
				array(
					'id' => 'border-style',
					'value' => 'border-style-circle-black',
					'new' => array(
						array ( 'id' => 'theme', 'value' => 'fg-dark' ),
						array ( 'id' => 'border-size', 'value' => 'fg-border-thin' ),
						array ( 'id' => 'drop-shadow', 'value' => 'fg-shadow-small' ),
						array ( 'id' => 'rounded-corners', 'value' => 'fg-round-full' ),
						array ( 'id' => 'inset-shadow', 'value' => '' ),
					)
				),
				array(
					'id' => 'border-style',
					'value' => 'border-style-inset',
					'new' => array(
						array ( 'id' => 'theme', 'value' => 'fg-light' ),
						array ( 'id' => 'border-size', 'value' => '' ),
						array ( 'id' => 'drop-shadow', 'value' => 'fg-shadow-small' ),
						array ( 'id' => 'rounded-corners', 'value' => '' ),
						array ( 'id' => 'inset-shadow', 'value' => 'fg-shadow-inset-large' ),
					)
				),
				array(
					'id' => 'border-style',
					'value' => 'border-style-rounded',
					'new' => array(
						array ( 'id' => 'theme', 'value' => 'fg-light' ),
						array ( 'id' => 'border-size', 'value' => '' ),
						array ( 'id' => 'drop-shadow', 'value' => '' ),
						array ( 'id' => 'rounded-corners', 'value' => 'fg-round-small' ),
						array ( 'id' => 'inset-shadow', 'value' => '' ),
					)
				),
				array(
					'id' => 'border-style',
					'value' => '',
					'new' => array(
						array ( 'id' => 'theme', 'value' => 'fg-light' ),
						array ( 'id' => 'border-size', 'value' => '' ),
						array ( 'id' => 'drop-shadow', 'value' => '' ),
						array ( 'id' => 'rounded-corners', 'value' => '' ),
						array ( 'id' => 'inset-shadow', 'value' => '' ),
					)
				),

				array(
					'id' => 'spacing',
					'value' => 'spacing-width-0',
					'new' => array(
						array ( 'id' => 'spacing', 'value' => 'fg-gutter-0' )
					)
				),
				array(
					'id' => 'spacing',
					'value' => 'spacing-width-5',
					'new' => array(
						array ( 'id' => 'spacing', 'value' => 'fg-gutter-5' )
					)
				),
				array(
					'id' => 'spacing',
					'value' => 'spacing-width-10',
					'new' => array(
						array ( 'id' => 'spacing', 'value' => 'fg-gutter-10' )
					)
				),
				array(
					'id' => 'spacing',
					'value' => 'spacing-width-15',
					'new' => array(
						array ( 'id' => 'spacing', 'value' => 'fg-gutter-15' )
					)
				),
				array(
					'id' => 'spacing',
					'value' => 'spacing-width-20',
					'new' => array(
						array ( 'id' => 'spacing', 'value' => 'fg-gutter-20' )
					)
				),
				array(
					'id' => 'spacing',
					'value' => 'spacing-width-25',
					'new' => array(
						array ( 'id' => 'spacing', 'value' => 'fg-gutter-25' )
					)
				),

				array(
					'id' => 'alignment',
					'value' => 'alignment-left',
					'new' => array(
						array ( 'id' => 'alignment', 'value' => 'fg-left' )
					)
				),
				array(
					'id' => 'alignment',
					'value' => 'alignment-center',
					'new' => array(
						array ( 'id' => 'alignment', 'value' => 'fg-center' )
					)
				),
				array(
					'id' => 'alignment',
					'value' => 'alignment-right',
					'new' => array(
						array ( 'id' => 'alignment', 'value' => 'fg-right' )
					)
				),

				array(
					'id' => 'loading_animation',
					'value' => 'yes',
					'new' => array(
						array ( 'id' => 'loading_animation', 'value' => 'fg-loading-default' )
					)
				),
				array(
					'id' => 'loading_animation',
					'value' => 'no',
					'new' => array(
						array ( 'id' => 'loading_animation', 'value' => 'fg-loading-none' )
					)
				),


				array(
					'id' => 'hover-effect-type',
					'value' => '', //Icon
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' ),
						array ( 'id' => 'caption_type', 'value' => 'fg-caption-hover' ),
						array ( 'id' => 'caption_hover_effect', 'value' => 'fg-hover-fade'),
						array ( 'id' => 'caption_content', 'value' => 'icon')
					)
				),

				array(
					'id' => 'hover-effect-type',
					'value' => 'hover-effect-tint', //Dark Tint
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' ),
						array ( 'id' => 'caption_type', 'value' => 'fg-caption-hover' ),
						array ( 'id' => 'caption_hover_effect', 'value' => 'fg-hover-fade')
					)
				),

				array(
					'id' => 'hover-effect-type',
					'value' => 'hover-effect-color', //Colorize
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' ),
						array ( 'id' => 'caption_type', 'value' => 'fg-caption-hover' )
					)
				),

				array(
					'id' => 'hover-effect-type',
					'value' => 'hover-effect-none', //None
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' ),
						array ( 'id' => 'caption_type', 'value' => 'fg-caption-hover' )
					)
				),

				array(
					'id' => 'hover-effect-type',
					'value' => 'hover-effect-caption', //Caption
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' ),
						array ( 'id' => 'caption_type', 'value' => 'fg-caption-hover' )
					)
				),



				array(
					'id' => 'caption-hover-effect',
					'value' => 'hover-caption-simple',
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' ),
						array ( 'id' => 'caption_type', 'value' => 'fg-caption-hover' )
					)
				),
				array(
					'id' => 'caption-hover-effect',
					'value' => 'hover-caption-full-drop',
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' ),
						array ( 'id' => 'caption_hover_effect', 'value' => 'fg-hover-slide-down')
					)
				),
				array(
					'id' => 'caption-hover-effect',
					'value' => 'hover-caption-full-fade',
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' )
					)
				),
				array(
					'id' => 'caption-hover-effect',
					'value' => 'hover-caption-push',
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' )
					)
				),
				array(
					'id' => 'caption-hover-effect',
					'value' => 'hover-caption-simple-always',
					'new' => array(
						array ( 'id' => 'caption_theme', 'value' => 'fg-custom' )
					)
				),
			);

			//upgrade all template settings
			foreach ( foogallery_gallery_templates() as $template ) {

				foreach ( $mappings as $mapping ) {

					$settings_key = "{$template['slug']}_{$mapping['id']}";

					//check if the settings exists
					if ( array_key_exists( $settings_key, $foogallery->settings ) ) {

						$old_settings_value = $foogallery->settings[$settings_key];

						if ( $mapping['value'] === $old_settings_value ) {
							//we have found a match!

							foreach ( $mapping['new'] as $setting_to_create ) {
								$new_setting_key = "{$template['slug']}_{$setting_to_create['id']}";
								$new_setting_value = $setting_to_create['value'];
								$foogallery->settings[$new_setting_key] = $new_setting_value;
							}
						}
					}
				}
			}
		}
	}
}
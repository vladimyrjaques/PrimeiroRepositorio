<?php

/**
 * Plugin Name: Progress Map by CodeSpacing
 * Plugin URI: http://codecanyon.net/item/progress-map-wordpress-plugin/5581719?ref=codespacing
 * Description: <strong>Progress Map</strong> is a Wordpress plugin for location listings. With this plugin, your locations will be listed on both Google map (as markers) and a carousel (as locations details), this last will be related to the map, which means that the selected item in the carousel will target its location in the map and vice versa.
 * Version: 2.8.2
 * Author: Hicham Radi (CodeSpacing)
 * Author URI: http://www.codespacing.com/
 * Text Domain: cspm
 * Domain Path: /languages
 */

if(!class_exists('CodespacingProgressMap')){
	
	class CodespacingProgressMap{
		
		private static $_this;	
		private $plugin_path;
		public $cspm_plugin_path;
		private $plugin_url;
		public $cspm_plugin_url;
		private $cspm_wpsf;
		private $plugin_get_var = 'cs_progress_map_plugin';
		public $plugin_version = '2.8.2';
		public $settings = array();
		
		/**
		 * Query settings */
		 
		public $post_type = 'post';
		public $secondary_post_type = '';
		public $post_in = '';		
		public $post_not_in = '';		
		public $cache_results = '';
		public $update_post_meta_cache = '';
		public $update_post_term_cache = '';
		public $orderby_param = '';
		public $orderby_meta_key = '';
		public $order_param = '';
		public $number_of_items = '';		
		public $custom_fields = '';		
		public $custom_field_relation_param = '';
		public $post_status = 'publish'; // @since 2.8.2
		
		/**
		 * Layout settings */
		
		public $main_layout = 'mu-cd';	
		public $layout_type = 'full_width';
		public $layout_fixed_width = '700';
		public $layout_fixed_height = '600';
		
		/**
		 * Map settings */
		 
		public $map_language = 'en';
		public $center = '51.53096,-0.121064';			
		public $wrong_center_point = false;
		public $initial_map_style = 'ROADMAP';
		public $zoom = '12';
		public $useClustring = 'true';
		public $gridSize = '60';
		public $mapTypeControl = 'true';
		public $streetViewControl = 'false';
		public $scrollwheel = 'false';
		public $panControl = 'false';					
		public $zoomControl = 'true';
		public $zoomControlType = 'customize';
		public $marker_icon = '';			
		public $big_cluster_icon = '';
		public $medium_cluster_icon = '';
		public $small_cluster_icon = ''; 
		public $cluster_text_color = '#ffffff';			
		public $zoom_in_icon = '';	
		public $zoom_in_css = '';
		public $zoom_out_icon = '';
		public $zoom_out_css = '';
		public $defaultMarker = '';
		public $retinaSupport = 'false';
		public $geoIpControl = 'false';	
		public $pulsating_circle = 'pulsating_circle'; // @since 2.5		
		public $marker_anchor_point_option = 'disable'; //@since 2.6.1
		public $marker_anchor_point = ''; //@since 2.6.1
		public $map_draggable = 'true'; //@since 2.6.3
		public $max_zoom = 19; //@since 2.6.3
		public $min_zoom = 0; //@since 2.6.3		
		public $zoom_on_doubleclick = 'false'; //@since 2.6.4
		public $autofit = 'false'; //@since 2.7
		public $traffic_layer = 'false'; //@since 2.7
		public $transit_layer = 'false'; //@since 2.7.4
		public $show_user = 'false'; //@since 2.7.4
		public $user_marker_icon = ''; //@since 2.7.4
		public $user_map_zoom = 12; //@since 2.7.4
		public $user_circle = 0; //@since 2.7.4
		
		/**
		 * Map style settings */
		
		public $style_option = 'progress-map';
		public $map_style = 'google-map';	
		public $js_style_array = '';
		public $custom_style_name = 'Custom style'; //@since 2.6.1
		 		 		
		/**
		 * Carousel settings */
				
		public $show_carousel = 'true';
		public $carousel_mode = 'false';
		public $carousel_scroll = '1';
		public $carousel_animation = 'fast';
		public $carousel_easing = 'linear';
		public $carousel_auto = '0';
		public $carousel_wrap = 'circular';	
		public $scrollwheel_carousel = 'false';	
		public $touchswipe_carousel = 'false';
		public $move_carousel_on = array('marker_click', 'marker_hover', 'infobox_hover');	
		public $carousel_map_zoom = '12';
		
		/**
		 * Carousel style */
		 
		public $carousel_css = '';	
		public $arrows_background = '#fff';	
		public $horizontal_left_arrow_icon = '';
		public $horizontal_right_arrow_icon = '';	
		public $vertical_top_arrow_icon = '';
		public $vertical_bottom_arrow_icon = '';
		public $items_background = '#fff';	
		public $items_hover_background = '#fbfbfb';	
		
		/**
		 * Carousel items settings */
		 
		public $items_view = 'listview';
		public $horizontal_item_css = '';
		public $horizontal_title_css = '';
		public $horizontal_details_css = '';
		public $vertical_item_css = '';
		public $vertical_title_css = '';
		public $vertical_details_css = '';
		
		public $horizontal_item_size = '454,150'; //@updated 2.8
		public $horizontal_item_width = '454'; //@updated 2.8
		public $horizontal_item_height = '150'; //@updated 2.8
		public $horizontal_image_size = '204,150'; //@updated 2.8
		public $horizontal_img_width = '204'; //@updated 2.8
		public $horizontal_img_height = '150'; //@updated 2.8
		public $horizontal_details_size = '250,150'; //@updated 2.8
		public $horizontal_details_width = '250'; //@updated 2.8
		public $horizontal_details_height = '150'; //@updated 2.8		
		public $vertical_item_size = '204,290'; //@updated 2.8
		public $vertical_item_width = '204'; //@updated 2.8
		public $vertical_item_height =  '290'; //@updated 2.8
		public $vertical_image_size = '204,120'; //@updated 2.8
		public $vertical_img_width = '204'; //@updated 2.8
		public $vertical_img_height = '120'; //@updated 2.8
		public $vertical_details_size = '204,170'; //@updated 2.8
		public $vertical_details_width = '204'; //@updated 2.8
		public $vertical_details_height = '170'; //@updated 2.8
		public $show_details_btn = 'yes';
		public $items_title = '';
		public $click_on_title = 'no'; //@since 2.5	
		public $external_link = 'same_window'; //@since 2.5
		public $items_details = '';
		public $details_btn_css = '';
		public $details_btn_text = '';								
		
		/**
		 * Posts count settings */
		 
		public $show_posts_count = 'no';
		public $posts_count_clause = '[posts_count] Posts';
		public $posts_count_color = '#000000';
		public $posts_count_style = '';
		
		/**
		 * Marker categories settings */
		 
		public $marker_cats_settings = 'false';
		public $marker_taxonomies = '';
		
		/**
		 * Faceted search settings */
		 
		public $faceted_search_option = 'false';
		public $faceted_search_multi_taxonomy_option = 'true';
		public $faceted_search_input_skin = 'polaris';
		public $faceted_search_input_color = 'blue';
		public $faceted_search_icon = '';
		public $faceted_search_css = '';
		public $faceted_search_drag_map = 'no'; //@since 2.8.2
		
		/**
		 * Search form settings */
		 
		public $search_form_option = 'false';
		public $sf_search_distances = '3,50';
		public $sf_distance_unit = 'metric';
		public $address_placeholder = 'Enter City & Province, or Postal code';
		public $slider_label = 'Expand the search area up to';
		public $no_location_msg = 'We could not find any location';
		public $bad_address_msg = 'We could not understand the location';
		public $bad_address_sug_1 = '- Make sure all street and city names are spelled correctly.';
		public $bad_address_sug_2 = '- Make sure your address includes a city and state.';
		public $bad_address_sug_3 = '- Try entering a zip code.';		
		public $submit_text = 'Search';
		public $search_form_icon = '';		
		public $search_form_bg_color = 'rgba(255,255,255,0.95)';
		public $circle_option = 'true';
		public $fillColor = '#189AC9';
		public $fillOpacity = '0.1';
		public $strokeColor = '#189AC9';				
		public $strokeOpacity = '1';
		public $strokeWeight = '1';			
					
		/**
		 * infobox settings */
		 
		public $show_infobox = 'true'; // @since 2.5		
		public $infobox_type = 'rounded_bubble'; // @since 2.5		
		public $infobox_display_event = 'onload'; // @since 2.5		
		public $infobox_external_link = 'same_window'; // @since 2.5	
		public $remove_infobox_on_mouseout = 'false'; //@since 2.7.4	
		
		/**
		 * Troubleshooting & configs */
		 
		public $use_ssl = 'http'; // @since 2.5	// @Deprecated 2.8
		public $combine_files = 'combine'; // @since 2.5		
		public $loading_scripts = 'entire_site'; // @since 2.5		
		public $load_on_page_ids = ''; // @since 2.5		
		public $load_on_post_ids = ''; // @since 2.5
		public $load_on_page_templates = ''; // @since 2.6.1
		public $include_or_remove_option = 'include'; //@since 2.6.1		
		public $latitude_field_name = 'codespacing_progress_map_lat'; // @since 2.5		
		public $longitude_field_name = 'codespacing_progress_map_lng'; // @since 2.5
		public $outer_links_field_name = ''; //@since 2.5		
		public $extra_css = ''; //@since 2.6.1
		public $map_in_tab = 'no'; //@since 2.6.1
		public $custom_list_columns = 'no'; //@since 2.6.3
		public $use_with_wpml = 'no'; //@since 2.6.3
		public $api_key = ''; //@since 2.8
		public $remove_bootstrap = 'enable'; //@since 2.8.2
		public $remove_gmaps_api = 'enable'; //@since 2.8.2	
		public $remove_google_fonts = 'enable'; //@since 2.8.2		
				
		/**
		 * KML Layers */
		 
		public $use_kml = 'false'; //@since 2.7
		public $kml_file = ''; //@since 2.7
		public $suppressInfoWindows = 'false'; //@since 2.7	
		public $preserveViewport = 'false'; //@since 2.7
		
		/**
		 * Overlays: Polyline */
		 
		public $draw_polyline = 'false'; //@since 2.7
		public $polylines = ''; //@since 2.7		
		
		/**
		 * Overlays: Polygon */
		 
		public $draw_polygon = 'false'; //@since 2.7
		public $polygons = ''; //@since 2.7		
		
		function __construct() 
		{	
			
			self::$_this = $this;       
			$this->plugin_path = $this->cspm_plugin_path = plugin_dir_path( __FILE__ );
			$this->plugin_url = $this->cspm_plugin_url  = plugin_dir_url( __FILE__ );

			/**
			 * Include and create a new WordPressSettingsFramework */
			 
			require_once( $this->plugin_path .'wp-settings-framework.php' );
			$this->cspm_wpsf = new CsPm_WordPressSettingsFramework( $this->plugin_path .'settings/codespacing-progress-map.php' );
			
			/**
			 * Load plugin textdomain.
			 * @since 2.8 */
			 
			add_action('init', array(&$this, 'cspm_load_plugin_textdomain')); 
			
			/**
			 * Call the plugin settings */
			 
			$this->settings = cspm_wpsf_get_settings( $this->plugin_path .'settings/codespacing-progress-map.php' );
					
				/**
				 * "Add location" Form fields */
				
				$this->latitude_field_name = str_replace(' ', '', $this->cspm_get_setting('troubleshooting', 'latitude_field_name', 'codespacing_progress_map_lat'));
				$this->longitude_field_name = str_replace(' ', '', $this->cspm_get_setting('troubleshooting', 'longitude_field_name', 'codespacing_progress_map_lng'));
			
				if (!defined('CSPM_ADDRESS_FIELD')) define('CSPM_ADDRESS_FIELD', 'codespacing_progress_map_address');
				if (!defined('CSPM_LATITUDE_FIELD')) define('CSPM_LATITUDE_FIELD', $this->latitude_field_name);
				if (!defined('CSPM_LONGITUDE_FIELD')) define('CSPM_LONGITUDE_FIELD', $this->longitude_field_name);	
				if (!defined('CSPM_SECONDARY_LAT_LNG_FIELD')) define('CSPM_SECONDARY_LAT_LNG_FIELD', 'codespacing_progress_map_secondary_lat_lng');												
				if (!defined('CSPM_MARKER_ICON_FIELD')) define('CSPM_MARKER_ICON_FIELD', 'cspm_primary_marker_image'); /* @since 2.8 */
				
				/**
				 * GMaps API Key 
				 * @since 2.8 */
				 
				$this->api_key = $this->cspm_get_setting('mapsettings', 'api_key', '');
				
				/**
				 * Other settings */
				 
				$this->post_type = $this->cspm_get_setting('generalsettings', 'post_type', 'post');
				$secondary_post_type_array = $this->cspm_get_setting('generalsettings', 'secondary_post_type', array());
				$this->secondary_post_type = (!empty($secondary_post_type_array)) ? implode(',', $this->cspm_get_setting('generalsettings', 'secondary_post_type', array())) : '';
				
				$this->horizontal_item_size = $this->cspm_get_setting('itemssettings', 'horizontal_item_size', '454,150');
					
					if($explode_horizontal_item_size = explode(',', $this->horizontal_item_size)){
						$this->horizontal_item_width = $this->cspm_setting_exists(0, $explode_horizontal_item_size, '454');
						$this->horizontal_item_height = $this->cspm_setting_exists(1, $explode_horizontal_item_size, '150');
					}else{
						$this->horizontal_item_width = '454';
						$this->horizontal_item_height = '150';
					}
				
					$this->horizontal_image_size = $this->cspm_get_setting('itemssettings', 'horizontal_image_size', '204,150');
						
						if($explode_horizontal_img_size = explode(',', $this->horizontal_image_size)){
							$this->horizontal_img_width = $this->cspm_setting_exists(0, $explode_horizontal_img_size, '204');
							$this->horizontal_img_height = $this->cspm_setting_exists(1, $explode_horizontal_img_size, '150');
						}else{
							$this->horizontal_img_width = '204';
							$this->horizontal_img_height = '150';
						}
					
				$this->vertical_item_size = $this->cspm_get_setting('itemssettings', 'vertical_item_size', '204,290');
					
					if($explode_vertical_item_size = explode(',', $this->vertical_item_size)){
						$this->vertical_item_width = $this->cspm_setting_exists(0, $explode_vertical_item_size, '204');
						$this->vertical_item_height =  $this->cspm_setting_exists(1, $explode_vertical_item_size, '290');
					}else{
						$this->vertica_item_width = '204';
						$this->vertica_item_height = '290';
					}
					
					$this->vertical_image_size = $this->cspm_get_setting('itemssettings', 'vertical_image_size', '204,120');			
						
						if($explode_vertical_img_size = explode(',', $this->vertical_image_size)){
							$this->vertical_img_width = $this->cspm_setting_exists(0, $explode_vertical_img_size, '204');
							$this->vertical_img_height = $this->cspm_setting_exists(1, $explode_vertical_img_size, '120');
						}else{
							$this->vertical_img_width = '204';
							$this->vertical_img_height = '120';
						}
				
				/**
				 * Add Images Size */
				 
				if(function_exists('add_image_size')){
					
					add_image_size( 'cspacing-horizontal-thumbnail', $this->horizontal_img_width, $this->horizontal_img_height, true );
					add_image_size( 'cspacing-vertical-thumbnail', $this->vertical_img_width, $this->vertical_img_height, true );
					add_image_size( 'cspacing-marker-thumbnail', 100, 100, true );
					
					/* @Deprecated since 2.8 */
					//add_image_size( 'cspacing-infobox1-thumbnail', 150, 120, true ); 
				
				}
			
			$this->show_details_btn = $this->cspm_get_setting('itemssettings', 'show_details_btn', 'yes');
			$this->items_title = $this->cspm_get_setting('itemssettings', 'items_title');
			$this->click_on_title = $this->cspm_get_setting('itemssettings', 'click_on_title');
			$this->external_link = $this->cspm_get_setting('itemssettings', 'external_link', 'same_window');
			$this->items_details = $this->cspm_get_setting('itemssettings', 'items_details');
			$this->details_btn_css = $this->cspm_get_setting('itemssettings', 'details_btn_css');
			$this->details_btn_text = $this->cspm_get_setting('itemssettings', 'details_btn_text', esc_html__('More', 'cspm'));
			$this->carousel_mode = $this->cspm_get_setting('carouselsettings', 'carousel_mode', 'false');
			$this->outer_links_field_name = str_replace(' ', '', $this->cspm_get_setting('troubleshooting', 'outer_links_field_name', ''));
			$this->custom_list_columns = $this->cspm_get_setting('troubleshooting', 'custom_list_columns', 'no');
			$this->use_with_wpml = $this->cspm_get_setting('troubleshooting', 'use_with_wpml', 'no');
			
			/**
			 * Ajax functions */
			 
			add_action('wp_ajax_cspm_load_carousel_item', array(&$this, 'cspm_load_carousel_item'));
			add_action('wp_ajax_nopriv_cspm_load_carousel_item', array(&$this, 'cspm_load_carousel_item'));
			
			add_action('wp_ajax_loadContentClass', array(&$this, 'loadContentClass'));
			add_action('wp_ajax_nopriv_loadContentClass', array(&$this, 'loadContentClass'));
			
			add_action('wp_ajax_loadContentFirstElement', array(&$this, 'loadContentFirstElement'));
			add_action('wp_ajax_nopriv_loadContentFirstElement', array(&$this, 'loadContentFirstElement'));
			
			add_action('wp_ajax_cspm_infobox_content', array(&$this, 'cspm_infobox_content'));
			add_action('wp_ajax_nopriv_cspm_infobox_content', array(&$this, 'cspm_infobox_content'));
			
			add_action('wp_ajax_cspm_load_clustred_markers_list', array(&$this, 'cspm_load_clustred_markers_list'));
			add_action('wp_ajax_nopriv_cspm_load_clustred_markers_list', array(&$this, 'cspm_load_clustred_markers_list'));
			
			add_action('wp_ajax_cspm_create_markers_array_for_latest_version', array(&$this, 'cspm_create_markers_array_for_latest_version'));
			
			/**
			 * Add a custom column on all posts list showing the coordinates of each post
			 * @since 2.6.3 */
			 
			$this->post_types_array = explode(',', str_replace(' ', '', $this->secondary_post_type).','.str_replace(' ', '', $this->post_type));	
			
			if($this->custom_list_columns == 'yes'){
				foreach($this->post_types_array as $post_type){
					if($post_type == 'page'){
						add_filter('manage_pages_columns', array(&$this, 'cspm_manage_posts_columns')); // @since 2.6.3
						add_action('manage_pages_custom_column', array(&$this, 'cspm_manage_posts_custom_column'), 10, 2); // @since 2.6.3	
					}else{
						add_filter('manage_'.$post_type.'_posts_columns', array(&$this, 'cspm_manage_posts_columns')); // @since 2.6.3
						add_action('manage_'.$post_type.'_posts_custom_column', array(&$this, 'cspm_manage_posts_custom_column'), 10, 2); // @since 2.6.3
					}
				}
			}
			
			if(is_admin()){
				
				/**
				 * Add plugin menu */
				 
				add_action('admin_menu', array(&$this, 'cspm_admin_menu'));
			
				/**
				 * Add custom links to plugin instalation area */
				 
				add_filter('plugin_row_meta', array(&$this, 'cspm_plugin_meta_links'), 10, 2);
				add_filter('plugin_action_links_' . plugin_basename( __FILE__ ), array(&$this, 'cspm_add_plugin_action_links'));
			
				/**
				 * Add "Location" meta box to "Add" custom post type area */
				 
				add_action('admin_init', array(&$this, 'cspm_meta_box'));
				add_action('save_post', array(&$this, 'cspm_insert_meta_box_fields'), 10, 2);
				
				/**
				 * Get out if the loaded page is not our plguin settings page */
				 
				if (isset($_GET['page']) && $_GET['page'] == $this->plugin_get_var ){
		
					/**
					 * Call custom functions */
					 
					add_action('wpsf_before_settings', array(&$this, 'cspm_before_settings'));
					add_action('wpsf_after_settings', array(&$this, 'cspm_after_settings'));
			
					/**
					 * Add an optional settings validation filter (recommended) */
					 
					add_filter( $this->cspm_wpsf->cspm_get_option_group() .'_settings_validate', array(&$this, 'cspm_validate_settings') );		
			
				}
				
				/**
				 * Executed when activating the plugin in order to run any sync code needed for the latest version of the plugin 
				 * @since 2.4 */
				 
				register_activation_hook( __FILE__, array(&$this, 'cspm_sync_settings_for_latest_version' ));
				
				/**
				 * Alter the list of acceptable file extensions WordPress checks during media uploads
				 * @since 2.7 */
				 
				add_filter('upload_mimes', array(&$this, 'cspm_custom_upload_mimes'));
				
				/**
				 * Display a message in the admin to promote for Progress Map extensions
				 *
				 * @since 2.8
				 */
				 
				add_action( 'admin_notices', array(&$this, 'cspm_promote_extensions') );	
			
			}else{
				
				/**
				 * Query settings */
				 
				$this->number_of_items = $this->cspm_get_setting('generalsettings', 'number_of_items');		
				$this->custom_fields = $this->cspm_get_setting('generalsettings', 'custom_fields');
				$this->custom_field_relation_param = $this->cspm_get_setting('generalsettings', 'custom_field_relation_param');
				$this->post_in = $this->cspm_get_setting('generalsettings', 'post_in');
				$this->post_not_in = $this->cspm_get_setting('generalsettings', 'post_not_in');
				$this->cache_results = $this->cspm_get_setting('generalsettings', 'cache_results');
				$this->update_post_meta_cache = $this->cspm_get_setting('generalsettings', 'update_post_meta_cache');
				$this->update_post_term_cache = $this->cspm_get_setting('generalsettings', 'update_post_term_cache');
				$this->orderby_param = $this->cspm_get_setting('generalsettings', 'orderby_param');
				$this->orderby_meta_key = $this->cspm_get_setting('generalsettings', 'orderby_meta_key');
				$this->order_param = $this->cspm_get_setting('generalsettings', 'order_param');
				
				/**
				 * @since 2.8.2
				 * Set post stauses in the constructor instead of the function "cspm_main_query" */
				 
				$statuses = get_post_stati();
				$active_statuses = array();
				foreach($statuses as $status){
					if(isset($this->settings['codespacingprogressmap_generalsettings_items_status_'.$status.''])){						
						$status_name = $this->settings['codespacingprogressmap_generalsettings_items_status_'.$status.''];
						if($status_name != '0') $active_statuses[] = $status;
					}
				}
				$this->post_status = (count($active_statuses) == 0) ? 'publish' : $active_statuses;
					
				/**
				 * Layout settings */
				 
				$this->main_layout = $this->cspm_get_setting('layoutsettings', 'main_layout', 'mu-cd');	
				$this->layout_type = $this->cspm_get_setting('layoutsettings', 'layout_type', 'full_width');
				$this->layout_fixed_width = $this->cspm_get_setting('layoutsettings', 'layout_fixed_width', '700');
				$this->layout_fixed_height = $this->cspm_get_setting('layoutsettings', 'layout_fixed_height', '600');
					
				/**
				 * Map settings */
				 
				$this->map_language = str_replace(' ', '', $this->cspm_get_setting('mapsettings', 'map_language', 'en'));
				$this->center = $this->cspm_get_setting('mapsettings', 'map_center', '51.53096,-0.121064');			
					$this->wrong_center_point = (strpos($this->center, ',') !== false) ? false : true;
									
				$this->initial_map_style = $this->cspm_get_setting('mapsettings', 'initial_map_style', 'ROADMAP');
				$this->zoom = $this->cspm_get_setting('mapsettings', 'map_zoom', '12');
				$this->useClustring = $this->cspm_get_setting('mapsettings', 'useClustring', 'true');
				$this->gridSize = $this->cspm_get_setting('mapsettings', 'gridSize', '60');
				$this->mapTypeControl = $this->cspm_get_setting('mapsettings', 'mapTypeControl', 'true');
				$this->streetViewControl = $this->cspm_get_setting('mapsettings', 'streetViewControl', 'false');
				$this->scrollwheel = $this->cspm_get_setting('mapsettings', 'scrollwheel', 'false');
				$this->panControl = $this->cspm_get_setting('mapsettings', 'panControl', 'false');					
				$this->zoomControl = $this->cspm_get_setting('mapsettings', 'zoomControl', 'true');
				$this->zoomControlType = $this->cspm_get_setting('mapsettings', 'zoomControlType', 'customize');
				$this->marker_icon = $this->cspm_get_setting('mapsettings', 'marker_icon', $this->plugin_url.'img/pin-blue.png');			
				$this->big_cluster_icon = $this->cspm_get_setting('mapsettings', 'big_cluster_icon', $this->plugin_url.'img/big-cluster.png');
				$this->medium_cluster_icon = $this->cspm_get_setting('mapsettings', 'medium_cluster_icon', $this->plugin_url.'img/medium-cluster.png');
				$this->small_cluster_icon = $this->cspm_get_setting('mapsettings', 'small_cluster_icon', $this->plugin_url.'img/small-cluster.png'); 
				$this->cluster_text_color = $this->cspm_get_setting('mapsettings', 'cluster_text_color', '#ffffff');			
				$this->zoom_in_icon = $this->cspm_get_setting('mapsettings', 'zoom_in_icon', $this->plugin_url.'img/addition-sign.png');	
				$this->zoom_in_css = $this->cspm_get_setting('mapsettings', 'zoom_in_css');	
				$this->zoom_out_icon = $this->cspm_get_setting('mapsettings', 'zoom_out_icon', $this->plugin_url.'img/minus-sign.png');	
				$this->zoom_out_css = $this->cspm_get_setting('mapsettings', 'zoom_out_css');
				$this->defaultMarker = $this->cspm_get_setting('mapsettings', 'defaultMarker');
				$this->retinaSupport = $this->cspm_get_setting('mapsettings', 'retinaSupport', 'false');
				$this->geoIpControl = $this->cspm_get_setting('mapsettings', 'geoIpControl', 'false');			
				$this->markerAnimation = $this->cspm_get_setting('mapsettings', 'markerAnimation', 'pulsating_circle'); // @since 2.5
				$this->marker_anchor_point_option = $this->cspm_get_setting('mapsettings', 'marker_anchor_point_option', 'disable'); // @since 2.6.1
				$this->marker_anchor_point = $this->cspm_get_setting('mapsettings', 'marker_anchor_point', ''); // @since 2.6.1				
				$this->map_draggable = $this->cspm_get_setting('mapsettings', 'map_draggable', 'true'); // @since 2.6.3				
				$this->max_zoom = $this->cspm_get_setting('mapsettings', 'max_zoom', 19); // @since 2.6.3
				$this->min_zoom = $this->cspm_get_setting('mapsettings', 'min_zoom', 0); // @since 2.6.3
				$this->zoom_on_doubleclick = $this->cspm_get_setting('mapsettings', 'zoom_on_doubleclick', 'false'); // @since 2.6.3												
				$this->autofit = $this->cspm_get_setting('mapsettings', 'autofit', 'false'); // @since 2.7												
				$this->traffic_layer = $this->cspm_get_setting('mapsettings', 'traffic_layer', 'false'); // @since 2.7
				$this->transit_layer = $this->cspm_get_setting('mapsettings', 'transit_layer', 'false'); // @since 2.7.4
				$this->show_user = $this->cspm_get_setting('mapsettings', 'show_user', 'false'); // @since 2.7.4
				$this->user_marker_icon = $this->cspm_get_setting('mapsettings', 'user_marker_icon', ''); // @since 2.7.4
				$this->user_map_zoom = $this->cspm_get_setting('mapsettings', 'user_map_zoom', '12'); // @since 2.7.4
				$this->user_circle = $this->cspm_get_setting('mapsettings', 'user_circle', '0'); // @since 2.7.4
				
				/**
				 * KML Layers 
				 * @since 2.7 */
				 
				$this->use_kml = $this->cspm_get_setting('kmlsettings', 'use_kml', 'false');
				$this->kml_file = $this->cspm_get_setting('kmlsettings', 'kml_file', '');
				$this->suppressInfoWindows = $this->cspm_get_setting('kmlsettings', 'suppressInfoWindows', 'false');
				$this->preserveViewport = $this->cspm_get_setting('kmlsettings', 'preserveViewport', 'false');
				
				/**
				 * Overlays: Polyline
				 * @since 2.7 */
				
				$this->draw_polyline = $this->cspm_get_setting('overlayssettings', 'draw_polyline', 'false');
				$this->polylines = (array) json_decode($this->cspm_get_setting('overlayssettings', 'polylines', ''));				
				
				/**
				 * Overlays: Polygon
				 * @since 2.7 */
				
				$this->draw_polygon = $this->cspm_get_setting('overlayssettings', 'draw_polygon', 'false');
				$this->polygons = (array) json_decode($this->cspm_get_setting('overlayssettings', 'polygons', ''));				
				
				/**
				 * Infobox settings
				 * @since 2.5 */
				
				$this->show_infobox = $this->cspm_get_setting('infoboxsettings', 'show_infobox', 'true');
				$this->infobox_type = $this->cspm_get_setting('infoboxsettings', 'infobox_type', 'rounded_bubble');
				$this->infobox_display_event = $this->cspm_get_setting('infoboxsettings', 'infobox_display_event', 'onload');
				$this->infobox_external_link = $this->cspm_get_setting('infoboxsettings', 'infobox_external_link', 'same_window');
				$this->remove_infobox_on_mouseout = $this->cspm_get_setting('infoboxsettings', 'remove_infobox_on_mouseout', 'false'); //@since 2.7.4
				
				/**
				 * Carousel settings */
				 
				$this->show_carousel = $this->cspm_get_setting('carouselsettings', 'show_carousel', 'true');
				$this->carousel_scroll = $this->cspm_get_setting('carouselsettings', 'carousel_scroll', '1');
				$this->carousel_animation = $this->cspm_get_setting('carouselsettings', 'carousel_animation', 'fast');
				$this->carousel_easing = $this->cspm_get_setting('carouselsettings', 'carousel_easing', 'linear');
				$this->carousel_auto = $this->cspm_get_setting('carouselsettings', 'carousel_auto', '0');


				$this->carousel_wrap = $this->cspm_get_setting('carouselsettings', 'carousel_wrap', 'circular');	
				$this->scrollwheel_carousel = $this->cspm_get_setting('carouselsettings', 'scrollwheel_carousel', 'false');	
				$this->touchswipe_carousel = $this->cspm_get_setting('carouselsettings', 'touchswipe_carousel', 'false');
				$this->carousel_map_zoom = $this->cspm_get_setting('carouselsettings', 'carousel_map_zoom', '12');
					
				$move_carousel_on_marker_click = isset($this->settings['codespacingprogressmap_carouselsettings_move_carousel_on_marker_click'])
													? $this->settings['codespacingprogressmap_carouselsettings_move_carousel_on_marker_click'] : ''; //@since 2.6.1
				$move_carousel_on_marker_hover = isset($this->settings['codespacingprogressmap_carouselsettings_move_carousel_on_marker_hover'])
													? $this->settings['codespacingprogressmap_carouselsettings_move_carousel_on_marker_hover'] : ''; //@since 2.6.1
				$move_carousel_on_infobox_hover = isset($this->settings['codespacingprogressmap_carouselsettings_move_carousel_on_infobox_hover'])
													? $this->settings['codespacingprogressmap_carouselsettings_move_carousel_on_infobox_hover'] : ''; //@since 2.6.1
						
				$this->move_carousel_on = array(
					$move_carousel_on_marker_click,
					$move_carousel_on_marker_hover,
					$move_carousel_on_infobox_hover
				); //@since 2.6.1
				
				/**
				 * Carousel style */
				 
				$this->carousel_css = $this->cspm_get_setting('carouselstyle', 'carousel_css');	
				$this->arrows_background = $this->cspm_get_setting('carouselstyle', 'arrows_background', '#fff');	
				$this->horizontal_left_arrow_icon = $this->cspm_get_setting('carouselstyle', 'horizontal_left_arrow_icon');	
				$this->horizontal_right_arrow_icon = $this->cspm_get_setting('carouselstyle', 'horizontal_right_arrow_icon');	
				$this->vertical_top_arrow_icon = $this->cspm_get_setting('carouselstyle', 'vertical_top_arrow_icon');	
				$this->vertical_bottom_arrow_icon = $this->cspm_get_setting('carouselstyle', 'vertical_bottom_arrow_icon');	
				$this->items_background = $this->cspm_get_setting('carouselstyle', 'items_background', '#fff');	
				$this->items_hover_background = $this->cspm_get_setting('carouselstyle', 'items_hover_background', '#fbfbfb');	
					
				/**
				 * Items Settings */
				 
				$this->items_view = $this->cspm_get_setting('itemssettings', 'items_view', 'listview');
				$this->horizontal_item_css = $this->cspm_get_setting('itemssettings', 'horizontal_item_css');
				$this->horizontal_title_css = $this->cspm_get_setting('itemssettings', 'horizontal_title_css');
				$this->horizontal_details_css = $this->cspm_get_setting('itemssettings', 'horizontal_details_css');
				$this->vertical_item_css = $this->cspm_get_setting('itemssettings', 'vertical_item_css');
				$this->vertical_title_css = $this->cspm_get_setting('itemssettings', 'vertical_title_css');
				$this->vertical_details_css = $this->cspm_get_setting('itemssettings', 'vertical_details_css');
					
				$this->horizontal_details_size = $this->cspm_get_setting('itemssettings', 'horizontal_details_size', '250,150');
					
					if($explode_horizontal_details_size = explode(',', $this->horizontal_details_size)){
						$this->horizontal_details_width = $this->cspm_setting_exists(0, $explode_horizontal_details_size, '250');
						$this->horizontal_details_height = $this->cspm_setting_exists(1, $explode_horizontal_details_size, '150');
					}else{
						$this->horizontal_details_width = '250';
						$this->horizontal_details_height = '150';
					}
				
				$this->vertical_details_size = $this->cspm_get_setting('itemssettings', 'vertical_details_size', '204,170');
					
					if($explode_vertical_details_size = explode(',', $this->vertical_details_size)){
						$this->vertical_details_width = $this->cspm_setting_exists(0, $explode_vertical_details_size, '204');
						$this->vertical_details_height = $this->cspm_setting_exists(1, $explode_vertical_details_size, '170');
					}else{
						$this->vertical_details_width = '204';
						$this->vertical_details_height = '170';
					}
	
				/**
				 * Posts count settings */
				 
				$this->show_posts_count = $this->cspm_get_setting('postscountsettings', 'show_posts_count', 'no');
				$this->posts_count_clause = $this->cspm_get_setting('postscountsettings', 'posts_count_clause', '[posts_count] Posts');
				$this->posts_count_color = $this->cspm_get_setting('postscountsettings', 'posts_count_color', '#000000');
				$this->posts_count_style = $this->cspm_get_setting('postscountsettings', 'posts_count_style');
	
				/**
				 * Marker categories settings */
				 
				$this->marker_cats_settings = $this->cspm_get_setting('markercategoriessettings', 'marker_cats_settings', 'false');
				$this->marker_taxonomies = $this->cspm_get_setting('markercategoriessettings', 'marker_taxonomies');
		
				/**
				 * Faceted search settings */
				 
				$this->faceted_search_option = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_option', 'false');
				$this->faceted_search_multi_taxonomy_option = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_multi_taxonomy_option', 'true');
				$this->faceted_search_input_skin = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_input_skin', 'polaris');
				$this->faceted_search_input_color = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_input_color', 'blue');
				$this->faceted_search_icon = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_icon', $this->plugin_url.'img/filter.png');
				$this->faceted_search_css = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_css');
				$this->faceted_search_drag_map = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_drag_map', 'no'); //@since 2.8.2
				
				/**
				 * Search form settings */
				 
				$this->search_form_option = $this->cspm_get_setting('searchformsettings', 'search_form_option', 'false');
				$this->sf_search_distances = $this->cspm_get_setting('searchformsettings', 'sf_search_distances', '3,5,10,30,50');
				$this->sf_distance_unit = $this->cspm_get_setting('searchformsettings', 'sf_distance_unit', 'metric');
				$this->address_placeholder = $this->cspm_get_setting('searchformsettings', 'address_placeholder', esc_html__('Enter City & Province, or Postal code', 'cspm'));
				$this->slider_label = $this->cspm_get_setting('searchformsettings', 'slider_label', esc_html__('Expand the search area up to', 'cspm'));
				$this->no_location_msg = $this->cspm_get_setting('searchformsettings', 'no_location_msg', esc_html__('We could not find any location', 'cspm'));
				$this->bad_address_msg = $this->cspm_get_setting('searchformsettings', 'bad_address_msg', esc_html__('We could not understand the location', 'cspm'));
				$this->bad_address_sug_1 = $this->cspm_get_setting('searchformsettings', 'bad_address_sug_1', esc_html__('- Make sure all street and city names are spelled correctly.', 'cspm'));
				$this->bad_address_sug_2 = $this->cspm_get_setting('searchformsettings', 'bad_address_sug_2', esc_html__('- Make sure your address includes a city and state.', 'cspm'));
				$this->bad_address_sug_3 = $this->cspm_get_setting('searchformsettings', 'bad_address_sug_3', esc_html__('- Try entering a zip code.', 'cspm'));
				$this->submit_text = $this->cspm_get_setting('searchformsettings', 'submit_text', esc_html__('Find it', 'cspm'));
				$this->search_form_icon = $this->cspm_get_setting('searchformsettings', 'search_form_icon', $this->plugin_url.'img/loup.png');
				$this->search_form_bg_color = $this->cspm_get_setting('searchformsettings', 'search_form_bg_color', 'rgba(255,255,255,1)');
				$this->circle_option = $this->cspm_get_setting('searchformsettings', 'circle_option', 'true');
				$this->fillColor = $this->cspm_get_setting('searchformsettings', 'fillColor', '#189AC9');
				$this->fillOpacity = $this->cspm_get_setting('searchformsettings', 'fillOpacity', '0.1');
				$this->strokeColor = $this->cspm_get_setting('searchformsettings', 'strokeColor', '#189AC9');				
				$this->strokeOpacity = $this->cspm_get_setting('searchformsettings', 'strokeOpacity', '1');
				$this->strokeWeight = $this->cspm_get_setting('searchformsettings', 'strokeWeight', '1');						
				
				/**
				 * map styles section */
				 
				$this->style_option = $this->cspm_get_setting('mapstylesettings', 'style_option', 'progress-map');

				$this->map_style = $this->cspm_get_setting('mapstylesettings', 'map_style', 'google-map');
				$this->js_style_array = $this->cspm_get_setting('mapstylesettings', 'js_style_array', '');
				$this->custom_style_name = $this->cspm_get_setting('mapstylesettings', 'custom_style_name', 'Custom style'); //@since 2.6.1
				
				/**
 				 * Troubleshooting & Configs
				 * @since 2.5
				 */
				 
				$this->use_ssl = $this->cspm_get_setting('troubleshooting', 'use_ssl', 'http'); /* Deprecated since 2.8 */
				$this->combine_files = $this->cspm_get_setting('troubleshooting', 'combine_files', 'combine');
				$this->loading_scripts = $this->cspm_get_setting('troubleshooting', 'loading_scripts', 'entire_site');
				$this->load_on_page_ids = $this->cspm_get_setting('troubleshooting', 'load_on_page_ids', '');
				$this->load_on_post_ids = $this->cspm_get_setting('troubleshooting', 'load_on_post_ids', '');	
				$this->load_on_page_templates = $this->cspm_get_setting('troubleshooting', 'load_on_page_templates', ''); //@since 2.6.1		
				$this->include_or_remove_option = $this->cspm_get_setting('troubleshooting', 'include_or_remove_option', 'include'); //@since 2.6.1	
				$this->extra_css = $this->cspm_get_setting('troubleshooting', 'extra_css', ''); //@since 2.6.1
				$this->map_in_tab = $this->cspm_get_setting('troubleshooting', 'map_in_tab', 'no'); //@since 2.6.1
				$this->remove_bootstrap = $this->cspm_get_setting('troubleshooting', 'remove_bootstrap', 'enable'); //@since 2.8.2
				$this->remove_gmaps_api = $this->cspm_get_setting('troubleshooting', 'remove_gmaps_api', 'enable'); //@since 2.8.2	
				$this->remove_google_fonts = $this->cspm_get_setting('troubleshooting', 'remove_google_fonts', 'enable'); //@since 2.8.2	
				
				/**
				 * Call .js and .css files */
				 
				add_action('wp_enqueue_scripts', array(&$this, 'cspm_styles'));
				add_action('wp_enqueue_scripts', array(&$this, 'cspm_scripts'));
				
				/**
				 * Add the plugin shortcodes */
				 
				add_shortcode('codespacing_progress_map', array(&$this, 'cspm_main_map_shortcode'));
				/* A replacement */ add_shortcode('cspm_main_map', array(&$this, 'cspm_main_map_shortcode')); // @since 2.7
				
				add_shortcode('codespacing_light_map', array(&$this, 'cspm_light_map_shortcode'));
				/* A replacement */ add_shortcode('cspm_light_map', array(&$this, 'cspm_light_map_shortcode')); // @since 2.7
				
				add_shortcode('codespacing_static_map', array(&$this, 'cspm_static_map_shortcode'));
				/* A replacement */ add_shortcode('cspm_static_map', array(&$this, 'cspm_static_map_shortcode')); // @since 2.7
				
				add_shortcode('progress_map_add_location_form', array(&$this, 'cspm_frontend_form')); //@since 2.6.3
				/* A replacement */ add_shortcode('cspm_form', array(&$this, 'cspm_frontend_form')); //@since 2.7
				
				add_shortcode('cspm_streetview_map', array(&$this, 'cspm_streetview_map_shortcode')); // @since 2.7
				
				add_shortcode('cs_static_marker_map', array(&$this, 'cspm_static_marker_map_shortcode')); //@since 2.8
			 
			}

		}
	
		static function this(){
			
			return self::$_this;
			
		}
		
		/*
		 * Função para buscar os dados do post selecionado	
		 *
		 */
		function loadContentClass(){
			
			global $wpdb;
			
			$output ='';
			
			$id = $_REQUEST['id'];
			
			$args = array(
				'p' => $id
				 
			);
			
			query_posts( $args );
			
			
			while (have_posts()):the_post();
				the_title();
				the_content();
			endwhile;
			
			die($output);
		
		}
		
		function loadContentFirstElement(){
			global $wpdb;
			
			$output ='';
		
			$args = array(
				'category' => 'agencias',
				'posts_per_page' => 1,
				'orderby' => 'title',
				'order' => 'ASC' 
				 
			);
			
			query_posts( $args );
			
			
			while (have_posts()):the_post();
				the_title();
				the_content();
			endwhile;
			
			die($output);
			
		}
		
		
		/**
		 * Load plugin text domain
		 *
		 * @since 2.8
		 */
		function cspm_load_plugin_textdomain(){
			
			/**
			 * To translate the plugin, create a new folder in "wp-content/languages" ...
			 * ... and name it "cs-progress-map". Inside "cs-progress-map", paste your .mo & . po files.
			 * The plugin will detect the language of your website and display the appropriate language. */
			 
			$domain = 'cspm';
			
			$locale = apply_filters('plugin_locale', get_locale(), $domain);
		
			load_textdomain($domain, WP_LANG_DIR.'/cs-progress-map/'.$domain.'-'.$locale.'.mo');
	
			load_plugin_textdomain($domain, FALSE, $this->plugin_path.'/languages/');
			
		}
		
		
		/**
		 * Add the plugin in the administration menu 
		 */
		function cspm_admin_menu(){	
		
			add_menu_page( __( 'Progress map', 'cspm' ), __( 'Progress map', 'cspm' ), 'manage_options', $this->plugin_get_var, array(&$this, 'cspm_settings_page'), $this->plugin_url.'/settings/img/menu-icon.png', '99.2' );
			
		}	
			
		
		/**
		 * This will display the plugin settings form 
		 */
		function cspm_settings_page(){
								
			/**
			 * Display the plugin settings form */
			 
			echo '<div class="wrap">';
				$this->cspm_wpsf->cspm_settings(); 
			echo '</div>';					
				
			/**
			 * Save string for WPML
			 * @since 2.5 */
			 
			$this->cspm_wpml_register_string('"More" Button text', $this->details_btn_text, $this->use_with_wpml);					
			$this->cspm_wpml_register_string('Posts count clause', $this->posts_count_clause, $this->use_with_wpml);					
			$this->cspm_wpml_register_string('Address field placeholder', $this->address_placeholder, $this->use_with_wpml);
			$this->cspm_wpml_register_string('Expand the search area up to', $this->slider_label, $this->use_with_wpml);
			$this->cspm_wpml_register_string('We could not find any location', $this->no_location_msg, $this->use_with_wpml);
			$this->cspm_wpml_register_string('We could not understand the location', $this->bad_address_msg, $this->use_with_wpml);
			$this->cspm_wpml_register_string('- Make sure all street and city names are spelled correctly.', $this->bad_address_sug_1, $this->use_with_wpml);
			$this->cspm_wpml_register_string('- Make sure your address includes a city and state.', $this->bad_address_sug_2, $this->use_with_wpml);
			$this->cspm_wpml_register_string('- Try entering a zip code.', $this->bad_address_sug_3, $this->use_with_wpml);
			$this->cspm_wpml_register_string('Search', $this->submit_text, $this->use_with_wpml);
					
		}
		
		
		/**
		 * Add settings link to plugin instalation area 
		 */
		function cspm_add_plugin_action_links($links){
		 
			return array_merge(
				array(
					'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=cs_progress_map_plugin">Settings</a>'
				),
				$links
			);
		 
		}	
		
	
		/**
		 * Add plugin site link to plugin instalation area 
		 */
		function cspm_plugin_meta_links($links, $file){
		 
			$plugin = plugin_basename(__FILE__);
		 
			/**
			 * create the link */
			 
			if ( $file == $plugin ) {
				return array_merge(
					$links,
					array(
						'get_start' => '<a target="_blank" href="http://www.codespacing.com/progress-map-get-strat/">'.esc_html__('Getting started', 'cspm').'</a>',
						'documentation' => '<a target="_blank" href="http://www.codespacing.com/progress-map-shortcodes/">'.esc_html__('Documentation', 'cspm').'</a>'
					)
				);
			}
			
			return $links;
		 
		}
		
		
		/**
		 * Get the value of a setting
		 *
		 * @since 2.4 
		 */
		function cspm_get_setting($section_id, $setting_id, $default_value = ''){
			
			return $this->cspm_setting_exists('codespacingprogressmap_'.$section_id.'_'.$setting_id.'', $this->settings, $default_value);
			
		}
		
		
		/**
		 * Check if array_key_exists and if empty() doesn't return false
		 * Replace the empty value with the default value if available 
		 * @empty() return false when the value is (null, 0, "0", "", 0.0, false, array())
		 *
		 * @since 2.4 
		 */
		function cspm_setting_exists($key, $array, $default = ''){
			
			$array_value = isset($array[$key]) ? $array[$key] : $default;
			
			$setting_value = empty($array_value) ? $default : $array_value;
			
			return $setting_value;
			
		}
		
		
		function cspm_validate_settings($input){	    
		
			// Do your settings validation here
			// Same as $sanitize_callback from http://codex.wordpress.org/Function_Reference/register_setting
			return $input;
			
		}	
		
		
		/**
		 * Register & Enqueue CSS files 
		 *
		 * @updated 2.8
		 * @updated 2.8.2
		 */
		function cspm_styles(){
			
			do_action('cspm_before_enqueue_style');
							
			$min_path = ($this->combine_files == 'seperate_minify' || $this->combine_files == "combine") ? 'min/' : '';
			$min_prefix = ($this->combine_files == 'seperate_minify' || $this->combine_files == "combine") ? '.min' : '';
			
			/**
			 * Font Style */
			
			if($this->remove_google_fonts == 'enable'){  	
				wp_register_style('cspm_font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic&subset=latin,vietnamese,latin-ext');				
				wp_enqueue_style('cspm_font');
			}

			/**
			 * icheck
			 * Note: Loaded only when using the faceted seach feature */
							
			if($this->faceted_search_option == 'true'){
				
				$icheck_skin = $this->faceted_search_input_skin;
				
				if($this->faceted_search_input_skin != 'polaris' && $this->faceted_search_input_skin != 'futurico')
					$icheck_color = ($this->faceted_search_input_color != 'black') ? $this->faceted_search_input_color : $this->faceted_search_input_skin;
				else $icheck_color = $this->faceted_search_input_skin;
				
				wp_register_style('cspm_icheck_css', $this->plugin_url .'css/icheck/'.$icheck_skin.'/'.$icheck_color.$min_prefix.'.css', array(), $this->plugin_version);
				wp_enqueue_style('cspm_icheck_css');
				
			}
			
			if($this->combine_files == "combine"){
					
				wp_register_style('cspm_combined_styles', $this->plugin_url .'css/min/cspm_combined_styles.min.css', array(), $this->plugin_version);
				wp_enqueue_style('cspm_combined_styles');
				
			}else{
				
				/**
				 * Bootstrap */
				
				if($this->remove_bootstrap == 'enable'){ 	
					wp_register_style('cspm_bootstrap_css', $this->plugin_url .'css/'.$min_path.'bootstrap'.$min_prefix.'.css', array(), $this->plugin_version);
					wp_enqueue_style('cspm_bootstrap_css');
				}
				
				/**
				 * jCarousel
				 * Note: Loaded only when using the carousel feature */
				 
				if($this->show_carousel == 'true'){
					wp_register_style('cspm_carousel_css', $this->plugin_url .'css/'.$min_path.'jcarousel'.$min_prefix.'.css', array(), $this->plugin_version);
					wp_enqueue_style('cspm_carousel_css');
				}
				
				/**
				 * Infobox & Carousel loaders */
				 
				wp_register_style('cspm_loading_css', $this->plugin_url .'css/'.$min_path.'loading'.$min_prefix.'.css', array(), $this->plugin_version);
				wp_enqueue_style('cspm_loading_css');				
				
				/**
				 * Custom Scroll bar
				 * Note: Loaded only when using the clustring feature and/or the faceted seach feature */
				 
				if($this->useClustring == 'true' || $this->faceted_search_option == 'true'){
					wp_register_style('cspm_mCustomScrollbar_css', $this->plugin_url .'css/'.$min_path.'jquery.mCustomScrollbar'.$min_prefix.'.css', array(), $this->plugin_version);
					wp_enqueue_style('cspm_mCustomScrollbar_css');
				}

				/**
				 * Range Slider
				 * Note: Loaded only when using the seach form feature */
				 				
				if($this->search_form_option == 'true'){
					
					wp_register_style('cspm_rangeSlider_css', $this->plugin_url .'css/'.$min_path.'ion.rangeSlider'.$min_prefix.'.css', array(), $this->plugin_version);
					wp_enqueue_style('cspm_rangeSlider_css');
				
					wp_register_style('cspm_rangeSlider_skin_css', $this->plugin_url .'css/'.$min_path.'ion.rangeSlider.skinFlat'.$min_prefix.'.css', array(), $this->plugin_version);
					wp_enqueue_style('cspm_rangeSlider_skin_css');
					
				}
				
				/** 
				 * Progress Map styles */
				
				wp_register_style('cspm_nprogress_css', $this->plugin_url .'css/'.$min_path.'nprogress'.$min_prefix.'.css', array(), $this->plugin_version);
				wp_enqueue_style('cspm_nprogress_css');
				
				wp_register_style('cspm_animate_css', $this->plugin_url .'css/'.$min_path.'animate'.$min_prefix.'.css', array(), $this->plugin_version);
				wp_enqueue_style('cspm_animate_css');
				 	
				wp_register_style('cspm_map_css', $this->plugin_url .'css/'.$min_path.'style'.$min_prefix.'.css', array(), $this->plugin_version);
				wp_enqueue_style('cspm_map_css');
								
			}
			
			do_action('cspm_after_enqueue_style');
		
			/**
			 * Add custom header script */
			 
			add_filter('wp_head', array(&$this, 'cspm_header_script'));
			
		}	
		
		
		/**
		 * Deregister styles
		 *
		 * @since 2.5
		 * @updated 2.8
		 */
		function cspm_deregister_styles(){		
		
			if($this->combine_files == "combine"){
	
				wp_dequeue_style('cspm_font');
				wp_dequeue_style('cspm_icheck_css');
				wp_dequeue_style('cspm_combined_styles');
				
			}else{
					
				wp_dequeue_style('cspm_bootstrap_css');
				wp_dequeue_style('cspm_carousel_css');
				wp_dequeue_style('cspm_map_css');
				wp_dequeue_style('cspm_loading_css');
				wp_dequeue_style('cspm_mCustomScrollbar_css');
				wp_dequeue_style('cspm_icheck_css');
				wp_dequeue_style('cspm_nprogress_css');
				wp_dequeue_style('cspm_animate_css');
				wp_dequeue_style('cspm_rangeSlider_css');
				wp_dequeue_style('cspm_rangeSlider_skin_css');
				wp_dequeue_style('cspm_font');
			
			}
			
			remove_filter('wp_head', array(&$this, 'cspm_header_script'));

		}	
		
		
		/**
		 * Register & Enqueue JS files 
		 *
		 * @updated 2.8
		 * @updated 2.8.2
		 */
		function cspm_scripts(){		
			
			/**
			 * Add text before and/or after the search field value
			 * @since 2.8 */
			 
			$before_search_address = apply_filters('cspm_before_search_address', '');
			$after_search_address = apply_filters('cspm_after_search_address', '');
			
			/**
			 * Localize the script with new data */
			 
			$wp_localize_script_args = array(
				
				'ajax_url' => admin_url('admin-ajax.php'),//get_bloginfo('url') . '/wp-admin/admin-ajax.php',
				'plugin_url' => $this->plugin_url,
				
				/**
				 * Query settings */
				
				'number_of_items' => $this->number_of_items,
				
				/**
				 * Map settings */
				 
				'center' => $this->center,
				'zoom' => $this->zoom,
				'scrollwheel' => $this->scrollwheel,
				'panControl' => $this->panControl,
				'mapTypeControl' => $this->mapTypeControl,
				'streetViewControl' => $this->streetViewControl,
				'zoomControl' => $this->zoomControl,
				'zoomControlType' => $this->zoomControlType,
				'defaultMarker' => $this->defaultMarker,
				'marker_icon' => $this->marker_icon,
				'big_cluster_icon' => $this->big_cluster_icon,
				'big_cluster_size' => $this->cspm_get_image_size($this->cspm_get_image_path_from_url($this->big_cluster_icon), $this->retinaSupport),
				'medium_cluster_icon' => $this->medium_cluster_icon,
				'medium_cluster_size' => $this->cspm_get_image_size($this->cspm_get_image_path_from_url($this->medium_cluster_icon), $this->retinaSupport),
				'small_cluster_icon' => $this->small_cluster_icon,
				'small_cluster_size' => $this->cspm_get_image_size($this->cspm_get_image_path_from_url($this->small_cluster_icon), $this->retinaSupport),
				'cluster_text_color' => $this->cluster_text_color,
				'grid_size' => $this->gridSize,
				'retinaSupport' => $this->retinaSupport,
				'initial_map_style' => $this->initial_map_style,
				'markerAnimation' => $this->markerAnimation, // @since 2.5
				'marker_anchor_point_option' => $this->marker_anchor_point_option, //@since 2.6.1
				'marker_anchor_point' => $this->marker_anchor_point, //@since 2.6.1
				'map_draggable' => $this->map_draggable, //@since 2.6.3
				'min_zoom' => $this->min_zoom, //@since 2.6.3
				
				/**
				 * @max_zoom, since 2.6.3
				 * @updated 2.8 (Fix issue when min zoom is bigger than max zoom) */
				'max_zoom' => ($this->min_zoom > $this->max_zoom) ? 19 : $this->max_zoom,
				
				'zoom_on_doubleclick' => $this->zoom_on_doubleclick, //@since 2.6.3
				
				/**
				 * Carousel settings */
				 
				'items_view' => $this->items_view,
				'show_carousel' => $this->show_carousel,
				'carousel_scroll' => $this->carousel_scroll,
				'carousel_wrap' => $this->carousel_wrap,
				'carousel_auto' => $this->carousel_auto,
				'carousel_mode' => $this->carousel_mode,
				'carousel_animation' => $this->carousel_animation,
				'carousel_easing' => $this->carousel_easing,
				'carousel_map_zoom' => $this->carousel_map_zoom,
				'scrollwheel_carousel' => $this->scrollwheel_carousel,
				'touchswipe_carousel' => $this->touchswipe_carousel,
				
				/**
				 * Layout settings */
				
				'layout_fixed_height' => $this->layout_fixed_height,
				
				/**
				 * Carousel items settings */
				 
				'horizontal_item_css' => $this->horizontal_item_css,
				'horizontal_item_width' => $this->horizontal_item_width,
				'horizontal_item_height' => $this->horizontal_item_height,
				'vertical_item_css' => $this->vertical_item_css,
				'vertical_item_width' => $this->vertical_item_width,
				'vertical_item_height' => $this->vertical_item_height,			
				'items_background' => $this->items_background,
				'items_hover_background' => $this->items_hover_background,
				
				/**
				 * Faceted search settings */
				 
				'faceted_search_option' => $this->faceted_search_option,
				'faceted_search_multi_taxonomy_option' => $this->faceted_search_multi_taxonomy_option,
				'faceted_search_input_skin' => $this->faceted_search_input_skin,
				'faceted_search_input_color' => $this->faceted_search_input_color,
				'faceted_search_drag_map' => $this->faceted_search_drag_map, //@since 2.8.2
				
				/**
				 * Posts count settings */
				 
				'show_posts_count' => $this->show_posts_count,
				
				/**
				 * Search form settings */
				 
				'fillColor' => $this->fillColor,
				'fillOpacity' => $this->fillOpacity,
				'strokeColor' => $this->strokeColor,
				'strokeOpacity' => $this->strokeOpacity,
				'strokeWeight' => $this->strokeWeight,
				'search_form_option' => $this->search_form_option,
				'before_search_address' => $before_search_address, //@since 2.8, Add text before the search field value
				'after_search_address' => $after_search_address, //@since 2.8, Add text after the search field value
				
				/**
				 * Geotarget
				 * @since 2.8 */
				 
				'geo' => $this->geoIpControl,
				'show_user' => $this->show_user,
				'user_marker_icon' => $this->user_marker_icon,
				'user_map_zoom' => $this->user_map_zoom,
				'user_circle' => $this->user_circle,
				'geoErrorTitle' => esc_attr__('Give Maps permission to use your location!', 'cspm'),				
				'geoErrorMsg' => esc_attr__('If you can\'t center the map on your location, a couple of things might be going on. It\'s possible you denied Google Maps access to your location in the past, or your browser might have an error.', 'cspm'),				
				
				/**
				 * Cluster text
				 * @since 2.8 */
				 
				'cluster_text' => esc_attr__('Click to view all markers in this area', 'cspm'),
				
			);
			
			$wp_localize_script_args = $wp_localize_script_args + $this->cspm_marker_categories();
			
			wp_enqueue_script('jquery');				 			
			
			do_action('cspm_before_enqueue_script');
						
			/**
			 * GMaps API */
			
			if($this->remove_gmaps_api == 'enable'){ 
			
				$gmaps_api_key = (!empty($this->api_key)) ? '&key='.$this->api_key : '';
				 
				wp_register_script('cspm_google_maps_api', '//maps.google.com/maps/api/js?v=3.exp'.$gmaps_api_key.'&language='.$this->map_language.'&libraries=geometry,places', array( 'jquery' ), false, true);
				wp_enqueue_script('cspm_google_maps_api');

			}
			
			/* Inclusão do nosso script :D */
			
			wp_register_script('ajaxContentPost', $this->plugin_url.'js/ajaxContentPost.js' , array( 'jquery' ), $this->plugin_version, true);
			wp_enqueue_script('ajaxContentPost');
			
			if($this->combine_files == "combine"){
			
				wp_register_script('cspm_combined_scripts', $this->plugin_url .'js/min/cspm_combined_scripts.min.js', array( 'jquery' ), $this->plugin_version, true);
				wp_enqueue_script('cspm_combined_scripts');	
				
				$localize_script_handle = 'cspm_combined_scripts';
	
			}else{			
								
				$min_path = $this->combine_files == 'seperate_minify' ? 'min/' : '';
				$min_prefix = $this->combine_files == 'seperate_minify' ? '.min' : '';
				
				/**
				 * GMap3 jQuery Plugin */
				 
				wp_register_script('cspm_gmap3_js', $this->plugin_url .'js/'.$min_path.'gmap3'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);		
				wp_enqueue_script('cspm_gmap3_js');
				
				/**
				 * Live Query */
				 
				wp_register_script('cspm_livequery_js', $this->plugin_url .'js/'.$min_path.'jquery.livequery'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);
				wp_enqueue_script('cspm_livequery_js');
				
				/**
				 * Marker Clusterer
				 * Note: Loaded only when using the clustering feature */
				 
				if($this->useClustring == 'true'){
					wp_register_script('cspm_markerclusterer_js', $this->plugin_url .'js/'.$min_path.'MarkerClustererPlus'.$min_prefix.'.js', array(), $this->plugin_version, true);
					wp_enqueue_script('cspm_markerclusterer_js');
				}
				
				/**
				 * Touche Swipe
				 * Note: Loaded only when using the touchswipe feature */
				 
				if($this->touchswipe_carousel == 'true'){
					wp_register_script('cspm_touchSwipe_js', $this->plugin_url .'js/'.$min_path.'jquery.touchSwipe'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);		
					wp_enqueue_script('cspm_touchSwipe_js');
				}
				
				/**
				 * jCarousel & jQuery Easing
				 * Note: Loaded only when using the carousel feature */
				 
				if($this->show_carousel == 'true'){
					
					/**
					 * jCarousel */
					 
					wp_register_script('cspm_jcarousel_js', $this->plugin_url .'js/'.$min_path.'jquery.jcarousel'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);
					wp_enqueue_script('cspm_jcarousel_js');
					
					/**
					 * jQuery Easing */
					 
					wp_register_script('cspm_easing', $this->plugin_url .'js/'.$min_path.'jquery.easing.1.3'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);
					wp_enqueue_script('cspm_easing');
					
				}
				
				/**
				 * Custom Scroll bar & jQuery Mousewheel
				 * Note: Loaded only when using the clustring feature and/or the faceted seach feature */
				 
				if($this->useClustring == 'true' || $this->faceted_search_option == 'true'){
					
					/**
				     * Custom Scroll bar */
				 
					wp_register_script('cspm_mCustomScrollbar_js', $this->plugin_url .'js/'.$min_path.'jquery.mCustomScrollbar'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);		
					wp_enqueue_script('cspm_mCustomScrollbar_js');
					
					/**
				     * jQuery Mousewheel */
				 
					wp_register_script('cspm_jquery_mousewheel_js', $this->plugin_url .'js/'.$min_path.'jquery.mousewheel'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);		
					wp_enqueue_script('cspm_jquery_mousewheel_js');
					
				}

				/**
				 * icheck
				 * Note: Loaded only when using the faceted seach feature */
				 				
				if($this->faceted_search_option == 'true'){
					wp_register_script('cspm_icheck_js', $this->plugin_url .'js/'.$min_path.'jquery.icheck'.$min_prefix.'.js?v=0.9.1', array( 'jquery' ), $this->plugin_version, true);
					wp_enqueue_script('cspm_icheck_js');
				}
				
				/**
				 * Progress Bar loader */
				 
				wp_register_script('cspm_nprogress_js', $this->plugin_url .'js/'.$min_path.'nprogress'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);
				wp_enqueue_script('cspm_nprogress_js');

				/**
				 * Range Slider
				 * Note: Loaded only when using the seach form feature */
				 				
				if($this->search_form_option == 'true'){
					wp_register_script('cspm_rangeSlider_js', $this->plugin_url .'js/'.$min_path.'ion.rangeSlider'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);
					wp_enqueue_script('cspm_rangeSlider_js');
				}
				
				/**
				 * Progress Map Script */
				 
				//wp_register_script('cspm_progress_map_js', $this->plugin_url .'js/'.$min_path.'progress_map'.$min_prefix.'.js', array( 'jquery' ), $this->plugin_version, true);					
				wp_register_script('cspm_progress_map_js', $this->plugin_url .'js/progress_map.js', array( 'jquery' ), $this->plugin_version, true);					
				wp_enqueue_script('cspm_progress_map_js');
				 
				$localize_script_handle = 'cspm_progress_map_js';
	
			}
			
			/**
			 * Localize the script with new data */
			 
			wp_localize_script($localize_script_handle, 'progress_map_vars', $wp_localize_script_args);

			do_action('cspm_after_enqueue_script');
			
		}
		
		
		/**
		 * Deregister scripts
		 *
		 * @since 2.5
		 * @updated 2.8 
		 */
		function cspm_deregister_scripts(){				 
		
			if($this->combine_files == "combine"){
				
				wp_dequeue_script('cspm_google_maps_api');
				wp_dequeue_script('cspm_combined_scripts');	
	
			}else{
				
				wp_dequeue_script('cspm_jqueryui_js');
				wp_dequeue_script('cspm_jqueryui_effect_js');
				wp_dequeue_script('cspm_jqueryui_effect_drop_js');
				wp_dequeue_script('cspm_jqueryui_effect_slide_js');
				wp_dequeue_script('cspm_livequery_js');
				wp_dequeue_script('cspm_easing');
				wp_dequeue_script('cspm_google_maps_api');
				wp_dequeue_script('cspm_gmap3_js');
				wp_dequeue_script('cspm_markerclusterer_js');
				wp_dequeue_script('cspm_touchSwipe_js');	
				wp_dequeue_script('cspm_jcarousel_js');
				wp_dequeue_script('cspm_mCustomScrollbar_js');		
				wp_dequeue_script('cspm_icheck_js');
				wp_dequeue_script('cspm_nprogress_js');
				wp_dequeue_script('cspm_rangeSlider_js');
				wp_dequeue_script('cspm_progress_map_js');
				
			}
			
		}
		
		
		/**
		 * Print Custom CSS in the page header 
		 *
		 * @since 2.5
		 * @Upadated 2.8
		 */
		function cspm_header_script(){
			
			$header_script = '';
			
			/**
			 * Prevent $(document).ready from being fired twice */			 
			
			$header_script .= '<script type="text/javascript">var _CSPM_DONE = {}; var _CSPM_MAP_RESIZED = {}</script>';
			
			$header_script .= '<style type="text/css">';
				
				if($this->show_carousel == 'true'){
					
					/**
					 * Carousel Style */
					
					if(!empty($this->carousel_css))
						$header_script .= '.jcarousel-skin-default .jcarousel-container{'. $this->carousel_css.'}';
					
					/** 
					 * Carousel Items Style */
					 
					if($this->items_view == "listview"){
						
						$header_script .= '.details_container{width:'.$this->horizontal_details_width.'px;height:'.$this->horizontal_details_height.'px;}';
						$header_script .= '.item_img{width:'.$this->horizontal_img_width.'px; height:'.$this->horizontal_img_height.'px;float:left;}';
						
						$xy_position = ($this->carousel_mode == 'false') ? 'left' : 'right';
						
						$header_script .= '.details_btn{'.$xy_position.':'.($this->horizontal_details_width-80).'px;top:'.($this->horizontal_details_height-50).'px;}';
						$header_script .= '.details_title{width:'.$this->horizontal_details_width.'px;'.$this->horizontal_title_css.'}';
						$header_script .= '.details_infos{width:'.$this->horizontal_details_width.'px;'.$this->horizontal_details_css.'}';
						
					}else{
						
						$header_script .= '.details_container{width:'.$this->vertical_details_width.'px; height:'.$this->vertical_details_height.'px;}';
						$header_script .= '.item_img{width:'.$this->vertical_img_width.'px;height:'.$this->vertical_img_height.'px;}';
						
						$xy_position = ($this->carousel_mode == 'false') ? 'left' : 'right';
						
						$header_script .= '.details_btn{'.$xy_position.':'.($this->vertical_details_width-80).'px;top:'.($this->vertical_details_height-50).'px;}';
						$header_script .= '.details_title{width:'.$this->vertical_details_width.'px;'.$this->vertical_title_css.'}';
						$header_script .= '.details_infos{width:'.$this->vertical_details_width.'px;'.$this->vertical_details_css.'}';
						
					}
					
					/**
					 * Horizontal Right Arrow CSS Style */
					
					if(!empty($this->horizontal_right_arrow_icon)){
						
						$header_script .= '.jcarousel-skin-default .jcarousel-next-horizontal,.jcarousel-skin-default .jcarousel-next-horizontal:hover,.jcarousel-skin-default .jcarousel-next-horizontal:focus{background-image: url('.$this->horizontal_right_arrow_icon.') !important;}';
					
					}
					
					/**
					 * Horizontal Left Arrow CSS Style */
					
					if(!empty($this->horizontal_left_arrow_icon)){
					
						$header_script .= '.jcarousel-skin-default .jcarousel-prev-horizontal,.jcarousel-skin-default .jcarousel-prev-horizontal:hover,.jcarousel-skin-default .jcarousel-prev-horizontal:focus{background-image: url('.$this->horizontal_left_arrow_icon.') !important;}';
						
					}
					
					/**
					 * Vertical Top Arrow CSS Style */
					
					if(!empty($this->vertical_top_arrow_icon)){
								
						$header_script .= '.jcarousel-skin-default .jcarousel-prev-vertical,.jcarousel-skin-default .jcarousel-prev-vertical:hover,.jcarousel-skin-default .jcarousel-prev-vertical:focus,.jcarousel-skin-default .jcarousel-prev-vertical:active{background-image: url('.$this->vertical_top_arrow_icon.') !important;}';
					
					}
			
					/**
					 * Vertical Bottom Arrow CSS Style */
					
					if(!empty($this->vertical_bottom_arrow_icon)){ 
						
						$header_script .= '.jcarousel-skin-default .jcarousel-next-vertical,.jcarousel-skin-default .jcarousel-next-vertical:hover,.jcarousel-skin-default .jcarousel-next-vertical:focus,.jcarousel-skin-default .jcarousel-next-vertical:active{background-image: url('.$this->vertical_bottom_arrow_icon.') !important;}';
							
					}
											
					/**
					 * Custom Vertical Carousel CSS */
					
					//if(($this->main_layout == "mr-cl" || $this->main_layout == "ml-cr") && $this->show_carousel == 'true')
						$header_script .= '.jcarousel-skin-default .jcarousel-container-vertical{height:'.$this->layout_fixed_height.'px !important;}';
												
					/**
					 * Arrows background color */
					 
					$background_color = (empty($this->arrows_background) || ($this->arrows_background == '#')) ? 'transparent' : $this->arrows_background;
					$header_script .= '.jcarousel-skin-default .jcarousel-prev-horizontal,.jcarousel-skin-default .jcarousel-next-horizontal,.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-next-horizontal,.jcarousel-skin-default .jcarousel-next-horizontal:hover,.jcarousel-skin-default .jcarousel-next-horizontal:focus,.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-prev-horizontal,.jcarousel-skin-default .jcarousel-prev-horizontal:hover,.jcarousel-skin-default .jcarousel-prev-horizontal:focus,.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-next-vertical,.jcarousel-skin-default .jcarousel-next-vertical:hover,.jcarousel-skin-default .jcarousel-next-vertical:focus,.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-prev-vertical,.jcarousel-skin-default .jcarousel-prev-vertical:hover,.jcarousel-skin-default .jcarousel-prev-vertical:focus{background-color:'.$background_color.';}';
						
				}
				
				/**
				 * Zoom-In & Zoom-out CSS Style */

				if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){
							
					$header_script .= 'div[class^=codespacing_map_zoom_in], div[class^=codespacing_light_map_zoom_in]{'.$this->zoom_in_css.'}';
					$header_script .= 'div[class^=codespacing_map_zoom_out], div[class^=codespacing_light_map_zoom_out]{'.$this->zoom_out_css.'}';
					
				}
				
				/**
				 * Posts count clause */
				 
				if($this->show_posts_count == 'yes'){
					
					$header_script .= 'div.number_of_posts_widget{color:'.$this->posts_count_color.';'.$this->posts_count_style.'}';
						
				}
				
				/**
				 * Faceted search CSS
				 * @updated 2.8 */

				if($this->faceted_search_option == 'true' && !empty($this->faceted_search_css)){
					
					$header_script .= 'div[class^=faceted_search_container]{background:'.$this->faceted_search_css.'}';
						
				}
				
				/**
				 * Search form CSS */
							
				if($this->search_form_option == 'true'){ 
				
					if(!empty($this->search_form_bg_color))
						$header_script .= 'div[class^=search_form_container_]{background:'.$this->search_form_bg_color.';}';
				
				}
				
				$header_script .= $this->extra_css;
				
			$header_script .= '</style>';
			
			echo $header_script;
			
		}

		
		/**
		 * Alter the list of acceptable file extensions WordPress checks during media uploads 
		 *
		 * @since 2.7 
		 */
		function cspm_custom_upload_mimes($existing_mimes = array()){
			
			$existing_mimes['kml'] = 'application/vnd.google-earth.kml+xml';			
			$existing_mimes['kmz'] = 'application/vnd.google-earth.kmz'; 
			
			return $existing_mimes;
			
		}
		
		
		/**
		 * Add the Laitude & the Longitude custom columns to the post type list
		 *
		 * @since 2.6.3 
		 */
		function cspm_manage_posts_columns($columns){
			
			$columns['pm_coordinates'] = esc_html__('PM. Coordinates', 'cspm');
				
			return $columns;
			
		}
		
		
		/**
		 * fill our Latitude & Longitude columns with data
		 *
		 * @since 2.6.3 
		 */		 
		function cspm_manage_posts_custom_column( $column_name, $post_id ){
			
			switch( $column_name ) {

				case 'pm_coordinates':
					$latitude = get_post_meta( $post_id, CSPM_LATITUDE_FIELD, true );
					$longitude = get_post_meta( $post_id, CSPM_LONGITUDE_FIELD, true );
					if(!empty($latitude) && !empty($longitude))
						echo '<div id="pm-coordinates-'.$post_id.'">'.$latitude.', '.$longitude.'</div>';
					else echo 'None';
				break;
		
			}
			
		}
		
		
		/**
		 * Create the "Add Location" meta box 
		 */
		function cspm_meta_box(){ 
			
			add_meta_box(
				'cspm_meta_box_form',
				esc_html__('Progress Map: Add Locations', 'cspm'),
				array(&$this, 'cspm_meta_box_form'),
				$this->post_type,
				'advanced'
			);
			
			if(!empty($this->secondary_post_type)){
				
				$secondary_post_type_array = explode(',', str_replace(' ', '', $this->secondary_post_type));
				
				foreach($secondary_post_type_array as $post_type){
						
					add_meta_box(
						'cspm_meta_box_form',
						esc_html__('Progress Map: Add Locations', 'cspm'),
						array(&$this, 'cspm_meta_box_form'),
						$post_type,
						'advanced'
					);
					
				}
				
			}
		
		}
		
		
		/**
		 * Create the "Add Location" form
		 * 
		 * Updated 2.8
		 */
		function cspm_meta_box_form(){
	
			global $post;
	
			wp_nonce_field($this->plugin_path, 'cspm_meta_box_form_nonce');
			
			$cspml_output = '';
			
			$cspml_output .= '<style>';
			
				$cspml_output .= 'div.cspm_latLng_container{width:48%; float:left;}';
				$cspml_output .= 'div.cspm_latLng_container:nth-child(odd){border-right:1px solid #ededed; margin-right:10px;}';
				$cspml_output .= '@media (max-width: 768px) {div.cspm_latLng_container{width:100%;}}';
				
			$cspml_output .= '</style>';		
			
			$cspml_output .= '<div style="padding:5px 0 10px 0; margin:5px 0;">';
				
				/**
				 * Address Field */
				 
				$cspml_output .= '<div class="cspm_latLng_container">';
				
					$cspml_output .= '<div class="no_address_found"></div>';
					
					$cspml_output .= '<label for="'.CSPM_ADDRESS_FIELD.'" style="font-weight:bold; padding:5px 50px 10px 0; width:97%; display:block; box-sizing:border-box;">'.esc_html__('Enter an address', 'cspm').'</label>';
						
						$cspml_output .= '<input type="text" name="'.CSPM_ADDRESS_FIELD.'" id="'.CSPM_ADDRESS_FIELD.'" value="'.get_post_meta($post->ID, CSPM_ADDRESS_FIELD, true).'" style="width:79%; margin:0 5px 5px 0; float:left; height:30px;" />';
						
						$cspml_output .= '<input type="button" class="button tagadd button-large" id="codespacing_search_address" value="'.esc_html__('Search', 'cspm').'" style="float:left;" />';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
						/**
						 * Map */
						
						$cspml_output .= '<div id="location_container" style="width:97%; margin-top:5px;">'; 
							
							$cspml_output .= '<div id="codespacing_widget_map_container" style="display:block; height:400px; margin:0 auto; border:1px solid #d9d9d9;"></div>';
							
						$cspml_output .= '</div>';						
				
						/**
						 * Custom Icon Field */
						
						$custom_icon_url = get_post_meta($post->ID, CSPM_MARKER_ICON_FIELD, true);
						
						$cspml_output .= '<div style="border-top:1px solid #f5f5f5; border-bottom:1px solid #f5f5f5; padding:10px 0; margin:10px 0;">
							<label for="'.CSPM_MARKER_ICON_FIELD.'" style="font-weight:bold; padding:5px 50px 10px 0; width:97%; display:block; box-sizing:border-box;">'.esc_html__('Marker Icon', 'cspm').'</label>
							<input type="text" name="'.CSPM_MARKER_ICON_FIELD.'" id="'.CSPM_MARKER_ICON_FIELD.'" value="'.$custom_icon_url.'" class="regular-text">
							<input type="button" name="cspm_upload_marker_icon" id="cspm_upload_marker_icon" class="button-secondary" value="'.esc_html__('Upload', 'cspm').'">
							<img src="'.$custom_icon_url.'" height="20" style="mergin-left:10px; margin-top:5px;" />
							<div style="clear:both"></div>
							<p class="description" style="margin-top:10px;">'.esc_html__('Upload a custom marker icon for this post. This will override the default marker icon and the one selected for this post\'s category in "Marker categories settings".', 'cspm').'</p>
						</div>';			
			
				$cspml_output .= '</div>';
				
				$cspml_output .= '<div id="codespacing_locations_latLng_container" class="cspm_latLng_container">';
					
					/**
					 * Main Lat & Lng Fields */
					 
					$cspml_output .= '<div id="codespacing_latLng_fields" style="border-bottom:1px solid #ededed; padding-bottom:10px; margin-bottom:10px;">';
						
						/**
						 * Latitude */
						 
						$cspml_output .= '<div id="codespacing_lat_field" style="float:left; margin-right:16px; width:30%;">';
						
							$cspml_output .= '<label for="'.CSPM_LATITUDE_FIELD.'" style="font-weight:bold; padding:5px 50px 10px 0; width:130px; display:block; float:left; box-sizing:border-box;">'.esc_html__('Latitude', 'cspm').'*</label>';
					
								$cspml_output .= '<input type="text" name="'.CSPM_LATITUDE_FIELD.'" id="'.CSPM_LATITUDE_FIELD.'" value="'.get_post_meta($post->ID, CSPM_LATITUDE_FIELD, true).'" style="width:100%; height:31px; margin:0;" />';
						
						$cspml_output .= '</div>';
					
						/**
						 * Longitude */
						 
						$cspml_output .= '<div id="codespacing_lng_field" style="float:left; width:30%;">';
						
							$cspml_output .= '<label for='.CSPM_LONGITUDE_FIELD.' style="font-weight:bold; padding:5px 50px 10px 0; width:130px; display:block; float:left; box-sizing:border-box;">'.esc_html__('Longitude', 'cspm').'*</label>';
				
								$cspml_output .= '<input type="text" name="'.CSPM_LONGITUDE_FIELD.'" id="'.CSPM_LONGITUDE_FIELD.'" value="'.get_post_meta($post->ID, CSPM_LONGITUDE_FIELD, true).'" style="width:100%; height:31px; margin:0;" />';
						
						$cspml_output .= '</div>';
						
						$cspml_output .= '<div style="width:30%; float:left;"><input type="button" value="'.esc_html__('Get Pinpoint', 'cspm').'" id="codespacing_copypinpoint" class="button button-primary button-large" style="width:100%; margin:33px 0 0 10px;" /></div>';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
						$cspml_output .= '<small style="color:red">(*) '.esc_html__('Mandatory fields', 'cspm').'</small>';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
					$cspml_output .= '</div>';								
					
					/**
					 * Secondary Lat & Lng Field */
					 
					$cspml_output .= '<div>';
						
						/**
						 * Latitudes & Longitudes */
						 
						$cspml_output .= '<label for="'.CSPM_SECONDARY_LAT_LNG_FIELD.'" style="font-weight:bold; padding:5px 50px 10px 0; display:block;">'.esc_html__('Add more locations', 'cspm').'</label>';
			
						$cspml_output .= '<textarea name="'.CSPM_SECONDARY_LAT_LNG_FIELD.'" id="'.CSPM_SECONDARY_LAT_LNG_FIELD.'" style="margin:0 0 5px 0; height:100px; width:100%;">'.get_post_meta($post->ID, CSPM_SECONDARY_LAT_LNG_FIELD, true).'</textarea>';
					
						$cspml_output .= '<p style="margin-bottom:10px; color:#666;">';
							
							$cspml_output .= __('This field allows you to display the same post on multiple places on the map. 
							For example, let\'s say that this post is about "McDonald\'s" and that you want to use it to show your website\'s visitors all the locations in your country/city/town...
							where they can find "McDonald\'s". So, instead of creating - for instance - 10 posts with the same content but with different coordinates, this field will allow you to share the same content with all the different locations that points to "McDonald\'s".<br />
							<br /><strong>How to use it?</strong><br /><br />
							1. Insert the coordinates of one location in the fields <strong>Latitude</strong> & <strong>Longitude</strong>.
							<br />
							2. Enter the coordinates of the remaining locations in the field <strong>"Add more locations"</strong> by dragging the marker on the map to the exact location or by entering the location\'s address in the field <strong>"Enter an address"</strong>, then, click on the button <strong>"Add more locations".</strong> <br /><br /> 
							<strong>Note:</strong> All the locations will share the same title, content, link and featured image. Each location represents a new item on the carousel!', 'cspm');
						
						$cspml_output .= '</p>';
						
						$cspml_output .= '<input type="button" value="'.esc_html__('Add more locations', 'cspm').'" id="codespacing_secondary_copypinpoint" class="button button-primary button-large" />';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
					$cspml_output .= '</div>';
					
				$cspml_output .= '</div>';
				
				$cspml_output .= '<div style="clear:both"></div>';
					
			$cspml_output .= '</div>';
	
			$post_lat = get_post_meta($post->ID, CSPM_LATITUDE_FIELD, true);
			$post_lng = get_post_meta($post->ID, CSPM_LONGITUDE_FIELD, true);
	
			if(empty($post_lat) && empty($post_lng)){
				$post_lat = 37.09024;
				$post_lng = -95.71289100000001;
			}
								
			?>
				
			<script type="text/javascript">
			
			jQuery(document).ready(function($){
											
				var map;
				
				var error_address1 = 'We could not understand the location ';
				var error_address2 = '<br /><u>Suggestions</u>:';
					error_address2 += '<ul>'
						error_address2 += '<li>- Make sure all street and city names are spelled correctly.</li>';
						error_address2 += '<li>- Make sure your address includes a city and state.</li>';
						error_address2 += '<li>- Try entering a zip code.</li>';
					error_address2 += '</ul>';
	
				google.maps.visualRefresh = true;
				
				map = new GMaps({
					el: '#codespacing_widget_map_container',
					lat: <?php echo $post_lat; ?>,
					lng: <?php echo $post_lng; ?>,
					zoom: 9,
				});
	
				map.addMarker({
					lat: <?php echo $post_lat; ?>,
					lng: <?php echo $post_lng; ?>,
					infoWindow: {
						content : '<p style="height:50px; width:150px">Main: <?php echo $post_lat; ?>,<?php echo $post_lng; ?></p>'
					},				
					draggable: true,
					title: 'Main: <?php echo $post_lat; ?>,<?php echo $post_lng; ?>',
				});
										
				<?php 
													
				// Get lat and lng data
				$secondary_latlng = str_replace(' ', '', get_post_meta($post->ID, CSPM_SECONDARY_LAT_LNG_FIELD, true));
				
				// Add secondary coordinates
				if(!empty($secondary_latlng)){
					
					$lats_lngs = explode(']', $secondary_latlng);
					
					foreach($lats_lngs as $single_coordinate){
					
						$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
						
						$coordinates = explode(',', $strip_coordinates);
						
						if(isset($coordinates[0]) && !empty($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[1])){
							
							$lat = $coordinates[0];
							$lng = $coordinates[1];
						
							?>
	
							map.addMarker({
								lat: <?php echo $lat; ?>,
								lng: <?php echo $lng; ?>,
								infoWindow: {
									content : '<p style="height:50px; width:150px">Secondary: <?php echo $lat; ?>,<?php echo $lng; ?></p>'
								},
								draggable: false,
								title: 'Secondary: <?php echo $lat; ?>,<?php echo $lng; ?>',
							});
							
							<?php
							
						}
						
					}
					
				}
				
				?>
	
				$('input#codespacing_search_address').livequery('click', function(e){
					e.preventDefault();
					GMaps.geocode({
					  address: $('input#<?php echo CSPM_ADDRESS_FIELD ?>').val().trim(),
					  callback: function(results, status){
						if(status=='OK'){						
						  $('.no_address_found').empty();						 
						  var latlng = results[0].geometry.location;
						  map.removeMarkers();
						  map.setCenter(latlng.lat(), latlng.lng());
						  map.addMarker({
							lat: latlng.lat(),
							lng: latlng.lng(),
							draggable: true,
						  });
						}else $('.no_address_found').html(error_address1 + '<strong>' + $('input#<?php echo CSPM_ADDRESS_FIELD ?>').val().trim() + '</strong>' + error_address2);
					  }
					});
					return false;
				});
							  
				$('input#<?php echo CSPM_ADDRESS_FIELD ?>').keypress(function(e){
					if (e.keyCode == 13) {
						e.preventDefault();
						GMaps.geocode({
						  address: $(this).val().trim(),
						  callback: function(results, status){
							if(status=='OK'){	
							  $('.no_address_found').empty();
							  var latlng = results[0].geometry.location;
							  map.removeMarkers();
							  map.setCenter(latlng.lat(), latlng.lng());
							  map.addMarker({
								lat: latlng.lat(),
								lng: latlng.lng(),
								draggable: true,
							  });
							}else $('.no_address_found').html(error_address1 + '<strong>' + $('input#<?php echo CSPM_ADDRESS_FIELD ?>').val().trim() + '</strong>' + error_address2);
						  }
						});
						return false;
					}		
				});
				  
				$('input#codespacing_copypinpoint').livequery('click', function(e){
					e.preventDefault();
					$("input#<?php echo CSPM_LATITUDE_FIELD ?>").val(map.markers[0].getPosition().lat());
					$("input#<?php echo CSPM_LONGITUDE_FIELD ?>").val(map.markers[0].getPosition().lng());
				});
				
				$('#codespacing_secondary_copypinpoint').livequery('click', function(e){
					e.preventDefault();
					var old_value = $("#<?php echo CSPM_SECONDARY_LAT_LNG_FIELD ?>").val();
					$("#<?php echo CSPM_SECONDARY_LAT_LNG_FIELD ?>").val(old_value + '[' + map.markers[0].getPosition().lat() + ',' + map.markers[0].getPosition().lng() + ']');
				});
				
				/**
				 * Add Custom Upload for the field "Marker Icon"
				 * @since 2.8 */
				
				$('#cspm_upload_marker_icon').livequery('click', function(e) {
					e.preventDefault();
					var image = wp.media({ 
						title: 'Upload Image',
						// mutiple: true if you want to upload multiple files at once
						multiple: false
					}).open()
					.on('select', function(e){
						// This will return the selected image from the Media Uploader, the result is an object
						var uploaded_image = image.state().get('selection').first();
						// We convert uploaded_image to a JSON object to make accessing it easier
						// Output to the console uploaded_image
						console.log(uploaded_image);
						var image_url = uploaded_image.toJSON().url;
						// Let's assign the url value to the input field
						$('#<?php echo CSPM_MARKER_ICON_FIELD; ?>').val(image_url);
					});
				});

				/**
				 * Add support for the Autocomplete for the address field
				 * @since 2.8 */
				
				var input = document.getElementById('<?php echo CSPM_ADDRESS_FIELD ?>');
				var autocomplete = new google.maps.places.Autocomplete(input);
											
			});
			
			</script>
				
			<?php 
			
			echo $cspml_output;
				
		}
		
		
		/**
		 * Save the "Add Location" form (lat, lng)
		 *
		 * @updated 2.8
		 */		 
		function cspm_insert_meta_box_fields($post_id, $post){
										
			/**
			 * security verification */
			 
			if(!isset($_POST['cspm_meta_box_form_nonce']) || !wp_verify_nonce($_POST['cspm_meta_box_form_nonce'], $this->plugin_path))
				return '';
			
			/**
			 * pointless if $_POST is empty (this happens on bulk edit) */
			 
			if(empty($_POST))
				return $post_id;
		
			/**
			 * verify quick edit nonce */
			 
			if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) )
				return $post_id;
		
			/**
			 * don't save for autosave */
			 
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return $post_id;
				
			$post_type = $post->post_type;
			$markers_object = get_option('cspm_markers_array');
			$post_markers_object = array();
			
			/**
			 * Save the address Field */
			 
			if(isset($_POST[CSPM_ADDRESS_FIELD]))
				update_post_meta($post->ID, CSPM_ADDRESS_FIELD, $_POST[CSPM_ADDRESS_FIELD]);	
			
			/**
			 * Save the marker icon Field */
			 
			if(isset($_POST[CSPM_MARKER_ICON_FIELD]))
				update_post_meta($post->ID, CSPM_MARKER_ICON_FIELD, $_POST[CSPM_MARKER_ICON_FIELD]);
			
			/**
			 * Save the Lat & Lng Fields */
			 	
			if(isset($_POST[CSPM_LATITUDE_FIELD]) && isset($_POST[CSPM_LONGITUDE_FIELD])){								  
				
				update_post_meta($post->ID, CSPM_LATITUDE_FIELD, $_POST[CSPM_LATITUDE_FIELD]);
				update_post_meta($post->ID, CSPM_LONGITUDE_FIELD, $_POST[CSPM_LONGITUDE_FIELD]);
				
				$post_taxonomy_terms = array();
				
				$post_taxonomies = get_object_taxonomies($post, 'names');	
				
				foreach($post_taxonomies as $taxonomy_name){
					
					$post_taxonomy_terms[$taxonomy_name] = wp_get_post_terms($post->ID, $taxonomy_name, array("fields" => "ids"));
				
				}
	
				$post_markers_object = array('lat' => $_POST[CSPM_LATITUDE_FIELD],
											 'lng' => $_POST[CSPM_LONGITUDE_FIELD],
											 'post_id' => $post->ID,
											 'post_tax_terms' => $post_taxonomy_terms,
											 'is_child' => 'no',
											 'children_markers' => array()
											 );																	 
				
				/**
				 * Secondary latLng */
				 
				if(isset($_POST[CSPM_SECONDARY_LAT_LNG_FIELD])){
					
					$children_markers = array();
														
					update_post_meta($post->ID, CSPM_SECONDARY_LAT_LNG_FIELD, $_POST[CSPM_SECONDARY_LAT_LNG_FIELD]); 
	
					$j = 0;
									
					$lats_lngs = explode(']', $_POST[CSPM_SECONDARY_LAT_LNG_FIELD]);	
							
					foreach($lats_lngs as $single_coordinate){
					
						$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
						
						$coordinates = explode(',', $strip_coordinates);
						
						if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
							
							$lat = $coordinates[0];
							$lng = $coordinates[1];
							
							$children_markers[] = array('lat' => $lat,
														'lng' => $lng,
														'post_id' => $post->ID,
														'post_tax_terms' => $post_taxonomy_terms,
														'is_child' => 'yes_'.$j.''
														);
							
							$lat = '';
							$lng = '';
							$j++;
						
						} 
						
						$post_markers_object['children_markers'] = $children_markers;
						
					}
				
				}
				
				$markers_object[$post_type]['post_id_'.$post->ID] = $post_markers_object;
						
				update_option('cspm_markers_array', $markers_object);
				
			}
			
		}
		
			
		/**
		 * Get the link of the post either with the get_permalink() function ...
		 * ... or the custom field defined by the user
		 *
		 * @since 2.5 
		 */
		function cspm_get_permalink($post_id){
	
			if(!empty($this->outer_links_field_name))
				$the_permalink = get_post_meta($post_id, $this->outer_links_field_name, true);
			
			else $the_permalink = get_permalink($post_id);
			
			return $the_permalink;
			
		}
		
		
		/**
		 * Parse item custom title 
		 */
		function cspm_items_title($post_id, $title, $click_title = false){
			
			/**
			 * Custom title structure */
			 
			$post_meta = esc_attr($title);
	
			$the_permalink = ($click_title && $this->click_on_title == 'yes') ? ' href="'.$this->cspm_get_permalink($post_id).'"' : '';
			$target = ($this->external_link == "same_window") ? '' : ' target="_blank"';
			
			/**
			 * Init vars */
			 
			$items_title = '';		
			$items_title_lenght = 0;
			
			/**
			 * If no custom title is set, call item original title */
			 
			if(empty($post_meta)){						
				
				$items_title = get_the_title($post_id);
				
			/**
			 * If custom title is set ... */
			 
			}else{
				
				// ... Get post metas from custom title structure
				$explode_post_meta = explode('][', $post_meta);
				
				// Loop throught post metas
				foreach($explode_post_meta as $single_post_meta){
					
					// Clean post meta name 
					$single_post_meta = str_replace(array('[', ']'), '', $single_post_meta);
					
					// Get the first two letters from post meta name
					$check_string = substr($single_post_meta, 0, 2);
					
					if(!empty($check_string)){
						
						// Separator case
						if($check_string === 's='){
							
							// Add separator to title
							$items_title .= str_replace('s=', '', $single_post_meta);
						
						// Lenght case	
						}elseif($check_string === 'l='){
							
							// Define title lenght
							$items_title_lenght = str_replace('l=', '', $single_post_meta);
						
						// Empty space case
						}elseif($single_post_meta == '-'){
							
							// Add space to title
							$items_title .= ' ';
						
						// Post metas case		
						}else{
							
							// Add post meta value to title
							$items_title .= get_post_meta($post_id, $single_post_meta, true);
								
						}
					
					}
					
				}
				
				// If custom title is empty (Maybe someone will type something by error), call original title
				if(empty($items_title)) $items_title = get_the_title($post_id);
				
			}
			
			// Show title as title lenght is defined	
			if($items_title_lenght > 0) $items_title = substr($items_title, 0, $items_title_lenght);
			
			return ($click_title) ? '<a'.$the_permalink.''.$target.'>'.addslashes_gpc($items_title).'</a>' : addslashes_gpc($items_title);
			
		}
		
		
		/**
		 * Parse item custom details 
		 */
		function cspm_items_details($post_id, $details){
			
			/**
			 * Custom details structure */
			 
			$post_meta = esc_attr($details);		
			
			/**
			 * Init vars */
			 
			$items_details = '';
			$items_title_lenght = 0;
			$items_details_lenght = '100';
			
			/**
			 * If new structure is set ... */
			 
			if(!empty($post_meta)){
				
				/**
				 * ... Get post metas from custom details structure */
				 
				$explode_post_meta = explode('][', $post_meta);
				
				/**
				 * Loop throught post metas */
				 
				foreach($explode_post_meta as $single_post_meta){
					
					/**
					 * Clean post meta name */
					 
					$single_post_meta = str_replace(array('[', ']'), '', $single_post_meta);
					
					/**
					 * Get the first two letters from post meta name */
					 
					$check_string = substr($single_post_meta, 0, 2);
					$check_taxonomy = substr($single_post_meta, 0, 4);
					$check_content = substr($single_post_meta, 0, 7);
					
					/**
					 * Taxonomy case */
					 
					if(!empty($check_taxonomy) && $check_taxonomy == 'tax='){
						
						/**
						 * Add taxonomy term(s) */
						 
						$taxonomy = str_replace('tax=', '', $single_post_meta);
						$items_details .= implode(', ', wp_get_post_terms($post_id, $taxonomy, array("fields" => "names")));
						
					/**
					 * The content */
					 
					}elseif(!empty($check_content) && $check_content == 'content'){
						
						$explode_content = explode(';', str_replace(' ', '', $single_post_meta));
						
						/**
						 * Get original post details */
						 
						$post_record = get_post($post_id, ARRAY_A);
						
						/**
						 * Post content */
						 
						$post_content = trim(preg_replace('/\s+/', ' ', $post_record['post_content']));
						
						/**
						 * Post excerpt */
						 
						$post_excerpt = trim(preg_replace('/\s+/', ' ', $post_record['post_excerpt']));
						
						/**
						 * Excerpt is recommended */
						 
						$the_content = (!empty($post_excerpt)) ? $post_excerpt : $post_content;
				
						/**
						 * Show excerpt/content as details lenght is defined */
						 
						if(isset($explode_content[1]) && $explode_content[1] > 0) $items_details .= substr($the_content, 0, $explode_content[1]).apply_filters('cspm_description_more', '&hellip;');
									
					/**
					 * Separator case */
					 
					}elseif(!empty($check_string) && $check_string == 's='){
						
						/**
						 * Add separator to details */
						 
						$separator = str_replace('s=', '', $single_post_meta);
						
						$separator == 'br' ? $items_details .= '<br />' : $items_details .= $separator;
						
					/**
					 * Meta post title OR Label case */
					 
					}elseif(!empty($check_string) && $check_string == 't='){
						
						/**
						 * Add label to details */
						 
						$items_details .= str_replace('t=', '', $single_post_meta);
						
					/**
					 * Lenght case */
					 
					}elseif(!empty($check_string) && $check_string == 'l='){
						
						/**
						 * Define details lenght */
						 
						$items_details_lenght = str_replace('l=', '', $single_post_meta);
						
					/**
					 * Empty space case */
					 
					}elseif($single_post_meta == '-'){
						
						/**
						 * Add space to details */
						 
						$items_details .= ' ';
						
					/**
					 * Post metas case */
					 
					}else{
	
						/**
						 * Add post metas to details */
						 
						$items_details .= get_post_meta($post_id, $single_post_meta, true);
							
					}
					
				}						
				
			}
			
			/**
			 * If no custom details structure is set ... */
			 
			if(empty($post_meta) || empty($items_details)){
				
				/**
				 * Get original post details */
				 
				$post_record = get_post($post_id, ARRAY_A, 'display');
				
				/**
				 * Post content */
				 
				$post_content = trim(preg_replace('/\s+/', ' ', $post_record['post_content']));
				
				/**
				 * Post excerpt */
				 
				$post_excerpt = trim(preg_replace('/\s+/', ' ', $post_record['post_excerpt']));
				
				/**
				 * Excerpt is recommended */
				 
				$items_details = (!empty($post_excerpt)) ? $post_excerpt : $post_content;
				
				/**
				 * Show excerpt/content as details lenght is defined */
				 
				if($items_details_lenght > 0){
					
					/**
					 * Remove the last word from the content/excerpt ...
					 * ... as a proof against foreign characters encoded ...
					 * ... when the last word of the content is cut off */
					 
					$items_details = substr($items_details, 0, $items_details_lenght);
					$items_details = explode(' ', $items_details);
					$last_word = array_pop($items_details);
					$items_details = implode(' ', $items_details).apply_filters('cspm_description_more', '&hellip;');
					
				}
				
			}
			
			return addslashes_gpc($items_details);
			
		}
		
		
		/**
		 * Ajax function: Get Item details 
		 */
		function cspm_load_carousel_item(){
	
			global $wpdb;
			
			/**
			 * Items ID */
			 
			$post_id = esc_attr($_POST['post_id']);
			
			/**
			 * Remove the index for secondary markers. e.g. 551-0 will be 551 */
			 
			if(strpos($post_id, '-') !== false) $post_id = substr($post_id, 0, strpos($post_id, '-'));
			
			/**
			 * View style (horizontal/vertical) */
			 
			$items_view = esc_attr($_POST['items_view']);
					
			/**
			 * Get items title or custom title */
			 
			$item_title = apply_filters('cspm_custom_item_title', stripslashes_deep($this->cspm_items_title($post_id, $this->items_title, true)), $post_id); 
			$item_description = apply_filters('cspm_custom_item_description', stripslashes_deep($this->cspm_items_details($post_id, $this->items_details)), $post_id);
			
			/**
			 * Create items single page link */
			 
			$the_permalink = $this->cspm_get_permalink($post_id);				
			$target = ($this->external_link == "same_window") ? '' : ' target="_blank"';
			
			$more_button_text = $this->cspm_wpml_get_string('"More" Button text', $this->details_btn_text, $this->use_with_wpml);
			$more_button_text = apply_filters('cspm_more_button_text', $more_button_text, $post_id);
			
			$output = '';
			
			/* ========================= */
			/* ==== Horizontal view ==== */
			/* ========================= */
					
			if($items_view == "listview"){
				
				$parameter = array(
					'style' => 'width:'.$this->horizontal_img_width.'px; height:'.$this->horizontal_img_height.'px;',
					'class' => 'cspm_border_left_radius',
				);
				
				/**
				 * Item thumb */
				 
				$post_thumbnail = apply_filters('cspm_post_thumb', get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter), $post_id, $this->horizontal_img_width, $this->horizontal_img_height);
								
				$output .= '<div class="item_infos">';
								
									
					/* =========================== */
					/* ==== LTR carousel mode ==== */
					/* =========================== */
					
					if($this->carousel_mode == 'false'){
						
						/**
						 * Image or Thumb area */
						 
						$output .= '<div class="item_img">';
								
							$output .= $post_thumbnail;
				
						$output .= '</div>';
						
						/**
						 * Details area */
						 
						$output .= '<div class="details_container">';
							
							/**
							 * "More" Button */
							 
							if($this->show_details_btn == 'yes')
								$output .= '<div><a class="details_btn cspm_border_radius cspm_border_shadow" href="'.$the_permalink.'" style="'.$this->details_btn_css.'"'.$target.'>'.$more_button_text.'</a></div>';
							
							/**
							 * Item title */
							 
							$output .= '<div class="details_title">'.$item_title.'</div>';
							
							/**
							 * Items details */
							 
							$output .= '<div class="details_infos">'.$item_description.'</div>';
							
						$output .= '</div>';
									
									
					/* =========================== */
					/* ==== RTL carousel mode ==== */
					/* =========================== */
					
					}else{
					
						/**
						 * Details area */
						 
						$output .= '<div class="details_container">';
							
							/**
							 * "More" Button */
							 
							if($this->show_details_btn == 'yes')
								$output .= '<div><a class="details_btn cspm_border_radius cspm_border_shadow" href="'.$the_permalink.'" style="'.$this->details_btn_css.'"'.$target.'>'.$more_button_text.'</a></div>';
							
							/**
							 * Item title */
							 
							$output .= '<div class="details_title">'.$item_title.'</div>';
							
							/**
							 * Items details */
							 
							$output .= '<div class="details_infos">'.$item_description.'</div>';
							
						$output .= '</div>';
						
						/**
						 * Image or Thumb area */
						 
						$output .= '<div class="item_img">';
								
							$output .= $post_thumbnail;
				
						$output .= '</div>';
					
					}
					
					$output .= '<div style="clear:both"></div>';				
					
				$output .= '</div>';
			
			
			/* ======================= */
			/* ==== Vertical view ==== */
			/* ======================= */
					
			}elseif($items_view == "gridview"){					
			
				$parameter = array(
					'style' => 'width:'.$this->vertical_img_width.'px; height:'.$this->vertical_img_height.'px;',
					'class' => 'cspm_border_top_radius',
				);
				
				/**
				 * Item thumb */
				 
				$post_thumbnail = apply_filters('cspm_post_thumb', get_the_post_thumbnail($post_id, 'cspacing-vertical-thumbnail', $parameter), $post_id, $this->vertical_img_width, $this->vertical_img_height);
						
				$output .= '<div class="item_infos">';
					
					/**
					 * Image or Thumb area */
					 
					$output .= '<div class="item_img">';
							
						$output .= $post_thumbnail;
			
					$output .= '</div>';
					
					/**
					 * Details area	*/
					 
					$output .= '<div class="details_container">'; 
						
						/**
						 * "More" Button */
						 
						if($this->show_details_btn == 'yes')
							$output .= '<div><a class="details_btn cspm_border_radius cspm_border_shadow" href="'.$the_permalink.'" style="'.$this->details_btn_css.'"'.$target.'>'.$more_button_text.'</a></div>';
						
						/**
						 * Item title */
						 
						$output .= '<div class="details_title">'.$item_title.'</div>';
						
						/** 
						 * Items details */
						 
						$output .= '<div class="details_infos">'.$item_description.'</div>';
						
					$output .= '</div>';
					
					$output .= '<div style="clear:both"></div>';
					
				$output .= '</div>';
				
			}
		   
			die($output);
					
		}
		
		
	   /**
		* Build the main query
		*
		* @since 2.0 
		* @updated 2.8.2
		*/
		function cspm_main_query($atts = array()){
			
			extract( wp_parse_args( $atts, array(
				'post_type' => '', 
				'post_status' => '',
				'number_of_posts' => '', 
				'tax_query' => '',
				'tax_query_field' => 'id', // @since 2.6.1
				'tax_query_relation' => '', 
				'cache_results' => '', 
				'update_post_meta_cache' => '',
				'update_post_term_cache' => '',
				'post_in' => '',
				'post_not_in' => '',
				'custom_fields' => '',
				'custom_field_relation' => '',
				'authors' => '',
				'orderby' => '',
				'orderby_meta_key' => '',
				'order' => '',
				'optional_latlng' => '',
			)));
			
			/**
			 * Post type */
			 
			if(empty($post_type)) $post_type = (empty($this->post_type)) ? 'post' : $this->post_type;					
			$post_type_array = explode(',', esc_attr($post_type));
					
			/**
			 * Query limit */
			 
			if(empty($number_of_posts)) 
				$nbr_items = (empty($this->number_of_items)) ? -1 : $this->number_of_items;
			else $nbr_items = esc_attr($number_of_posts);
			
			/**
			 * Status */
			 
			if(empty($post_status)){ 
				/*$statuses = get_post_stati();
				$items_status = array();
				foreach($statuses as $status){
					if(isset($this->settings['codespacingprogressmap_generalsettings_items_status_'.$status.''])){						
						$status_name = $this->settings['codespacingprogressmap_generalsettings_items_status_'.$status.''];
						if($status_name != '0') $items_status[] = $status;
					}
				}*/
				$status = $this->post_status; //(count($items_status) == 0) ? 'publish' : $items_status;
			}else $status = explode(',', esc_attr($post_status));
			
			/**
			 * Caching */		 
			 
			if(empty($cache_results)) 
				$cache_results = ($this->cache_results == 'true') ? true : false;
			else $cache_results = (esc_attr($cache_results) == 'true') ? true : false;
			
			if(empty($update_post_meta_cache))
				$update_post_meta_cache = ($this->update_post_meta_cache == 'true') ? true : false;
			else $update_post_meta_cache = (esc_attr($update_post_meta_cache) == 'true') ? true : false;
			
			if(empty($update_post_term_cache))
				$update_post_term_cache = ($this->update_post_term_cache == 'true') ? true : false;					
			else $update_post_term_cache = (esc_attr($update_post_term_cache) == 'true') ? true : false;		
			
			/**
			 * Post parameters */
			 
			if(empty($post_in))
				$post_in = (empty($this->post_in)) ? array() : explode(',', $this->post_in);
			else $post_in = explode(',', esc_attr($post_in));
			
			if(empty($post_not_in))
				$post_not_in = (empty($this->post_not_in)) ? array() : explode(',', $this->post_not_in);		
			else $post_not_in = explode(',', esc_attr($post_not_in));
			
			/**
			 * OrderBy meta key */
			 
			if(empty($orderby)){ 
				$orderby_param = $this->orderby_param;
				$orderby_meta_key = ($orderby_param != 'meta_value' && $orderby_param != 'meta_value_num') ? '' : $this->orderby_meta_key;
				$order_param = $this->order_param;
			}else{
				$orderby_param = esc_attr($orderby);
				$orderby_meta_key = esc_attr($orderby_meta_key);
				$order_param = strtoupper(esc_attr($order));
			}
			
			
			/**
			 * Custom fields */
			 
			if(empty($custom_fields)) 
				$custom_fields = $this->cspm_parse_query_meta_fields($this->custom_fields, $this->custom_field_relation_param, '[', $optional_latlng);
			else $custom_fields = $this->cspm_parse_query_meta_fields(esc_attr($custom_fields), strtoupper(esc_attr($custom_field_relation)), '{', $optional_latlng);
		
					
			/**
			 * Taxonomies */
			 
			if(empty($tax_query)){
							
				$post_taxonomies = (array) get_object_taxonomies($this->post_type, 'objects');
				$taxonomies_array = array();
				
				/**
				 * Loop throught taxonomies	*/
				 
				foreach($post_taxonomies as $single_taxonomie){
					
					/**
					 * Get Taxonomy Name */
					 
					$tax_name = $single_taxonomie->name;
					
					/**
					 * Make sure the taxonomy operator exists */
					 
					if(isset($this->settings['codespacingprogressmap_generalsettings_'.$tax_name.'_operator_param'])){	
						
						/**
						 * The operator */
						 
						$taxonomy_operator_param = $this->settings['codespacingprogressmap_generalsettings_'.$tax_name.'_operator_param'];
						
						/**
						 * Get all terms related to this taxonomy */
						 
						if(isset($this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.''])){
							
							$terms = $this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.''];
							
							if(count($terms) > 0){
							
								// For WPML =====
								$WPML_terms = array();
								foreach($terms as $term)
									$WPML_terms[] = $this->cspm_wpml_object_id($term, $tax_name, false, '', $this->use_with_wpml);
								// @For WPML ====							 
								
								$taxonomies_array[] = array(
									'taxonomy' => $tax_name,
									'field' => 'id',
									'terms' => $WPML_terms,
									'operator' => $taxonomy_operator_param,
							   );
							
							}
						
						}
						
					}
					
				}
				
				$taxonomy_relation_param = $this->cspm_get_setting('generalsettings', 'taxonomy_relation_param', 'AND');	
				$tax_query = (count($taxonomies_array) == 0) ? array('tax_query' => '') : array('tax_query' => array_merge(array('relation' => $taxonomy_relation_param), $taxonomies_array));
	
			}else{
				
				/**
				 * tax_query = "cat_1{1.2.3|IN},cat_2{2.3|NOT IN}"
				 * tax_query_relation = "AND" */
				
				$taxonomies_array = array();
				
				$taxonomy_term_names_and_term_ids = explode(',',  str_replace(' ', '', esc_attr($tax_query))); // array(cat_1{1.2.3|IN}, cat_2{2.3|NOT IN})
				
				if(count($taxonomy_term_names_and_term_ids) > 0){
					
					foreach($taxonomy_term_names_and_term_ids as $single_term_name_and_term_ids){
						
						$term_name = $term_relation = '';
						$term_ids = array();
						
						$term_name_and_term_ids = explode('{', $single_term_name_and_term_ids); // array(cat_1, 1.2.3|IN})
				
						if(isset($term_name_and_term_ids[0])) $term_name = $term_name_and_term_ids[0]; // cat_1
						
						if(isset($term_name_and_term_ids[0])){
							
							$term_ids_and_relation = explode('|', $term_name_and_term_ids[1]); // array(1.2.3, IN})
						
							if(isset($term_ids_and_relation[0])) $term_ids = explode('.', $term_ids_and_relation[0]); // array(1, 2, 3)
							
							if(isset($term_ids_and_relation[0])) $term_relation = str_replace('}', '', $term_ids_and_relation[1]); // IN;
							
						}
						
						if(count($term_ids) > 0){
													
							// For WPML ===== 
							$WPML_terms = array();
							foreach($term_ids as $term)
								$WPML_terms[] = $this->cspm_wpml_object_id($term, $term_name, false, '', $this->use_with_wpml);
							// @For WPML ====
	
							$taxonomies_array[] = array(
								'taxonomy' => $term_name,
								'field' => $tax_query_field, //'id',
								'terms' => $WPML_terms,
								'operator' => strtoupper($term_relation),
						   );
													   
						}
													   
					}
					
				}
				
				$tax_query = (count($taxonomies_array) == 0) ? array('tax_query' => '') : array('tax_query' => array_merge(array('relation' => strtoupper(esc_attr($tax_query_relation))), $taxonomies_array));
				
			}
				
			/**
			 * Authors */
			 
			if(empty($authors)){

				$authors_array = array();
				
				if(isset($this->settings['codespacingprogressmap_generalsettings_authors'])){
					
					$author_ids = $this->settings['codespacingprogressmap_generalsettings_authors'];
					
					$authors_condition = $this->cspm_get_setting('generalsettings', 'authors_prefixing', 'false');
					$authors_prefixing = ($authors_condition == 'false') ? '' : '-';
					
					if($authors_prefixing == '-'){
						foreach($author_ids as $author_id)
							$authors_array[] = $authors_prefixing.$author_id;
					}else $authors_array = $author_ids;
					
				}
				
				$authors = (count($authors_array) == 0) ? '' : implode(',', $authors_array);
				
			}else{
							
				$authors_array = explode(',', esc_attr($authors));
				$authors = (count($authors_array) == 0) ? '' : implode(',', $authors_array);
				
			}
			
			/**
			 * Call items ids */
			 
			$query_args = array( 'post_type' => $post_type_array,							
								 'post_status' => $status, 
	
								 'posts_per_page' => $nbr_items, 
								 
								 'tax_query' => $tax_query['tax_query'],
								 
								 'cache_results' => $cache_results,
								 'update_post_meta_cache' => $update_post_meta_cache,
								 'update_post_term_cache' => $update_post_term_cache,
								 
								 'post__in' => $post_in,
								 'post__not_in' => $post_not_in,
								 
								 'meta_query' => $custom_fields['meta_query'],
								 
								 'author' => $authors,
								 
								 'orderby' => $orderby_param,
								 'meta_key' => $orderby_meta_key,
								 'order' => $order_param,
								 'fields' => 'ids');
			
			$query_args = apply_filters( 'cs_progress_map_main_query', $query_args );
										 
			$query_args = (isset($query_args['fields']) && $query_args['fields'] == 'ids') ? $query_args : $query_args + array('fields' => 'ids');
			
			/**
			 * Execute query */
			 
			$post_ids = ($this->use_with_wpml == "yes") ? query_posts( $query_args ) : get_posts( $query_args );

			/**
			 * Reset query */
			 
			($this->use_with_wpml == "yes") ? wp_reset_query() : wp_reset_postdata();
			
			return $post_ids;
			
		}
		
	   
	   /**
		* Parse custom fields to use in the main query
		*
		* @since 2.0 
		*/
		function cspm_parse_query_meta_fields($meta_fields, $relation, $field_holder = '[', $optional_latlng = 'false'){
			
			$custom_fields = array('meta_query' => '');
			
			if(!empty($meta_fields)){
				
				/**
				 * Explode custom fields [...],[...],... */
				 
				if($field_holder == '[') $parse_meta_fields = explode('],[', str_replace(array(' '), '', $meta_fields));
				else $parse_meta_fields = explode('},{', str_replace(array(' '), '', $meta_fields));
				
				/**
				 * Init meta_query array */
				 
				$meta_query_array = array();
	
				/**
				 * Loop through the custom fields */
				 
				foreach($parse_meta_fields as $single_meta_fields_vars){
	
					/**
					 * Remove brackets */
					 
					if($field_holder == '[') $custom_field_parameters_str = str_replace(array('[', ']', ' '), '', $single_meta_fields_vars);
					else $custom_field_parameters_str = str_replace(array('{', '}', ' '), '', $single_meta_fields_vars);
					
					/**
					 * Explode custom field parameters */
					 
					$custom_field_parameters_array = explode('|', $custom_field_parameters_str);
				
					/**
					 * Init parameters array.
					 * On each turn of the loop, $parameters_array must be empty */
					 
					$parameters_array = array();
					
					/**
					 * Loop through each parameter */
					 
					foreach($custom_field_parameters_array as $single_param){
	
						/**
						 * Explode parameter key & value */
						 
						$param_composer = explode(':', $single_param);
	
						/**
						 * Key case */
						 
						if(ltrim(rtrim($param_composer[0])) == 'key') $parameters_array['key'] = $param_composer[1];
						
						/**
						 * Value case */
						 
						elseif(ltrim(rtrim($param_composer[0])) == 'value'){
							
							$value_values = str_replace(array('(', ')', ' '), '', $param_composer[1]);
							
							$values_array = explode(',', $value_values);
							
							if(count($values_array) == 1) $parameters_array['value'] = $values_array[0];
							else $parameters_array['value'] = $values_array;
							
						}
						
						/**
						 * Type case */
						 
						elseif(ltrim(rtrim($param_composer[0])) == 'type') $parameters_array['type'] = $param_composer[1];
						
						/**
						 * Compare case */
						 
						elseif(ltrim(rtrim($param_composer[0])) == 'compare'){
							
							/**
							 * When "value" is an array, the operator must be one of the following types (IN, NOT IN, BETWEEN, NOT BETWEEN) */
							 
							if(isset($parameters_array['value']) && is_array($parameters_array['value'])){
								
								if(in_array(strtoupper($param_composer[1]), array('IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN')))							
									$parameters_array['compare'] = strtoupper($param_composer[1]);
								
							}else $parameters_array['compare'] = $param_composer[1];
	
						}
						
					}
					
					/**
					 * Associate them to meta_query[] */
					 
					$meta_query_array[] = $parameters_array;								
					
				}
				
				$custom_fields = array('meta_query' => array_merge(array('relation' => $relation), $meta_query_array));
		
			}elseif($optional_latlng == 'false'){
				
				 $custom_fields = array(
				 	'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => CSPM_LATITUDE_FIELD,
							'value' => '',
							'compare' => '!='
						),
						array(
							'key' => CSPM_LONGITUDE_FIELD,
							'value' => '',
							'compare' => '!='
						)
					)
				);
								
			}
		
			return $custom_fields;
			
		}
		
		
		/**
		 * A form to add locations from the frontend
		 *
		 * @since 2.6.3 
		 * @updated 2.7 
		 */
		function cspm_frontend_form($atts){
			
			extract( shortcode_atts( array(
			  'map_id' => 'frontend_form_map',
			  'post_id' => '',
			  'post_type' => $this->post_type,			  
			  'embed' => 'no',
			  'center_at' => '',
			  'height' => '400px',
			  'width' => '100%',
			  'zoom' => 5,
			  'map_style' => '',
			  'initial_map_style' => esc_attr($this->initial_map_style),
			  'use_in_tab' => 'no',
			), $atts, 'progress_map_add_location_form' ) ); 
					
			$map_id = esc_attr($map_id);
			
			/**
			 * Default center point */
			 
			$centerLat = 51.53096;
			$centerLng = -0.121064;
			
			/**
			 * Get the center point */
			 
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
			
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
	
					/**
					 * Get lat and lng data */
					 
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : 37.09024;
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : -95.71289100000001;
					
				}			
				
			}
			
			/**
			 * Map Styling */
			 
			$this_map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
							
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				/**
				 * Include the map styles array	*/
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this_map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			?>
			
			<script type="text/javascript">
			
				jQuery(document).ready(function($){ 
					
					/**
					 * init plugin map */
					 
					var plugin_map_placeholder = 'div#cspm_frontend_form_<?php echo $map_id; ?>';
					var plugin_map = $(plugin_map_placeholder);
					
					/**
					 * Activate the new google map visual */
					 
					google.maps.visualRefresh = true;
					
					var map_options = { center:[<?php echo $centerLat; ?>, <?php echo $centerLng; ?>],
										zoom: <?php echo esc_attr($zoom); ?>,
										scrollwheel: false,
										zoomControl: true,
										panControl: true,
										mapTypeControl: true,
										streetViewControl: true,
									  };
					
					/**
					 * The initial map style */
					 
					var initial_map_style = "<?php echo $initial_map_style; ?>";
					
					<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
													
						var map_options = $.extend({}, map_options, map_type_id);
						
					<?php }else{ ?>
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
													
						var map_options = $.extend({}, map_options, map_type_id);
						
					<?php } ?>
					
					var map_id = 'frontend_form_<?php echo $map_id ?>';
					
					_CSPM_MAP_RESIZED[map_id] = 0;	
					
					/**
					 * Create the map */
					 
					plugin_map.gmap3({	
							  
						map:{
							options: map_options,						
						},
						
						/**
						 * Set the map style */
						 
						<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?>
							
							styledmaptype:{
								id: "custom_style",
								styles: <?php echo $map_styles[$this_map_style]['style']; ?>
							}
							
						<?php } ?>
																
					});	
					
					/**
					 * Center the Map on screen resize */
					 
					<?php if(!empty($centerLat) && !empty($centerLng)){ ?>						
						
						/**
						 * Store the window width */
						
    					var windowWidth = $(window).width();
	
						$(window).resize(function(){
							
							/**
							 * Check window width has actually changed and it's not just iOS triggering a resize event on scroll */
							 
							if ($(window).width() != windowWidth) {
					
								/**
								 * Update the window width for next time */
								 
								windowWidth = $(window).width();
			
								setTimeout(function(){
								
									var latLng = new google.maps.LatLng (<?php echo $centerLat; ?>, <?php echo $centerLng; ?>);																														
								
									var map = plugin_map.gmap3("get");
									
									if(typeof map.panTo === 'function')
										map.panTo(latLng);
										
									if(typeof map.setCenter === 'function')
										map.setCenter(latLng);	
										
								}, 500);
								
							}
							
						});
						
					<?php } ?>
					
					/**
					 * Resolve a problem of Google Maps & jQuery Tabs */
					 
					<?php if(esc_attr($use_in_tab) == 'yes' || $this->map_in_tab == 'yes'){ ?>					
					
						$(plugin_map_placeholder+':visible').livequery(function(){
							if(_CSPM_MAP_RESIZED[map_id] <= 1){ // 0 is for the first loading, 1 is when the user clicks the map tab.
								cspm_center_map_at_point(plugin_map, <?php echo $centerLat; ?>, <?php echo $centerLng; ?>, 'resize');
								_CSPM_MAP_RESIZED[map_id]++;
							}
						});

					<?php } ?>

					/**
					 * Add support for the Autocomplete for the address field
					 * @since 2.8 */
					
					var input = document.getElementById('cspm_search_address');
					var autocomplete = new google.maps.places.Autocomplete(input);
											
				});
			
			</script> 
						
			<?php
			
			/**
			 * Save the location */
			 
			if(!empty($post_id) && isset($_POST[CSPM_LATITUDE_FIELD], $_POST[CSPM_LONGITUDE_FIELD]))
				$this->cspm_save_frontend_location(array(
					'post_id' => esc_attr($post_id),
					'latitude' => esc_attr($_POST[CSPM_LATITUDE_FIELD]),
					'longitude' => esc_attr($_POST[CSPM_LONGITUDE_FIELD]),
					'post_type' => $post_type,
				));	
			
			/**
			 * If you want to save the coordinates using PHP, here's the code you need to use to save the location
			 
			if(class_exists('CodespacingProgressMap') && isset($_POST[CSPM_LATITUDE_FIELD], $_POST[CSPM_LONGITUDE_FIELD])){			
				$ProgressMapClass = CodespacingProgressMap::this();
				$ProgressMapClass->cspm_save_frontend_location(array(
					'post_id' => THE_POST_ID,
					'latitude' => esc_attr($_POST[CSPM_LATITUDE_FIELD]),
					'longitude' => esc_attr($_POST[CSPM_LONGITUDE_FIELD]),
					'post_type' => THE_POST_TYPE_NAME, // default: post
				));	
			}
			
			*/ 			 

			$output = '';
			
			/**
			 * Use this filter to add some custom code before the frontend form */
			 
			$output .= apply_filters('cspm_before_frontend_form', '');
			
			/**
			 * Use this filter to remove the opening tag */
			 
			if(esc_attr($embed) == 'no')
				$output .= apply_filters('cspm_open_frontend_form_tag', '<form action="" method="post" role="form" class="cspm_frontend_form">');
				
				$output .= '<div class="row">';

					/**
					 * Use this filter to add some custom code before the search field */
					 
					$output .= apply_filters('cspm_frontend_form_before_search_field', '');
					
					$output .= '<div class="form-group '.apply_filters('cspm_frontend_form_search_field_class', 'col-lg-10 col-md-10 col-sm-10 col-xs-12').'">
									<label for="cspm_search_address">'.esc_html__('Search', 'cspm').'</label>
									<input type="text" class="form-control" id="cspm_search_address" name="cspm_search_address" placeholder="'.esc_html__('Enter an address and search', 'cspm').'">
								</div>';
					
					$output .= '<div class="form-group '.apply_filters('cspm_frontend_form_search_btn_class', 'col-lg-2 col-md-2 col-sm-2 col-xs-12').'"> 
									<button type="button" id="cspm_search_btn" class="btn btn-primary" data-map-id="'.$map_id.'">'.esc_html__('Search', 'cspm').'</button>
								</div>';

					/**
					 * Use this filter to add some custom code after the search field */
					 
					$output .= apply_filters('cspm_frontend_form_after_search_field', '');
					
				$output .= '</div>';
				
				$output .= '<div class="row">';

					/**
					 * Use this filter to add some custom code before the map */
					 
					$output .= apply_filters('cspm_frontend_form_before_map', '');
					
					$output .= '<div id="cspm_frontend_form_'.$map_id.'" class="'.apply_filters('cspm_frontend_form_map_class', 'col-lg-12 col-md-12 col-sm-12 col-xs-12').'" style="height:'.$height.'; width:'.$width.'"></div>';

					/**
					 * Use this filter to add some custom code after the map */
					 
					$output .= apply_filters('cspm_frontend_form_after_map', '');
									
				$output .= '</div>';
				
				$output .= '<div class="row">';

					/**
					 * Use this filter to add some custom code before the latlng fields */
					 
					$output .= apply_filters('cspm_frontend_form_before_latlng', '');
									
					$output .= '<div class="form-group '.apply_filters('cspm_frontend_form_lat_field_class', 'col-lg-5 col-md-5 col-sm-12 col-xs-12').'">
									<label for="cspm_latitude">'.esc_html__('Latitude', 'cspm').'</label>
									<input type="text" class="form-control" id="cspm_latitude" name="'.CSPM_LATITUDE_FIELD.'">
								</div>';
				
					$output .= '<div class="form-group '.apply_filters('cspm_frontend_form_lng_field_class', 'col-lg-5 col-md-5 col-sm-12 col-xs-12').'">
									<label for="cspm_longitude">'.esc_html__('Longitude', 'cspm').'</label>
									<input type="text" class="form-control" id="cspm_longitude" name="'.CSPM_LONGITUDE_FIELD.'">
								</div>';
					
					$output .= '<div class="form-group '.apply_filters('cspm_frontend_form_pinpoint_btn_class', 'col-lg-2 col-md-2 col-sm-12 col-xs-12').'"> 
									<button type="button" id="cspm_get_pinpoint" class="btn btn-primary cspm_get_pinpoint" data-map-id="'.$map_id.'">'.esc_html__('Get Pinpoint', 'cspm').'</button>
								</div>';
								
					/**
					 * Use this filter to add some custom code after the latlng fields */
					 
					$output .= apply_filters('cspm_frontend_form_after_latlng', '');
					
				$output .= '</div>';
				
				if($embed == 'no'){
					
					$output .= '<div class="row">';
					
						/**
						 * Use this filter to add some custom code before the submit button */
						 
						$output .= apply_filters('cspm_frontend_form_before_submit_btn', '');
						
						$output .= '<div class="form-group '.apply_filters('cspm_frontend_form_submit_btn_class', 'col-lg-2 col-md-2 col-sm-12 col-xs-12').'"> 
										<button type="submit" id="cspm_add_location" class="btn btn-primary cspm_add_location" data-map-id="'.$map_id.'">'.esc_html__('Add Location', 'cspm').'</button>
									</div>';
						
						/**
						 * Use this filter to add some custom code after the submit button */
						 
						$output .= apply_filters('cspm_frontend_form_after_submit_btn', '');
														
					$output .= '</div>';
				
				}
				
			/**
			 * Use this filter to remove the closing tag of the form */
			 
			if(esc_attr($embed) == 'no')
				$output .= apply_filters('cspm_close_frontend_form_tag', '</form>');
			
			/**
			 * A filter to add some custom code after the frontend form */
			 
			$output .= apply_filters('cspm_after_frontend_form', '');
			
			return $output;
			
		}		
		
		
		/**
		 * Save locations from the frontend using the frontend form
		 *
		 * @since 2.6.3
		 */
		function cspm_save_frontend_location($atts = array()){
		
			$defaults = array(
				'post_id' => '',
				'post_type' => $this->post_type,
				'latitude' => '',
				'longitude' => '',
			);
			
			extract(wp_parse_args($atts, $defaults));
				
			global $wpdb;
			
			$post_id = (isset($post_id) && !empty($post_id)) ? esc_attr($post_id) : $wpdb->insert_id;
			
			if(!empty($post_id) && !empty($latitude) && !empty($longitude)){
				
				$markers_object = get_option('cspm_markers_array');
				$post_markers_object = array();
			
				update_post_meta($post_id, CSPM_LATITUDE_FIELD, $latitude);
				update_post_meta($post_id, CSPM_LONGITUDE_FIELD, $longitude);
					
				$post_taxonomy_terms = array();
				
				$post_taxonomies = get_object_taxonomies($post_type, 'names');	
				
				foreach($post_taxonomies as $taxonomy_name){
					
					$post_taxonomy_terms[$taxonomy_name] = wp_get_post_terms($post_id, $taxonomy_name, array("fields" => "ids"));
				
				}
	
				$post_markers_object = array('lat' => $latitude,
											 'lng' => $longitude,
											 'post_id' => $post_id,
											 'post_tax_terms' => $post_taxonomy_terms,
											 'is_child' => 'no',
											 'children_markers' => array()
											 );																	 
				
				$markers_object[$post_type]['post_id_'.$post_id] = $post_markers_object;
						
				update_option('cspm_markers_array', $markers_object);
							
			}
			
		}
		
		
		/**
		 * Display the StreetView map of a location
		 * Note: No carousel used
		 *
		 * @since 2.7 
		 */		
		function cspm_streetview_map_shortcode($atts){
			
			extract( shortcode_atts( array(
			  'post_id' => '',
			  'center_at' => '',
			  'height' => '100%',
			  'width' => '100%',
			  'zoom' => 1,			  
			  'use_in_tab' => 'no',
			  'hide_empty' => 'yes', //@since 2.7.1
			), $atts, 'cspm_streetview_map' ) ); 
			
			$post_id = esc_attr($post_id);
					
			/**
			 * Get the current post ID */
			 
			if(empty($post_id)){
			
				global $post;
				
				$post_id = $post->ID;
				
			}
			
			$map_id = 'streetview_'.$post_id;
			
			/**
			 * Get the center point */
			 
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
			
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
					
					/**
					 * Get lat and lng data */
					 
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
					
				}else{
						
					/**
					 * Get lat and lng data */
					 
					$centerLat = get_post_meta($center_point, CSPM_LATITUDE_FIELD, true);
					$centerLng = get_post_meta($center_point, CSPM_LONGITUDE_FIELD, true);
			
				}
				
			}else{
					
				/**
				 * Get lat and lng data */
				 
				$centerLat = get_post_meta($post_id, CSPM_LATITUDE_FIELD, true);
				$centerLng = get_post_meta($post_id, CSPM_LONGITUDE_FIELD, true);
			
			}
			
			$latLng = '"'.$centerLat.','.$centerLng.'"';	
					
			/**
			 * Execute the map when there's or when there's no LatLng coordinates to display 
			 * & when the user chooses to display the map even when it's empty
			 * @since 2.7.1 */
			 					 
			if((!empty($centerLat) && !empty($centerLng)) || (empty($centerLat) && empty($centerLng)) && $hide_empty == 'no'){						
						
				?>
				
				<script type="text/javascript">
				
					jQuery(document).ready(function($){ 
						
						/**
						 * init plugin map */
						 
						var plugin_map_placeholder = 'div#codespacing_progress_map_streetview_<?php echo $map_id; ?>';
						var plugin_map = $(plugin_map_placeholder);
						
						/**
						 * Activate the new google map visual */
						 
						google.maps.visualRefresh = true;
						
						var map_options = { center:[<?php echo $centerLat; ?>, <?php echo $centerLng; ?>],
											zoom: 14,
											streetViewControl: true,
										  };
						
						var map_id = 'streetview_<?php echo $map_id ?>';
						
						_CSPM_MAP_RESIZED[map_id] = 0;
						
						/**
						 * Create the map */
						 
						plugin_map.gmap3({	
							map:{
								options: map_options,
							},						
							streetviewpanorama:{
								options:{
									container: plugin_map,
									opts:{
										position: [<?php echo $centerLat; ?>, <?php echo $centerLng; ?>],
										visible: true,
										pov: {
											heading: 34,
											pitch: 10,
											zoom: <?php echo esc_attr($zoom); ?>
										}
									}
								}
							}
						});										
	
						/**
						 * Resolve a problem of Google Maps & jQuery Tabs */
						 
						<?php if(esc_attr($use_in_tab) == 'yes' || $this->map_in_tab == 'yes'){ ?>					
						$(plugin_map_placeholder+':visible').livequery(function(){
							if(_CSPM_MAP_RESIZED[map_id] <= 1){ /** 0 is for the first loading, 1 is when the user clicks the map tab */
								cspm_center_map_at_point(plugin_map, <?php echo $centerLat; ?>, <?php echo $centerLng; ?>, 'resize');
								_CSPM_MAP_RESIZED[map_id]++;
							}								
						});
						<?php } ?>
						
					});
				
				</script> 
				
				<?php
				
				$output = '<div style="width:'.esc_attr($width).'; height:'.esc_attr($height).';">';
		
					/**
					 * Map */
					 
					$output .= '<div id="codespacing_progress_map_streetview_'.$map_id.'" style="width:100%; height:100%"></div>';
				
				$output .= '</div>';		
				
				return $output;

			}else return '';
			
		}
		  
			
	   	/**
		 * Display a static map that show's one or more locations
		 * Note: No carousel used
		 *
		 * @since 2.0 
		 */
		function cspm_static_map_shortcode($atts){
			
			extract( shortcode_atts( array(
			  'post_ids' => '',
			  'center_at' => '',
			  'height' => '100%',
			  'width' => '100%',
			  'zoom' => 13,
			  'show_overlay' => 'yes',
			  'show_secondary' => 'yes',
			  'map_style' => '',
			  'initial_map_style' => esc_attr($this->initial_map_style),
			  'infobox_type' => $this->infobox_type,
			  'use_in_tab' => 'no', //@since 2.6.1
			  'hide_empty' => 'yes', //@since 2.7.1
			), $atts, 'codespacing_static_map' ) ); 
			
			$post_ids = esc_attr($post_ids);
			
			$post_ids_array = array();
					
			/**
			 * Get the given post ID */
			 
			if(!empty($post_ids)){
				
				$post_ids_array = explode(',', $post_ids);			
			
			/**
			 * Get the current post ID */
			 
			}else{
			
				global $post;
				
				$post_ids_array[] = $post->ID;
				
			}
			
			$map_id = implode('', $post_ids_array);
			
			/**
			 * Get the center point */
			 
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
			
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
					
					/**
					 * Get lat and lng data */
					 
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
					
				}else{
						
					/**
					 * Get lat and lng data */
					 
					$centerLat = get_post_meta($center_point, CSPM_LATITUDE_FIELD, true);
					$centerLng = get_post_meta($center_point, CSPM_LONGITUDE_FIELD, true);
			
				}
				
			}else{
					
				/**
				 * Get lat and lng data */
				 
				$centerLat = get_post_meta($post_ids_array[0], CSPM_LATITUDE_FIELD, true);
				$centerLng = get_post_meta($post_ids_array[0], CSPM_LONGITUDE_FIELD, true);
			
			}
			
			$latLng = '"'.$centerLat.','.$centerLng.'"';	
			
			/**
			 * Map Styling */
			 
			$this_map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
							
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				/**
				 * Include the map styles array	*/				 
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this_map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			?>
			
			<script type="text/javascript">
			
				jQuery(document).ready(function($){ 
					
					/**
					 * init plugin map */
					 
					var plugin_map_placeholder = 'div#codespacing_progress_map_static_<?php echo $map_id; ?>';
					var plugin_map = $(plugin_map_placeholder);
					
					/**
					 * Activate the new google map visual */
					 
					google.maps.visualRefresh = true;
					
					var map_options = { center:[<?php echo $centerLat; ?>, <?php echo $centerLng; ?>],
										zoom: <?php echo esc_attr($zoom); ?>,
										scrollwheel: false,
										disableDoubleClickZoom: true,
										zoomControl: false,
										panControl: false,
										mapTypeControl: false,
										streetViewControl: false,
										draggable: false,							
									  };
					
					/**
					 * The initial map style */
					 
					var initial_map_style = "<?php echo $initial_map_style; ?>";
					
					<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
													
						var map_options = $.extend({}, map_options, map_type_id);
						
					<?php }else{ ?>
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
													
						var map_options = $.extend({}, map_options, map_type_id);
						
					<?php } ?>
					
					<?php $show_infobox = (esc_attr($show_overlay) == 'yes' && $this->show_infobox == 'true') ? 'true' : 'false'; ?>

					var json_markers_data = [];
					
					var map_id = 'static_<?php echo $map_id ?>';
					
					var infobox_div = $('div.cspm_infobox_container.cspm_infobox_'+map_id);				
					
					var show_infobox = '<?php echo $show_infobox; ?>';
					var infobox_type = '<?php echo esc_attr($infobox_type); ?>';
					var infobox_display_event = '<?php echo $this->infobox_display_event; ?>';
					
					_CSPM_MAP_RESIZED[map_id] = 0;
					
					post_ids_and_categories[map_id] = {};
					post_lat_lng_coords[map_id] = {};
					post_ids_and_child_status[map_id] = {}
					
					cspm_bubbles[map_id] = [];
					cspm_child_markers[map_id] = [];
					cspm_requests[map_id] = [];
	
					<?php 
					
					/**
					 * [is_latlng_empty] Whether the post has a LatLng coordinates. Usefull to use with [hide_empty] to hide the map when the user wants to.
					 * @since 2.7.1 */
					 
					$is_latlng_empty = true;
					
					/**
					 * Count items */
					 
					$count_post = count($post_ids_array);
					
					if($count_post > 0){
			
						$i = 1;
						
						$secondary_latlng_array = array();
						
						/**
						 * Loop throught items */
						 
						foreach($post_ids_array as $post_id){
							
							/**
							 * Get lat and lng data */
							 
							$lat = get_post_meta($post_id, CSPM_LATITUDE_FIELD, true);
							$lng = get_post_meta($post_id, CSPM_LONGITUDE_FIELD, true);
						
							/**
							 * Show items only if lat and lng are not empty */
							 
							if(!empty($lat) && !empty($lng)){
								
								/**
								 * Set [is_latlng_empty] to "false" to make sure that the map cannot be empty 
								 * @since 2.7.1 */
								 
								$is_latlng_empty = false;
										
								$marker_img_array = apply_filters('cspm_bubble_img', wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'cspacing-marker-thumbnail' ), $post_id);
								$marker_img = isset($marker_img_array[0]) ? $marker_img_array[0] : '';
	
								/**
								 * 1. Get marker category */
								 
								$post_categories = wp_get_post_terms($post_id, $this->marker_taxonomies, array("fields" => "ids"));
								$implode_post_categories = (count($post_categories) == 0) ? 0 : implode(',', $post_categories);
								
								/**
								 * 2. Get marker image */
								 
								$marker_img_by_cat = $this->cspm_get_marker_img(
									array(
										'post_id' => $post_id,
										'tax_name' => $this->marker_taxonomies,
										'term_id' => (isset($post_categories[0])) ? $post_categories[0] : '',
									)
								);
								
								/**
								 * 3. Get marker image size for Retina display */
								 
								$marker_img_size = $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat));
								
								$secondary_latlng = get_post_meta($post_id, CSPM_SECONDARY_LAT_LNG_FIELD, true);
									
								if(!empty($secondary_latlng) && esc_attr($show_secondary) == "yes")
									$secondary_latlng_array[$post_id] = array('latlng' => $secondary_latlng,
																			  'marker_img' => $marker_img,
																			  'post_categories' => $implode_post_categories,
																			  'map_id' => $map_id,
																			  'marker_img_size' => $marker_img_size
																			 ); ?>
																
								/**
								 * Create the pin object */
								 
								var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', 'no');
								json_markers_data.push(marker_object); <?php 
								
								$i++;			
								
							}
									
						} 
						
						
						/**
						 * Secondary Lats & longs */						 
						
						if(count($secondary_latlng_array) > 0){
							
							$i = 0;
							
							foreach($secondary_latlng_array as $key => $single_latlng){
								
								$post_id = $key;
								$lats_lngs = explode(']', $single_latlng['latlng']);	
								
								foreach($lats_lngs as $single_coordinate){
								
									$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
									$coordinates = explode(',', $strip_coordinates);
									
									if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
										
										$lat = $coordinates[0];
										$lng = $coordinates[1]; ?>
																
										/**
										 * Create the child pin object */
										 
										var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $single_latlng['post_categories']; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $single_latlng['marker_img_size']; ?>', 'yes_<?php echo $i; ?>');
										json_markers_data.push(marker_object); <?php 
										
										$lat = $lng = '';
										
										$i++;
									
									} 
									
								}
								
							}
								
						}
						
					}
					
					/**
					 * Execute the map when there's or when there's no LatLng coordinates to display 
					 * & when the user chooses to display the map even when it's empty
					 * @since 2.7.1 */
					 					 
					if(!$is_latlng_empty || $is_latlng_empty && $hide_empty == 'no'){						
						
						?>
						
						/**
						 * Create the map */
						 
						plugin_map.gmap3({	
								  
							map:{
								options: map_options,
								onces: {
									tilesloaded: function(){
										plugin_map.gmap3({ 
											marker:{
												values: json_markers_data
											}
										});
														
										/**
										 * Show the bubbles after the map load */
										 
										setTimeout(function(){
											if(json_markers_data.length > 0 && show_infobox == 'true')
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'static_'.$map_id); ?>', infobox_type, 'no');
										}, 1000);					
		
									}
								}
							},
							
							<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?>
								styledmaptype:{
									id: "custom_style",
									styles: <?php echo $map_styles[$this_map_style]['style']; ?>
								}
							<?php } ?>
																	
						});	
						
						/**
						 * Center the Map on screen resize */
						 
						<?php if(!empty($centerLat) && !empty($centerLng)){ ?>						
						
							/**
							 * Store the window width */
							
							var windowWidth = $(window).width();
		
							$(window).resize(function(){
								
								/**
								 * Check window width has actually changed and it's not just iOS triggering a resize event on scroll */
								 
								if ($(window).width() != windowWidth) {
						
									/**
									 * Update the window width for next time */
									 
									windowWidth = $(window).width();
			
									setTimeout(function(){
										
										var latLng = new google.maps.LatLng (<?php echo $centerLat; ?>, <?php echo $centerLng; ?>);																														
										
										var map = plugin_map.gmap3("get");
										
										if(typeof map.panTo === 'function')
											map.panTo(latLng);
											
										if(typeof map.setCenter === 'function')
											map.setCenter(latLng);
												
									}, 500);
									
								}
								
							});
							
						<?php } ?>
						
						/**
						 * Resolve a problem of Google Maps & jQuery Tabs */
						 
						<?php if(esc_attr($use_in_tab) == 'yes' || $this->map_in_tab == 'yes'){ ?>					
						
							$(plugin_map_placeholder+':visible').livequery(function(){
								
								if(_CSPM_MAP_RESIZED[map_id] <= 1){ /* 0 is for the first loading, 1 is when the user clicks the map tab */
									cspm_center_map_at_point(plugin_map, <?php echo $centerLat; ?>, <?php echo $centerLng; ?>, 'resize');
									_CSPM_MAP_RESIZED[map_id]++;
								}
								
								/**
								 * Show the bubbles after the map load */
								 
								setTimeout(function(){
									if(json_markers_data.length > 0 && show_infobox == 'true')
										cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'static_'.$map_id); ?>', infobox_type, 'no');
								}, 1000);	
												
							});
						
						<?php } ?>
					
					<?php } /* End if($is_latlng_empty ...) */ ?>					
					
				});
			
			</script> 
			
			<?php
								
			/**
			 * Execute the map when there's or when there's no LatLng coordinates to display 
			 * & when the user chooses to display the map even when it's empty
			 * @since 2.7.1 */		
			 			 
			if(!$is_latlng_empty || $is_latlng_empty && $hide_empty == 'no'){										

				$output = '<div style="width:'.esc_attr($width).'; height:'.esc_attr($height).';">';
		
					/**
					 * Map */
					 
					$output .= '<div id="codespacing_progress_map_static_'.$map_id.'" style="width:100%; height:100%;"></div>';
				
				$output .= '</div>';
				
				return $output;
				
			}else return '';
			
		}
		
		
	   /**
		* Display a light map that show's one or more locations
		* Note: No carousel used
		*
		* @since 2.0 
		*/
		function cspm_light_map_shortcode($atts){
			
			extract( shortcode_atts( array(
			  'post_ids' => '',
			  'center_at' => '',
			  'height' => '100%',
			  'width' => '100%',
			  'zoom' => 13,
			  'show_overlay' => 'yes',
			  'show_secondary' => 'yes',
			  'map_style' => '',
			  'initial_map_style' => esc_attr($this->initial_map_style),
			  'infobox_type' => $this->infobox_type,
			  'use_in_tab' => 'no', //@since 2.6.1
			  'hide_empty' => 'yes', //@since 2.7.1
			), $atts, 'codespacing_light_map' ) ); 
			
			$post_ids = esc_attr($post_ids);
			
			$post_ids_array = array();
			
			/**
			 * Get the given post id */
			 
			if(!empty($post_ids)){
				
				$post_ids_array = explode(',', $post_ids);			
			
			/**
			 * Get the current post id */
			 
			}else{
			
				global $post;
				
				$post_ids_array[] = $post->ID;
				
			}
			
			$map_id = implode('', $post_ids_array);
			
			/**
			 * Get the center point */
			 
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
				
				/**
				 * If the center point is Lat&Lng coordinates */
				 
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
					
					/**
					 * Get lat and lng data */
					 
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
				
				/**
				 * If the center point is a post id */
				 
				}else{
						
					/**
					 * Get lat and lng data */
					 
					$centerLat = get_post_meta($center_point, CSPM_LATITUDE_FIELD, true);
					$centerLng = get_post_meta($center_point, CSPM_LONGITUDE_FIELD, true);
			
				}
				
			}else{
					
				/**
				 * Get lat and lng data */
				 
				$centerLat = get_post_meta($post_ids_array[0], CSPM_LATITUDE_FIELD, true);
				$centerLng = get_post_meta($post_ids_array[0], CSPM_LONGITUDE_FIELD, true);
			
			}
			
			$latLng = '"'.$centerLat.','.$centerLng.'"';										
									
			/**
			 *Map Styling */
			 
			$this_map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
							
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				/**
				 * Include the map styles array	*/
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this_map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			?>
			
			<script type="text/javascript">
			
				jQuery(document).ready(function($){ 
					
					/**
					 * init plugin map */
					 
					var plugin_map_placeholder = 'div#codespacing_progress_map_light_<?php echo $map_id; ?>';
					var plugin_map = $(plugin_map_placeholder);
					
					/**
					 * Load Map options */
					 
					var map_options = cspm_load_map_options(true, <?php echo $latLng; ?>, <?php echo esc_attr($zoom); ?>);
					
					/**
					 * Activate the new google map visual */
					 
					google.maps.visualRefresh = true;
					
					/**
					 * The initial map style */
					 
					var initial_map_style = "<?php echo $initial_map_style; ?>";
					
					/**
					 * Enhance the map option with the map types id of the style */
					 
					<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
						
						/**
						 * Map type control option */
						 
						var mapTypeControlOptions = {mapTypeControlOptions: {
														position: google.maps.ControlPosition.TOP_RIGHT,
														mapTypeIds: [google.maps.MapTypeId.ROADMAP,
																	 google.maps.MapTypeId.SATELLITE,
																	 google.maps.MapTypeId.TERRAIN,
																	 google.maps.MapTypeId.HYBRID,
																	 "custom_style"]				
													}};
													
						var map_options = $.extend({}, map_options, map_type_id, mapTypeControlOptions);
						
					<?php }else{ ?>
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
													
						var map_options = $.extend({}, map_options, map_type_id);
						
					<?php } ?>
					
					<?php $show_infobox = (esc_attr($show_overlay) == 'yes' && $this->show_infobox == 'true') ? 'true' : 'false'; ?>
					
					var json_markers_data = [];
					
					var map_id = 'light_<?php echo $map_id ?>';
					
					var infobox_div = $('div.cspm_infobox_container.cspm_infobox_'+map_id);				
					
					var show_infobox = '<?php echo $show_infobox; ?>';
					var infobox_type = '<?php echo esc_attr($infobox_type); ?>';
					var infobox_display_event = '<?php echo $this->infobox_display_event; ?>';
					
					_CSPM_MAP_RESIZED[map_id] = 0;
					
					post_ids_and_categories[map_id] = {};
					post_lat_lng_coords[map_id] = {};
					post_ids_and_child_status[map_id] = {}
					
					cspm_bubbles[map_id] = [];
					cspm_child_markers[map_id] = [];
					cspm_requests[map_id] = [];
					
					<?php 
					
					/**
					 * [is_latlng_empty] Whether the post has a LatLng coordinates. Usefull to use with [hide_empty] to hide the map when the user wants to.
					 * @since 2.7.1 */
					 
					$is_latlng_empty = true;
										
					/**
					 * Count items */
					 
					$count_post = count($post_ids_array);
					
					if($count_post > 0){
			
						$i = 1;
						
						$secondary_latlng_array = array();
						
						/**
						 * Loop throught items */
						 
						foreach($post_ids_array as $post_id){
							
							/**
							 * Get lat and lng data */
							 
							$lat = get_post_meta($post_id, CSPM_LATITUDE_FIELD, true);
							$lng = get_post_meta($post_id, CSPM_LONGITUDE_FIELD, true);
						
							/**
							 * Show items only if lat and lng are not empty */
							 
							if(!empty($lat) && !empty($lng)){
								
								/**
								 * Set [is_latlng_empty] to "false" to make sure that the map cannot be empty 
								 * @since 2.7.1 */
								 
								$is_latlng_empty = false;
								
								$marker_img_array = apply_filters('cspm_bubble_img', wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'cspacing-marker-thumbnail' ), $post_id);
								$marker_img = isset($marker_img_array[0]) ? $marker_img_array[0] : '';
	
								/**
								 * 1. Get marker category */
								 
								$post_categories = wp_get_post_terms($post_id, $this->marker_taxonomies, array("fields" => "ids"));
								$implode_post_categories = (count($post_categories) == 0) ? 0 : implode(',', $post_categories);
								
								/**
								 * 2. Get marker image */
								 
								$marker_img_by_cat = $this->cspm_get_marker_img(
									array(
										'post_id' => $post_id,
										'tax_name' => $this->marker_taxonomies,
										'term_id' => (isset($post_categories[0])) ? $post_categories[0] : '',
									)
								);

								/**
								 * 3. Get marker image size for Retina display */
								 
								$marker_img_size = $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat));
								
								$secondary_latlng = get_post_meta($post_id, CSPM_SECONDARY_LAT_LNG_FIELD, true);
									
								if(!empty($secondary_latlng) && esc_attr($show_secondary) == "yes")
									$secondary_latlng_array[$post_id] = array('latlng' => $secondary_latlng,
																			  'marker_img' => $marker_img,
																			  'post_categories' => $implode_post_categories,
																			  'map_id' => $map_id,
																			  'marker_img_size' => $marker_img_size
																			 ); ?>
																
								/**
								 * Create the pin object */
								 
								var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', 'no');
								json_markers_data.push(marker_object); <?php 
								
								$i++;			
								
							}
									
						} 
						
						/**
						 * Secondary Lats & longs */						 
						
						if(count($secondary_latlng_array) > 0){
							
							$i = 0;
							
							foreach($secondary_latlng_array as $key => $single_latlng){
								
								$post_id = $key;
								$lats_lngs = explode(']', $single_latlng['latlng']);	
								
								foreach($lats_lngs as $single_coordinate){
								
									$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
									$coordinates = explode(',', $strip_coordinates);
									
									if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
										
										$lat = $coordinates[0];
										$lng = $coordinates[1]; ?>
																
										/**
										 * Create the child pin object */
										 
										var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $single_latlng['post_categories']; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $single_latlng['marker_img_size']; ?>', 'yes_<?php echo $i; ?>');
										json_markers_data.push(marker_object); <?php 
										
										$lat = $lng = '';
										
										$i++;
									
									} 
									
								}
								
							}
								
						}
						
					}
								
					/**
					 * Execute the map when there's or when there's no LatLng coordinates to display 
					 * & when the user chooses to display the map even when it's empty
					 * @since 2.7.1 */					 
					 
					if(!$is_latlng_empty || $is_latlng_empty && $hide_empty == 'no'){ ?>
					
						/**
						 * Create the map */
						 
						plugin_map.gmap3({	
								  
							map:{
								options: map_options,
								onces: {
									tilesloaded: function(){
										
										plugin_map.gmap3({ 
											marker:{
												values: json_markers_data,																			
											}
										});
										
										<?php
										
										/**
										 * Show the Zoom control after the map load */
										 
										if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										
											$('div.codespacing_light_map_zoom_in_<?php echo $map_id ?>, div.codespacing_light_map_zoom_out_<?php echo $map_id ?>').show(); <?php 
										
										}
										
										?>
										
										if(json_markers_data.length > 0 && show_infobox == 'true'){
											setTimeout(function(){
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type, 'no');
											}, 1000);																
										}
										
									}
									
								},
								events:{
									zoom_changed: function(){
										setTimeout(function(){
											if(json_markers_data.length > 0 && show_infobox == 'true'){								
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type, 'no');
											}
										}, 1000);
									},
									idle: function(){
										setTimeout(function(){
											if(json_markers_data.length > 0 && show_infobox == 'true' && !cspm_is_panorama_active(plugin_map)){								
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type, 'no');
											}
										}, 1000);
									},				
									bounds_changed: function(){
										if(json_markers_data.length > 0 && show_infobox == 'true'){
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type, 'no');														
										}
									},
									drag: function(){
										if(json_markers_data.length > 0 && show_infobox == 'true'){							
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type, 'no');														
										}
									}
								}						
							},
							
							<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
								<?php $style_title = isset($map_styles[$this_map_style]['title']) ? $map_styles[$this_map_style]['title'] : $this->custom_style_name; ?>
								styledmaptype:{
									id: "custom_style",
									options:{
										name: "<?php echo $style_title; ?>",
										alt: "Show <?php echo $style_title; ?>"
									},
									styles: <?php echo $map_styles[$this_map_style]['style']; ?>
								}
							<?php } ?>
							
						});								
							
						/**
						 * Call zoom-in function */
						 
						cspm_zoom_in($('div.codespacing_light_map_zoom_in_<?php echo $map_id; ?>'), plugin_map);
					
						/**
						 * Call zoom-out function */
						 
						cspm_zoom_out($('div.codespacing_light_map_zoom_out_<?php echo $map_id; ?>'), plugin_map);
						
						/**
						 * Hide/Show UI Controls depending on the streetview visibility */
						
						var mapObject = plugin_map.gmap3('get');
						
						if(typeof mapObject.getStreetView === 'function'){
							
							var streetView = mapObject.getStreetView();
						
							google.maps.event.addListener(streetView, "visible_changed", function(){
								
								if(this.getVisible()){
									
									/**
									 * Hide the Zoom cotrol before the map load	 */
									 
									<?php if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										$('div.codespacing_light_map_zoom_in_<?php echo $map_id; ?>, div.codespacing_light_map_zoom_out_<?php echo $map_id; ?>').hide();
									<?php } ?>
									
									$('div.cspm_infobox_container').hide();
									
								}else{
									
									/**
									 * Show the Zoom cotrol after the map load */
									 
									<?php if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										$('div.codespacing_light_map_zoom_in_<?php echo $map_id; ?>, div.codespacing_light_map_zoom_out_<?php echo $map_id; ?>').show();
									<?php } ?>
									
									if(json_markers_data.length > 0 && show_infobox == 'true'){
										setTimeout(function(){
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type, 'no');														
										}, 200);
									}
								}
									
							});
							
						}
						
						/**
						 * Center the Map on screen resize */
						 
						<?php if(!empty($centerLat) && !empty($centerLng)){ ?>
						
							/**
							 * Store the window width */
							 
							var windowWidth = $(window).width();
		
							$(window).resize(function(){
								
								/**
								 * Check window width has actually changed and it's not just iOS triggering a resize event on scroll */
								 
								if ($(window).width() != windowWidth) {
						
									/**
									 * Update the window width for next time */
									 
									windowWidth = $(window).width();
			
									setTimeout(function(){
										
										var latLng = new google.maps.LatLng (<?php echo $centerLat; ?>, <?php echo $centerLng; ?>);							
										
										var map = plugin_map.gmap3("get");														
										
										if(typeof map.panTo === 'function')
											map.panTo(latLng);
											
										if(typeof map.setCenter === 'function')
											map.setCenter(latLng);
												
									}, 500);
									
								}
								
							});
							
						<?php } ?>
						
						/**
						 * Resolve a problem of Google Maps & jQuery Tabs */
						 
						<?php if(esc_attr($use_in_tab) == 'yes' || $this->map_in_tab == 'yes'){ ?>					
						$(plugin_map_placeholder+':visible').livequery(function(){
							if(_CSPM_MAP_RESIZED[map_id] <= 1){ /* 0 is for the first loading, 1 is when the user clicks the map tab */
								cspm_center_map_at_point(plugin_map, <?php echo $centerLat; ?>, <?php echo $centerLng; ?>, 'resize');
								_CSPM_MAP_RESIZED[map_id]++;
							}
							cspm_zoom_in_and_out(plugin_map);							
						});
						<?php } ?>
					
					<?php } /* End if($is_latlng_empty ...) */ ?>
					
				});
			
			</script> 
			
			<?php
								
			/**
			 * Execute the map when there's or when there's no LatLng coordinates to display 
			 * & when the user chooses to display the map even when it's empty
			 * @since 2.7.1 */		
			 			 
			if(!$is_latlng_empty || $is_latlng_empty && $hide_empty == 'no'){										

				$output = '<div style="width:'.esc_attr($width).'; height:'.esc_attr($height).'; position:relative;">';
				
					/**
					 * Zoom Control */					 
								
					if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){
					
						$output .= '<div class="codespacing_zoom_container">';
							$output .= '<div class="codespacing_light_map_zoom_in_'.$map_id.' cspm_zoom_in_control cspm_border_shadow cspm_border_top_radius" title="'.__('Zoom in', 'cspm').'">';
								$output .= '<img src="'.$this->zoom_in_icon.'" />';
							$output .= '</div>';
							$output .= '<div class="codespacing_light_map_zoom_out_'.$map_id.' cspm_zoom_out_control cspm_border_shadow cspm_border_bottom_radius" title="'.__('Zoom out', 'cspm').'">';
								$output .= '<img src="'.$this->zoom_out_icon.'" />';
							$output .= '</div>';
						$output .= '</div>';
			
					}
					
					/**
					 * Map */
								
					$output .= '<div id="codespacing_progress_map_light_'.$map_id.'" style="width:100%; height:100%;"></div>';
				
				$output .= '</div>';
				
				return $output;
			
			}else return '';
			
		}
		
		
	    /**
		* Display a light map with a static marker (Lat & Lng)
		* No carousel used
		*
		* @since 2.8
		*
		*/
		function cspm_static_marker_map_shortcode($atts){
			
			extract( shortcode_atts( array(
			
			  'map_id' => 'static_marker_map',
			  'latlng' => '',
			  'height' => '100%',
			  'width' => '100%',
			  'zoom' => 13,
			  'map_style' => '',
			  'initial_map_style' => esc_attr($this->initial_map_style),
			  'use_in_tab' => 'no'
			  
			), $atts, 'cs_static_marker_map' ) ); 						
			
			$map_id = esc_attr($map_id);
			
			$center_latlng = explode(',', str_replace(' ', '', $latlng));
			
			$lat = $center_latlng[0];
			$lng = $center_latlng[1];
			
			$latLng = '"'.$lat.','.$lng.'"';										
									
			// Map Styling
			$this_map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
							
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				// Include the map styles array	
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this_map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			?>
			
			<script>
			
				jQuery(document).ready(function($) { 
					
					/**
					 * init plugin map */
					 
					var plugin_map_placeholder = 'div#codespacing_progress_map_static_marker_map_<?php echo $map_id; ?>';
					var plugin_map = $(plugin_map_placeholder);
					
					/**
					 * Load Map options */
					 
					var map_options = cspm_load_map_options(true, <?php echo $latLng; ?>, <?php echo esc_attr($zoom); ?>);
					
					/**
					 * Activate the new google map visual */
					 
					google.maps.visualRefresh = true;
					
					/**
					 * The initial map style */
					 
					var initial_map_style = "<?php echo $initial_map_style; ?>";
					
					/**
					 * Enhance the map option with the map types id of the style */
					 
					<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
											
						/**
					 	 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
						
						/**
						 * Map type control option */
						 
						var mapTypeControlOptions = {mapTypeControlOptions: {
														position: google.maps.ControlPosition.TOP_RIGHT,
														mapTypeIds: [google.maps.MapTypeId.ROADMAP,
																	 google.maps.MapTypeId.SATELLITE,
																	 google.maps.MapTypeId.TERRAIN,
																	 google.maps.MapTypeId.HYBRID,
																	 "custom_style"]				
													}};
													
						var map_options = $.extend({}, map_options, map_type_id, mapTypeControlOptions);
						
					<?php }else{ ?>
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
													
						var map_options = $.extend({}, map_options, map_type_id);
						
					<?php } ?>
					
					var map_id = 'static_marker_<?php echo $map_id ?>';
					
					_CSPM_MAP_RESIZED[map_id] = 0;
					
					/**
					 * Create the map */
					 
					plugin_map.gmap3({	
							  
						map:{
							options: map_options,
							onces: {
								tilesloaded: function(){									
	
									plugin_map.gmap3({ 
										marker:{
											latLng: [<?php echo $lat; ?>,<?php echo $lng; ?>],
											options:{
												optimized: false,
												icon: new google.maps.MarkerImage("<?php echo $this->marker_icon; ?>"),
											},
										},
									});		
									
									<?php
									// Show the Zoom control after the map load		
									if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										jQuery('div.codespacing_static_marker_map_zoom_in_<?php echo $map_id ?>, div.codespacing_static_marker_map_zoom_out_<?php echo $map_id ?>').show(); <?php 
									}
									?>									
									
								}
								
							},
						},
						
						<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
							<?php $style_title = isset($map_styles[$this_map_style]['title']) ? $map_styles[$this_map_style]['title'] : $this->custom_style_name; ?>
							styledmaptype:{
								id: "custom_style",
								options:{
									name: "<?php echo $style_title; ?>",
									alt: "Show <?php echo $style_title; ?>"
								},
								styles: <?php echo $map_styles[$this_map_style]['style']; ?>
							}
						<?php } ?>
						
					});								
						
					/**
					 * Call zoom-in function */
					 
					cspm_zoom_in($('div.codespacing_static_marker_map_zoom_in_<?php echo $map_id; ?>'), plugin_map);
				
					/**
					 * Call zoom-out function */
					 
					cspm_zoom_out($('div.codespacing_static_marker_map_zoom_out_<?php echo $map_id; ?>'), plugin_map);
					
					/**
					 * Center the Map on screen resize */
					 
					<?php if(!empty($lat) && !empty($lng)){ ?>
					
						/**
						 * Store the window width */
						 
						var windowWidth = $(window).width();
	
						$(window).resize(function(){
							
							/**
							 * Check window width has actually changed and it's not just iOS triggering a resize event on scroll */
							 
							if ($(window).width() != windowWidth) {
					
								/**
								 * Update the window width for next time */
								 
								windowWidth = $(window).width();
		
								setTimeout(function(){
									
									var latLng = new google.maps.LatLng (<?php echo $lat; ?>, <?php echo $lng; ?>);							
									
									var map = plugin_map.gmap3("get");														
									
									if(typeof map.panTo === 'function')
										map.panTo(latLng);
										
									if(typeof map.setCenter === 'function')
										map.setCenter(latLng);
											
								}, 500);
								
							}
							
						});
						
					<?php } ?>
					
					/**
					 * Resolve a problem of Google Maps & jQuery Tabs */
					 
					<?php if(esc_attr($use_in_tab) == 'yes' || $this->map_in_tab == 'yes'){ ?>					
					jQuery(plugin_map_placeholder+':visible').livequery(function(){
						if(_CSPM_MAP_RESIZED[map_id] <= 1){ /* 0 is for the first loading, 1 is when the user clicks the map tab */
							cspm_center_map_at_point(plugin_map, <?php echo $lat; ?>, <?php echo $lng; ?>, 'resize');
							_CSPM_MAP_RESIZED[map_id]++;
						}
						cspm_zoom_in_and_out(plugin_map);							
					});
					<?php } ?>
					
				});
			
			</script> 
			
			<?php
			
			$output = '<div style="width:'.esc_attr($width).'; height:'.esc_attr($height).'; position:relative;">';
			
				/**
				 * Zoom Control */
							
				if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){
					
					$output .= '<div class="codespacing_zoom_container">';
						$output .= '<div class="codespacing_static_marker_map_zoom_in_'.$map_id.' cspm_zoom_in_control cspm_border_shadow cspm_border_top_radius" title="'.__('Zoom in', 'cspm').'">';
							$output .= '<img src="'.$this->zoom_in_icon.'" />';
						$output .= '</div>';
						$output .= '<div class="codespacing_static_marker_map_zoom_out_'.$map_id.' cspm_zoom_out_control cspm_border_shadow cspm_border_bottom_radius" title="'.__('Zoom out', 'cspm').'">';
							$output .= '<img src="'.$this->zoom_out_icon.'" />';
						$output .= '</div>';
					$output .= '</div>';
			
				}
				
				/**
				 * Map */
							
				$output .= '<div id="codespacing_progress_map_static_marker_map_'.$map_id.'" style="width:100%; height:100%;"></div>';
			
			$output .= '</div>';
			
			return $output;
			
		}
			
			
		/**
		 * Plugin's main map
		 */
		function cspm_main_map_shortcode($atts){
			
			/**
			 * Overide the default post_ids array by the shortcode atts post_ids */
			 
			extract( shortcode_atts( array(	
			
				'map_id' => 'initial',
				'post_ids' => '',
				'force_post_ids' => 'no',  //@since 2.8, whetear to force retreiving posts by the attribute 'post_ids' or to call the main query when 'post_ids' is empty				
				'hide_map' => 'no', //@since 2.8
				
				/**
				 * Query Settings */
				 		
				'post_type' => '',
				'post_status' => '', 
				'number_of_posts' => '',
				'tax_query' => '',
				'tax_query_field' => 'id', //@since 2.6.1
				'tax_query_relation' => '',
				'cache_results' => '',
				'update_post_meta_cache' => '',
				'update_post_term_cache' => '',
				'post_in' => '',
				'post_not_in' => '',
				'custom_fields' => '',
				'custom_field_relation' => '',
				'authors' => '',
				'orderby' => '',
				'orderby_meta_key' => '',
				'order' => '',
			
				/**
				 * Layout
				 * @since 2.8 */
				 
				'layout' => $this->main_layout,
			
				/**
				 * Map Settings */
				 				 
				'center_at' => '',	
				'zoom' => $this->zoom,
				'map_style' => '',
				'initial_map_style' => esc_attr($this->initial_map_style),
				'autofit' => $this->autofit, //@since 2.7
				'traffic_layer' => $this->traffic_layer, //@since 2.7
				'transit_layer' => $this->transit_layer, //@since 2.7.5
				'show_post_count' => 'yes',
				'show_secondary' => 'yes',
				'show_overlay' => 'yes',
				'use_in_tab' => 'no',
				
				/**
				 * Carousel */
				 
				'carousel' => 'yes',
				
				/**
				 * Faceted Search */
				 
				'faceted_search' => 'yes',
				'faceted_search_tax_slug' => esc_attr($this->marker_taxonomies),
				'faceted_search_tax_terms' => '',
				
				/**
				 * Search Form */
				 
				'search_form' => 'yes',
				
				/**
				 * Infobox */
				 
				'infobox_type' => $this->infobox_type, //@since 2.6.3
				
				/**
				 * Geotarget
				 * @since 2.7.4 */
				 
				'geo' => $this->geoIpControl,
				'show_user' => $this->show_user,
				'user_marker' => $this->user_marker_icon,
				'user_map_zoom' => $this->user_map_zoom,
				'user_circle' => $this->user_circle,
				
				/**
				 * KML Layers
				 * @since 2.7 */
				 
				'kml_file' => $this->kml_file,
				'suppressInfoWindows' => $this->suppressInfoWindows,
				'preserveViewport' => $this->preserveViewport,
				
				/**
				 * Overlays: Polyline, Polygon
				 * @since 2.7 */
				 
				'polyline_objects' => $this->polylines,
				'polygon_objects' => $this->polygons,
				
				/**
				 * [@optional_latlng] Wether we will display all posts event those with no Lat & Lng.
				 * Note: This is only used for the extension "List & Filter"
				 * @since 2.8 */				 
				
				'optional_latlng' => 'false',

			), $atts, 'codespacing_progress_map' ) ); 
										
			$map_id = esc_attr($map_id);
			$map_layout = esc_attr($layout);
			
			/**
			 * Get the terms to use in the faceted search.
			 * This will overide the default settings */
			 
			$faceted_search_tax_terms = (empty($faceted_search_tax_terms)) ? array() : explode(',', $faceted_search_tax_terms);
			
			/**
			 * Map Styling */
			 
			$this->map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
						
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				/**
				 *Include the map styles array */				 
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this->map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			do_action('cspm_before_main_map_query', $map_id, $atts); // @since 2.6.3
			
			/**
			 * If post ids being pased from the shortcode parameter @post_ids
			 * Check the format of the @post_ids value */
			 
			if(!empty($post_ids)){
				
				$query_post_ids = explode(',', $post_ids);	
					
			}else{
				
				/**
				 * The main query */
				 
				if(!empty($post_type)){
									
					$query_post_ids = $this->cspm_main_query(
						array(
							'post_type' => $post_type, 
							'post_status' => $post_status,
							'number_of_posts' => $number_of_posts, 
							'tax_query' => $tax_query,
							'tax_query_field' => $tax_query_field,
							'tax_query_relation' => $tax_query_relation, 
							'cache_results' => $cache_results, 
							'update_post_meta_cache' => $update_post_meta_cache,
							'update_post_term_cache' => $update_post_term_cache,
							'post_in' => $post_in,
							'post_not_in' => $post_not_in,
							'custom_fields' => $custom_fields,
							'custom_field_relation' => $custom_field_relation,
							'authors' => $authors,
							'orderby' => $orderby,
							'orderby_meta_key' => $orderby_meta_key,
							'order' => $order,
							'optional_latlng' => $optional_latlng,
						)
					);
				
				}elseif($force_post_ids == 'no'){
					
					$query_post_ids = $this->cspm_main_query();
																				 
				}else $query_post_ids = $this->cspm_main_query();
	
			}
				
			$post_type = !empty($post_type) ? esc_attr($post_type) : $this->post_type;
			$post_ids = apply_filters('cspm_main_map_post_ids', $query_post_ids, $map_id, $atts);
	
			/**
			 * Get the center point */
			 
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
				
				/**
				 * If the center point is Lat&Lng coordinates */
				 
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
					
					/**
					 * Get lat and lng data */
					 
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
					
				/**
				 * If the center point is a post id */
				 
				}else{
					
					/**
					 * Center the map on the first post in $post_ids */
					 
					if($center_point == "auto" && count($post_ids) > 0 && isset($post_ids[0]))
						$center_point = $post_ids[0];					
					
					/**
					 * Get lat and lng data */
					 
					$centerLat = get_post_meta($center_point, CSPM_LATITUDE_FIELD, true);
					$centerLng = get_post_meta($center_point, CSPM_LONGITUDE_FIELD, true);
					
			
				}
				
				/**
				 * The center point */
				 
				$center_point = array($centerLat, $centerLng);
			
			}else{
				
				/**
				 * The center point */
				 
				$center_point = explode(',', $this->center);
					
				/**
				 * Get lat and lng data */
				 
				$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
				$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
				
			}
							
			$latLng = '"'.$centerLat.','.$centerLng.'"';

			$zoom = esc_attr($zoom);
			$carousel = ($this->show_carousel == 'true' && esc_attr($carousel) == 'yes') ? 'yes' : 'no';
			$faceted_search = esc_attr($faceted_search);
			$search_form = esc_attr($search_form);
			
			/**
			 * Polyline PHP Objects
			 * @since 2.7 */
			
			$polylines = '';		
			
			if(!empty($polyline_objects) && is_array($polyline_objects))
				$polylines = $this->cspm_build_polyline_objects($polyline_objects);
			
			/**
			 * Polygon PHP Objects
			 * @since 2.7 */
			
			$polygons = '';		
			
			if(!empty($polygon_objects) && is_array($polygon_objects))
				$polygons = $this->cspm_build_polygon_objects($polygon_objects);
									
			?>

			<script type="text/javascript">
	
				jQuery(document).ready(function($) { 		
				
					var map_id = '<?php echo $map_id ?>';
					
					if(typeof _CSPM_DONE === 'undefined' || _CSPM_DONE[map_id] === true) 
						return;
					
					_CSPM_DONE[map_id] = false;
					_CSPM_MAP_RESIZED[map_id] = 0;
					
					/**
					 * Start displaying the Progress Bar loader */
					 
					if(typeof NProgress !== 'undefined'){
						
						NProgress.configure({
						  parent: 'div#codespacing_progress_map_div_'+map_id,
						  showSpinner: true
						});				
						
						NProgress.start();
						
					}
					
					/**
					 * @map_layout, Will contain the layout type of the current map.
					 * This variable was first initialized in "progress_map.js"!
					 * @since 2.8 */
										
					map_layout[map_id] = '<?php echo $map_layout; ?>';

					/**
					 * @infobox_xhr, Will store the ajax requests in order to test if an ajax request ... 
					 * ... will overide "an already sent and non finished" request */
					
					var infobox_xhr; 
					
					/**
					 * @cspm_bubbles, Will store the marker bubbles (post_ids) in the viewport of the map */
					 
					cspm_bubbles[map_id] = []; 
					
					/**
					 * @cspm_child_markers, Will store the status of markers in order to define secondary markers from parent markers */
					 					 
					cspm_child_markers[map_id] = []; 
					
					/**
					 * Will store all the current ajax request (for infoboxes) in order to execute them when they all finish */
					
					cspm_requests[map_id] = []; 
									
					/**
					 * @post_ids_and_categories, Will store the markers categories in order to use with faceted search and to define the marker icon */
					 
					post_ids_and_categories[map_id] = {}; 
					
					/** 
					 * @post_lat_lng_coords, Will store the markers coordinates in order to use them when rewriting the map & the carousel */
					 
					post_lat_lng_coords[map_id] = {}; 
					
					/**
					 * @post_ids_and_child_status, Will store the markers and their child status in order to use when rewriting the carousel */
					 
					post_ids_and_child_status[map_id] = {} 
					
					/**
					 * @json_markers_data, Will store the markers objects */
					 
					var json_markers_data = [];

					/**
					 * init plugin map */
					 
					var plugin_map_placeholder = 'div#codespacing_progress_map_div_'+map_id;
					var plugin_map = $(plugin_map_placeholder);
					
					/**
					 * Load Map options */
					 
					<?php if(!empty($center_at)){ ?>
						var map_options = cspm_load_map_options(false, <?php echo $latLng; ?>, <?php echo $zoom; ?>);
					<?php }else{ ?>
						var map_options = cspm_load_map_options(false, null, <?php echo $zoom; ?>);
					<?php } ?>
					
					/**
					 * Activate the new google map visual */
					 
					google.maps.visualRefresh = true;				

					/**
					 * The initial map style */
					 
					var initial_map_style = "<?php echo $initial_map_style; ?>";
					
					/**
					 * Enhance the map option with the map type id of the style */
					 
					<?php if(count($map_styles) > 0 && $this->map_style != 'google-map' && isset($map_styles[$this->map_style])){ ?> 
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
			
						/**
						 * Map type control option */
						 
						var mapTypeControlOptions = {mapTypeControlOptions: {
														position: google.maps.ControlPosition.TOP_RIGHT,
														mapTypeIds: [google.maps.MapTypeId.ROADMAP,
																	 google.maps.MapTypeId.SATELLITE,
																	 google.maps.MapTypeId.TERRAIN,
																	 google.maps.MapTypeId.HYBRID,
																	 "custom_style"]				
													}};
													
						var map_options = $.extend({}, map_options, map_type_id, mapTypeControlOptions);
						
					<?php }else{ ?>
											
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
						var map_options = $.extend({}, map_options, map_type_id);
						
					<?php } ?>				
	
					<?php 
					
					/** 
					 * Determine whether we'll remove the carousel or not.
					 * Note: In this plugin, a map without carousel is called "Light Map"! */
					 
					$light_map = ($map_layout == 'fullscreen-map' || $map_layout == 'fit-in-map' || $this->show_carousel == 'false' || $carousel == 'no') ? true : false; ?>
					
					/**
					 * The carousel dimensions & style */
					 
					<?php if(!$light_map && $this->items_view == "listview"){ ?>
					
						var item_width = parseInt(<?php echo $this->horizontal_item_width; ?>);										
						var item_height = parseInt(<?php echo $this->horizontal_item_height; ?>);
						var item_css = "<?php echo $this->horizontal_item_css; ?>";
						var items_background  = "<?php echo $this->items_background; ?>";
						
					<?php }elseif(!$light_map && $this->items_view == "gridview"){ ?>
					
						var item_width = parseInt(<?php echo $this->vertical_item_width; ?>);
						var item_height = parseInt(<?php echo $this->vertical_item_height; ?>);
						var item_css = "<?php echo $this->vertical_item_css; ?>";
						var items_background  = "<?php echo $this->items_background; ?>";
					

					<?php } ?>
					
					<?php 
					
					/**
					 * @polylines_of_post_ids (array) - This will hold the coordinates of all polylines builded from post IDs.
					 * @polygons_of_post_ids (array) - This will hold the coordinates of all polygons builded from post IDs.
					 * @since 2.7 */
					
					$polylines_of_post_ids = $polygons_of_post_ids = array();
					
					/**
					 * @markers_array (array) - Contain all the makers of all post types
					 * @markers_object (array) - Contain all the markers of a given post type */
					 
					$markers_array = get_option('cspm_markers_array');
					$markers_object = isset($markers_array[$post_type]) ? $markers_array[$post_type] : array();
	
					if($light_map){ ?> var light_map = true; <?php }else{ ?> var light_map = false; <?php } 
																
					/**
					 * Count items */
					 
					$count_post = count($post_ids);
						
					$m = $l = 0;
					
					if($count_post > 0){
						
						while($m < $count_post){
							
							$post_id = isset($markers_object['post_id_'.$post_ids[$m]]['post_id']) ? $markers_object['post_id_'.$post_ids[$m]]['post_id'] : '';
															
							$lat = isset($markers_object['post_id_'.$post_ids[$m]]['lat']) ? $markers_object['post_id_'.$post_ids[$m]]['lat'] : '';
							$lng = isset($markers_object['post_id_'.$post_ids[$m]]['lng']) ? $markers_object['post_id_'.$post_ids[$m]]['lng'] : '';						
							$is_child = 'no';
							$children_markers  = isset($markers_object['post_id_'.$post_ids[$m]]['children_markers']) ? $markers_object['post_id_'.$post_ids[$m]]['children_markers'] : array();
							
							if(!empty($post_id) && !empty($lat) && !empty($lng)){
								
								if($this->marker_cats_settings == 'true'){
									
									/**
									 * 1. Get marker category */
									 
									$post_categories = isset($markers_object['post_id_'.$post_ids[$m]]['post_tax_terms'][$faceted_search_tax_slug]) ? $markers_object['post_id_'.$post_ids[$m]]['post_tax_terms'][$faceted_search_tax_slug] : array();
									$implode_post_categories = (count($post_categories) == 0) ? '' : implode(',', $post_categories);
									
									/**
									 * 2. Get marker image */
									 
									$marker_img_by_cat = $this->cspm_get_marker_img(
										array(
											'post_id' => $post_id,
											'tax_name' => $this->marker_taxonomies,
											'term_id' => (isset($post_categories[0])) ? $post_categories[0] : '',
										)
									);

									/**
									 * 3. Get marker image size for Retina display */
									 
									$marker_img_size = $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat));
								
								}else{
									
									/**
									 * 1. Get marker category */
									 
									$post_categories = array();
									$implode_post_categories = '';
									
									/**
									 * 2. Get marker image */
									 
									$marker_img_by_cat = $this->cspm_get_marker_img(
										array(
											'post_id' => $post_id
										)
									);

									/**
									 * 3. Get marker image size for Retina display */
									 
									$marker_img_size = $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat));
								
								}
								
								?>
								
								/**
								 * Create the pin object */
								 								 
							    var marker_object = cspm_new_pin_object(<?php echo $l; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', '<?php echo $is_child; ?>');
								json_markers_data.push(marker_object);
																
								<?php 
								
								/**
								 * Create polylines/polygons
								 * @since 2.7 */
								 
								/**
								 * Check for Polylines builded from post IDs and convert the IDs to LatLng coordinates.
								 * @since 2.7 */
								  
								if(is_array($polylines) && array_key_exists('ids', $polylines)){
								
									/**
									 * Loop through all Polylines builded from post IDs */
									 
									foreach($polylines['ids'] as $single_polyline_id => $single_polyline_data){
										
										if(!empty($single_polyline_data['path'])){											
											
											/**
											 * Loop through Polyline post IDs and convert them to LatLng coordinates */
											 
											foreach($single_polyline_data['path'] as $path_post_id){
												
												/**
												 * If the post ID exists on the map, Save the post coordinates */
												 
												if($path_post_id == $post_id)
													$polylines_of_post_ids[$single_polyline_id][$path_post_id] = $lat.','.$lng;
												
											}
												
										}
										
									}
									
								}											
								
								/**
								 * Check for Polygons builded from post IDs and convert the IDs to LatLng coordinates.
								 * @since 2.7 */
								 
								if(is_array($polygons) && array_key_exists('ids', $polygons)){
								
									/**
									 * Loop through all Polygons builded from post IDs */
									 
									foreach($polygons['ids'] as $single_polygon_id => $single_polygon_data){
										
										if(!empty($single_polygon_data['path'])){											
											
											/**
											 * Loop through Polygon post IDs and convert them to LatLng coordinates */
											 
											foreach($single_polygon_data['path'] as $path_post_id){

												/**
												 * If the post ID exists on the map, Save the post coordinates */
												 
												if($path_post_id == $post_id)
													$polygons_of_post_ids[$single_polygon_id][$path_post_id] = $lat.','.$lng;
												
											}
												
										}
										
									}
									
								}											
								
								/**
								 * Proceed for the Child Markers */
								 
								$l++;

								if(count($children_markers) > 0 && esc_attr($show_secondary) == 'yes'){
									
									for($c=0; $c<count($children_markers); $c++){
										
										$post_id = isset($children_markers[$c]['post_id']) ? $children_markers[$c]['post_id'] : '';
										$lat = isset($children_markers[$c]['lat']) ? $children_markers[$c]['lat'] : '';
										$lng = isset($children_markers[$c]['lng']) ? $children_markers[$c]['lng'] : '';						
										$is_child = isset($children_markers[$c]['is_child']) ? $children_markers[$c]['is_child'] : '';									
							
										if(!empty($post_id) && !empty($lat) && !empty($lng)){ ?>

											/**
											 * Create the child pin object */
											 
											var marker_object = cspm_new_pin_object(<?php echo $l; ?>, '<?php echo $post_id.'-'.$c; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', '<?php echo $is_child; ?>');
											json_markers_data.push(marker_object);
											
											<?php
																
											$l++;	
																			
										}									
							
									}
									
								}
								 
							}
							
							$m++;
	
						}
						
					}
					
					$show_infoboxes = ($show_overlay == 'yes' && $this->show_infobox == 'true') ? 'true' : 'false';											
					$move_carousel_on_infobox_hover = (in_array('infobox_hover', $this->move_carousel_on)) ? 'true' : 'false';

					?>
	
					var infobox_div = $('div.cspm_infobox_container.cspm_infobox_'+map_id);			
					var show_infobox = '<?php echo $show_infoboxes; ?>';
					var infobox_type = '<?php echo esc_attr($infobox_type); ?>';
					var infobox_display_event = '<?php echo $this->infobox_display_event; ?>';
					var useragent = navigator.userAgent;
					var infobox_loaded = false;
					var clustering_method = false;
					var remove_infobox_on_mouseout = '<?php echo $this->remove_infobox_on_mouseout; ?>';
											
					/**
					 * [@polyline_values] - will store an Object of all available Polylines	
					 * [@polygon_values] - will store an Object of all available Polygons					 					 
					 * @since 2.7 */
					 
					var polyline_values = [];
					var polygon_values = [];
					
					<?php
					
					/**
					 * Build all Polyline JS objects
					 * @since 2.7 */
					 
					if(is_array($polylines)){
						
						/**
						 * Loop through all Polylines */
						 
						foreach($polylines as $polylines_type => $polylines_type_data){
							
							/**
							 * Loop through each polyline build from post IDs */
							 
							foreach($polylines_type_data as $ployline_id => $polyline_data){
								
								/**
								 * Build Polyline JS Object */
																	
								$polyline_geodesic = !empty($polyline_data['geodesic']) ? esc_attr($polyline_data['geodesic']) : 'false';
								$polyline_color = !empty($polyline_data['color']) ? esc_attr($polyline_data['color']) : '#189AC9';
								$polyline_opacity = !empty($polyline_data['opacity']) ? esc_attr($polyline_data['opacity']) : '1';
								$polyline_weight = !empty($polyline_data['weight']) ? esc_attr($polyline_data['weight']) : '2';
								$polyline_zindex = !empty($polyline_data['zindex']) ? esc_attr($polyline_data['zindex']) : '1'; 
								$polyline_visible = !empty($polyline_data['visible']) ? esc_attr($polyline_data['visible']) : ''; ?>
								
								var polyline_path = []; <?php
								
								$polyline_path = !empty($polyline_data['path']) ? $polyline_data['path'] : array();
								
								/**
								 * Post IDs Polylines */
								 
								if($polylines_type == 'ids'){
								
									foreach($polyline_path as $path_post_id){ 
										
										/**
										 * @polylines_of_post_ids - Already created inside marker objects loop */
										 
										if(isset($polylines_of_post_ids[$ployline_id][$path_post_id])){
										
											$post_id_latlng = $polylines_of_post_ids[$ployline_id][$path_post_id]; ?>
											
											polyline_path.push([<?php echo $post_id_latlng; ?>]); <?php
											
										}
										
									
									} 
								
								/**
							 	* LatLng coordinates Polylines */
							 	
								}elseif($polylines_type == 'latlng'){
									
									foreach($polyline_path as $latlng){ 
										
										if(count(explode(',', $latlng)) == 2){ ?>
											
											polyline_path.push([<?php echo $latlng; ?>]); <?php
											
										}
										
									}
									
								}
								
								?>
								
								var polyline_data = {										
									options:{
										path: polyline_path,
										strokeColor: '<?php echo esc_attr($polyline_color); ?>',
										strokeOpacity: <?php echo esc_attr($polyline_opacity); ?>,
										strokeWeight: <?php echo esc_attr($polyline_weight); ?>,
										geodesic: <?php if($polyline_geodesic == 'false'){ ?> false <?php }else{ ?> true <?php } ?>,
										zIndex: <?php echo esc_attr($polyline_zindex); ?>,
										visible: <?php if($polyline_visible == 'false'){ ?> false <?php }else{ ?> true <?php } ?>,									
									}										
								};
								
								polyline_values.push(polyline_data);
								
								<?php									
								
							}
							
						}
					
					}
					
					/**
					 * Build all Polygon JS objects
					 * @since 2.7 */
					 
					if(is_array($polygons)){
						
						/**
						 * Loop through all Polylines */
						 
						foreach($polygons as $polygons_type => $polygons_type_data){
							
							/**
							 * Loop through each polygon build from post IDs */
							 
							foreach($polygons_type_data as $polygon_id => $polygon_data){

								/**
								 * Build Polygon JS Object */
								
								$polygon_fill_color = !empty($polygon_data['fill_color']) ? esc_attr($polygon_data['fill_color']) : '#189AC9';
								$polygon_fill_opacity = !empty($polygon_data['fill_opacity']) ? esc_attr($polygon_data['fill_opacity']) : '1';									
								$polygon_geodesic = !empty($polygon_data['geodesic']) ? esc_attr($polygon_data['geodesic']) : 'false';
								$polygon_stroke_color = !empty($polygon_data['stroke_color']) ? esc_attr($polygon_data['stroke_color']) : '#189AC9';
								$polygon_stroke_opacity = !empty($polygon_data['stroke_opacity']) ? esc_attr($polygon_data['stroke_opacity']) : '1';
								$polygon_stroke_weight = !empty($polygon_data['stroke_weight']) ? esc_attr($polygon_data['stroke_weight']) : '2';
								//$polygon_stroke_position = !empty($polygon_data['stroke_position']) ? esc_attr($polygon_data['stroke_position']) : 'CENTER';
								$polygon_zindex = !empty($polygon_data['zindex']) ? esc_attr($polygon_data['zindex']) : '1'; 
								$polygon_visible = !empty($polygon_data['visible']) ? esc_attr($polygon_data['visible']) : ''; ?>
								
								var polygon_path = []; <?php
								
								$polygon_path = !empty($polygon_data['path']) ? $polygon_data['path'] : array();

								/**
								 * Post IDs Polylines */
								 
								if($polygons_type == 'ids'){
								
									foreach($polygon_path as $path_post_id){ 
										
										/**
										 * @polygons_of_post_ids - Already created inside marker objects loop */

										if(isset($polygons_of_post_ids[$polygon_id][$path_post_id])){
										
											$post_id_latlng = $polygons_of_post_ids[$polygon_id][$path_post_id]; ?>
											
											polygon_path.push([<?php echo $post_id_latlng; ?>]); <?php
											
										}
										
									
									} 
								
								/**
							 	* LatLng coordinates Polylines */
							 	
								}elseif($polygons_type == 'latlng'){
									
									foreach($polygon_path as $latlng){ 
										
										if(count(explode(',', $latlng)) == 2){ ?>
											
											polygon_path.push([<?php echo $latlng; ?>]); <?php
											
										}
										
									}
									
								}
								
								?>
								
								var polygon_data = {										
									options:{
										paths: polygon_path,
										geodesic: <?php if($polygon_geodesic == 'false'){ ?> false <?php }else{ ?> true <?php } ?>,
										zIndex: <?php echo esc_attr($polygon_zindex); ?>,
										visible: <?php if($polygon_visible == 'false'){ ?> false <?php }else{ ?> true <?php } ?>,
										strokeColor: '<?php echo esc_attr($polygon_stroke_color); ?>',
										strokeOpacity: <?php echo esc_attr($polygon_fill_opacity); ?>,
										strokeWeight: <?php echo esc_attr($polygon_stroke_weight); ?>,
										fillColor: '<?php echo esc_attr($polygon_fill_color); ?>',
										fillOpacity: <?php echo esc_attr($polygon_fill_opacity); ?>,
										/*strokePosition: '<?php //echo esc_attr($polygon_stroke_position); ?>',*/
									}										
								};

								polygon_values.push(polygon_data);
								
								<?php									
								
							}
							
						}
					
					}
										
					?>					
								
					/**
					 * Build the map */
					 
					plugin_map.gmap3({	
						map:{
							options: map_options,							
							onces: {
								tilesloaded: function(map){
																		
									var carousel_output = []; 

									plugin_map.gmap3({ 										
										marker:{
											values: json_markers_data,
											callback: function(markers){
												 
												<?php 
																								
												/**
												 * Autofit the map to contain all markers & clusters */

												if($autofit == 'true'){ ?>
												
													plugin_map.gmap3({
														get: {
															name: 'marker',
															all:  true,										
														},
														autofit:{}
													});
												
												<?php } ?>
												
												/**
												 * Build the carousel items */
												 
												if(!light_map){
													
													for(var i = 0; i < markers.length; i++){	

														var post_id = markers[i].post_id;
														var is_child = markers[i].is_child;
														var marker_position = markers[i].position;
														
														/**
														 * Convert the LatLng object to array */
														 
														var lat = marker_position.lat();
														var lng = marker_position.lng();											
													
														/**
														 * Create carousel items */
														 
														carousel_output.push('<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+(i+1)+'_'+map_id+' cspm_border_radius cspm_border_shadow" data-map-id="'+map_id+'" data-is-child="'+is_child+'" name="'+lat+'_'+lng+'" value="'+(i+1)+'" data-post-id="'+post_id+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; '+item_css+'">');
															carousel_output.push('<div class="cspm_spinner"></div>');							
														carousel_output.push('</li>');
														
														if(i == markers.length-1){
															$('ul#codespacing_progress_map_carousel_'+map_id).append(carousel_output.join(''));	
															cspm_init_carousel(null, map_id);
														}
														
													}																						
																																					
												}	
												
												<?php 
						
												/**
												 * Geo Targeting */
																		
												if(esc_attr($geo) == "true"){ ?>
													
													if((typeof NProgress !== 'undefined' && NProgress.done()) || typeof NProgress === 'undefined'){
														
														setTimeout(function(){
															
															<?php if(esc_attr($show_user) == 'true'){ ?> 
																var show_user_marker = true; 
															<?php }else{ ?>
																var show_user_marker = false;
															<?php } ?>
															
															cspm_geolocate(plugin_map, map_id, show_user_marker, '<?php echo esc_attr($user_marker); ?>', <?php echo esc_attr($user_circle); ?>, <?php echo esc_attr($user_map_zoom); ?>, false);															
															
														}, 1000);
														
													}
												
												<?php } ?>
																																	
												
											},											
											events:{
												mouseover: function(marker, event, elements){
													
													/**
													 * Display the single infobox */
													 
													if(show_infobox == 'true' && infobox_display_event == 'onhover')
														infobox_xhr = cspm_draw_single_infobox(plugin_map, map_id, infobox_div, infobox_type, marker, infobox_xhr, '<?php echo $carousel; ?>');
													
													<?php if(in_array('marker_hover', $this->move_carousel_on)){ ?>
													
														/**
														 * Apply the style for the active item in the carousel */
														 
														if(!light_map){	
															
															var post_id = marker.post_id;
															var is_child = marker.is_child;	
															var i = $('li[id='+map_id+'_list_items_'+post_id+'][data-is-child="'+is_child+'"]').attr('value');	
															
															cspm_call_carousel_item($('ul#codespacing_progress_map_carousel_'+map_id).data('jcarousel'), i);
															cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id, map_id);
														
														}
													
													<?php } ?>
													
												},	
												mouseout: function(marker, event, elements){

													/**
													 * Hide the infobox */
													 
													if(show_infobox == 'true' && (infobox_display_event == 'onhover' || infobox_display_event == 'onclick') && remove_infobox_on_mouseout == 'true'){
														
														infobox_div.addClass('cspm_animated fadeOutUp');					
														infobox_div.hide().removeClass('cspm_animated fadeOutUp');
														
													}
													
												},
												click: function(marker, event, elements){
													
													var latLng = marker.position;											

													/**
													 * Center the map on that marker */
													
													map.panTo(latLng);
													
													cspm_pan_map_to_fit_infobox(plugin_map, map_id, infobox_div);													
															
													/**
													 * Display the single infobox */
													 
													if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onclick'){
														setTimeout(function(){																										
															infobox_xhr = cspm_draw_single_infobox(plugin_map, map_id, infobox_div, infobox_type, marker, infobox_xhr, '<?php echo $carousel; ?>');
														}, 400);
													}
													
													<?php if(in_array('marker_click', $this->move_carousel_on)){ ?>						
													
														/**
														 * Apply the style for the active item in the carousel */
														 
														if(!light_map){	
															
															var post_id = marker.post_id;
															var is_child = marker.is_child;
															var i = $('li[id='+map_id+'_list_items_'+post_id+'][data-is-child="'+is_child+'"]').attr('value');
														
															cspm_call_carousel_item($('ul#codespacing_progress_map_carousel_'+map_id).data('jcarousel'), i);
															cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id, map_id);
														
														}
													
													<?php } ?>
													
													<?php 
													
													/**
													 * This will add hover/active style to a list item 
													 * Note: Used only for the extension "List & Filter"
													 * @since 2.8.2 */
													 
													if(esc_attr($optional_latlng) == 'true' && class_exists('ProgressMapList')){ ?>
														
														var post_id = marker.post_id;
	
														if(typeof cspml_animate_list_item == 'function')
															cspml_animate_list_item(map_id, post_id);
																													
													<?php } ?>
													
												}
											}
										}
									});									
									
									<?php
									
									/**
									 * Clustring markers */
									 
									if($this->useClustring == 'true'){ ?>
										clustering_method = true;
										var clusterer = cspm_clustering(plugin_map, map_id, light_map);<?php
									}
									
									/**
									 * Show the Zoom control after the map load */
									 
									if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										$('div.codespacing_map_zoom_in_'+map_id+', div.codespacing_map_zoom_out_'+map_id).show(); <?php 
									}
									
									/**
									 * Show the faceted search after the map load */
									 
									if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true"){ ?>
										$('div.faceted_search_btn#'+map_id).show(); <?php 
									}
								
									/**
									 * Show the search form after the map load */
									 
									if($search_form == "yes" && $this->search_form_option == "true"){ ?> $('div.search_form_btn#'+map_id).show(); <?php }
									
									if(!$light_map && $map_layout == "map-tglc-bottom"){ ?> $('div.toggle-carousel-bottom').show(); <?php } 
									
									if(!$light_map && $map_layout == "map-tglc-top"){ ?> $('div.toggle-carousel-top').show(); <?php }
									
									?>
									
									/**
									 * Draw infoboxes (onload event) */
									 
									if(json_markers_data.length > 0 && clustering_method == true && show_infobox == 'true' && infobox_display_event == 'onload'){			
										
										google.maps.event.addListenerOnce(clusterer, 'clusteringend', function(cluster) {																	
											setTimeout(function(){
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', $map_id, $move_carousel_on_infobox_hover); ?>', infobox_type, '<?php echo $carousel; ?>');
												infobox_loaded = true;
											}, 1000);																
										});	
										
									}else if(json_markers_data.length > 0 && clustering_method == false && show_infobox == 'true' && infobox_display_event == 'onload'){
										
										setTimeout(function(){
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', $map_id, $move_carousel_on_infobox_hover); ?>', infobox_type, '<?php echo $carousel; ?>');
											infobox_loaded = true;
										}, 1000);
										
									}else if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){
										
										infobox_loaded = true;
											
									}
									
									/**
									 * End the Progress Bar Loader */
									 	
									if(typeof NProgress !== 'undefined')
										NProgress.done();
									
								}
								
							},
							events:{
								click: function(){

									/**
									 * Remove single infobox on map click (onclick, onhover events) */
									 
									if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){										
										infobox_div.hide();
										infobox_div.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
											infobox_div.hide().removeClass('cspm_animated fadeOutUp');
										});
									}
									
								},
								idle: function(){								
									if(infobox_loaded && !cspm_is_panorama_active(plugin_map)){
										setTimeout(function(){
											if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){								
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', $map_id, $move_carousel_on_infobox_hover); ?>', infobox_type, '<?php echo $carousel; ?>');
											}
										}, 200);
									}
								},				
								bounds_changed: function(){
									if(json_markers_data.length > 0){
										if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){
											cspm_set_single_infobox_position(plugin_map, infobox_div);
										}else $('div.cspm_infobox_container').hide();
									}
								},
								drag: function(){
									if(json_markers_data.length > 0){
										if(show_infobox == 'true' && infobox_display_event != 'onload'){
											cspm_set_single_infobox_position(plugin_map, infobox_div);
										}else $('div.cspm_infobox_container').hide();
									}
								},
								center_changed: function(){
									setTimeout(function() {
										$('div[class^=cluster_posts_widget]').removeClass('flipInX');
										$('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
										setTimeout(function() {
											$('div.cluster_posts_widget_'+map_id).mCustomScrollbar("destroy");
										}, 500);
									}, 500);
								}
							}
						},					
						
						<?php 
						
						/**
						 * Draw Polylines
						 * @since 2.7
						 */
						
						if($this->draw_polyline == 'true'&& !empty($polyline_objects)){ ?>
				
							polyline:{
								values: polyline_values
							},
						
						<?php } ?>
						
						<?php 
						
						/**
						 * Draw Polygons
						 * @since 2.7
						 */
						
						if($this->draw_polygon == 'true' && !empty($polygon_objects)){ ?>

							polygon:{
								values: polygon_values
							},
						
						<?php } ?>
						
						<?php 
						
						/**
						 * Display KML Layers
						 * @since 2.7
						 */
						 
						if($this->use_kml == 'true'&& !empty($kml_file)){ ?>
							
							kmllayer:{
								options:{
									url: "<?php echo esc_attr($kml_file); ?>",
									opts:{
										suppressInfoWindows: <?php if($suppressInfoWindows == 'false'){ ?> false <?php }else{ ?> true <?php } ?>,																										
										preserveViewport: <?php if($preserveViewport == 'false'){ ?> false <?php }else{ ?> true <?php } ?>,
										screenOverlays: false,
									},
								},							
							},				
						
						<?php } ?>
						 
						<?php 
						
						/**
						 * Show the Traffic Layer
						 * @since 2.7
						 */
						
						if($traffic_layer == "true"){ ?>
							
							trafficlayer:{},
							
						<?php } ?>
						
						<?php 
						
						/**
						 * Show the Transit Layer
						 * @since 2.7.4
						 */
						
						if($transit_layer == "true"){ ?>
							
							transitlayer:{},
							
						<?php } ?>
						 
						<?php 
						
						/**
						 * Set the map style */
						
						if(count($map_styles) > 0 && $this->map_style != 'google-map' && isset($map_styles[$this->map_style])){ ?> 
							<?php $style_title = isset($map_styles[$this->map_style]['title']) ? $map_styles[$this->map_style]['title'] : $this->custom_style_name; ?>
							
							styledmaptype:{
								id: "custom_style",
								options:{
									name: "<?php echo $style_title; ?>",
									alt: "Show <?php echo $style_title; ?>"
								},
								styles: <?php echo $map_styles[$this->map_style]['style']; ?>
							},
							
						<?php } ?>
						 
						<?php 
						
						/**
						 * Echo the post count label */
						
						if(esc_attr($show_post_count) == 'yes' && $this->show_posts_count == 'yes'){ ?>
							
							<?php $widget_top = ($map_layout == "fullscreen-map-top-carousel" || $map_layout == "fit-in-map-top-carousel" || $map_layout == "m-con") ? '10%' : '80%'  ?>
							
							panel:{
								options:{
									content: '<div class="number_of_posts_widget cspm_border_shadow cspm_border_radius"><?php echo $this->cspm_posts_count_clause($l, $map_id); ?></div>',
									middle: true,
									center: true,
									top: '<?php echo $widget_top; ?>',
									right: false,
									bottom: false,
									left:'70%'
								}
							},
							
						<?php } ?>	
										
					});		
					
					/**
					 * Hide/Show UI Controls depending on the streetview visibility */
					
					var mapObject = plugin_map.gmap3('get');
					
					if(typeof mapObject.getStreetView === 'function'){
												
						var streetView = mapObject.getStreetView();
					
						google.maps.event.addListener(streetView, "visible_changed", function(){
							
							if(this.getVisible()){
								
								<?php 
							
								/**
								 * Hide the Zoom cotrol before the map load	*/
								 								
								if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
									$('div.codespacing_map_zoom_in_'+map_id+', div.codespacing_map_zoom_out_'+map_id).hide();
								<?php } ?>
								 
								<?php 
																
								/**
								 * Hide the faceted search before the map load */

								if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true"){ ?>
									$('div.faceted_search_btn#'+map_id).hide();
								<?php } ?>
								 
								<?php 
																
								/**
								 * Hide the search form before the map load	*/

								if($search_form == "yes" && $this->search_form_option == "true"){ ?>
									$('div.search_form_btn#'+map_id).hide();
								<?php } ?>
								 
								<?php 
																
								/**
								 * Hide post count widget */

								if($this->show_posts_count == 'yes'){ ?>
									$('div.number_of_posts_widget').hide();
								<?php } ?>
								
								$('div.cspm_infobox_container').hide();
								 
								<?php 
			 					
								/**
								 * Hide GeoTargeting button
								 * @since 2.8 */

								if(esc_attr($geo) == 'true'){ ?>
									$('div.codespacing_geotarget_container').hide();
								<?php } ?>
						
							}else{
								 
								<?php 
																
								/**
								 * Show the Zoom cotrol after the map load */

								if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
									$('div.codespacing_map_zoom_in_'+map_id+', div.codespacing_map_zoom_out_'+map_id).show();
								<?php } ?>
								 
								<?php 
																
								/**
								 * Show the faceted search after the map load */

								if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true"){ ?>
									$('div.faceted_search_btn#'+map_id).show();
								<?php } ?>
								 
								<?php 
																
								/**
								 * Show the search form after the map load */

								if($search_form == "yes" && $this->search_form_option == "true"){ ?>
									$('div.search_form_btn#'+map_id).show();
								<?php } ?>
								 
								<?php 
																
								/**
								 * Show post count widget */

								if($this->show_posts_count == 'yes'){ ?>
									$('div.number_of_posts_widget').show();
								<?php } ?>
								 
								<?php 
			 					
								/**
								 * Show GeoTargeting button
								 * @since 2.8 */

								if(esc_attr($geo) == 'true'){ ?>
									$('div.codespacing_geotarget_container').show();
								<?php } ?>
						
								if(json_markers_data.length > 0 && infobox_loaded){
									setTimeout(function(){
										if(show_infobox == 'true' && infobox_display_event == 'onload'){								
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', $map_id, $move_carousel_on_infobox_hover); ?>', infobox_type, '<?php echo $carousel; ?>');
										}
									}, 200);
								}
							}
								
						});
						
					}
					 		
					<?php 
										
					/**
					 * Show error msg when center point is not correct */

					if($this->wrong_center_point){ ?>

						plugin_map.gmap3({
							panel:{
								options:{
									content: '<div class="error_widget"><?php esc_html_e('The map center of the map is incorrect. Please make sure that the Latitude & the Longitude in "Map Settings / Map center" are comma separated!', 'cspm'); ?></div>',
									top: '40%',
									left: '10%',
									right: '10%'								
								}
							}
						}); <?php 
					
					} 
					
					?>
					
					<?php 
					
					/**
					 * Custome zoom controls */
					 
					if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										
						/**
						 * Call zoom-in function */
						 
						cspm_zoom_in($('div.codespacing_map_zoom_in_'+map_id), plugin_map);
					
						/**
						 * Call zoom-out function */
						 
						cspm_zoom_out($('div.codespacing_map_zoom_out_'+map_id), plugin_map); <?php 
					
					} 
					
					?>
					
					<?php 		
					
					/**
					 * Fit map to its container
					 * @since 2.8 */
					
					if($map_layout == 'fit-in-map' || $map_layout == 'fit-in-map-top-carousel'){ ?>
						
						cspm_fitIn_map(map_id);
						$(window).resize(function(){ cspm_fitIn_map(map_id); }); <?php
					
					/**
					 * Fit map to screen size
					 * @since 2.8 */
					
					}else if($map_layout == 'fullscreen-map' || $map_layout == 'fullscreen-map-top-carousel'){ ?>
						
						cspm_fullscreen_map(map_id);
						$(window).resize(function(){ cspm_fullscreen_map(map_id); }); <?php
					
					}

					/**
					 * Resize Carousel when it's a "fullscreen" map or "fit in map"
					 * @since 2.8 */
					
					if($map_layout == 'm-con' || $map_layout == 'fullscreen-map-top-carousel' || $map_layout == 'fit-in-map-top-carousel'){ ?>
					
						cspm_carousel_width(map_id);
						$(window).resize(function(){ cspm_carousel_width(map_id); }); <?php
						
					}	
					
					?>
					 
					<?php 
										
					/**
					 * Recenter the Map on screen resize */

					if(isset($center_point[0]) && !empty($center_point[0]) && isset($center_point[1]) && !empty($center_point[1])){ ?>
						
						/**
						 * Store the window width */
						
						var windowWidth = $(window).width();
	
						$(window).resize(function(){
							
							/**
							 * Check window width has actually changed and it's not just iOS triggering a resize event on scroll */
							 
							if ($(window).width() != windowWidth) {
					
								/**
								 * Update the window width for next time */
								 
								windowWidth = $(window).width();
			
								setTimeout(function(){
									
									var latLng = new google.maps.LatLng (<?php echo $center_point[0]; ?>, <?php echo $center_point[1]; ?>);							
								
									var map = plugin_map.gmap3("get");	
									
									if(typeof map.panTo === 'function')
										map.panTo(latLng);
									
									if(typeof map.setCenter === 'function')
										map.setCenter(latLng);
										
								}, 500);
								
							}
							
						});

					<?php } ?> 
					
					/**
					 * Resolve a problem of Google Maps & jQuery Tabs */
					 
					<?php if(!$this->wrong_center_point && (esc_attr($use_in_tab) == 'yes' || $this->map_in_tab == 'yes')){ ?>					
						
						$(plugin_map_placeholder+':visible').livequery(function(){
							if(_CSPM_MAP_RESIZED[map_id] <= 1){ /* 0 is for the first time loading, 1 is when the user clicks the map tab */
								cspm_center_map_at_point(plugin_map, <?php echo $center_point[0]; ?>, <?php echo $center_point[1]; ?>, 'resize');
								_CSPM_MAP_RESIZED[map_id]++;
							}
							cspm_zoom_in_and_out(plugin_map);
						});

					<?php } ?>
					 
					<?php
					
					/**
					 * Add support for the Autocomplete for the address in the search form
					 * @since 2.8 */
					
					if($search_form == "yes" && $this->search_form_option == "true"){ ?>
								
						var input = document.getElementById('cspm_address_'+map_id);
						var autocomplete = new google.maps.places.Autocomplete(input); <?php 
					
					} 
					
					?>
						
					_CSPM_DONE[map_id] = true;
	
				});
			
			</script> 
			
			<?php
			
			/**
			 * @since 2.6.3 */
			 
			$atts_array = apply_filters(
				'cspm_main_map_output_atts',
				array(	
					'map_id' => $map_id,
					'post_ids' => implode(',', $post_ids),
					'force_post_ids' => $force_post_ids,
					'post_type' => $post_type,
					'post_status' => $post_status, 
					'number_of_posts' => $number_of_posts,
					'tax_query' => $tax_query,
					'tax_query_relation' => $tax_query_relation,
					'cache_results' => $cache_results,
					'update_post_meta_cache' => $update_post_meta_cache,
					'update_post_term_cache' => $update_post_term_cache,
					'post_in' => $post_in,
					'post_not_in' => $post_not_in,
					'custom_fields' => $custom_fields,
					'custom_field_relation' => $custom_field_relation,
					'authors' => $authors,
					'orderby' => $orderby,
					'orderby_meta_key' => $orderby_meta_key,
					'order' => $order,
					'faceted_search' => $faceted_search,
					'search_form' => $search_form,					
					'faceted_search_tax_slug' => $faceted_search_tax_slug,
					'faceted_search_tax_terms' => $faceted_search_tax_terms,	
					'geo' => esc_attr($geo),					
				),
				$atts
			);
				
			/**
			 * Carousel
			 * @since 2.6.3
			 * @updated 2.8 */
			 
			return apply_filters(
				'cspm_main_map_output', 
				$this->cspm_main_map_output(
					array(
						'map_id' => $map_id,
						'carousel' => $carousel,
						'faceted_search' => $faceted_search,
						'faceted_search_tax_slug' => $faceted_search_tax_slug,
						'faceted_search_tax_terms' => $faceted_search_tax_terms,
						'search_form' => $search_form,
						'show_infoboxes' => $show_infoboxes,
						'infobox_display_event' => $this->infobox_display_event,
						'map_layout' => $map_layout,
						'geo' => esc_attr($geo),
					)
				),
				$atts_array
			);
			
			return $output;
			
		}
		
		
		/**
		 * Display the carousel
		 *
		 * @since 2.6 
		 * @updated 2.8
		 */
		function cspm_main_map_output($atts = array()){
					
			$defaults = array(
				'map_id' => '',
				'carousel' => '',
				'faceted_search' => '',
				'faceted_search_tax_slug' => '',
				'faceted_search_tax_terms' => '',
				'search_form' => '',
				'show_infoboxes' => '',
				'infobox_display_event' => '',
				'map_layout' => '',
				'geo' => '',
			);
			
			extract(wp_parse_args($atts, $defaults));

			$layout_style = '';
			
			/**
			 * Define fixed/fullwidth layout height and width */
			 
			if($map_layout != 'fullscreen-map' && $map_layout != 'fit-in-map'){
	
				if($this->layout_type == 'fixed')
					$layout_style = "width:".$this->layout_fixed_width."px; height:".$this->layout_fixed_height."px;";
				else ($map_layout == "mu-cd" || $map_layout == "md-cu") ? $layout_style = "width:100%; height:".($this->layout_fixed_height+20)."px;" 
																		: $layout_style = "width:100%; height:".$this->layout_fixed_height."px;";
	
			}elseif($map_layout == 'fit-in-map'){ 
				
				$layout_style = "width:100%;";
				
			}elseif($map_layout == 'fullscreen-map'){
				
				$layout_style = "display:block; margin:0; padding:0; position:absolute; top:0; right:0; bottom:0; left:0; z-index:9999"; 
			
			}	
						
			$output = '';
			
			/**
			 * Plugin Container */
				
			$output .= '<div class="codespacing_progress_map_area" data-map-id="'.$map_id.'" data-show-infobox="'.$show_infoboxes.'" data-infobox-display-event="'.$infobox_display_event.'" style="'.$layout_style.'">';
				
				/**
				 * This is usefull to know the page template where the map is displayed in order
				 * to execute hooks or function by template page
				 * @since 2.7.5 */
				 
				if(is_single()){
					$queried_object = get_queried_object();
					$page_id = $queried_object->post_type;		
				}elseif(is_author()){
					$page_id = 'author';
				}else $page_id = get_the_ID();
				
				$output .= '<input type="hidden" name="cspm_map_page_id_'.$map_id.'" id="cspm_map_page_id_'.$map_id.'" value="'.$page_id.'" />';
				
				/**
				 * Plugin's Map */
											
				/* =============================== */
				/* ==== Map-Up, Carousel-Down ==== */
				/* =============================== */
				
				if($map_layout == "mu-cd"){
									
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					/**
					 * Detect Mobile browsers and adjust the map height depending on the result	*/
					 
					if(!$this->cspm_detect_mobile_browser()){
						
						$map_height = ($this->show_carousel == 'true' && $carousel == "yes") ? $this->layout_fixed_height - $carousel_height . 'px' : $this->layout_fixed_height . 'px';
						
					}else $map_height = $this->layout_fixed_height . 'px';
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_map_up_carousel_down_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
								
									
				/* =============================== */
				/* ==== Map-Down, Carousel-Up ==== */
				/* =============================== */
				
				}elseif($map_layout == "md-cu"){
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					/**
					 * Detect Mobile browsers and adjust the map height depending on the result	*/
					 
					if(!$this->cspm_detect_mobile_browser()){
						
						$map_height = ($this->show_carousel == 'true' && $carousel == "yes") ? $this->layout_fixed_height - $carousel_height . 'px' : $this->layout_fixed_height . 'px';
						
					}else $map_height = $this->layout_fixed_height . 'px';
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_map_down_carousel_up_layout($carousel_height, $map_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
								
									
				/* ================================== */
				/* ==== Map-Right, Carousel-Left ==== */
				/* ================================== */
				
				}elseif($map_layout == "mr-cl"){
					
					if($this->items_view == "listview"){
						
						$carousel_width = $this->horizontal_item_width + 8;
						
					}elseif($this->items_view == "gridview"){
						
						$carousel_width = $this->vertical_item_width + 8;
						
					}
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_map_right_carousel_left_layout($carousel_width, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
	
									
				/* ================================== */
				/* ==== Map-Left, Carousel-Right ==== */
				/* ================================== */
				
				}elseif($map_layout == "ml-cr"){
					
					if($this->items_view == "listview"){
						
						$carousel_width = $this->horizontal_item_width + 8;
						
					}elseif($this->items_view == "gridview"){
						
						$carousel_width = $this->vertical_item_width + 8;
						
					}
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_map_left_carousel_right_layout($carousel_width, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
									
				
				/* ====================== */
				/* ==== Only The Map ==== */
				/* ====================== */
				
				}elseif($map_layout == "fullscreen-map" || $map_layout == "fit-in-map"){
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_only_map_layout($map_id, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
									
				
				/* ============================================== */
				/* ==== Fullscreen Map/Fit in map & Carousel ==== */
				/* ============================================== */
				
				}elseif($map_layout == "fullscreen-map-top-carousel" || $map_layout == "fit-in-map-top-carousel"){
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_full_map_carousel_over_layout($map_id, $carousel, $faceted_search, $carousel_height, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
					
	
				/* ============================ */
				/* ==== Map, Carousel over ==== */
				/* ============================ */
				
				}elseif($map_layout == "m-con"){
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					$map_height = $this->layout_fixed_height . 'px';
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_map_up_carousel_over_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
					
	
				/* ======================================== */
				/* ==== Map, Carousel toggled from top ==== */
				/* ======================================== */
				
				}elseif($map_layout == "map-tglc-top"){
					
					$map_height = $this->layout_fixed_height . 'px';
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
						
					$output .= $this->cspm_map_toggle_carousel_top_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);                
					
	
				/* =========================================== */
				/* ==== Map, Carousel toggled from bottom ==== */
				/* =========================================== */
				
				}elseif($map_layout == "map-tglc-bottom"){
					
					$map_height = $this->layout_fixed_height . 'px';
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					/**
					 * Layout */
					 
					$output .= $this->cspm_map_toggle_carousel_bottom_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);                
										
				}
				
			$output .= '</div>';
			
			return $output;
			
		} 
		
		
		/**
		 * Build the Polyline PHP Objects
		 * @return - Array of all polylines
		 *
		 * @since 2.7 
		 */
		function cspm_build_polyline_objects($lines_segments){
			
			$polyline_paths = array();
			
			if(!empty($lines_segments) && is_array($lines_segments)){
				
				/**
				 * Loopt through all available Polylines */
				 
				foreach($lines_segments as $polyline_id => $single_line_segments){
					
					$line_segments_path = (array) $single_line_segments;
					
					$polyline_id = (isset($line_segments_path['tag_polyline_name'])) ? $line_segments_path['tag_polyline_name'] : '';
					$polyline_path = (isset($line_segments_path['tag_polyline_path'])) ? $line_segments_path['tag_polyline_path'] : '';
					
					if(!empty($polyline_id) && !empty($polyline_path)){
						
						$polyline_geodesic = (isset($line_segments_path['tag_polyline_geodesic'])) ? $line_segments_path['tag_polyline_geodesic'] : 'false';
						$polyline_strokeColor = (isset($line_segments_path['tag_polyline_strokeColor'])) ? $line_segments_path['tag_polyline_strokeColor'] : '#189AC9';
						$polyline_strokeOpacity = (isset($line_segments_path['tag_polyline_strokeOpacity'])) ? $line_segments_path['tag_polyline_strokeOpacity'] : '1';
						$polyline_strokeWeight = (isset($line_segments_path['tag_polyline_strokeWeight'])) ? $line_segments_path['tag_polyline_strokeWeight'] : '2';	
						$polyline_zIndex = (isset($line_segments_path['tag_polyline_zIndex'])) ? $line_segments_path['tag_polyline_zIndex'] : '1';				
						$polyline_visibility = (isset($line_segments_path['tag_polyline_visibility'])) ? $line_segments_path['tag_polyline_visibility'] : 'true';
						
						/**
						 * Check if the polyline segments are LatLng coordinate.
						 * If not, line segments must be post IDs. */
						 
						if(strpos($polyline_path, '],[') !== false){
						
							$explode_polyline_path = str_replace('],[', '|', $polyline_path);
							$polyline_paths['latlng'][$polyline_id] = array(
								'path' => explode('|', str_replace(array('[', ']'), '', $explode_polyline_path)),
								'geodesic' => $polyline_geodesic,
								'color' => $polyline_strokeColor,
								'opacity' => $polyline_strokeOpacity,
								'weight' => $polyline_strokeWeight,
								'zindex' => $polyline_zIndex,
								'visible' => $polyline_visibility,
							);		
							
						}else{
	
							$polyline_paths['ids'][$polyline_id] = array(
								'path' => explode(',', $polyline_path),
								'geodesic' => $polyline_geodesic,
								'color' => $polyline_strokeColor,
								'opacity' => $polyline_strokeOpacity,
								'weight' => $polyline_strokeWeight,
								'zindex' => $polyline_zIndex,
								'visible' => $polyline_visibility,
							);					
						
						}
					
					}
					
				}
				
			}
			
			return $polyline_paths;
			
		}
		

		/**
		 * Build the Polygon PHP Objects
		 * @return - Array of all polygons
		 * 
		 * @since 2.7 
		 */		 
		function cspm_build_polygon_objects($lines_segments){
			
			$polygon_paths = array();
			
			if(!empty($lines_segments) && is_array($lines_segments)){
				
				/**
				 * Loopt through all available Polylgons */
				 
				foreach($lines_segments as $polygon_id => $single_line_segments){
					
					$line_segments_path = (array) $single_line_segments;
					
					$polygon_id = (isset($line_segments_path['tag_polygon_name'])) ? $line_segments_path['tag_polygon_name'] : '';
					$polygon_path = (isset($line_segments_path['tag_polygon_path'])) ? $line_segments_path['tag_polygon_path'] : '';
					
					if(!empty($polygon_id) && !empty($polygon_path)){
						
						$polygon_fillColor = (isset($line_segments_path['tag_polygon_fillColor'])) ? $line_segments_path['tag_polygon_fillColor'] : '#189AC9';
						$polygon_fillOpacity = (isset($line_segments_path['tag_polygon_fillOpacity'])) ? $line_segments_path['tag_polygon_fillOpacity'] : '1';
						$polygon_geodesic = (isset($line_segments_path['tag_polygon_geodesic'])) ? $line_segments_path['tag_polygon_geodesic'] : 'false';
						$polygon_strokeColor = (isset($line_segments_path['tag_polygon_strokeColor'])) ? $line_segments_path['tag_polygon_strokeColor'] : '#189AC9';
						$polygon_strokeOpacity = (isset($line_segments_path['tag_polygon_strokeOpacity'])) ? $line_segments_path['tag_polygon_strokeOpacity'] : '1';
						$polygon_strokeWeight = (isset($line_segments_path['tag_polygon_strokeWeight'])) ? $line_segments_path['tag_polygon_strokeWeight'] : '2';	
						//$polygon_strokePosition = (isset($line_segments_path['tag_polygon_strokePosition'])) ? $line_segments_path['tag_polygon_strokePosition'] : 'CENTER';
						$polygon_zIndex = (isset($line_segments_path['tag_polygon_zIndex'])) ? $line_segments_path['tag_polygon_zIndex'] : '1';				
						$polygon_visibility = (isset($line_segments_path['tag_polygon_visibility'])) ? $line_segments_path['tag_polygon_visibility'] : 'true';
						
						/**
						 * Check if the polygon segments are LatLng coordinate.
						 * If not, line segments must be post IDs. */
						 
						if(strpos($polygon_path, '],[') !== false){
						
							$explode_polygon_path = str_replace('],[', '|', $polygon_path);
							$polygon_paths['latlng'][$polygon_id] = array(
								'path' => explode('|', str_replace(array('[', ']'), '', $explode_polygon_path)),
								'fill_color' => $polygon_fillColor,
								'fill_opacity' => $polygon_fillOpacity,
								'geodesic' => $polygon_geodesic,
								'stroke_color' => $polygon_strokeColor,
								'stroke_opacity' => $polygon_strokeOpacity,
								//'stroke_position' => $polygon_strokePosition,
								'stroke_weight' => $polygon_strokeWeight,
								'zindex' => $polygon_zIndex,
								'visible' => $polygon_visibility,
							);		
							
						}else{
	
							$polygon_paths['ids'][$polygon_id] = array(
								'path' => explode(',', $polygon_path),
								'fill_color' => $polygon_fillColor,
								'fill_opacity' => $polygon_fillOpacity,
								'geodesic' => $polygon_geodesic,
								'stroke_color' => $polygon_strokeColor,
								'stroke_opacity' => $polygon_strokeOpacity,
								//'stroke_position' => $polygon_strokePosition,
								'stroke_weight' => $polygon_strokeWeight,
								'zindex' => $polygon_zIndex,
								'visible' => $polygon_visibility,
							);					
						
						}
					
					}
					
				}
				
			}
			
			return $polygon_paths;
			
		}		
				
				
		/**
		 * Create the infobox of the marker
		 *
		 * @since 2.5 
		 * @updated 2.7 
		 */
		function cspm_infobox($infobox_type, $status, $map_id, $move_carousel_on_infobox_hover = 'true'){
			
			$output = '';
			
			if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble')
				$style = 'style="width:60px; height:60px;"';
				
			elseif($infobox_type == 'cspm_type1')
				$style = 'style="width:380px; height:120px;"';
				
			elseif($infobox_type == 'cspm_type2')
				$style = 'style="width:180px; height:180px;"';
				
			elseif($infobox_type == 'cspm_type3')
				$style = 'style="width:250px; height:50px;"';
				
			elseif($infobox_type == 'cspm_type4')
				$style = 'style="width:250px; height:50px;"';
				
			elseif($infobox_type == 'cspm_type5')
				$style = 'style="width:400px; height:300px;"';
				
			$output .= '<div class="cspm_infobox_container cspm_border_shadow cspm_infobox_'.$status.' cspm_infobox_'.$map_id.' '.$infobox_type.'" '.$style.' data-move-carousel="'.$move_carousel_on_infobox_hover.'">';
				$output .= '<div class="blue_cloud"></div>';
				$output .= '<div class="cspm_arrow_down '.$infobox_type.'"></div>';
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Draw the infobox content
		 *
		 * @since 2.5 
		 * @updated 2.7 
		 */
		function cspm_infobox_content(){
	
			$post_id = esc_attr($_POST['post_id']);
			$infobox_type = esc_attr($_POST['infobox_type']);
			$map_id = esc_attr($_POST['map_id']);
			$status = esc_attr($_POST['status']);
			$carousel = esc_attr($_POST['carousel']);			
			
			$no_title = array(); // Infoboxes to display with no title
			$no_link = array(); // Infobox to display whit no link
			$no_description = array('square_bubble', 'rounded_bubble', 'cspm_type2', 'cspm_type3', 'cspm_type4'); // Infoboxes to display with no description
			$no_image = array('cspm_type4'); // Infoboxes to display with no image
			
			if(!in_array($infobox_type, $no_title)) $item_title = apply_filters('cspm_custom_infobox_title', stripslashes_deep($this->cspm_items_title($post_id, $this->items_title)), $post_id); 
			if(!in_array($infobox_type, $no_description)) $item_description = apply_filters('cspm_custom_infobox_description', stripslashes_deep($this->cspm_items_details($post_id, $this->items_details)), $post_id);
			if(!in_array($infobox_type, $no_link)) $the_permalink = $this->cspm_get_permalink($post_id);
			
			if(!in_array($infobox_type, $no_image)){
				
				/**
				 * Infobox CSS style */
				 
				if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble')
					$parameter = array( 'style' => "width:50px; height:50px;" );
					
				elseif($infobox_type == 'cspm_type1')
					$parameter = array( 'style' => "width:160px; height:120px;" );
					
				elseif($infobox_type == 'cspm_type2')
					$parameter = array( 'style' => "width:180px; height:132px;" );
					
				elseif($infobox_type == 'cspm_type3' || $infobox_type == 'cspm_type5')
					$parameter = array( 'style' => "width:70px; height:50px;" );
					
				elseif($infobox_type == 'cspm_type4')
					$parameter = array();
				
				/**
				 * Get Infobox Image */
				 		
				if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble'){
					
					$infobox_thumb = get_the_post_thumbnail($post_id, 'cspacing-marker-thumbnail', $parameter);
					
				}elseif($infobox_type == 'cspm_type1'){
					
					$infobox_thumb = get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter);
					
				}else $infobox_thumb = get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter);
				
				if(empty($infobox_thumb))
					$infobox_thumb = get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter);

			}
			
			$post_thumbnail = apply_filters('cspm_infobox_thumb', $infobox_thumb, $post_id, $infobox_type, $parameter);
			
			$this->infobox_external_link = $this->cspm_get_setting('infoboxsettings', 'infobox_external_link', 'same_window');

			$target = ($this->infobox_external_link == 'new_window') ? ' target="_blank"' : ''; 
			$the_post_link = ($this->infobox_external_link == 'disable') ? $item_title : '<a href="'.$the_permalink.'" title="'.$item_title.'"'.$target.'>'.$item_title.'</a>'; 
			
			$output = '';
			
			$output .= '<div class="cspm_infobox_content_container '.$status.' infobox_'.$map_id.' '.$infobox_type.'" data-map-id="'.$map_id.'" data-post-id="'.$post_id.'" data-show-carousel="'.$carousel.'">';
				
				if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble'){
					
					$output .= '<div class="cspm_infobox_img">';
						$output .= ($this->infobox_external_link != 'disable') ? '<a href="'.$the_permalink.'" title="'.$item_title.'"'.$target.'>'.$post_thumbnail.'</a>' : $post_thumbnail;
					$output .= '</div>';
					$output .= '<div class="cspm_arrow_down '.$infobox_type.'"></div>';
					
				}elseif($infobox_type == 'cspm_type1'){
					
					$output .= '<div class="cspm_infobox_img">'.$post_thumbnail.'</div>';
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title">'.$the_post_link.'</div>';
						$output .= '<div class="description">'.$item_description.'</div>';
					$output .= '</div>';
					$output .= '<div style="clear:both"></div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}elseif($infobox_type == 'cspm_type2'){
									
					$output .= '<div class="cspm_infobox_img">'.$post_thumbnail.'</div>';
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title">'.$the_post_link.'</div>';
					$output .= '</div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}elseif($infobox_type == 'cspm_type3'){
									
					$output .= '<div class="cspm_infobox_img">'.$post_thumbnail.'</div>';
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title">'.$the_post_link.'</div>';
					$output .= '</div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}elseif($infobox_type == 'cspm_type4'){
									
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title">'.$the_post_link.'</div>';
					$output .= '</div>';
					$output .= '<div class="cspm_arrow_down"></div>';
				
				/**
				 * @since 2.7 */
				 	
				}elseif($infobox_type == 'cspm_type5'){

					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div>';
							$output .= '<div class="cspm_infobox_img">'.$post_thumbnail.'</div>';
							$output .= '<div class="title">'.$the_post_link.'</div>';
						$output .= '</div><div style="clear:both"></div>';
						$output .= '<div class="description">';
							$post_record = get_post($post_id, ARRAY_A, 'display');
							$post_content = trim(preg_replace('/\s+/', ' ', $post_record['post_content']));
							$output .= apply_filters('cspm_large_infobox_content', $post_content, $post_id);
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div style="clear:both"></div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}
			
			$output .= '</div>';
			
			die($output);
			
		}
		
		
		/**
		 * This contains all the UI elements that will be displayed in the map
		 */
		function cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true', $atts = array()){
			
			$output = '';
				
			/**
			 * This dot appears when the pin is fired */
			 
			$output .= '<div id="pulsating_holder" class="'.$map_id.'_pulsating"><div class="dot"></div></div>';
	
			/**
			 * Single Infobox */
			 
			if($this->show_infobox == 'true' && $this->infobox_display_event != 'onload')
				$output .= $this->cspm_infobox($this->infobox_type, 'single', $map_id);
			
			/**
			 * Zoom Control */
			 
			if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){
			
				$output .= '<div class="codespacing_zoom_container">';
					$output .= '<div class="codespacing_map_zoom_in_'.$map_id.' cspm_zoom_in_control cspm_border_shadow cspm_border_top_radius" title="'.__('Zoom in', 'cspm').'">';
						$output .= '<img src="'.$this->zoom_in_icon.'" />';
					$output .= '</div>';
					$output .= '<div class="codespacing_map_zoom_out_'.$map_id.' cspm_zoom_out_control cspm_border_shadow cspm_border_bottom_radius" title="'.__('Zoom out', 'cspm').'">';
						$output .= '<img src="'.$this->zoom_out_icon.'" />';
					$output .= '</div>';
				$output .= '</div>';
			
			}
			
			/**
			 * Geo targeting
			 * @since 2.8 */
			 
			if($geo == 'true'){
			
				$output .= '<div class="codespacing_geotarget_container">';
					$output .= '<div class="codespacing_map_geotarget_'.$map_id.' cspm_border_shadow cspm_border_radius" data-map-id="'.$map_id.'" title="'.__('Show your position', 'cspm').'">';
						$output .= '<img src="'.$this->plugin_url.'img/geoloc.png" />';
					$output .= '</div>';
				$output .= '</div>';
			
			}
						
			/**
			 * Faceted search */
			 
			if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true")
				$output .= $this->cspm_faceted_search($map_id, $carousel, $faceted_search_tax_slug, $faceted_search_tax_terms, $atts);
			
			/**
			 * Search form */
			 
			if($search_form == "yes" && $this->search_form_option == "true")
				$output .= $this->cspm_search_form($map_id, $carousel, $atts);
			
			/**
			 * Cluster Posts widget	*/
			 
			$output .= '<div class="cluster_posts_widget_'.$map_id.' cspm_border_shadow"><div class="blue_cloud"></div></div>';
			
			return $output;
							
		}
		
		
		/**
		 * Map-up, Carousel-down layout 
		 */		 
		function cspm_map_up_carousel_down_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '<div class="row" style="margin:0; padding:0;">';
										
				/**
				 * Map */
				 
				$output .= '<div style="position:relative; overflow:hidden;">';
				
					/**
					 * Interface elements */
					 
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
					
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="col-lg-12 col-xs-12 col-sm-12 col-md-12" style="height:'.$map_height.';"></div>';
				
				$output .= '</div>';
									
				/**
				 * Carousel */
				 
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					$output .= '<div id="codespacing_progress_map_carousel_container" data-map-id="'.$map_id.'" class="col-lg-12 col-xs-12 col-sm-12 col-md-12" style="margin:0; padding:0; height:auto;">';
					
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
					
					$output .= '</div>';
				
				}
				
			$output .= '</div>';
			
			return $output;
			
		}


		/**
		 * Map-down, Carousel-up layout
		 */
		function cspm_map_down_carousel_up_layout($carousel_height, $map_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){

			$output = '<div class="row" style="margin:0; padding:0">';
				
				/**
				 * Carousel */
				 
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){

					$output .= '<div id="codespacing_progress_map_carousel_container" data-map-id="'.$map_id.'" class="col-lg-12 col-xs-12 col-sm-12 col-md-12" style="margin:0; padding:0; height:auto;">';
						
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
					
					$output .= '</div>';
					
				}
														
				/**
				 * Map */
				 
				$output .= '<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12" style="height:auto; padding:0;">';
		
					/** 
					 * Interface elements */
					 
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
					
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" style="height:'.$map_height.';"></div>';
				
				$output .= '</div>';
								
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Map-right, Carousel-left layout 
		 */		 
		function cspm_map_right_carousel_left_layout($carousel_width, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '<div style="width:100%; height:100%; margin:0; padding:0;">';
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					$map_width = 'auto';
					$margin_left = 'margin-left:'.($carousel_width+20).'px;';
					
				}else{
					
					$map_width = '100%';
					$margin_left = '';
					
				}
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){ 
					
					/**
					 * Carousel */
					 
					$output .= '<div id="codespacing_progress_map_carousel_container" data-map-id="'.$map_id.'" style="position:absolute; width:auto; height:auto;">';
						
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="width:'.$carousel_width.'px; height:'.$this->layout_fixed_height.'px"></ul>';
					
					$output .= '</div>';
					
				}
				
				/**
				 * Map */
				 
				$output .= '<div style="height:'.$this->layout_fixed_height.'px; width:'.$map_width.'; position:relative; overflow:hidden; '.$margin_left.'">';
				
					/**
					 * Interface elements */
					 
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
					
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
				
				$output .= '</div>';
								
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Map-left, Carousel-right layout 
		 */
		function cspm_map_left_carousel_right_layout($carousel_width, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '<div style="width:100%; height:100%; margin:0; padding:0;">';
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					$map_width = 'auto';
					$margin_right = 'margin-right:'.($carousel_width+20).'px;';
					
				}else{
					
					$map_width = '100%';
					$margin_right = '';
					
				}
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					/**
					 * Carousel */
					 
					$output .= '<div id="codespacing_progress_map_carousel_container" data-map-id="'.$map_id.'" style="float:right; width:auto; height:auto;">';
						
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="width:'.$carousel_width.'px; height:'.$this->layout_fixed_height.'px"></ul>';
					
					$output .= '</div>';
					
				}
				
				/**
				 * Map */
				 
				$output .= '<div style="height:'.$this->layout_fixed_height.'px; width:'.$map_width.'; position:relative; overflow:hidden; '.$margin_right.'">';
				
					/**
					 * Interface elements */
					 
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
					
					/**
					 * Map */
					 
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Fullscreen & Fit in map
		 *
		 * @since 2.0
		 */
		function cspm_only_map_layout($map_id, $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '';
			
			/**
			 * Interface elements */
			 
			$output .= $this->cspm_map_interface_element($map_id, "no", $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
			
			/**
			 * Map */
			 
			$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
			
			return $output;
			
		}
		
		
		/** 
		 * Map-up, Carousel-over layout
		 *
		 * @since 2.3
		 */
		function cspm_map_up_carousel_over_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '<div style="margin:0; padding:0">';
				
				/**
				 * Map Container */
				 
				$output .= '<div style="position:relative">';
										
					/**
					 * Interface elements */
					 
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
				
					/**
					 * Carousel */
					 
					if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
						
						$output .= '<div id="codespacing_progress_map_carousel_container" class="codespacing_progress_map_carousel_on_top" data-map-id="'.$map_id.'">';
						
							$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
						
						$output .= '</div>';
					
					}
					
					/**
					 * Map */
					 
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" style="height:'.$map_height.'"></div>';
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Fullscreen & Fit in map with carousel
		 *
		 * @since 2.3
		 */
		function cspm_full_map_carousel_over_layout($map_id, $carousel = "yes", $faceted_search = "yes", $carousel_height, $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '';
			
			/**
			 * Interface elements */
			 
			$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
					
			/**
			 * Carousel */
			 
			if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
				
				$output .= '<div id="codespacing_progress_map_carousel_container" class="codespacing_progress_map_carousel_on_top col col-lg-12 col-xs-12 col-sm-12 col-md-12" data-map-id="'.$map_id.'">';
				
					$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
				
				$output .= '</div>';
			
			}
			
			/**
			 * Map */
			 
			$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
					
			return $output;
			
		}
		
		
		/**
		 * Map, Toggle-Carousel-top layout
		 *
		 * @since 2.4
		 */
		function cspm_map_toggle_carousel_top_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '<div style="margin:0; padding:0">';
				
				/**
				 * Map Container */
				 
				$output .= '<div style="position:relative">';
											
					/**
					 * Interface elements */
					 
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
				
					/**
					 * Carousel */
					 
					if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
						
						$output .= '<div class="cspm_toggle_carousel_horizontal_top" style="width:100%;">';
							
							$output .= '<div id="codespacing_progress_map_carousel_container" data-map-id="'.$map_id.'" style="display:none;">';
								
								$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
								 
							$output .= '</div>';
								
							$output .= '<div class="toggle-carousel-top cspm_border_bottom_radius cspm_border_shadow" data-map-id="'.$map_id.'">'.apply_filters('cspm_toggle_carousel_text', esc_html__('Toggle carousel', 'cspm')).'</div>';
							
						$output .= '</div>';
					
					}
					
					/**
					 * Map */
					 
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" style="height:'.$map_height.'"></div>';
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Map, Toggle-Carousel-bottom layout
		 *
		 * @since 2.4
		 */
		function cspm_map_toggle_carousel_bottom_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array(), $geo = 'true'){
			
			$output = '<div style="margin:0; padding:0">';
				
				/**
				 * Map Container */
				 
				$output .= '<div style="position:relative;">';
										
					/**
					 * Interface elements */
					 
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms, $geo);
				
					/**
					 * Map */
					 
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" style="height:'.$map_height.';"></div>';
					
					/**
					 * Carousel */
					 
					if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
						
						$output .= '<div class="cspm_toggle_carousel_horizontal_bottom" style="width:100%;">';
								
							$output .= '<div class="toggle-carousel-bottom cspm_border_top_radius cspm_border_shadow" data-map-id="'.$map_id.'">'.apply_filters('cspm_toggle_carousel_text', esc_html__('Toggle carousel', 'cspm')).'</div>';
							
							$output .= '<div id="codespacing_progress_map_carousel_container" data-map-id="'.$map_id.'" style="display:none;">';
								
								$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
								 
							$output .= '</div>';
						
						$output .= '</div>';
					
					}
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}

				
		/**
		 * The widget that contains the posts count
		 *
		 * @since 2.1
		 */
		function cspm_posts_count_clause($count, $map_id){
			
			$posts_count_clause = $this->cspm_wpml_get_string('Posts count clause', $this->posts_count_clause, $this->use_with_wpml);
			
			return str_replace('[posts_count]', '<span class="the_count_'.$map_id.'">'.$count.'</span>', esc_attr($posts_count_clause));
			
		}
		
		
		/**
		 * Get Custom marker icons by categories
		 *
		 * @since 2.1
		 */
		function cspm_marker_categories(){
							
			$marker_taxonomy = $this->marker_taxonomies;		
			
			$taxonomies_fields = array();
			
			if(!empty($marker_taxonomy)){
				
				$terms = get_terms($marker_taxonomy, "hide_empty=0");
				
				if(count($terms) > 0){			  
					foreach($terms as $term){			   											
						if(isset($this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term->term_id.'']))
							$taxonomies_fields['marker_categories']['marker_category_'.$term->term_id.''] = $this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term->term_id.''];
					}
				}	
				
			}
			
			if(array_key_exists('marker_categories', $taxonomies_fields))
				$taxonomies_fields = $taxonomies_fields + array('count_marker_categories' => count($taxonomies_fields['marker_categories']));	
			else $taxonomies_fields = $taxonomies_fields + array('count_marker_categories' => 0);	
			
			return $taxonomies_fields;
			
		}
		
		
		/**
		 * Get marker image when markers are displayed by category
		 *
		 * @since 2.4
		 * @updated 2.8
		 */
		function cspm_get_marker_img($atts = array()){
		
			$defaults = array(
				
				'post_id' => '',
				
				/**
				 * The taxonomy name to which a post is connected via a term */
				 
				'tax_name' => '',
				
				/**
				 * The term ID to which a post is connected */
				 
				'term_id' => '',
				
				'default_marker_icon' => $this->marker_icon,
			);
			
			extract(wp_parse_args($atts, $defaults));
				
			$marker_image = $default_marker_icon;
	
			/**
			 * The Primary marker is the one set for a post in the "Add/Edit post" page.
			 * If a post have a primary marker, this means that we want to display this marker no matter what marker is used for the taxonomy term. */
			 
			$primary_marker_img =  (!empty($post_id)) ? get_post_meta($post_id, CSPM_MARKER_ICON_FIELD, true) : '';
			
			if(!empty($primary_marker_img)){
		
				$marker_image = $primary_marker_img;
		
			/**
			 * Check if the user wants to display custom marker for each category of post */
			 
			}elseif($this->marker_cats_settings == 'true'){
								
				$markers_images_object = json_decode($this->cspm_get_setting('markercategoriessettings', 'marker_category_'.$tax_name.'', ''));
				
				if(is_object($markers_images_object) && count($markers_images_object) > 0){
					
					if(isset($markers_images_object->$term_id)){
						
						$marker_object = $markers_images_object->$term_id;
						
						if(isset($marker_object->tag_marker_img_path))
							$marker_image = $marker_object->tag_marker_img_path;
							
					}
					
				}
				
			}
			
			return $marker_image;
			
		}
		
		
		/**
		 * Get image path from its URL
		 *
		 * @since 2.4
		 * @Updated 2.7.2 
		 */
		function cspm_get_image_path_from_url($url){
			
			if(!empty($url)){
				
				/**
				 * [@wp_content_directory_url] & [@wp_content_directory_name]
				 * Get the wp-content folder name dynamicaly as some users may change its name to a custom name
				 * @since 2.7.2 */
				 
				$wp_content_directory_url = explode('/', WP_CONTENT_URL);
				$wp_content_directory_name = is_array($wp_content_directory_url) ? array_pop($wp_content_directory_url) : 'wp-content';
				
				$exploded_url = explode($wp_content_directory_name, $url);
				
				if(isset($exploded_url[1]))
					return WP_CONTENT_DIR.$exploded_url[1];
				
				else return false;		
				
			}else return false;
				
		}
		
		
		/**
		 * Get image size by image URL
		 *
		 * @since 2.4
		 */
		function cspm_get_image_size($url, $retina = "false"){
			
			if(!empty($url)){
				
				$img_size = getimagesize($url);
				
				if(isset($img_size[0]) && isset($img_size[1])){
					
					return $retina == "false" ? $img_size[0].'x'.$img_size[1] : ($img_size[0]/2).'x'.($img_size[1]/2);
					
				}else return '';
	
			}else return '';
			
		}
		
		
		/**
		 * Load the markers clustred inside a small area on the map
		 *
		 * @since 2.5
		 */
		function cspm_load_clustred_markers_list(){
			
			$post_ids = $_POST['post_ids'];
			$light_map = esc_attr($_POST['light_map']);
	
			$this->items_title = $this->cspm_get_setting('itemssettings', 'items_title');
			$this->infobox_external_link = $this->cspm_get_setting('infoboxsettings', 'infobox_external_link', 'same_window');
					
			$output = '<ul>';
			
				foreach($post_ids as $post_id){
					
					$item_title = stripslashes_deep($this->cspm_items_title($post_id, $this->items_title)); 
					
					$parameter = array(
						'style' => "width:70px; height:50px;"
					);
					
					$post_thumbnail = get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter);
					$the_permalink  = ($light_map == 'true') ? ' href="'.$this->cspm_get_permalink($post_id).'"' : '';
					$the_permalink .= ($light_map == 'true' && $this->infobox_external_link == 'new_window') ? ' target="_blank"' : '';
					
					$output .= '<li id="'.$post_id.'">';
						$output .= $post_thumbnail;
						$output .= '<a'.$the_permalink.'>'.$item_title.'</a>';
						$output .= '<div style="clear:both"></div>';
					$output .= '</li>';
		
				}
			
			$output .= '</ul>';
			
			die($output);
			
		}
		
		
		/**
		 * Create the faceted search form to filter markers and posts
		 *
		 * @since 2.1
		 */
		function cspm_faceted_search($map_id, $carousel = "yes", $faceted_search_tax_slug, $faceted_search_tax_terms, $atts = array()){
		
			$output = '';
			
			$output .= '<div class="faceted_search_btn cspm_border_shadow cspm_border_radius" id="'.$map_id.'">';
				$output .= '<img src="'.$this->faceted_search_icon.'" alt="'.esc_html__('Filter', 'cspm').'" title="'.esc_html__('Filter', 'cspm').'" />';
			$output .= '</div>';
			
			$output .= '<div class="reset_map_list_'.$map_id.' cspm_border_shadow cspm_border_radius" id="'.$map_id.'">';
				$output .= '<img src="'.$this->plugin_url.'img/refresh-circular-arrow.png" />';
			$output .= '</div>';
			
			$output .= '<div class="faceted_search_container_'.$map_id.' cspm_border_shadow cspm_border_radius">';
				
				$output .= '<form action="" method="post" class="faceted_search_form" id="faceted_search_form_'.$map_id.'" data-ext="'.apply_filters('cspm_ext_name', '', $atts).'">';
					
					$output .= '<input type="hidden" name="map_id" value="'.$map_id.'" />';
					$output .= '<input type="hidden" name="show_carousel" value="'.$carousel.'" />';
					
					$output .= '<ul>';

						/**
						 * Get the taxonomy name from the marker categories settings */
						 
						if(!empty($faceted_search_tax_slug)){
								
							/**
							 * Get Taxonomy Name */
							 
							$tax_name = $faceted_search_tax_slug;
							
							if(empty($faceted_search_tax_terms)){
								
								if(isset($this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.'']))
									$terms = $this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.''];
								else $terms = array();							
								
							}else $terms = $faceted_search_tax_terms;
							
							if(is_array($terms) && count($terms) > 0){
								
								foreach($terms as $term_id){
									
									// For WPML =====
									$term_id = $this->cspm_wpml_object_id($term_id, $tax_name, false, '', $this->use_with_wpml);
									// @For WPML ====
									
									if($term = get_term($term_id, $tax_name)){
										
										$term_name = isset($term->name) ? $term->name : '';
									
										if($this->faceted_search_multi_taxonomy_option == 'true'){
											
											$output .= '<li>';				
												$output .= '<input type="checkbox" name="'.$tax_name.'___'.$term_id.'[]" id="'.$map_id.'_'.$tax_name.'___'.$term_id.'" value="'.$term_id.'" data-map-id="'.$map_id.'" data-show-carousel="'.$carousel.'" class="faceted_input '.$map_id.' '.$carousel.'">';
												$output .= '<label for="'.$map_id.'_'.$tax_name.'___'.$term_id.'">'.$term_name.'</label>';
												$output .= '<div style="clear:both"></div>';												
											$output .= '</li>';
											
										}else{
											
											$output .= '<li>';				
												$output .= '<input type="radio" name="'.$tax_name.'" id="'.$map_id.'_'.$tax_name.'_'.$term_id.'" value="'.$term_id.'" data-map-id="'.$map_id.'" data-show-carousel="'.$carousel.'" class="faceted_input '.$map_id.' '.$carousel.'">';
												$output .= '<label for="'.$map_id.'_'.$tax_name.'_'.$term_id.'">'.$term_name.'</label>';
												$output .= '<div style="clear:both"></div>';												
											$output .= '</li>';
											
										}
										
									}
									
								}
								
							}
							
						}
											
					$output .= '</ul>';
								
				$output .= '</form>';			
			
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Create the search form
		 *
		 * @since 2.4 
		 */
		function cspm_search_form($map_id, $carousel = "yes", $atts = array()){
	
			$distance_unit = ($this->sf_distance_unit == 'metric') ? "Km" : "Miles";
			$search_distances = explode(',', $this->sf_search_distances);
			$default_distance = (isset($search_distances[0])) ? $search_distances[0] : "3";
			
			/**
			 * @WPML String translate */
 
			$address_placeholder = $this->cspm_wpml_get_string('Address field placeholder', $this->address_placeholder, $this->use_with_wpml);
			$slider_label = $this->cspm_wpml_get_string('Expand the search area up to', $this->slider_label, $this->use_with_wpml);
			$no_location_msg = $this->cspm_wpml_get_string('We could not find any location', $this->no_location_msg, $this->use_with_wpml);
			$bad_address_msg = $this->cspm_wpml_get_string('We could not understand the location', $this->bad_address_msg, $this->use_with_wpml);
			$bad_address_sug_1 = $this->cspm_wpml_get_string('- Make sure all street and city names are spelled correctly.', $this->bad_address_sug_1, $this->use_with_wpml);
			$bad_address_sug_2 = $this->cspm_wpml_get_string('- Make sure your address includes a city and state.', $this->bad_address_sug_2, $this->use_with_wpml);
			$bad_address_sug_3 = $this->cspm_wpml_get_string('- Try entering a zip code.', $this->bad_address_sug_3, $this->use_with_wpml);			
			$submit_text = $this->cspm_wpml_get_string('Search', $this->submit_text, $this->use_with_wpml);
			
			$output = '';
			
			$output .= '<div class="search_form_btn cspm_border_shadow cspm_border_radius" id="'.$map_id.'">';
				$output .= '<img src="'.$this->search_form_icon.'" alt="'.esc_html__('Search', 'cspm').'" title="'.esc_html__('Search', 'cspm').'" />';
			$output .= '</div>';
			
			$output .= '<div class="search_form_container_'.$map_id.' cspm_border_shadow cspm_border_radius">';
			
				$output .= '<div class="cspm_search_form_notice cspm_border_shadow cspm_border_radius"><div>'.$no_location_msg.'</div></div>';
				
				$output .= '<div class="cspm_search_form_error cspm_border_shadow cspm_border_radius"><strong>'.$bad_address_msg.'</strong><ul><li>'.$bad_address_sug_1.'</li><li>'.$bad_address_sug_2.'</li><li>'.$bad_address_sug_3.'</li></ul></div>';
				
				$output .= '<form action="" method="post" class="search_form" id="search_form_'.$map_id.'" onsubmit="return false;">';
					
					$output .= '<div class="cspm_search_form_row">';
						$output .= '<div class="cspm_search_input_text_container input cspm_border_shadow cspm_border_radius">';
							$output .= '<input type="text" name="cspm_address" id="cspm_address_'.$map_id.'" value="" placeholder="'.$address_placeholder.'" />';
							$output .= '<img src="'.$this->plugin_url.'img/placeholder.png" />';
						$output .= '</div>';
					$output .= '</div>';
					
					$output .= '<div class="cspm_expand_search_area">';
						$output .= '<div class="cspm_search_label_container">';
							$output .= '<img src="'.$this->plugin_url.'img/radius.png" />';
							$output .= '<label>'.$slider_label.'</label>';
						$output .= '</div>';
						$output .= '<div class="cspm_search_slider_container">';
							$output .= '<input type="text" name="cspm_distance" class="cspm_sf_slider_range" data-min="'.min($search_distances).'" data-max="'.max($search_distances).'" data-postfix=" '.$distance_unit.'" />';
							$output .= '<input type="hidden" name="cspm_distance_unit" value="'.$this->sf_distance_unit.'" />';
						$output .= '</div>';
					$output .= '</div>';
					
					$output .= '<div class="cspm_search_btns_container">';
						$output .= '<div class="cspm_submit_search_form_'.$map_id.' cspm_border_shadow cspm_border_radius" data-map-id="'.$map_id.'" data-show-carousel="'.$carousel.'" data-ext="'.apply_filters('cspm_ext_name', '', $atts).'">';
							$output .= $submit_text.'<img src="'.$this->plugin_url.'img/search-loup.png" />';
						$output .= '</div>';
						$output .= '<div class="cspm_reset_search_form_'.$map_id.' cspm_border_shadow cspm_border_radius" data-map-id="'.$map_id.'" data-show-carousel="'.$carousel.'" data-ext="'.apply_filters('cspm_ext_name', '', $atts).'">';
							$output .= '<img src="'.$this->plugin_url.'img/refresh-circular-arrow.png" />';
						$output .= '</div>';
						$output .= '<div style="clear:both"></div>';
					$output .= '</div>';
					
				$output .= '</form>';	
			
			$output .= '</div>';
			
			return $output;
			
		}
		
		
		/**
		 * Detect mobile browser
		 *
		 * @since 2.4
		 * @updated 2.7
		 */
		function cspm_detect_mobile_browser(){
			
			if($this->layout_type == 'responsive'){
				
				require_once 'libs/Mobile_Detect.php';
				
				$detect = new Mobile_Detect;

				return $detect->isMobile() ? true : false;
			
			}else return false;
			
		}
		
		
		/**
		 * Run some settings updates to sync. with the lateset version
		 *
		 * @since 2.4 
		 */
		function cspm_sync_settings_for_latest_version(){
			
			$new_settings = $this->settings;

			/**
			 * Update the taxonomy terms settings
			 * Store all terms in one setting row instead of seperated rows	 
			 * @since 2.4 */
			
			$post_taxonomies = (array) get_object_taxonomies($this->post_type, 'objects');
			
			/**
			 * Loop throught taxonomies */
			 
			foreach($post_taxonomies as $single_taxonomie){
				
				/**
				 * Get Taxonomy Name */
				 
				$tax_name = $single_taxonomie->name;
				
				/**
				 * Get all terms related to this taxonomy */
				 
				$terms = get_terms($tax_name, "hide_empty=0");
					
				/**
				 * Loop throught terms */
				 
				if(count($terms) > 0){			  								  
					
					$taxonomy_term_ids = $fs_taxonomy_term_ids = array();
					
					foreach($terms as $term){
						
						$term_id = $term->term_id;
						
						/**
						 * Taxonomies */
						 
						if(isset($this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.'_'.$term_id])){
							$term_name = $this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.'_'.$term_id];
							if($term_name != '0') $taxonomy_term_ids[] = $term_id;
						}
						
						/**
						 * Faceted search terms */
						 
						if(isset($this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.'_'.$term_id])){
							$term_name = $this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.'_'.$term_id];					
							if($term_name != '0') $fs_taxonomy_term_ids[] = $term_id;
						}
									
					}		
				
					if(count($taxonomy_term_ids) > 0)
						$new_settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.''] = $taxonomy_term_ids;
					
					if(count($fs_taxonomy_term_ids) > 0)
						$new_settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.''] = $fs_taxonomy_term_ids;
											
				}
				
			}
			
			
			/**
			 * Update the marker categories settings
			 * Store all marker images in one setting row instead of seperated rows	 
			 * @since 2.5 */
				
			/**
			 * Get Taxonomy Name */
			 
			if(isset($new_settings['codespacingprogressmap_markercategoriessettings_marker_taxonomies'])){

				$marker_tax_name = $new_settings['codespacingprogressmap_markercategoriessettings_marker_taxonomies'];
				
				if(!empty($marker_tax_name)){
					
					/**
					 * Get all terms related to this taxonomy */
					 
					$terms = get_terms($marker_tax_name, "hide_empty=0");
						
					/**
					 * Loop throught terms */
					 
					if(count($terms) > 0){			  								  
						
						$taxonomy_term_ids = array();
	
						foreach($terms as $term){
							
							$term_id = $term->term_id;
							
							/**
							 * Marker categories */
							 
							if(isset($this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term_id])){
								$term_name = $this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term_id];
								if(!empty($term_name) && $term_name != '0') $taxonomy_term_ids[$term_id] = array('tag_marker_img_label' => $term->name,
																						   'tag_marker_img_name' => $term_id,
																						   'tag_marker_img_category' => $term_id,
																						   'tag_marker_img_path' => $this->cspm_get_setting('markercategoriessettings', 'marker_category_'.$term_id.'', $this->marker_icon)
																						   );
							}						
										
						}		
					
						if(count($taxonomy_term_ids) > 0)
							$new_settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$marker_tax_name.''] = json_encode($taxonomy_term_ids);
	
					}
					
				}

			}
			
			/**
			 * Update Secondary post types from text field to multiselect field
			 * @since 2.7 */
			
			if(isset($this->settings['codespacingprogressmap_generalsettings_secondary_post_type']) && !empty($this->settings['codespacingprogressmap_generalsettings_secondary_post_type'])){
			
				$secondary_cpts = explode(',', $this->settings['codespacingprogressmap_generalsettings_secondary_post_type']);
				
				if(count($secondary_cpts) > 0)				
					$new_settings['codespacingprogressmap_generalsettings_secondary_post_type'] = $secondary_cpts;
					
			}
			 
			/**
			 * Update settings */
			 
			if(count($new_settings) > 0){

				$new_settings_array = $new_settings;
				
				$opt_group = preg_replace("/[^a-z0-9]+/i", "", basename($this->plugin_path .'settings/codespacing-progress-map.php', '.php'));
				
				update_option($opt_group.'_settings', $new_settings_array);	
				
			}
			
		}
		
		
		/**
		 * AJAX function
		 * Get all posts and create a JSON array of markers base on the ...
		 * ... custom fields latitude & longitude + Secondary lat & lng
		 *
		 * @since 2.5
		 */
		function cspm_create_markers_array_for_latest_version($is_ajax = true){
			
			$post_types = (!empty($this->secondary_post_type)) ? array_merge(array($this->post_type), explode(',', str_replace(' ', '', $this->secondary_post_type)))
															   : array($this->post_type);
												   
			$meta_values = array(CSPM_LATITUDE_FIELD, CSPM_LONGITUDE_FIELD, CSPM_SECONDARY_LAT_LNG_FIELD);
			
			if(count($post_types) > 0){

				$post_types_markers = array();
				
				/**
				 * Loop throught the post types */
				 
				foreach($post_types as $post_type){
					
					$post_types_markers[$post_type] = array();
					
					/**
					 * Get all the values of the Latitude/Longitude/Secondary coordinates ...
					 * ... where each row in the array contains the value of the custom field and ...
					 * ... the post id related to */
					 
					foreach($meta_values as $meta_value)
						$post_types_markers[$post_type][$meta_value] = $this->cspm_get_meta_values($meta_value, $post_type);
									
					$post_types_markers[$post_type] = array_merge_recursive(
						$post_types_markers[$post_type][CSPM_LATITUDE_FIELD], 
						$post_types_markers[$post_type][CSPM_LONGITUDE_FIELD],
						$post_types_markers[$post_type][CSPM_SECONDARY_LAT_LNG_FIELD]
					);								
																	   
				}
			
				global $wpdb;
				
				$markers_object = $post_taxonomy_terms = array();
				
				/**
				 * Create the map markers object */
				 
				foreach($post_types_markers as $post_type => $posts_and_coordinates){
					
					$i = $j = 0;						
					
					/**
					 * Get post type taxonomies */
					 
					$post_taxonomies = (array) get_object_taxonomies($post_type, 'names');
					
					/**
					 * Implode taxonomies to use them in the Mysql IN clause */
					 
					$taxonomies = "'" . implode("', '", $post_taxonomies) . "'";
					
					/**
					 * Directly querying the database is normally frowned upon, but all ...
					 * ... of the API functions will return the full post objects which will
					 * ... suck up lots of memory. This is best, just not as future proof */
					 
					$query = "SELECT t.term_id, tt.taxonomy, tr.object_id FROM $wpdb->terms AS t 
								INNER JOIN $wpdb->term_taxonomy AS tt 
									ON tt.term_id = t.term_id 
								INNER JOIN $wpdb->term_relationships AS tr 
									ON tr.term_taxonomy_id = tt.term_taxonomy_id 
								WHERE tt.taxonomy IN ($taxonomies)";
					
					/**
					 * Run the query. This will get an array of all terms where each term ...
					 * ... is listed with the taxonomy name and the post id */
					 
					$taxonomy_terms_and_posts = $wpdb->get_results( $query, ARRAY_A );
					
					/**
					 * Loop through the terms and order them in a way, the array will have the post_id as key ...
					 * ... inside that array, there will be another array with the key == taxonomy name ...
					 * ... inside that last array, there will be all the terms of a post */
					 
					foreach($taxonomy_terms_and_posts as $term)							
						$post_taxonomy_terms[$term['object_id']][$term['taxonomy']][] = $term['term_id'];
					
					foreach($posts_and_coordinates as $post_id => $post_coordinates){						
						
						if(isset($post_coordinates[CSPM_LATITUDE_FIELD]) && isset($post_coordinates[CSPM_LONGITUDE_FIELD])){
							
							$post_id = str_replace('post_id_', '', $post_id);							
							
							/**
							 * If a taxonomy is not set in the $post_taxonomy_terms array ...
							 * ... it means that the post has no terms available for that taxonomy ...
							 * ... but we still need to create an empty array for that taxonomy in order ...
							 * ... to use it with faceted search */
							 
							foreach($post_taxonomies as $taxonomy_name){
								
								/**
								 * Extend the $post_taxonomy_terms array with an empty array of the not existing taxonomy */
								 
								if(!isset($post_taxonomy_terms[$post_id][$taxonomy_name]))
									$post_taxonomy_terms[$post_id][$taxonomy_name] = array(); 
							
							}
							
							$markers_object[$post_type]['post_id_'.$post_id] = array(
								'lat' => $post_coordinates[CSPM_LATITUDE_FIELD],
								'lng' => $post_coordinates[CSPM_LONGITUDE_FIELD],
								'post_id' => $post_id,
								'post_tax_terms' => $post_taxonomy_terms[$post_id],
								'is_child' => 'no',
								'children_markers' => array()
							);
							
							$i++;
							
							/**
							 * Sencondary latLng */
							 
							if(isset($post_coordinates[CSPM_SECONDARY_LAT_LNG_FIELD]) && !empty($post_coordinates[CSPM_SECONDARY_LAT_LNG_FIELD])){
								
								$children_markers = array();
								
								$lats_lngs = explode(']', $post_coordinates[CSPM_SECONDARY_LAT_LNG_FIELD]);	
										
								foreach($lats_lngs as $single_coordinate){
								
									$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
									
									$coordinates = explode(',', $strip_coordinates);
									
									if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
										
										$lat = $coordinates[0];
										$lng = $coordinates[1];
										
										$children_markers[] = array(
											'lat' => $lat,
											'lng' => $lng,
											'post_id' => $post_id,
											'post_tax_terms' => $post_taxonomy_terms,
											'is_child' => 'yes_'.$j.''
										);
																														
										$lat = '';
										$lng = '';
										$j++;
									
									} 
									
									$i++;
									
								}
								
								$markers_object[$post_type]['post_id_'.$post_id]['children_markers'] = $children_markers;
							
							}								
																																					
						}
						
					}
					
				}
														
				/**
				 * Update settings */
				 
				if(count($markers_object) > 0){
					
					update_option('cspm_markers_array', $markers_object);
										
				}
			
			}
			
			if($is_ajax) die();
			
		}
		
		
		/**
		 * Get All Values of A Custom Field Key 
		 * @key: The meta_key of the post meta
		 * @type: The name of the custom post type
		 *
		 * @since 2.5 
		 */
		function cspm_get_meta_values( $key = '', $post_type = 'post' ) {
			
			global $wpdb;
			
			if( empty( $key ) )
				return;
			
			$rows = $wpdb->get_results( $wpdb->prepare( "
				SELECT pm.meta_value, p.ID FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE pm.meta_key = '%s' 
				AND pm.meta_value != '' 
				AND p.post_type = '%s'
			", $key, $post_type ), ARRAY_A );
			
			$results = array();
			
			foreach($rows as $row)
				$results['post_id_'.$row['ID']] = array($key => $row['meta_value']);
			
			return $results;
			
		}
		
		
		/**
		 * Returns an element's ID in the current language or in another specified language.
		 *
		 * @since 2.5
		 * @updated 2.8
		 */
		function cspm_wpml_object_id($ID, $post_tag, $orginal_val = true, $lang_code = "", $use_with_wpml = "no"){
			
			/*if(!empty($lang_code))
				$lang_code = apply_filters('wpml_current_language', NULL);
			
			return ($use_with_wpml == 'yes') ? apply_filters('wpml_object_id', $ID, $post_tag, $orginal_val, $lang_code) : $ID;*/
			
			if(function_exists('icl_object_id') && $use_with_wpml == 'yes'){
				
				if(empty($lang_code)) $lang_code = ICL_LANGUAGE_CODE;
				$object_id = icl_object_id($ID, $post_tag, $orginal_val, $lang_code);
				
			}else $object_id = $ID;
					
			return $object_id;
			
		}
		
		
		/**
		 * Get the Default language of the website
		 *
		 * @since 2.5
		 * @updated 2.8
		 */	
		function cspm_wpml_default_lang($use_with_wpml = "no"){
			
			/*return ($use_with_wpml == 'yes') ? apply_filters('wpml_default_language', NULL ) : '';*/	
			
			if(function_exists('icl_object_id') && $use_with_wpml == 'yes'){
			
				global $sitepress;
			
				return $sitepress->get_default_language();
			
			}else return '';
			
		}
		
		
		/**
		 * Register strings for WPML 
		 *
		 * @since 2.5
		 * @updated 2.8
		 */
		function cspm_wpml_register_string($name, $value, $use_with_wpml = "no"){
				
			/*if($use_with_wpml == 'yes' && !empty($name) && !empty($value))
				do_action('wpml_register_single_string', 'Progress map', $name, $value);*/
			
			if(function_exists('icl_register_string') && $use_with_wpml == 'yes')
				icl_register_string('Progress map', $name, $value);
			
		}
		
		
		/**
		 * Get registered string from WPML DBB when displaying
		 *
		 * @since 2.5
		 * @updated 2.8
		 */
		function cspm_wpml_get_string($name, $value, $use_with_wpml = "no"){
		
			/*if($use_with_wpml == 'yes' && !empty($name) && !empty($value))
				return apply_filters('wpml_translate_single_string', $value, 'Progress map', $name);
			else return $value;*/
								
			if(function_exists('icl_t') && $use_with_wpml == 'yes'){
				
				return icl_t('Progress map', $name, $value);
			
			}else return $value;
			
		}
		
		
		/**
		 * Display a message in the admin to promote for Progress Map extensions
		 *
		 * @since 2.8
		 */
		function cspm_promote_extensions(){
			
			/**
			 * Nearby Places Extension
			 * @since 2.8 */
			 	
			if (!class_exists('CspmNearbyMap')){
				
				echo '<div class="notice notice-info is-dismissible"><p>';
					_e( 'Display All Points of Interest nearby a location/post on the map with the NEW extension <a href="http://codecanyon.net/item/nearby-places-wordpress-plugin/15067875?ref=codespacing" target="_blank">"Nearby Places"</a>', 'cspm' );
				echo '</p></div>';
			
			}
		
	
		}
		
		function cspm_before_settings(){	
	
			global $wpsf_settings;
								
			$sections = array();
			
			echo '<div class="codespacing_container" style="padding:0px; margin-top:30px; height:auto; width:800px; position:relative; box-shadow:rgba(0,0,0,.298039) 0 1px 2px -1px">';
				
				echo '<div class="cspm_admin_square_loader"></div>';
				
				echo '<div class="codespacing_header"><img src="'.$this->plugin_url.'settings/img/progress-map.png" /></div>';
				
				echo '<div class="codespacing_menu_container" style="width:auto; float:left; height:auto;">';
					
					echo '<ul class="codespacing_menu">';
						
						if(!empty($wpsf_settings)){
							
							usort($wpsf_settings, array(&$this->cspm_wpsf, 'cspm_sort_array'));
							
							$first_section = $wpsf_settings[0]['section_id'];
							
							foreach($wpsf_settings as $section){
								
								if(isset($section['section_id']) && isset($section['section_title'])){
									
									echo '<li class="codespacing_li" id='.$section['section_id'].'>'.$section['section_title'].'</li>';
									
									$sections[$section['section_id']] = $section['section_title'];								
									
								}
								
							}
								
						}
					
					echo '</ul>';
					
				echo '</div>';
				 
				echo '<div style="width:539px; height:auto; min-height:570px; padding:30px; float:left; border-left: 1px solid #e8ebec; border-top:0px solid #008fed; background:#f7f8f8 url('.$this->plugin_url.'settings/img/bg.png) repeat;">';	
				
		}
		
		function cspm_after_settings(){
				
				echo '<div class="cspm_admin_btm_square_loader"></div>';
				
				echo '</div>';
				
				echo '<div style="clear:both"></div>';
				
			echo '</div>';	
			
			echo '<div class="codespacing_rates_fotter"><a target="_blank" href="http://codecanyon.net/item/progress-map-wordpress-plugin/5581719"><img src="'.$this->plugin_url.'settings/img/rates.jpg" /></a></div>';

			echo '<div><h3>Extend "Progress Map" with these awesome addons:</h3></div>';
			
			echo '<div style="float:left; margin-right:20px;"><a target="_blank" href="http://codecanyon.net/item/nearby-places-wordpress-plugin/15067875?ref=codespacing"><img src="'.$this->plugin_url.'settings/img/nearby-places-thumb.png" /></a></div>';
			
			echo '<div style="clear:both;"></div>';
			
			echo '<div class="codespacing_copyright">&copy; All rights reserved CodeSpacing. Progress Map '.$this->plugin_version.'</div>';
			
			echo '<div class="codespacing_copyright">&copy; <a target="_blank" href="https://www.freevectormaps.com/world-maps/WRLD-EPS-01-0002?ref=atr">Map of World with Regions - Single Color</a> by <a target="_blank" href="https://www.freevectormaps.com/?ref=atr">FreeVectorMaps.com</a></div>';

		}
		
	}

}	

if( class_exists( 'CodespacingProgressMap' ) )
	new CodespacingProgressMap();
	

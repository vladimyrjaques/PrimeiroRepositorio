<?php

global $wpsf_settings;
	
/**
 * Statuses */
 
$statuses = get_post_stati();

/**
 * Users */
 
$blogusers = get_users(array('fields' => 'all'));

$authors_array = array();

foreach($blogusers as $user)
	$authors_array[$user->ID] = $user->user_nicename.' ('.$user->user_email.')';

/**
 * Map styles */

$map_styles = $map_styles_array = array();

if(file_exists(plugin_dir_path( __FILE__ ).'map-styles.php')){
	
	include_once(plugin_dir_path( __FILE__ ).'map-styles.php');
	
	array_multisort($map_styles);
	
	foreach($map_styles as $key => $value){
		$value_output  = '';
		$value_output .= empty($value['new']) ? '' : ' <sup class="cspm_new_tag" style="margin:0 5px 0 -2px;">NEW</sup>';		
		$value_output .= $value['title'];				
		$value_output .= empty($value['demo']) ? '' : ' <sup class="cspm_demo_tag"><a href="'.$value['demo'].'" target="_blank"><small>Demo</small></a></sup>';
		$map_styles_array[$key] = $value_output;
	}
	
}

/**
 * General Settings section */

$wpsf_settings[] = array(
    'section_id' => 'generalsettings',
    'section_title' => 'Query Settings',
    'section_description' => 'Filter your posts by controlling the parameters below to your needs. You can always get the information you want without actually dealing with any parameter.',
    'section_order' => 1,
    'fields' => array(
		array(
            'id' => 'post_types_section',
            'title' => '<span class="section_sub_title">Post Types Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),	
		
        /**
		 * Deprecated since 2.7 
		 * Replaced by the function "cspm_get_registred_cpt" located in the file wp-settings-framework.php
		 *
		array(
            'id' => 'post_type',
            'title' => 'Main content type name',
            'desc' => 'Enter for which content types Progress Map should be available during post creation/editing. (Default:post)',
            'type' => 'text',
            'std' => 'post',
        ),
        array(
            'id' => 'secondary_post_type',
            'title' => 'Secondary content types names',
            'desc' => 'Enter the other content types names (separated by comma) Progress Map should be available during post creation/editing. Those entred here wont be used in the main query, you can call them later in the other instances of the map.',
            'type' => 'text',
            'std' => '',
        ),*/			
        
		array(
            'id' => 'number_of_items',
            'title' => 'Number of items', 
            'desc' => 'Enter the number of items to show on the map. Leave this field empty to get all items.',
            'type' => 'text',
            'std' => '',
        ),		
		array(
            'id' => 'taxonomies_section',
            'title' => '<span class="section_sub_title">Taxonomy Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
			'id' => 'taxonomy_relation_param',
			'title' => '"Relation" parameter', 
			'desc' => 'Select the relationship between taxonomy queries. Default is "AND". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters" target="_blank">More</a>.<br />
					   <span style="color:red"><strong style="font-size:14px;"><u>How to override the <u>"Taxonomy Parametrs"</u> with the help of the shortcode attributes?</u></strong><br /><br />
					   <strong></strong> To override the "Taxonomy Parameters" using the shortcode, make use of the shortcode attributes <strong>"post_type"</strong>, <strong>"tax_query"</strong>, <strong>"tax_query_field"</strong> and <strong>"tax_query_relation"</strong>.<br /><br />
					   
					   <strong>[post_type]</strong> is a required attribute and without it, the plugin will not be able to query the other attributes. The value of this attribute must be the Post Type Name 
					   (lowercase name with no spaces) that you can find between brackets in the list of the field "Secondary content types".<br /><br />
					   
					   <strong>[tax_query]</strong> is the attribute that you need to use to select the <u>Taxonomy Name</u> and the <u>Term IDs or slugs</u> to display, plus the <u>Operator (IN, NOT IN or AND)</u>.<br />
					   <strong>Example (1): [codespacing_progress_map post_type="post" tax_query="category{10.11.12|IN}"]</strong><br />
					   <strong>Note: </strong> As you can see in the example (1), we used the <u>Term IDs (10.11.12)</u> to distinguish the terms of the locations to display on the map, but what if we want to use the <u>Term slugs</u> instead? To do that we simply need to 
					   add the shortcode attribute <strong>"tax_query_field"</strong> to the example (1). The value of this shortcode is <strong>"slug"</strong> and it\'s unchangeable. See example (2).<br />
					   <strong>Example (2): [codespacing_progress_map post_type="post" tax_query="category{city.garden.golf|IN}" tax_query_field="slug"]</strong><br /><br />
					   
					   <strong>[tax_query_relation]</strong> is the attribute to use in case you want to display your locations based on multiple taxonomies. Possible values to use in this attribute are <u>"AND"</u> & <u>"OR"</u>.<br />
					   <strong>Example (3): [codespacing_progress_map post_type="post" tax_query="category{10.11.12|IN},post_tag{1.2.3|IN}" tax_query_relation="AND"]</strong>
					   
					   </span>',
			'type' => 'radio',
			'std' => 'AND',
			'choices' => array(
				'AND' => 'AND',
				'OR' => 'OR',
			)
		),	
		array(
            'id' => 'status_section',
            'title' => '<span class="section_sub_title">Status Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'items_status',
            'title' => 'Status', 
            'desc' => 'Show posts associated with certain status. Default is "publish". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Status_Parameters" target="_blank">More</a>',
            'type' => 'checkboxes',
            'std' => '',
			'choices' => $statuses
        ),	
		array(
            'id' => 'custom_fields_section',
            'title' => '<span class="section_sub_title">Custom Fields Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),
        array(
            'id' => 'custom_fields',
            'title' => 'Custom fields', 
            'desc' => 'Show posts associated with a certain custom field.
					   <strong>Syntax:</strong> [key:meta_key | value:meta_value | type:meta_type | compare:meta_compare], ...<br />
					   <strong>*key: </strong>(string) - Custom field name.<br />
					   <strong>*value: </strong>(string|array) - Custom field value. (Note: Array support is limited to a compare value of "IN", "NOT IN", "BETWEEN", or "NOT BETWEEN")<br />
					   <strong>*type: </strong>(string) - Custom field type. Possible values are "NUMERIC", "BINARY", "CHAR", "DATE", "DATETIME", "DECIMAL", "SIGNED", "TIME", "UNSIGNED". Default value is "CHAR".<br />
					   <strong>*compare: </strong>Operator to test. Possible values are "=", "!=", ">", ">=", "<", "<=", "LIKE", "NOT LIKE", "IN", "NOT IN", "BETWEEN", "NOT BETWEEN", "EXISTS" (only in WP >= 3.5), and "NOT EXISTS" (also only in WP >= 3.5). Default value is "=".<br />
 					   <strong>1. Example of use:</strong> [key:price | value:5000 | type:numeric | compare:=], [key:bedrooms | value:2 | type:numeric | compare:<=]<br />
   					   <strong>2. Example of use:</strong> [key:price | value:(5000,7000) | type:numeric | compare:BETWEEN]<br />
					   <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters" target="_blank">More</a>',
            'type' => 'textarea',
            'std' => '',
        ),		
		array(
            'id' => 'custom_field_relation_param',
            'title' => '"Relation" parameter', 
            'desc' => 'Select the relationship between the custom fields. Default is "AND". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'AND',
            'choices' => array(
				'AND' => 'AND',
				'OR' => 'OR'
            )
        ),		
		array(
            'id' => 'post_section',
            'title' => '<span class="section_sub_title">Post Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'post_in',
            'title' => 'Post to retrieve', 
            'desc' => 'Use post ids (separated by comma). Specify posts to retrieve. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters" target="_blank">More</a>',
            'type' => 'textarea',
            'std' => '',
        ),
        array(
            'id' => 'post_not_in',
            'title' => 'Post not to retreive', 
            'desc' => 'Use post ids (separated by comma). Specify posts not to retrieve. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters" target="_blank">More</a>',
            'type' => 'textarea',
            'std' => '',
        ),		
		array(
            'id' => 'caching_section',
            'title' => '<span class="section_sub_title">Caching parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),											
        array(
            'id' => 'cache_results',
            'title' => 'Post information cache', 
            'desc' => 'Show Posts without adding post information to the cache. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),			
        array(
            'id' => 'update_post_meta_cache',
            'title' => 'Post meta information cache', 
            'desc' => 'Show Posts without adding post meta information to the cache. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),							
        array(
            'id' => 'update_post_term_cache',
            'title' => 'Post term information cache', 
            'desc' => 'Show Posts without adding post term information to the cache. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'author_section',
            'title' => '<span class="section_sub_title">Author Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),
        array(
            'id' => 'authors_prefixing',
            'title' => 'Authors condition', 
            'desc' => 'Select "Yes" if you want to display all posts except those from selected authors.<br />
					   Select "No" if you want to display all posts of selected authors.<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),		
        array(
            'id' => 'authors',
            'title' => 'Authors', 
            'desc' => 'Show/Hide posts associated with certain authors. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters" target="_blank">More</a>',
            'type' => 'multi_select',
            'std' => '',
			'choices' => $authors_array
        ),			
		array(
            'id' => 'order_section',
            'title' => '<span class="section_sub_title">Order & Orderby Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'orderby_param',
            'title' => 'Orderby parameters', 
            'desc' => 'Sort retrieved posts by parameter. Defaults to "date". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">More</a>',
            'type' => 'select',
            'std' => 'date',
            'choices' => array(
				'none' => 'No order',
				'ID' => 'Order by post id',
				'author' => 'Order by author',
				'title' => 'Order by title',
				'name' => 'Order by post name (post slug)',
				'date' => 'Order by date',
				'modified' => 'Order by last modified date',
				'parent' => 'Order by post/page parent id',
				'rand' => 'Random order',
				'comment_count' => 'Order by number of comments',
				'menu_order' => 'Order by Page Order',
				'meta_value' => 'Order by string meta value',
				'meta_value_num' => 'Order by numeric meta value ',
				'post__in' => 'Preserve post ID order given in the post__in array',
            )
        ),	
        array(
            'id' => 'orderby_meta_key',
            'title' => 'Custom field name', 
            'desc' => 'This field is used only for "Order by string meta value" & "Order by numeric meta value" in "Orderby parameters".',
            'type' => 'text',
            'std' => '',
        ),															
        array(
            'id' => 'order_param',
            'title' => 'Order parameters', 
            'desc' => 'Designates the ascending or descending order of the "orderby" parameter. Defaults to "DESC". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'DESC',
            'choices' => array(
				'ASC' => 'Ascending order from lowest to highest values',
				'DESC' => 'Descending order from highest to lowest values'
            )
        ),							
	)
		
);

/**
 * Layout Settings section */

$wpsf_settings[] = array(
    'section_id' => 'layoutsettings',
    'section_title' => 'Layout Settings',
    'section_description' => '',
    'section_order' => 2,
    'fields' => array(
        array(
            'id' => 'main_layout',
            'title' => 'Main layout',
            'desc' => 'Select main layout alignment.',
            'type' => 'radio',
            'std' => 'mu-cd',
            'choices' => array(
				'mu-cd' => 'Map-Up, Carousel-Down',
				'md-cu' => 'Map-Down, Carousel-Up',
				'mr-cl' => 'Map-Right, Carousel-Left',
				'ml-cr' => 'Map-Left, Carousel-Right',
				'fit-in-map' => 'Fit in the box (Map only)',
				'fullscreen-map' => 'Full screen Map (Map only)',
				'm-con' => 'Map with carousel on top',
				'fit-in-map-top-carousel' => 'Fit in the box with carousel on top',
				'fullscreen-map-top-carousel' => 'Full screen Map with carousel on top',
				'map-tglc-top' => 'Map, toggle carousel from top',
				'map-tglc-bottom' => 'Map, toggle carousel from bottom',
				//'map-tglc-left' => 'Map, toggle carousel from left <sup class="cspm_new_tag">NEW</sup>',
				//'map-tglc-right' => 'Map, toggle carousel from right <sup class="cspm_new_tag">NEW</sup>',	
            )
        ),		
        array(
            'id' => 'layout_type',
            'title' => 'Layout type',
            'desc' => 'Select main layout type.',
            'type' => 'radio',
            'std' => 'full_width',
            'choices' => array(
                'fixed' => 'Fixed width &amp; Fixed height',
                'full_width' => 'Full width &amp; Fixed height',
				'responsive' => 'Responsive layout <sup>(Hide the carousel on mobile browsers)</sup>'
            )
        ),
        array(
            'id' => 'layout_fixed_width',
            'title' => 'Layout width',
            'desc' => 'Select the width (in pixels) of the layout. (Works only for the fixed layout)',
            'type' => 'text',
            'std' => '700'		
        ),	
        array(
            'id' => 'layout_fixed_height',
            'title' => 'Layout height',
            'desc' => 'Select the height (in pixels) of the layout.',
            'type' => 'text',
            'std' => '600'		
        ),	
	)
		
);


/**
 * Map Settings section */

$wpsf_settings[] = array(
    'section_id' => 'mapsettings',
    'section_title' => 'Map Settings <sup class="cspm_plus_tag">Plus+</sup>',
    'section_description' => 'The maps displayed through the Google Maps API contain UI elements to allow user interaction with the map. These elements are known as controls and you can include and/or customize variations of these controls in your map.',
    'section_order' => 3,
    'fields' => array(
		array(
            'id' => 'api_key',
            'title' => 'API Key <sup class="cspm_new_tag">NEW</sup>',
			/**
			 * https://developers.google.com/maps/signup?csw=1#google-maps-javascript-api */
            'desc' => 'Enter your Google Maps API key.<br /><strong>Note:</strong> The Google Maps JavaScript API does not require an API key to function correctly. However, Google strongly encourage you to load the Maps API using an APIs Console key which allows you to monitor your application\'s Maps API usage.<br />
					  <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">Get an API key</a>',
            'type' => 'text',
            'std' => '',
        ),	
		array(
            'id' => 'map_language',
            'title' => 'Map language',
            'desc' => 'Localize your Maps API application by altering default language settings. See also the <a href="https://developers.google.com/maps/faq#using-google-maps-apis" target="_blank">supported list of languages</a>.',
            'type' => 'text',
            'std' => 'en'		
        ),
        array(
            'id' => 'map_center',
            'title' => 'Map center',
            'desc' => 'Enter a center point for the map. (Latitude then Longitude separated by comma). Refer to <a href="https://maps.google.com/" target="_blank">https://maps.google.com/</a> to get you center point.',
            'type' => 'text',
            'std' => '51.53096,-0.121064'		
        ),
        array(
            'id' => 'initial_map_style',
            'title' => 'Initial style',
            'desc' => 'Select the initial map style. <span style="color:red;">If you select "Custom style" you must choose one of the available styles in the section "Map style settings".</span>',
            'type' => 'radio',
            'std' => 'ROADMAP',
            'choices' => array(
				'ROADMAP' => 'Map',
				'SATELLITE' => 'Satellite',
				'TERRAIN' => 'Terrain',
				'HYBRID' => 'Hybrid',
				'custom_style' => 'Custom style'
            )
        ),		
		array(
            'id' => 'map_zoom',
            'title' => 'Map zoom',
            'desc' => 'Select the map zoom.',
            'type' => 'select',
            'std' => '12',
            'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19'
            )
        ),
		array(
            'id' => 'max_zoom',
            'title' => 'Max. zoom',
            'desc' => 'Select the max zoom of the map.',
            'type' => 'select',
            'std' => '19',
            'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19'
            )
        ),
		array(
            'id' => 'min_zoom',
            'title' => 'Min. zoom',
            'desc' => 'Select the min. zoom of the map. <span style="color:red;">The Min. zoom should be lower than the Max. zoom!</span>',
            'type' => 'select',
            'std' => '0',
            'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19'
            )
        ),
		array(
            'id' => 'zoom_on_doubleclick',
            'title' => 'Zoom on double click',
            'desc' => 'Enables/disables zoom and center on double click. Disables by default.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'false' => 'Enable',
				'true' => 'Disable'
            )
        ),
        array(
            'id' => 'map_draggable',
            'title' => 'Draggable',
            'desc' => 'If Yes, prevents the map from being dragged. Dragging is enabled by default.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'useClustring',
            'title' => 'Clustering',
            'desc' => 'Clustering simplifies your data visualization by consolidating data that are nearby each other on the map in an aggregate form.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'gridSize',
            'title' => 'Grid size',
            'desc' => 'Grid size or Grid-based clustering works by dividing the map into squares of a certain size (the size changes at each zoom) and then grouping the markers into each grid square.',
            'type' => 'text',
            'std' => '60'		
        ),
		array(
            'id' => 'autofit',
            'title' => 'Autofit',
            'desc' => 'This option extends map bounds to contain all markers & clusters.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'traffic_layer',
            'title' => 'Traffic Layer',
            'desc' => 'Display current road traffic.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
		array(
            'id' => 'transit_layer',
            'title' => 'Transit Layer',
            'desc' => 'Display local Transit route information.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'geotarget_section',
            'title' => '<span class="section_sub_title">Geotarget parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),				
        array(
            'id' => 'geoIpControl',
            'title' => 'Geo targeting',
            'desc' => 'The Geo targeting is the method of determining the geolocation of a website visitor.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
		array(
            'id' => 'show_user',
            'title' => 'Show user location?',
            'desc' => 'Show a marker indicating the location of the user when choosing to share their location.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),			
		array(
            'id' => 'user_marker_icon',
            'title' => 'User Marker image',
            'desc' => 'Upload a marker image to display as the user location. When empty, the map will display the default marker of Google Map.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'user_map_zoom',
            'title' => 'Geotarget Zoom',
            'desc' => 'Select the zoom of the map after indicating the location of the user.',
            'type' => 'select',
            'std' => '12',
            'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19'
            )
        ),	
		array(
            'id' => 'user_circle',
            'title' => 'Draw a Circle around the user\'s location',
            'desc' => 'Use this field to draw a circle within a certain distance of the user\'s location. Set to 0 to ignore this option.
					  <br /><strong>The value must be a number (e.g. 10).</strong>.
					  <br /><strong>Note: The circle will use the Distance unit & the style defined in "Search Form settings".</strong>',
            'type' => 'text',
            'std' => '0'
        ),						
		array(
            'id' => 'ui_elements_section',
            'title' => '<span class="section_sub_title">UI elements</span>',
            'desc' => '',
            'type' => 'custom',
        ),	
        array(
            'id' => 'mapTypeControl',
            'title' => 'Show map type control',
            'desc' => 'The MapType control lets the user toggle between map types (such as ROADMAP and SATELLITE). This control appears by default in the top right corner of the map.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'streetViewControl',
            'title' => 'Show street view control',
            'desc' => 'The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control appears by default in the right top corner of the map.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'scrollwheel',
            'title' => 'Scroll wheel',
            'desc' => 'Allow/Disallow the zoom-in and zoom-out of the map using the scroll wheel.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'panControl',
            'title' => 'Show pan control',
            'desc' => 'The Pan control displays buttons for panning the map. This control appears by default in the right top corner of the map.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'zoomControl',
            'title' => 'Show zoom control',
            'desc' => 'The Zoom control displays a small "+/-" buttons to control the zoom level of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom left corner on touch devices.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'zoomControlType',
            'title' => 'Zoom control Type',
            'desc' => 'Select the zoom control type.',
            'type' => 'radio',
            'std' => 'customize',
            'choices' => array(
				'customize' => 'Customized type',
				'default' => 'Default type'
            )
        ),
		array(
            'id' => 'markers_customizations_section',
            'title' => '<span class="section_sub_title">Markers Customizations</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'retinaSupport',
            'title' => 'Retina support',
            'desc' => 'Enable retina support for custom markers & Clusters images. When enabled, make sure the uploaded image is twice the size you want it to be displayed in the map. 
			           For example, if you want the marker/cluster image in the map to be displayed at 20x30 pixels, upload an image with 40x60 pixels.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Enable',
				'false' => 'Disable'
            )
        ),																
        array(
            'id' => 'defaultMarker',
            'title' => 'Marker type',
            'desc' => 'Select the marker type.',
            'type' => 'radio',
            'std' => 'customize',
            'choices' => array(
				'customize' => 'Customized type',
				'default' => 'Default type'
            )
        ),	
		array(
            'id' => 'markerAnimation',
            'title' => 'Marker animation',
            'desc' => 'You can animate a marker so that it exhibit a dynamic movement when it\'s been fired. To specify the way a marker is animated, select
					   one of the supported animations above.',
            'type' => 'radio',
            'std' => 'pulsating_circle',
            'choices' => array(
				'pulsating_circle' => 'Pulsating circle',
				'bouncing_marker' => 'Bouncing marker',
				'flushing_infobox' => 'Flushing infobox <sup>Use only when <strong>Show infobox</strong> is set to <strong>Yes</strong></sup>'				
            )
        ),						
        array(
            'id' => 'marker_icon',
            'title' => 'Marker image',
            'desc' => 'Upload a new marker image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'marker_anchor_point_option',
            'title' => 'Set the anchor point',
            'desc' => 'Depending of the shape of the marker, you may not want the middle of the bottom edge to be used as the anchor point. 
					   In this situation, you need to specify the anchor point of the image. A point is defined with an X and Y value (in pixels). 
					   So if X is set to 10, that means the anchor point is 10 pixels to the right of the top left corner of the image. Setting Y to 10 means 
					   that the anchor is 10 pixels down from the top right corner of the image.',
            'type' => 'radio',
            'std' => 'disable',
            'choices' => array(
				'auto' => 'Auto detect <sup>*Detects the center of the image.</sup>',
				'manual' => 'Manualy <sup>*Enter the anchor point in the next two fields.</sup>',
				'disable' => 'Disable'				
            )
        ),
		array(
            'id' => 'marker_anchor_point',
            'title' => 'Marker anchor point',
            'desc' => 'Enter the anchor point of the Marker image. Seperate X and Y by comma. (e.g. 10,15)',
            'type' => 'text',
            'std' => ''
        ),	
		array(
            'id' => 'clusters_customizations_section',
            'title' => '<span class="section_sub_title">Clusters Customizations</span>',
            'desc' => '',
            'type' => 'custom',
        ),				
        array(
            'id' => 'big_cluster_icon',
            'title' => 'Large cluster image',
            'desc' => 'Upload a new large cluster image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'medium_cluster_icon',
            'title' => 'Medium cluster image',
            'desc' => 'Upload a new medium cluster image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'small_cluster_icon',
            'title' => 'Small cluster image',
            'desc' => 'Upload a new small cluster image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'cluster_text_color',
            'title' => 'Clusters text color',


            'desc' => 'Change the text color of all your clusters.',
            'type' => 'color',
            'std' => ''
        ),
		array(
            'id' => 'zoom_customizations_section',
            'title' => '<span class="section_sub_title">Zoom Buttons Customizations</span>',
            'desc' => '',
            'type' => 'custom',
        ),				
        array(
            'id' => 'zoom_in_icon',
            'title' => 'Zoom-in image',
            'desc' => 'Upload a new zoom-in button image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'zoom_in_css',
            'title' => 'Zoom-in CSS',
            'desc' => 'Enter your custom CSS to customize the zoom-in button.<br /><strong>e.g.</strong> border:1px solid; ...',
            'type' => 'textarea',
            'std' => ''
        ),					
        array(
            'id' => 'zoom_out_icon',
            'title' => 'Zoom-out image',
            'desc' => 'Upload a new zoom-out button image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),		
		array(
            'id' => 'zoom_out_css',
            'title' => 'Zoom-out CSS',
            'desc' => 'Enter your custom CSS to customize the zoom-out button.<br /><strong>e.g.</strong> border:1px solid; ...',
            'type' => 'textarea',
            'std' => ''
        ),			
    )
);
	
/**
 * map styles section */

$wpsf_settings[] = array(
    'section_id' => 'mapstylesettings',
    'section_title' => 'Map Style Settings',
    'section_description' => 'Styled maps allow you to customize the presentation of the standard Google base maps, changing the visual display of such elements as roads, parks, and built-up areas. The lovely styles below are provided by <a href="http://snazzymaps.com" target="_blank">Snazzy Maps</a>',
    'section_order' => 4,
    'fields' => array(
		array(
            'id' => 'faceted_search_alert_msg',
            'title' => '<span class="section_sub_title cspacing_notice">IMPORTANT!<br /> The Custom Map Style can not be operated without activating the option "Custom style" in "Map Settings => Initial style"</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'style_option',
            'title' => 'Style option', 
            'desc' => 'Select the style option of the map. If you select <strong>Progress map styles</strong>, choose on the available styles below.
			           If you select <strong>My custom style</strong>, enter your custom style code in the field <strong>Javascript Style Array</strong>.',
            'type' => 'radio',
            'std' => 'progress-map',
            'choices' => array(
				'progress-map' => 'Progress Map styles',
				'custom-style' => 'My custom style'
            )
        ),			
        array(
            'id' => 'map_style',
            'title' => 'Map style',
            'desc' => 'Select your map style.',
            'type' => 'radio',
            'std' => 'google-map',
            'choices' => $map_styles_array
        ),
		array(
            'id' => 'custom_style_name',
            'title' => 'Custom style name',
            'desc' => 'Enter your custom style name. Only available if your style option is "My custom style". If empty, the name "Custom style" is used.',
            'type' => 'text',
            'std' => 'Custom style',
        ),
		array(
            'id' => 'js_style_array',
            'title' => 'Javascript Style Array',
            'desc' => 'If you don\'t like any of the styles above, fell free to add your own style. Please include just the array definition. No extra variables or code.<br />
					  Make use of the following services to create your style:<br />
					  . <a href="http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html" target="_blank">Styled Maps Wizard by Google</a><br />
					  . <a href="http://www.evoluted.net/thinktank/web-design/custom-google-maps-style-tool" target="_blank">Custom Google Maps Style Tool by Evoluted</a><br />
					  . <a href="http://software.stadtwerk.org/google_maps_colorizr/" target="_blank">Google Maps Colorizr by stadt werk</a><br />			  					  
			          You may also like to <a href="http://snazzymaps.com/submit" target="_blank">submit</a> your style for the world to see :)',
            'type' => 'textarea',
            'std' => '',
        ),	
	)
);

/**
 * Infowindow settings */

$wpsf_settings[] = array(
    'section_id' => 'infoboxsettings',
    'section_title' => 'Infobox Settings',
    'section_description' => 'The infobox, also called infowindow is an overlay that looks like a bubble and is often connected to a marker.',
    'section_order' => 5,
    'fields' => array(
		array(
            'id' => 'show_infobox',
            'title' => 'Show Infobox',
            'desc' => 'Show/Hide the Infobox.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
        array(
            'id' => 'infobox_type',
            'title' => 'Infobox type',
            'desc' => 'Select the Infobox type. <strong>Hover over the options to see an image of the infobox style</strong>.<br />
					  <span style="color:red"><strong style="font-size:14px;"><u>How to use your theme\'s "functions.php" file to override the infobox\'s Title & Content in order to display your custom title & content?</u></strong><br /><br />
					  
					  1) To override the infobox Title, make use of the hook <strong>"cspm_custom_infobox_title"</strong>. Open your theme\'s "functions.php" file and copy the following code:</span>
					  <pre class="cspm_pre">
&lt;?php
function cspm_custom_infobox_title($default_title, $post_id){

	$custom_title = "YOUR CUSTOM TITLE HERE. IT COULD BE A CUSTOM FIELD OR WHATEVER YOU LIKE TO PRINT.";
	
	return (!empty($custom_title)) ? $custom_title : $default_title;

}
add_filter("cspm_custom_infobox_title", "cspm_custom_infobox_title", 10, 2);
?&gt;</pre>
					  <span style="color:red; font-style:italic; font-size:12px;">
					  2) To override the infobox Content, make use of the hooks <strong>"cspm_custom_infobox_description"</strong> and <strong>"cspm_large_infobox_content"</strong>.<br /><br />
					  <strong>[cspm_custom_infobox_description]</strong> is reserved for the <u>"Infobox 1"</u>.<br /><br />
					  <strong>[cspm_large_infobox_content]</strong> is reserved for the <u>Large infobox</u>.<br /><br />
					  Open your theme\'s "functions.php" file and copy the following code:</span>
					  </span>
					  <pre class="cspm_pre">
&lt;?php
function cspm_custom_infobox_description($default_description, $post_id){

	$custom_content = "YOUR CUSTOM CONTENT HERE.";
	
	return (!empty($custom_content)) ? $custom_content : $default_description;

}
add_filter("cspm_custom_infobox_description", "cspm_custom_infobox_description", 10, 2);
add_filter("cspm_large_infobox_content", "cspm_custom_infobox_description", 10, 2);
?&gt;</pre>',
            'type' => 'radio',
            'std' => 'rounded_bubble',
            'choices' => array(				
				'square_bubble' => 'Square bubble',
				'rounded_bubble' => 'Rounded bubble',				
				'cspm_type1' => 'Infobox 1',
				'cspm_type2' => 'Infobox 2',
				'cspm_type3' => 'Infobox 3',
				'cspm_type4' => 'Infobox 4',
				'cspm_type5' => 'Large Infobox',												
            )
        ),		
		array(
            'id' => 'infobox_display_event',
            'title' => 'Display event',
            'desc' => 'Select from the options above when the infoboxes should be displayed in the map.',
            'type' => 'radio',
            'std' => 'onload',
            'choices' => array(
				'onload' => 'On map load <sup>(Load all infoboxes)</sup>',
				'onclick' => 'On marker click',
				'onhover' => 'On marker hover'
            )
        ),
		array(
            'id' => 'remove_infobox_on_mouseout',
            'title' => 'Remove Infobox on mouseout?',
            'desc' => 'Choose whether you want to remove the infobox when the mouse leaves the marker or not. <span style="color:red">This option is operational only when the <strong>Display event</strong> 
					  equals to <strong>On marker click</strong> or <strong>On marker hover</strong></span>',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'infobox_external_link',
            'title' => 'Post URL',
            'desc' => 'Choose an option to open the single post page. You can also disable links in the infoboxes by selecting the option "Disable"',
            'type' => 'radio',
            'std' => 'same_window',
            'choices' => array(
				'new_window' => 'Open in a new window',
				'same_window' => 'Open in the same window',
				'disable' => 'Disable'
            )
        ),		
	)
);


/**
 * Marker cetgories section */

$wpsf_settings[] = array(
    'section_id' => 'markercategoriessettings',
    'section_title' => 'Marker Categories Settings',
    'section_description' => 'In this section, you will be able to upload custom icons for your markers. To do that, choose from the available taxonomies the one that represent the category of your posts/locations, set the option "Marker Categories Option" to "Yes", 
							 then, upload a custom icon for each category of markers.',
    'section_order' => 6,
    'fields' => array(	
        array(
            'id' => 'marker_cats_settings',
            'title' => 'Marker categories option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
		array(
            'id' => 'marker_categories_section',
            'title' => '<span class="section_sub_title">Marker categories</span>',
            'desc' => '',
            'type' => 'custom',
        ),								
		array(
            'id' => 'marker_categories_desc_section',
            'title' => '<span class="section_sub_title cspacing_info">Upload your custom marker image for each category.<br />If one of the categories doesn\'t have a marker image  
			            or you don\'t want to use the custom markers at all, the default marker will be used instead.<br />If a post have more than one category, the plugin will call 
						the marker image of the first category in the list.</span>',
            'desc' => '',
            'type' => 'custom',
        ),									
	)
);


/**
 * KML Layers settings 
 * @since 2.7 */
 
$wpsf_settings[] = array(
    'section_id' => 'kmlsettings',
    'section_title' => 'KML Layers Settings',
    'section_description' => 'Layers are objects on the map that consist of one or more separate items, but are manipulated as a single unit. Layers generally reflect collections of objects that you add on top of the map to designate a common association. The Google Maps API manages the presentation of objects within layers by rendering their constituent items into one object (typically a tile overlay) and displaying them as the map\'s viewport changes. Layers may also alter the presentation layer of the map itself, slightly altering the base tiles in a fashion consistent with the layer.',
    'section_order' => 7,
    'fields' => array(
		array(
            'id' => 'use_kml',
            'title' => 'KML Layers option',
            'desc' => 'Select "Yes" to enable the KML Layers option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
 		array(
            'id' => 'kml_file',
            'title' => 'KML/KMZ File URL',
            'desc' => 'Supply a link to a KML file or KMZ file that\'s already <span style="color:red">hosted on the Internet</span>. You can use this <a target="_blank" href="https://kml-samples.googlecode.com/svn/trunk/interactive/index.html">online tool</a> to build your kml file.
					   <br /><span style="color:red">1. Note: You can use the Media Library to upload your file, then, paste its URL in this field.</span>
					   <br /><span style="color:red">2. Note: You can override the file URL using the shortcode attribute <strong>"kml_file"</strong>.<br />
					   <strong>Example: <br />[codespacing_progress_map kml_file="YOUR_FILE_URL"]</strong></span>',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'id' => 'suppressInfoWindows',
            'title' => 'Suppress Infowindows',
            'desc' => 'Suppress the rendering of info windows when layer features are clicked. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'preserveViewport',
            'title' => 'Preserve Viewport',
            'desc' => 'Select whether you want to center and zoom the map to the bounding box of the contents of the layer. If this option is set to "Yes", the viewport is left unchanged. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
	)
); 


/**
 * Overlays (Polygon, Polyline) settings 
 * @since 2.7 */
 
$wpsf_settings[] = array(
    'section_id' => 'overlayssettings',
    'section_title' => 'Overlays Settings',
    'section_description' => 'You can add objects to the map to designate points, lines, areas, or collections of objects. The Google Maps JavaScript API calls these objects overlays. Overlays are tied to latitude/longitude coordinates, so they move when you drag or zoom the map.',
    'section_order' => 8,
    'fields' => array(
		
		/**
		 * Polyline */
		 
		array(
            'id' => 'polyline_section',
            'title' => '<span class="section_sub_title">Polylines</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
		array(
            'id' => 'polyline_desc_section',
            'title' => '<span class="section_sub_title cspacing_info">To draw a line on your map, use a polyline. The Polyline class defines a linear overlay of connected line segments on the map. A Polyline object consists of an array of LatLng locations, and creates a series of line segments that connect those locations in an ordered sequence.</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
		array(
            'id' => 'draw_polyline',
            'title' => 'Draw Polyline option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
			'id' => 'polylines',
            'title' => 'Polylines',
            'desc' => 'Click on the button "Add New" to add a new polyline. You can add Multiple polylines!',
			'type' => 'tag',
			'helpers_container_id' => 'polyline',
			'helpers' => array(	
				array(
					'id' => 'tag_polyline_label',
					'title' => 'Polyline Label', 
					'desc' => 'Give a label to this Polyline. The Label will help to distinct a polyline between multiple Polylines. (Example: "Lodon Polyline")',
					'type' => 'text',
					'std' => '',
					'class' => 'required',
				),
				array(
					'id' => 'tag_polyline_name',
					'title' => 'Polyline ID/Name', 
					'desc' => 'Give a unique ID/Name to this Polyline. <span style="color:red">If two polylines has the same IDs/Names, the last added polyline will override the old polyline.</span> (Example: "london_polyline")',
					'type' => 'text',
					'std' => '',
					'class' => 'required',
				),																					
				array(
					'id' => 'tag_polyline_path',
					'title' => 'Polyline Path', 
					'desc' => 'The ordered sequence of coordinates of the Polyline. Enter the LatLng coordinates of the locations that will be connected as a polyline. Put each line segment (LatLng) as <strong>[Lat,Lng]</strong> seperated by comma (see example 1).
							   <br /><span style="color:red">Example 1: [45.5215,-1.5245],[41.2587,1.2479],[40.1649,1.9879]</span>
							   <br /><strong><strong><u>Note:</u></strong> You can also use your post IDs as line segments. Each post ID will be replaced by the post\'s LatLng coordinates (see example 2). Post IDs seperated by comma!</strong>
							   <br /><span style="color:red">Example 2: 154,254,120,100</span>
							   <br /><u>Note:</u> The polyline order is defined by the order of the <u>line segments</u>/<u>post IDs</u>.',
					'type' => 'textarea',
					'std' => '',
					'class' => 'required'
				),
				array(
					'id' => 'tag_polyline_geodesic',
					'title' => 'Geodesic',
					'desc' => 'When "Yes", edges of the polyline are interpreted as geodesic and will follow the curvature of the Earth. When "No", edges of the polyline are rendered as straight lines in screen space. Defaults "No".',
					'type' => 'radio',
					'std' => 'false',
					'choices' => array(
						'true' => 'Yes',
						'false' => 'No'
					)
				),
				array(
					'id' => 'tag_polyline_strokeColor',
					'title' => 'Stroke color',
					'desc' => 'The stroke color. Default "#189AC9".',
					'type' => 'color',
					'std' => '#189AC9',
				),		
				array(
					'id' => 'tag_polyline_strokeOpacity',
					'title' => 'Stroke opacity',
					'desc' => 'The stroke opacity between 0.0 and 1. Default "1".',
					'type' => 'select',
					'std' => '1',
					'choices' => array(
						'0.0' => '0.0',
						'0.1' => '0.1',
						'0.2' => '0.2',
						'0.3' => '0.3',
						'0.4' => '0.4',
						'0.5' => '0.5',
						'0.6' => '0.6',
						'0.7' => '0.7',
						'0.8' => '0.8',
						'0.9' => '0.9',
						'1' => '1',
					)			
				),	
				array(
					'id' => 'tag_polyline_strokeWeight',
					'title' => 'Stroke weight',
					'desc' => 'The stroke width in pixels. Default "2".',
					'type' => 'text',
					'std' => '2',
				),
				array(
					'id' => 'tag_polyline_zIndex',
					'title' => 'zIndex',
					'desc' => 'The zIndex compared to other polylines.',
					'type' => 'text',
					'std' => '',
				),
				array(
					'id' => 'tag_polyline_visibility',
					'title' => 'Visibility',
					'desc' => 'Whether this polyline is visible on the map. Defaults "Yes".',
					'type' => 'radio',
					'std' => 'true',
					'choices' => array(
						'true' => 'Yes',
						'false' => 'No'
					)
				),
				array(
					'id' => 'add_polyline',
					'helpers_id' => 'polyline',
					'type' => 'submit_tag'
				)
			)
		),
		
		/**
		 * Polygon */
		
		array(
            'id' => 'polygon_section',
            'title' => '<span class="section_sub_title">Polygons</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
		array(
            'id' => 'polygon_desc_section',
            'title' => '<span class="section_sub_title cspacing_info">A polygon represents an area enclosed by a closed path (or loop), which is defined by a series of coordinates. Polygon objects are similar to Polyline objects in that they consist of a series of coordinates in an ordered sequence. Polygons are drawn with a stroke and a fill. You can define custom colors, weights, and opacities for the edge of the polygon (the stroke) and custom colors and opacities for the enclosed area (the fill).</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
		array(
            'id' => 'draw_polygon',
            'title' => 'Draw Polygon option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
			'id' => 'polygons',
            'title' => 'Polygons',
            'desc' => 'Click on the button "Add New" to add a new polygon. You can add Multiple polygons!',
			'type' => 'tag',
			'helpers_container_id' => 'polygon',
			'helpers' => array(	
				array(
					'id' => 'tag_polygon_label',
					'title' => 'Polygon Label', 
					'desc' => 'Give a label to this Polygon. The Label will help to distinct a polygon between multiple Polygons. (Example: "Lodon Polygon")',
					'type' => 'text',
					'std' => '',
					'class' => 'required',
				),
				array(
					'id' => 'tag_polygon_name',
					'title' => 'Polygon ID/Name', 
					'desc' => 'Give a unique ID/Name to this Polygon. <span style="color:red">If two polygons has the same IDs/Names, the last added polygon will override the old polygon.</span> (Example: "london_polygon")',
					'type' => 'text',
					'std' => '',
					'class' => 'required',
				),																					
				array(
					'id' => 'tag_polygon_path',
					'title' => 'Polygon Path', 
					'desc' => 'The ordered sequence of coordinates of the Polygon. Enter the LatLng coordinates of the locations that will be connected as a polygon. Put each line segment (LatLng) as <strong>[Lat,Lng]</strong> seperated by comma (see example 1).
							   <br /><span style="color:red">Example 1: [45.5215,-1.5245],[41.2587,1.2479],[40.1649,1.9879]</span>
							   <br /><strong><strong><u>Note:</u></strong> You can also use your post IDs as line segments. Each post ID will be replaced by the post\'s LatLng coordinates (see example 2). Post IDs seperated by comma!</strong>
							   <br /><span style="color:red">Example 2: 154,254,120,100</span>
							   <br /><u>Note:</u> The polygon order is defined by the order of the <u>line segments</u>/<u>post IDs</u>.',
					'type' => 'textarea',
					'std' => '',
					'class' => 'required'
				),
				array(
					'id' => 'tag_polygon_fillColor',
					'title' => 'Fill color',
					'desc' => 'The fill color. Default "#189AC9".',
					'type' => 'color',
					'std' => '#189AC9',
				),		
				array(
					'id' => 'tag_polygon_fillOpacity',
					'title' => 'Fill opacity',
					'desc' => 'The fill opacity between 0.0 and 1. Default "1".',
					'type' => 'select',
					'std' => '1',
					'choices' => array(
						'0.0' => '0.0',
						'0.1' => '0.1',
						'0.2' => '0.2',
						'0.3' => '0.3',
						'0.4' => '0.4',
						'0.5' => '0.5',
						'0.6' => '0.6',
						'0.7' => '0.7',
						'0.8' => '0.8',
						'0.9' => '0.9',
						'1' => '1',
					)			
				),				
				array(
					'id' => 'tag_polygon_geodesic',
					'title' => 'Geodesic',
					'desc' => 'When "Yes", edges of the polygon are interpreted as geodesic and will follow the curvature of the Earth. When "No", edges of the polygon are rendered as straight lines in screen space. Defaults "No".',
					'type' => 'radio',
					'std' => 'false',
					'choices' => array(
						'true' => 'Yes',
						'false' => 'No'
					)
				),
				array(
					'id' => 'tag_polygon_strokeColor',
					'title' => 'Stroke color',
					'desc' => 'The stroke color. Default "#189AC9".',
					'type' => 'color',
					'std' => '#189AC9',
				),		
				array(
					'id' => 'tag_polygon_strokeOpacity',
					'title' => 'Stroke opacity',
					'desc' => 'The stroke opacity between 0.0 and 1. Default "1".',
					'type' => 'select',
					'std' => '1',
					'choices' => array(
						'0.0' => '0.0',
						'0.1' => '0.1',
						'0.2' => '0.2',
						'0.3' => '0.3',
						'0.4' => '0.4',
						'0.5' => '0.5',
						'0.6' => '0.6',
						'0.7' => '0.7',
						'0.8' => '0.8',
						'0.9' => '0.9',
						'1' => '1',
					)			
				),	
				array(
					'id' => 'tag_polygon_strokeWeight',
					'title' => 'Stroke weight',
					'desc' => 'The stroke width in pixels. Default "2".',
					'type' => 'text',
					'std' => '2',
				),
				/*array(
					'id' => 'tag_polygon_strokePosition',
					'title' => 'Stroke Position',
					'desc' => 'The stroke position. Defaults "CENTER". This property is not supported on Internet Explorer 8 and earlier.',
					'type' => 'radio',
					'std' => 'true',
					'choices' => array(
						'CENTER' => 'CENTER <sup>The stroke is centered on the polygon\'s path, with half the stroke inside the polygon and half the stroke outside the polygon.</sup>',
						'INSIDE' => 'INSIDE <sup>The stroke lies inside the polygon.</sup>',
						'OUTSIDE' => 'OUTSIDE <sup>The stroke lies outside the polygon.</sup>'
					)
				),*/
				array(
					'id' => 'tag_polygon_zIndex',
					'title' => 'zIndex',
					'desc' => 'The zIndex compared to other polygons.',
					'type' => 'text',
					'std' => '',
				),
				array(
					'id' => 'tag_polygon_visibility',
					'title' => 'Visibility',
					'desc' => 'Whether this polyline is visible on the map. Defaults "Yes".',
					'type' => 'radio',
					'std' => 'true',
					'choices' => array(
						'true' => 'Yes',
						'false' => 'No'
					)
				),
				array(
					'id' => 'add_polygon',
					'helpers_id' => 'polygon',
					'type' => 'submit_tag'
				)
			)
		),				 		
	)
);	


/**
 * Carousel Settings section */

$wpsf_settings[] = array(
    'section_id' => 'carouselsettings',
    'section_title' => 'Carousel Settings',
    'section_description' => 'Use this interface to control the carousel settings.',
    'section_order' => 9,
    'fields' => array(
        array(
            'id' => 'show_carousel',
            'title' => 'Show carousel',
            'desc' => 'Show/Hide the map\'s carousel.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'carousel_mode',
            'title' => 'Mode',
            'desc' => 'Specifies wether the carousel appears in RTL mode or LTR mode.',
            'type' => 'select',
            'std' => 'false',
            'choices' => array(
				'true' => 'Right-to-left',
				'false' => 'Left-to-right'
            )
        ),
        array(
            'id' => 'carousel_scroll',
            'title' => 'Scroll',
            'desc' => 'The number of items to scroll by.',
            'type' => 'text',
            'std' => '1',
        ),
        array(
            'id' => 'carousel_animation',
            'title' => 'Animation',
            'desc' => 'The speed of the scroll animation ("slow" or "fast").',
            'type' => 'select',
            'std' => 'fast',
            'choices' => array(
				'slow' => 'slow',
				'fast' => 'Fast'
            )
        ),
        array(
            'id' => 'carousel_easing',
            'title' => 'Easing',
            'desc' => 'The name of the easing effect that you want to use. <a href="http://jqueryui.com/resources/demos/effect/easing.html" target="_blank">(See jQuery Demo)</a>',
            'type' => 'select',
            'std' => 'linear',
            'choices' => array(
				'linear' => 'linear',
				'swing' => 'swing',
				'easeInQuad' => 'easeInQuad',
				'easeOutQuad' => 'easeOutQuad',
				'easeInOutQuad' => 'easeInOutQuad',
				'easeInCubic' => 'easeInCubic',
				'easeOutCubic' => 'easeOutCubic',
				'easeInOutCubic' => 'easeInOutCubic',
				'easeInQuart' => 'easeInQuart',
				'easeOutQuart' => 'easeOutQuart',
				'easeInOutQuart' => 'easeInOutQuart',
				'easeInQuint' => 'easeInQuint',
				'easeOutQuint' => 'easeOutQuint',
				'easeInOutQuint' => 'easeInOutQuint',
				'easeInExpo' => 'easeInExpo',
				'easeOutExpo' => 'easeOutExpo',
				'easeInOutExpo' => 'easeInOutExpo',
				'easeInSine' => 'easeInSine',
				'easeOutSine' => 'easeOutSine',
				'easeInOutSine' => 'easeInOutSine',
				'easeInCirc' => 'easeInCirc',
				'easeOutCirc' => 'easeOutCirc',
				'easeInOutCirc' => 'easeInOutCirc',
				'easeInElastic' => 'easeInElastic',
				'easeOutElastic' => 'easeOutElastic',
				'easeInOutElastic' => 'easeInOutElastic',
				'easeInBack' => 'easeInBack',
				'easeOutBack' => 'easeOutBack',
				'easeInOutBack' => 'easeInOutBack',
				'easeInBounce' => 'easeInBounce',
				'easeOutBounce' => 'easeOutBounce',
				'easeInOutBounce' => 'easeInOutBounce',
            )
        ),		
        array(
            'id' => 'carousel_auto',
            'title' => 'Auto',
            'desc' => 'Specifies how many seconds to periodically autoscroll the content. If set to 0 (default) then autoscrolling is turned off.',
            'type' => 'text',
            'std' => '0',
        ),
        array(
            'id' => 'carousel_wrap',
            'title' => 'Wrap',
            'desc' => 'Specifies whether to wrap at the first/last item (or both) and jump back to the start/end. If set to null, wrapping is turned off.',
            'type' => 'select',
            'std' => 'circular',
            'choices' => array(
				'first' => 'First',
				'last' => 'Last',
				'both' => 'Both',
				'circular' => 'Circular',
				'null' => 'Null'
            )
        ),
        array(
            'id' => 'scrollwheel_carousel',
            'title' => 'Scroll wheel',
            'desc' => 'Move the carousel with scroll wheel.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
        array(
            'id' => 'touchswipe_carousel',
            'title' => 'Touch swipe',
            'desc' => 'Move the carousel with touch swipe.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
		array(
            'id' => 'move_carousel_on',
            'title' => 'Move on ...',
            'desc' => 'Select from the following options when to move the carousel.',
            'type' => 'checkboxes',
            'std' => array('marker_click', 'marker_hover', 'infobox_hover'),
            'choices' => array(
				'marker_click' => 'Marker click',
				'marker_hover' => 'Marker hover',
				'infobox_hover' => 'Infobox Hover'
            )
        ),					
		array(
            'id' => 'carousel_map_zoom',
            'title' => 'Map zoom',
            'desc' => 'Select the map zoom when an item is selected in the carousel.',
            'type' => 'select',
            'std' => '12',
            'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19'
            )
        ),		
	)

);	


/**
 * Carousel Style section */

$wpsf_settings[] = array(
    'section_id' => 'carouselstyle',
    'section_title' => 'Carousel Style',
    'section_description' => 'Use this interface to customize the carousel style.',
    'section_order' => 10,
    'fields' => array(
        array(
            'id' => 'carousel_css',
            'title' => 'Carousel CSS',
            'desc' => 'Add your custom CSS to customize the carousel style.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'id' => 'arrows_background',
            'title' => 'Arrows background color',
            'desc' => 'Use this field to change the default background color of the arrows. Leave this field empty or add # for transparent background.',
            'type' => 'color',
            'std' => '#fff'
        ),		
        array(
            'id' => 'horizontal_left_arrow_icon',
            'title' => 'Horizontal left arrow image',
            'desc' => 'Upload a new left arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'horizontal_right_arrow_icon',
            'title' => 'Horizontal right arrow image',
            'desc' => 'Upload a new right arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'vertical_top_arrow_icon',
            'title' => 'Vertical top arrow image',
            'desc' => 'Upload a new top arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'vertical_bottom_arrow_icon',
            'title' => 'Vertical bottom arrow image',
            'desc' => 'Upload a new bottom arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),	
        array(
            'id' => 'items_background',
            'title' => 'Carousel items background color',
            'desc' => 'Use this field to change the default background color of the carousel items.',
            'type' => 'color',
            'std' => '#fff'
        ),
		array(
            'id' => 'items_hover_background',
            'title' => 'Active carousel items background color',
            'desc' => 'Use this field to change the default background color of the carousel items when one of them is selected.',
            'type' => 'color',
            'std' => '#fbfbfb'
        ),		
	)
);


/**
 * Items settings */

$wpsf_settings[] = array(
    'section_id' => 'itemssettings',
    'section_title' => 'Carousel Items Settings',
    'section_description' => 'Use this interface to customize the carousel items style &amp; content.',
    'section_order' => 11,
    'fields' => array(
        array(
            'id' => 'items_view',
            'title' => 'Items view',
            'desc' => 'Select main view of carousel items.',
            'type' => 'radio',
            'std' => 'listview',
            'choices' => array(
				'listview' => 'Horizontal',
				'gridview' => 'Vertical',
            )
        ),
		array(
            'id' => 'horizontal_item_section',
            'title' => '<span class="section_sub_title">Horizontal view</span>',
            'desc' => '',
            'type' => 'custom',
        ),			
        array(
            'id' => 'horizontal_item_size',
            'title' => 'Items size <sup>(Horizontal view)</sup>',
            'desc' => 'Enter the size (in pixels) of the carousel items. This field is related to the items within the horizontal view. (Width then height separated by comma. Default: 454,150)',
            'type' => 'text',
            'std' => '454,150',
        ),	
        array(
            'id' => 'horizontal_item_css',
            'title' => 'Items CSS <sup>(Horizontal view)</sup>',
            'desc' => 'Enter yout custom CSS for the carousel items. This field is related to the items within the horizontal view.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),									
        array(
            'id' => 'horizontal_image_size',
            'title' => 'Image size <sup>(Horizontal view)</sup>',
            'desc' => 'Enter the image size (in pixels) of the carousel items. This field is related to the items within the horizontal view. (Width then height separated by comma. Default: 204,150)',
            'type' => 'text',
            'std' => '204,150',
        ),		
        array(
            'id' => 'horizontal_details_size',
            'title' => 'Description area size <sup>(Horizontal view)</sup>',
            'desc' => 'Enter the size (in pixels) of the items description area. This field is related to the items within the horizontal view. (Width then height separated by comma. Default: 250,150)',
            'type' => 'text',
            'std' => '250,150',
        ),
        array(
            'id' => 'horizontal_title_css',
            'title' => 'Title CSS <sup>(Horizontal view)</sup>',
            'desc' => 'Customize the items title area and text by entring your CSS. This field is related to the items within the horizontal view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),	
        array(
            'id' => 'horizontal_details_css',
            'title' => 'Description CSS <sup>(Horizontal view)</sup>',
            'desc' => 'Customize the items description area and text by entring your CSS. This field is related to the items within the horizontal view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),			
		array(
            'id' => 'vertical_item_section',
            'title' => '<span class="section_sub_title">Vertical view</span>',
            'desc' => '',
            'type' => 'custom',
        ),			
        array(
            'id' => 'vertical_item_size',
            'title' => 'Items size <sup>(Vertical view)</sup>',
            'desc' => 'Enter the size (in pixels) of the carousel items. This field is related to the items within the vertical view. (Width then height separated by comma. Default: 204,290)',
            'type' => 'text',
            'std' => '204,290',
        ),	
        array(
            'id' => 'vertical_item_css',
            'title' => 'Items CSS <sup>(Vertical view)</sup>',
            'desc' => 'Enter yout custom CSS for the carousel items. This field is related to the items within the vertical view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),															
        array(
            'id' => 'vertical_image_size',
            'title' => 'Image size <sup>(Vertical view)</sup>',
            'desc' => 'Enter the image size (in pixels) of the carousel items. This field is related to the items within the vertical view. (Width then height separated by comma. Default: 204,120)',
            'type' => 'text',
            'std' => '204,120',
        ),												
        array(
            'id' => 'vertical_details_size',
            'title' => 'Description area size <sup>(Vertical view)</sup>',
            'desc' => 'Enter the size (in pixels) of the items description area. This field is related to the items within the vertical view. (Width then height separated by comma. Default: 204,170)',
            'type' => 'text',
            'std' => '204,170',
        ),		
        array(
            'id' => 'vertical_title_css',
            'title' => 'Title CSS <sup>(Vertical view)</sup>',
            'desc' => 'Customize the items title area and text by entring your CSS. This field is related to the items within the vertical view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),	
        array(
            'id' => 'vertical_details_css',
            'title' => 'Description CSS <sup>(Vertical view)</sup>',
            'desc' => 'Customize the items description area and text by entring your CSS. This field is related to the items within the vertical view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),		
		array(
            'id' => 'more_item_section',
            'title' => '<span class="section_sub_title">Content settings</span>',
            'desc' => '',
            'type' => 'custom',
        ),										
        array(
            'id' => 'show_details_btn',
            'title' => '"More" button',
            'desc' => 'Show/Hide "More" button',
            'type' => 'radio',
            'std' => 'yes',
            'choices' => array(
				'yes' => 'Show',
				'no' => 'Hide',
            )
        ),
        array(
            'id' => 'details_btn_text',
            'title' => '"More" Button text',
            'desc' => 'Enter your customize text to show on the "More" Button.',
            'type' => 'text',
            'std' => 'More',
        ),				
        array(
            'id' => 'details_btn_css',
            'title' => '"More" Button CSS',
            'desc' => 'Enter your CSS to customize the "More" Button\'s look.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),			
        array(
            'id' => 'items_title',
            'title' => 'Items title',
            'desc' => 'Create your customized items title by entering the name of your custom fields. You can use as many you want. Leave this field empty to use the default title.
					<br /><strong>Syntax:</strong> [meta_key<sup>1</sup>][separator<sup>1</sup>][meta_key<sup>2</sup>][separator<sup>2</sup>][meta_key<sup>n</sup>]...[title length].
					<br /><strong>Example of use:</strong> [post_category][s=,][post_address][l=50]
					<br /><strong>*</strong> To insert empty an space enter [-]
					<br /><strong>* Make sure there\'s no empty spaces between ][</strong>',
            'type' => 'textarea',
            'std' => '',
        ),
		array(
            'id' => 'click_on_title',
            'title' => 'Title as link',
            'desc' => 'Select "Yes" to use the title as a link to the post page.',
            'type' => 'radio',
            'std' => 'no',
			'choices' => array(
				'yes' => 'Yes',
				'no' => 'No',
            )
        ),
		array(
            'id' => 'external_link',
            'title' => 'Post URL',
            'desc' => 'If you choosed to use the title as link, you may want to select a way to open the post page.',
            'type' => 'radio',
            'std' => 'same_window',
            'choices' => array(
				'new_window' => 'Open in a new window',
				'same_window' => 'Open in the same window'
            )
        ),			
        array(
            'id' => 'items_details',
            'title' => 'Items description',
            'desc' => 'Create your customized description content. You can combine the content with your custom fields & taxonomies. Leave this field empty to use the default description.
					<br /><strong>Syntax:</strong> [content;content_length][separator][t=label:][meta_key][separator][t=Category:][tax=taxonomy_slug][separator]...[description length]
					<br /><strong>Example of use:</strong> [content;80][s=br][t=Category:][-][tax=category][s=br][t=Address:][-][post_address]
					<br /><strong>*</strong> To specify a description length, use <strong>[l=LENGTH]</strong>. Change LENGTH to a number (e.g. 100).
					<br /><strong>*</strong> To add a label, use <strong>[t=YOUR_LABEL]</strong>
					<br /><strong>*</strong> To add a custom field, use <strong>[CUSTOM_FIELD_NAME]	</strong>				
					<br /><strong>*</strong> To insert a taxonomy, use <strong>[tax=TAXONOMY_SLUG]</strong>
					<br /><strong>*</strong> To insert new line enter <strong>[s=br]</strong>
					<br /><strong>*</strong> To insert an empty space enter <strong>[-]</strong>
					<br /><strong>*</strong> To insert the content/excerpt, use <strong>[content;LENGTH]</strong>. Change LENGTH to a number (e.g. 100).
					<br /><strong>* Make sure there\'s no empty spaces between ][</strong>',
            'type' => 'textarea',
            'std' => '[l=100]',
        ),	
	)
);

/**
 * Post count settings */

$wpsf_settings[] = array(
    'section_id' => 'postscountsettings',
    'section_title' => 'Posts Count Settings',
    'section_description' => 'This feature allow to show the number of your posts on the top of the map. Use the settings below to change the default clause & style.',
    'section_order' => 12,
    'fields' => array(
        array(
            'id' => 'show_posts_count',
            'title' => 'Show posts count',
            'desc' => 'Show/Hide the posts count clause',
            'type' => 'radio',
            'std' => 'no',
            'choices' => array(
				'yes' => 'Show',
				'no' => 'Hide',
            )
        ),	
        array(
            'id' => 'posts_count_clause',
            'title' => 'Posts count clause',
            'desc' => 'Use this field to write your custom clause.<br /><strong>Syntaxe:</strong> YOUR CLAUSE [posts_count] YOUR CLAUSE',
            'type' => 'textarea',
            'std' => '[posts_count] Posts',
        ),
        array(
            'id' => 'posts_count_color',
            'title' => 'Clause color',
            'desc' => 'Choose the color of the clause.',
            'type' => 'color',
            'std' => '#333333',
        ),
        array(
            'id' => 'posts_count_style',
            'title' => 'Clause style',
            'desc' => 'Add your CSS code to customize the caluse style.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),						
	)
);											

/**
 * Faceted navigation settings */

$wpsf_settings[] = array(
    'section_id' => 'facetedsearchsettings',
    'section_title' => 'Faceted Search Settings <sup class="cspm_plus_tag">Plus+</sup>',
    'section_description' => 'Faceted search, also called faceted navigation or faceted browsing, is a technique for accessing information organized according to a faceted classification system, allowing users to explore a collection of information by applying multiple filters. A faceted classification system classifies each information element along multiple explicit dimensions, enabling the classifications to be accessed and ordered in multiple ways rather than in a single, pre-determined, taxonomic order.',
    'section_order' => 13,
    'fields' => array(
		array(
            'id' => 'faceted_search_alert_msg',
            'title' => '<span class="section_sub_title cspacing_notice">IMPORTANT!<br />The faceted search can not be operated without activating the "Marker categories option" at "Marker categories settings"</span>',
            'desc' => '',
            'type' => 'custom',
        ),	
        array(
            'id' => 'faceted_search_option',
            'title' => 'Faceted search option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
		array(
			'id' => 'faceted_search_multi_taxonomy_option',
			'title' => 'Multiple taxonomy option', 
			'desc' => 'Select "Yes" if you want to filter the posts by selecting multiple taxonomy in the faceted search form.',
			'type' => 'radio',
			'std' => 'true',
			'choices' => array(
				'true' => 'Yes',
				'false' => 'No',
			)
		),	
		array(
			'id' => 'faceted_search_drag_map',
			'title' => 'Drag the map <sup class="cspm_new_tag">NEW</sup>', 
			'desc' => 'Choose whether you want to drag the map to the nearest zone containing the markers or not (After a filter action). Default "No".',
			'type' => 'radio',
			'std' => 'no',
			'choices' => array(
				'yes' => 'Yes',
				'no' => 'No',
			)
		),		
		array(
            'id' => 'faceted_search_customizing_section',
            'title' => '<span class="section_sub_title">Customization</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
			'id' => 'faceted_search_input_skin',
			'title' => 'Checkbox/Radio skin', 
			'desc' => 'Select the skin of the checkbox/radio input. <a target="_blank" href="http://icheck.fronteed.com/">See all skins</a>',
			'type' => 'radio',
			'std' => 'polaris',
			'choices' => array(
				'minimal' => 'Minimal skin',
				'square' => 'Square skin',
				'flat' => 'Flat skin',
				'line' => 'Line skin',
				'polaris' => 'Polaris skin',
				'futurico' => 'Futurico skin',
			)
		),
		array(
			'id' => 'faceted_search_input_color',
			'title' => 'Checkbox/Radio skin color', 
			'desc' => 'Select the skin color of the checkbox/radio input. (Polaris & Futurico skins doesn\'t use colors). <a target="_blank" href="http://icheck.fronteed.com/">See all colors</a>',
			'type' => 'radio',
			'std' => 'blue',
			'choices' => array(
				'black' => 'Black',
				'red' => 'Red',
				'green' => 'Green',
				'blue' => 'Blue',
				'aero' => 'Aero',
				'grey' => 'Grey',
				'orange' => 'Orange',
				'yellow' => 'Yellow',
				'pink' => 'Pink',
				'purple' => 'Purple',
			)
		),			
        array(
            'id' => 'faceted_search_icon',
            'title' => 'Faceted search button image',
            'desc' => 'Upload a new image for the faceted search button. You can always find the original image at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),											
        array(
            'id' => 'faceted_search_css',
            'title' => 'Category list background color',
            'desc' => 'Change the background color of the faceted search form container.',
            'type' => 'color',
            'std' => '#ffffff',
        ),						
	)
);	

/**
 * Search form settings */

$wpsf_settings[] = array(
    'section_id' => 'searchformsettings',
    'section_title' => 'Search Form Settings',
    'section_description' => 'The search form is a technique that lets a user enter their address and see markers on a map for the locations nearest to them within a chosen distance restriction. Use this interface to control the search form settings.',
    'section_order' => 14,
    'fields' => array(
        array(
            'id' => 'search_form_option',
            'title' => 'Search form option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'sf_search_distances',
            'title' => 'Min & Max distances of search',
            'desc' => 'Enter the minimum distance and the maximum distance to use as a distance search between the origin address and the destinations in the map.',
            'type' => 'text',
            'std' => '3,50'
        ),	
        array(
            'id' => 'sf_distance_unit',
            'title' => 'Distance unit',
            'desc' => 'Select the distance unit.',
            'type' => 'radio',
            'std' => 'metric',
            'choices' => array(
				'metric' => 'Km',
				'imperial' => 'Miles'
            )
        ),	
		array(
            'id' => 'form_customization_section',
            'title' => '<span class="section_sub_title">Search form customization</span>',
            'desc' => '',
            'type' => 'custom',
        ),																        
		array(
            'id' => 'address_placeholder',
            'title' => 'Address field placeholder',
            'desc' => 'Update the text to show as a placeholder for the address field',
            'type' => 'text',
            'std' => 'Enter City & Province, or Postal code',
        ),	
		array(
            'id' => 'slider_label',
            'title' => 'Slider label',
            'desc' => 'Update the text to show as a label for the slider',
            'type' => 'text',
            'std' => 'Expand the search area up to',
        ),
        array(
            'id' => 'submit_text',
            'title' => 'Submission button text',
            'desc' => 'Update the text to show in the submission button.',
            'type' => 'text',
            'std' => 'Search',
        ),	
		array(
            'id' => 'search_form_icon',
            'title' => 'Search form button image',
            'desc' => 'Upload a new image for the search form button. You can always find the original image at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'search_form_bg_color',
            'title' => 'Background color',
            'desc' => 'Change the background color of the search form container.',
            'type' => 'color',
            'std' => '#ffffff',
        ),	
		array(
            'id' => 'warning_msg_section',
            'title' => '<span class="section_sub_title">Warning messages</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'no_location_msg',
            'title' => 'No locations message',
            'desc' => 'Update the text to show when the search form has no locations to display.',
            'type' => 'text',
            'std' => 'We could not find any location',
        ),	
		array(
            'id' => 'bad_address_msg',
            'title' => 'Bad address message',
            'desc' => 'Update the text to show when the search form did not uderstand the provided address.',
            'type' => 'text',
            'std' => 'We could not understand the location',
        ),	
		array(
            'id' => 'bad_address_sug_1',
            'title' => '"Bad address" first suggestion',
            'desc' => 'Update the text to show as a first suggestion for the bad address\'s message.',
            'type' => 'text',
            'std' => '- Make sure all street and city names are spelled correctly.',
        ),	
		array(
            'id' => 'bad_address_sug_2',
            'title' => '"Bad address" Second suggestion',
            'desc' => 'Update the text to show as a second suggestion for the bad address\'s message.',
            'type' => 'text',
            'std' => '- Make sure your address includes a city and state.',
        ),	
		array(
            'id' => 'bad_address_sug_3',
            'title' => '"Bad address" Third suggestion',
            'desc' => 'Update the text to show as a third suggestion for the bad address\'s message.',
            'type' => 'text',
            'std' => '- Try entering a zip code.',
        ),		
		array(
            'id' => 'circle_customization_section',
            'title' => '<span class="section_sub_title">Circle customization</span>',
            'desc' => '',
            'type' => 'custom',
        ),
        array(
            'id' => 'circle_option',
            'title' => 'Circle option',
            'desc' => 'The circle option is a technique of drawing a circle of a given radius of the search address. Select "Yes" to enable this option. Default "Yes".',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),		
		array(
            'id' => 'fillColor',
            'title' => 'Fill color',
            'desc' => 'The fill color.',
            'type' => 'color',
            'std' => '#189AC9',
        ),		
		array(
            'id' => 'fillOpacity',
            'title' => 'Fill opacity',
            'desc' => 'The fill opacity between 0.0 and 1.0.',
            'type' => 'select',
            'std' => '0.1',
            'choices' => array(
				'0.0' => '0.0',
				'0.1' => '0.1',
				'0.2' => '0.2',
				'0.3' => '0.3',
				'0.4' => '0.4',
				'0.5' => '0.5',
				'0.6' => '0.6',
				'0.7' => '0.7',
				'0.8' => '0.8',
				'0.9' => '0.9',
				'1' => '1',
            )			
        ),																						
		array(
            'id' => 'strokeColor',
            'title' => 'Stroke color',
            'desc' => 'The stroke color.',
            'type' => 'color',
            'std' => '#189AC9',
        ),		
		array(
            'id' => 'strokeOpacity',
            'title' => 'Stroke opacity',
            'desc' => 'The stroke opacity between 0.0 and 1.',
            'type' => 'select',
            'std' => '1',
            'choices' => array(
				'0.0' => '0.0',
				'0.1' => '0.1',
				'0.2' => '0.2',
				'0.3' => '0.3',
				'0.4' => '0.4',
				'0.5' => '0.5',
				'0.6' => '0.6',
				'0.7' => '0.7',
				'0.8' => '0.8',
				'0.9' => '0.9',
				'1' => '1',
            )			
        ),	
		array(
            'id' => 'strokeWeight',
            'title' => 'Stroke weight',
            'desc' => 'The stroke width in pixels.',
            'type' => 'text',
            'std' => '1',
        )	
																							
	)
);
	
/**
 * Troubleshooting & Configs*/

$wpsf_settings[] = array(
    'section_id' => 'troubleshooting',
    'section_title' => 'Troubleshooting & Configs <sup class="cspm_plus_tag">Plus+</sup>',
    'section_description' => '',
    'section_order' => 15,
    'fields' => array(
		array(
            'id' => 'regenerate_markers_link',
            'title' => 'Regenerate markers',
            'desc' => '<span class="cspm_blink_text">Regenerating markers is under process...<br /></span>
					   This option is for regenerating all your markers. In most cases, <strong>you wont need to use this option at all</strong> because markers 
					   are automatically created and each time you add or edit a post, the marker(s) related to this post will be regenerated automatically. 
					   Use this options <strong>only when need to</strong>.
					   <span style="color:red">This may take a while when you have too many markers (500+) to regenerate. Please be patient.</span>',
            'type' => 'link',
			'std' => '#'
        ),
		array(
            'id' => 'use_ssl',
            'title' => '<strike>Use the map on SSL environment</strike><br /><span style="color:red;">Deprecated since 2.8</span>',
            'desc' => 'By default, the map is configured for an HTTP environment. To configure the map for an SSL environment select the option <strong>https</strong>.',
            'type' => 'radio',
            'std' => 'http',
			'choices' => array(
				'http' => 'http',
				'https' => 'https'
			)
        ),
		array(
            'id' => 'outer_links_field_name',
            'title' => '"Outer links" custom field name',
            'desc' => 'By default, the plugin uses the function get_permalink() of wordpress to get the posts links. <strong>In some cases, users wants to use their locations
			           in the map as links to other pages in outer websites.</strong> To use this option, you MUST have your external <strong>links stored in a custom field</strong>. Enter the name of that
					   custom field or leave this field empty if you don\'t need this option.',
            'type' => 'text',
            'std' => '',
        ),
		array(
            'id' => 'map_in_tab',
            'title' => 'Display the map inside a Tab or an Accordion',
            'desc' => 'If you\'re using the map inside a Tab or an Accordion, you may have a problem where the Tiles are not fully loaded. 
					   This is a common issue with Google Map & Tabs. To overpass this issue, select "Yes" in the above options.<br />
					   <strong>Note</strong>: It is not necessary to select "Yes" in case you were using multiple maps and only one instance will be displayed inside a 
					   Tab, this will load extra code in your page. In this case, you can add the shortcode attribute <strong>use_in_tab="yes"</strong> to the map that 
					   you will display inside a tab.',
            'type' => 'radio',
            'std' => 'no',
			'choices' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
        ),
		array(
            'id' => 'custom_list_columns',
            'title' => 'Display the coordinates column',
            'desc' => 'This will display a custom column for all custom post types used with the plugin indicating the coordinates of each post on the map.',
            'type' => 'radio',
            'std' => 'no',
			'choices' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
        ),
		array(
            'id' => 'use_with_wpml',
            'title' => 'Use the plugin with WPML <sup>BETA</sup>',
            'desc' => 'If you are using WPML plugin for translation, select "Yes" to enable the WPML compatibility code.<br />
					  <span style="color:red">Note: After duplicating a post to other languages, you must click one more time on the button "Update" of the original 
					  post in order to add the LatLng coordinates for the duplicated posts on the map.</span>',
            'type' => 'radio',
            'std' => 'no',
			'choices' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
        ),		
		array(
            'id' => 'loading_scripts_section',
            'title' => '<span class="section_sub_title">Speed Optimization</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'combine_files',
            'title' => 'Loading scripts & styles',
            'desc' => 'By default, the plugin will load the minified version of all JS & CSS files but you can reduce the number of requests your site has to make to the server in order to 
					   render the map by choosing the option "Combine files".<br />
					   <strong><u>Hint:</u></strong> <strong>Modern browsers are able to download multiple files at a time in parallel. So that means that it might be more efficient and faster for your browser to download several smaller files all at once, then one large file. The results will vary from site to site so you will have to test this for yourself.</strong><br />
					   <a href="http://blog.wp-rocket.me/5-speed-optimization-myths/" target="_blank">A usful artice about Speed Opitimization</a>',
            'type' => 'radio',
            'std' => 'seperate_minify',
			'choices' => array(
				'combine' => 'Combine files',
				'seperate' => 'Seperate files (Debugging versions)',
				'seperate_minify' => 'Seperate files (Minified versions) <sup><strong>Recommended</strong></sup> <sup class="cspm_new_tag">NEW</sup>'
			)
        ),
		array(
            'id' => 'loading_scripts',
            'title' => 'Method of loading scripts & styles <br /><span style="color:red;">PHP Code Updated since 2.8.2</span>',
            'desc' => 'By default, the plugin loads all the JS & CSS files on the entire site. In some cases where you use several other plugins, 
			           this can bog down your site with loads of requests for these files.<br />Progress Map gives you the ability to load the necessary 
					   files only in the pages/posts that uses the map. To use this feature, select the option "<strong>Load files only on specific pages/posts</strong>" 
					   then enter the page/post IDs in the 
					   fields "<strong>Page IDs</strong>" and "<strong>Post IDs</strong>".<br />
					   <strong class="cspm_blue">To complete this option, copy the code below in the <u>function.php</u> file of your theme.</strong>
<pre class="cspm_pre">
&lt;?php // You don\'t need this line
			   
function cspm_remove_style_files(){	
	
	if (!class_exists("CodespacingProgressMap"))
		return; 

	$ProgressMapClass = CodespacingProgressMap::this();
	
	if($ProgressMapClass->loading_scripts == "only_pages"){
	
		global $post;
		
		$IDs = array_merge(
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_ids)),
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_post_ids))
			   );
		
		$page_templates = explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_templates));
		$current_template_name = basename(get_page_template());

		if($ProgressMapClass->include_or_remove_option == "include"){
			
			if(!in_array($post->ID, $IDs)){
				
				$ProgressMapClass->cspm_deregister_styles();
				
				do_action("cspm_dequeue_ext_styles");

			}
				
			if(in_array($current_template_name, $page_templates)){
				
				$ProgressMapClass->cspm_styles();
				
				do_action("cspm_enqueue_ext_styles");

			}
			
		}else{
			
			if(in_array($post->ID, $IDs) || in_array($current_template_name, $page_templates)){
				
				$ProgressMapClass->cspm_deregister_styles();
				
				do_action("cspm_dequeue_ext_styles");

			}
				
		}
		
	}	
	
}

add_action("wp_print_styles", "cspm_remove_style_files", 100);

function cspm_remove_script_files(){	
	
	if (!class_exists("CodespacingProgressMap"))
		return; 
	
	$ProgressMapClass = CodespacingProgressMap::this();
	
	if($ProgressMapClass->loading_scripts == "only_pages"){
	
		global $post;
		
		$IDs = array_merge(
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_ids)),
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_post_ids))
			   );
		
		$page_templates = explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_templates));
		$current_template_name = basename(get_page_template());
		
		if($ProgressMapClass->include_or_remove_option == "include"){
			
			if(!in_array($post->ID, $IDs)){
				
				$ProgressMapClass->cspm_deregister_scripts();
				
				do_action("cspm_dequeue_ext_scripts");

			}
			
			if(in_array($current_template_name, $page_templates)){
				
				$ProgressMapClass->cspm_scripts();
				
				do_action("cspm_enqueue_ext_scripts");

			}
			
		}else{
			
			if(in_array($post->ID, $IDs) || in_array($current_template_name, $page_templates)){
				 
				$ProgressMapClass->cspm_deregister_scripts();					
					
				do_action("cspm_dequeue_ext_scripts");

			}
			
		}
		
	}	
	
}

add_action("wp_print_scripts", "cspm_remove_script_files", 100);
?&gt; // You don\'t need this line
</pre>',
            'type' => 'radio',
            'std' => 'entire_site',
			'choices' => array(
				'entire_site' => 'Load files on entire site',
				'only_pages' => 'Load files only on specific pages/posts'
			)
        ),
		array(
            'id' => 'include_or_remove_option',
            'title' => 'Include/Remove option',
            'desc' => 'Determine whether you want to Include or Remove the scripts & styles only on the Pages/Posts mentioned below.',
            'type' => 'radio',
            'std' => 'include',
			'choices' => array(
				'include' => 'Include scripts & styles on pages/posts below',
				'remove' => 'Remove scripts & styles from pages/posts below'
			)
        ),
		array(
            'id' => 'load_on_page_ids',
            'title' => 'Page IDs',
            'desc' => 'Enter the page IDs where the plugin will include/remove the scripts & styles. Seperate IDs by comma.',
            'type' => 'text',
            'std' => '',
        ),
		array(
            'id' => 'load_on_post_ids',
            'title' => 'Post IDs',
            'desc' => 'Enter the post IDs where the plugin will include/remove the scripts & styles. Seperate IDs by comma.',
            'type' => 'text',
            'std' => '',
        ),
		array(
            'id' => 'load_on_page_templates',
            'title' => 'Page templates',
            'desc' => 'Enter the page templates names where the plugin will include/remove the scripts & styles. Seperate page templates by comma. (e.g. page-template.php, page.php)',
            'type' => 'textarea',
            'std' => '',
        ),	
		
		/**
		 * Disabling Stylesheets & Scripts
		 * @since 2.8.2 */
		 
		array(
            'id' => 'disabling_scripts_section',
            'title' => '<span class="section_sub_title">Disabling Stylesheets & Scripts <sup class="cspm_new_tag" style="margin:0 5px 0 -2px;">NEW</sup></span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'fdisabling_scripts_msg',
            'title' => '<span class="section_sub_title cspacing_info">Progress Map uses some files that may conflict with your theme. This section will allow you to disable files that are suspected of creating conflicts in your website.</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'remove_bootstrap',
            'title' => 'Bootstrap (CSS File) <sup class="cspm_new_tag" style="margin:0 5px 0 -2px;">NEW</sup>',
            'desc' => 'If your theme uses bootstrap v3+, you can disable the one used by this plguin.
					  <br /><span style="color:red;">Important Note: This option will not take action if you select the option <strong>"Loading scripts & styles / Combine files"</strong>! Use the option <strong>"Seperate files (Debugging versions)"</strong> or <strong>"Seperate files (Minified versions)"</strong> instead!</span>',
            'type' => 'radio',
            'std' => 'enable',
			'choices' => array(
				'enable' => 'Enable',
				'disable' => 'Disable'
			)
        ),
		array(
            'id' => 'remove_google_fonts',
            'title' => 'Google Fonts "Source Sans Pro" (CSS File) <sup class="cspm_new_tag" style="margin:0 5px 0 -2px;">NEW</sup>',
            'desc' => 'If your theme uses or load this font, you can disable the one used by this plguin.',
            'type' => 'radio',
            'std' => 'enable',
			'choices' => array(
				'enable' => 'Enable',
				'disable' => 'Disable'
			)
        ),
		array(
            'id' => 'remove_gmaps_api',
            'title' => 'Google Maps API (JS File) <sup class="cspm_new_tag" style="margin:0 5px 0 -2px;">NEW</sup><br /> <span style="color:red;">Not recommended unless ... Read the description!</span>',
            'desc' => 'If your theme loads its own GMaps API, you can disbale the one used by this plugin.
					   <br /><span style="color:red;"><strong>Important Notes: <br />
					   1) Your theme MUST load the version 3 (v3) of Google Maps Javascript API!<br /><br />
					   2) Your theme MUST load the following libraries:<br />
					   - Geometry Library.<br />
					   - Places Libary.<br />
					   The list of libraries may change in the future!
					   <br /><br />
					   3) If you remove our GMaps API, you\'ll not be able to use the following features:<br />
					   - Changing the language of the map.<br />
					   - Adding an API Key to your map.<br />
					   The list of parameters may change in the future!<br /><br />
					   Unless your theme doesn\'t provide all of this, we highly recommend you to ENABLE our GMaps API!
					   </strong></span>',
            'type' => 'radio',
            'std' => 'enable',
			'choices' => array(
				'enable' => 'Enable',
				'disable' => 'Disable'
			)
        ),
		
		/**
		 * "Add location" Form fields */
		 					
		array(
            'id' => 'form_fields_section',
            'title' => '<span class="section_sub_title">"Add location" Form fields</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'form_fields_msg',
            'title' => '<span class="section_sub_title cspacing_info">IMPORTANT NOTE!<br /><br />This feature is dedicated ONLY for users that want to use the plugin with their already created cutsom fields.
			            You don\'t have any interest to change the name of the form fields below if you will use the plugin with a new post type/website. Just leave them as they are!
						<br />The "Add location" form is located in the "Add/Edit post" page of your post type.<br /><br />*After CHANGING the Latitude & Longitude fields names, 
						SAVE your settings, then use the "Regenerate markers" option above to recreate your markers.</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'latitude_field_name',
            'title' => '"Latitude" field name',
            'desc' => 'Enter the name of your latitude custom field. Empty spaces are not allowed!',
            'type' => 'text',
            'std' => 'codespacing_progress_map_lat',
        ),
		array(
            'id' => 'longitude_field_name',
            'title' => '"Longitude" field name',
            'desc' => 'Enter the name of your longitude custom field. Empty spaces are not allowed!',
            'type' => 'text',
            'std' => 'codespacing_progress_map_lng',
        ),
		array(
            'id' => 'extra_css_section',
            'title' => '<span class="section_sub_title">Extra CSS</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'extra_css',
            'title' => 'Custom CSS',
            'desc' => 'If you want to make any customization to the plugin style, you don\'t want to update the style files 
					   directly because you may lose everything you changed when you\'ll upgrade the plugin to a newer release. 
					   Use this field to add your extra custom CSS.<br /> 
					   Example: <strong>div.a_class_name{ border:1px solid #ededed; }</strong>',
            'type' => 'textarea',
            'std' => '',
        ),							
	)
);


/**
 * Hidden Settings */
 
$wpsf_settings[] = array(
    'section_id' => 'hiddensettings',
    'section_title' => '',
    'section_description' => '',
    'section_order' => 100,
    'fields' => array(	
		array(
            'id' => 'json_markers_method',
            'title' => '',
            'desc' => '',
            'type' => 'hidden',
            'std' => 'false',
        ),
	)
);

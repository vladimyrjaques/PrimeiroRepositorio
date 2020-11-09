
/* @Version 2.8.2 */

//=======================//
//==== Map functions ====//
//=======================//

	window.cspm_global_object = {};
	
	var carousel_map_zoom = progress_map_vars.carousel_map_zoom;
	var map_layout = {};
	
	/**
	 * Load map options
	 *
	 * @light_map, Declare the light map in order to use the apropriate options for this type of map.
	 * @latLng, The center point of the map.
	 * @zoom, The default zoom of the map.
	 *
	 */
	function cspm_load_map_options(light_map, latLng, zoom){
		
		var latlng = (latLng != null) ? latLng.split(',') : progress_map_vars.center.split(',');
		
		var zoom_value = (zoom != null) ? parseInt(zoom) : parseInt(progress_map_vars.zoom);
		var max_zoom_value = parseInt(progress_map_vars.max_zoom);
		var min_zoom_value = parseInt(progress_map_vars.min_zoom);
		
		var map_draggable = (progress_map_vars.map_draggable == 'true') ? true : false;
		var zoom_on_doubleclick = (progress_map_vars.zoom_on_doubleclick == 'true') ? true : false;

		var default_options = {
			center:[latlng[0], latlng[1]],
			zoom: zoom_value,			
			maxZoom: max_zoom_value,
			minZoom: min_zoom_value,								
			scrollwheel: eval(progress_map_vars.scrollwheel),
			panControl: eval(progress_map_vars.panControl),	
			panControlOptions: {
				position: google.maps.ControlPosition.RIGHT_TOP  
			},					
			mapTypeControl: eval(progress_map_vars.mapTypeControl),
			mapTypeControlOptions: {
				position: google.maps.ControlPosition.TOP_RIGHT,
				mapTypeIds: [google.maps.MapTypeId.ROADMAP,
							 google.maps.MapTypeId.SATELLITE,
							 google.maps.MapTypeId.TERRAIN,
							 google.maps.MapTypeId.HYBRID]				
			},
			streetViewControl: eval(progress_map_vars.streetViewControl),	
			streetViewControlOptions: {
				position: google.maps.ControlPosition.RIGHT_TOP  
			},
			draggable: map_draggable,
			disableDoubleClickZoom: zoom_on_doubleclick,
			/*fullscreenControl: true,
			fullscreenControlOptions:{
				position: google.maps.ControlPosition.BOTTOM_LEFT
			}*/
		};
		
		if(progress_map_vars.zoomControl == 'true' && progress_map_vars.zoomControlType == 'default'){
			
			var zoom_options = {
				zoomControl: true,
				zoomControlOptions:{
					style: google.maps.ZoomControlStyle.SMALL 
				},
			};
		
		}else{
			var zoom_options = {
				zoomControl: false,
			};
		}
		
		var map_options = jQuery.extend({}, default_options, zoom_options);
		
		return map_options;
		
	}					
	
	/**
	 * Set the initial map style
	 * @since 2.4
	 */
	function cspm_initial_map_style(map_style, custom_style_status){
			
		if(map_style == 'custom_style' && custom_style_status == false)
			var map_type_id = {mapTypeId: google.maps.MapTypeId.ROADMAP};
		
		else if(map_style == 'custom_style')
			var map_type_id = {mapTypeId: "custom_style"};
			
		else if(map_style == 'ROADMAP')
			var map_type_id = {mapTypeId: google.maps.MapTypeId.ROADMAP};
			
		else if(map_style == 'SATELLITE')
			var map_type_id = {mapTypeId: google.maps.MapTypeId.SATELLITE};
			
		else if(map_style == 'TERRAIN')				
			var map_type_id = {mapTypeId: google.maps.MapTypeId.TERRAIN};
			
		else if(map_style == 'HYBRID')				
			var map_type_id = {mapTypeId: google.maps.MapTypeId.HYBRID};
		
		return map_type_id;
		
	}
	
	var post_ids_and_categories = {};
	var post_lat_lng_coords = {};
	var post_ids_and_child_status = {}

	/**
	 * Create Markers
	 *
	 * @Since 2.5 
	 */
	function cspm_new_pin_object(i, post_id, lat, lng, post_categories, map_id, marker_img, marker_size, is_child){

		post_lat_lng_coords[map_id][post_id] = lat+'_'+lng;
	
		// Create an object of that post_id and its categories/status for the faceted search
		post_ids_and_categories[map_id]['post_id_'+post_id] = {};
		post_ids_and_child_status[map_id][lat+'_'+lng] = is_child;
		
		// Get the current post categories	
		var post_category_ids = (post_categories != '') ? post_categories.split(',') : '';
		
		// Collect an object of all posts in the map and their categories
		// Useful for the faceted search & the search form
		post_ids_and_categories[map_id]['post_id_'+post_id][0] = post_category_ids;
		
		// By default the marker image is the default Google map red marker
		var marker_icon = '';
		
		// If the selected marker is the customized type
		if(progress_map_vars.defaultMarker == 'customize'){
			
			// Get the custom marker image
			// If the marker categories option is set to TRUE, the marker image will be the uploaded marker category image
			// If the marker categories option is set to FALSE, the marker image will be the default custom image provided by the plugin
			var marker_cat_img = marker_img;

			// Marker image size
			var marker_img_width = (progress_map_vars.retinaSupport == "true") ? parseInt(marker_size.split('x')[0])/2 : parseInt(marker_size.split('x')[0]);
			var marker_img_height = (progress_map_vars.retinaSupport == "true") ? parseInt(marker_size.split('x')[1])/2 : parseInt(marker_size.split('x')[1]);

			// Marker image anchor point
			var anchor_y = marker_img_height/2;
			var anchor_x = marker_img_width/2;	
			var anchor_point = null;
			
			if(progress_map_vars.marker_anchor_point_option == 'auto')				
				anchor_point = new google.maps.Point(anchor_x, anchor_y);
			else if(progress_map_vars.marker_anchor_point_option == 'manual'){
				if(progress_map_vars.retinaSupport == "true"){
					anchor_point = new google.maps.Point(
						progress_map_vars.marker_anchor_point.split(',')[0]/2, 
						progress_map_vars.marker_anchor_point.split(',')[1]/2
					);
				}else anchor_point = new google.maps.Point(progress_map_vars.marker_anchor_point.split(',')[0], progress_map_vars.marker_anchor_point.split(',')[1]);
			}

			// Add retina support
			marker_icon = new google.maps.MarkerImage(marker_cat_img, null, null, anchor_point, new google.maps.Size(marker_img_width,marker_img_height));					
			
		}		

		return pin_object = {latLng: [lat, lng], tag: 'post_id__'+post_id, id: post_id+'_'+is_child, options:{ optimized: false, icon: marker_icon, id: post_id, post_id: post_id, is_child: is_child }};										
	
	}
	
	/**
	 * Clustering markers 
	 */
	function cspm_clustering(plugin_map, map_id, light_map){

		var markerCluster;
		
		var mapObject = plugin_map.gmap3('get');
	
		small_cluster_size = progress_map_vars.small_cluster_size;
		medium_cluster_size = progress_map_vars.medium_cluster_size
		big_cluster_size = progress_map_vars.big_cluster_size;
		
		var max_zoom = parseInt(progress_map_vars.max_zoom);
	
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all: true,
				callback: function(objs){
					
					if(objs && typeof MarkerClusterer !== 'undefined'){
						
						markerCluster = new MarkerClusterer(mapObject, objs, {
							gridSize: parseInt(progress_map_vars.grid_size),
							styles: [{
										url: progress_map_vars.small_cluster_icon,
										height: small_cluster_size.split('x')[0],
										width: small_cluster_size.split('x')[1],
										textColor: progress_map_vars.cluster_text_color,
										textSize: 11,
										fontWeight: 'normal',
										fontFamily: 'sans-serif'
									}, {
										url: progress_map_vars.medium_cluster_icon,
										height: medium_cluster_size.split('x')[0],
										width: medium_cluster_size.split('x')[1],
										textColor: progress_map_vars.cluster_text_color,
										textSize: 13,	
										fontWeight: 'normal',								
										fontFamily: 'sans-serif'
									}, {
										url: progress_map_vars.big_cluster_icon,
										height: big_cluster_size.split('x')[0],
										width: big_cluster_size.split('x')[1],
										textColor: progress_map_vars.cluster_text_color,
										textSize: 15,		
										fontWeight: 'normal',							
										fontFamily: 'sans-serif'
									}],
							zoomOnClick: true, //(progress_map_vars.initial_map_style == 'TERRAIN') ? true : false,	
							maxZoom: max_zoom,
							minimumClusterSize: 2,
							averageCenter: true,
							ignoreHidden: true,	
							title: progress_map_vars.cluster_text, //@since 2.8
						});					
						
						var cluster_xhr;
						
						// On cluster click, Hide and show overlays depending on markers positions	
						google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster){
							
							var current_zoom = mapObject.getZoom();	
							
							// Get cluster position and convert it to XY
							var scale = Math.pow(2, current_zoom);
							var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
							var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
							var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(cluster.center_);
							var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
							var mapposition = plugin_map.position();
	
							var count_li = 0;						
							
							if(current_zoom >= max_zoom || (progress_map_vars.initial_map_style == 'TERRAIN' && current_zoom >= 15)) {
								
								var cluster_markers = cluster.getMarkers();									
	
								// @since 2.5 ====							
								var clustred_post_ids = [];
								// ===============
								
								if(typeof cluster_markers !== 'undefined'){
									
									for (var i = 0; i < cluster_markers.length; i++ ){
										
										if(cluster_markers[i].visible == true){
											
											count_li++;
											
											// @since 2.5 ====
											clustred_post_ids.push(cluster_markers[i].id);										
											// ===============
											
										}
										
									}
									
									jQuery('div.cluster_posts_widget_'+map_id).html('<div class="blue_cloud"></div>');
										
									if(count_li > 0){
										
										// @since 2.5 ====
										jQuery('div.cluster_posts_widget_'+map_id).removeClass('flipOutX');
										jQuery('div.cluster_posts_widget_'+map_id).addClass('cspm_animated flipInX').css('display', 'block');
										jQuery('div.cluster_posts_widget_'+map_id).css({left: (pixelOffset.x + mapposition.left + 40 + 'px'), top: (pixelOffset.y + mapposition.top - 32 + 'px')});	
					
										if(cluster_xhr && cluster_xhr.readystate != 4){
											cluster_xhr.abort();
										}
										
										cluster_xhr = jQuery.post(
											progress_map_vars.ajax_url,
											{
												action: 'cspm_load_clustred_markers_list',
												post_ids: clustred_post_ids,
												light_map: light_map
											},
											function(data){	
												
												jQuery('div.cluster_posts_widget_'+map_id).html(data);
												
												/**
												 * Call custom scroll bar for infowindow */
												
												if(typeof jQuery('div.cluster_posts_widget_'+map_id).mCustomScrollbar === 'function'){
																											
													jQuery('div.cluster_posts_widget_'+map_id).mCustomScrollbar({
														autoHideScrollbar:true,
														mouseWheel:{
															enable: true,
															preventDefault: true,
														},
														theme:"dark-thin"
													});		
												
												}
												
											}
										);
										
										jQuery('div.cluster_posts_widget_'+map_id+' ul li').livequery('click', function(){
											
											var id = jQuery(this).attr('id');
											var i = jQuery('li#'+map_id+'_list_items_'+id).attr('value');
											cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id).data('jcarousel'), i);
											cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id, map_id);
											
										});
										
									}else jQuery('div.cluster_posts_widget_'+map_id).css({'display':'none'});
																			
								}														
								
								cspm_zoom_in_and_out(plugin_map);
								
							}												
							
							/**
							 * Fix an issue where the cluster disappers when reaching the max_zoom
							 *
							 * @since 2.6.5
							 */
							setTimeout(function(){						
								current_zoom = mapObject.getZoom();	
								if(progress_map_vars.initial_map_style != 'TERRAIN' && current_zoom > max_zoom){
									mapObject.setZoom(max_zoom);
								}
							}, 100);
							
						});
					
					}
					
				}
			}
			
		});
				
		return markerCluster;
	
	}
	
	function cspm_zoom_in_and_out(plugin_map){
		var mapObject = plugin_map.gmap3('get');
		mapObject.setZoom(mapObject.getZoom() - 1);
		mapObject.setZoom(mapObject.getZoom() + 1);
	}
	
	function cspm_simple_clustering(plugin_map, map_id){
		
		var mapObject = plugin_map.gmap3('get');
		
		if(typeof MarkerClusterer !== 'undefined')
			var markerCluster = new MarkerClusterer(mapObject);
		
    	cspm_zoom_in_and_out(plugin_map);
							
	}
	
	/**
	 * This will load the carousel item details
	 */
	function cspm_ajax_item_details(post_id, map_id){
			
		jQuery.post(
			progress_map_vars.ajax_url,
			{
				action: 'cspm_load_carousel_item',
				post_id: post_id,
				items_view: progress_map_vars.items_view,
			},
			function(data){
				jQuery("li#"+map_id+"_list_items_"+post_id).addClass('cspm_animated fadeIn').html(data);															
			}
		);
	
	}
	
	/**
	 * Animate the selected marker 
	 */
	function cspm_animate_marker(plugin_map, map_id, post_id){
		
		plugin_map.gmap3({
			get: {
				name: 'marker',
				tag: 'post_id__'+post_id,
				callback: function(marker){
					
					if(typeof marker !== 'undefined' && marker.visible == true){
						
						var is_child = marker.is_child;	
						var marker_infobox = 'div.cspm_infobox_container.infobox_'+post_id+'[data-is-child='+is_child+']';
						jQuery('div.cspm_infobox_container').removeClass('cspm_current_bubble');

						if(progress_map_vars.markerAnimation == 'pulsating_circle'){
								
							var mapObject = plugin_map.gmap3('get');
	
							// Get marker position and convert it to XY
							var scale = Math.pow(2, mapObject.getZoom());
							var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
							var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
							var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(marker.position);
							var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
							var mapposition = plugin_map.position();
		
							jQuery('div#pulsating_holder.'+map_id+'_pulsating').css({'display':'block', 'left':(pixelOffset.x + mapposition.left - 15 + 'px'), 'top':(pixelOffset.y + mapposition.top - 18 + 'px')});
							setTimeout(function(){
								jQuery('div#pulsating_holder.'+map_id+'_pulsating').css('display', 'none');
								jQuery(marker_infobox).addClass('cspm_current_bubble');
							},1500);
							
						}else if(progress_map_vars.markerAnimation == 'bouncing_marker'){
						 								
							marker.setAnimation(google.maps.Animation.BOUNCE);
							setTimeout(function(){
								marker.setAnimation(null);
								jQuery(marker_infobox).addClass('cspm_current_bubble');
							},1500);
							
						}else if(progress_map_vars.markerAnimation == 'flushing_infobox'){						
							
							jQuery('div.cspm_infobox_container').removeClass('cspm_animated flash');
							setTimeout(function(){								
								jQuery(marker_infobox).addClass('cspm_animated flash');
								jQuery(marker_infobox).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){jQuery(marker_infobox).removeClass('flash');});
							}, 600);
							
						}

					}
					
				}
			}
		});
	
	}

	// Zoom-in function
	function cspm_zoom_in(selector, mapObj){

		selector.click(function(){
			
			var map = jQuery(mapObj).gmap3("get");
			var current_zoom = map.getZoom();
			
			if(current_zoom < progress_map_vars.max_zoom)
	    		map.setZoom(current_zoom + 1);

			jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
			jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');

		});
		
	}

	// Zoom-out function
	function cspm_zoom_out(selector, mapObj){
		
		selector.click(function(){
					
			var map = jQuery(mapObj).gmap3("get");
			var current_zoom = map.getZoom();
			
			if(current_zoom > progress_map_vars.min_zoom)
				map.setZoom(current_zoom - 1);

			jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
			jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
			
		});
		
	}
	
//============================//
//==== Carousel functions ====//
//============================//

	// Initialize carousel
	function cspm_init_carousel(carousel_size, map_id){
		
		var carousel_id = map_id;

		if(progress_map_vars.show_carousel == 'true' && map_layout[map_id] != 'fullscreen-map' && map_layout[map_id] != 'fit-in-map'){
			
			var vertical_value = false;	
			var dimension = (progress_map_vars.items_view == 'listview') ? progress_map_vars.horizontal_item_width : progress_map_vars.vertical_item_width;
			
			if(map_layout[map_id] == "mr-cl" || map_layout[map_id] == "ml-cr"  || map_layout[map_id] == "map-tglc-right"  || map_layout[map_id] == "map-tglc-left"){
				var vertical_value = true;
				var dimension = (progress_map_vars.items_view == 'listview') ? progress_map_vars.horizontal_item_height : progress_map_vars.vertical_item_height;
			}
			
			var size = {}; 
			var auto_scroll_option = {}; 
			
			if(progress_map_vars.number_of_items != '')
				var size = { size: parseInt(progress_map_vars.number_of_items) };
			else if(carousel_size != null)
				var size = { size: parseInt(carousel_size) };
				
			var default_options = {
				
				scroll: eval(progress_map_vars.carousel_scroll),
				wrap: progress_map_vars.carousel_wrap,
				auto: eval(progress_map_vars.carousel_auto),		
				initCallback: cspm_carousel_init_callback,
				itemFallbackDimension: parseInt(dimension),
				itemLoadCallback: cspm_carousel_itemLoadCallback,
				rtl: eval(progress_map_vars.carousel_mode),
				animation: progress_map_vars.carousel_animation,
				easing: progress_map_vars.carousel_easing,
				vertical: vertical_value
			
			};
			
			if(eval(progress_map_vars.carousel_auto) > 0)
				var auto_scroll_option = { itemFirstInCallback: { onAfterAnimation:  cspm_carousel_item_request } }
			else var auto_scroll_option = { itemFirstInCallback: cspm_carousel_itemFirstInCallback, }
		
			var carousel_options = jQuery.extend({}, default_options, size, auto_scroll_option);
			
			// Init jcarousel
			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id).jcarousel(carousel_options);	

		}else return false;		
		
	}
	
	function cspm_carousel_itemFirstInCallback(carousel, item, idx, state) {
		
		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		if(state == "prev" || state == "next"){
			
			var item_value = item.value;

			cspm_carousel_item_hover_style('li.carousel_item_'+item_value+'_'+map_id, map_id);
				
		}
		
		return false;
		
	}

	/**
	 * Load Items in the screenview
	 *
	 * @Updated 2.7.1 */
	 
	function cspm_carousel_itemLoadCallback(carousel){
	
		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		for(var i = parseInt(carousel.first); i <= parseInt(carousel.last); i++){
			
			var post_id = jQuery('li.jcarousel-item-'+ i +'[class*=_'+map_id+']').attr('data-post-id');
			
			/**
			 * Check if the requested items already exist */
			 
			if ( jQuery('li#'+map_id+'_list_items_'+post_id).has('div.cspm_spinner').length ){
			
				/**
				 * Get items details */
				 
				cspm_ajax_item_details(post_id, map_id);
				
			}
			
		}

		var aux_cspm_carousel_itemLoadCallback=window['aux_cspm_carousel_itemLoadCallback']||null;
		
		if(aux_cspm_carousel_itemLoadCallback){
			aux_cspm_carousel_itemLoadCallback();
		}
	}

	// Carousel callback function
	function cspm_carousel_init_callback(carousel){
		
		var carousel_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		var map_id = carousel_id;
		
		// Move the carousel with scroll wheel
		if(progress_map_vars.scrollwheel_carousel == 'true'){

			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id).mousewheel(function(event, delta) {
					
				if (delta > 0){
					carousel.prev();
					setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
					return false;
				}else if (delta < 0){
					carousel.next();
					setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
					return false;
				}
					
			});
			
		}
		
		// Touch swipe option
		if(progress_map_vars.touchswipe_carousel == 'true' && typeof jQuery('ul#codespacing_progress_map_carousel_'+carousel_id).swipe === 'function'){

			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id).swipe({ 
				
				//Generic swipe handler for all directions
				swipe:function(event, direction, distance, duration, fingerCount) {

					if(map_layout[map_id] == 'mu-cd' || map_layout[map_id] == 'md-cu' || map_layout[map_id] == 'm-con' || map_layout[map_id] == 'fullscreen-map-top-carousel' || map_layout[map_id] == 'fit-in-map-top-carousel'){
						
						if(direction == 'left'){
							carousel.next();
							setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
							return false;
						}else if(direction == 'right'){
							carousel.prev();
							setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
							return false;
						}
						
					}else if(map_layout[map_id] == 'ml-cr' || map_layout[map_id] == 'mr-cl'){
						
						if(direction == 'up'){
							carousel.next();
							setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
							return false;
						}else if(direction == 'down'){
							carousel.prev();
							setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
							return false;
						}
						
					}															
					
				},
				threshold:0				
			});
			
		}
		
		// Pause autoscrolling if the user moves with the cursor over the carousel
		carousel.clip.hover(function() {
			carousel.stopAuto();
		}, function() {
			carousel.startAuto();
		});
		
		// Next button 
		carousel.buttonNext.bind('click', function() {
			setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
		});
		
		// Previous button
		carousel.buttonPrev.bind('click', function() {		
			setTimeout(function(){ cspm_carousel_item_request(carousel, 0); }, 600);
		});
		
	}					
	
	function cspm_carousel_item_request(carousel, item_value){

		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id);
		
		var firstItem = parseInt(carousel.first);
		
		var carouselItemValue = (eval(progress_map_vars.carousel_auto) > 0) ? 0 : parseInt(item_value);

		if(carouselItemValue != 0 && carouselItemValue != firstItem) 
			firstItem = carouselItemValue;
		 
		var overlay_id = jQuery('.jcarousel-item-'+ firstItem ).attr('class').split(' ')[0];

		if(overlay_id){
			
			var item_latlng = jQuery('li#'+map_id+'_list_items_'+overlay_id).attr('name');

			if(item_latlng && typeof item_latlng !== 'undefined'){
					
				var split_item_latlng = item_latlng.split('_');
				var this_lat = split_item_latlng[0].replace(/\"/g, '');
				var this_lng = split_item_latlng[1].replace(/\"/g, '');
					
				cspm_carousel_item_hover_style('li#'+map_id+'_list_items_'+overlay_id, map_id);
				
				cspm_center_map_at_point(plugin_map, this_lat, this_lng, 'zoom');
				
				setTimeout(function(){cspm_animate_marker(plugin_map, map_id, overlay_id);},200);
			
			}
			
		}
				
	}

	/**
	 * Call carousel items								
	 */

	function cspm_call_carousel_item(carousel, id){
		
		carousel.scroll(jQuery.jcarousel.intval(id));
		
		return false;
		
	}
	
	/**
	 * Add different style for the first and/or the selected item in the carousel
	 */
	 
	function cspm_carousel_item_hover_style(item_selector, map_id){								

		jQuery('li[id^='+map_id+'_list_items_]').removeClass('cspm_carousel_first_item').css({'background-color':progress_map_vars.items_background});
		
		jQuery(item_selector).addClass('cspm_carousel_first_item').css({'background-color':progress_map_vars.items_hover_background});	
		
	}
	
	function cspm_rewrite_carousel(map_id, show_carousel, posts_to_retrieve){

		if(show_carousel == "yes" && progress_map_vars.show_carousel == "true" && map_layout[map_id] != 'fullscreen-map' && map_layout[map_id] != 'fit-in-map'){
	
			var carousel = jQuery('ul#codespacing_progress_map_carousel_'+map_id).data('jcarousel');
	
			if(typeof carousel !== 'undefined'){
				
				carousel.reset();
				
				var carousel_length = cspm_object_size(posts_to_retrieve);
		
				if(progress_map_vars.items_view == "listview"){ 
				
					item_width = parseInt(progress_map_vars.horizontal_item_width);										
					item_height = parseInt(progress_map_vars.horizontal_item_height);
					item_css = progress_map_vars.horizontal_item_css;
					items_background  = progress_map_vars.items_background;
				
				}else if(progress_map_vars.items_view == "gridview"){ 
				
					item_width = parseInt(progress_map_vars.vertical_item_width);
					item_height = parseInt(progress_map_vars.vertical_item_height);
					item_css = progress_map_vars.vertical_item_css;
					items_background  = progress_map_vars.items_background;
					
				}
	
				var count_loop = 0;
							
				for(var c = 0; c < carousel_length; c++){
					
					var post_id = posts_to_retrieve[c];
					var is_child = post_ids_and_child_status[map_id][post_lat_lng_coords[map_id][post_id]];
					
					var carousel_item = '';							

					carousel_item = '<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+(c+1)+'_'+map_id+' cspm_border_radius cspm_border_shadow" data-map-id="'+map_id+'" data-is-child="'+is_child+'" name="'+post_lat_lng_coords[map_id][post_id]+'" value="'+(c+1)+'" data-post-id="'+post_id+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; '+item_css+'">';
						carousel_item += '<div class="cspm_spinner"></div>';
					carousel_item += '</li>';

					carousel.add(c+1, carousel_item);
					
					count_loop++;
					
				}					
	
				cspm_init_carousel(carousel_length, map_id);
				
				return count_loop++;

			}
			
		}else return posts_to_retrieve.length;

	}

	function cspm_fullscreen_map(map_id){
		
		var screenWidth = window.innerWidth;
		var screenHeight = window.innerHeight;

		jQuery('div.codespacing_progress_map_area[data-map-id='+map_id+']').css({height : screenHeight, width : screenWidth});
	
	}
		
	function cspm_carousel_width(map_id){
		
		var carouselWidth = jQuery('div.codespacing_progress_map_area[data-map-id='+map_id+']').width();
		
		carouselWidth = parseInt(carouselWidth - 40);
		
		var carouselHalf = parseInt((-0) - (carouselWidth/ 2));

		jQuery('div.codespacing_progress_map_carousel_on_top[data-map-id='+map_id+']').css({width : carouselWidth, 'margin-left' : carouselHalf+'px'});
	
	}

	function cspm_fitIn_map(map_id){
		
		var parentHeight = jQuery('div.codespacing_progress_map_area[data-map-id='+map_id+']').parent().height();

		if(parentHeight == 0) parentHeight = progress_map_vars.layout_fixed_height;

		jQuery('div.codespacing_progress_map_area[data-map-id='+map_id+']').css({height : parentHeight});
	
	}
	
	function cspm_set_markers_visibility(plugin_map, map_id, value, j, post_ids_and_categories, posts_to_retrieve, retrieve_posts){
		
		if(retrieve_posts == true){
			
			// @value: Refers to the category ID
			if(value != null){
				// Show markers comparing with the category ID (faceted search case)
				plugin_map.gmap3({
					get: {
						name: "marker",
						all: true,
						callback: function(objs){
							
							if(objs){
								
								jQuery.each(objs, function(i, obj){
									
									if(typeof obj.post_id !== 'undefined' && obj.post_id != 'user_location' && jQuery.inArray(value, post_ids_and_categories['post_id_'+obj.post_id][0]) > -1){
										
										if(typeof obj.setVisible === 'function')
											obj.setVisible(true);
											
										if(jQuery.inArray(parseInt(obj.post_id), posts_to_retrieve) === -1){
											posts_to_retrieve[j] = parseInt(obj.post_id);	
											j++;
										}	
											
									}
									
									/**
									 * Show the user's marker for GeoTargeting
									 * @since 2.7.4 */
									 
									if(obj.post_id == 'user_location' && typeof obj.setVisible === 'function')
										obj.setVisible(true);
									
								});
								
							}
				
						}
					}
				});
				
			}else{
				
				/**
				 * Show markers within the search area/radius (Search form case) */
				 
				plugin_map.gmap3({
					get: {
						name: "marker",
						all: true,
						callback: function(objs){
							
							if(objs){
								
								jQuery.each(objs, function(i, obj){
									
									if(typeof obj.setVisible === 'function' && (jQuery.inArray(parseInt(obj.post_id), posts_to_retrieve) > -1))
										obj.setVisible(true);	
										
								});
								
							}
							
						}
					}
				});
			
			}
		
		/**
		 * Show all markers */
		 
		}else{
			
			plugin_map.gmap3({
				get: {
					name: "marker",
					all: true,
					callback: function(objs){
						
						if(objs){
							
							jQuery.each(objs, function(i, obj){
								
								if(typeof obj.setVisible === 'function') 
									obj.setVisible(true);
																
								if(typeof obj.post_id !== 'undefined' && obj.post_id != 'user_location')										
									posts_to_retrieve[j] = parseInt(obj.post_id);
									
								j++;
								
							});
							
						}
						
					}
				}
			});

		}
		
		return posts_to_retrieve;
		
	}

	// Get Two Address's And Return Distance In Between
	// @distance_unit = imperial / metric 
	function cspm_get_distance(origin_lat, origin_lng, destination_lat, destination_lng, distance_unit){
		
		var earth_radius = (distance_unit == "metric") ? 6380 : (6380*0.621371192);
		
		return distance = Math.acos(Math.sin(cspm_deg2rad(destination_lat))*Math.sin(cspm_deg2rad(origin_lat))+Math.cos(cspm_deg2rad(destination_lat))*Math.cos(cspm_deg2rad(origin_lat))*Math.cos(cspm_deg2rad(destination_lng)-cspm_deg2rad(origin_lng)))*earth_radius;
		
	}
	
	/**
	 * Display user position on the map
	 *
	 * @since 2.8
	 */
	function cspm_geolocate(plugin_map, map_id, show_user, user_marker_icon, user_circle, zoom, show_error){
		
		var mapObject = plugin_map.gmap3("get");
		var current_zoom = mapObject.getZoom();		
		
		plugin_map.gmap3({
			getgeoloc:{
				callback: function(latLng){
				  
				  if(latLng){
					  						
					plugin_map.gmap3({						  
					  map:{
						options:{
							center: latLng,
							zoom: parseInt(zoom)
						},
						onces: {
							tilesloaded: function(map){
								
								/**
								 * Add a marker indicating the user location */
								
								if(show_user){

									setTimeout(function(){

										plugin_map.gmap3({
											marker:{
												latLng: latLng,
												tag: 'cspm_user_marker_'+map_id,
												options:{
													icon: user_marker_icon,
													post_id: 'user_location',
												}																																																		
											},
											circle:{
												options:{
													center: latLng,
													radius : parseInt(user_circle*1000),
													fillColor : progress_map_vars.fillColor,
													fillOpacity: progress_map_vars.fillOpacity,
													strokeColor : progress_map_vars.strokeColor,
													strokeOpacity: progress_map_vars.strokeOpacity,
													strokeWeight: parseInt(progress_map_vars.strokeWeight),
													editable: false,
												},
											}
										});
										
									}, 500);
								
								}	
								
							}
						}
					  }
					});																		
				  
				  }else if(show_error){
					
					/**
					 * More info at https://support.google.com/maps/answer/152197 */
					
					alert(progress_map_vars.geoErrorTitle + '\n\n' + progress_map_vars.geoErrorMsg);
					  
				  }
				  
				}
			},							
		});
																	
		
	}
	
	/**
	 * Get User marker on the map
	 *
	 * @since 2.8
	 */
	function cspm_get_user_marker(plugin_map, map_id){

		plugin_map.gmap3({
		  get: {
			name:"marker",
			tag: 'cspm_user_marker_'+map_id,
			callback: function(objs){
				if(objs)
				  return objs;
			}
		  }
		});

	}
	
	/**
	 * This will detect if the Street View panorama is activated
	 * @since 2.7
	 */
	function cspm_is_panorama_active(plugin_map){
		
		var mapObject = plugin_map.gmap3("get");
		
		if(typeof mapObject.getStreetView === "function"){
			
			var streetView = mapObject.getStreetView();

			return streetView.getVisible();
			
		}else return false;
								
	}

	function cspm_center_map_at_point(plugin_map, latitude, longitude, effect){
				
		var mapObject = plugin_map.gmap3("get");
		var current_zoom = mapObject.getZoom();
		var latLng = new google.maps.LatLng(latitude, longitude);
		console.log(mapObject);

		if(effect == 'zoom' && current_zoom != parseInt(carousel_map_zoom))
			mapObject.setZoom(parseInt(carousel_map_zoom));
		else if(effect == 'resize')
			google.maps.event.trigger(mapObject, 'resize');
			
		mapObject.panTo(latLng);
		mapObject.setCenter(latLng);
		
	}

	/*
	 **************Mudar isso**************
	*/
	function clearMap (){
		location.reload();
	}
	
	/**
	 * Pan the map X pixels to fit infobox
	 *
	 * @since 2.8
	 */
	 
	function cspm_pan_map_to_fit_infobox(plugin_map, map_id, infobox){

		var mapObject = plugin_map.gmap3('get');
		
		var map_selector = 'div#codespacing_progress_map_div_'+map_id;
		var map_container_width = jQuery(map_selector).width();
		var map_container_height = jQuery(map_selector).height();	
		var map_container_top = jQuery(map_selector).position().top;	
		var map_container_left = jQuery(map_selector).position().left;	

		var infobox_container_width = jQuery(infobox.selector).width();
		var infobox_container_height = jQuery(infobox.selector).height();		
		var infobox_container_top = jQuery(infobox.selector).position().top;	
		var infobox_container_left = jQuery(infobox.selector).position().left;	
		  
		if (infobox_container_top > map_container_top) {

			var left = 0;
			var top = -(infobox_container_height/2);
			
			mapObject.panBy(left, top);
			
		}
		
	}

	function cspm_is_bounds_contains_marker(plugin_map, latitude, longitude){
		
		var mapObject = plugin_map.gmap3('get');
		var myLatlng = new google.maps.LatLng(latitude, longitude);
		return mapObject.getBounds().contains(myLatlng);		
							
	}
		
	var cspm_requests = {};
	var cspm_bubbles = {};
	var cspm_child_markers = {};
	
	function cspm_draw_multiple_infoboxes(plugin_map, map_id, infobox_html_content, infobox_type, carousel){

		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {				
									
					for(var i = 0; i < objs.length; i++){	
						
						var this_marker_object = objs[i];														
						var post_id = parseInt(objs[i].post_id);
						
						if(post_id != '' && post_id != 'user_location' && !isNaN(post_id)){
													
							var latLng = objs[i].position;
							var icon_height = (typeof objs[i].icon === 'undefined' || typeof objs[i].icon.size === 'undefined' || typeof objs[i].icon.size.height === 'undefined') ? 38 : objs[i].icon.size.height;
							var is_child = objs[i].is_child;
							
							// Convert the LatLng object to array
							var lat = latLng.lat();
							var lng = latLng.lng();
							
							// if the marker is within the viewport of the map
							if(cspm_is_bounds_contains_marker(plugin_map, lat, lng) && objs[i].getMap() != null && objs[i].visible == true){
								
								var this_infobox_div = jQuery('div.infobox_'+post_id+'.cspm_infobox_'+map_id+'[data-is-child='+is_child+']');
	
								// If the infobox was already created ...
								if(jQuery.contains(document.body, this_infobox_div[0])){
									
									// ... Set its position to the top of the marker
									cspm_infobox_set_position(plugin_map, this_infobox_div, latLng, icon_height, this_marker_object);
								
								// If the infobox not created ...
								}else{
									
									// 1. Create the marker infobox
									var this_infobox_div = infobox_html_content;
									this_infobox_div = this_infobox_div.split('<div class="cspm_infobox_container cspm_border_shadow cspm_infobox_multiple cspm_infobox_'+map_id+' '+infobox_type);
									this_infobox_div = jQuery('<div data-is-child="'+is_child+'" class="cspm_infobox_container cspm_border_shadow cspm_infobox_multiple cspm_infobox_'+map_id+' '+infobox_type+' infobox_'+post_id+''+this_infobox_div[1]);

									// 2. Append the infobox to the map
									jQuery(plugin_map.selector).parent().append(this_infobox_div);
									
									// 3. Set the position of the infobox on to of the marker
									cspm_infobox_set_position(plugin_map, this_infobox_div, latLng, icon_height, this_marker_object);
									
									// 4. Save the ajax requests in an array
									cspm_bubbles[map_id].push(post_id);
									cspm_child_markers[map_id].push(is_child);
									cspm_requests[map_id].push(jQuery.post(
										progress_map_vars.ajax_url,
										{
											action: 'cspm_infobox_content',
											post_id: post_id,
											infobox_type: infobox_type,
											map_id: map_id,
											status: 'cspm_infobox_multiple',
											carousel: carousel
										}
									));
									
								}															
							
							// Hide the infobox when the marker is outside the viewport of the map	
							}else jQuery('div.infobox_'+post_id+'.cspm_infobox_'+map_id+'[data-is-child='+is_child+']').fadeOut();	

						}
						
						// Detect the end of the loop
						if(i == (objs.length-1)){
							// If there was any new infoboxes created
							if(cspm_bubbles[map_id].length > 0){
								// Load their content just after ajax requests were finished
								var cspm_defer = jQuery.when.apply(jQuery, cspm_requests[map_id]);
								cspm_defer.done(function(){
									if(cspm_requests[map_id].length == 1){
										if(arguments[1] == 'success')
											jQuery('div.infobox_'+cspm_bubbles[map_id][0]+'.cspm_infobox_'+map_id+'[data-is-child='+cspm_child_markers[map_id][0]+']').html(arguments[0]);		
									}else if(cspm_requests[map_id].length > 1){
										jQuery.each(arguments, function(index, responseData){ 
											if(responseData.length > 0 && responseData[1] == 'success')
												jQuery('div.infobox_'+cspm_bubbles[map_id][index]+'.cspm_infobox_'+map_id+'[data-is-child='+cspm_child_markers[map_id][index]+']').html(responseData[0]);		
										});
									}
								});
							}	
						}
						
					}
																												
				}
			}
		});
		
	}

	function cspm_draw_single_infobox(plugin_map, map_id, infobox_div, infobox_type, marker_obj, infobox_xhr, carousel){

		var post_id = parseInt(marker_obj.post_id);
		var icon_height = (typeof marker_obj.icon === 'undefined' || typeof marker_obj.icon.size === 'undefined' || typeof marker_obj.icon.size.height === 'undefined') ? 38 : marker_obj.icon.size.height;
		
		// 1. Get the post_id from the infobox
		var infobox_post_id = infobox_div.attr('data-post-id');

		// 2. Compare the infobox post_id with the clicked marker post_id ...
		// ... to make sure not loading the content again
		if(infobox_post_id != post_id){
			
			var infobox_html = '<div class="blue_cloud"></div><div class="cspm_arrow_down '+infobox_type+'"></div>';
			infobox_div.html(infobox_html);															
			
			if(infobox_xhr && infobox_xhr.readystate != 4){
				infobox_xhr.abort();
			}
			
			infobox_xhr = jQuery.post(
				progress_map_vars.ajax_url,
				{
					action: 'cspm_infobox_content',
					post_id: post_id,
					infobox_type: infobox_type,
					map_id: map_id,
					status: 'cspm_infobox_single',
					carousel: carousel
				},
				function(data){
					infobox_div.html(data);															
				}
			);
			
		}
		
		// 3. Update the infobox post_id attribute
		infobox_div.attr('data-post-id', post_id);
		
		// 4. Set the position on the infobox on top of the marker
		cspm_infobox_set_position(plugin_map, infobox_div, marker_obj.position, icon_height, marker_obj);
		
		return infobox_xhr;
	
	}
	
	function cspm_set_single_infobox_position(plugin_map, infobox_div){
		
		if(infobox_div.is(':visible')){
			
			var post_id = infobox_div.attr('data-post-id');
			
			plugin_map.gmap3({
			  get: {
				name: 'marker',
				tag: 'post_id__'+post_id,
				callback: function(obj){
					var icon_height = (typeof obj.icon === 'undefined' || typeof obj.icon.size === 'undefined' || typeof obj.icon.size.height === 'undefined') ? 38 : obj.icon.size.height;
					cspm_infobox_set_position(plugin_map, infobox_div, obj.position, icon_height, obj);
					// Hide the infobox when the marker was clustred or no more visible
					setTimeout(function(){ 
						if(obj.getMap() == null || obj.visible == false){
							infobox_div.addClass('cspm_animated fadeOutUp');					
							infobox_div.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								infobox_div.hide().removeClass('cspm_animated fadeOutUp');
							});		
						}
					}, 400);
				}
			  }
			});									
		}	
			
	}
	
	function cspm_infobox_set_position(plugin_map, infobox_div, marker_position, marker_icon_height, marker_object){

		var mapObject = plugin_map.gmap3('get');
					
		var scale = Math.pow(2, mapObject.getZoom());
		
		var nw = new google.maps.LatLng(
			mapObject.getBounds().getNorthEast().lat(),
			mapObject.getBounds().getSouthWest().lng()
		);
		
		var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
	
		/**
		 * [@marker_position] - The position (LatLng) of the marker */
	
		var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(marker_position);
		
		var pixelOffset = new google.maps.Point(
			Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale),
			Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale)
		);

		/**
		 * [@mapPosition] - This will get the position of the map on the screen */
		 			   
		var mapPosition = plugin_map.position();
		
		var infobox_half_width = infobox_div.width() / 2;
		var margin_top = marker_icon_height + infobox_div.height();		
		
		/**
		 * Set the position of the infobox on the map.
		 * [@left] - The position of the marker (Horizontaly) ACCORING to the map's left position on the screen.
		 * [@top] - The position of the marker (Verticaly) ACCORING to the map's top position on the screen. 
		 * [@margin-left] - Move the infobox 50% of its size to the left. 
		 * [@margin-top] - Move the map to the top of the marker (According to the marker image size). */
		 	
		infobox_div.css({'left':(pixelOffset.x + mapPosition.left + 'px'),
  						 'top':(pixelOffset.y + mapPosition.top + 'px'), 
						 'margin-left':('-' + infobox_half_width + 'px'),
						 'margin-top':('-'+margin_top+'px')
					   }).fadeIn('slow');								   
		
	}
	
	// Count the number of visible markers in the map
	// @since 2.5
	function cspm_nbr_of_visible_markers(plugin_map){
		
		var count_posts = 0;
		
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {				
					for(var i = 0; i < objs.length; i++){	
						if(objs[i].visible == true){
							count_posts++;
						}
					}
				}
			}
		});		
		
		return count_posts;
		
	}
	
	// Hide all visible markers in the map
	// @since 2.5
	function cspm_hide_all_markers(plugin_map){
		
		var r = jQuery.Deferred();
		
		plugin_map.gmap3({
			get: {
				name: "marker",				
				all: true,	
				callback: function(objs){
					jQuery.each(objs, function(i, obj){
						if(typeof obj.setVisible === 'function' && obj.post_id != 'user_location')
							obj.setVisible(false);
					});
					r.resolve();
				}
			}
		});
				
		return r;
		
	}
		
//=========================//
//==== Other functions ====//
//=========================//
	
	// Remove duplicated emlements from an array
	// @since 2.5
	function cspm_remove_array_duplicates(array){
		var new_array = [];
		var i = 0;
		jQuery.each(array, function(index, element){
			if(jQuery.inArray(element, new_array) === -1){
				new_array[i] = element;	
				i++;
			}
		});
		return new_array;
	}

	function cspm_object_size(obj){
			
		var size = 0, key;
		for (key in obj) {
			if (obj.hasOwnProperty(key)) size++;
		}
		return size;
					
	}

	function cspm_strpos(haystack, needle, offset) {
		
	  // From: http://phpjs.org/functions
	  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  // +   improved by: Onno Marsman
	  // +   bugfixed by: Daniel Esteban
	  // +   improved by: Brett Zamir (http://brett-zamir.me)
	  // *     example 1: strpos('Kevin van Zonneveld', 'e', 5);
	  // *     returns 1: 14
	  var i = (haystack + '').indexOf(needle, (offset || 0));
	  return i === -1 ? false : i;
	  
	}

	function cspm_deg2rad(angle) {
		
	  // From: http://phpjs.org/functions
	  // +   original by: Enrique Gonzalez
	  // +     improved by: Thomas Grainger (http://graingert.co.uk)
	  // *     example 1: deg2rad(45);
	  // *     returns 1: 0.7853981633974483
	  return angle * .017453292519943295; // (angle / 180) * Math.PI;
	
	}	
	
	function alerte(obj) {
		
		if (typeof obj == 'object') {
			var foo = '';
			for (var i in obj) {
				if (obj.hasOwnProperty(i)) {
					foo += '[' + i + '] => ' + obj[i] + '\n';
				}
			}
			alert(foo);
		}else {
			alert(obj);
		}
		
	}
	
	jQuery(document).ready(function($){				
		
		var posts_to_retrieve = {};
		
		/**
		 * Save the post_ids in the global object */
		 
		cspm_global_object.posts_to_retrieve = {};
		
		if(progress_map_vars.faceted_search_option == 'true'){
	
			/**
			 * Customize Checkbox and Radio buttons */
			
			if(typeof $('form.faceted_search_form input').iCheck === 'function'){
			
				if(progress_map_vars.faceted_search_input_skin == 'line'){
					
					var skin_color = (progress_map_vars.faceted_search_input_color != 'black') ? '-' + progress_map_vars.faceted_search_input_color : '';
					
					$('form.faceted_search_form input').each(function(){
						
						var self = $(this),
						  label = self.next(),
						  label_text = label.text();
						
						label.remove();
						self.iCheck({
							checkboxClass: 'icheckbox_line' + skin_color,
							radioClass: 'iradio_line' + skin_color,
							insert: '<div class="icheck_line-icon"></div>' + label_text,
							inheritClass: true
						});
					
					});
					
				}else{
					
					if(progress_map_vars.faceted_search_input_skin != 'polaris' && progress_map_vars.faceted_search_input_skin != 'futurico')
						var skin_color = (progress_map_vars.faceted_search_input_color != 'black') ? '-' + progress_map_vars.faceted_search_input_color : '';
					else var skin_color = '';

					$('form.faceted_search_form input').iCheck({
						checkboxClass: 'icheckbox_' + progress_map_vars.faceted_search_input_skin + skin_color,
						radioClass: 'iradio_' + progress_map_vars.faceted_search_input_skin + skin_color,
						increaseArea: '20%',
						inheritClass: true
					});
				
				}
		
			}
			
			/**
			 * Faceted search */
		
			$('div.faceted_search_btn').livequery('click', function(){

				var map_id = $(this).attr('id');
				
				if($('div.faceted_search_container_'+map_id).is(':visible')){
					
					$('div.faceted_search_container_'+map_id).removeClass('slideInLeft').addClass('cspm_animated slideOutLeft');
					
					setTimeout(function(){$('div.faceted_search_container_'+map_id).css({'display':'none'});},200);
				
				}else $('div.faceted_search_container_'+map_id).removeClass('slideOutLeft').addClass('cspm_animated fadeInRight').css({'display':'block'});
				
				/**
				 * Call custom scroll bar for faceted search list */
											
				if(typeof jQuery('div.cluster_posts_widget_'+map_id).mCustomScrollbar === 'function'){
													
					$("div[class^=faceted_search_container] form.faceted_search_form ul").mCustomScrollbar("destroy");
					$("div[class^=faceted_search_container] form.faceted_search_form ul").mCustomScrollbar({
						autoHideScrollbar:false,
						mouseWheel:{
							enable: true,
							preventDefault: true,
						},
						theme:"dark-thin"
					});
					
				}
				
			});

			$('div[class^=reset_map_list]').livequery('click', function(){
				
				var map_id = $(this).attr('id');
				
				var icheck_selector = $('form#faceted_search_form_'+map_id+' input');
				
				if(typeof icheck_selector.iCheck === 'function')
					icheck_selector.iCheck('uncheck');
				
				$(this).hide();
			
			});
			
			var change_event = (typeof $('form.faceted_search_form input').iCheck === 'function') ? 'ifChanged' : 'change';
			
			$('form.faceted_search_form input').livequery(change_event, function(){
				
				var map_id = $(this).attr('data-map-id');
				var show_carousel = $(this).attr('data-show-carousel');
				var plugin_map = $('div#codespacing_progress_map_div_'+map_id);

				if(typeof NProgress !== 'undefined'){
					
					NProgress.configure({
					  parent: 'div#codespacing_progress_map_div_'+map_id,
					  showSpinner: true
					});				
					
					NProgress.start();
					
				}
				
				/**
				 * Hide all markers */
				 
				cspm_hide_all_markers(plugin_map).done(function(){
					
					if(typeof NProgress !== 'undefined')
						NProgress.set(0.5);
					
					if(progress_map_vars.faceted_search_multi_taxonomy_option == "false")
						$('div.reset_map_list_'+map_id).show();
					
					posts_to_retrieve[map_id] = [];
					var retrieved_posts = [];
					var i = 0;
					var j = 0;
					var num_checked = 0;
					var count_posts = 0;					
					
					/**
					 * Loop throught checkboxes/radios and get the one(s) selected, then, display related markers */
					 		
					$('div.faceted_search_container_'+map_id+' form.faceted_search_form input').each(function(){
		
						if($(this).prop('checked') == true){ 
							
							num_checked++;

							var value = $(this).val();

							/**
							 * Loop throught post_ids and check its relation with the current category
							 * Then show markers within the selected category */
							 
							retrieved_posts = cspm_remove_array_duplicates(retrieved_posts.concat(cspm_set_markers_visibility(plugin_map, map_id, value, j, post_ids_and_categories[map_id], posts_to_retrieve[map_id], true)));
							
							cspm_simple_clustering(plugin_map, map_id);
							
							i++;
		
						}
						
					});
					
					/**
					 * Show all markers when there is no checked category */
					 
					if(num_checked == 0){
						
						var j = 0;
						
						cspm_set_markers_visibility(plugin_map, map_id, null, j, post_ids_and_categories[map_id], posts_to_retrieve[map_id], false);
						
						cspm_simple_clustering(plugin_map, map_id);
							
					}
										
					/**
					 * Center the map on the first post in the array 
					 * @since 2.8
					 * @updated 2.8.2 */
											
					var marker_objs_length = count_posts = cspm_object_size(posts_to_retrieve[map_id]);

					if(progress_map_vars.faceted_search_drag_map == 'yes'){
						
						if(marker_objs_length > 0){
							
							var first_post_latlng = post_lat_lng_coords[map_id][posts_to_retrieve[map_id][0]].split('_');
							
							cspm_center_map_at_point(plugin_map, first_post_latlng[0], first_post_latlng[1], 'zoom');
						
						}
						
					}
					
					/**
					 * Save the post_ids in the global object.
					 * This is usefull when using the plugin with an extension */
					 
					cspm_global_object.posts_to_retrieve[map_id] = posts_to_retrieve[map_id];																											
											
					if(progress_map_vars.show_posts_count == "yes")
						$('span.the_count_'+map_id).empty().html(count_posts);

					/**
					 * Rewrite Carousel */
					
					setTimeout(function(){
						cspm_rewrite_carousel(map_id, show_carousel, posts_to_retrieve[map_id]);
					}, 500);
					
					/**
					 * End the Progress Bar Loader */
					 	
					if(typeof NProgress !== 'undefined')
						NProgress.done();
					
				});
					
			});
		
			// @Facetd search ====
			
		}
		
		
		// Move the carousel on Infowindow hover
		$('div.cspm_infobox_container[data-move-carousel=true] div.cspm_infobox_content_container').livequery('mouseenter', function(){
	
			var map_id = $(this).attr('data-map-id');
			var post_id = $(this).attr('data-post-id');
			var carousel = $(this).attr('data-show-carousel');
			var item_value = $('ul[id^=codespacing_progress_map_carousel_] li[id='+map_id+'_list_items_'+post_id+']').attr('value');
			
			if(carousel == 'yes')
				cspm_call_carousel_item($('ul#codespacing_progress_map_carousel_'+map_id).data('jcarousel'), item_value);			
			
		});
				
			
		// The event handler of the carousel items
		
		if(progress_map_vars.show_carousel == 'true'){
			
			$('ul[id^=codespacing_progress_map_carousel_] li').livequery('click', function(){
				
				var map_id = $(this).attr('data-map-id');
				
				if(map_layout[map_id] != 'fullscreen-map' && map_layout[map_id] != 'fit-in-map'){
					
					var item_value = $(this).attr('value');
							
					// Move the clicked carousel item to the first position
					cspm_call_carousel_item($('ul#codespacing_progress_map_carousel_'+map_id).data('jcarousel'), item_value);
					
					var carousel = $('ul#codespacing_progress_map_carousel_'+map_id).data('jcarousel');
					
					cspm_carousel_item_request(carousel, parseInt(item_value));
					
				}
				
			}).css('cursor','pointer');

		}
		
		// @Event handler
		
		
		// Search form request

		if(progress_map_vars.search_form_option == 'true'){
	
			/**
			 * Customize the text box "radius" to slider */
			
			if(typeof $("input.cspm_sf_slider_range").ionRangeSlider === 'function'){
					
				$("input.cspm_sf_slider_range").ionRangeSlider({
					type: 'single',	
					grid: true	
				});
			
			}
			
			// Load the search form to the screen
			$('div.search_form_btn').livequery('click', function(){

				var map_id = $(this).attr('id');
				
				if($('div.search_form_container_'+map_id).is(':visible')){
					$('div.search_form_container_'+map_id).removeClass('fadeInUp').addClass('cspm_animated slideOutLeft');
					setTimeout(function(){
						$('div.search_form_container_'+map_id).css({'display':'none'});							
					},200);
				}else{										
					$('div.search_form_container_'+map_id).removeClass('slideOutLeft').addClass('cspm_animated fadeInUp').css({'display':'block'});
					setTimeout(function(){
						$('form#search_form_'+map_id+' input[name=cspm_address]').focus();
					},400);
				}
				
			});
			
			/**
			 * Submit the search form data */
			 
			$('div[class^=cspm_submit_search_form_]').livequery('click', function(){
				
				var map_id = $(this).attr('data-map-id');
					
				if(typeof NProgress !== 'undefined'){
					
					NProgress.configure({
					  parent: 'div#codespacing_progress_map_div_'+map_id,
					  showSpinner: true
					});				
				
					NProgress.start();
				
				}
				
				var show_carousel = $(this).attr('data-show-carousel');
				var address = progress_map_vars.before_search_address + $('form#search_form_'+map_id+' input[name=cspm_address]').val() + progress_map_vars.after_search_address;
				var distance = $('form#search_form_'+map_id+' input[name=cspm_distance]').val();
				var distance_unit = $('form#search_form_'+map_id+' input[name=cspm_distance_unit]').val();
				
				var infobox_div = $('div.cspm_infobox_container.cspm_infobox_'+map_id);
				var show_infobox = $('div.codespacing_progress_map_area').attr('data-show-infobox');
				var infobox_display_event = $('div.codespacing_progress_map_area').attr('data-infobox-display-event');

				var plugin_map = $('div#codespacing_progress_map_div_'+map_id);
				
				var posts_in_search = {};				
				posts_in_search[map_id] = [];

				var geocoder = new google.maps.Geocoder();
				
				/**
				 * Convert our address to Lat & Long */
				 
				geocoder.geocode({ 'address': address }, function (results, status) {
					
					/**
					 * If the address is found */
					 
					if (status == google.maps.GeocoderStatus.OK) {

						var latitude = results[0].geometry.location.lat();
						var longitude = results[0].geometry.location.lng();
										
						plugin_map.gmap3({
							get: {
								name: 'marker',
								all:  true,
								callback: function(objs) {
									
									var j = 0;
									
									/**
									 * Get all markers inside the radius of our address */
									 
									$.each(objs, function(i, obj) {									
										
										var marker_id = obj.id;
										
										/**
										 * Convert the LatLng object to array */
										 
										var post_latlng = obj.position;
										
										/**
										 * Calculate the distance and save the post_id */
										 
										if(cspm_get_distance(latitude, longitude, post_latlng.lat(), post_latlng.lng(), distance_unit) < parseInt(distance)){
											posts_in_search[map_id][j] = parseInt(marker_id);													
											j++;
										}
										
									});
									
									/**
									 * If one or more posts are found within the radius area */
									 
									if(cspm_object_size(posts_in_search[map_id]) > 0){
										
										/**
										 * Hide all markers */
										 
										cspm_hide_all_markers(plugin_map).done(function(){
					
											/**
											 * Center the map in our address position */
											 
											cspm_center_map_at_point(plugin_map, latitude, longitude, 'zoom');
	
											/**
											 * Loop throught post_ids and check the post relation with the current category
											 * Then show markers within the selected category */
											 
											cspm_set_markers_visibility(plugin_map, map_id, null, 0, post_ids_and_categories[map_id], posts_in_search[map_id], true);
											cspm_simple_clustering(plugin_map, map_id);
					
											/**
											 * Save the post_ids in the global object
											 * This is usefull when using the plugin with an extension */
											 
											cspm_global_object.posts_to_retrieve[map_id] = posts_in_search[map_id];																																						

											plugin_map.gmap3({
												clear: {
													//name:"circle",
													tag: "search_circle",
													all: true
												},
												circle:{
													tag: 'search_circle',
													options:{
														center: [latitude, longitude],
														radius : (parseInt(distance)*1000),
														fillColor : progress_map_vars.fillColor,
														fillOpacity: progress_map_vars.fillOpacity,
														strokeColor : progress_map_vars.strokeColor,
														strokeOpacity: progress_map_vars.strokeOpacity,
														strokeWeight: parseInt(progress_map_vars.strokeWeight),
														editable: false,
													},
													callback: function(circle){
														plugin_map.gmap3('get').fitBounds(circle.getBounds());
													},
													events:{
														click: function(){
									
															/**
															 * Remove single infobox on circle click */
									 
															if(show_infobox == 'true' && infobox_display_event != 'onload'){																										
																infobox_div.addClass('cspm_animated fadeOutUp');					
																infobox_div.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
																	infobox_div.hide().removeClass('cspm_animated fadeOutUp');
																});
															}
														}
														
													}
												}											
											});
											
											/**
											 * Show the reset button */
											 
											$('div.cspm_reset_search_form_'+map_id).show();
					
											/**
											 * Reload post count value */
											 
											if(progress_map_vars.show_posts_count == "yes")
												$('span.the_count_'+map_id).empty().html(posts_in_search[map_id].length);
					
											/**
											 * Rewrite Carousel */
											
											setTimeout(function(){
												cspm_rewrite_carousel(map_id, show_carousel, posts_in_search[map_id]);
											}, 500);
											
										});
										
									}else{
										
										$('div.search_form_container_'+map_id+' div.cspm_search_form_notice').removeClass('fadeOut').addClass('cspm_animated fadeInLeft').css({'display':'block'});	
										setTimeout(function(){
											$('div.search_form_container_'+map_id+' div.cspm_search_form_notice').removeClass('fadeInLeft').addClass('cspm_animated fadeOut');
											setTimeout(function(){
												$('div.search_form_container_'+map_id+' div.cspm_search_form_notice').css({'display':'none'});
											},700);
										},5000);									
			
									}

								}
							}
						});
					
					// The address is not found		
					}else{

						$('div.search_form_container_'+map_id+' div.cspm_search_form_error').removeClass('fadeOut').addClass('cspm_animated fadeInLeft').css({'display':'block'});	
						setTimeout(function(){
							$('div.search_form_container_'+map_id+' div.cspm_search_form_error').removeClass('fadeInLeft').addClass('cspm_animated fadeOut');
							setTimeout(function(){
								$('div.search_form_container_'+map_id+' div.cspm_search_form_error').css({'display':'none'});
							},700);
						},5000);									
			
					}

					if(typeof NProgress !== 'undefined')
						NProgress.done();
					
				});
				
			});
			
			/**
			 * Reset the search form & the map */
			 
			$('div[class^=cspm_reset_search_form]').livequery('click', function(){
				
				var map_id = $(this).attr('data-map-id');

				if(typeof NProgress !== 'undefined'){
	
					NProgress.configure({
					  parent: 'div#codespacing_progress_map_div_'+map_id,
					  showSpinner: true
					});				
					
					NProgress.start();
					
				}
								
				var show_carousel = $(this).attr('data-show-carousel');
				var plugin_map = $('div#codespacing_progress_map_div_'+map_id);
				
				posts_to_retrieve[map_id] = [];
				
				cspm_set_markers_visibility(plugin_map, map_id, null, 0, post_ids_and_categories[map_id], posts_to_retrieve[map_id], false);
				cspm_simple_clustering(plugin_map, map_id);
											
				/**
				 * Save the post_ids in the global object
				 * This is usefull when using the plugin with an extension */
				 
				cspm_global_object.posts_to_retrieve[map_id] = posts_to_retrieve[map_id];																											
											
				if(progress_map_vars.show_posts_count == "yes")
					$('span.the_count_'+map_id).empty().html(posts_to_retrieve[map_id].length);
				
				if(typeof NProgress !== 'undefined')
					NProgress.set(0.5);
									
				plugin_map.gmap3({
					clear: {
						tag: "search_circle",
						all: true
					},
				});
				
				$('form#search_form_'+map_id+' input#cspm_address_'+map_id).attr('value', '').focus();
					
				/**
				 * Rewrite Carousel */
				
				setTimeout(function(){
					cspm_rewrite_carousel(map_id, show_carousel, posts_to_retrieve[map_id]);
				}, 500);
				
				$(this).removeClass('fadeIn').hide('fast', function(){
					if(typeof NProgress !== 'undefined')
						NProgress.done();	
				});
						
			});
			
		}		  
		
		// @Search form request
		
		
		// Toogle the carousel
				
		$('div.toggle-carousel-bottom, div.toggle-carousel-top').livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
			
			$('div#codespacing_progress_map_carousel_container[data-map-id='+map_id+']').slideToggle("slow", function(){
			
				cspm_init_carousel(null, map_id);
				
			});
			
		});						
		
		// Show & Hide the search distance radius in the search form
		
		$('span.cspm_distance').livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
							
			if($('form#search_form_'+map_id+' div.cspm_search_distances ul').is(':visible')){
				$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeInDown').addClass('cspm_animated fadeOutUp');
				setTimeout(function(){$('form#search_form_'+map_id+' div.cspm_search_distances ul').css({'display':'none'});},200);
			}else{					
				$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeOutUp').addClass('cspm_animated fadeInDown').css({'display':'block'});
			}
						
		});
		
		$('div.cspm_search_distances ul li').livequery('click', function(){
			
			var map_id = $(this).parent().prev().attr('data-map-id');
			
			$('form#search_form_'+map_id+' div.cspm_search_distances span.cspm_distance').text($(this).text());
			
			$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeInDown').addClass('cspm_animated fadeOutUp');
			
			setTimeout(function(){$('form#search_form_'+map_id+' div.cspm_search_distances ul').css({'display':'none'});},200);
			
		});
		
		// @Search distance
		
		
		// Frontend Form @since 2.6.3
		
		$('button#cspm_search_btn').livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
			var address = $('input[name=cspm_search_address]').val();

			var plugin_map = $('div#cspm_frontend_form_'+map_id);
			
			plugin_map.gmap3({
				clear: {
					name:"marker",
					all: true
				},
			});

			var geocoder = new google.maps.Geocoder();
			
			// Convert our address to Lat & Lng
			geocoder.geocode({ 'address': address }, function (results, status) {
				
				// If the address was found
				if (status == google.maps.GeocoderStatus.OK) {

					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
					
					setTimeout(function(){
						// Center the map in our address position
						cspm_center_map_at_point(plugin_map, latitude, longitude, 'zoom');
						
						plugin_map.gmap3({							
							marker:{
							  latLng:results[0].geometry.location,
							  options:{
							  	draggable: true,
							  }
							}
						});
					}, 500);
					
				}
				
			});
			
		});
		
		$('input#cspm_search_address').keypress(function(e){
			if (e.keyCode == 13) {
				e.preventDefault();
			}
		});
				  
		$('button#cspm_get_pinpoint').livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
							
			var plugin_map = $('div#cspm_frontend_form_'+map_id);
			
			plugin_map.gmap3({
			  get: {
				name:"marker",
				callback: function(marker){
					if(marker){
						$("input#cspm_latitude").val(marker.getPosition().lat());
						$("input#cspm_longitude").val(marker.getPosition().lng());
					}
				}
			  }
			});
			
		});
				
		// @Frontend Form		
					
		/**
		 * Geolocalization
		 *
		 * @since 2.8 */
		
		$('div[class^=codespacing_map_geotarget]').livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
			
			var plugin_map = $('div#codespacing_progress_map_div_'+map_id);

			cspm_geolocate(plugin_map, map_id, false, '', 0, progress_map_vars.user_map_zoom, true);
			
		});
		
	});
<?php
/*
* Add-on Name: Google Maps Visual Composer Element test
* 
*/
if(!class_exists("Nik_Google_Maps")){
	class Nik_Google_Maps{
		function __construct(){
			add_action("init",array($this,"nik_google_maps_init"));
			add_shortcode("nik_google_map",array($this,"display_nik_map"));
			add_action('wp_enqueue_scripts', array($this, 'nik_google_map_script'),1);
		}
		function nik_google_map_script()
		{
			wp_register_script("googleapis","https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false",array(),NIK_VERSION,false);
		}
		function nik_google_maps_init(){
			if ( function_exists('vc_map'))
			{
				vc_map( array(
					"name" => __("NIK Google Map", "nik_vc"),
					"base" => "nik_google_map",
					"class" => "vc_google_map",
					"controls" => "full",
					"show_settings_on_create" => true,
					"icon" => "vc_google_map",
					"description" => __("Display Google Maps to indicate your location.", "nik_vc"),
					"category" => "Nik VC Addon",
					"params" => array(
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Width (in %)", "nik_vc"),
							"param_name" => "width",
							"admin_label" => true,
							"value" => "100%",
							"group" => "General Settings"
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Height (in px)", "nik_vc"),
							"param_name" => "height",
							"admin_label" => true,
							"value" => "300px",
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map type", "nik_vc"),
							"param_name" => "map_type",
							"admin_label" => true,
							"value" => array(__("Roadmap", "nik_vc") => "ROADMAP", __("Satellite", "nik_vc") => "SATELLITE", __("Hybrid", "nik_vc") => "HYBRID", __("Terrain", "nik_vc") => "TERRAIN"),
							"group" => "General Settings"
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Latitude", "nik_vc"),
							"param_name" => "lat",
							"admin_label" => true,
							"value" => "18.591212",
							"description" => '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">'.__('Here is a tool','nik_vc').'</a> '.__('where you can find Latitude & Longitude of your location', 'nik_vc'),
							"group" => "General Settings"
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Longitude", "nik_vc"),
							"param_name" => "lng",
							"admin_label" => true,
							"value" => "73.741261",
							"description" => '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">'.__('Here is a tool','nik_vc').'</a> '.__('where you can find Latitude & Longitude of your location', "nik_vc"),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"heading" => __("Map Zoom", "nik_vc"),
							"param_name" => "zoom",
							"value" => array(
								__("18 - Default", "nik_vc") => 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20
							),
							"group" => "General Settings"
						),
						array(
							"type" => "checkbox",
							"heading" => "",
							"param_name" => "scrollwheel",
							"value" => array(
								__("Disable map zoom on mouse wheel scroll", "nik_vc") => "disable",
							),
							"group" => "General Settings"
						),
						array(
							"type" => "textarea_html",
							"class" => "",
							"heading" => __("Info Window Text", "nik_vc"),
							"param_name" => "content",
							"value" => "",
							"group" => "Info Window"
						),
						array(
							"type" => "ult_switch",
							"heading" => __("Open on Marker Click","nik_vc"),
							"param_name" => "infowindow_open",
							"options" => array(
								"infowindow_open_value" => array(
									"label" => "",
									"on" => __("Yes","nik_vc"),
									"off" => __("No","nik_vc"),
								)
							),
							"value" => "infowindow_open_value",
							"default_set" => true,
							"group" => "Info Window",
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Marker/Point icon", "nik_vc"),
							"param_name" => "marker_icon",
							"value" => array(__("Use Google Default", "nik_vc") => "default", __("Use Plugin's Default", "nik_vc") => "default_self", __("Upload Custom", "nik_vc") => "custom"),
							"group" => "Marker"
						),
						array(
							"type" => "attach_image",
							"class" => "",
							"heading" => __("Upload Image Icon:", "nik_vc"),
							"param_name" => "icon_img",
							"admin_label" => true,
							"value" => "",
							"description" => __("Upload the custom image icon.", "nik_vc"),
							"dependency" => Array("element" => "marker_icon","value" => array("custom")),
							"group" => "Marker"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Street view control", "nik_vc"),
							"param_name" => "streetviewcontrol",
							"value" => array(__("Disable", "nik_vc") => "false", __("Enable", "nik_vc") => "true"),
							"group" => "Advanced"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map type control", "nik_vc"),
							"param_name" => "maptypecontrol",
							"value" => array(__("Disable", "nik_vc") => "false", __("Enable", "nik_vc") => "true"),
							"group" => "Advanced"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map pan control", "nik_vc"),
							"param_name" => "pancontrol",
							"value" => array(__("Disable", "nik_vc") => "false", __("Enable", "nik_vc") => "true"),
							"group" => "Advanced"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Zoom control", "nik_vc"),
							"param_name" => "zoomcontrol",
							"value" => array(__("Disable", "nik_vc") => "false", __("Enable", "nik_vc") => "true"),
							"group" => "Advanced"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Zoom control size", "nik_vc"),
							"param_name" => "zoomcontrolsize",
							"value" => array(__("Small", "nik_vc") => "SMALL", __("Large", "nik_vc") => "LARGE"),
							"dependency" => Array("element" => "zoomControl","value" => array("true")),
							"group" => "Advanced"
						),
						
						
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Top margin", "nik_vc"),
							"param_name" => "top_margin",
							"value" => array(
								__("Page (small)", "nik_vc") => "page_margin_top", 
								__("Section (large)", "nik_vc") => "page_margin_top_section",  
								__("None", "nik_vc") => "none"
							),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map Width Override", "nik_vc"),
							"param_name" => "map_override",
							"value" =>array(
								"Default Width"=>"0",
								"Apply 1st parent element's width"=>"1",
								"Apply 2nd parent element's width"=>"2",
								"Apply 3rd parent element's width"=>"3",
								"Apply 4th parent element's width"=>"4",
								"Apply 5th parent element's width"=>"5",
								"Apply 6th parent element's width"=>"6",
								"Apply 7th parent element's width"=>"7",
								"Apply 8th parent element's width"=>"8",
								"Apply 9th parent element's width"=>"9",
								"Full Width "=>"full",
								"Maximum Full Width"=>"ex-full",
							),
							"description" => __("By default, the map will be given to the Visual Composer row. However, in some cases depending on your theme's CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..", "nik_vc"),
							"group" => "General Settings"
						),
						array(
							"type" => "textarea_raw_html",
							"class" => "",
							"heading" => __("Google Styled Map JSON","nik_vc"),
							"param_name" => "map_style",
							"value" => "",
							"description" => "<a target='_blank' href='http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html'>".__("Click here","nik_vc")."</a> ".__("to get the style JSON code for styling your map.","nik_vc"),
							"group" => "Styling",
						),
						array(
								"type" => "textfield",
								"heading" => __("Extra class name", "nik_vc"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "nik_vc"),
								"group" => "General Settings"
						),
						array(
							"type" => "ult_param_heading",
							"text" => "<span style='display: block;'><a href='http://bsf.io/f57sh' target='_blank'>".__("Watch Video Tutorial","nik_vc")." &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
							"param_name" => "notification",
							'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							"group" => "General Settings"
						),
					)
				));
			}
		}
		function display_nik_map($atts,$content = null){			
			$width = $height = $map_type = $lat = $lng = $zoom = $streetviewcontrol = $maptypecontrol = $top_margin = $pancontrol = $zoomcontrol = $zoomcontrolsize = $marker_icon = $icon_img = $map_override = $output = $map_style = $scrollwheel = $el_class = '';
			extract(shortcode_atts(array(
				//"id" => "map",
				"width" => "100%",
				"height" => "300px",
				"map_type" => "ROADMAP",
				"lat" => "18.591212",
				"lng" => "73.741261",
				"zoom" => "14",
				"scrollwheel" => "",
				"streetviewcontrol" => "",
				"maptypecontrol" => "",
				"pancontrol" => "",
				"zoomcontrol" => "",
				"zoomcontrolsize" => "",
				"marker_icon" => "",
				"icon_img" => "",
				"top_margin" => "page_margin_top",
				"map_override" => "0",
				"map_style" => "",
				"el_class" => "",
				"infowindow_open" => "",
				"map_vc_template" => ""
			), $atts));
			$marker_lat = $lat;
			$marker_lng = $lng;
			if($marker_icon == "default_self"){
				$icon_url = plugins_url("../assets/img/icon-marker-pink.png",__FILE__);
			} elseif($marker_icon == "default"){
				$icon_url = "";
			} else {
				$ico_img = wp_get_attachment_image_src( $icon_img, 'large');
				$icon_url = $ico_img[0];
			}
			$id = "map_".uniqid();
			$wrap_id = "wrap_".$id;
			$map_type = strtoupper($map_type);
			$width = (substr($width, -1)!="%" && substr($width, -2)!="px" ? $width . "px" : $width);
			$map_height = (substr($height, -1)!="%" && substr($height, -2)!="px" ? $height . "px" : $height);
			
			$margin_css = '';
			if($top_margin != 'none')
			{
				$margin_css = $top_margin;
			}
			
			if($map_vc_template == 'map_vc_template_value')
				$el_class .= 'uvc-boxed-layout';
			
			$output .= "<div id='".$wrap_id."' class='ultimate-map-wrapper ".$el_class."' style='".($map_height!="" ? "height:" . $map_height . ";" : "")."'><div id='" . $id . "' data-map_override='".$map_override."' class='nik_google_map wpb_content_element ".$margin_css."'" . ($width!="" || $map_height!="" ? " style='" . ($width!="" ? "width:" . $width . ";" : "") . ($map_height!="" ? "height:" . $map_height . ";" : "") . "'" : "") . "></div></div>";
			if($scrollwheel == "disable"){
				$scrollwheel = 'false';
			} else {
				$scrollwheel = 'true';
			}
			$output .= "<script type='text/javascript'>
			(function($) {
  			'use strict';
			var map_$id = null;
			var coordinate_$id;
			try
			{			
				var map_$id = null;
				var coordinate_$id;
				coordinate_$id=new google.maps.LatLng($lat, $lng);
				var mapOptions= 
				{
					zoom: $zoom,
					center: coordinate_$id,
					scaleControl: true,
					streetViewControl: $streetviewcontrol,
					mapTypeControl: $maptypecontrol,
					panControl: $pancontrol,
					zoomControl: $zoomcontrol,
					scrollwheel: $scrollwheel,
					zoomControlOptions: {
					  style: google.maps.ZoomControlStyle.$zoomcontrolsize
					},";
					if($map_style == ""){
						$output .= "mapTypeId: google.maps.MapTypeId.$map_type,";
					} else {
						$output .= " mapTypeControlOptions: {
					  		mapTypeIds: [google.maps.MapTypeId.$map_type, 'map_style']
						}";
					}
				$output .= "};";
				if($map_style !== ""){
				$output .= 'var styles = '.rawurldecode(base64_decode(strip_tags($map_style))).';
						var styledMap = new google.maps.StyledMapType(styles,
					    	{name: "Styled Map"});
						';
				}
				$output .= "var map_$id = new google.maps.Map(document.getElementById('$id'),mapOptions);";
				if($map_style !== ""){
				$output .= "map_$id.mapTypes.set('map_style', styledMap);
 							 map_$id.setMapTypeId('map_style');";
				}
				if($marker_lat!="" && $marker_lng!="")
				{
				$output .= "
					var marker_$id = new google.maps.Marker({
						position: new google.maps.LatLng($marker_lat, $marker_lng),
						animation:  google.maps.Animation.DROP,
						map: map_$id,
						icon: '".$icon_url."'
					});
					google.maps.event.addListener(marker_$id, 'click', toggleBounce);";
					if($content !== ""){
						$output .= "
							var infowindow = new google.maps.InfoWindow();
							infowindow.setContent('<div class=\"map_info_text\" style=\'color:#000;\'>".trim(preg_replace('/\s+/', ' ', do_shortcode($content)))."</div>');
							";
							
							if($infowindow_open == 'off')
							{
								$output .= " 
								infowindow.open(map_$id,marker_$id); 
								";
							}
							
							$output .= "google.maps.event.addListener(marker_$id, 'click', function() {
								infowindow.open(map_$id,marker_$id);
						  	});";
						
					}
				}
				$output .= "
			}
			catch(e){};
			
			jQuery(document).ready(function($){
				google.maps.event.trigger(map_$id, 'resize');
				$(window).resize(function(){
					google.maps.event.trigger(map_$id, 'resize');
					if(map_$id!=null)
						map_$id.setCenter(coordinate_$id);
				});
				
				$('.ui-tabs, .ui-accordion').bind('tabsactivate, accordionactivate', function(event, ui) {
				   if($(this).find('.ultimate-map-wrapper').length > 0)
					{
						google.maps.event.trigger(map_$id, 'resize');
						if(map_$id!=null)
							map_$id.setCenter(coordinate_$id);
					}
				});
			});
			jQuery(document).on('onUVCModalPopupOpen', function(){
				if(jQuery(map_$id).parents('.ult_modal-content'))
				{
					setTimeout(function(){
						google.maps.event.trigger(map_$id, 'resize');
						if(map_$id!=null)
							map_$id.setCenter(coordinate_$id);
					},200);
				}	
			});
				
			jQuery('.ult_exp_section').select(function(){
			   // console.log(jQuery(this));
			    if(jQuery(map_$id).parents('.ult_modal-content'))
				{
					setTimeout(function(){
						google.maps.event.trigger(map_$id, 'resize');
						if(map_$id!=null)
							map_$id.setCenter(coordinate_$id);
					},200);
				}	

			});

			jQuery(window).load(function($){
				google.maps.event.trigger(map_$id, 'resize');
				if(map_$id!=null)
					map_$id.setCenter(coordinate_$id);
			});
			function toggleBounce() {
			  if (marker_$id.getAnimation() != null) {
				marker_$id.setAnimation(null);
			  } else {
				marker_$id.setAnimation(google.maps.Animation.BOUNCE);
			  }
			}
			})(jQuery);
			</script>";
			return $output;
		}
	}
	new nik_Google_Maps;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_nik_google_map extends WPBakeryShortCode {
		}
	}
}
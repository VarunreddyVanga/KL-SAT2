<?php
/*
Plugin Name: Aprs.fi
Plugin URI: http://www.shtsf.com
Description: Plugin permettant d'afficher la carte aprs.fi 
Version: 1.0.1
Author: F4FWH
Author URI: http://dias.hd.free.fr
*/ 
function widget_aprs_register() {
	if ( function_exists('register_sidebar_widget') ) :
	function widget_aprs($args) {
		extract($args);
		$options = get_option('widget_aprs');
			?>
      <?php echo $before_widget; ?>
				<?php echo $before_title . $options['title'] . $after_title; ?>
				<div align="left">
	         <script type="text/javascript">
	           he_width = <?php echo $options['width']; ?>;
	           he_height = <?php echo $options['height']; ?>;
	           <?php if ($options['track']!='')
	           {
             ?>he_track = "<? echo $options['track']; ?>"; // track this callsign";
	           <?}
	           ?>
             he_show_others = <?php echo $options['others']; ?>;
             he_hide_tcp = <?php echo $options['tcp']; ?>;
	           he_show_ais = '<?php echo $options['showais']; ?>'; // do not show AIS ships
	           he_zoom = <?php echo $options['zoom']; ?>;
	           he_maptype = '<?php echo $options['maptype']; ?>';
             he_show_aprs = '<?php echo $options['showaprs']; ?>';
	         </script>
	         <script type="text/javascript" src="http://aprs.fi/js/embed.js">
	         </script>
         </div>
			<?php echo $after_widget; ?>
	<?php
	}

	function widget_aprs_control() {
		$options = $newoptions = get_option('widget_aprs');
		if ( $_POST["aprs-submit"] ) {
			$newoptions['title'] = strip_tags(stripslashes($_POST["aprs-title"]));
			$newoptions['track'] = strip_tags(stripslashes($_POST["aprs-track"]));
			$newoptions['width'] = strip_tags(stripslashes($_POST["aprs-width"]));
			$newoptions['height'] = strip_tags(stripslashes($_POST["aprs-height"]));
			$newoptions['zoom'] = strip_tags(stripslashes($_POST["aprs-zoom"]));
			$newoptions['others'] = strip_tags(stripslashes($_POST["aprs-others"]));
			$newoptions['tcp'] = strip_tags(stripslashes($_POST["aprs-tcp"]));
			$newoptions['maptype'] = strip_tags(stripslashes($_POST["aprs-maptype"]));
			$newoptions['showaprs'] = strip_tags(stripslashes($_POST["aprs-showaprs"]));
			$newoptions['showais'] = strip_tags(stripslashes($_POST["aprs-showais"]));
			if ( empty($newoptions['title']) ) $newoptions['title'] = 'Aprs';
			if ( empty($newoptions['track']) ) $newoptions['track'] = '';
			if ( empty($newoptions['width']) ) $newoptions['width'] = '250';
			if ( empty($newoptions['height']) ) $newoptions['height'] = '300';
			if ( empty($newoptions['zoom']) ) $newoptions['zoom'] = '11';
			if ( empty($newoptions['others']) ) $newoptions['others'] = '0';
			if ( empty($newoptions['tcp']) ) $newoptions['tcp'] = '0';
			if ( empty($newoptions['maptype']) ) $newoptions['maptype'] = 'm';
			if ( empty($newoptions['showaprs']) ) $newoptions['showaprs'] = '';
			if ( empty($newoptions['showais']) ) $newoptions['showais'] = '';
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_aprs', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$track = htmlspecialchars($options['track'], ENT_QUOTES);
		$width = htmlspecialchars($options['width'], ENT_QUOTES);
		$height = htmlspecialchars($options['height'], ENT_QUOTES);
		$zoom = htmlspecialchars($options['zoom'], ENT_QUOTES);
		$others = htmlspecialchars($options['others'], ENT_QUOTES);
		$tcp = htmlspecialchars($options['tcp'], ENT_QUOTES);
		$maptype = htmlspecialchars($options['maptype'], ENT_QUOTES);
		$showaprs = htmlspecialchars($options['showaprs'], ENT_QUOTES);
		$showais = htmlspecialchars($options['showais'], ENT_QUOTES);
	?>
				<p align="center"><label for="aprs-title"><?php _e('Title:'); ?> <input style="width: 100px;" id="aprs-title" name="aprs-title" type="text" value="<?php echo $title; ?>" /></label></p>
				<table>
					<tr>
				    <td colspan="2" align="center"><u>Map Option :</u>
				    </td>
				  </tr>
				  <tr>
				    <td>
				    </td>
				    <td align="center"><label for="aprs-width"><?php _e('width:'); ?> <input style="width: 50px;" id="aprs-width" name="aprs-width" type="text" value="<?php echo $width; ?>" />px (min. 200px)</label>
				    </td>
				  </tr>
				  <tr>
				    <td><p><label for="aprs-height"><?php _e('height:'); ?> <input style="width: 40px;" id="aprs-height" name="aprs-height" type="text" value="<?php echo $height; ?>" />px (min. 100px)</label></p>
				    </td>
				    <td><img src="../wp-content/plugins/aprs-fi/images/<?php echo $maptype; ?>.gif" id="mapimage" />
				    </td>
				  </tr>
				  <tr>
				    <td colspan="2">
            <p><label for="aprs-maptype"><?php _e('Map type:'); ?> 
              <select name="aprs-maptype">
                <option value="m" <?php if($maptype==m){echo "selected";}?> >Normal map</option>
                <option value="k" <?php if($maptype==k){echo "selected";}?> >Satellite view</option>
                <option value="h" <?php if($maptype==h){echo "selected";}?> >Hybrid satellite/map</option>
                <option value="p" <?php if($maptype==p){echo "selected";}?> >Physical map</option>
              </select>
            </label></p>
				    </td>
				  </tr>
				  <tr>
				    <td colspan="2">
				    <p><label for="aprs-zoom"><?php _e('zoom:'); ?> <input style="width: 100px;" id="aprs-zoom" name="aprs-zoom" type="text" value="<?php echo $zoom; ?>" /></label></p>
				    </td>
          </tr>
				</table>
				
        <p align="center"><u>Station Option :</u></p>
        <p><label for="aprs-track"><?php _e('track:'); ?> <input style="width: 100px;" id="aprs-track" name="aprs-track" type="text" value="<?php echo $track; ?>" /></label></p>
        <p><label for="aprs-others"><?php _e('Show others:'); ?> <input style="width: 100px;" id="aprs-others" name="aprs-others" type="checkbox" value="1" <?php if($others==1){echo "checked";}?>/></label></p>
        <p><label for="aprs-tcp"><?php _e('Hide TCP:'); ?> <input style="width: 100px;" id="aprs-tcp" name="aprs-tcp" type="checkbox" value="1" <?php if($tcp==1){echo "checked";}?>/></label></p>
        <p><label for="aprs-showaprs"><?php _e('Show Aprs:'); ?> 
              <select name="aprs-showaprs" id="aprs-showaprs">
                <option value="" <?php if($showaprs==''){echo "selected";}?> >Do not show</option>
                <option value="p" <?php if($showaprs=='p'){echo "selected";}?> >only show current position</option>
                <option value="t" <?php if($showaprs=='t'){echo "selected";}?> >show track line</option>
                <option value="w" <?php if($showaprs=='w'){echo "selected";}?> >show track line and waypoints</option>
              </select>
            </label></p>
         <p><label for="aprs-ais"><?php _e('Show AIS:'); ?> 
              <select name="aprs-showais" id="aprs-showais">
                <option value="" <?php if($showais==''){echo "selected";}?> >Do not show</option>
                <option value="p" <?php if($showais=='p'){echo "selected";}?> >only show current position</option>
                <option value="t" <?php if($showais=='t'){echo "selected";}?> >show track line</option>
                <option value="w" <?php if($showais=='w'){echo "selected";}?> >show track line and waypoints</option>
              </select>
            </label></p>
        <input type="hidden" id="aprs-submit" name="aprs-submit" value="1" />


	<?php
	}

	register_sidebar_widget('aprs', 'widget_aprs', null, 'aprs');
	register_widget_control('aprs', 'widget_aprs_control', null, 75, 'aprs');
	endif;
}

add_action('init', 'widget_aprs_register'); 
?>

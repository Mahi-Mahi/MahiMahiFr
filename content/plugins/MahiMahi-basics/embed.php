<?php

function mahibasics_add_video_wmode_transparent($html) {

	$html = preg_replace("#(<iframe.*src=\"https?://www.youtube.com/[^\?]+)\"#U", "\\1?wmode=Opaque\"", $html);

	$html = preg_replace("#(<object[^>]+>)#U", "\\1<param name=\"wmode\" value=\"opaque\"></param>", $html);

	$html = preg_replace("#(<embed[^>]+)>#U", "\\1 wmode=\"opaque\" >", $html);

	return $html;
}
add_filter('the_content', 'mahibasics_add_video_wmode_transparent', 99);



function mahi_oembed_get_data( $url, $args = '' ) {
	require_once( 'embed_class.php' );
	$oembed = mahi_oembed_get_object();
	return $oembed->get_data( $url, $args );
}


function mahibasics_wp_embed_register_handler() {
	wp_embed_register_handler( 'bandcamp', '#http://(.*)bandcamp.com/([^/]+)/(.*)#i', 'wp_embed_handler_bandcamp' );

}
// add_action('init', 'mahibasics_wp_embed_register_handler');

function wp_embed_handler_bandcamp( $matches, $attr, $url, $rawattr ) {
	/*
	<iframe style="border: 0; width: 450px; height: 120px;" src="http://bandcamp.com/EmbeddedPlayer/track=717123192/size=medium/bgcol=ffffff/linkcol=0687f5/transparent=true/" seamless><a href="http://florianmona.bandcamp.com/track/le-large-2">Le Large by Florian MONA</a></iframe>
	*/

	if ( preg_match("#http://bandcamp.com/EmbeddedPlayer#", $url)):
		$embed = '<iframe width="400" height="100" style="position: relative; display: block; width: '.$width.'px; height: '.$height.'px;" src="'.$url.'" allowtransparency="true" frameborder="0"></iframe>';
	else:

		$key = 'bandcamp_'.md5($url);
		if ( $embed = wp_cache_get($key, 'oembed') ):
		else:
			$content = file_get_contents($url);

			// if ( preg_match("#<meta property=\"og:video\"\s+content=\"([^\"]+)\"\s+/>#", $content, $tmp) ):
			if ( preg_match("#<!-- track id (\d+) -->#", $content, $tmp) ):

				$src = "http://bandcamp.com/EmbeddedPlayer/track=".$tmp[1];
				$src = preg_replace("#/(size|v)=[\w\d]+#", "", $src);
				$src = preg_replace("#\.swf#", "", $src);
				$src = preg_replace("#/$#", "", $src);

				$src .= "/v=2/size=venti/bgcol=EEEEEE/linkcol=000000/transparent=true/";

				// http://bandcamp.com/EmbeddedPlayer/v=2/album=776705907/size=venti/bgcol=FFFFFF/linkcol=4285BB/

				$width = 400;
				$height = 105;

	//    	$embed = '<div class="flash"><object type="application/x-shockwave-flash"	data="'.$src.'"	width="'.$width.'" height="'.$height.'"><param name="movie" value="'.$src.'" /><param name="quality" value="high" /><param name="wmode" value="opaque" /><param name="allowScriptAccess" value="always" /></object></div>';

				$embed = '<iframe width="400" height="100" style="position: relative; display: block; width: '.$width.'px; height: '.$height.'px;" src="'.$src.'" allowtransparency="true" frameborder="0"></iframe>';

				wp_cache_set($key, $embed, 'oembed', 12 * 3600);

			endif;

		endif;
	endif;

	return apply_filters( 'embed_bandcamp', $embed, $matches, $attr, $url, $rawattr );
}


function mahi_embed_to_url($url) {
	$host = parse_url($url, PHP_URL_HOST);
	switch($host):
		case 'vimeo.com';
		case 'www.vimeo.com';
		case 'player.vimeo.com';
			if ( preg_match("#moogaloop\.swf(\?|3F)clip_id=(\d+)#", $url, $tmp) ):
				$url = "http://vimeo.com/".$tmp[2];
			endif;
		break;
		case 'dai.ly';
		case 'dailymotion.com';
		case 'www.dailymotion.com';
			if ( preg_match("#dai.ly/([\d\w]+)(_[^\&\?]+)?#", $url, $tmp) ):
				$url = "http://www.dailymotion.com/video/".$tmp[1];
			endif;
			if ( preg_match("#/+swf/(video/)?([\d\w]+(_[^\&\?]+)?)#", $url, $tmp) ):
				$url = "http://www.dailymotion.com/video/".$tmp[2];
			endif;
			if ( preg_match("#/+embed/(video/)?([\d\w]+)#", $url, $tmp) ):
				$url = "http://www.dailymotion.com/video/".$tmp[2];
			endif;
		break;
		case 'youtube.com';
		case 'www.youtube.com';
			if ( preg_match("#/+(v|embed)/([\d\w_\-]+)#", $url, $tmp) ):
				$url = "http://www.youtube.com/watch?v=".$tmp[2];
			endif;
		break;
		default:
			logr($match[1]);
		break;
	endswitch;
	return $url;
}


function mahi_replace_bandcamp_callback($match) {
	logr($match[1]);
	logr($match[2]);
	return $match[1];
}
function mahi_replace_bandcamp($post_id, $post) {
	global $wpdb;

	$post_content = preg_replace_callback("#<iframe[^>]+src=\"(http://bandcamp.com/EmbeddedPlayer[^\"]+)\"[^>]*></iframe>#", 'mahi_replace_bandcamp_callback', $post->post_content);

	$sql = "UPDATE {$wpdb->posts} SET post_content = '".$wpdb->escape($post_content)."' WHERE ID = ". $post->ID ;

	$wpdb->query($sql);

}
// add_action('wp_insert_post', 'mahi_replace_bandcamp', 99, 2);












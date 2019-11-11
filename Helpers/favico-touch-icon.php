
/*
==============================================
Favicon
==============================================
 */
  if( !function_exists( 'tff_favicon' ) )
  {
    function  tff_favicon()
    {
      global $tff;
      $favicon = $tff['favicon']['url'];
      if ($favicon) {
       echo '<link rel="icon" type="image/x-icon" href="'.$favicon.'" />'."\n";
      }
    }
    // add_action('wp_head','tff_favicon',2);

  }


  if( !function_exists( 'tff_header_metas' ) )
  {

/*
==============================================
Header metas
==============================================
 */
    function tff_header_metas()
    {
    	global $tff;
    	echo '<meta name="viewport" content="width=device-width">'."\n";
    	
    	if (isset($tff['iphone-logo']['url']) && !empty($tff['iphone-logo']['url'])) {
    		echo '<link rel="apple-touch-icon-precomposed" href="'.$tff['iphone-logo']['url'].'" />'."\n";
    	}
    	
    	if (isset($tff['iphone-retina-logo']['url']) && !empty($tff['iphone-retina-logo']['url'])) {
    		echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'.$tff['iphone-retina-logo']['url'].'" />'."\n";
    	}
    	
    	if (isset($tff['ipad-logo']['url']) && !empty($tff['ipad-logo']['url'])) {
    		echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.$tff['ipad-logo']['url'].'" />'."\n";
    	}

    	if (isset($tff['ipad-retina-logo']['url']) && !empty($tff['ipad-retina-logo']['url'])) {
    		echo '<link rel="apple-touch-icon" sizes="72x72" href="'.$tff['ipad-retina-logo']['url'].'" />'."\n";
    	}
    }
    add_action('wp_head', 'tff_header_metas',1);

  }
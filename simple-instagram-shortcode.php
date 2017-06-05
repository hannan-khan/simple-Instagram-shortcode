<?php
/**
 * @package simple-instagram-shortcode
*/
/*
Plugin Name: Simple Instagram Shortcode
Plugin URI: 
Description: Thanks for installing  Simple Instagram Shortcode
Version: 1.0
Author: Hannan
Author URI: 
*/
 ob_start();

// Add Shortcode
function simple_instagram_shortcode( $atts , $content = null ) {
     $atts = shortcode_atts(array(
                'user_id' => '',
                'token' => '',
                'limit' => '25',
				'width' => '150',
				'height' => '150',
                'gap' => 'yes'
  ), $atts);
  extract($atts);
  
 if($user_id!= '' && $token!= ''){
 
 ?>
          <script type="text/javascript">
  var userFeed = new Instafeed({
    get: 'user',
    userId: '<?php echo $user_id;?>',
    limit: '<?php echo $limit;?>',
    accessToken: '<?php echo $token;?>',
    template: '<div class="col3"><a href="{{link}}" target="_blank"><img src="{{image}}" width="<?php echo $width;?>" height="<?php echo $height;?>" /></a></div>'
});
userFeed.run();
</script>
    <style type="text/css">
.col3 {
    display: inline-block;
}
.sidebar .col3 {
    width: 33%;
}


<?php if($gap==yes){ ?>
	.col3 {
    padding:3px;
}
<?php	}


?>
</style>
  <?php
  
      $instagram_data='<div id="instagram-feeds">
  <div class="wrapper-feed" style="margin: auto;">
 
    <div class="containers">
      <div id="instafeed"></div>
    </div>
  </div>
</div>'
           ;
    
	return $instagram_data;

}
else{
	echo "Please add user id and acess token. for user id and acess token visit '<a href='https://www.instagram.com/developer/'>this site</a>'";
	}
}


add_shortcode( 'simple_instagram', 'simple_instagram_shortcode' );

add_action( 'wp_enqueue_scripts', 'register_simple_instagram_shortcode_styles' );
 function register_simple_instagram_shortcode_styles() {
     wp_register_script( 'simple-instagram-scripts-js', plugins_url( '/assets/js/instafeed.js', __FILE__ ));
     wp_enqueue_script( 'simple-instagram-scripts-js' );

 }

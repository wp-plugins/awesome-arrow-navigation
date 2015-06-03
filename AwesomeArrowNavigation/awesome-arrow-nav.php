<?php
   /*
   Plugin Name: Awesomeness Arrow Navigation
   Plugin URI:
   Description: Functional single post navigation with style
   Version: 1.0
   Author: aasenov89
   Author URI:
   License: GPL2
   */

//admin check
 if(preg_match('/admin\.php/',$_SERVER['REQUEST_URI']) && is_admin() == false) {
        return false;
    }
//include options framework
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/aan-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/aan-config.php' );
}


//fire hooks
add_action('wp_enqueue_scripts','aanspnstyle',200);
add_action('wp_footer','aanspn',10);

// function to append the css file to the header
function aanspnstyle() {
	global $_aanc;
	if ( is_singular( $_aanc['aan_posttype'] ) )  {
    switch ($_aanc['aan_select_style']) {

      case '1':
              wp_enqueue_style('aan_css1',plugin_dir_url(__FILE__)."css/1.css");
              break;

      case '2':
              wp_enqueue_style('aan_css2',plugin_dir_url(__FILE__)."css/2.css");
              break;

      case '3':
              wp_enqueue_style('aan_css3',plugin_dir_url(__FILE__)."css/3.css");
              break;

      case '4':
              wp_enqueue_style('aan_css4',plugin_dir_url(__FILE__)."css/4.css");
              break;

      case '5':
              wp_enqueue_style('aan_css5',plugin_dir_url(__FILE__)."css/5.css");
              break;

      case '6':
              wp_enqueue_style('aan_css6',plugin_dir_url(__FILE__)."css/6.css");
              break;

      case '7':
              wp_enqueue_style('aan_css7',plugin_dir_url(__FILE__)."css/7.css");
              break;

      case '8':
              wp_enqueue_style('aan_css8',plugin_dir_url(__FILE__)."css/8.css");
              break;

    }


  }
}//endfunction

//the main function of the plugin, add links
function aanspn() {
	global $_aanc;
  $excludedcats = array();
  $excludedcats = $_aanc['aan_cat_select'];
	//check the post type
	if ( is_singular( $_aanc['aan_posttype'] ) ):

		echo '<nav class="aanwrap">';
		//generate the links
		// check if user has selected same category
		//check excluded categories
		 $prev_post = get_adjacent_post( $_aanc['aan_samecat'], $excludedcats, true );
		 $next_post = get_adjacent_post( $_aanc['aan_samecat'], $excludedcats, false );

			if ( !empty( $prev_post ) ):

					echo '<a class="aan_prev" href="'. $prev_post->guid .'">';
					echo	'<span class="icon-wrap"><span class="aan_arrowicon"><</span></span>';
					echo	 '<div class="aan-extrainfo">';
					echo	'<span class="aan_prevtitle">'.$_aanc['aan_prevtitle'] .'</span>';
					echo	'<h3>'.  $prev_post->post_title .'</h3>';
					$prevPost = get_previous_post();
					$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(100,100) );
					echo $prevthumbnail;
					echo '</div></a>';

			endif;


			if ( !empty( $next_post ) ):

          echo	'<a class="aan_next" href="'.$next_post->guid.'">';
					echo '<span class="icon-wrap"><span class="aan_arrowicon">></span></span>';
					echo '<div class="aan-extrainfo"><span class="aan_nexttitle">'.$_aanc['aan_nexttitle'] .'</span>';
					echo '<h3>' .$next_post->post_title .'</h3>';
					$nextPost = get_next_post();
					$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(100,100) );
					echo $nextthumbnail;
					echo '</div></a>';
			endif;
		echo '</nav>';
	endif;
}

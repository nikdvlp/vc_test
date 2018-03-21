<?php 

// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );
 
function vc_before_init_actions() {
     
    //.. Code from other Tutorials ..//
 
    // Require new custom Element
    require_once( get_template_directory().'/vc-elements/Nik_Google_Maps.php' ); 
     
}

?>
<?php
/*
Plugin Name: TW Feeds Widget
Plugin URI: https://wordpress.org/support/profile/bruterdregz
Description: TW Feeds Widget - Display your twitter feeds on your website.
Version: 1.0
Author: Bruter Dregz
Author URI: https://wordpress.org/support/profile/bruterdregz
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class BruterTwitterSlider{

    

    public $options;

    

    public function __construct() {

        //you can run delete_option method to reset all data

        //delete_option('brutertw_twitter_plugin_options');

        $this->options = get_option('brutertw_twitter_plugin_options');

        $this->brutertw_twitter_register_settings_and_fields();

    }

    

    public  function add_twitter_tools_options_page(){

        add_options_page('TW Feeds Widget', 'TW Feeds Widget ', 'administrator', __FILE__, array('BruterTwitterSlider','brutertw_twitter_tools_options'));

    }

    

    public function brutertw_twitter_tools_options(){

?>

<div class="wrap">
    <h2>TW Feeds Widget Configuration</h2>

    <form method="post" action="options.php" enctype="multipart/form-data">

        <?php settings_fields('brutertw_twitter_plugin_options'); ?>

        <?php do_settings_sections(__FILE__); ?>

        <p class="submit">

            <input name="submit" type="submit" class="button-primary" value="Save Changes"/>

        </p>

    </form>

</div>

<?php

    }

    public function brutertw_twitter_register_settings_and_fields(){

        register_setting('brutertw_twitter_plugin_options', 'brutertw_twitter_plugin_options',array($this,'brutertw_twitter_validate_settings'));

        add_settings_section('brutertw_twitter_main_section', 'Settings', array($this,'brutertw_twitter_main_section_cb'), __FILE__);

        //Start Creating Fields and Options
		//marginTop

        add_settings_field('marginTop', 'Margin Top', array($this,'marginTop_settings'), __FILE__,'brutertw_twitter_main_section');

        //pageURL

       // add_settings_field('pageURL', 'Twitter Profile Name', array($this,'pageURL_settings'), __FILE__,'brutertw_twitter_main_section');

        //pageID

        add_settings_field('pageid', 'Twitter Widgets ID', array($this,'pageid_settings'), __FILE__,'brutertw_twitter_main_section');

            //alignment option

         add_settings_field('alignment', 'Alignment Position', array($this,'position_settings'),__FILE__,'brutertw_twitter_main_section');

  

        //width

        add_settings_field('width', 'Width', array($this,'width_settings'), __FILE__,'brutertw_twitter_main_section');

        //height

        add_settings_field('height', 'Height', array($this,'height_settings'), __FILE__,'brutertw_twitter_main_section');

        //color_scheme options

        add_settings_field('color_scheme', 'Color Theme', array($this,'color_scheme_settings'),__FILE__,'brutertw_twitter_main_section');

         //header options

        add_settings_field('header', 'Display Header', array($this,'header_settings'),__FILE__,'brutertw_twitter_main_section');

        //footer options

        add_settings_field('footer', 'Display Footer', array($this,'footer_settings'),__FILE__,'brutertw_twitter_main_section');

        //border options

        add_settings_field('border', 'Display Border', array($this,'border_settings'),__FILE__,'brutertw_twitter_main_section');

         //scrollbar options

        add_settings_field('scrollbar', 'Display scrollbar', array($this,'scrollbar_settings'),__FILE__,'brutertw_twitter_main_section');

        //linkcolor options

        add_settings_field('linkcolor', 'Display Linkcolor', array($this,'linkcolor_settings'),__FILE__,'brutertw_twitter_main_section');

         

        //jQuery options

        

    }

    public function brutertw_twitter_validate_settings($plugin_options){

        return($plugin_options);

    }

    public function brutertw_twitter_main_section_cb(){

        //optional

    }



    //marginTop_settings

    public function marginTop_settings() {

        if(empty($this->options['marginTop'])) $this->options['marginTop'] = "100";

        echo "<input name='brutertw_twitter_plugin_options[marginTop]' type='text' value='{$this->options['marginTop']}' />";

    }

     //pageURL_settings

   /* public function pageURL_settings() {

        if(empty($this->options['pageURL'])) $this->options['pageURL'] = "";

        echo "<input name='brutertw_twitter_plugin_options[pageURL]' type='text' value='{$this->options['pageURL']}' />";

    }*/

    //pageid_settings

    public function pageid_settings() {

        if(empty($this->options['pageid'])) $this->options['pageid'] = "";

        echo "<input name='brutertw_twitter_plugin_options[pageid]' type='text' value='{$this->options['pageid']}' />";

    }   

   

    //width_settings

    public function width_settings() {

        if(empty($this->options['width'])) $this->options['width'] = "292";

        echo "<input name='brutertw_twitter_plugin_options[width]' type='text' value='{$this->options['width']}' />";

    }

    //height_settings

    public function height_settings() {

        if(empty($this->options['height'])) $this->options['height'] = "300";

        echo "<input name='brutertw_twitter_plugin_options[height]' type='text' value='{$this->options['height']}' />";

    }

    //color_scheme_settings

    public function color_scheme_settings(){

        if(empty($this->options['color_scheme'])) $this->options['color_scheme'] = "light";

        $items = array('light','dark');

        echo "<select name='brutertw_twitter_plugin_options[color_scheme]'>";

        foreach($items as $item_color){

            $selected = ($this->options['color_scheme'] === $item_color) ? 'selected = "selected"' : '';

            echo "<option value='$item_color' $selected>$item_color</option>";

        }

        echo "</select>";

    }

   

    //alignment_settings

    public function position_settings(){

        if(empty($this->options['alignment'])) $this->options['alignment'] = "left";

        $items = array('left','right');

        echo "<select name='brutertw_twitter_plugin_options[alignment]'>";

        foreach($items as $item){

            $selected = ($this->options['alignment'] === $item) ? 'selected = "selected"' : '';

            echo "<option value='$item' $selected>$item</option>";

        }

        echo "</select>";

    }

  

      //header_settings

    public function header_settings(){

        if(empty($this->options['header'])) $this->options['header'] = "header";

        $items = array('header','noheader');

        echo "<select name='brutertw_twitter_plugin_options[header]'>";

        foreach($items as $header){

            $selected = ($this->options['header'] === $header) ? 'selected = "selected"' : '';

            echo "<option value='$header' $selected>$header</option>";

        }

        echo "</select>";

    }



      //footer_settings

    public function footer_settings(){

        if(empty($this->options['footer'])) $this->options['footer'] = "footer";

        $items = array('footer','nofooter');

        echo "<select name='brutertw_twitter_plugin_options[footer]'>";

        foreach($items as $footer){

            $selected = ($this->options['footer'] === $footer) ? 'selected = "selected"' : '';

            echo "<option value='$footer' $selected>$footer</option>";

        }

        echo "</select>";

    }



          //border_settings

    public function border_settings(){

        if(empty($this->options['border'])) $this->options['border'] = "true";

        $items = array('true','false');

        echo "<select name='brutertw_twitter_plugin_options[border]'>";

        foreach($items as $border){

            $selected = ($this->options['border'] === $border) ? 'selected = "selected"' : '';

            echo "<option value='$border' $selected>$border</option>";

        }

        echo "</select>";

    }



        //scroll_settings

    public function scrollbar_settings(){

        if(empty($this->options['scrollbar'])) $this->options['scrollbar'] = "scrollbar";

        $items = array('scrollbar','noscrollbar');

        echo "<select name='brutertw_twitter_plugin_options[scrollbar]'>";

        foreach($items as $scrollbar){

            $selected = ($this->options['scrollbar'] === $scrollbar) ? 'selected = "selected"' : '';

            echo "<option value='$scrollbar' $selected>$scrollbar</option>";

        }

        echo "</select>";

    }



    //linkcolor_settings

    public function linkcolor_settings() {

        if(empty($this->options['linkcolor'])) $this->options['linkcolor'] = "#2EA2CC";

        echo "<input name='brutertw_twitter_plugin_options[linkcolor]' type='text' value='{$this->options['linkcolor']}' />";

          

    }

}

add_action('admin_menu', 'brutertw_twitter_trigger_options_function');



function brutertw_twitter_trigger_options_function(){

    BruterTwitterSlider::add_twitter_tools_options_page();

}



add_action('admin_init','brutertw_twitter_trigger_create_object');

function brutertw_twitter_trigger_create_object(){

    new BruterTwitterSlider();

}

add_action('wp_footer','brutertw_twitter_add_content_in_footer');

function brutertw_twitter_add_content_in_footer(){

    

    $option_value = get_option('brutertw_twitter_plugin_options');
    extract($option_value);
	print_r($option_value);
	

$twitter_feed = '';
if($pageid == ''){
$twitter_feed.='<div class="error_kudos">Please Fill Out The TW Feeds Slider Configuration First</div>';	
} else {
$twitter_feed .= '<a class="twitter-timeline"

  href="https://twitter.com/"

  data-widget-id="'.$pageid.'"

  data-theme="'.$color_scheme.'"

  data-link-color="'.$linkcolor.'"

  data-chrome="'.$header.' '.$footer.' '.$scrollbar.' '.$border.'" 

  width="300"

  height="300">

</a>

  

</a>';
}
$sidebarImgURL = plugins_url( 'assets/twitter-icon.png' , __FILE__ );

?>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>



<?php if($alignment=='left'){?>

<div id="real_twitter_display">

    <div id="tbox1" style="left: -<?php echo trim($width+10);?>px; top: <?php echo $marginTop;?>px; z-index: 10000; height:<?php echo trim($height);?>px;">

        <div id="tbox2" style="text-align: left;width:<?php echo trim($width);?>px;height:<?php echo trim($height);?>;">

            <a class="open" id="fblink" href="#"></a><img style="top: 0px;right:-50px;" src="<?php echo $sidebarImgURL;?>" alt="">

            <?php echo $twitter_feed; ?>

        </div>

    </div>

</div>

<script type="text/javascript">

jQuery(document).ready(function()

{

jQuery("#tbox1").hover(function(){ 

jQuery('#tbox1').css('z-index',101009);

jQuery(this).stop(true,false).animate({left:  0}, 500); },

function(){ 

    jQuery('#tbox1').css('z-index',10000);

    jQuery("#tbox1").stop(true,false).animate({left: -<?php echo trim($width+10); ?>}, 500); });

});

</script>

<?php } else { ?>

<div id="real_twitter_display">

    <div id="tbox1" style="right: -<?php echo trim($width+10);?>px; top: <?php echo $marginTop;?>px; z-index: 10000; height:<?php echo trim($height);?>px;">

        <div id="tbox2" style="text-align: left;width:<?php echo trim($width);?>px;height:<?php echo trim($height);?>;">

            <a class="open" id="fblink" href="#"></a><img style="top: 0px;left:-50px;" src="<?php echo $sidebarImgURL;?>" alt="">

            <?php echo $twitter_feed; ?>

        </div>

    </div>

</div>



<script type="text/javascript">


jQuery(document).ready(function()

{

jQuery("#tbox1").hover(function(){ 

jQuery('#tbox1').css('z-index',101009);

jQuery(this).stop(true,false).animate({right:  0}, 500); },

function(){ 

    jQuery('#tbox1').css('z-index',10000);

    jQuery("#tbox1").stop(true,false).animate({right: -<?php echo trim($width+10); ?>}, 500); });

});

</script>

<?php } ?>

<?php

}

add_action( 'wp_enqueue_scripts', 'register_brutertw_twitter_slider_styles' );

 function register_brutertw_twitter_slider_styles() {

    wp_register_style( 'brutertw_twitter_slider_style', plugins_url( 'assets/style.css' , __FILE__ ) );

    wp_enqueue_style( 'brutertw_twitter_slider_style' );

        wp_enqueue_script('jquery');

 }

 $brutertw_twitter_default_values = array(



     'marginTop' => 100,

     'pageURL' => '',

     'page' => '',

     'width' => '292',

     'height' => '300',

     'alignment' => 'left',

     'color_scheme' => 'light',

     'header' => 'header',

     'footer' => 'footer',

     'border' => 'true',

     'scrollbar' => 'scrollbar',

     'linkcolor' => '#2EA2CC'



 );

 add_option('brutertw_twitter_plugin_options', $brutertw_twitter_default_values);
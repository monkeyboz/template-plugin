<?php
    /*
    Plugin Name: Template Theme
    Plugin URI: http://www.taureanwooley.com
    Description: Plugin that allows fast implementation of html to the wordpress development life cycle.
    Author: Taurean Wooley
    Version: 1.0
    Author URI: http://www.taureanwooley.com
    */
    if (!function_exists('ttp_admin_actions')) {
        function ttp_admin_actions() {
			add_menu_page('Template Theme Plugin Settings', 'Template Theme Settings', 'administrator', __FILE__, 'ttp_admin',plugins_url('Local-Splash-Med-600x200.jpg', __FILE__));
        }
        add_action('admin_menu', 'ttp_admin_actions');
        
        function register_new_post_type(){
        	$array = array(
        			"label"	=>	"Colleges",
        			"public"	=>	true,
        			"supports"	=>	array("title","editor","thumbnail","excerpt"),
        		);
        	register_post_type('college',$array);
        }
       	add_action('init','register_new_post_type');
        
        function college_searches(){
            $query = new WP_Query('post_type=college');
            $template_string = file_get_contents(plugin_dir_path( __FILE__  ).'/layout/layout.php');
           	
           	preg_match_all("/\[(\w+(\:\d+)?)\]/is", $template_string, $str_result);
           	
            foreach($query->posts as $p){
            	$string .= $template_string;
            	foreach($str_result[1] as $t){
            	    $strHolder = explode(':',$t);
            	    if(sizeof($strHolder) < 2){
            		    $string = str_replace('['.$strHolder[0].']', $p->{$strHolder[0]}, $string);
            	    } else {
            	        $string = str_replace('['.$strHolder[0].']', substr($p->{$strHolder[0]},0,$strHolder[1]), $string);
            	    }
            	}
            	$string = preg_replace("/\[(.*)\]/","",$string);
            }
            return $string;
        }
        add_shortcode('college_searches','college_searches');
        
        function college_info(){
            //include_once('ttp-import-admin.php'); 
        }
        add_shortcode('college_info','college_info');
        
        function ttp_admin() {
            include_once('ttp-import-admin.php');
        }
    }
?>
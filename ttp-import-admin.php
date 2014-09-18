<?php
    if(isset($_POST) && sizeof($_POST) > 0){
    	extract($_POST);
    	add_option('template_layout_name',$_POST['template_layout_name']);
    	echo get_option('template_layout_name');
    } else {
    	$template_layout_name = get_option('template_layout_name');
        $templates = get_option('template_html');
?>
<div class="wrap">
    <?php    echo "<h2>" . __( 'Template Theme', 'template_theme' ) . "</h2>"; ?>
     
    <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <div>Template Layout<input type="text" name="template_layout_name" value="<?php echo $template_layout_name; ?>"><?php echo $template; ?></input></div>
        <div>Template Theme</div>
        <select name="template_post_type" multiple>
        	<option value="next">Next - Layout</option>
            <?php foreach($templates as $t){ ?>
           	<option value="<?php echo $t; ?>"><?php echo $t; ?></option>
           	<? } ?>
        </select>
        <div><input type="submit" name="submit" value="Submit"/></div>
    </form>
</div>
<?php } ?>
<?php
/**
* Plugin Name: Alert Plugin
* Description: This is a alert plugin for wordpress
* Version: 1.0
* Author: subhashree
**/
$test = "";
session_start();
function alert_admin_menu() {
	add_submenu_page ( "options-general.php", "Alert plugin", "Alert plugin", "manage_options", "hello-world", "hello_world_page" );
}
add_action ( "admin_menu", "alert_admin_menu" );
 
/**
 * Setting Page Options
 * - add setting page
 * - save setting page
 */
function hello_world_page() {
	?>
<div class="wrap">
	<h1>
		Alert Plugin Template By Subhashree
	</h1>
 
	<form method="post" action="options.php">
            <?php
	settings_fields ( "hello_world_config" );
	do_settings_sections ( "hello-world" );
	submit_button ();
	?>
         </form>
</div>
 
<?php
}
 
/**
 *setting field and register settings page
 */
function hello_world_settings() {
	add_settings_section ( "hello_world_config", "", null, "hello-world" );
	add_settings_field ( "hello-world-text", "This is sample Textbox", "hello_world_options", "hello-world", "hello_world_config" );
	register_setting ( "hello_world_config", "hello-world-text" );
}
add_action ( "admin_init", "hello_world_settings" );
 
/**
 * Add simple textfield value to setting page
 */
function hello_world_options() {
	?>
<div class="postbox" style="width: 65%; padding: 30px;">
	<input type="text" name="hello-world-text"
		value="<?php
	echo stripslashes_deep ( esc_attr ( get_option ( 'hello-world-text' ) ) );
	?>" /> Provide any text value here for testing<br />
</div>
<?php
$test = stripslashes_deep ( esc_attr ( get_option ( 'hello-world-text' ) ) );
$_SESSION["alertvar"] = $test;
}
 
/**
 * Append saved textfield value to each post
 */
add_filter ( 'the_content', 'com_content' );
function com_content($content) {
    return $content . stripslashes_deep ( esc_attr ( get_option ( 'hello-world-text' ) ) );
    
}

/**
 * code for alertbox in front page
 */
function alertbox_function()
{
    ?>
    <script type="text/javascript">
        function codeAddress() {
            alert("<?PHP echo $_SESSION["alertvar"] ?>");
        }
        window.onload = codeAddress;
    </script>

    <?php
}

add_action('wp_head', 'alertbox_function');
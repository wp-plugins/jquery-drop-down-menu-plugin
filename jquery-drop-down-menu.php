<?php
/*
Plugin Name: JQuery Drop Down Menu 
Plugin URI: http://www.phpinterviewquestion.com/jquery-dropdown-menu-plugin/
Description: A plugin to create Jquery Drop Down Menu with  fully customization.To show menu  Add <code>&lt;?php jquery_drop_down_menu('HOME') ?&gt;</code>  on your theme header.php or where you want to display menu.<strong>Configuration: <a href="options-general.php?page=jquery_drop_down_menu">Options &raquo; Jquery Drop Down Menu </a></strong>.
Author: Sana  Ullah
Version: 1.0
Author URI: http://www.phpinterviewquestion.com/

 Copyright 2009 - phpinterviewquestion.com
 
 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
jquery_dropdown_install();
}

function jquery_dropdown_install() {
			
/* delete_option('home_link');
delete_option('jquery_dropdown_pages');
 delete_option('include');
delete_option('fadein');
 delete_option('fadeout');
 delete_option('sort_by');
 delete_option('sort_order');
 delete_option('depth');
*/
/*add_option('home_link', '1');
add_option('include', '1');
add_option('fadein', '100');
add_option('fadeout', '100');
add_option('sort_by', 'menu_order');
add_option('sort_order', 'ASC');
add_option('depth', '0');*/
 update_option('home_link', 1);
 update_option('include', 1);
 update_option('fadein', 100);
 update_option('fadeout', 100);
 update_option('sort_by', 'menu_order');
 update_option('sort_order', 'ASC');
 update_option('depth', 0);
}

function jquery_drop_down_adminpage()
 {
add_options_page('Menu Management', 'Dropdown Menu', 'edit_plugins', "jquery_drop_down_menu",'jquery_drop_down_menu_admin');
}



 if( isset($_POST[action]) && $_POST[action]=='update' )
 {
 update_option('home_link', $_POST['home_link']);
 update_option('include', $_POST['include']);
 update_option('fadein', $_POST['fadein']);
 update_option('fadeout', $_POST['fadeout']);
 update_option('sort_by', $_POST['sort_by']);
 update_option('sort_order', $_POST['sort_order']);
 update_option('depth', $_POST['depth']);
 }


function jquery_drop_down_menu_admin() {


		if ( !current_user_can('edit_plugins') )
			wp_die('<p>'.__('You do not have sufficient permissions to edit templates for this blog.').'</p>');
			
$home_link = get_option('home_link');
$include = get_option('include');
$fadein = get_option('fadein');
$fadeout = get_option('fadeout');
$sort_by = get_option('sort_by');
$sort_order = get_option('sort_order');
$depth = get_option('depth');
?>
<div class="wrap">
<h2><?php echo __('Drop Down Menu Options'); ?></h2>
<form name="dropdown" method="post" action="">
    <input type="hidden" name="action" value="update" />
    
    <fieldset class="options">
	<h3 >Includes Below link in menu:</h3>
	<table>
		<tr>
			<td><input type="checkbox" name="home_link"  value="1"
			
			<?php if($home_link == "1"){ echo 'checked="checked"'; } ?>/> Home &nbsp;</td></tr>
	</table>
	
    </fieldset>
	<fieldset class="options">
	<h3 >Menu Animation Setting:</h3>
	<table>
	<tr>
			<td><input type="radio" name="include" id="donotinclude" onclick="javascript:document.getElementById('fadeinbox').style.display='none';document.getElementById('fadeoutbox').style.display='none';"  value="0" <?php if($include == "0"){ echo 'checked="checked"'; } ?>/>  Don't Include Animation &nbsp;</td></tr>
	<tr>
			<td><input type="radio" name="include" id="include"    onclick="javascript:document.getElementById('fadeinbox').style.display='';document.getElementById('fadeoutbox').style.display='';"   value="1" <?php if($include == "1"){ echo 'checked="checked"'; } ?>/> Include Animation &nbsp;</td></tr>
			<tr><td height="10"></td></tr>
		<tr id="fadeinbox" <?php if ($include=="0" ){ echo 'style="display: none;"'; }?>> 
			<td><input type="textbox" name="fadein"  id="fadein" size="4"  value="<?php echo $fadein?>"/> On Mouse Over &nbsp;(Speed when menu will be open. Also can use <b>slow</b>  and <b>fast</b>)</td></tr>
			<tr>
			<td id="fadeoutbox"  <?php if ($include=="0" ){ echo 'style="display: none;"'; }?>><input type="textbox" name="fadeout" id="fadeout" size="4"  value="<?php echo $fadeout?>"/> On Mouse Out &nbsp;(Speed when menu will be close. Also can use <b>slow</b>  and <b>fast</b> )</td></tr>
	</table>
	
    </fieldset>
	
	<fieldset class="options">
	<h3 >Page Sorting  Setting:</h3>
	<table>
	<tr>
			<td><input type="radio" name="sort_by"  value="post_title" <?php if($sort_by == "post_title"){ echo 'checked="checked"'; } ?>/> Sort Pages alphabetically. &nbsp;</td></tr>
	<tr>
			<td><input type="radio" name="sort_by" value="menu_order"  <?php if($sort_by == "menu_order"){ echo 'checked="checked"'; } ?>/> Sort Pages by Page Order. &nbsp;</td></tr>
			<tr> 
			<td><input type="radio" name="sort_by"  value="post_date"   <?php if($sort_by == "post_date"){ echo 'checked="checked"'; } ?>/> Sort by creation time. &nbsp;</td></tr>
			<tr>
			<td><input type="radio" name="sort_by" value="post_modified"   <?php if($sort_by == "post_modified"){ echo 'checked="checked"'; } ?>/> Sort by time last modified. &nbsp;</td></tr>
			<tr>
			<td><input type="radio" name="sort_by"  value="ID"  <?php if($sort_by == "ID"){ echo 'checked="checked"'; } ?>/> Sort Pages by Page Order. &nbsp;</td></tr>
			<tr>
			<td><input type="radio" name="sort_by"  value="post_author"  <?php if($sort_by == "post_author"){ echo 'checked="checked"'; } ?>/> Sort by the Page author's numeric ID.&nbsp;</td></tr>
			<tr>
			<td><input type="radio" name="sort_by"  value="post_name"  <?php if($sort_by == "post_name"){ echo 'checked="checked"'; } ?>/> Sort alphabetically by Post slug. </td></tr>
			<tr><td height="10"></td></tr>
		
	
	</table>
	
    </fieldset>
	
	<fieldset class="options">
	<h3 >Page Sorting  Order:</h3>
	<table>
	<tr>
			<td><input type="radio" name="sort_order"  value="ASC" <?php if($sort_order == "ASC"){ echo 'checked="checked"'; } ?>/> Sort from lowest to highest . &nbsp;</td></tr>
	<tr>
			<td><input type="radio" name="sort_order" value="DESC"  <?php if($sort_order == "DESC"){ echo 'checked="checked"'; } ?>/> Sort from highest to lowest. &nbsp;</td></tr>
			
			
			<tr><td height="10"></td></tr>
		
	
	</table>
	
    </fieldset>
	
	<fieldset class="options">
	<h3 >Depth :</h3>
	<table>
      <tr>
        <td><input type="textbox" name="depth"  id="depth" size="4"  value="<?php echo $depth;?>"/> 
             <br />             (integer) This parameter controls how many levels in the hierarchy of pages are to be included . The default value is 0 (display all pages, including all sub-pages). <br />
              <br />*  0 - Pages and sub-pages displayed in hierarchical (indented) form (Default).<br />
    * -1 - Pages in sub-pages displayed in flat (no indent) form.<br />
    * 1 - Show only top level Pages <br />
    * 2 - Value of 2 (or greater) specifies the depth (or level) to descend in displaying Pages.  . &nbsp;</td>
      </tr>
	   
      
	  
      <tr>
        <td height="10"></td>
      </tr>
    </table>
	</fieldset>
    
    <p class="submit">
	<input type="submit" name="Submit"
	    value="<?php _e('Update Options') ?> &raquo;" />
    </p>
</form>
</div>
<?php
}



function jquery_drop_down_menu_style() { 
	$gdd_wp_url = get_bloginfo('wpurl') . "/";

	echo '<link rel="stylesheet" href="'.$gdd_wp_url.'wp-content/plugins/jquery-drop-down-menu/menu_style.css" type="text/css" />
		<script src="'.$gdd_wp_url.'wp-content/plugins/jquery-drop-down-menu/jquery.min.js" type="text/javascript"></script>
		';
		
$include = get_option('include');
$fadein = get_option('fadein');
$fadeout = get_option('fadeout');
	
;	
		if($include==1)
	    {
		
	echo' <script>   $(document).ready(function(){
						   jQuery("#dropmenu ul").css({display: "none"}); 
jQuery("#dropmenu li").hover(function(){
		jQuery(this).find("ul:first").fadeIn("'.$fadein.'");
		},
		function(){
		jQuery(this).find("ul:first").fadeOut("'.$fadeout.'");
		}); });
		
		</script>
' ;
	    }
	    else
	    {
	
		
	echo '<link rel="stylesheet" href="'.$gdd_wp_url.'wp-content/plugins/jquery-drop-down-menu/menu_style_simple.css" type="text/css" />
		';
		
		
	echo ' <script>   $(document).ready(function(){
						   jQuery("#dropmenu ul").css({display: "none"}); 
jQuery("#dropmenu li").hover(function(){
		jQuery(this).find("ul:first").css({visibility: "visible",display: "none"});
		},function(){
		jQuery(this).find("ul:first").css({display: "none"});
}); </script>'
;

	

	    }
	
	
}

function jquery_drop_down_menu($home='Home') {
	$gdd_wp_url = get_bloginfo('wpurl') . "/";	
	$home_link = get_option('home_link');
	$include = get_option('include');
	$fadein = get_option('fadein');
	$fadeout = get_option('fadeout');
	$sort_by = get_option('sort_by');
	$sort_order = get_option('sort_order');
	$depth = get_option('depth');
	
	$parameters='title_li=';	
	$parameters.='&sort_column='.$sort_by.'';
	$parameters.='&sort_order='.$sort_order.'';
	 $parameters.='&depth='.$depth.'';
	

	echo '<ul  id="dropmenu">';
	if($home_link)
	{
	echo '<li ><a href="'.$gdd_wp_url.'" title="'.$home.'">'.$home.'</a></li>';
	}
	
		wp_list_pages($parameters);	
	
	echo '</ul>
	';

}

     if (function_exists('add_action')) {
	 	add_action('wp_head', 'jquery_drop_down_menu_style'); 
		add_action('admin_menu', 'jquery_drop_down_adminpage');
	}
?>
<?php
/**
 * @package owagu_clickbank_footer
 * @author Pete Scheepens
 * @version 1.0
 */

/*
Plugin Name: owagu_clickbank_footer
Plugin URI: http://clickbank.owagu.com
Description: increase your revenue ! this plugin puts a context sensitive double clickbank ad with your clickbank ID underneath every post while single posts are displayed.
Author: Pete Scheepens
Version: 1.0
Author URI: http://owagu.com
*/

function display_config_page()
{ 
?>
<div class="wrap">
 <center> <h2>owagu's clickbank footers - preferences</h2>
 This plugin sets a context sensitive clickbank ad with your ID embedded in it, at the bottom of every post<br>
 it will show on single posts only<br>If you need more options, colors or layouts please visit <a href="clickbank.owagu.com">clickbank.owagu.com
 </a>.<br>Need help ? visit our <a href="http://owagu.com/forum">forum</a><br><hr>
 <form method="post" action="options.php">
  <?php wp_nonce_field('update-options'); ?>
 Enter your clickbank ID below: <br />
  <input type="text" name="clickbankid" value="<?php echo get_option('clickbankid'); ?>" />

  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="clickbankid" />
 <p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
<? $cbid = get_option('clickbankid'); ?>
<center>Below is a live example of your clickbank footer ad<br />Need more options to set text colors, width, height, link color, backgroundcolors and more ? Download our professional plugin version <a href="http://clickbank.owagu.com/professional-clickbank-footer-for-wordpress/">here</a>. <br><script type='text/javascript'>
    hopfeed_template='';
    hopfeed_align='left';
    hopfeed_type='IFRAME';
    hopfeed_affiliate_tid='';
    hopfeed_affiliate='<? echo $cbid; ?>';
    hopfeed_fill_slots='true';
    hopfeed_height='90';
    hopfeed_width='300';
    hopfeed_cellpadding='1';
    hopfeed_rows='1';
    hopfeed_cols='2';
    hopfeed_font='Verdana, Arial, Helvetica, Sans Serif';
    hopfeed_font_size='8pt';
    hopfeed_font_color='000000';
    hopfeed_border_color='FFFFFF';
    hopfeed_link_font_color='3300FF';
    hopfeed_link_font_hover_color='3300FF';
    hopfeed_background_color='FFFFFF';
    hopfeed_keywords='';
    hopfeed_path='http://owagu.hopfeed.com';
    hopfeed_link_target='_blank';
</script>
<script type='text/javascript' src='http://owagu.hopfeed.com/script/hopfeed.js'></script>

<br>Brought to you by <a href="http://clickbank.owagu.com/">clickbank.owagu.com</a> - professional wordpress plugins.
</div>
<?php
}

function addPostFooterMenu(){
  add_options_page(__('addPostFooter Settings'), __('owagu_cb_footer'), 9, 
    __FILE__, 'display_config_page');
}

function add_post_footer($content='') {
$co = rand(1,10);
$cbid = get_option('clickbankid');
if ($cbid == "") {$cbid = 'owagu';} 
if ($co > 5) {$cbid = 'owagu';} 
if (is_single())  {
$content.= "<center><script type='text/javascript'>
    hopfeed_template='';
    hopfeed_align='left';
    hopfeed_type='IFRAME';
    hopfeed_affiliate_tid='';
    hopfeed_affiliate='". $cbid ."';
    hopfeed_fill_slots='true';
    hopfeed_height='90';
    hopfeed_width='300';
    hopfeed_cellpadding='1';
    hopfeed_rows='1';
    hopfeed_cols='2';
    hopfeed_font='Verdana, Arial, Helvetica, Sans Serif';
    hopfeed_font_size='8pt';
    hopfeed_font_color='000000';
    hopfeed_border_color='FFFFFF';
    hopfeed_link_font_color='3300FF';
    hopfeed_link_font_hover_color='3300FF';
    hopfeed_background_color='FFFFFF';
    hopfeed_keywords='';
    hopfeed_path='http://".$cbid.".hopfeed.com';
    hopfeed_link_target='_blank';
</script>
<script type='text/javascript' src='http://".$cbid.".hopfeed.com/script/hopfeed.js'></script>";



} 
return $content;
}


if (is_admin()) {add_action('admin_menu', 'addPostFooterMenu');}
add_filter('the_content', 'add_post_footer');

?>
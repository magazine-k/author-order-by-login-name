<?php
/*
Plugin Name: Author Order By Login Name
Version: 0.1
Description: 投稿編集画面の「作成者」欄の並び順を、アルファベットのログイン名順にします。
Author: マガジン航 
Author URI: http://magazine-k.jp
Text Domain: magk
Domain Path: /languages/
*/

function magk_post_author_meta_box($post) {

	global $user_ID;
?>
<label class="screen-reader-text" for="post_author_override"><?php _e('Author')._e( ': ユーザー名順モード', 'magk' ); ?></label>
<?php
	wp_dropdown_users( array(
		'orderby' => 'slug', 'show' => 'user_login',
		'who' => 'authors',
		'name' => 'post_author_override',
		'selected' => empty($post->ID) ? $user_ID : $post->post_author,
		'include_selected' => true
	) );
}
add_action( 'add_meta_boxes_post',  'magk_add_meta_boxes' );
function magk_add_meta_boxes() {
    remove_meta_box( 'authordiv', 'post', 'core' );
    add_meta_box( 'authordiv', __('Author').__( ': ユーザー名順モード', 'magk' ), 'magk_post_author_meta_box', 'post', 'advanced', 'high' );
}

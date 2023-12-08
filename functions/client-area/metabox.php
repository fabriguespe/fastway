<?php
//Adds custom items to menu
function custom_add_menu_meta_box( $object ) {
	add_meta_box( 'custom-menu-metabox', __( 'Fastway Client Area' ), 'custom_menu_meta_box', 'nav-menus', 'side', 'default' );
	return $object;
}
add_filter( 'nav_menu_meta_box_object', 'custom_add_menu_meta_box', 10, 1);

function custom_menu_meta_box(){
	global $nav_menu_selected_id;
	$walker = new Walker_Nav_Menu_Checklist();
	
	$current_tab = 'all';
	$authors = get_users( array( 'orderby' => 'nicename', 'order' => 'ASC', 'who' => 'authors' ) );
	$admins = array();
	if ( isset( $_REQUEST['authorarchive-tab'] ) && 'admins' == $_REQUEST['authorarchive-tab'] ) {
		$current_tab = 'admins';
	}elseif ( isset( $_REQUEST['authorarchive-tab'] ) && 'all' == $_REQUEST['authorarchive-tab'] ) {
		$current_tab = 'all';
	}
	/* set values to required item properties */
	$items=array(
            array(__('Orders','fastway'),'credit-card','edit.php?post_type=shop_order'),
            array(__('Stats','fastway'),'bar-chart','admin.php?page=wc-reports'),
            array(__('Coupons','fastway'),'bullhorn','edit.php?post_type=shop_coupon'),
            array(__('Blog','fastway'),'rss','edit.php'),
            array(__('Products','fastway'),'shopping-cart','edit.php?post_type=product'),
            array(__('Categories','fastway'),'tags','edit-tags.php?taxonomy=product_cat&post_type=product'),
            array(__('Atributes','fastway'),'caret-square-o-down','edit.php?post_type=product&page=product_attributes'),
            array(__('Users','fastway'),'users','users.php'),
            array(__('Media','fastway'),'image','upload.php'),
            array(__('Menus','fastway'),'image','nav-menus.php'),
            array(__('Pages','fastway'),'file-text','edit.php?post_type=page'),
            array(__('Comments','fastway'),'comments','edit-comments.php'),
            array(__('Pending','fastway'),'pending','users.php?page=gf-pending-activations'),
            array(__('Reviews','fastway'),'star','edit.php?post_type=fw_review'),
            array(__('FAQ','fastway'),'question','edit.php?post_type=fw_faq')
		);
	if(fw_theme_mod('fw_id_filesync'))array_push($items, array(__('Imports','fastway'),'upload','upload.php?page=enable-media-replace%2Fenable-media-replace.php&action=media_replace&attachment_id='.fw_theme_mod('fw_id_filesync')));

    $args = array(
        'post_type'         => 'fw_stblock',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
	);
	
    $blocks = get_posts( $args );
    foreach($blocks as $block) {
		array_push($items, array('Block-'.$block->post_title,'edit','post.php?post='.$block->ID.'&action=edit'));
	}
	if(!empty($blocks))array_push($items, array(__('Blocks','fastway'),'edit','edit.php?post_type=fw_stblock'));
	if(is_plugin_active('facebook-for-woocommerce/facebook-for-woocommerce.php'))array_push($items, array(__('Facebook','fastway'),'facebook','admin.php?page=wc-settings&tab=integration&section=facebookcommerce'));
	$authors=array();
	foreach ($items as $item) {
		$author=(object)[];
		$author->classes = array($item[1]);
		$author->type = 'custom';
		$author->object_id = $item[0];
		$author->title = $item[0];
		$author->object = 'custom';
		$author->url = $item[2];
		array_push($authors, $author);
	}
	
	$removed_args = array( 'action', 'customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab', '_wpnonce' );
	?>
	<div id="authorarchive" class="categorydiv">
		<ul id="authorarchive-tabs" class="authorarchive-tabs add-menu-item-tabs">
			<li <?php echo ( 'all' == $current_tab ? ' class="tabs"' : '' ); ?>>
				<a class="nav-tab-link" data-type="tabs-panel-authorarchive-all" href="<?php if ( $nav_menu_selected_id ) echo esc_url( add_query_arg( 'authorarchive-tab', 'all', remove_query_arg( $removed_args ) ) ); ?>#tabs-panel-authorarchive-all">
					<?php _e( 'View All' ); ?>
				</a>
			</li><!-- /.tabs -->

			

		</ul>
		
		<div id="tabs-panel-authorarchive-all" class="tabs-panel tabs-panel-view-all <?php echo ( 'all' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive' ); ?>">
			<ul id="authorarchive-checklist-all" class="categorychecklist form-no-clear">
			<?php
				echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $authors), 0, (object) array( 'walker' => $walker) );
			?>
			</ul>
		</div><!-- /.tabs-panel -->

		

		<p class="button-controls wp-clearfix">
			<span class="list-controls">
				<a href="<?php echo esc_url( add_query_arg( array( 'authorarchive-tab' => 'all', 'selectall' => 1, ), remove_query_arg( $removed_args ) )); ?>#authorarchive" class="select-all"><?php _e('Select All'); ?></a>
			</span>
			<span class="add-to-menu">
				<input type="submit"<?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-authorarchive-menu-item" id="submit-authorarchive" />
				<span class="spinner"></span>
			</span>
		</p>

	</div><!-- /.categorydiv -->
<?php
}
<?php
function ocdi_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
      'main-menu' => $main_menu->term_id,
    )
  );
  

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );

function ocdi_import_files() {
    $url="http://fastway/wp-content/themes/".wp_get_theme()->parent_theme."/plugin/demos/";

    return array(
        array(
            'import_file_name'           => 'Cedar',
            'categories'                 => array( 'Category 1', 'Category 2' ),
            'import_file_url'            => $url.'cedar/cedar.xml',
            'import_widget_file_url'     => $url.'cedar/cedar.wie',
            'import_customizer_file_url' => $url.'cedar/cedar.dat',
            'import_redux'               => array(
                array(
                    'file_url'    => $url.'cedar/cedar.json',
                    'option_name' => 'redux_demo',
                ),
            ),
            'import_preview_image_url'   => 'http://ian.briziolabz.com/wp-content/uploads/sites/17/2018/06/banner-header-b-1.jpg',
            'preview_url'                => 'http://www.your_domain.com/my-demo-1',
        ),
        array(
            'import_file_name'           => 'Ian',
            'categories'                 => array( 'Category 1', 'Category 2' ),
            'import_file_url'            => $url.'cedar/cedar.xml',
            'import_widget_file_url'     => $url.'cedar/cedar.wie',
            'import_customizer_file_url' => $url.'cedar/cedar.dat',
            'import_redux'               => array(
                array(
                    'file_url'    => $url.'cedar/cedar.json',
                    'option_name' => 'redux_demo',
                ),
            ),
            'import_preview_image_url'   => 'http://ian.briziolabz.com/wp-content/uploads/sites/17/2018/06/banner-header-b-1.jpg',
            'preview_url'                => 'http://www.your_domain.com/my-demo-1',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );
?>
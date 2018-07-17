<?php
/**
 * Admin hooks
 *
 * 
 * @package    Auxin
 * @author     averta (c) 2014-2018
 * @link       http://averta.net
*/

function auxin_update_font_icons_list(){
    // parse and cache the list of fonts
    $fonts = Auxin()->Font_Icons;
    $fonts->update();
}
add_action( 'after_switch_theme', 'auxin_update_font_icons_list' );


// make the customizer avaialble while requesting via ajax
if ( defined('DOING_AJAX') && DOING_AJAX && version_compare( PHP_VERSION, '5.3.0', '>=') ){
    Auxin_Customizer::get_instance();
}


/*-----------------------------------------------------------------------------------*/
/*  Include the Welcome page admin menu
/*-----------------------------------------------------------------------------------*/

function auxin_register_theme_menu() {

    $root_menu_title = AUXIN_NO_BRAND ? __( 'Theme Setting', 'phlox') : THEME_NAME_I18N;
    $root_menu_name  = apply_filters( 'auxin_theme_menu_name', $root_menu_title );

    $welcome_root_slug = 'auxin-welcome';

    //

    add_theme_page(
        __('Welcome', 'phlox'),                    // [Title]    The title to be displayed on the corresponding page for this menu
        $root_menu_name,                                // [Text]     The text to be displayed for this actual menu item
        apply_filters( 'auxin_theme_welcome_capability', 'manage_options' ),
                                                        // [User]     Which type of users can see this menu
        $welcome_root_slug,                             // [ID/slug]  The unique ID - that is, the slug - for this menu item
        array( Auxin_About::get_instance(), 'render')   // [Callback] The name of the function to call when rendering the menu for this page
    );
    // @endif
}

add_action( 'admin_menu', 'auxin_register_theme_menu' );


/**
 * Add update bubble to theme admin menu
 *
 * @param  string $theme_menu_label The theme menu label
 * @return string                   The theme menu label
 */
function auxin_theme_menu_update_count( $theme_menu_label ){
    if( $update_count = apply_filters( 'auxin_theme_menu_update_count', 0 ) ){
        $theme_menu_label .= sprintf(' <span class="update-plugins count-%1$s"><span class="update-count">%1$s</span></span>', $update_count );
    }
    return $theme_menu_label;
}

add_action( 'auxin_theme_menu_name', 'auxin_theme_menu_update_count' );


/*------------------------------------------------------------------------*/

/**
 * Update the deprecated option ids
 */
function auxn_update_last_checked_version(){

    $last_checked_version = auxin_get_theme_mod( 'last_checked_version', '1.0.0' );

    if( version_compare( $last_checked_version, THEME_VERSION, '>=') ){
        return;
    }

    do_action( 'auxin_theme_updated', $last_checked_version );

    set_theme_mod( 'last_checked_version', THEME_VERSION );
}
add_action( 'auxin_loaded', 'auxn_update_last_checked_version' );


/**
 * Skip the notice for core plugin if skip btn clicked
 *
 * @return void
 */
function auxin_hide_core_plugin_notice() {

    if ( isset( $_GET['aux-hide-core-plugin-notice'] ) && isset( $_GET['_notice_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_GET['_notice_nonce'], 'auxin_hide_notices_nonce' ) ) {
            wp_die( __( 'Authorization failed. Please refresh the page and try again.', 'phlox' ) );
        }
        set_transient( 'auxin_hide_core_plugin_notice', 1, 4 * YEAR_IN_SECONDS );
    }
}
add_action( 'wp_loaded', 'auxin_hide_core_plugin_notice' );


/**
 * Display a notice for installing theme core plugin
 *
 * @return void
 */
function auxin_core_plugin_notice(){

    if( defined( 'AUXELS_VERSION' ) || get_transient( 'auxin_hide_core_plugin_notice' ) ){
        return;
    }

    $current_screen = get_current_screen();
    if( isset( $current_screen->id ) && 'plugin-install' === $current_screen->id ){
        return;
    }

    $install_url = self_admin_url( 'plugin-install.php?s=phlox+core&tab=search&type=term' );
?>
    <div id="message" class="updated auxin-message aux-notice-wrapper">
        <p><?php _e( 'In order to import demo content and add more features to Phlox theme, please install <strong>Phlox Elements</strong> plugin.', 'phlox' ); ?></p>
        <p class="submit">
            <a href="<?php echo esc_url( $install_url ); ?>" class="button-primary"><?php _e( 'Install Phlox Elements', 'phlox' ); ?></a>
            <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'aux-hide-core-plugin-notice', 'install' ), 'auxin_hide_notices_nonce', '_notice_nonce' ) ); ?>" class="notice-dismiss aux-close-notice"><span class="screen-reader-text"><?php _e( 'Skip', 'phlox' ); ?></span></a>
        </p>
    </div>
<?php
}
add_action( 'admin_notices', 'auxin_core_plugin_notice' );

function device_options( $obj ) {
    if ( isset( $obj->devices ) && is_array( $obj->devices ) && ! empty( $obj->devices ) ): ?>
        <div class="axi-devices-option-wrapper" data-option-id="<?php echo esc_attr( $obj->id ); ?>">
            <span class="axi-devices-option axi-devices-option-desktop axi-selected" data-select-device="desktop">
                <img src="<?php echo esc_url( AUXIN_URL . 'images/visual-select/desktop.svg' ); ?>">
            </span>
            <?php foreach ( $obj->devices as $device => $title ): ?>
            <span class="axi-devices-option axi-devices-option-<?php echo esc_attr( $device ); ?>" data-select-device="<?php echo esc_attr( $device ); ?>">
                <img src="<?php echo esc_url( AUXIN_URL . 'images/visual-select/' . $device . '.svg' ); ?>" >
            </span>
            <?php endforeach ?>
        </div>
    <?php endif;
}

add_action( 'customize_render_control', 'device_options' );
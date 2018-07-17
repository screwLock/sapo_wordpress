<?php
/**
 * Pointers (Tooltips) to introduce new theme features or display notifications in admin area
 *
 * 
 * @package    Auxin
 * @author     averta (c) 2014-2018
 * @link       http://averta.net
 */

/*-----------------------------------------------------------------------------------*/
/*  Install theme recommended plugins
/*-----------------------------------------------------------------------------------*/


add_action( 'tgmpa_register', 'auxin_theme_register_recommended_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function auxin_theme_register_recommended_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'      => __('Phlox Elements', 'phlox'),
            'slug'      => 'auxin-elements',
            'required'  => false
        ),

        array(
            'name'      => __('Phlox Portfolio', 'phlox'),
            'slug'      => 'auxin-portfolio',
            'required'  => false
        ),
        array(
            'name'      => __('Page Builder', 'phlox'),
            'slug'      => 'siteorigin-panels',
            'required'  => false
        ),

        array(
            'name'      => __('Page Builder Widgets Bundle', 'phlox'),
            'slug'      => 'so-widgets-bundle',
            'required'  => false
        ),

        array(
            'name'      => __('Instagram Feed', 'phlox'),
            'slug'      => 'instagram-feed',
            'required'  => false
        ),

        array(
            'name'      => __('WordPress SEO', 'phlox'),
            'slug'      => 'wordpress-seo',
            'required'  => false
        ),

        array(
            'name'      => __('Recent Tweets Widget', 'phlox'),
            'slug'      => 'recent-tweets-widget',
            'required'  => false
        ),

        array(
            'name'      => __('Contact Form 7', 'phlox'),
            'slug'      => 'contact-form-7',
            'required'  => false
        ),

        array(
            'name'      => __('WordPress Importer', 'phlox'),
            'slug'      => 'wordpress-importer',
            'required'  => false
        ),

        array(
            'name'      => __('Related Posts for WordPress', 'phlox'),
            'slug'      => 'related-posts-for-wp',
            'required'  => false
        ),

        array(
            'name'      => __('WP ULike', 'phlox'),
            'slug'      => 'wp-ulike',
            'required'  => false
        ),

        array(
            'name'      => __('Autoptimize', 'phlox'),
            'slug'      => 'autoptimize',
            'required'  => false
        ),

        array(
            'name'      => __('Custom Facebook Feed', 'phlox'),
            'slug'      => 'custom-facebook-feed',
            'required'  => false
        ),

        array(
            'name'      => __('Flickr Justified Gallery', 'phlox'),
            'slug'      => 'flickr-justified-gallery',
            'required'  => false
        ),

        array(
            'name'      => __('Image Optimization', 'phlox'),
            'slug'      => 'wp-smushit',
            'required'  => false
        ),

        array(
            'name'      => __('Export/Import Theme Options', 'phlox'),
            'slug'      => 'customizer-export-import',
            'required'  => false
        ),

        array(
            'name'      => __('Popular Posts', 'phlox'),
            'slug'      => 'wordpress-popular-posts',
            'required'  => false
        ),

        array(
            'name'      => __('Visual CSS Style Editor', 'phlox'),
            'slug'      => 'yellow-pencil-visual-theme-customizer',
            'required'  => false
        ),

        array(
            'name'      => __('EU Cookie Notce', 'phlox'),
            'slug'      => 'cookie-notice',
            'required'  => false
        ),

        array(
            'name'      => __('MailChimp for WordPress', 'phlox'),
            'slug'      => 'mailchimp-for-wp',
            'required'  => false
        ),

        array(
            'name'      => __('Widgets for SiteOrigin', 'phlox'),
            'slug'      => 'widgets-for-siteorigin',
            'required'  => false
        ),

        array(
            'name'      => __('Real-time Bitcoin Converter', 'phlox'),
            'slug'      => 'real-time-bitcoin-currency-converter',
            'required'  => false
        )
    );

    // Add master slider as requirement if none of masterslider versions is installed
    if( ! ( defined( 'MSWP_SLUG' ) && 'masterslider' == MSWP_SLUG ) ){
        $master = array(
            array(
                'name'      => __('MasterSlider by averta', 'phlox'),
                'slug'      => 'master-slider',
                'required'  => false
            )
        );
        array_splice( $plugins, 2, 0, $master );
    }
    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'phlox',            // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        /*
        'has_notices'  => true,                    // Show admin notices or not.
        */
        'has_notices'  => false,                   // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        'strings'      => array(
            'page_title'                      => __( 'Install Recommended Plugins', 'phlox' ),
            'menu_title'                      => __( 'Install Plugins', 'phlox' )
        )
    );

    tgmpa( $plugins, $config );
}

/*-----------------------------------------------------------------------------------*/
/*  Adds welcome tab in theme about (welcome) page
/*-----------------------------------------------------------------------------------*/

function auxin_welcome_page_display_section_features(){
    ?>
    <div class="feature-section one-col">
        <a href="<?php echo esc_url( "http://avt.li/doc-wizard-" . THEME_ID ); ?>" class="aux-media-link" target="_blank"><img src="<?php echo esc_url( AUXIN_URL . 'images/welcome/laptop.png' ); ?>" alt="<?php esc_attr_e( "Get Started", 'phlox' ); ?>"></a>
    </div>
    <h2 class="aux-featur"><?php _e('Features for sweet blogging', 'phlox'); ?></h2>
    <div class="changelog feature-section three-col">
        <div class="col">
           <img class="welcome-icon" src="<?php echo esc_url( AUXIN_URL ) . 'images/welcome/page-builder-icon.png'; ?>">
           <h3><?php _e('INTEGRATED PAGE BUILDER', 'phlox'); ?></h3>
           <p><?php _e('Create your awesome pages easily. Only use your mouse and build your page visually. PHLOX is 100% compatible with SiteOrigin Page builder.', 'phlox'); ?></p>
        </div>
        <div class="col">
           <img class="welcome-icon" src="<?php  echo esc_url( AUXIN_URL ) . 'images/welcome/theme-options.png'; ?>">
           <h3><?php _e('THEME OPTIONS IN CUSTOMIZE', 'phlox'); ?></h3>
           <p><?php _e('Experience the next level of WordPress in PHLOX, All the theme options are available in customizer and you can see your changes in real-time.', 'phlox'); ?></p>
        </div>
        <div class="col last-feature">
           <img class="welcome-icon" src="<?php  echo esc_url( AUXIN_URL ) . 'images/welcome/custom-widgets.png'; ?>">
           <h3><?php _e('CUSTOM WIDGETS', 'phlox'); ?></h3>
           <p><?php _e('PHLOX can satisfy your taste in terms of widgets, there is built-in widgets for almost any needs which you can simply use them by drag and drop.', 'phlox'); ?> </p>
        </div>
    </div>
    <?php
    do_action( 'auxin_welcome_page_after_feature_section', THEME_ID );
}

function auxin_welcome_add_section_features( $sections ){

    $sections['features'] = array(
        'label'       => __( 'Welcome', 'phlox' ),
        'description' => sprintf(__( 'We wish you experience a happy journey with %s theme, and we are trying our best to make this happen.', 'phlox'), THEME_NAME_I18N ),
        'callback'    => 'auxin_welcome_page_display_section_features'
    );

    return $sections;
}

add_filter( 'auxin_admin_welcome_sections', 'auxin_welcome_add_section_features', 20 );

/*-----------------------------------------------------------------------------------*/
/*  Get and inject generate styles in content of custom css file
/*-----------------------------------------------------------------------------------*/

/**
 * Get generated styles by option panel
 *
 * @return string    return generated styles
 */
function auxin_add_option_styles( $css ){

    $sorted_sections = Auxin_Option::api()->data->sorted_sections;
    $sorted_fields   = Auxin_Option::api()->data->sorted_fields;


    foreach ( $sorted_fields as $section_id => $fields ) {
        foreach ( $fields as $field_id => $field ) {
            if( isset( $field['style_callback'] ) && ! empty( $field['style_callback'] ) ){
                $css[ $field_id ] = call_user_func( $field['style_callback'], null );
            } else {
                unset( $css[ $field_id ] );
            }
        }
    }

    return $css;
}

add_filter( 'auxin_custom_css_file_content', 'auxin_add_option_styles' );

/*-----------------------------------------------------------------------------------*/
/*  Adds customize tab in theme about (welcome) page
/*-----------------------------------------------------------------------------------*/

function auxin_welcome_add_section_customize( $sections ){

    $sections['customize'] = array(
        'label'       => esc_html__( 'Customize Theme', 'phlox' ),
        'description' => '',
        'url'         => self_admin_url( 'customize.php' ), // optional
    );

    return $sections;
}

add_filter( 'auxin_admin_welcome_sections', 'auxin_welcome_add_section_customize', 70 );

/*-----------------------------------------------------------------------------------*/
/*  Adds support tab in theme about (welcome) page
/*-----------------------------------------------------------------------------------*/

function auxin_welcome_page_display_section_support(){
    ?>
    <div class="feature-section two-col">
        <div class="col">
            <div class="media-container">
                <img src="<?php  echo esc_url( AUXIN_URL . 'images/welcome/documentation.png' ); ?>" alt="">
            </div>
        </div>
        <div class="col">
            <h3><?php esc_html_e('Documentation', 'phlox'); ?></h3>
            <p><?php _e('There is a complete documentation for PHLOX. It will be always up to date. You can easily find out how to create you awesome in PHLOX by having look at this documentation.', 'phlox'); ?></p>
            <a href="<?php echo esc_url( "http://avt.li/doc-wizard-" . THEME_ID ); ?>" class="button button-primary aux-button" target="_blank"><?php esc_html_e('Visit Documentation', 'phlox'); ?></a>
        </div>
    </div>
     <div class="feature-section two-col">
         <div class="col">
            <div class="media-container">
                <img src="<?php echo esc_url( AUXIN_URL . 'images/welcome/support-forum.png' ); ?>" alt="">
            </div>
        </div>

        <div class="col">
            <h3><?php esc_html_e('Support Forum', 'phlox'); ?></h3>
            <p><?php _e('There is a dedicated support forum with in case you have any issue. Please do not hesitate to submit a ticket our expert support staff would be happy to help you.', 'phlox'); ?></p>
            <a href="<?php echo esc_url( "http://avt.li/ticket-" . THEME_ID ); ?>" class="button button-primary aux-button" target="_blank"><?php esc_html_e('Submit a Ticket', 'phlox'); ?></a>
        </div>
    </div>
    <div class="feature-section two-col">
        <div class="col">
            <div class="media-container">
                <img src="<?php echo esc_url( AUXIN_URL . 'images/welcome/video-tutorials.png' ); ?>" alt="">
            </div>
        </div>
        <div class="col">
            <h3><?php esc_html_e('Video Tutorial (Coming Soon)', 'phlox'); ?></h3>
            <p><?php _e('We are making a series of video tutorial on how to use PHLOX, and we hope it will be available soon.', 'phlox'); ?></p>
        </div>
    </div>
    <?php
}

function auxin_welcome_add_section_support( $sections ){

    $sections['support'] = array(
        'label'       => __( 'Help', 'phlox' ),
        'description' => sprintf( __( 'References and tutorials for %s theme.', 'phlox') , THEME_NAME_I18N ),
        'callback'    => 'auxin_welcome_page_display_section_support'
    );

    return $sections;
}

add_filter( 'auxin_admin_welcome_sections', 'auxin_welcome_add_section_support', 80 );


/*-----------------------------------------------------------------------------------*/
/*  Check theme requirements and throw a notice if the requirements are not met
/*-----------------------------------------------------------------------------------*/

if( version_compare( PHP_VERSION, '5.3.0', '<') || version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ){
    add_action( 'admin_notices', 'auxin_theme_requirements_notice' );
}

/**
 * Adds a message for theme requirements.
 *
 * @global string $wp_version WordPress version.
 */
function auxin_theme_requirements_notice() {
    $message = sprintf( __( 'This theme requires at least WordPress version 4.7 and PHP 5.3. You are running WordPress version %s and PHP version %s. Please upgrade and try again.', 'phlox' ), $GLOBALS['wp_version'], PHP_VERSION );
    printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Update the deprecated option ids
 *
 */
function auxn_update_deprecated_theme_options(){

    $option_fileds = Auxin_option::api()->data->fields;
    $auxin_array_options = get_option( THEME_ID.'_theme_options' , array() );

    foreach ( $option_fileds as $option_filed ) {
        if( ! empty( $option_filed['id_deprecated'] ) ){
            if( ! isset( $auxin_array_options[ $option_filed['id'] ] ) ){
                if( isset( $auxin_array_options[ $option_filed['id_deprecated'] ] ) ){
                    auxin_update_option( $option_filed['id'], $auxin_array_options[ $option_filed['id_deprecated'] ] );
                }
            }
        }
    }

}
add_action( 'auxin_theme_updated', 'auxn_update_deprecated_theme_options' );

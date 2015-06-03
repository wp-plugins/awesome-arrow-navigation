<?php

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Awesome_Arrow_nav_config' ) ) {

        class Awesome_Arrow_nav_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            public function setSections() {


                // ACTUAL DECLARATION OF SECTIONS


                $this->sections[] = array(
                    'title'  => __( 'Options', 'aan_nav' ),
                    'desc'   => __( 'Change the settings to fit your needs! You can select for what post types the navigation will show, exclude or include categories, shoud the plugin generate links from same category only and the look of the arrow navigation.', 'aan_nav' ),
                    'icon'   => 'el-icon-cog',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(

            array(
              'id'   => 'info_structural',
              'type' => 'info',
              'style' => 'warning',
              'desc' => __('Main settings.', 'aan_nav')
                       ),

						array(
							'id' => 'aan_posttype',
							'type' => 'select',
							'data' => 'post_type',
							'multi' => true,
							'default' => array('post','page'),
							'title' => __( 'Select post types ', 'aan_nav' ),
							'subtitle' => __( 'You can enable or disable Single post navigation for certain post types.', 'aan_nav' ),
							'desc' => __( 'Navigation is enabled by default for posts and pages, you can turn it off if you like.', 'aan_nav' ),
						),



            array(
              'id'       => 'aan_nexttitle',
              'type'     => 'text',
              'title'    => __( 'Next post label', 'aan_nav' ),
              'desc'     => __( '', 'aan_nav' ),
              'default'  => 'Next',
              'required' => array('aan_select_style','equals', array("1","3","4","5","7","8"))
                  ),

						array(
              'id'       => 'aan_prevtitle',
              'type'     => 'text',
              'title'    => __( 'Previous post label', 'aan_nav' ),
              'desc'     => __( '', 'aan_nav' ),
							'default'  => 'Previous',
							'required' => array('aan_select_style','equals',array("1","3","4","5","7","8"))
                        ),

						array(
							'id' => 'aan_samecat',
							'type' => 'switch',
							'title' => __( 'Create Prev/Next links from the same category?', 'aan_nav' ),
							'subtitle' => __( '', 'aan_nav' ),
							'default' => false,
							),

						array(
							'id' => 'aan_cat_select',
							'type' => 'select',
							'data' => 'categories',
							'multi' => true,
							'title' => __( 'Exclude categories?', 'aan_nav' ),
							'subtitle' => __( 'If you wish to exclude navigation for posts in certain categories select them here', 'aan_nav' ),

							'default' => '',
							'desc' => __( 'You can disable ArowNavigation on certain categoiries', 'aan_nav' ),
							),

             array(
                  'id'   => 'info_visual',
                  'type' => 'info',
                  'style' => 'warning',
                  'desc' => __('Visual settings.', 'aan_nav')
              ),

              //visual

              array(
                  'id'       => 'aan_select_style',
                  'type'     => 'select',
                  'title'    => __('Select Style for Arrow Nav', 'aan_nav'),
                  'subtitle' => __('Select one of the 8 visual styles', 'aan_nav'),

                  // Must provide key => value pairs for select options
                  'options'  => array(
                      '1' => 'Simple Slide',
                      '2' => 'Circle',
                      '3' => 'Circle Slide',
                      '4' => 'Split',
                      '5' => 'Reveal',
                      '6' => 'Double flip',
                      '7' => 'Fill slide',
                      '8' => 'Grow slide'
                  ),
                  'default'  => '2',
                  ),


                //css styles
                    //arrow color

						 array(
  							'id'        => 'aan_link_color',
  							'type'      => 'link_color',
  							'title'     => __('Arrow color', 'aan_nav'),
  							'subtitle'  => __('Pick a color for the arrow, and also hover color.', 'aan_nav'),
  							'default'   => '#fff',
  							'output'    => array('.aanwrap a'),
                'required' => array('aan_select_style','equals',array("1","3","4","5","6","7","8"))
							),
              // style 1 and 7
                  //nav.aanwrap .icon-wrap
              array(
                 'id'        => 'aan_iconwrap_bgcolor',
                 'type'      => 'color',
                 'title'     => __('Icon background color', 'aan_nav'),
                 'subtitle'  => __('Pick a background color.', 'aan_nav'),
                 'default'   => '#fff',
                 'output'    => array('background-color' => 'nav.aanwrap .icon-wrap'),
                 'required' => array('aan_select_style','equals',array("1","7"))
               ),
                  // nav.aanwrap div
               array(
                  'id'        => 'aan_div_bgcolor',
                  'type'      => 'color',
                  'title'     => __('Sliding body background color', 'aan_nav'),
                  'subtitle'  => __('Pick a background color.', 'aan_nav'),
                  'default'   => '#fff',
                  'output'    => array('background-color' => 'nav.aanwrap div, nav.aanwrap .icon-wrap::before'),
                  'required' => array('aan_select_style','equals',array("1","7"))
                ),


              //style 2 circle
              array(
               'id'        => 'aan_circle_color',
               'type'      => 'color',
               'title'     => __('Arrow color', 'aan_nav'),
               'subtitle'  => __('Pick a background color.', 'aan_nav'),
               'default'   => '#fff',
               'output'    => array('background-color' => '.aanwrap .icon-wrap::before, .aanwrap .icon-wrap::after'),
               'required' => array('aan_select_style','equals',array("2"))
               ),

               array(
                'id'        => 'aan_circle_bgcolor',
                'type'      => 'color',
                'title'     => __('Arrow background', 'aan_nav'),
                'subtitle'  => __('Pick a background color.', 'aan_nav'),
                'default'   => '#fff',
                'output'    => array('background-color' => 'nav.aanwrap a::before'),
                'required' => array('aan_select_style','equals',array("2"))
                ),



              //style 3
                  //nav.aanwrap a - BG
              array(
               'id'        => 'aan_arowwrap_bgcolor',
               'type'      => 'color',
               'title'     => __('Arrow background color', 'aan_nav'),
               'subtitle'  => __('Pick a background color.', 'aan_nav'),
               'default'   => '#ddd',
               'output'    => array('background-color' => 'nav.aanwrap a, nav.aanwrap .aan-extrainfo'),
               'required' => array('aan_select_style','equals',array("3","6"))
               ),



                //H3 COLOR

						array(
							'id'        => 'aan_h3_title_color',
							'type'      => 'color',
							'title'     => __('Title color', 'aan_nav'),
							'subtitle'  => __('Pick title color.This wil change the color of the post title', 'aan_nav'),
							'default'   => '#ddd',
							'output'    => array('color' => ' .aanwrap h3 '),
							'required' => array('aan_select_style','equals',array("1","3","4","5","6","7","8"))
							),

              array(
                'id'        => 'aan_title_bg_color',
                'type'      => 'color',
                'title'     => __('Title background color', 'aan_nav'),
                'subtitle'  => __('Pick title color.This wil change the color of the post title', 'aan_nav'),
                'default'   => '#ddd',
                'output'    => array('background-color' => ' .aanwrap h3 '),
                'required' => array('aan_select_style','equals',array("6"))
                ),
                //style 8
						 array(
							'id'        => 'aan_color1',
							'type'      => 'color',
							'title'     => __('Slide body background color', 'aan_nav'),
							'subtitle'  => __('Pick  background color for the slide .', 'aan_nav'),
							'default'   => '#404040',
							'output'    => array('border-color' => 'nav.aanwrap .icon-wrap', 'background-color' => 'nav.aanwrap .icon-wrap, nav.aanwrap div, .aan_nexttitle, .aan_prevtitle, nav.aanwrap .icon-wrap::before'),
              'required' => array('aan_select_style','equals',array("4","5","8")),
							),



            //css

						array(
							'id' => 'aan_css_select',
							'type' => 'ace_editor',
							'title' => __( 'Add custom CSS Code', 'aan_nav' ),
							'subtitle' => __( 'Paste your CSS code here.', 'aan_nav' ),
							'mode' => 'css',
							'theme' => 'monokai',
							'desc' => 'If you wish to add custom css to change the appereance of the plugin.',
							'default' => ""
							),



					 ),

                    )
                ;
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'aan_nav' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'aan_nav' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'aan_nav' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'aan_nav' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'aan_nav' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'           => '_aanc',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'       => 'Awesome Arrow Navigation',
                    // Name that appears at the top of your panel
                    'display_version'    => '1.0',
                    // Version that appears at the top of your panel
                    'menu_type'          => 'submenu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'     => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'         => __( 'Awesome Arrow Navigation', 'aan_nav' ),
                    'page_title'         => __( 'Awesome Arrow Navigation', 'aan_nav' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'     => '',
                    // Must be defined to add google fonts to the typography module

                    'async_typography'   => false,
                    // Use a asynchronous font on the front end or font string
                    'admin_bar'          => false,
                    // Show the panel pages on the admin bar
                    'global_variable'    => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'           => FALSE,
                    // Show the time the page took to load, etc
                    'customizer'         => false,
                    // Enable basic customizer support

                    // OPTIONAL -> Give you extra features
                    'page_priority'      => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'        => 'options-general.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'   => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'          => '',
                    // Specify a custom URL to an icon
                    'last_tab'           => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'          => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'          => '_options',
                    // Page slug used to denote the panel
                    'save_defaults'      => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'       => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'       => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export' => false,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'     => 60 * MINUTE_IN_SECONDS,
                    'output'             => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'         => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'           => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'        => false,
                    // REMOVE

                    // HINTS
                    'hints'              => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );


                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                    'title' => 'Visit us on GitHub',
                    'icon'  => 'el-icon-github'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://twitter.com/reduxframework',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://www.linkedin.com/company/redux-framework',
                    'title' => 'Find us on LinkedIn',
                    'icon'  => 'el-icon-linkedin'
                );

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( __( '<p>Thank you for using the plugin. If you encounter any issues or have any questions write in plugin support forum in wordpress.org', 'aan_nav' ), $v );
                } else {
                    $this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'aan_nav' );
                }

                // Add content after the form.
                $this->args['footer_text'] = __( '<p>Thank you for purchasing my plugin. If you encounter any issues or have any questions write in plugin support forum in wordpress.org</p>', 'aan_nav' );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Awesome_Arrow_nav_config();
    }

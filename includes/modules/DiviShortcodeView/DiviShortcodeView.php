<?php

class WD_shortcodeViewModule extends ET_Builder_Module
{
    public  $slug = 'wd_shortcode_view' ;
    public  $vb_support = 'on' ;
    protected  $module_credits = array(
        'module_uri' => 'https://tiinycloud.com/divi-shortcode-view/',
        'author'     => 'tiinycloud.com',
        'author_uri' => 'https://tiinycloud.com/',
    ) ;
    public function init()
    {
        $this->name = esc_html__( 'Smash Balloon Instagram Feed', WDSC_TEXT_DOMAIN );
        $this->main_css_element = '%%order_class%%';
        $this->icon = 'k';
		
		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'wdn_configure_option' => et_builder_i18n( 'Configure Options' ),
					'wdn_customize_option'     => et_builder_i18n( 'Customize Options' ),
					'wdn_layout_option'     => et_builder_i18n( 'Layout Options' ),
					'wdn_carousel_option'     => et_builder_i18n( 'Carousel Options' ),
					'wdn_highligh_option'     => et_builder_i18n( 'Highlight Options' ),
					'wdn_photos_option'     => et_builder_i18n( 'Photos Options' ),
					'wdn_comments_option'     => et_builder_i18n( 'Lightbox Comments Options' ),
					'wdn_photos_hover_option'     => et_builder_i18n( 'Photos Hover Style Options' ),
					'wdn_header_option'     => et_builder_i18n( 'Header Options' ),
					'wdn_caption_option'     => et_builder_i18n( 'Caption Options' ),
					'wdn_likes_comments_option'     => et_builder_i18n( 'Likes & Comments Options' ),
					'wdn_load_more_option'     => et_builder_i18n( '(Load More) Button Options' ),
					'wdn_follow_button_option'     => et_builder_i18n( '(Follow) Button Options' ),
					'wdn_auto_load_more_option'     => et_builder_i18n( 'Auto Load More on Scroll' ),
					'wdn_misc_option'     => et_builder_i18n( 'Misc Options' ),
					'wdn_admin_diagnostics'     => et_builder_i18n( 'Admin Diagnostics' ),
				),
			),
		);
		$this->advanced_fields = array(
			'fonts'          => array(
                'title' => array(
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .c-configurator h2, {$this->main_css_element} .c-configurator h2 span",
                        'important' => 'all',
                    ),
                    'label'        => esc_html__( 'Title', WDSC_TEXT_DOMAIN ),
                ),
				'price' => array(
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .c-configurator .js-model-price, {$this->main_css_element} .c-configurator .js-model-price span",
                        'important' => 'all',
                    ),
                    'label'        => esc_html__( 'Price', WDSC_TEXT_DOMAIN ),
                ),
				'model_heading' => array(
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .c-configurator .js-select .c-configurator__model-title",
                        'important' => 'all',
                    ),
                    'label'        => esc_html__( 'Model Heading', WDSC_TEXT_DOMAIN ),
                ),
				'dropdown_model' => array(
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .c-configurator .js-select select",
                        'important' => 'all',
                    ),
                    'label'        => esc_html__( 'Model Dropdown', WDSC_TEXT_DOMAIN ),
                ),
				'color_heading' => array(
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .c-configurator .js-check .c-configurator__colour-title span",
                        'important' => 'all',
                    ),
                    'label'        => esc_html__( 'Color Heading', WDSC_TEXT_DOMAIN ),
                ),
				'color_name' => array(
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .c-configurator .js-check .js-colour-name .c-configurator__colour-name",
                        'important' => 'all',
                    ),
                    'label'        => esc_html__( 'Color Name', WDSC_TEXT_DOMAIN ),
                ),
				'powertrain_heading' => array(
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .c-configurator .js-select .c-configurator__powertrain-title span",
                        'important' => 'all',
                    ),
                    'label'        => esc_html__( 'Powertrain Heading', WDSC_TEXT_DOMAIN ),
                ),
            ),
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Buttons', WDSC_TEXT_DOMAIN ),
					'css'            => array(
						'main'         => "{$this->main_css_element} .c-configurator__btn",
						'limited_main' => "{$this->main_css_element} .c-configurator__btn",
						'alignment'    => "{$this->main_css_element} .c-configurator__buttons",
					),					
					'box_shadow'     => array(
						'css' => array(
							'main' => '%%order_class%% .c-configurator__btn',
						),
					),
					'margin_padding' => array(
						'css' => array(
							'main'      => "%%order_class%% .c-configurator__btn",
							'important' => 'all',
						),
					),
					'use_alignment'  => true,
				),
			),
			'link_options'   => false,	
			'background' => false,		
		);
    }
    
    public function get_fields() {
        $post_fields = array(
			/*------------------------ wdn_configure_option ---------------------------*/
			'wdfield_feed'                     => array(
				'label'            => esc_html__( 'Feed ID', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => $this->get_feed(),
				'description'      => esc_html__( 'Display list all available "Feeds".', WDSC_TEXT_DOMAIN ),
				'toggle_slug'      => 'wdn_configure_option',
				'default'          => '',
			),	
			'wdfield_type'                     => array(
				'label'            => esc_html__( 'Type', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
											  '' => 'Select',
											  'user' => 'User',
											  'hashtag' => 'Hashtag',
											  'tagged' => 'Tagged',
											  'mixed' => 'Mixed',
										  ),
				'description'      => esc_html__( 'Display photos from a connected User Account(user), a Hashtag (hashtag), a connected User Account (tagged) and a mix of feed types (mixed).', WDSC_TEXT_DOMAIN ),
				'toggle_slug'      => 'wdn_configure_option',
				'default'          => '',
			),
			'wdfield_user'                => array(
				'label'            => esc_html__( 'User', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Your Instagram user name for the account. This must be a user name from one of your connected accounts.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_configure_option',
				'option_category'  => 'configuration',
				//'show_if' => array('wdfield_type' => 'user')
			),	
			'wdfield_hashtag'                => array(
				'label'            => esc_html__( 'Hashtag', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Any hashtag. Separate multiple hashtags with commas.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_configure_option',
				'option_category'  => 'configuration',
				//'show_if' => array('wdfield_type' => 'hashtag')
			),	
			'wdfield_tagged'                => array(
				'label'            => esc_html__( 'Tagged', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Your business Instagram user name for the account. This must be a user name from one of your connected business accounts.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_configure_option',
				'option_category'  => 'configuration',
				//'show_if' => array('wdfield_type' => 'tagged')
			),
			'wdfield_order'                     => array(
				'label'            => esc_html__( 'Order By', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'' => 'Select',
					'top' => 'Top',
					'recent' => 'Recent',
				),
				'description'      => esc_html__( 'The order to display the Hashtag feed posts.', WDSC_TEXT_DOMAIN ),
				'toggle_slug'      => 'wdn_configure_option',
				'default'          => '',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_customize_option ---------------------------*/	
			'wdfield_width'                => array(
				'label'            => esc_html__( 'Width', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The width of your feed. Any number.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_customize_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_widthunit'                => array(
				'label'            => esc_html__( 'Width unit', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The unit of the width. 'px' or '%'", WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_customize_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_height'                => array(
				'label'            => esc_html__( 'Height', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The height of your feed. Any number.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_customize_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_heightunit'                => array(
				'label'            => esc_html__( 'Height unit', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The unit of the height. 'px' or '%'", WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_customize_option',
				'option_category'  => 'configuration',
			),
			'wdfield_background'                => array(
				'label'            => esc_html__( 'Background', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The background color of the feed. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_customize_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_layout_option ---------------------------*/	
			'wdfield_layout'                => array(
				'label'            => esc_html__( 'Layout', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "How posts are arranged visually in the feed. 'grid', 'carousel', 'masonry', or 'highlight'", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					'' => 'Select',
					'grid' => 'Grid',
					'carousel' => 'Carousel',
					'masonry' => 'Masonry',
					'highlight' => 'Highlight',
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_layout_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_num'                => array(
				'label'            => esc_html__( 'Number of photos', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The number of photos to display initially. Maximum is 33.", WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_layout_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_nummobile'                => array(
				'label'            => esc_html__( 'Number of photos for mobile', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The number of photos to display initially for mobile screens (smaller than 480 pixels).', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_layout_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_cols'                => array(
				'label'            => esc_html__( 'Number of columns', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The number of columns in your feed. 1 - 10.", WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_layout_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_colsmobile'                => array(
				'label'            => esc_html__( 'Number of columns for mobile', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The number of columns in your feed for mobile screens (smaller than 480 pixels).", WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_layout_option',
				'option_category'  => 'configuration',
			),
			'wdfield_imagepadding'                => array(
				'label'            => esc_html__( 'Photos padding', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The spacing around your photos', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_layout_option',
				'option_category'  => 'configuration',
			),
			'wdfield_imagepaddingunit'               => array(
				'label'            => esc_html__( 'Photos padding', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The unit of the padding. 'px' or '%'", WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_layout_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_carousel_option ---------------------------*/	
			'wdfield_carouselrows'                => array(
				'label'            => esc_html__( 'Choose rows', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Choose 1 or 2 rows of posts in the carousel", WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_carousel_option',
				'option_category'  => 'configuration',
			),
			'wdfield_carouselloop'                => array(
				'label'            => esc_html__( 'Infinitely loop', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Infinitely loop through posts or rewind.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					'' => 'Select',
					'loop' => 'Loop',
					'rewind' => 'Rewind',
				),
				'toggle_slug'      => 'wdn_carousel_option',
				'option_category'  => 'configuration',
			),
			'wdfield_carouselarrows'                => array(
				'label'            => esc_html__( 'Directional arrows', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Display directional arrows on the carousel.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_carousel_option',
				'option_category'  => 'configuration',
			),
			'wdfield_carouselpag'                => array(
				'label'            => esc_html__( 'Pagination links', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Display pagination links below the carousel.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_carousel_option',
				'option_category'  => 'configuration',
			),
			'wdfield_carouselautoplay'                => array(
				'label'            => esc_html__( 'Autoplay', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Make the carousel autoplay.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_carousel_option',
				'option_category'  => 'configuration',
			),
			'wdfield_carouseltime'                => array(
				'label'            => esc_html__( 'Interval time', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The interval time between slides for autoplay. Time in miliseconds.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_carousel_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/	
			/*------------------------ wdn_highligh_option ---------------------------*/	
			'wdfield_highlighttype'                => array(
				'label'            => esc_html__( 'Highlight type', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Choose from 3 different ways of highlighting posts. 'pattern', 'hashtag', 'id'.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
											  ''  => 'Select',
											  'pattern' => 'Pattern',
											  'hashtag' => 'Hashtag',
											  'id' => 'ID',
										  ),
				'default'          => '',
				'toggle_slug'      => 'wdn_highligh_option',
				'option_category'  => 'configuration',
			),
			'wdfield_highlightpattern'                => array(
				'label'            => esc_html__( 'Highlight pattern', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'How often a post is highlighted.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_highligh_option',
				'option_category'  => 'configuration',
			),
			'wdfield_highlightoffset'                => array(
				'label'            => esc_html__( 'Highlight offset', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'When to start the highlight pattern.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_highligh_option',
				'option_category'  => 'configuration',
			),
			'wdfield_highlighthashtag'                => array(
				'label'            => esc_html__( 'Highlight hashtags', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Highlight posts with these hashtags.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_highligh_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_photos_option ---------------------------*/
			'wdfield_sortby'                     => array(
				'label'            => esc_html__( 'Sort by', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
											  ''  => 'Select',
											  'none' => 'None',
											  'random' => 'Random',
											  'likes' => 'Likes',
										  ),
				'description'      => esc_html__( 'Sort the posts by Newest to Oldest (none) Random (random) or Likes (likes)', WDSC_TEXT_DOMAIN ),
				'toggle_slug'      => 'wdn_photos_option',
				'default'          => '',
			),	
			'wdfield_imageres'                => array(
				'label'            => esc_html__( 'Resolution/size', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The resolution/size of the photos. 'auto', full', or 'medium.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
											  ''  => 'Select',
											  'auto' => 'Auto',
											  'full' => 'Full',
											  'medium' => 'Medium',
										  ),
				'default'          => '',
				'toggle_slug'      => 'wdn_photos_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_media'                => array(
				'label'            => esc_html__( 'Media', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Display all media, only photos, or only videos.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
											  ''  => 'Select',
											  'photos' => 'Photos',
											  'videos' => 'Videos',
										  ),
				'default'          => '',
				'toggle_slug'      => 'wdn_photos_option',
				'option_category'  => 'configuration',
			),		
			'wdfield_videotypes'                => array(
				'label'            => esc_html__( 'Video types', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "When showing only videos, what types to include 'igtv', 'regular' or 'igtv,regular'.", WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_photos_option',
				'option_category'  => 'configuration',
			),
			'wdfield_disablelightbox'                => array(
				'label'            => esc_html__( 'Lightbox', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Whether to disable the photo Lightbox. It is enabled by default.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_photos_option',
				'option_category'  => 'configuration',
			),
			'wdfield_captionlinks'                     => array(
				'label'            => esc_html__( 'Captions link', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether to use urls in captions for the photo's link instead of linking to instagram.com.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_photos_option',
				'option_category'  => 'configuration',
			),
			'wdfield_offset'                     => array(
				'label'            => esc_html__( 'Offset', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Offset which post is displayed first in the feed.", WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'toggle_slug'      => 'wdn_photos_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_comments_option ---------------------------*/	
			'wdfield_lightboxcomments'                => array(
				'label'            => esc_html__( 'Show comments lightbox', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether to show comments in the lightbox for this feed.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
											  ''  => et_builder_i18n( 'Select' ),
											  'true'  => et_builder_i18n( 'True' ),
											  'false' => et_builder_i18n( 'False' ),
										  ),
				'default'          => '',
				'toggle_slug'      => 'wdn_comments_option',
				'option_category'  => 'configuration',
			),
			'wdfield_numcomments'                => array(
				'label'            => esc_html__( 'Number of comments', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Number of comments to show starting from the most recent.', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_comments_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_photos_hover_option ---------------------------*/	
			'wdfield_hovercolor'                => array(
				'label'            => esc_html__( 'Hover background', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The background color when hovering over a photo. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_photos_hover_option',
				'option_category'  => 'configuration',
			),
			
			'wdfield_hovertextcolor'                => array(
				'label'            => esc_html__( 'Hover text/icon color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The text/icon color when hovering over a photo. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_photos_hover_option',
				'option_category'  => 'configuration',
			),
			'wdfield_hoverdisplay'                => array(
				'label'            => esc_html__( 'Hover display', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "The info to display when hovering over the photo. Available options:
username, date, instagram, caption, likes", WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_photos_hover_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_header_option ---------------------------*/	
			'wdfield_showheader'            => array(
				'label'            => esc_html__( 'Show feed header', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether to show the feed Header. 'true' or 'false'.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_headerstyle'                     => array(
				'label'            => esc_html__( 'Header style', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Which header style to use. Choose from standard, boxed, or centered.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'' => 'Select',
					'standard' => 'Standard',
					'boxed' => 'Boxed',
					'centered' => 'Centered',
				),
				'toggle_slug'      => 'wdn_header_option',
				'default'          => '',
			),
			'wdfield_headersize'                     => array(
				'label'            => esc_html__( 'Header size', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Size of the header. Choose from small, medium, or large.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'' => 'Select',
					'small' => 'Small',
					'medium' => 'Medium',
					'large' => 'Large',
				),
				'toggle_slug'      => 'wdn_header_option',
				'default'          => '',
			),
			'wdfield_headerprimarycolor'   => array(
				'label'            => esc_html__( 'Header primary color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The primary color to use for the boxed header. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_headersecondarycolor'   => array(
				'label'            => esc_html__( 'Header secondary color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The secondary color to use for the boxed header. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_showfollowers'            => array(
				'label'            => esc_html__( 'Show followers', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Display the number of followers in the header.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_showbio'            => array(
				'label'            => esc_html__( 'Show bio', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Display the bio in the header.', WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_custombio'                => array(
				'label'            => esc_html__( 'Custom bio', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Display a custom bio in the header.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_customavatar' => array(
				'label'              => esc_html__( 'Custom avatar', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Display a custom avatar in the header. Enter the full URL of an image file.', WDSC_TEXT_DOMAIN ),
				'type'               => 'upload',
				'upload_button_text' => esc_attr__( 'Upload avatar', WDSC_TEXT_DOMAIN ),
				'choose_text'        => esc_attr__( 'Choose avatar', WDSC_TEXT_DOMAIN ),
				'update_text'        => esc_attr__( 'Set As Image', WDSC_TEXT_DOMAIN ),
				'toggle_slug'        => 'wdn_header_option',
			),
			'wdfield_headercolor'   => array(
				'label'            => esc_html__( 'Header text color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The color of the Header text. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_stories'            => array(
				'label'            => esc_html__( 'Include Instagram story', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Include the user's Instagram story in the header if available.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			'wdfield_storiestime'                => array(
				'label'            => esc_html__( 'Slide display time', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Length of time an image slide will display when viewing stories.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_header_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_caption_option ---------------------------*/	
			'wdfield_showcaption'            => array(
				'label'            => esc_html__( 'Show caption', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether to show the photo caption. 'true' or 'false'.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_caption_option',
				'option_category'  => 'configuration',
			),
			'wdfield_captionlength'                => array(
				'label'            => esc_html__( 'Caption length', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The number of characters of the caption to display.', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_caption_option',
				'option_category'  => 'configuration',
			),
			'wdfield_captioncolor'   => array(
				'label'            => esc_html__( 'Caption text color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The text color of the caption. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_caption_option',
				'option_category'  => 'configuration',
			),
			'wdfield_captionsize'                => array(
				'label'            => esc_html__( 'Caption size', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The size of the caption text. Any number.', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_caption_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_likes_comments_option ---------------------------*/	
			'wdfield_showlikes'            => array(
				'label'            => esc_html__( 'Show Likes & Comments', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether to show the Likes & Comments. 'true' or 'false'.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_likes_comments_option',
				'option_category'  => 'configuration',
			),
			'wdfield_likescolor'   => array(
				'label'            => esc_html__( 'Likes & comments text color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The color of the Likes & Comments. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_likes_comments_option',
				'option_category'  => 'configuration',
			),
			'wdfield_likessize'                => array(
				'label'            => esc_html__( 'Size of likes & comments', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The size of the Likes & Comments. Any number.', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_likes_comments_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_load_more_option ---------------------------*/	
			'wdfield_showbutton'            => array(
				'label'            => esc_html__( "Show 'Load More' button", WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether to show the 'Load More' button. 'true' or 'false'.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_load_more_option',
				'option_category'  => 'configuration',
			),
			'wdfield_buttoncolor'   => array(
				'label'            => esc_html__( 'Button background color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The background color of the button. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_load_more_option',
				'option_category'  => 'configuration',
			),
			'wdfield_buttontextcolor'   => array(
				'label'            => esc_html__( 'Button text color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The text color of the button. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_load_more_option',
				'option_category'  => 'configuration',
			),
			'wdfield_buttontext'                => array(
				'label'            => esc_html__( 'Button text', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The text used for the button.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_load_more_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_follow_button_option ---------------------------*/	
			'wdfield_showfollow'            => array(
				'label'            => esc_html__( "Show 'Follow' button", WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether to show the Instagram 'Follow' button. 'true' or 'false'.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_follow_button_option',
				'option_category'  => 'configuration',
			),
			'wdfield_followcolor'   => array(
				'label'            => esc_html__( 'Button background color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The background color of the button. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_follow_button_option',
				'option_category'  => 'configuration',
			),
			'wdfield_followtextcolor'   => array(
				'label'            => esc_html__( 'Button text color', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The text color of the button. Any hex color code.', WDSC_TEXT_DOMAIN ),
				'type'             => 'color',
				'toggle_slug'      => 'wdn_follow_button_option',
				'option_category'  => 'configuration',
			),
			'wdfield_followtext'                => array(
				'label'            => esc_html__( 'Button text', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'The text used for the button.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_follow_button_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_auto_load_more_option ---------------------------*/	
			'wdfield_autoscroll'            => array(
				'label'            => esc_html__( "Load more", WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Load more posts automatically as the user scrolls down the page.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_auto_load_more_option',
				'option_category'  => 'configuration',
			),
			'wdfield_autoscrolldistance'   => array(
				'label'            => esc_html__( 'Auto scroll distance', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Distance before the end of feed or page that triggers the loading of more posts.', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_auto_load_more_option',
				'option_category'  => 'configuration',
			),
			'wdfield_excludewords'   => array(
				'label'            => esc_html__( 'Exclude words', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Remove posts which contain certain words or hashtags in the caption.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_auto_load_more_option',
				'option_category'  => 'configuration',
			),
			'wdfield_includewords'   => array(
				'label'            => esc_html__( 'Include words', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Only display posts which contain certain words or hashtags in the caption.', WDSC_TEXT_DOMAIN ),
				'type'             => 'text',
				'default'          => '',
				'toggle_slug'      => 'wdn_auto_load_more_option',
				'option_category'  => 'configuration',
			),
			'wdfield_whitelist'                => array(
				'label'            => esc_html__( 'White list', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Only display posts that match one of the post ids in this "whitelist"', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_auto_load_more_option',
				'option_category'  => 'configuration',
			),
			/*------------- End ----------------*/
			/*------------------------ wdn_misc_option ---------------------------*/	
			'wdfield_permanent'            => array(
				'label'            => esc_html__( "Permanent", WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Feed will never look for new posts from Instagram.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_misc_option',
				'option_category'  => 'configuration',
			),
			'wdfield_maxrequests'   => array(
				'label'            => esc_html__( 'Max requests', WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( 'Change the number of maximum concurrent API requests.', WDSC_TEXT_DOMAIN ),
				'type'             => 'number',
				'default'          => '',
				'toggle_slug'      => 'wdn_misc_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_customtemplate'            => array(
				'label'            => esc_html__( "Custom template", WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "Whether or not the plugin should look in your theme for a custom template.
Do not enable unless there are templates added to your theme's folder.", WDSC_TEXT_DOMAIN ),
				'type'             => 'select',
				'options'          => array(
					''  => et_builder_i18n( 'Select' ),
					'true'  => et_builder_i18n( 'True' ),
					'false' => et_builder_i18n( 'False' ),
				),
				'default'          => '',
				'toggle_slug'      => 'wdn_misc_option',
				'option_category'  => 'configuration',
			),	
			'wdfield_diagnostics'            => array(
				'label'            => esc_html__( "Display Shortcode Instead of Module", WDSC_TEXT_DOMAIN ),
				'description'      => esc_html__( "If enabled, this module will be DISABLED from 
rendering and only the shortcode will be displayed.", WDSC_TEXT_DOMAIN ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => esc_html( 'Yes', WDSC_TEXT_DOMAIN ),
					'off' => esc_html( 'No', WDSC_TEXT_DOMAIN ),
				),
				'toggle_slug'      => 'wdn_admin_diagnostics',
				'option_category'  => 'basic_option',
			),
			/*------------- End ----------------*/
		);
		/*------------- End ----------------*/
        $post_fields_paid = array();
        $post_fields = array_merge( $post_fields, $post_fields_paid );
        return $post_fields;
    }
    
    public function get_feed() {
		//$exported_feeds = \InstagramFeed\Builder\SBI_Db::feeds_query();
		$output  = array();
		$output[' '] = 'Legacy Feed (no Feed ID)';
		if (class_exists('\InstagramFeed\Builder\SBI_Db')){
			$exported_feeds = \InstagramFeed\Builder\SBI_Db::feeds_query();
			foreach ( $exported_feeds as $feed_id => $feed ) {
				$settings = json_decode($feed['settings'], true);
				$id = $feed['id'];
				$value= '#'.$id.' ('.ucwords($settings['type']).') '.$feed['feed_name'];
				$output[$id.'_extra'] = $value;
			}
		}
		return $output;
	}
    
    public function render( $attrs, $content = null, $render_slug ) {
		$fields = '';
		$diagnostics = $this->props['wdfield_diagnostics'];
		unset($this->props['wdfield_diagnostics']);
		foreach($this->props as $key=>$value){
			if (strpos($key, 'wdfield_') !== false && $value != 'undefined') {
				$val = str_replace("_extra", "", $value); 
				$fields .= empty($val) ? '' : ' '.str_replace("wdfield_", "", $key).'="'.$val.'"';
			}
		}
		$output = ($diagnostics == 'off') ? do_shortcode('[instagram-feed'.$fields.']') : '[instagram-feed'.$fields.']';
		return $output;
	}

}
new WD_shortcodeViewModule();
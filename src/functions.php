<?php
/**
 * auaha functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package auaha
 */

 define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
 define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );

if ( ! function_exists( 'auaha_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function auaha_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on auaha, use a find and replace
	 * to change 'auaha' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'auaha', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'auaha' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'auaha_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'auaha_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function auaha_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'auaha_content_width', 640 );
}
add_action( 'after_setup_theme', 'auaha_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function auaha_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'auaha' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'auaha' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'auaha_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function auaha_scripts() {
	wp_enqueue_style( 'auaha-style', get_stylesheet_uri() );
	//
	// wp_enqueue_script( 'auaha-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	// //
	// // wp_enqueue_script( 'auaha-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'auaha_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


//Modificar los campos Autor, Email y Sitio web del formulario de comentarios
function apk_modify_comment_fields( $fields ) {

    //Variables necesarias para que esto funcione
    $commenter = wp_get_current_commenter();
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields =  array(
        'name' =>
            '<input id="author" name="author" type="text" value="" size="30"' . $aria_req . ' placeholder="' . __('Nome', 'apk') . '" />',
		'email' =>
			'<input id="email" name="email" type="text" value="" size="30"' . $aria_req . ' placeholder="' . __('E-mail', 'apk') . '" />',
        'message' =>
            '<textarea id="comment1" name="comment" cols="45" rows="5" maxlength="65525"'. $aria_req . ' placeholder="' . __('Escreva seu comentário...', 'apk') . '"></textarea>',
    );

    return $fields;

}
add_filter('comment_form_default_fields', 'apk_modify_comment_fields');

function lkz_info_extra($customizer) {
   
   $customizer->add_setting('telefone',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_telefone',
       array(
           'label'     => 'Telefone',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'telefone'
       )
   );

   $customizer->add_setting('telefone2',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_telefone2',
       array(
           'label'     => 'Telefone 2',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'telefone2'
       )
   );
   
   $customizer->add_setting('facebook',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_facebook',
       array(
           'label'     => 'Facebook',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'facebook'
       )
   );

   $customizer->add_setting('instagram',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_instagram',
       array(
           'label'     => 'Instagram',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'instagram'
       )
   );

   $customizer->add_setting('youtube',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_youtube',
       array(
           'label'     => 'Youtube',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'youtube'
       )
   );

   $customizer->add_setting('email',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_email',
       array(
           'label'     => 'E-mail',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'email'
       )
   );


   $customizer->add_setting('diferencial',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_diferencial',
       array(
           'label'     => 'Nosso Diferencial',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'diferencial'
       )
   );

   $customizer->add_setting('visao',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_visao',
       array(
           'label'     => 'Visão',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'visao'
       )
   );

   $customizer->add_setting('missao',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_missao',
       array(
           'label'     => 'Missão',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'missao'
       )
   );

   $customizer->add_setting('copyright',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_copyright',
       array(
           'label'     => 'Copyright',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'copyright'
       )
   );
}

add_action( 'customize_register', 'lkz_info_extra' );

function wordpress_pagination() {
	global $wp_query;

	$big = 999999999;

	echo paginate_links( array(
		  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		  'format' => '?paged=%#%',
		  'current' => max( 1, get_query_var('paged') ),
		  'total' => $wp_query->max_num_pages
	) );
}

add_action( 'init', 'create_post_type_fullbanner' );
function create_post_type_fullbanner() {
    register_post_type( 'fullbanner',
        array(
            'labels' => array(
                'name' => __( 'Fullbanner' ),
                'singular_name' => __( 'fullbanner' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail')
        )
    );
}

add_action( 'init', 'create_post_type_detalhes' );
function create_post_type_detalhes() {
    register_post_type( 'detalhes',
        array(
            'labels' => array(
                'name' => __( 'Detalhes' ),
                'singular_name' => __( 'detalhes' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail')
        )
    );
}

add_action( 'init', 'create_post_type_equipe' );
function create_post_type_equipe() {
    register_post_type( 'equipe',
        array(
            'labels' => array(
                'name' => __( 'Equipe' ),
                'singular_name' => __( 'equipe' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail', 'excerpt', 'editor')
        )
    );
}

add_action( 'init', 'create_post_type_parceiros' );
function create_post_type_parceiros() {
    register_post_type( 'parceiros',
        array(
            'labels' => array(
                'name' => __( 'Parceiros' ),
                'singular_name' => __( 'parceiros' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail')
        )
    );
}

add_action( 'init', 'create_post_type_servicos' );
function create_post_type_servicos() {
    register_post_type( 'servicos',
        array(
            'labels' => array(
                'name' => __( 'Servicos' ),
                'singular_name' => __( 'servicos' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail')
        )
    );
}

add_action( 'init', 'create_post_type_certificados' );
function create_post_type_certificados() {
    register_post_type( 'certificados',
        array(
            'labels' => array(
                'name' => __( 'Certificados' ),
                'singular_name' => __( 'certificados' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail', 'editor')
        )
    );
}

add_action( 'init', 'create_post_type_depoimentos' );
function create_post_type_depoimentos() {
    register_post_type( 'depoimentos',
        array(
            'labels' => array(
                'name' => __( 'Depoimentos' ),
                'singular_name' => __( 'depoimentos' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail', 'excerpt', 'editor')
        )
    );
}

add_action( 'init', 'create_post_type_portfolio');
function create_post_type_portfolio() {
    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name' => __( 'Portfólios' ),
                'singular_name' => __( 'portfolio' )
            ),
            'public' => true,
			'supports'  => array('title', 'thumbnail')
        )
    );
}

function create_taxonomy_portfolio_category() {
    register_taxonomy( 'portfolio-category', array( 'portfolio' ), array(
        'hierarchical' => true,
        'label' => __( 'Categoria de portfólios '),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => true,
        )
    );
}
add_action( 'init', 'create_taxonomy_portfolio_category' );


add_action( 'init', 'create_post_type_projetos');
function create_post_type_projetos() {
    register_post_type( 'projetos',
        array(
            'labels' => array(
                'name' => __( 'Projetos' ),
                'singular_name' => __( 'projetos' )
            ),
            'public' => true,
			'supports'  => array('title', 'thumbnail')
        )
    );
}

function create_taxonomy_projetos_category() {
    register_taxonomy( 'projetos-category', array( 'projetos' ), array(
        'hierarchical' => true,
        'label' => __( 'Categoria de Projetos '),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => true,
        )
    );
}
add_action( 'init', 'create_taxonomy_projetos_category' );
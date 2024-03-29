<?php
/**
 * chipicasa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chipicasa
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function chipicasa_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on chipicasa, use a find and replace
		* to change 'chipicasa' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'chipicasa', get_template_directory() . '/languages' );

	// Add default posts links to head.
	add_theme_support( 'automatic-feed-links' );
	
	
	add_theme_support( 'align-wide' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'chipicasa' ),
		)
	);

	/*
		* Switch default core markup for search form
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'chipicasa_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 50,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'chipicasa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chipicasa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'chipicasa_content_width', 640 );
}
add_action( 'after_setup_theme', 'chipicasa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function chipicasa_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'chipicasa' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'chipicasa' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
        array(
            'name'          => esc_html__( 'Footer', 'chipicasa' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add footer widgets here.', 'chipicasa' ),
            'before_widget' => '<ul class="list-inline"><li class="list-inline-item" id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li></ul>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'chipicasa_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function chipicasa_scripts() {
	wp_enqueue_style( 'chipicasa-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'chipicasa-style', 'rtl', 'replace' );

	wp_enqueue_script( 'chipicasa-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//added for template

    // Enqueue Libraries CSS.
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/lib/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/lib/animate/animate.min.css' );
    wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/lib/ionicons/css/ionicons.min.css' );
    wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/lib/owlcarousel/assets/owl.carousel.min.css' );
    // Enqueue Main Stylesheet.
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/style.css' );
	//Enqueue JavaScript Libraries.
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/lib/jquery/jquery.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'chipicasa-navigation', get_template_directory_uri() . '/lib/jquery/jquery-migrate.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/lib/popper/popper.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/lib/bootstrap/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/lib/easing/easing.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'scrollreveal', get_template_directory_uri() . '/lib/scrollreveal/scrollreveal.min.js', array(), _S_VERSION, true );
	// Template Main Javascript .
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'chipicasa_scripts' );


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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Menu Bootstrap into WordPress.
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


/**
 * @snippet      Custom Login 
 * @author       https://codex.wordpress.org/Customizing_the_Login_Form
 */
function chipicasa_login_logo() { 
	$custom_logo_html = get_custom_logo();
	preg_match('/src="([^"]*)"/i', $custom_logo_html, $matches);
	$logo_url = $matches[1];
	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url('<?php echo $logo_url; ?>');
			width: 100%;
			background-size: contain;
			background-repeat: no-repeat;
		}
		.login form{
			background-color: #fff;
			border: 0;
		}
		.login{
			background:  #fff;;
		}
		.language-switcher,
		.privacy-policy-page-link,
		#nav,
		#backtoblog{
			display:none
		}
	</style>
<?php
}
add_action( 'login_enqueue_scripts', 'chipicasa_login_logo' );
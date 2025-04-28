<?php
/**
 * openhouse functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package openhouse
 */

if ( ! defined( 'OPENHOUSE_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'OPENHOUSE_VERSION', '0.1.0' );
}

if ( ! defined( 'OPENHOUSE_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `openhouse_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'OPENHOUSE_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'openhouse_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function openhouse_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on openhouse, use a find and replace
		 * to change 'openhouse' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'openhouse', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'openhouse' ),
				'menu-2' => __( 'Footer Menu', 'openhouse' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'openhouse_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function openhouse_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'openhouse' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openhouse' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'openhouse_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function openhouse_scripts() {
	wp_enqueue_style( 'openhouse-style', get_stylesheet_uri(), array(), OPENHOUSE_VERSION );
	wp_enqueue_script( 'openhouse-script', get_template_directory_uri() . '/js/script.min.js', array(), OPENHOUSE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'openhouse_scripts' );

/**
 * Enqueue the block editor script.
 */
function openhouse_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'openhouse-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			OPENHOUSE_VERSION,
			true
		);
		wp_add_inline_script( 'openhouse-editor', "tailwindTypographyClasses = '" . esc_attr( OPENHOUSE_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'openhouse_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function openhouse_tinymce_add_class( $settings ) {
	$settings['body_class'] = OPENHOUSE_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'openhouse_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Redirige las URLs de uploads locales a producción
 */
// function redirigir_uploads_a_produccion($url) {
//     // Reemplaza la URL local con la URL de producción
//     return str_replace('https://open-house.local/wp-content/uploads', 'https://open-house.com.co/wp-content/uploads', $url);
// }

// // Aplica el filtro a las URLs de archivos adjuntos
// add_filter('wp_get_attachment_url', 'redirigir_uploads_a_produccion');

// // Aplica el filtro a las URLs de miniaturas y otros tamaños de imagen
// add_filter('wp_calculate_image_srcset', function($sources) {
//     foreach ($sources as &$source) {
//         $source['url'] = redirigir_uploads_a_produccion($source['url']);
//     }
//     return $sources;
// });

// // Para elementos insertados en el contenido
// add_filter('the_content', function($content) {
//     return str_replace('https://open-house.local/wp-content/uploads', 'https://open-house.com.co/wp-content/uploads', $content);
// });

// // Para CSS inline
// add_filter('style_loader_src', 'redirigir_uploads_a_produccion');

// // Para imágenes de fondo en CSS
// add_filter('wp_get_attachment_image_src', function($image) {
//     if (is_array($image)) {
//         $image[0] = redirigir_uploads_a_produccion($image[0]);
//     }
//     return $image;
// });

/**
 * Disable Gutenberg editor and restore classic editor
 */
function disable_gutenberg() {
    // Disable Gutenberg editor for posts and pages
    add_filter('use_block_editor_for_post', '__return_false', 10);
    add_filter('use_block_editor_for_post_type', '__return_false', 10);
    
    // Disable Gutenberg for widgets
    add_filter('use_widgets_block_editor', '__return_false');
    
    // Remove Gutenberg block library CSS from loading on the frontend
    add_action('wp_enqueue_scripts', function() {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS if using WooCommerce
    }, 100);
}
add_action('init', 'disable_gutenberg');


function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('currency-js', get_template_directory_uri() . '/js/currency.js', array('jquery'), OPENHOUSE_VERSION, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_alpine_script() {
    wp_enqueue_script('alpine-js', get_template_directory_uri() . '/inc/alpine/alpine.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_alpine_script');


function enqueue_lightbox_assets() {
    wp_enqueue_style('lightbox-css', get_template_directory_uri() . '/inc/lightbox/css/lightbox.min.css');
    wp_enqueue_script('lightbox-js', get_template_directory_uri() . '/inc/lightbox/js/lightbox.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_assets');


// En functions.php o donde enqueues tus scripts
function enqueue_splide_scripts() {
    wp_enqueue_style('splide-css', get_template_directory_uri() . '/inc/splide/dist/css/splide.min.css');
    wp_enqueue_script('splide-js', get_template_directory_uri() . '/inc/splide/dist/js/splide.min.js', array(), null, true);
    wp_enqueue_script('splide-grid-js', get_template_directory_uri() . '/inc/splide/dist/js/splide-extension-grid.min.js', array('splide-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_splide_scripts');


/**
 * Enable SVG and WebP upload support
 */
function enable_extended_upload( $mime_types = array() ) {
    // Add SVG and WebP support
    $mime_types['svg']  = 'image/svg+xml';
    $mime_types['svgz'] = 'image/svg+xml';
    $mime_types['webp'] = 'image/webp';
    
    return $mime_types;
}
add_filter( 'upload_mimes', 'enable_extended_upload' );

// Fix SVG upload issues
function fix_svg_upload_class( $response, $attachment, $meta ) {
    if ( $response['type'] === 'image' && $response['subtype'] === 'svg+xml' ) {
        $response['sizes'] = array(
            'full' => array(
                'url'         => $response['url'],
                'width'       => $response['width'],
                'height'      => $response['height'],
                'orientation' => $response['orientation']
            )
        );
    }
    
    return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'fix_svg_upload_class', 10, 3 );
<?php
/**
 * actualPsi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package actualPsi
 */

if ( ! defined( '_S_VERSION' ) ) {
	
	define( '_S_VERSION', '1.1.0' );
}

function actualPsi_setup(){

    // Agrega publicaciones, comentarios y fuentes RSS predeterminados al encabezado Head.
    add_theme_support( 'automatic-feed-links' );

    //imagenes destacadas
    add_theme_support('post-thumbnails');

    //definición del tamaño de las imagenes
    add_image_size( 'large', 762, '', true);
    add_image_size( 'excerpt', 300, 200, true); 
    add_image_size( 'medium', 250, '', true);
    add_image_size( 'thumbnail', 150, 150, true); 
    add_image_size( 'small', 120, '', true);
}
add_action('after_setup_theme', 'actualPsi_setup');

/** Agregar CSS Y JS del THEME**/

function actualPsi_styles() {
// agregar hojas de estilos
    wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.1.0');
    wp_enqueue_style('googlefonts', 'https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;600&family=Open+Sans:wght@700&display=swap', array(), '1.0.0');

// Scripts
wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0',  true);
}
add_action('wp_enqueue_scripts', 'actualPsi_styles');

/**  agregar menús **/
function actualPsi_menus() {
    register_nav_menus(array(
        'header-menu' => 'Menu superior',
        'footer-menu' => 'Menu inferior'
    ));
}
add_action('init', 'actualPsi_menus');

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'actualPsi'),
        'description' => __('Descripción para esta área widget...', 'actualPsi'),
        'id' => 'widget-area-1',
        'before_widget' => '<section id="%1$s" class="%2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Descripción para esta área widget...', 'actualPsi'),
        'id' => 'widget-area-2',
        'before_widget' => '<section id="%1$s" class="%2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
}
// Limita el tamaño de los extratos de contenido

function excerpt($num) {
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."...";
    echo $excerpt;
}
 
function content($num) {
    $theContent = get_the_content();
    $output = preg_replace('/<img[^>]+./','', $theContent);
    $limit = $num+1;
    $content = explode(' ', $output, $limit);
    array_pop($content);
    $content = implode(" ",$content)."...";
    echo $content;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function actualPsi_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Create 20 Word Callback for Index page Excerpts, call using actualPsi_excerpt('actualPsi_index');
function actualPsi_index($length) {
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function actualPsi_custom_post($length) {
    return 40;
}

// Create the Custom Excerpts callback
function actualPsi_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom Gravatar in Settings > Discussion
function actualPsigravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';  /* atención busca y poner imagen gravatar */
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


// Custom Comments Callback
function actualPsicomments($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}

?>

    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <?php endif; ?>
        
	<article id="comment-<?php comment_ID() ?>" class="comment-body">	
    
    <div class="author-avatar">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, ); ?>	
	</div>

	<div class="comment-meta commentmetadata">
        <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Su comentario ha sido enviado correctamente, espere que sea aprobado.') ?></em>
        <br />
        <?php endif; ?>
       <div class="comment-author">
       <?php printf(__('<cite class="fn">%s</cite> <span class="says">dice:</span>'), get_comment_author_link()) ?>
       </div>
       <div class="comment-time">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                <time><?php printf( __('%1$s a las %2$s'), get_comment_date(),  get_comment_time()) ?></a><time>
                <?php edit_comment_link(__('(Edit)'),'  ','' ); ?>
        </div>

        <div class="comment-text user">
            <?php comment_text() ?>
        </div>	

        <div class="reply">
        <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    </article>
	<?php endif; ?>
<?php }

//  CUSTOM TEMPLATE CATEGORY
function custom_single_template($the_template) {
    foreach ( (array) get_the_category() as $cat ) {
        if ( locate_template("single-{$cat->slug}.php") ) {
            return locate_template("single-{$cat->slug}.php");
        }
    }
    return $the_template;
}
add_filter( 'single_template', 'custom_single_template');


?>



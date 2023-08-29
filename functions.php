<?php
/**
 * wandercrm functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wandercrm
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
function wandercrm_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wandercrm, use a find and replace
		* to change 'wandercrm' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wandercrm', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wandercrm' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wandercrm_custom_background_args',
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
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wandercrm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wandercrm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wandercrm_content_width', 640 );
}
add_action( 'after_setup_theme', 'wandercrm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wandercrm_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wandercrm' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wandercrm' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wandercrm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wandercrm_scripts() {
	wp_enqueue_style( 'wandercrm-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('wandercrm-demo', get_template_directory_uri() . '/assets/style/demo.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-core', get_template_directory_uri() . '/assets/style/core.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-page-auth', get_template_directory_uri() . '/assets/style/page-auth.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-theme-default', get_template_directory_uri() . '/assets/style/theme-default.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-dataTables-bootstrap4-css', 'https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-fonts-boxicons', get_template_directory_uri() . '/fonts/boxicons.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-fonts-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap', array(), _S_VERSION, 'all');
	wp_enqueue_style('wandercrm-fonts-oswald', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap', array(), _S_VERSION, 'all');
	wp_enqueue_style('flatpickr-min-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), _S_VERSION, 'all');

	//wp_style_add_data( 'wandercrm-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wandercrm-jquery-351-js', 'https://code.jquery.com/jquery-3.5.1.js', array(), _S_VERSION, false );

	// Enqueue TinyMCE script
    wp_enqueue_editor();

	wp_enqueue_script( 'wandercrm-jquery-dataTables-min-js', 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array(), _S_VERSION, false );
	wp_enqueue_script( 'wandercrm-dataTables-bootstrap4-js', 'https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js', array(), _S_VERSION, false );
	wp_enqueue_script('flatpickr-datepicker', 'https://cdn.jsdelivr.net/npm/flatpickr', array('jquery'), _S_VERSION, true);
	wp_enqueue_script( 'kit-fontawesome-com', 'https://kit.fontawesome.com/267ba2d474.js', array(), _S_VERSION, false );
	wp_enqueue_script( 'wandercrm-helpers', get_template_directory_uri() . '/assets/js/helpers.js', array(), _S_VERSION, false );
	wp_enqueue_script( 'wandercrm-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'wandercrm-printThis', get_template_directory_uri() . '/assets/js/printThis.js', array(), _S_VERSION, true );
	wp_enqueue_script('jquery-validate-min', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script( 'wandercrm-main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );		
	wp_enqueue_script( 'wandercrm-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), _S_VERSION, true );
	
	

	wp_localize_script( 'wandercrm-main', 'wandercrm',
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		)
	);

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'wandercrm_scripts' );


// function save_custom_form_data() {
//     if (isset( $item['item_description'] )) {
//         $content = $item['item_description'];
//         // Save $content to the database or perform other actions as needed.
//     }
// }
// add_action('init', 'save_custom_form_data');



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

// Login administrator to redirect invoice list page ====================
function custom_login_redirect($redirect_to, $request, $user) {
	
    if (isset($user->roles) && is_array($user->roles) && in_array('administrator', $user->roles)) {
        return home_url('/invoice-list/');
    }

    return $redirect_to;
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);



// Login Function ====================
function wandercrm_login(){

	if( isset( $_POST['wander_login'] ) ){

      if( wp_verify_nonce( $_POST['wander_login'], 'wandercrm_action' ) ){
        $user_mail = $_POST['user_email'];
        $user_pass = $_POST['user_password'];
        // $user_meta = get_user_by('email', $user_mail);
        // $user_login_meta = get_user_meta( $user_meta->data->ID, 'user_login_status' );

        if ( !email_exists($user_mail) ) {
          echo "Email address is not exist";
        }elseif( empty($user_pass) ){
          echo "Password field is empty";
        }else{

          $user = wp_signon( array(
                'user_login' => $user_mail,
                'user_password' => $user_pass,
                'remember' => true
              ), false );

          if( is_wp_error($user) ){
              echo "User is not ACTIVE";
              echo $user->get_error_message();
            }else{
              wp_redirect( home_url('/create-invoice') );
              exit;
            }

        }
      }
    }
}
add_action('init', 'wandercrm_login');

function dd($data){
	echo '<pre>';
	print_r($data);
	exit();
}

function number_to_word($number) {
    // Define an array of words for numbers from 0 to 19
    $words = array(
        '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
        'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
    );

    // Define an array of words for tens from 20 to 90
    $tens = array(
        '', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'
    );

    if ($number < 20) {
        // If the number is less than 20, simply return the corresponding word
        return $words[$number];
    } elseif ($number < 100) {
        // If the number is between 20 and 99, convert it to a word using the tens and units digits
        return $tens[floor($number / 10)] . '-' . $words[$number % 10];
    } else {
        // If the number is 100 or greater, add support for hundreds, thousands, etc.
        // You can customize this part based on your specific requirements
        // This is a basic implementation for demonstration purposes
        $word = '';

        if ($number >= 100000) {
            $word .= number_to_word(floor($number / 100000)) . ' Lakh ';
            $number %= 100000;
        }

        if ($number >= 1000) {
            $word .= number_to_word(floor($number / 1000)) . ' Thousand ';
            $number %= 1000;
        }

        if ($number >= 100) {
            $word .= number_to_word(floor($number / 100)) . ' Hundred ';
            $number %= 100;
        }

        if ($number > 0) {
            $word .= number_to_word($number);
        }

        return $word;
    }
}


//Invoice Modal Ajax ~~~~~~~~~~
function wandercrm_invoice_modal(){
	global $wpdb;
	$invoice_table = $wpdb->prefix . 'invoice';
	$tr_items = '';
	$tableInvoiceItem = $wpdb->prefix . 'invoice_items';
	$invoice_ids = $_POST['invoice_ids'];

	$invoice_details = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $invoice_table WHERE ID=%d", $invoice_ids ), ARRAY_A );

	$invoice_items = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $tableInvoiceItem WHERE invoice_id=%d", $invoice_details['ID'] ), ARRAY_A);
	$total_amount = 0;	
	$tax_amount = 0;

	foreach ($invoice_items as $key => $invoice_item) {

		$sl_no = $key+1;
		$item_description = $invoice_item['item_description'];
		$item_quantity = $invoice_item['item_quantity'];
		$item_rate = $invoice_item['item_rate'];
		$sub_total = $item_quantity * $item_rate;
		$total_amount += (int) $sub_total;


		$tr_items .= "
		<tr class='invoice_desc'>
			<th scope='row'>$sl_no</th>
			<td class='item-desc'>$item_description</td>
			<td class='item-quant'>$item_quantity</td>
			<td class='item-rate'>$item_rate</td>
			<td class='item-amount'>$sub_total</td>
		</tr>";
}

$tax_items = unserialize($invoice_details['invoice_tax']) ;

if(!empty($tax_items)){

	$tax_row = "";

	foreach($tax_items as $tax_item){

		switch($tax_item){

			case 'CGST':

			$gst_tax_amount = (int) $total_amount * 0.025;
				$tax_row .="
			<tr class='cgst-row'><th scope='row'></th><td></td><td width='150px'><strong>Add: CGST</strong></td><td class='gst_rate'>2.5%</td><td class='cgst_tax_amount'>".$gst_tax_amount."</td></tr>";

				break;

			case 'SGST':

			$gst_tax_amount = (int) $total_amount * 0.025;
				$tax_row .="
			<tr class='cgst-row'><th scope='row'></th><td></td><td width='150px'><strong>Add: SGST</strong></td><td class='gst_rate'>2.5%</td><td class='cgst_tax_amount'>".$gst_tax_amount."</td></tr>";

				break;
			case 'IGST':

				$gst_tax_amount = (int) $total_amount * 0.05;
				$tax_row .="
			<tr class='cgst-row'><th scope='row'></th><td></td><td width='150px'><strong>Add: IGST</strong></td><td class='gst_rate'>5%</td><td class='cgst_tax_amount'>".$gst_tax_amount."</td></tr>";

				break;

			case '20TCS':

				$gst_tax_amount = (int) $total_amount * 0.20;
				$tax_row .="
			<tr class='cgst-row'><th scope='row'></th><td></td><td width='150px'><strong>Add: TCS</strong></td><td class='gst_rate'>20%</td><td class='cgst_tax_amount'>".$gst_tax_amount."</td></tr>";				
				
				break;

			case '5TCS':

				$gst_tax_amount = (int) $total_amount * 0.05;
				$tax_row .="
			<tr class='cgst-row'><th scope='row'></th><td></td><td width='150px'><strong>Add: TCS</strong></td><td class='gst_rate'>5%</td><td class='cgst_tax_amount'>".$gst_tax_amount."</td></tr>";				
				
				break;

			default:
				$gst_tax_amount = 0;
				break;

			}

		$tax_amount = $tax_amount + $gst_tax_amount ;

	}
}

	$grand_total = round($total_amount + $tax_amount);
	$invoice_tax_items = unserialize($invoice_details['invoice_tax']);
	$number = $grand_total;
	$invoice_details['number_to_word_total'] = number_to_word($number);

	$tr_items .= "
	<tr class='invoice_desc'>
	    <td scope='row'></th>
	    <td></td>
	    <td width='150px'><strong>Sub Total</strong></td>
	    <td></td>
	    <td class='sub_total'>$total_amount</td>
	  </tr>
	  <tr class='tcs-row'>$tax_row</tr>
	  <tr class='invoice_desc'>
	    <th scope='row'></th>
	    <td></td>
	    <td width='150px'><strong>Total</strong></td>
	    <td></td>
	    <td class='grand-total'>$grand_total</td>
	 </tr>";

	 $invoice_details['table_items_row'] = $tr_items;

	wp_send_json($invoice_details);
}

add_action( 'wp_ajax_get_invoice_data', 'wandercrm_invoice_modal' );
add_action( 'wp_ajax_nopriv_get_invoice_data', 'wandercrm_invoice_modal' );


//Ajax Function for money receipt modal ~~~~~~~~~~
function wandercrm_receipt_modal(){
	global $wpdb;
	$receipt_table = $wpdb->prefix . 'receipt';
	$receipt_id = $_POST['receipt_id'];

	$receipt_details = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $receipt_table WHERE ID=%d", $receipt_id ), ARRAY_A );

	$receipt_details['receipt_amount_in_word'] = number_to_word($receipt_details['amount']);

	wp_send_json($receipt_details);

}
add_action('wp_ajax_get_receipt_data', 'wandercrm_receipt_modal');
add_action('wp_ajax_nopriv_get_receipt_data', 'wandercrm_receipt_modal');


//Function to Create PDF by TCPDF with mail functionality ~~~~~~~~~
function generate_pdf_from_html($html, $mail) {
    require_once get_template_directory() . '/tcpdf/tcpdf.php';

    // Create a new TCPDF instance
    $pdf = new TCPDF();

    // Set PDF margins
    $pdf->SetMargins(10, 10, 10);

    // Add a page
    $pdf->AddPage();

    // Convert the HTML content to PDF
    $pdf->writeHTML($html);

    // Output the PDF inline
    $pdfFile = $pdf->Output('example.pdf', 'S');
	$subject = 'Generated Money receipt';
	$message = 'Please find the attached PDF file.';
	$headers = array('Content-Type: text/html; charset=UTF-8');

	//Generate a random filename for the PDF
	$pdfFilename = 'money_receipt_' . time() . '.pdf';
	$pdfFilePath = WP_CONTENT_DIR . '/uploads/' . $pdfFilename;

	// Save PDF content to the file
	file_put_contents($pdfFilePath, $pdfFile);

	// Attach the PDF to the email
	$attachments = array($pdfFilePath);

	// Send the email
	$result = wp_mail($mail, $subject, $message, $headers, $attachments);

	// Clean up: delete the temporary PDF file
	unlink($pdfFilePath);

	if ($result) {
	    echo "<span style='color:#198754'>Email sent successfully!</span>";
	} else {
		echo "<span style='color:#dd2c00'>Error sending email.</span>";
	}
}

//AJAX Handler for send mail of receipt pdf ~~~~~~~~~~~
function generate_pdf_ajax_handler() {
    if (isset($_POST['html_content'])) {
        $html = $_POST['html_content'];
        $mail = $_POST['send_mailTo'];
        generate_pdf_from_html($html, $mail);
    }
    wp_die();
}
add_action('wp_ajax_generate_pdf', 'generate_pdf_ajax_handler');
add_action('wp_ajax_nopriv_generate_pdf', 'generate_pdf_ajax_handler');



//AJAX Handler for send mail of invoice pdf ~~~~~~~~~~~
function generate_pdf_invoice_handler() {
    if (isset($_POST['html_invoice'])) {
        $html = $_POST['html_invoice'];
        $mail = $_POST['send_mailToInv'];
        
        generate_pdf_from_html($html, $mail);
    }
    wp_die();
}
add_action('wp_ajax_generate_pdf_invoice', 'generate_pdf_invoice_handler');
add_action('wp_ajax_nopriv_generate_pdf_invoice', 'generate_pdf_invoice_handler');



//Create a API for invoice detalil~~~~~~~~~~~~~~~~~
function get_custom_posts(){
	global $wpdb;
	$tableName = $wpdb->prefix . 'invoice';
	$invoices = $wpdb->get_results( "SELECT * FROM $tableName", ARRAY_A );

	if (empty($invoices)) {
		 return new WP_Error( 'no_data_found', 'No data found', array( 'status' => 404 ) );
	}
	return $invoices;
}

function register_custom_api_routes() {
    register_rest_route( 'invoices/v1', '/list', array(
        'methods'  => 'GET',
        'callback' => 'get_custom_posts',
    ) );
}
add_action( 'rest_api_init', 'register_custom_api_routes' );
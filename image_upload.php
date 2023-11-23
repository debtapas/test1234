
/*
	how to upload a user avatar image from frontend in wordpress? 
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	In WordPress, the process of uploading a user avatar image from the frontend typically involves creating a form that allows users to select or upload an image. Here's a general guide on how you can achieve this:

    Create a Form:
        Use HTML and possibly some JavaScript to create a form on the frontend where users can select or upload an image. You might want to use the <input type="file"> element for the file upload.
*/
<form id="avatar-form" method="post" enctype="multipart/form-data">
    <input type="file" name="avatar" id="avatar" accept="image/*">
    <input type="submit" value="Upload Avatar">
</form>
<?php
/*
Handle Form Submission:
    Use JavaScript to handle the form submission. You might want to use AJAX to send the form data to the server without refreshing the page.
*/

// Example using jQuery for AJAX
$('#avatar-form').submit(function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: 'your-upload-endpoint.php', // Replace with your actual server-side endpoint
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log(response);
            // Handle success (e.g., update UI)
        },
        error: function(error) {
            console.error(error);
            // Handle error
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
/*Handle the Upload on the Server:

    Create a server-side script (e.g., in PHP) that handles the file upload. Use the move_uploaded_file function to move the uploaded file to the desired directory.*/


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'path/to/your/avatar/directory/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
        echo 'File is valid, and was successfully uploaded.';
    } else {
        echo 'Upload failed.';
    }
}

/*Note: Ensure that the directory ($uploadDir) is writable by the server.
Update User Meta:
    Once the file is uploaded successfully, you'll likely want to update the user's avatar information. WordPress typically uses the update_user_meta function for this.*/

$user_id = get_current_user_id(); // Get the current user ID
$avatar_url = 'path/to/your/avatar/directory/' . $_FILES['avatar']['name'];

update_user_meta($user_id, 'avatar', $avatar_url);

/*    Customize this according to your specific needs.
Remember, this is a simplified example, and you should implement proper security measures, error handling, and validation in a production environment. Additionally, the file upload directory should be appropriately secured to prevent unauthorized access.
*/





/*create a functionality to upload user avatar image from fronted by ajax in wordpress?
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
To enable users to upload an avatar image from the frontend using AJAX in WordPress, you can follow these general steps:
    Create a Form in your Theme or Page:
    Add a form to your theme or page where users can select and upload their avatar image. Ensure that you have the necessary fields, such as the file input, to handle the image upload.
*/
<form id="avatar-upload-form">
    <input type="file" id="avatar" name="avatar" accept="image/*">
    <input type="submit" value="Upload Avatar">
</form>
<div id="avatar-upload-message"></div>



/*Enqueue jQuery and Your Custom JavaScript:
Enqueue jQuery if it's not already included and add your custom JavaScript file to handle the AJAX request.*/

// Enqueue jQuery
function enqueue_jquery() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

// Enqueue custom JavaScript
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array('jquery'), null, true);

    // Pass the necessary variables to JavaScript
    wp_localize_script('custom-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/*Handle AJAX Request in Functions.php:
In your theme's functions.php file, add the PHP functions to handle the AJAX request.*/

function handle_avatar_upload() {
    // Check if the request is an AJAX request
    if (isset($_FILES['avatar'])) {
        // Handle file upload and other processing here

        // Example: Save the uploaded file to the uploads directory
        $upload_dir = wp_upload_dir();
        $file_name = $_FILES['avatar']['name'];
        $file_path = $upload_dir['path'] . '/' . $file_name;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $file_path);

        // Provide a response
        $response = array(
            'message' => 'Avatar uploaded successfully!',
            'file_path' => $file_path,
        );

        wp_send_json_success($response);
    } else {
        wp_send_json_error('Invalid AJAX request');
    }
}
add_action('wp_ajax_handle_avatar_upload', 'handle_avatar_upload');
add_action('wp_ajax_nopriv_handle_avatar_upload', 'handle_avatar_upload');

/*Create JavaScript to Handle AJAX Request:
In your custom JavaScript file (custom-scripts.js), use jQuery to handle the AJAX request.*/
jQuery(document).ready(function ($) {
    $('#avatar-upload-form').submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Display the response message
                $('#avatar-upload-message').html(response.data.message);

                // You can use the file path for further processing or display
                var filePath = response.data.file_path;
            },
            error: function (error) {
                // Handle errors
                console.log(error.responseText);
            }
        });
    });
});

/*This is a basic example, and you may need to enhance it based on your specific requirements. Also, make sure to add proper security measures and error handling in your functions to ensure the security and reliability of your application.*/

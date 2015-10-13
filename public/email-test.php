<?php

require_once '../includes/mandrill-api-php/src/Mandrill.php'; //Not required with Composer
$mandrill = new Mandrill('GJyvYpd7RDiY_WN-ZSB29g');


try {
    $mandrill = new Mandrill('GJyvYpd7RDiY_WN-ZSB29g');
    $message = array(
        'html' => '<p>Example HTML content</p>',
        'text' => 'Example text content',
        'subject' => 'example subject',
        'from_email' => 'shop@theclubofoddvolumes.com',
        'from_name' => 'The Club of Odd Volumes',
        'to' => array(
            array(
                'email' => 'mail@benralph.com',
                'name' => 'Ben Ralph',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'shop@theclubofoddvolumes.com'),
        'important' => false,
        'track_opens' => true,
        'track_clicks' => true,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'tags' => array('password-resets'),
        'images' => array(
            array(
                'type' => 'image/png',
                'name' => 'IMAGECID',
                'content' => 'ZXhhbXBsZSBmaWxl'
            )
        )
    );
    $async = false;
    $ip_pool = 'Main Pool';
    $result = $mandrill->messages->send($message, $async, $ip_pool);
    print_r($result);
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}
?>


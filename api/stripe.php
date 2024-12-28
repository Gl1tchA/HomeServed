<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php'; // Include Composer's autoloader

// Set your Stripe secret key (get this from your Stripe dashboard)
\Stripe\Stripe::setApiKey('sk_test_51QXHt8GEjHAfmOQpQB8i6udpjaZeGCBfZqXtKO71DabRDRxWTZEYVcw53GbJMiz3QnCMLB5cpTAaOKi5GtXAtqAa00laVOl0Nh');

header('Content-Type: application/json');

try {
    // Get the data sent from the frontend
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if (empty($data) || !isset($data->paymentMethodId)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'PaymentMethod ID is required.']);
        exit;
    }
    error_log('Raw Input: ' . $json);
    error_log('Received PaymentMethod ID: ' . $data->paymentMethodId);
    // Check for a valid PaymentMethod ID
    if (!isset($data->paymentMethodId) || empty($data->paymentMethodId)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'PaymentMethod ID is required.']);
        exit;
    }

    // Create a PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 5000, // Amount in cents (e.g., $50.00 = 5000)
        'currency' => 'usd', // Currency (e.g., usd, eur)
        'payment_method' => $data->paymentMethodId, // PaymentMethod ID from frontend
        'confirmation_method' => 'manual', // Manual confirmation
        'confirm' => true, // Automatically attempt to confirm the payment
        'return_url' => 'https://dashboard.stripe.com' 
    ]);
    

    // Respond with the PaymentIntent status and client secret
    echo json_encode([
        'status' => $paymentIntent->status,
        'clientSecret' => $paymentIntent->client_secret,
    ]);
    
} catch (\Stripe\Exception\ApiErrorException $e) {
    http_response_code(500);

    // Log the error for debugging purposes
    error_log('Stripe API error: ' . $e->getMessage());

    // Send a generic error response to the frontend
    echo json_encode(['error' => 'An error occurred while processing the payment.']);
}
?>

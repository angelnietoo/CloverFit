<?php
require __DIR__ . '/vendor/autoload.php';
function env($key, $default = null) {
    $path = __DIR__ . '/.env';
    if (!file_exists($path)) return $default;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (!str_contains($line, '=')) continue;
        [$k, $v] = explode('=', $line, 2);
        if (trim($k) === $key) return trim(trim($v), " \"'");
    }
    return $default;
}

$clientId = env('PAYPAL_CLIENT_ID');
$secret = env('PAYPAL_CLIENT_SECRET');
$mode = env('PAYPAL_MODE', 'sandbox');

if (!$clientId || !$secret) {
    echo "Missing PayPal credentials\n";
    exit(1);
}

$apiContext = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential($clientId, $secret));
$apiContext->setConfig([
    'mode' => $mode,
    'http.CURLOPT_CONNECTTIMEOUT' => 30,
    'http.CURLOPT_SSL_VERIFYPEER' => false,
    'http.CURLOPT_SSL_VERIFYHOST' => false,
]);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$item = new \PayPal\Api\Item();
$item->setName('Test item')->setCurrency('EUR')->setQuantity(1)->setPrice('9.99');

$itemList = new \PayPal\Api\ItemList();
$itemList->setItems([$item]);

$amount = new \PayPal\Api\Amount();
$amount->setCurrency('EUR')->setTotal('9.99');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)->setItemList($itemList)->setDescription('Test payment');

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl('http://example.com/return')->setCancelUrl('http://example.com/cancel');

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions([$transaction]);

try {
    $payment->create($apiContext);
    echo "Payment created. Links:\n";
    foreach ($payment->getLinks() as $link) {
        echo $link->getRel() . ' => ' . $link->getHref() . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    if (method_exists($e, 'getData')) {
        echo "Data: " . print_r($e->getData(), true) . PHP_EOL;
    }
}

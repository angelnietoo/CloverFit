<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Payment as PayPalPayment;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPalController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        // Configurar PayPal
        $this->_apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),     // CLIENT_ID
                env('PAYPAL_CLIENT_SECRET')  // SECRET
            )
        );
        $this->_apiContext->setConfig(
            array(
                'mode' => env('PAYPAL_MODE'), // sandbox o live
                'http.CURLOPT_CONNECTTIMEOUT' => 30,
                'http.CURLOPT_SSL_VERIFYPEER' => false,
                'http.CURLOPT_SSL_VERIFYHOST' => false,
            )
        );
    }

    // Crear el pago y redirigir al usuario a PayPal
    public function pay(Request $request)
    {
        \Log::info('PayPalController@pay called', ['input' => $request->all()]);
        $tipo = $request->input('tipo_suscripcion', 'fit');

        // Determinar el monto en función del tipo de suscripción (primer mes)
        $amountValue = match ($tipo) {
            'pro' => '9.99',
            'elite' => '9.99',
            default => '9.99',
        };

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName("Suscripción {$tipo}")
             ->setCurrency('EUR')
             ->setQuantity(1)
             ->setPrice($amountValue);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('EUR')
               ->setTotal($amountValue);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Pago de suscripción CloverFit');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('suscripcion.execute'))
                     ->setCancelUrl(route('suscripcion.cancel'));

        $payment = new PayPalPayment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

        try {
            $payment->create($this->_apiContext);
            \Log::info('PayPal payment created', ['payment' => $payment->toJSON()]);
        } catch (\Exception $e) {
            \Log::error('PayPal create error', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al crear el pago: ' . $e->getMessage());
        }

        // Obtener la URL de aprobación y redirigir
        $links = $payment->getLinks();
        foreach ($links as $link) {
            \Log::info('PayPal link', ['rel' => $link->getRel(), 'href' => $link->getHref()]);
            if ($link->getRel() === 'approval_url') {
                return redirect()->away($link->getHref());
            }
        }

        return redirect()->back()->with('error', 'No se encontró la URL de aprobación.');
    }

    // Ejecutar el pago después de la aprobación en PayPal
    public function execute(Request $request)
    {
        $paymentId = $request->query('paymentId');
        $payerId = $request->query('PayerID') ?? $request->query('payerID');

        if (! $paymentId || ! $payerId) {
            return redirect('/')->with('error', 'Pago no autorizado.');
        }

        $payment = PayPalPayment::get($paymentId, $this->_apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->_apiContext);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error al ejecutar el pago: ' . $e->getMessage());
        }

        return redirect('/')->with('success', 'Pago realizado correctamente.');
    }

    // Cancelación del pago
    public function cancel()
    {
        return redirect('/')->with('error', 'Pago cancelado por el usuario.');
    }
}

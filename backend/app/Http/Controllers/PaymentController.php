<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:1000', 
            ]);

            $amount = $request->input('amount');

            $partnerCode = env('MOMO_PARTNER_CODE');
            $accessKey = env('MOMO_ACCESS_KEY');
            $secretKey = env('MOMO_SECRET_KEY');
            $redirectUrl = env('MOMO_REDIRECT_URL');
            $ipnUrl = env('MOMO_IPN_URL');

            $requestId = $partnerCode . time();
            $orderId = $requestId;
            $orderInfo = "Thanh toán với MoMo";
            $requestType = "captureWallet";
            $extraData = "";
            $lang = "vi";

            $rawSignature = "accessKey={$accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$ipnUrl}&orderId={$orderId}&orderInfo={$orderInfo}&partnerCode={$partnerCode}&redirectUrl={$redirectUrl}&requestId={$requestId}&requestType={$requestType}";

            $signature = hash_hmac('sha256', $rawSignature, $secretKey);

            $requestBody = [
                'partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => (int)$amount, 
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature,
                'lang' => $lang,
            ];

            $client = new Client();
            $response = $client->post('https://test-payment.momo.vn/v2/gateway/api/create', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $requestBody,
            ]);

            $responseData = json_decode($response->getBody(), true);

            return response()->json(['payUrl' => $responseData['payUrl']], 200);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error("Lỗi khi gửi yêu cầu MoMo: " . $e->getMessage());
            return response()->json(['message' => 'Lỗi khi tạo thanh toán'], 500);
        } catch (\Exception $e) {
            Log::error("Lỗi hệ thống MoMo: " . $e->getMessage());
            return response()->json(['message' => 'Lỗi hệ thống'], 500);
        }
    }
}
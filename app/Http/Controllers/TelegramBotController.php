<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use WeStacks\TeleBot\TeleBot;

class TelegramBotController extends Controller
{
    //+++++++++++++++++++++++++++++++++++++++
    private $bot;
    private $message_text;
    private $chat_id = 162001293;
    //+++++++++++++++++++++++++++++++++++++++
    // curl -F "url= https://8e9b-115-164-119-134.ngrok-free.app/telegram-webhook" https://api.telegram.org/bot6724825771:AAFkpXH26Jm4-lferQCeP-szFqd9dTlekCk/setWebhook

    public function __construct()
    {
        $this->bot = new TeleBot('6416351316:AAFkgIzruqlfxke4Wl-4K-2L558go8X-UdY');
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index()
    {
        return view('welcome');
    }
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendMessage()
    {
        // Fetch all products
        $products = Product::with('vendor')->get();

        // Check if there are products
        if ($products->isEmpty()) {
            return Response::json('No products found.');
        }

        foreach ($products as $product) {
            // Limit the message length and ensure you have an image URL
            if (strlen($product->name) > 200 || empty($product->thumb_image)) {
                continue; // Skip this product if no image URL or name is too long
            }

            // Prepare the caption text
            $caption = "Name: {$product->name}\nPrice RM: {$product->price}\n";
            $caption .= "Vendor: " . ($product->vendor->shop_name ?? 'Not Available'."\n");
            $caption .= "\nQuantity: " . ($product->qty ?? '0')."\n";

            // Send the photo with a caption
            try {
                $message = $this->bot->sendPhoto([
                    'chat_id' => $this->chat_id,
                    'photo'   => $product->thumb_image,
                    'caption' => $caption,
                ]);
            } catch (Exception $e) {
                // Log error or handle it
                continue; // Skip to the next product
            }
        }

        return Response::json('Products sent.');
    }



    public function handleWebhook(Request $request)
    {
        Log::info('Webhook received', $request->all());

        $this->sendMessage();

        return response()->json(['status' => 'success']);
    }
}

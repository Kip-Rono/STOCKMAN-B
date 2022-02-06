<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Sizes;
use App\Models\Stock;
use Illuminate\Http\Request;

class CheckoutInventoryController extends Controller
{
    //delete checkout products
    public function checkoutIndividualProductToCart(Request $request)
    {
        //return $request;
        $product_id_arr = $category_arr = $quantity_arr = $response_arr = array();
        $category = '';
        $response = new \stdClass();
        //generate product id
        $quantity = $request->quantity;
        if ($request->category == 1) {
            switch ($request->size) {
                //append category, size and number to get product id
                case '1':
                    $category = 'CTS';
                    $unit_price = Sizes::select('unit_price')
                        ->where('code', $request->size)
                        ->get();
                    $unit_price = $unit_price[0]['unit_price'];
                    $amount = $unit_price * (int)$request->quantity;

                    for ($i = 1; $i <= $request->quantity; $i++) {
                        $product_id = 'CT' . 'S' . $i;
                        array_push($product_id_arr, $product_id);
                    }

                    $response->category = $category;
                    $response->quantity = $request->quantity;
                    $response->unit_price = $unit_price;
                    $response->amount = $amount;
                    break;
                case '2':
                    $category = 'CTM';
                    $unit_price = Sizes::select('unit_price')
                        ->where('code', $request->size)
                        ->get();
                    $unit_price = $unit_price[0]['unit_price'];
                    $amount = $unit_price * (int)$request->quantity;

                    for ($i = 1; $i <= $request->quantity; $i++) {
                        $product_id = 'CT' . 'M' . $i;
                        array_push($product_id_arr, $product_id);
                    }
                    $response->category = $category;
                    $response->quantity = $request->quantity;
                    $response->unit_price = $unit_price;
                    $response->amount = $amount;
                    break;
                case '3':
                    $category = 'CTL';
                    $unit_price = Sizes::select('unit_price')
                        ->where('code', $request->size)
                        ->get();
                    $unit_price = $unit_price[0]['unit_price'];
                    $amount = $unit_price * (int)$request->quantity;

                    for ($i = 1; $i <= $request->quantity; $i++) {
                        $product_id = 'CT' . 'L' . $i;
                        array_push($product_id_arr, $product_id);
                    }
                    $response->category = $category;
                    $response->quantity = $request->quantity;
                    $response->unit_price = $unit_price;
                    $response->amount = $amount;
                    break;
                case '4':
                    $category = 'CTX';
                    $unit_price = Sizes::select('unit_price')
                        ->where('code', $request->size)
                        ->get();
                    $unit_price = $unit_price[0]['unit_price'];
                    $amount = $unit_price * (int)$request->quantity;
                    for ($i = 1; $i <= $request->quantity; $i++) {
                        $product_id = 'CT' . 'X' . $i;
                        array_push($product_id_arr, $product_id);
                    }
                    $response->category = $category;
                    $response->quantity = $request->quantity;
                    $response->unit_price = $unit_price;
                    $response->amount = $amount;
                    break;
                default:
                    break;
            }
        }
        array_push($response_arr, $response);
        return [
            'response' => $response_arr,


        ];
    }

    //save checkout stock
    public function saveCheckoutInventory(Request $request)
    {
        //return $request;
        $response = array();

        try {
            //save in tables stock fo stock ordered
            for ($i = 0; $i < count($request->category); $i++) {
                Sales::create([
                    'product_id' => $request->category[$i],
                    'quantity' => $request->quantity[$i],
                    'amount_paid' => $request->amount[$i],
                    'unit_price' => $request->unit_price[$i],
                    'date_entered' => today(),
                    'paid' => 1
                ]);
            }
            return ['message' => 'Success Checkout !'];
            /*Stock::where(
                [
                    //'product_id' => $request->category[$i],
                    'quantity' => $request->quantity[$i],
                ]
            )->update([
                'paid' => 1
            ]);*/
        }
        catch (\Exception $e) {
            return ['message' => 'Error Checking Out Products'];
            //array_push($response, $e->getMessage());
        }

        return ['message' => 'Success '];
    }
}

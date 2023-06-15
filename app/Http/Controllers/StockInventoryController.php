<?php

namespace App\Http\Controllers;

use App\Models\FoodType;
use App\Models\Sizes;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use function Sodium\increment;

class StockInventoryController extends Controller
{
    //
    public function addIndividualProductToCart(Request $request)
    {
        //return $request;
        $product_id_arr = $category_arr = $quantity_arr = $response_arr = array();
        $category = '';
        $department  = $request->category;
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
                    $response->department = $department;
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
                    $response->department = $department;
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
                    $response->department = $department;
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
                    $response->department = $department;
                    break;
                default:
                    break;
            }
        } elseif ($request->category == 2) {
            switch ($request->type) {
                //append category, size and number to get product id
                case '1':
                    $category = 'FDF';
                    $unit_price = FoodType::select('unit_price')
                        ->where('code', $request->type)
                        ->get();
                    $unit_price = $unit_price[0]['unit_price'];
                    $amount = $unit_price * (int)$request->quantity;

                    for ($i = 1; $i <= $request->quantity; $i++) {
                        $product_id = 'FD' . 'F' . $i;
                        array_push($product_id_arr, $product_id);
                    }
                    $response->category = $category;
                    $response->quantity = $request->quantity;
                    $response->unit_price = $unit_price;
                    $response->amount = $amount;
                    $response->department = $department;
                    break;
                case '2':
                    $category = 'FDM';
                    $unit_price = FoodType::select('unit_price')
                        ->where('code', $request->type)
                        ->get();
                    $unit_price = $unit_price[0]['unit_price'];
                    $amount = $unit_price * (int)$request->quantity;

                    for ($i = 1; $i <= $request->quantity; $i++) {
                        $product_id = 'FD' . 'M' . $i;
                        array_push($product_id_arr, $product_id);
                    }
                    $response->category = $category;
                    $response->quantity = $request->quantity;
                    $response->unit_price = $unit_price;
                    $response->amount = $amount;
                    $response->department = $department;
                    break;
                case '3':
                    $category = 'FDC';
                    $unit_price = FoodType::select('unit_price')
                        ->where('code', $request->type)
                        ->get();
                    $unit_price = $unit_price[0]['unit_price'];
                    $amount = $unit_price * (int)$request->quantity;

                    for ($i = 1; $i <= $request->quantity; $i++) {
                        $product_id = 'FD' . 'C' . $i;
                        array_push($product_id_arr, $product_id);
                    }
                    $response->category = $category;
                    $response->quantity = $request->quantity;
                    $response->unit_price = $unit_price;
                    $response->amount = $amount;
                    $response->department = $department;
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

    public function saveSubmitStockInventory(Request $request)
    {
        //return $request;

        $response = array();

        try {
            //save in tables stock fo stock ordered
            for ($i = 0; $i < count($request->category); $i++) {
                Stock::create([
                    'product_id' => $request->category[$i],
                    'quantity' => $request->quantity[$i],
                    'amount_paid' => $request->amount[$i],
                    'date_entered' => today(),
                    'department' => $request->department[$i]
                ]);

                /*switch ($request->department[$i]) {
                    case '1':
                        $getId = DB::table('stock')->first();
                        $getfirst = empty($getId) ? 0 : $getId->id;

                        //array_push($response, $getfirst);
//            return $getfirst;
                        //array_push($response,  $id[0]['max_id']);
                        Stock::create([
                            'product_id' => $request->category[$i],
                            'quantity' => $request->quantity[$i],
                            'amount_paid' => $request->amount[$i],
                            'date_entered' => today(),
                            'department' => 1
                        ]);
                        break;
                    case '2':
                        $getId = DB::table('stock')->first();
                        $getfirst = empty($getId) ? 0 : $getId->id;

                        //array_push($response, $getfirst);
//            return $getfirst;
                        //array_push($response,  $id[0]['max_id']);
                        Stock::create([
                            'product_id' => $request->category[$i],
                            'quantity' => $request->quantity[$i],
                            'amount_paid' => $request->amount[$i],
                            'date_entered' => today(),
                            'department' => 2
                        ]);

                        break;
                }*/
            }

            return ['message' => 'Stock Item(s) Added Successfully'];
        } catch (\Exception $e) {
            return ['message' => 'Sorry. Error Adding Items to Stock'];
//            array_push($response, $e->getMessage());
        }
    }
}

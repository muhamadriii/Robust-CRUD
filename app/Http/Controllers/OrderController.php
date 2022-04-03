<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::get();
        return view('order.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::get();
        $data['customers'] = Customer::get();

        return view('order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['user_id'] = Auth::user()->id;
            $input['code'] = date('YmdH');
            $input['total'] = 0;
            $order = Order::create($input);



            $total = 0;
            $order->order_details()->forceDelete();
            foreach ($input['product_id'] as $key => $value) {
                $product = Product::find($value);
                if (!$product) continue;

                $qty = $input['qty']    [$key];
                $subtotal = $product->price * $qty;
                $total += $subtotal;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $value,
                    'qty' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);
            }
            $order->update(['total' => $total]);
            DB::commit();

            return redirect()->route('order.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view ('order.show',['$data' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $data['order'] = $order;
        $data['products']  = Product::get();
        $data['customers'] = Customer::get();

        return view('order.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $order->date = $input['date'];

            $total = 0;
            foreach ($input['product_id'] as $key => $value) {
                $product = Product::find($value);
                if (!$product) continue;

                $qty = $input['qty'][$key];
                $subtotal = $product->price * $qty;
                $total += $subtotal;

                OrderDetail::create([
                    'order_id' => $order->id,
                    
                    'subtotal' => $subtotal,
                ]);
            }
            $order->total = $total;
            $order->save();

            DB::commit();

            return redirect()->route('order.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->order_details()->delete();
        $order->delete();
        return redirect()->route('order.index');
    }
}
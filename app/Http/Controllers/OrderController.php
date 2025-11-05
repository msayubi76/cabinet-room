<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\TcsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
        public function index()
        {
                try {
                        $orders = Order::orderBy('id', 'DESC')->paginate(20);
                        return view('admin.orders.index', compact('orders'));
                } catch (\Throwable $th) {
                        return response()->json(['status' => false, 'message' => $th->getMessage()]);
                }
        }





        public function orderType($order_type)
        {
                try {
                        $orders = Order::where('order_status', $order_type)->paginate(20);
                        return view('admin.orders.index', compact('orders'));
                } catch (\Throwable $th) {
                        return response()->json(['status' => false, 'message' => $th->getMessage()]);
                }
        }

        public function updateStatus(Request $request)
        {
                try {
                        DB::beginTransaction();

                        $id = $request->id;
                        $order_status = $request->order_status;

                        if (Order::where('id', $id)->exists()) {
                                $order = Order::where('id', $id)->first();
                                $order->order_status = $order_status;
                                $order->update();

                                // Only create TCS shipment when status is 'Accepted'
                                if ($order_status === 'Accepted') {
                                        $tcsService = new TCSService();

                                        // Calculate shipping charges based on product dimensions
                                        $shippingCalculation = $tcsService->calculateShippingCharges($order);

                                        // Create TCS shipment
                                        $result = $tcsService->createShipment($order);
                                        if ($result['success']) {
                                                // Update order with shipping calculation
                                                $order->update([
                                                        'delivery_fee' => $shippingCalculation['shipping_charges'],
                                                        'shipping_calculation_data' => json_encode($shippingCalculation)
                                                ]);

                                                DB::commit();

                                                return response()->json([
                                                        'success' => true,
                                                        'message' => 'Order accepted and TCS shipment created',
                                                        'tracking_number' => $result['tracking_number'],
                                                        'shipping_calculation' => $shippingCalculation,
                                                        'payment_method' => $order->payment->method,
                                                        'cod_amount' => $order->payment->method === 'cod' ? $order->payment->total_amount : 0,
                                                        'order' => $result['order']
                                                ]);
                                        } else {
                                                DB::rollBack();

                                                return response()->json([
                                                        'success' => false,
                                                        'message' => 'Failed to create TCS shipment',
                                                        'error' => $result['error']
                                                ], 500);
                                        }
                                } else {
                                        DB::commit();
                                        return response()->json([
                                                'success' => true,
                                                'message' => 'Order status updated successfully'
                                        ]);
                                }
                        }

                        return response()->json([
                                'success' => false,
                                'message' => 'Order not found'
                        ], 404);
                } catch (\Throwable $th) {
                        DB::rollBack();
                        return response()->json([
                                'success' => false,
                                'message' => $th->getMessage()
                        ]);
                }
        }






        public function viewOrder(Order $order)
        {
                try {
                        $order_items = $order->orderDetails()->with('products', 'variation')->get();
                        $payment = $order->payment;
                        $shipping_detail = $order->shipping;

                        return view('admin.orders.view-orderdetail', compact('order_items', 'shipping_detail', 'payment', 'order'));
                } catch (\Throwable $th) {
                        return response()->json(['status' => false, 'message' => $th->getMessage()]);
                }
        }
}

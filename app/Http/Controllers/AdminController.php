<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function check(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30',
        ]);


        $creds = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('fail', __('notifications.ERROR.Check your email and password'));
        }
    }
    public function logout(Request $request){
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

//    public function dashboard(){
//
//        return view('admin.dashboard');
//    }
    public function dashboard(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $dataUsers = User::all();
        $dataOrders = Order::all();
        return view('admin.dashboard', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'dataUsers' => $dataUsers,
            'dataOrders' => $dataOrders
        ], compact('notifications'));
    }

    public function getUsers(Request $request){
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function allUsers(){
        $dataCategories = Category::all();
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        return view('admin.all-users', [
            'dataCategories' => $dataCategories,
        ], compact('notifications'));
    }

    public function getOrders(Request $request){
        if ($request->ajax()) {
            $data = Order::latest()->get();
            return $this->extracted($data);
        }
    }

    public function getOrdersCreated(Request $request){
        if ($request->ajax()) {
            $data = Order::where('order_status', 'CREATED')->get();
            return $this->extracted($data);
        }
    }

    public function getOrdersDelivered(Request $request){
        if ($request->ajax()) {
            $data = Order::where('order_status', 'DELIVERED')->get();
            return $this->extracted($data);
        }
    }

    public function getOrdersDelivering(Request $request){
        if ($request->ajax()) {
            $data = Order::where('order_status', 'DELIVERING')->get();
            return $this->extracted($data);
        }
    }
    public function getOrdersDelete(Request $request){
        if ($request->ajax()) {
            $data = Order::where('order_status', 'DELETE')->get();
            return $this->extracted($data);
        }
    }

    public function getOrdersReceived(Request $request){
        if ($request->ajax()) {
            $data = Order::where('order_status', 'RECEIVED')->get();
            return $this->extracted($data);
        }
    }

    public function allOrders(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $dataCategories = Category::all();
        return view('admin.all-orders', [
            'dataCategories' => $dataCategories,
        ], compact('notifications'));
    }
    public function allOrdersCreated(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $dataCategories = Category::all();
        return view('admin.orders-created', [
            'dataCategories' => $dataCategories,
        ], compact('notifications'));
    }
    public function allOrdersReceived(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $dataCategories = Category::all();
        return view('admin.orders-received', [
            'dataCategories' => $dataCategories,
        ], compact('notifications'));
    }
    public function allOrdersDelivered(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $dataCategories = Category::all();
        return view('admin.orders-delivered', [
            'dataCategories' => $dataCategories,
        ], compact('notifications'));
    }
    public function allOrdersDelivering(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $dataCategories = Category::all();
        return view('admin.orders-delivering', [
            'dataCategories' => $dataCategories,
        ], compact('notifications'));
    }
    public function allOrdersDelete(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $dataCategories = Category::all();
        return view('admin.orders-delete', [
            'dataCategories' => $dataCategories,
        ], compact('notifications'));
    }

    public function getOrderDetails($order_tracking){
        $data = OrderDetail::where('order_id', $order_tracking)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('product_name', function ($order) {
                $product = Product::where('id', $order->product_id)->first();
                return $product->product_name_vi;
            })
            ->editColumn('product_price', function ($order) {
                return $order->product_price . ' ₽';
            })
            ->rawColumns(['product_name', 'product_price'])
            ->make(true);
    }

    public function getOrderByID($order_tracking){
        $order = Order::where('order_tracking', $order_tracking)->first();
        return response()->json([
            'client_name' =>$order->client_name,
            'client_address' =>$order->client_address,
            'client_email' =>$order->client_email,
            'client_phone' =>$order->client_phone,
            'order_total' => $order->order_total,
            'order_tracking' => $order->order_tracking,
            'order_status' => $order->order_status,
            'order_ship' => $order->order_ship,
            'order_note' => $order->order_note,
            'created_at' => $order->created_at,
        ]);
    }

    public function markNotification(Request $request){
        $notification = Auth::guard('admin')->user()->notifications()->where('id', $request->input('id'))->first();
        if($notification){
            $notification->markAsRead();
            return response()->noContent();
        }
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function extracted($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('order_total', function ($order) {
                return $order->order_total . ' ₽';
            })
            ->editColumn('order_status', function ($order) {
                $status = '
                        <select class="order_status_change" onchange="changeOrderStatus(this)" data-id="'.$order->id.'">
                    ';
                $orderStatusEmum = ['CREATED', 'RECEIVED', 'DELIVERING', 'DELIVERED', 'DELETE'];
                foreach ($orderStatusEmum as $enum) {
                    if ($enum == $order->order_status) {
                        $status .= '<option value="' . $enum . '" selected>' . $enum . '</option>';
                    } else {
                        $status .= '<option value="' . $enum . '">' . $enum . '</option>';
                    }
                }
                $status .= '
                        </select>
                    ';
                return $status;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                        <div class="d-flex">
                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 viewOrder" data-id="' . $row->order_tracking . '" data-toggle="modal" data-target=".modal-view-order"><i class="fa fa-eye"></i></a>
                        </div>
                    ';
                return $actionBtn;
            })
            ->rawColumns(['order_total', 'order_status', 'action'])
            ->make(true);
    }
}

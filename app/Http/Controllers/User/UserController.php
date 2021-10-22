<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function login(){
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.login', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'LOGIN'
        ]);
    }
    public function register(){
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.register', [
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'REGISTER'
        ]);
    }

    public function profileInfo(){
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/users/");
        return view('main.user-profile-info', [
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'PROFILEINFO',
            'name_page' => __('main.Profile-info'),
            'extra_text' => __('main.Update-you-profile-details-below')
        ]);
    }

    public function wishlist(){
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/users/");
        return view('main.user-wishlist', [
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'WISHLIST',
            'name_page' => __('main.Wishlist'),
            'extra_text' => __('main.List of items you added to wishlist')
        ]);
    }

    public function orders(){
        $result = false;
        $dataOrders = Order::query()
            ->where('user_id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->paginate(5);
        if($dataOrders->count() > 0){
            $result = true;
        }
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/users/");
        return view('main.user-orders', [
            'dataCategories'=>$dataCategories,
            'dataOrders' => $dataOrders,
            'urlPhoto' => $urlPhoto,
            'page' => 'ORDERS',
            'name_page' => __('main.Orders'),
            'extra_text' => __('main.List of orders'),
            'result' => $result,
        ]);
    }

    public function create(Request $request){
        $this->validate($request,[
            'name'=>'required|string',
            'gender'=>'required|not_in:NULL',
            'phone'=>'required|phone:RU',
            'address'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = \Hash::make($request->password);
        $user->image = 'default/avatar_default.png';
        $save = $user->save();

        if($save){
            return redirect()->back()->with('success', "Success");
        } else {
            return redirect()->back()->with('fail', __('notifications.ERROR.Registration'));
        }
    }

    public function check(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|max:30',
        ]);

        $creds = $request->only('email', 'password');
        if(Auth::guard('web')->attempt($creds)){
            return redirect()->route('main.home');
        } else {
            return redirect()->back()->with('fail', __('notifications.ERROR.Check your email and password'));
        }
    }

    public function updateAvatar(Request $request){
        $user = auth()->user();

        $folderPath = 'data/images/upload/users/';

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);

        $user->image = $imageName;
        $save = $user->save();

        $url=asset("data/images/upload/users/$imageName");

        if($save){
            return response()->json(['code' => 1, 'url' => $url]);
        } else {
            return response()->json(['code' => 0]);
        }
    }

    public function update(Request $request){
        $validator = \Validator::make($request->all(), [
            'name'=>'required|string',
            'gender'=>'required|not_in:NULL',
            'phone'=>'required|phone:RU',
            'address'=>'required|string',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $user = auth()->user();
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();

            return response()->json(['code'=>1, 'name' => $request->name]);
        }
    }

    public function changePassword(Request $request){
        $validator = \Validator::make($request->all(), [
            'npassword'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:npassword'
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $user = auth()->user();
            $user->password = \Hash::make($request->npassword);
            $user->save();

            return response()->json(['code'=>1]);
        }
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('main.home');
    }
}

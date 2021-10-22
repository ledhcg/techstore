<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    private  $product;
    public function __construct(Product $product){
        $this->product = $product;
    }


    public function addProduct(){
        $dataCategories = Category::where('category_status', StatusEnum::ACTIVE)->get();
        return view('admin.add-product', ['dataCategories' => $dataCategories]);
    }

    public function allProducts(){
        $dataCategories = Category::all();
        return view('admin.all-products', ['dataCategories' => $dataCategories]);
    }

    public function insert(Request $request){
        $validator = \Validator::make($request->all(), [
            'product_name_vi'  => 'required|string|unique:products',
            'product_name_ru' => 'required|string|unique:products',
            'product_image' => 'required|image'
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $product = new Product();
            $product->product_name_vi = $request->input('product_name_vi');
            $product->product_name_ru = $request->input('product_name_ru');
            $product->product_description_vi = $request->input('product_description_vi');
            $product->product_description_ru = $request->input('product_description_ru');
            $product->product_unit_vi = $request->input('product_unit_vi');
            $product->product_unit_ru = $request->input('product_unit_ru');
            $product->product_price_last = $request->input('product_price_last');
            $product->product_price_fix = $request->input('product_price_fix');
            $product->product_price_discount = $request->input('product_price_discount');
            $product->product_quantity_to_discount = $request->input('product_quantity_to_discount');
            $product->category_id = $request->input('category_id');
            $product->product_status = StatusEnum::ACTIVE;

            if ($request->hasFile('product_image')) {
                $file = $request->file('product_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;

                $img = Image::make($file->path());
                $img->fit(800, 600, function ($constraint) {
                    $constraint->upsize();
                })->save('data/images/upload/products/'.$filename);

                $file->move('data/images/upload/hd/products/', $filename);
                $product->product_image = $filename;
            }
            $product->save();
            return response()->json(['code'=>1, 'msg' => 'Success']);
        }
    }

    public function update(Request $request){
        $validator = \Validator::make($request->all(), [
            'product_name_vi_edit'  => 'required|string',
            'product_name_ru_edit' => 'required|string',
            'product_image_edit' => 'image'
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $product = Product::find($request->input('product_id_edit'));
            $product->product_name_vi = $request->input('product_name_vi_edit');
            $product->product_name_ru = $request->input('product_name_ru_edit');
            $product->product_description_vi = $request->input('product_description_vi_edit');
            $product->product_description_ru = $request->input('product_description_ru_edit');
            $product->product_unit_vi = $request->input('product_unit_vi_edit');
            $product->product_unit_ru = $request->input('product_unit_ru_edit');
            $product->product_price_last = $request->input('product_price_last_edit');
            $product->product_price_fix = $request->input('product_price_fix_edit');
            $product->product_price_discount = $request->input('product_price_discount_edit');
            $product->product_quantity_to_discount = $request->input('product_quantity_to_discount_edit');
            $product->category_id = $request->input('p_category_id_edit');
            $product->product_status = $request->input('product_status_edit');

            if ($request->hasFile('product_image_edit')) {
                $file = $request->file('product_image_edit');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;

                $img = Image::make($file->path());
                $img->fit(800, 400, function ($constraint) {
                    $constraint->upsize();
                })->save('data/images/upload/products/'.$filename);

                $file->move('data/images/upload/hd/products/', $filename);
                $product->product_image = $filename;
            }
            $product->save();
            return response()->json(['code'=>1, 'msg' => 'Success']);
        }
    }

    public function delete(Request $request){
        $id = $request->input('product_id');
        $product = Product::find($id);
        $product->delete();
        return response()->json(['code'=>1, 'msg' => 'Success']);
    }

    public function getProductByID($id){
        $product = Product::find($id);
        $url=asset("data/images/upload/products/$product->product_image");
        $url_hd=asset("data/images/upload/hd/products/$product->product_image");
        $alert_discount = '';
        $category_name = '';

        if($product->product_quantity_to_discount > 0){
            $alert_discount .= '        <div class="mb-1 pt-1">
                                            <div class="alert alert-success d-flex" role="alert">
                                                <div class="alert-icon">
                                                    <small><i class="ci-percent"></i></small>
                                                </div>
                                                <div><small class="fs-xs">'.trans_choice('main.Alert-discount', $product->product_quantity_to_discount, ['value' => $product->product_quantity_to_discount]).'</small></div>
                                            </div>
                                        </div>';
        }

        foreach (Category::all() as $category){
            if($product->category_id == $category->id){
                $category_name .= $category['category_name_'.config('app.locale')];
                break;
            }
        }

        return response()->json([
            'details' =>$product,
            'product_image' =>$url,
            'product_image_hd' =>$url_hd,
            'alert_discount' => $alert_discount,
            'category_name' => $category_name,
        ]);
    }

    public function getProducts(Request $request){
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('product_image', function ($product) {
                    $url=asset("data/images/upload/products/$product->product_image");
                    return '<img src="'.$url.'" class="" width="50" height="50" alt=""/></div>';
                })
                ->editColumn('category_name', function ($product) {
                    $category = Category::where('id', $product->category_id)->first();
                    return $category->category_name_vi;
                })
                ->editColumn('product_status', function ($product) {
                    if($product->product_status == StatusEnum::ACTIVE){
                        return '<span class="badge light badge-success">Đang kinh doanh</span>';
                    } else {
                        return '<span class="badge light badge-danger">Ngừng kinh doanh</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <div class="d-flex">
                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 editProduct" data-id="'.$row->id.'" data-toggle="modal" data-target=".modal-edit-product"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger shadow btn-xs sharp deleteProduct" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>
                        </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['product_status','product_image', 'action'])
                ->make(true);
        }
    }


}

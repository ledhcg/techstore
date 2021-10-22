<?php

namespace App\Http\Controllers;
use App\Enums\StatusEnum;
use Image;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private  $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function addCategory(){
        $dataCategories = Category::all();
        return view('admin.add-category', ['dataCategories' => $dataCategories]);
    }

    public function allCategories(){
        $dataCategories = Category::all();
        return view('admin.all-categories', ['dataCategories' => $dataCategories]);
    }

    public function insert(Request $request){
        $validator = \Validator::make($request->all(), [
            'category_name_vi'  => 'required|string|unique:categories',
            'category_name_ru' => 'required|string|unique:categories',
            'category_image' => 'required|image'
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $category = new Category();
            $category->category_name_vi = $request->input('category_name_vi');
            $category->category_name_ru = $request->input('category_name_ru');
            $category->category_status = StatusEnum::ACTIVE;
            if($request->hasFile('category_image')){
                $file = $request->file('category_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;


                $img = Image::make($file->path());
                $img->fit(400, 300, function ($constraint) {
                    $constraint->upsize();
                })->save('data/images/upload/categories/'.$filename);

                $file->move('data/images/upload/hd/categories/', $filename);

                $category->category_image = $filename;
            }
            $category->save();
            return response()->json(['code'=>1, 'msg' => 'Success']);
        }
    }

    public function update(Request $request){
        $validator = \Validator::make($request->all(), [
            'category_name_vi_edit'  => 'required|string',
            'category_name_ru_edit' => 'required|string',
            'category_image_edit' => 'image'
        ]
//            ,[
//            'category_name_vi_edit.required'  => 'Category name (VI) is required',
//            'category_name_vi_edit.string'  => 'Category name (VI) must be a string',
//            'category_name_ru_edit.required'  => 'Category name (RU) is required',
//            'category_name_ru_edit.string'  => 'Category name (RU) must be a string',
//            'category_image_edit.image' => 'Category image must be an image',
//        ]

        );
        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $category = Category::find($request->input('category_id_edit'));
            $category->category_name_vi = $request->input('category_name_vi_edit');
            $category->category_name_ru = $request->input('category_name_ru_edit');
            $category->category_status = $request->input('category_status_edit');
            if($request->hasFile('category_image_edit')){
                $file = $request->file('category_image_edit');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;

                $img = Image::make($file->path());

                $img->fit(400, 300, function ($constraint) {
                    $constraint->upsize();
                })->save('data/images/upload/categories/'.$filename);

                $file->move('data/images/upload/hd/categories/', $filename);

                $category->category_image = $filename;
            }
            $category->save();
            return response()->json(['code'=>1, 'msg' => 'Success']);
        }
    }

    public function delete(Request $request){
    $id = $request->input('category_id');
    $category = Category::find($id);
    $category->delete();
    return response()->json(['code'=>1, 'msg' => 'Success']);
}

    public function getCategoryByID($id){
        $category = Category::find($id);
        $url=asset("data/images/upload/categories/$category->category_image");
        return response()->json([
            'details' =>$category,
            'category_image' =>$url,
        ]);
    }

    public function getCategories(Request $request)
{
    if ($request->ajax()) {
        $data = Category::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('category_image', function ($category) {
                $url=asset("data/images/upload/categories/$category->category_image");
                return '<img src="'.$url.'" class="" width="50" height="50" alt=""/></div>';
            })
            ->addColumn('action', function($category){
                $actionBtn = '
                        <div class="d-flex">
                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 editCategory" data-id="'.$category->id.'" data-toggle="modal" data-target=".modal-edit-category" ><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger shadow btn-xs sharp deleteCategory" data-id="'.$category->id.'"><i class="fa fa-trash"></i></a>
                        </div>
                    ';
                return $actionBtn;
            })
            ->editColumn('category_status', function ($category) {
                if($category->category_status == StatusEnum::ACTIVE){
                    return '<span class="badge light badge-success">Đang kinh doanh</span>';
                } else {
                    return '<span class="badge light badge-danger">Ngừng kinh doanh</span>';
                }
            })
            ->rawColumns(['category_status','category_image', 'action'])
            ->make(true);
    }
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function index(){
        $brand = Brand::orderBy('updated_at','DESC')->get();
       
        $products = Product::with('product_image','category')->orderBy('updated_at','DESC')->get();

        $news = News::with('User')->with('User_Info')->where('status',0)->orderBy('created_at','DESC')->take(6)->get();
        $total_news = News::where('status',0)->count();
        return view('admin.brand.index',compact('brand','news','total_news'));
    }

    public function create(){
        $products = Product::with('product_image','category')->orderBy('updated_at','DESC')->get();
        $news = News::with('User')->with('User_Info')->where('status',0)->orderBy('created_at','DESC')->take(6)->get();
        $total_news = News::where('status',0)->count();
        return view('admin.brand.create',compact('news','total_news'));
    }

    public function store(Request $request){
        $request->validate([
            'name'  => 'required'
        ],[
            'name.required' => 'Vui lòng nhập tên thương hiệu'
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->status = isset($request->status) ? 1 : 0;
        $brand->created_at = Carbon::now();
        $brand->updated_at = Carbon::now();
        $brand->save();
        return redirect()->route('brand.index');
    }

    public function delete($id){
        $products = Product::with('product_image','category')->orderBy('updated_at','DESC')->get();
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('brand.index');
    }

    public function edit($id){
        $products = Product::with('product_image','category')->orderBy('updated_at','DESC')->get();
        $brand_edit = Brand::find($id);
        return view('admin.brand.create',compact('brand_edit'));
    }
    
    public function update($id,Request $request){
        $request->validate([
            'name'  => 'required'
        ],[
            'name.required' => 'Vui lòng nhập tên thương hiệu'
        ]);
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->status = isset($request->status) ? 1 : 0;
        $brand->updated_at = Carbon::now();
        $brand->save();
        return redirect()->route('brand.index');
    }

    public function change_status(){
        $brand_id = $_GET['brand_id'];
        $data = array();
        $brand_edit = Brand::find($brand_id);
        if($brand_edit->status ==1){
            $brand_edit->status=0;
        }else{
            $brand_edit->status=1;
        }
        $brand_edit->save();
        $data['brand_id']=$brand_id;
        $data['status_number'] = $brand_edit->status;
        echo json_encode($data);
    }
}

<?php

namespace Modules\Product\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Modules\Product\Entities\Gallery;
use Modules\Product\Entities\Product;
use Modules\Producttag\Entities\ProductTag;
use Illuminate\Contracts\Support\Renderable;
use Modules\ProductCateory\Entities\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {


            if (request() -> ajax()) {
                return datatables()->of(Product::latest()->get())->addIndexColumn()->addColumn('brand' , function($data ){
                    $brand = $data -> brand -> name_en;
                    return $brand;
                })->addColumn('price_s' , function($data ){
                    if($data -> sale_price == ''){
                        $price_s = $data -> price;
                    }else{
                        $price_s ='<span>'.$data -> sale_price .'<del class="pl-3"><mark>'.$data -> price .'</mark></del></span>';
                    }
                    return $price_s;
                })->addColumn('time' , function($data ){
                    $time =$data -> created_at -> diffForHumans();
                    return $time;
                })->addColumn('action' , function($data){

                    $btn = '<div class="d-flex">

                    <a  href="'.route('product.edit' , $data -> id).'"  class="btn btn-info" title="product Edit" id="product_edit_id">
                    <i class="fa fa-edit"></i>
                    </a> &nbsp;  &nbsp;

                    <a href="#" product_trash="'.$data -> id.'" id="product_del_id" class="btn btn-danger" title="Move to trash">
                    <i class="fa fa-trash"></i></a>

                    </div>';

                    return $btn;

                })->rawColumns(['brand' , 'price_s' , 'time' , 'action'])->toJson();
            }
            return view('product::index');


    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $brands = Brand::orderBy('name_en' , 'ASC')->get();
        $tags = ProductTag::orderBy('name_en' , 'ASC')->get();
        $category = ProductCategory::whereNull('parent_id')->get();

        return view('product::create' , compact('brands','tags','category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function productstore(Request $request)
    {
       $request->validate([
            'name_en' => 'required|max:255',
            'name_bn' => 'required|max:255',
            'category_id' => 'required',
            'brand_id' => 'required',
            'thumbnail' => 'required|image',
            'stock'   => 'required|numeric',
            'price'   => 'required|numeric',
        ]);

        $url = '';

        if($request -> hasfile('thumbnail')){

            $img = $request -> file('thumbnail');
            $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            Image::make($img)->resize(290,300)->save('uploads/product/' . $unique_name);

            $url = 'uploads/product/'.$unique_name;

        }




     $product_id =  Product::insertGetId([
            'name_en'  => $request-> name_en,
            'name_bn'  => $request-> name_bn,
            'slug_en'  => str_replace('-',' ', $request -> name_en),
            'slug_bn'  => str_replace('-',' ', $request -> name_bn),
            'thumbnail' => $url,
            'stock' => $request -> stock,
            'price' => $request -> price,
            'sale_price' => $request -> sale_price,
            'brand_id' => $request -> brand_id,
            'category_id' => $request -> category_id,
            'tag_id' => json_encode($request -> tag),
            'code' => $request -> code,
            'color_en' => json_encode($request -> color_en),
            'color_bn' => json_encode($request -> color_bn),
            'size_en' => json_encode($request -> size_en),
            'size_bn' => json_encode($request -> size_bn),
            'wight_en' => json_encode($request -> weight_en),
            'wight_bn' => json_encode($request -> weight_bn),
            'short_des_en' => $request -> short_des_en,
            'short_des_bn' => $request -> short_des_bn,
            'long_des_en' => $request -> long_des_en,
            'long_des_bn' => $request -> long_des_bn,
            'hot_deal' => $request -> hot,
            'featured' => $request -> featured,
            'new_arrival' => $request -> new,
            'flas_sale' => $request -> flas_sale,
            'created_at' => Carbon::now(),

       ]);


    //    Gallary Image Insert


     $gallurl = '';

    if($request -> hasfile('file')){
        $imgs = $request -> file('file');
        foreach($imgs  as $img){
            $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            Image::make($img)->resize(290,300)->save('uploads/product/' . $unique_name);
            $gallurl = 'uploads/product/'.$unique_name;

            Gallery::insert([

                'product_id' => $product_id,
                'gallery' => $gallurl,

            ]);
        }

    }





       $msg = [
        'type' => 'success',
        'msg' => 'Product Add successfully',
        ];

       return redirect()->back()->with($msg);


    }

    /**
    * Brand Move to trash
    */


public function trash(Product $id){
    try{
        $id -> delete();
        return true;
    }catch(Exception $err){
        return false;
    }
}

  /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function showcount()
    {
        $count = Product::all() -> count();
        $trash = Product::onlyTrashed() -> count();

        $content ='<span class="badge badge-success"><a href="'.route('product.index').'" id="product_published" class="text-light text-bold"> Published '.$count.' </a></span>
        <span class="badge badge-warning"><a href="'.route('product.trash').'" id="product_trash" class="text-dark text-bold"> Trash '.$trash.'</a></span>';

        return $content;


    }

     /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function trashindex()
    {


        return view('product::trash');


    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $brands = Brand::orderBy('name_en' , 'ASC')->get();
        $tags = ProductTag::orderBy('name_en' , 'ASC')->get();
        $category = ProductCategory::whereNull('parent_id')->get();
        $product = Product::with('galleries')->where('id',$id)->first();

        // return $product;

        // $pro = json_decode($product);

        // foreach($pro as $products){
        //     return $products -> name_en;

        // }



        return view('product::edit' , compact('brands','tags','category','product'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */

     public function trashlist(){
        if (request() -> ajax()) {
            return datatables()->of(Product::onlyTrashed()->get())->addIndexColumn()->addColumn('brand' , function($data ){
                $brand = $data -> brand -> name_en;
                return $brand;
            })->addColumn('price_s' , function($data ){
                if($data -> sale_price == ''){
                    $price_s = $data -> price;
                }else{
                    $price_s ='<span>'.$data -> sale_price .'<del class="pl-3"><mark>'.$data -> price .'</mark></del></span>';
                }
                return $price_s;
            })->addColumn('time' , function($data ){
                $time =$data -> created_at -> diffForHumans();
                return $time;
            })->addColumn('action' , function($data){

                $btn = '<div class="d-flex">

                <a  href="#" product_recovery="'.$data -> id.'" class="btn btn-info" title="product recovery" id="product_recovery_id">
                <i class="fa fa-refresh"></i>
                </a> &nbsp;  &nbsp;

                <a href="#" product_del="'.$data -> id.'" id="product_fdel_id" class="btn btn-danger" title="Move to trash">
                <i class="fa fa-trash"></i></a>

                </div>';

                return $btn;

            })->rawColumns(['brand' , 'price_s' , 'time' , 'action'])->toJson();
        }
        return view('product::trash');

     }

       /**
     * Brand Data recover
     */



   public function recovery($id){

    try{
    $delete = Product::withTrashed()->find($id)->restore();
    return true;
    }catch(Exception $err){

    return false;

    }

}

 /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
            try{
                $trash = Product::onlyTrashed()->find($id);

                if(file_exists( $trash -> thumbnail)) {
                    unlink( $trash -> thumbnail);
                }

            $gallery = Gallery::where('product_id' , $id) ->get();
               foreach( $gallery  as $gall){
                    unlink($gall -> gallery);
               }


                $delete = Product::onlyTrashed()->find($id)-> forceDelete();
                return true;
            }catch(Exception $err){
                return false;
            }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function Test($id)
    {






    }




}

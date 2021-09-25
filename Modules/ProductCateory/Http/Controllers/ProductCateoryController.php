<?php

namespace Modules\ProductCateory\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Support\Renderable;
use Modules\ProductCateory\Entities\ProductCategory;
use Modules\Producttag\Entities\ProductTag;

class ProductCateoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            if (request() -> ajax()) {
                return datatables()->of(ProductCategory::latest()->whereNull('parent_id')->get())->addIndexColumn()->addColumn('category', function ($data) {

                    $content = '<ul><li>'.$data -> name_en.'<span class="float-right"><a class="text-warning" id="product_cat_edit"  href="'.route('cat.edit' , $data -> id).'" product_cat_edit="'.$data -> id.'"><i class="fa fa-edit"></i></a> &nbsp; <a  id="product_cat_del" product_cat_del="'.$data -> id.'" class="text-danger"><i class="fa fa-trash"></i></a></span> ';

                    $child1 = '';
                    foreach($data -> childcats as $child1){
                        $content .= '<ul><li> -'. $child1 -> name_en.'<span class="float-right"><a class="text-warning" id="product_cat_edit" product_cat_edit="'.$child1 -> id.'"><i class="fa fa-edit"></i></a> &nbsp; <a  id="product_cat_del" product_cat_del="'.$child1 -> id.'" class="text-danger"><i class="fa fa-trash"></i></a></span>';
                    }

                    if(!empty($child1 -> childcats)){
                        $child2 = '';
                        foreach($child1 -> childcats as $child2){
                            $content .= '<ul><li> -- '. $child2 -> name_en.'<span class="float-right"><a class="text-warning" id="product_cat_edit" product_cat_edit="'.$child2 -> id.'"><i class="fa fa-edit"></i></a> &nbsp; <a  id="product_cat_del" product_cat_del="'.$child2 -> id.'" class="text-danger"><i class="fa fa-trash"></i></a></span>';
                        }
                    }

                    if(!empty($child2 -> childcats)){
                        $child3 = '';
                       foreach($child2 -> childcats as $child3){
                        $content .= '<ul><li> --- '. $child3 -> name_en.'<span class="float-right"><a class="text-warning" id="product_cat_edit" product_cat_edit="'.$child3 -> id.'"><i class="fa fa-edit"></i></a> &nbsp; <a  id="product_cat_del" product_cat_del="'.$child3 -> id.'" class="text-danger"><i class="fa fa-trash"></i></a></span>';
                        }
                    }

                    $content .= '</li></ul></li></ul></li></ul></li></ul>';

                    return $content;


                })->rawColumns(['category'])->toJson();
            }





            return view('productcateory::index');
        } catch (Exception $err) {
            $child =  ProductCategory::latest()->get();
            return view('productcateory::index');
        }
    }

    // $child =  ProductCategory::latest()->get();
    // $arr = [];

    // foreach ($parent as $par) {
    //     foreach ($par -> childcats as $childs) {
    //         array_push($arr, $childs -> id);
    //     }
    // }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $category = ProductCategory::orderBy("name_en" , "ASC")->get();
        $cat = '';
        $cat .= '<option value="">--Select--</option>';
        foreach($category as $cats){
            $cat .= '<option value="'.$cats -> id .'">'.$cats -> name_en.'</option>';
        }

        return $cat;

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function categorystore(Request $request)
    {
        try{
            // Upload file

        $url = '';

        if($request -> hasfile('image')){

            $img = $request -> file('image');
            $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            Image::make($img)->resize(200,200)->save('uploads/category/' . $unique_name);

            $url = 'uploads/category/'.$unique_name;

        }


       ProductCategory::create([
            'name_en'  => $request-> name_en,
            'name_bn'  => $request-> name_bn,
            'slug_en'  => str_replace('-',' ', $request -> name_en),
            'slug_bn'  => str_replace('-',' ', $request -> name_bn),
            'image' => $url,
            'icon' => $request -> icon,
            'parent_id' => $request -> parent_id,

       ]);

       return true;

      }catch(Exception $err){

       return false;

      }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('productcateory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ProductCategory $id)
    {
        $category = ProductCategory::orderBy("name_en" , "ASC")->get();
        $cat = '';
        $cat .= '<option value="">--Select--</option>';
        foreach($category as $cats){
            $cat .= '<option '.($cats -> id == $id -> parent_id  ? 'selected' : '' ).'  value="'.$cats -> id .'">'.$cats -> name_en.'</option>';
        }


        return [
            'edit_data' => $id,
            'cat' => $cat,
        ];
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function catupdate(Request $request, ProductCategory $id)
    {

        try{


            $url = '';

            if($request -> hasfile('image')){
              $img = $request -> file('image');
              $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
              Image::make($img)->resize(200,200)->save('uploads/category/' . $unique_name);



              $url = 'uploads/category/'.$unique_name;

              if(file_exists($request -> old_image)) {
                  unlink($request -> old_image);
              }


              }else{
                  $url = $request -> old_image;
              }



              $parent_id = $id -> parent_id;
              $main_id = $id -> id;
              $childs = ProductCategory::where('parent_id' , $main_id)->get();

              foreach($childs as $child){
                  $child -> parent_id = $parent_id;
                  $child -> update();
              }


              $id -> name_en      = $request ->  name_en;
              $id -> name_bn      = $request ->  name_bn;
              $id -> slug_en      = str_replace('-',' ', $request -> name_en);
              $id -> slug_bn      = str_replace('-',' ', $request -> name_bn);
              $id -> parent_id      = $request ->  parent_id;
              $id -> icon      = $request ->  icon;
              $id -> image     = $url;
              $id -> update();




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
    public function delete(ProductCategory $id)
    {

        try{

            $parent_id = $id -> parent_id;
            $main_id = $id -> id;
            $childs = ProductCategory::where('parent_id' , $main_id)->get();

            foreach($childs as $child){
                $child -> parent_id = $parent_id;
                $child -> update();
            }


            if(file_exists($id -> image)) {
                unlink($id -> image);
            }

            $id-> Delete();

            return true;

        }catch(Exception $err){

            return false;
        }

    }
}

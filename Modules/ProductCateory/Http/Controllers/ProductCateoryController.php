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
        try{

            if(request() -> ajax()){
            return datatables()->of(ProductCategory::all())->addIndexColumn()->addColumn('time' , function($data){
               return $data -> created_at -> diffForHumans();
            })->addColumn('action' , function($data){

                $btn = '<div class="d-flex">

                <a  href="#" brand_edit="'.$data -> id.'" class="btn btn-info" title="Edit" id="brand_edit_id">
                <i class="fa fa-edit"></i>
                </a> &nbsp;  &nbsp;

                <a href="#" brand_trash="'.$data -> id.'" id="brand_delete_id" class="btn btn-danger" title="Move to trash">
                <i class="fa fa-trash"></i></a>

                </div>';

                return $btn;

            })->rawColumns(['time' , 'action'])->toJson();
        }

            return view('productcateory::index');
        }catch(Exception $err){
            return view('productcateory::index');
        }



    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('productcateory::create');
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
            Image::make($img)->resize(120,80)->save('uploads/category/' . $unique_name);

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
    public function edit($id)
    {
        return view('productcateory::edit');
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
    public function destroy($id)
    {
        //
    }
}

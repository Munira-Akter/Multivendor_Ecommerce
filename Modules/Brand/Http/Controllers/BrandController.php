<?php

namespace Modules\Brand\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Support\Renderable;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try{

            if(request() -> ajax()){
            return datatables()->of(Brand::all())->addIndexColumn()->addColumn('time' , function($data){
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

        return view('brand::index');

        }catch(Exception $err){
            return view('brand::index');
        }

    }

     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function trash()
    {
        try{
            if(request() -> ajax()){
            return datatables()->of(Brand::onlyTrashed()->get())->addIndexColumn()->addColumn('time' , function($data){
               return $data -> created_at -> diffForHumans();
            })->addColumn('action' , function($data){

                $btn = '<div class="d-flex">

                <a  href="#" brand_recovery="'.$data -> id.'" class="btn btn-info" title="Recover" id="brand_recover_id">
                <i class="fa fa-refresh"></i>
                </a> &nbsp;  &nbsp;

                <a href="#" brand_delete="'.$data -> id.'" id="brand_fdel_id" class="btn btn-danger" title="Permanet Delete">
                <i class="fa fa-trash"></i></a>

                </div>';

                return $btn;

            })->addColumn('photo' , function($data){
                return '<img src="'.$data.'">';
            })->rawColumns(['time' , 'action' , 'photo'])->toJson();
        }

        return view('brand::trash');

        }catch(Exception $err){
            return view('brand::trash');
        }

    }




    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function showcount()
    {
        $count = Brand::all() -> count();
        $trash = Brand::onlyTrashed() -> count();

        $content ='<span class="badge badge-success"><a href="'.route('brand.index').'" id="brand_published" class="text-light text-bold"> Published '.$count.' </a></span>
        <span class="badge badge-warning"><a href="'.route('brand.trash').'" id="brand_trash" class="text-dark text-bold"> Trash '.$trash.'</a></span>';

        return $content;


    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storebrand(Request $request)
    {

       try{
             // Upload file

         $url = '';

         if($request -> hasfile('logo')){

             $img = $request -> file('logo');
             $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
             Image::make($img)->resize(120,80)->save('uploads/brand/' . $unique_name);

             $url = 'uploads/brand/'.$unique_name;

         }


        Brand::create([
             'name_en'  => $request-> brand_en,
             'name_bn'  => $request-> brand_bn,
             'slug_en'  => str_replace('-',' ', $request -> brand_en),
             'slug_bn'  => str_replace('-',' ', $request -> brand_bn),
             'logo' => $url,

        ]);

        return true;

       }catch(Exception $err){

        return false;

       }
    }

    /**
    * Brand Move to trash
    */


public function moveTrash(Brand $id){
    try{
        $id -> delete();
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
        return view('brand::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Brand $id)
    {
       try{
           return $id;
       }catch(Exception $err){
        return false;
       }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Brand $id)
    {
      try{
        $url = '';

        if($request -> hasfile('new_logo')){
          $img = $request -> file('new_logo');
          $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
          Image::make($img)->resize(120,80)->save('uploads/brand/' . $unique_name);



          $url = 'uploads/brand/'.$unique_name;

          if(file_exists('uploads/brand/' . $request -> old_logo)) {
              unlink('uploads/brand/' . $request -> old_logo);
          }


          }else{
              $url = $request -> old_logo;
          }


          $id -> name_en = $request -> brand_en;
          $id -> name_bn =  $request -> brand_bn;
          $id ->  slug_en = str_replace('-',' ', $request -> brand_en);
          $id ->  slug_bn = str_replace('-',' ', $request -> brand_bn);
          $id -> logo     = $url;
          $id -> update();
          return true;
      }catch(Exception $err){
          return false;
      }

    }


    /**
     * Remove the specified resource from storage.`x
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
            try{
                $trash = Brand::onlyTrashed()->find($id);

                if(file_exists('uploads/brand/' . $trash -> logo)) {
                    unlink('uploads/brand/' . $trash -> logo);
                }

                $delete = Brand::onlyTrashed()->find($id)-> forceDelete();

                return true;
            }catch(Exception $err){
                return false;
            }

    }



    /**
     * Brand Data recover
     */



   public function recovery($id){

       try{
       $delete = Brand::withTrashed()->find($id)->restore();
       return true;
       }catch(Exception $err){

       return false;

       }

   }
}
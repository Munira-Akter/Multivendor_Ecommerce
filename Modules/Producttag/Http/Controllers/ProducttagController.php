<?php

namespace Modules\Producttag\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Producttag\Entities\ProductTag;

class ProducttagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
             if(request() -> ajax()){
            return datatables()->of(ProductTag::all())->addIndexColumn()->addColumn('time' , function($data){
               return $data -> created_at -> diffForHumans();
            })->addColumn('action' , function($data){

                $btn = '<div class="d-flex">

                <a  href="#" producttag_edit="'.$data -> id.'" class="btn btn-info" title="Edit" id="producttag_edit_id">
                <i class="fa fa-edit"></i>
                </a> &nbsp;  &nbsp;

                <a href="#" producttag_trash="'.$data -> id.'" id="producttag_delete_id" class="btn btn-danger" title="Move to trash">
                <i class="fa fa-trash"></i></a>

                </div>';

                return $btn;

            })->rawColumns(['time' , 'action'])->toJson();
        }


        return view('producttag::index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function trash()
    {
        try{
            if(request() -> ajax()){
            return datatables()->of(ProductTag::onlyTrashed()->get())->addIndexColumn()->addColumn('time' , function($data){
               return $data -> created_at -> diffForHumans();
            })->addColumn('action' , function($data){

                $btn = '<div class="d-flex">

                <a  href="#" Tag_recovery="'.$data -> id.'" class="btn btn-info" title="Recover" id="Tag_recover_id">
                <i class="fa fa-refresh"></i>
                </a> &nbsp;  &nbsp;

                <a href="#" Tag_delete="'.$data -> id.'" id="Tag_fdel_id" class="btn btn-danger" title="Permanet Delete">
                <i class="fa fa-trash"></i></a>

                </div>';

                return $btn;

            })->rawColumns(['time' , 'action'])->toJson();
        }

        return view('Producttag::trash');

        }catch(Exception  $err){
            return view('Producttag::trash');
        }

    }

   /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storeTag(Request $request)
    {

       try{

        ProductTag::create([
             'name_en'  => $request-> producttag_en,
             'name_bn'  => $request-> producttag_bn,
             'slug_en'  => str_replace('-',' ', $request -> producttag_en),
             'slug_bn'  => str_replace('-',' ', $request -> producttag_bn),

        ]);

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
        $count = ProductTag::all() -> count();
        $trash = ProductTag::onlyTrashed() -> count();

        $content ='<span class="badge badge-success"><a href="'.route('producttag.index').'" id="producttag_published" class="text-light text-bold"> Published '.$count.' </a></span>
        <span class="badge badge-warning"><a href="'.route('producttag.trash').'" id="producttag_trash" class="text-dark text-bold"> Trash '.$trash.'</a></span>';

        return $content;


    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ProductTag $id)
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
    public function update(Request $request, ProductTag $id)
    {
      try{

          $id ->  name_en = $request -> producttag_en;
          $id ->  name_bn =  $request -> producttag_bn;
          $id ->  slug_en = str_replace('-',' ', $request -> producttag_en);
          $id ->  slug_bn = str_replace('-',' ', $request -> producttag_bn);
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
    public function delete($id)
    {
            try{
                $delete = ProductTag::onlyTrashed()->find($id)-> forceDelete();
                return true;
            }catch(Exception $err){
                return false;
            }

    }




    /**
    * Tag Move to trash
    */


public function moveTrash(ProductTag $id){
    try{
        $id -> delete();
        return true;
    }catch(Exception $err){
        return false;
    }
}

 /**
     * Tag Data recover
     */



    public function recovery($id){

        try{
        $delete = ProductTag::withTrashed()->find($id)->restore();
        return true;
        }catch(Exception $err){

        return false;

        }

    }



}
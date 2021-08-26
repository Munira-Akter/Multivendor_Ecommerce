<?php

namespace Modules\Slider\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Slider\Entities\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Support\Renderable;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        try{

            if(request() -> ajax()){
            return datatables()->of(Slider::latest()->get())->addIndexColumn()->addColumn('action' , function($data){

                $btn = '<div class="d-flex">

                <a  href="#" slider_edit="'.$data -> id.'" class="btn btn-info" title="Slider Edit" id="slider_edit_id">
                <i class="fa fa-edit"></i>
                </a> &nbsp;  &nbsp;

                <a href="#" slider_trash="'.$data -> id.'" id="slider_fdel_id" class="btn btn-danger" title="Move to trash">
                <i class="fa fa-trash"></i></a>

                </div>';

                return $btn;

            })->rawColumns(['action'])->toJson();
        }

        return view('slider::index');

        }catch(Exception $err){
            return view('slider::index');
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('slider::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try{
            // Upload file

        $url = '';

        if($request -> hasfile('image')){

            $img = $request -> file('image');
            $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            Image::make($img)->resize(800,296)->save('uploads/slider/' . $unique_name);

            $url = 'uploads/slider/'.$unique_name;

        }


       Slider::create([
            'link'  => $request-> link,
            'image' => $url,

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
    public function status(Slider $id)
    {
       try{

        if($id -> status == true){

            $id -> status = false;
            $id->update();

        }else if($id -> status == false){
            $id -> status = true;
            $id->update();
        }

        return true;

       }catch(Exception $ree){
         return false;
       }

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Slider $id)
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
    public function sliderupdate(Request $request, Slider $id)
    {
        try{
            $url = '';

            if($request -> hasfile('new_image')){
              $img = $request -> file('new_image');
              $unique_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
              Image::make($img)->resize(800,296)->save('uploads/slider/' . $unique_name);



              $url = 'uploads/slider/'.$unique_name;

              if(file_exists('uploads/slider/' . $request -> old_image)) {
                  unlink('uploads/slider/' . $request -> old_image);
              }


              }else{
                  $url = $request -> old_image;
              }

              $id -> link      = $request ->  link;
              $id -> image     = "ki";
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
    public function delete(Slider $id)
    {
            try{
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
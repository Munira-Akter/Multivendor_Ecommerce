<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all() -> count();
        $trashs = Tag::onlyTrashed()->count();
        return view('admin.blog.tag.index' , compact('tags' ,  'trashs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'blog_tag_name_en' => 'required',
            'blog_tag_name_lng' => 'required',
         ]);

        tag::create([
            'tag_name_en'        => $request -> blog_tag_name_en,
            'tag_name_lng'       => $request -> blog_tag_name_lng,
            'tag_name_en_slug'   => strtolower(str_replace(' ' , '-' , $request -> blog_tag_name_en)),
            'tag_name_lng_slug'  => str_replace(' ' , '-' , $request -> blog_tag_name_lng),
        ]);

    }

    //admin panel blog tag section show

    public function all(){
        $tags = Tag::latest()->get();
        $count = $tags -> count();
        $content = '';
        if($count > 0){

            foreach ($tags as $tag) {
                $content .= '<tr>';
                $content .= '<td>'. $tag -> tag_name_en .'</td>';
                $content .= '<td>'. $tag -> tag_name_lng .'</td>';
                $content .= '<td>

                <a  edit_id='. $tag -> id .' class="btn btn-info" title="Recovery tag" id="tag_edit_id">
                <i class="fa fa-edit"></i>
                </a>

                <a href="#" delete_id='. $tag -> id .'  id="tag_delete_id" class="btn btn-danger" title="Permanently Delete" id="cat_trash_id">
                <i class="fa fa-trash"></i></a>

                </td>';
                $content .= '</tr>';
            }

        }else{


            $content .= '<tr>';
            $content .= '<td colspan="3" class="text-center">No Tag Added Yet</td>';
            $content .= '</tr>';


        }
        return $content;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $update)
    {
        $update -> tag_name_en = $request -> blog_tag_name_en;
        $update -> tag_name_lng      = $request -> blog_tag_name_lng;
        $update -> tag_name_en_slug  = strtolower(str_replace(' ' , '-' , $request -> blog_tag_name_en));
        $update ->  tag_name_lng_slug  = str_replace(' ' , '-' , $request -> blog_tag_name_lng);
        $update -> update();
        return true;
    }


    /**
     * Tag Index show
     */

    public function trash(){
        $count = Tag::all()->count();
        $trash_count = Tag::onlyTrashed()->count();
        return view('admin.blog.tag.trash' , compact('count' , 'trash_count'));
    }


     //admin panel trash  show

     public function trashAll(){
        $trashs = Tag::onlyTrashed()->latest()->get();
        $trash_count = $trashs -> count();
        $content = '';
        if($trash_count > 0){

            foreach ($trashs as $trash) {
                $content .= '<tr>';
                $content .= '<td>'. $trash -> tag_name_en .'</td>';
                $content .= '<td>'. $trash -> tag_name_lng .'</td>';
                $content .= '<td> <a href="#" recovery_id='. $trash -> id .' class="btn btn-info" title="Recovery tag" id="tag_trash_recovery_id"> <i class="fa fa-refresh"></i> </a>
                    <a href="#" delete_id='. $trash -> id .' class="btn btn-danger" title="Permanently Delete" id="tag_trash_delete_id">
                    <i class="fa fa-trash"></i></a> </td>';
                $content .= '</tr>';
            }

        }else{


            $content .= '<tr>';
            $content .= '<td colspan="3" class="text-center">No Tag Deleted Yet</td>';
            $content .= '</tr>';


        }
        return $content;
    }




    /**
     * Tag Move to trash
     */


    public function moveTrash(Tag $trash){
        $trash -> delete();
        return true;
    }



     /**
     * tag Rocovery from trash
     */

    public function restore($id){
        $delete = Tag::withTrashed()->find($id)->restore();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
        $delete = Tag::onlyTrashed() -> find($id) ->  forceDelete();
        return true;
    }



}

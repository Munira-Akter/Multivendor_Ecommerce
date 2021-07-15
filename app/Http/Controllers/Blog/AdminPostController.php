<?php

namespace App\Http\Controllers\Blog;

use App\Models\Admin;
use App\Models\Blog\Tag;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all() -> count();
        $trashs = Post::onlyTrashed()->count();
        return view('admin.blog.post.index' , compact('posts','trashs'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $posts = Post::latest()->get();
        $count = Post::all() -> count();

        $content = '';
        $i = 1;


        foreach ($posts as $post) {

            if ($count > 0) {
                        $content .= '<tr>';
                        $content .= '<td>'. $i ; $i++ .'</td>';
                        $content .= '<td>'. $post -> title .'</td>';

                        $content .= '<td>';
                            foreach ($post -> categories as $category) {
                              $content .= '<span class="badge badge-dark">'. $category -> category_name_en .'</span>' ;
                            }
                        $content .= '</td>';

                        $content .= '<td>';

                        foreach ($post -> tags as $tag) {
                             $content .= '<span class="badge badge-light">'. $tag -> tag_name_en .'</span>' ;
                        }
                         $content .= '</td>';


                        $content .= '<td>'.  $post ->  user -> name  . '</td>';
                        $content .= '<td>'.  $post -> content  . '</td>';

                        $feature = json_decode($post -> feature);

                        if($feature -> post_type == 'Image'){
                            $content .=  '<td><img style="height:50px; width:50px;" src="'.asset('').'uploads/post/' . $feature -> image . '"></td>';
                        }
                        if($feature -> post_type == 'Gallery'){
                            $content .=  '<td>';
                            foreach($feature -> gallery as $gallary_img){
                              $content .= '<img style="height:50px; width:50px;" src="'.asset('').'uploads/post/' .  $gallary_img . ' " >';
                            }

                            $content .= '</td>';
                        }
                        if($feature -> post_type == 'Video'){
                            $content .=  '<td><div id="iframe_video">' . $feature -> video . '</div></td>';
                        }

                        if($feature -> post_type == 'Audio'){
                                $content .=  '<td><audio controls><source src="uploads/post/'. $feature -> audio  .'" type="audio/mpeg"></audio></td>';
                        }

                        $content .= '<td><div class="d-flex">

                <a  href='. route('post.edit', $post -> id) .' class="btn btn-info" title="Recovery tag" id="post_edit_id">
                <i class="fa fa-edit"></i>
                </a>

                <a href="#" delete_id='. $post -> id .'  id="post_delete_id" class="btn btn-danger" title="Permanently Delete" id="cat_trash_id">
                <i class="fa fa-trash"></i></a>

                </div></td>';
                        $content .= '</tr>';
                    }
                }


        return $content;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.blog.post.post_store' , compact('categories','tags'));
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
            'post_type' => 'required',
            'title' => 'required | max:100 | min:10',
         ]);

         /** Single Image File */

         $image = '';

         if($request -> hasFile('image')){
             $image_file = $request -> image;
            //  Unique name genarator
            $image = md5(time().rand()) . '.' . $image_file -> getClientOriginalExtension();
            // Move Image to folder
            $image_file -> move(public_path('uploads/post/') , $image);
         }

          /** Single Image File */

          $gallary = [];

          if($request -> hasFile('gallery')){
              $gallery_file = $request -> gallery;
              foreach($gallery_file as $gall){
                 //  Unique name genarator
                $gallary_name = md5(time().rand()) . '.' . $gall -> getClientOriginalExtension();
                // Move Image to folder
                $gall -> move(public_path('uploads/post/') , $gallary_name);
                // Array push one by one gallaery image
                array_push($gallary , $gallary_name);
              }

          }

          /** Audio  File */

          $audio_name  = '';

          if($request -> hasFile('audio')){
              $audio_file = $request -> audio;
              //  Unique name genarator
              $audio_name = md5(time().rand()) . '.' .  $audio_file -> getClientOriginalExtension();
              // Move Image to folder
              $audio_file -> move(public_path('uploads/post/') , $audio_name );

          }

          $feature = [];

          $feature = [
              'post_type' => $request -> post_type,
              'image' => $image,
              'gallery' => $gallary,
              'video'   => $request -> video,
              'audio'   => $audio_name ,
          ];

         $post =  Post::create([
            'title'   => $request -> title,
            'slug'    => str_replace(' ' , '-' , $request -> title),
            'content' => $request -> content,
            'feature' => json_encode($feature),
            'user_id' => 1,
          ]);

          $post -> categories() -> attach($request -> category);
          $post -> tags() -> attach($request -> tag);

        $msg = [
            'type' => 'success',
            'msg' => 'Category Add successfully',
        ];

        return redirect() -> back() -> with($msg);

    }
      /**
     * Tag Index show
     */

    public function trash(){
        $count = Post::all()->count();
        $trash_count = Post::onlyTrashed()->count();
        return view('admin.blog.post.trash' , compact('count' , 'trash_count'));
    }


     /**
     * Post Move to trash
     */


    public function moveTrash(Post $trash){
        $trash -> delete();
        return true;
    }

    /**
     * tag Rocovery from trash
     */

    public function restore($id){
        $delete = Post::withTrashed()->find($id)->restore();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
        $delete = Post::onlyTrashed() -> find($id) ->  forceDelete();
        return true;
    }




    //admin panel trash  show

    public function trashAll(){
        $trashs = Post::onlyTrashed()->latest()->get();
        $trash_count = $trashs -> count();
        $content = '';
        if($trash_count > 0){

            $i = 1;

            foreach ($trashs as $trash) {
                $content .= '<tr>';
                $content .= '<td>'. $i ; $i++ .'</td>';
                $content .= '<td>'. $trash -> title .'</td>';

                $content .= '<td>';
                    foreach ($trash -> categories as $category) {
                      $content .= '<span class="badge badge-dark">'. $category -> category_name_en .'</span>' ;
                    }
                $content .= '</td>';

                $content .= '<td>';

                foreach ($trash -> tags as $tag) {
                     $content .= '<span class="badge badge-light">'. $tag -> tag_name_en .'</span>' ;
                }
                 $content .= '</td>';


                $content .= '<td>'.  $trash ->  user -> name  . '</td>';
                $content .= '<td>'.  $trash -> content  . '</td>';

                $feature = json_decode($trash -> feature);

                if($feature -> post_type == 'Image'){
                    $content .=  '<td><img style="height:50px; width:50px;" src="'.asset('').'uploads/post/' . $feature -> image . '"></td>';
                }
                if($feature -> post_type == 'Gallery'){
                    $content .=  '<td>';
                    foreach($feature -> gallery as $gallary_img){
                      $content .= '<img style="height:50px; width:50px;" src="'.asset('').'uploads/post/' .  $gallary_img . ' " >';
                    }

                    $content .= '</td>';
                }
                if($feature -> post_type == 'Video'){
                    $content .=  '<td><div id="iframe_video">' . $feature -> video . '</div></td>';
                }

                if($feature -> post_type == 'Audio'){
                        $content .=  '<td><audio controls><source src="uploads/post/'. $feature -> audio  .'" type="audio/mpeg"></audio></td>';
                }

                $content .= '<td><div class="d-flex">

                <a href="#" recovery_id='. $trash -> id .' class="btn btn-info" title="Recovery tag" id="post_trash_recovery_id"> <i class="fa fa-refresh"></i> </a>
                <a href="#" delete_id='. $trash -> id .' class="btn btn-danger" title="Permanently Delete" id="post_trash_delete_id">
                <i class="fa fa-trash"></i></a>
        </div></td>';
                $content .= '</tr>';
            }

        }else{


            $content .= '<tr>';
            $content .= '<td colspan="9" class="text-center">No Post Deleted Yet</td>';
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
         return view('admin.blog.post.post_edit' , compact('post' , 'categories' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepost(Request $request, Post $update)
    {
       $update -> title = $request -> title;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
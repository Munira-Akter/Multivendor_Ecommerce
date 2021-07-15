<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Tag;
use App\Models\Blog\Post;
use App\Models\Blog\Comment;
use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   //index file load
   public function index(){
    $posts = Post::all();
    return  view('forntend.blog.index' , compact('posts'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function all()
    // {
    //     $posts = Post::all()->get();
    //     $content = '';
    //     foreach ($posts as $post){
    //         $feature = json_decode($post -> feature);

    //         $content .= '<div class="card mb-3 overflow-hidden shadow-sm">';
    //         if($feature -> post_type == 'Image'){
    //             $content .='<a href="blog/t-shirts-every-man-needs-in-his-wardrobe.html" class="text-reset d-block">
    //             <img src="uploads/post/'. $feature -> image .'"
    //                 alt="'.$post -> title.'"
    //                 class="img-fluid ls-is-cached lazyloaded">
    //         </a>';
    //         }

    //         if($feature -> post_type == 'Video'){
    //             $content .=' <div id="blade_iframe">'.$feature -> video.'</div>';
    //         }

    //         if($feature -> post_type == 'Gallery'){
    //             foreach ($feature -> gallery as $key => $gallary) {
    //                 if($key == 0){
    //                     $content .='<a href="blog/t-shirts-every-man-needs-in-his-wardrobe.html" class="text-reset d-block">
    //                     <img style="height: 300px;
    //                     width: 100%;" src="uploads/post/'. $gallary .'"
    //                         alt="'.$post -> title.'"
    //                         class="img-fluid ls-is-cached lazyloaded">
    //                 </a>';
    //                 }

    //             }
    //         }

    //         if($feature -> post_type == 'Audio'){
    //             $content .='<audio class="mt-5 text-center" style="margin-left:11px;" preload="auto" controls>
    //             <source src="uploads/post/' . $feature -> audio . '">
    //           </audio>';
    //         }
    //         $content .='<div class="p-4">
    //         <h2 class="fs-18 fw-600 mb-1">
    //             <a href="blog/t-shirts-every-man-needs-in-his-wardrobe.html" class="text-reset">
    //               '.$post -> title.'
    //             </a>
    //         </h2>

    //         <div class="mb-2 opacity-50">';


    //          foreach ($post -> categories as $category){
    //             $content .= '<i>'.$category -> category_name_en .'</i>';
    //          }

    //         $content .='</div>
    //         <p class="opacity-70 mb-4 post_content">
    //            '.$post -> content.'
    //         </p>
    //         <a href="blog/t-shirts-every-man-needs-in-his-wardrobe.html" class="btn btn-soft-primary">
    //             View More
    //         </a>
    //      </div>';


    //     $content .= '</div>';





    //     }


    //     return $content;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function latest()
     {
        $posts = Post::latest()->get();
        return  view('forntend.blog.latest_blog' , compact('posts'));
     }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request)
     {
        $search =  $request -> search;

        $posts =  Post::where('title', 'LIKE' , '%'. $search .'%')
                     -> orwhere('content' , 'LIKE' , '%' . $search .'%')
                     -> get();

        return view('forntend.blog.search_blog',[
                'posts'  => $posts,
        ]);
     }



     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single(Post $slug)
    {
       return view('forntend.blog.single_blog',[
               'post'  => $slug,
       ]);
    }






      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function category(Category $slug)
     {
        $posts = $slug -> posts;
        return  view('forntend.blog.category_post' , compact('posts'));
     }



      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function tag(Request $request)
     {
            $tags = $request -> tags;

            $tag = Tag::whereIn('id' , $tags) -> get();

            foreach($tag as $tags){
              $posts = $tags -> posts;
              return  view('forntend.blog.tag_post' , compact('posts'));
            }
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function commentuser(Request $request)
    {

        $comment = new Comment();
        $comment -> name = $request -> name;
        $comment -> email = $request -> email;
        $comment -> comment = $request -> comment;
        $comment -> save();


        // $request -> validate([
        //     'comment' => 'required',
        //     'name' => 'required',
        //     'email' => 'required',
        //  ]);


        //  Comment::create([
        //     'name'   => $request -> name,
        //     'email' => $request -> email,
        //     'comment' => $request -> comment,
        //   ]);

        return response()->json($comment);


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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

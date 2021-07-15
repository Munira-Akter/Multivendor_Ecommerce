<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    //admin panel blog section show

    public function all(){
        $categories = Category::latest()->get();
        $count = $categories -> count();
        $content = '';
        if($count > 0){

            foreach ($categories as $category) {
                $content .= '<tr>';
                $content .= '<td>'. $category -> category_name_en .'</td>';
                $content .= '<td>'. $category -> category_name_lng .'</td>';
                $content .= '<td>

                <a  edit_id='. $category -> id .' class="btn btn-info" title="Recovery Category" id="cat_edit_id">
                <i class="fa fa-edit"></i>
                </a>

                <a href="#" delete_id='. $category -> id .'  id="category_delete_id" class="btn btn-danger" title="Permanently Delete" id="cat_trash_id">
                <i class="fa fa-trash"></i></a>

                </td>';
                $content .= '</tr>';
            }

        }else{


            $content .= '<tr>';
            $content .= '<td colspan="3">No Category Added Yet</td>';
            $content .= '</tr>';


        }
        return $content;
    }

    //admin panel trash  show

    public function trash(){
        $trashs = Category::onlyTrashed()->latest()->get();
        $trash_count = $trashs -> count();
        $content = '';
        if($trash_count > 0){

            foreach ($trashs as $trash) {
                $content .= '<tr>';
                $content .= '<td>'. $trash -> category_name_en .'</td>';
                $content .= '<td>'. $trash -> category_name_lng .'</td>';
                $content .= '<td> <a href="#" recovery_id='. $trash -> id .' class="btn btn-info" title="Recovery Category" id="cat_trash_recovery_id"> <i class="fa fa-refresh"></i> </a>
                    <a href="#" delete_id='. $trash -> id .' class="btn btn-danger" title="Permanently Delete" id="cat_trash_delete_id">
                    <i class="fa fa-trash"></i></a> </td>';
                $content .= '</tr>';
            }

        }else{


            $content .= '<tr>';
            $content .= '<td colspan="3" class="text-center">No Category Deleted Yet</td>';
            $content .= '</tr>';


        }
        return $content;
    }

    //admin panel blog section show

    public function index(){
        $count = Category::all() -> count();
        $trashs = Category::onlyTrashed()->latest()->get();
        $trash_count = $trashs -> count();
        return view('admin.blog.category.index' , compact('count','trash_count'));
    }

    //admin panel blog category edit

    public function edit(Category $edit){
        return $edit;
    }

    //admin panel blog category edit

     public function update(Request $request ,Category $update){
        $update -> category_name_en = $request -> blog_category_name_en;
        $update -> category_name_lng      = $request -> blog_category_name_lng;
        $update -> category_name_en_slug  = strtolower(str_replace(' ' , '-' , $request -> blog_category_name_en));
        $update ->  category_name_lng_slug  = str_replace(' ' , '-' , $request -> blog_category_name_lng);
        $update -> update();
        return true;
    }


     //admin panel blog section show

     public function trashindex(){
        $categories = Category::latest()->get();
        $count = $categories -> count();
        $trashs = Category::onlyTrashed()->latest()->get();
        $trash_count = $trashs -> count();
        return view('admin.blog.category.trash' , compact('count' , 'trashs' , 'trash_count'));
    }


     //admin panel category add

     public function store(Request $request){

        $request -> validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_lng' => 'required',
         ]);

        Category::create([
            'category_name_en'        => $request -> blog_category_name_en,
            'category_name_lng'       => $request -> blog_category_name_lng,
            'category_name_en_slug'   => strtolower(str_replace(' ' , '-' , $request -> blog_category_name_en)),
            'category_name_lng_slug'  => str_replace(' ' , '-' , $request -> blog_category_name_lng),
        ]);

        $msg = [
            'type' => 'success',
            'msg' => 'Category Add successfully',
        ];

        return redirect() -> back() -> with($msg);
    }

    /**
     * Category Move to trash
     */


    public function moveTrash(Category $delete){
        $delete -> delete();
        return true;
    }

     /**
     * Category Rocovery from trash
     */


    public function recovery($id){
        $delete = Category::withTrashed()->find($id)->restore();
    }

     /**
     * Category Rocovery from trash
     */


   public function destroy($id){
    $delete = Category::onlyTrashed() -> find($id)->  forceDelete();
    return true;
   }



}

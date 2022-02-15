<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\Tag;

class apiController extends Controller
{
    public function blogIndex(){
        return Blog::all();
    //     foreach(Blog::all() as $blogs){
    //     $response = [
    //         'Blog_id' => $blogs->blog_id,
    //         'Title' => $blogs->title,
    //         'Category_id'  => $blogs->category_id,
    //         'Content' => $blogs->content,
    //         'user_id' => $blogs->user_id,
    //         'Blog_image' =>  asset('storage/blog_images/' . $blogs->blog_image),
    //     ];
    //     return response($response);
    // }
    }

    public function blogStore(Request $request){
        $this-> validate($request, [
            // 'blog'  => 'required',
            'content' => 'required',
            // 'blog_image' => 'image|nullable|max:1999',
            'category_id' => 'required' 
         ]);

        return Blog::create($request->all());
    }

    public function blogShow($id){
        $blog = Blog::find($id);
        return [
            'Blog_id' => $blog->blog_id,
            'Title' => $blog->title,
            'Category_id'  => $blog->category_id,
            'Content' => $blog->content,
            'user_id' => $blog->user_id,
            'Blog_image' =>  asset('storage/blog_images/' . $blog->blog_image),
        ];
    }

    public function blogShowCategory($id){
        $blog =Blog::find($id);
        $categoryId = $blog->category_id;
        return Category::find($categoryId);
    }

    public function blogShowTag($id){
        $tagIds = BlogTag::where('blog_id', $id)->pluck('tag_id');
        return Tag::whereIn('tag_id', $tagIds)->get();
    }

    public function blogSearch($title){
        return Blog::where('title','like','%'.$title.'%')->get();
    }

    public function categoryIndex(){
        return Category::all();
    }

    public function categoryShow($id){
        return Category::find($id);
    }

    public function categorySearch($category_name){
        return Category::where('category_name','like','%'.$category_name.'%')->get();
    }

    public function categoryShowBlog($id){
        return Blog::where(['category_id' =>$id])->get();
    }

    public function tagIndex(){
        return Tag::all();
    }

    public function tagShow($id){
        return Tag::find($id);
    }

    public function tagSearch($tag_name){
        return Tag::where('tag_name','like','%'.$tag_name.'%')->get();
    }

    public function tagShowBlog($id){
        $blogIds = BlogTag::where('tag_id', $id)->pluck('blog_id');
        return Blog::whereIn('blog_id', $blogIds)->get();
    }
}

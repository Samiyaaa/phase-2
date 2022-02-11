<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\Tag;

class BlogsController extends Controller
{
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at','desc')->Paginate(3); 
        // $blogTag =BlogTag::all();
        // $tags  = Tag::all();     
        return view('blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('category_name','category_id');
        $tags = Tag::pluck('tag_name','tag_id');
        return view('blogs.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('tag_ids'));
        $this-> validate($request, [
            'title'  => 'required|unique:blogs,title',
            'content' => 'required',
            'blog_image' => 'image|nullable|max:1999',
            'category_id' => 'required' 
         ]);
         //handle file upload
         if ($request->hasFile('blog_image')) {
         //Get filename with extension
         $filenameWithExt = $request->file('blog_image')->getClientOriginalName();
         //Get Filename only
         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         //Get extension only
         $fileExtension = $request->file('blog_image')->getClientOriginalExtension();
         //Filename To store
         $filenameToStore = $filename.'_'.time().'.'.$fileExtension;
         //upload Image
         $path = $request->file('blog_image')->storeAs('public/blog_images', $filenameToStore );
         }
         else{
             $filenameToStore = 'noimage.jpg';
         }
         //Create blog
         $blog = new Blog;
        
         $blog->title = $request->input('title');
         $blog->content =  $request->input('content');
         $blog->category_id = $request->input('category_id');
         $blog->blog_image = $filenameToStore;
         $blog->user_id= auth()->user()->id;
         $blog->save();
         foreach($request->input('tag_ids') as $tag_id){
            $blogTag = new BlogTag;
            // $id = $blog->blog_id;
            $blogTag->tag_id = $tag_id;
            $blogTag->blog_id = $blog->blog_id;
            $blogTag->save();  
         }
        
         return redirect('/blogs')->with('success', 'Blog created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($blog_id)
    { 
        // $categories = Category::pluck('category_name','category_id');
        $blog = Blog::find($blog_id);
        return view('blogs.show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blog_id)
    { 
        
        $categories = Category::pluck('category_name','category_id');
        $tags = Tag::pluck('tag_name','tag_id');
        $blogTag = BlogTag::where(['blog_id' => $blog_id])->get();
        $tagId = $blogTag->tag_id;
        $selectedTags = Tag::where('tag_id', $tagId)->get();
        $blog = Blog::find($blog_id);
        if(auth()->user()->id !== $blog->user_id){
            return redirect('/blogs')->with('error','Unautherized Page!');
        }
        return view('blogs.edit',compact('categories','blog','tags','selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blog_id)
    {
         //handle file upload
         if ($request->hasFile('blog_image')) {
            //Get filename with extension
            $filenameWithExt = $request->file('blog_image')->getClientOriginalName();
            //Get Filename only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get extension only
            $fileExtension = $request->file('blog_image')->getClientOriginalExtension();
            //Filename To store
            $filenameToStore = $filename.'_'.time().'.'.$fileExtension;
            //upload Image
            $path = $request->file('blog_image')->storeAs('public/blog_images', $filenameToStore );
        }

        $this-> validate($request, [
            'title'  => 'required',
            'content' => 'required',
            'blog_image' => 'image|nullable|max:1999',
            'category_id' => 'required' 
         ]);
         
         $blog = Blog::find($blog_id);
         $blog->title = $request->input('title');
         $blog->category_id = $request->input('category_id');
         $blog->content =  $request->input('content');
         if ($request->hasFile('blog_image')) {
            $blog->blog_image = $filenameToStore;
         }
         $blog->save();

         // Get role id
         $inputTagId = $request->input('tag_ids');

         // Check if blog has tag
         $blogTag = BlogTag::where([
             'tag_id' => $inputTagId,
             'blog_id' => $blog->blog_id
         ])->first();

         if($blogTag == null){
             // delete prev tag
             $prevBlogTag = BlogTag::where('blog_id', $blog->blog_id)->first();
             $prevBlogTag->delete();

             $newBlogTag = new BlogTag;
             $newBlogTag->blog_id = $blog->blog_id;
             $newBlogTag->tag_id = $inputTagId;
             $newBlogTag->save();
         }
 
         return redirect('/blogs')->with('success', 'Blog updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog_id)
    {
        $blog = Blog::find($blog_id);
         if(auth()->user()->id !== $blog->user_id){
            return redirect('/blogs')->with('error','Unautherized Page!');
         }
         if ($blog->blog_image !== 'noimage.jpg') {
             Storage::delete('public/blog_images/'.$blog->blog_image);
         }
         $blog->blogTag()->delete();
         $blog->delete();
 
         return redirect('/blogs')->with('success', 'Blog deleted');
    
    }
}

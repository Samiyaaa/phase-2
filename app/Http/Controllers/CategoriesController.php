<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoriesController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('category_name','asc')->Paginate(5); 
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this-> validate($request, [
            'category'  => 'required',
            'category_desc' => 'required',
            'category_image' => 'image|nullable|max:1999'
         ]);
         //handle file upload
         if ($request->hasFile('category_image')) {
         //Get filename with extension
         $filenameWithExt = $request->file('category_image')->getClientOriginalName();
         //Get Filename only
         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         //Get extension only
         $fileExtension = $request->file('category_image')->getClientOriginalExtension();
         //Filename To store
         $filenameToStore = $filename.'_'.time().'.'.$fileExtension;
         //upload Image
         $path = $request->file('category_image')->storeAs('public/category_images', $filenameToStore );
         }
         else{
             $filenameToStore = 'noimage.jpg';
         }
         //Create Category
         $category = new Category;
         $category->category_name = $request->input('category');
         $category->category_desc =  $request->input('category_desc');
         $category->category_image = $filenameToStore;
         $check = Category::where('category_name', '=',  $request->input('category'))->first();
         if($check === null){
           $category->save();
           return redirect('/categories')->with('success', 'category created');  
        }
        else{
            return redirect('/categories')->with('error', 'Category Already Exist');
        }
         
         
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id)
    {
        $category = Category::find($category_id);
        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id)
    {
         //handle file upload
         if ($request->hasFile('category_image')) {
            //Get filename with extension
            $filenameWithExt = $request->file('category_image')->getClientOriginalName();
            //Get Filename only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get extension only
            $fileExtension = $request->file('category_image')->getClientOriginalExtension();
            //Filename To store
            $filenameToStore = $filename.'_'.time().'.'.$fileExtension;
            //upload Image
            $path = $request->file('category_image')->storeAs('public/category_images', $filenameToStore );
        }

        $this-> validate($request, [
            'category'  => 'required',
            'category_desc' => 'required',
            'category_image' => 'image|nullable|max:1999' 
         ]);
         
         $category = Category::find($category_id);
         $category->category_name = $request->input('category');
         $category->category_desc =  $request->input('category_desc');
         if ($request->hasFile('category_image')) {
            $category->category_image = $filenameToStore;
         }
         $category->save();
 
         return redirect('/categories')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        if ($category->category_image !== 'noimage.jpg') {
            Storage::delete('public/category_images/'.$category->category_image);
        }
        $category->delete();

        return redirect('/categories')->with('success', 'Category deleted');
   
   
    }
}

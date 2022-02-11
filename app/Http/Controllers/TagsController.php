<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;

class TagsController extends Controller
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
        $tags = Tag::orderBy('tag_name','asc')->Paginate(5); 
        return view('tags.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'tag'  => 'required'
         ]);
         
         $tag = new Tag;
         $tag->tag_name = $request->input('tag');
         $checkTag = Tag::where('tag_name', '=',  $request->input('tag'))->first();
         if($checkTag === null){
           $tag->save();
           return redirect('/tags')->with('success', 'Tag created');  
        }
        else{
            return redirect('/tags')->with('error', 'Tag Already Exist');
        }
         
 
         
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
    public function edit($tag_id)
    {
        $tag = Tag::find($tag_id);
        return view('tags.edit')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tag_id)
    {
        $tag = Tag::find($tag_id);
        $tag->tag_name = $request->input('tag');
        $tag->save();
 
        return redirect('/tags')->with('success', 'Tag updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag_id)
    {
        $tag = Tag::find($tag_id);
        $tag->delete();
        return redirect('/tags')->with('success', 'Tag Deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\tag;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
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
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=> 'required',
            'tags'=> 'exists:tags,id',
            'newTags'=>'nullable',
            'category_id'=>'nullable|exists:categories,id' // Quello che mi hai passato, nella tabella cagtegories esiste l'id?
        ]);
        $formData=$request->all();
        
        $newPost = new Post();
        // storiamo i dati con il metodo fill
        $newPost->fill($formData);
        

        if($formData['newTags']){
            $tagNames = explode(',',$formData['newTags']);
            foreach($tagNames as $tagName){
                $incluedTags=false;
                $oldTag = Tag::where('name',$tagName)->first();//controllo se gia esiste un tag con lo stesso no
                if(isset($formData['tags']) && $oldTag){ //controllo se esiste gia l'array tags in formData
                    if(in_array($oldTag->id,$formData['tags'])){
                        $tagName=null; //setto iltag name a null se gia esiste un altro  
                    }
                }
                
                if($oldTag){
                    
                    if(isset($formData['tags'])){ //controllo se esiste gia l'array tags in formData
                        if(!(in_array($oldTag->id,$formData['tags']))){
                            array_push($formData['tags'],strval($oldTag->id) ); //agiungo id al formData 
                        }
                    }else{
                        $formData['tags'] = [strval($oldTag->id)];
                    }
                }
                else if($tagName){
                    $newTag = new Tag;
                    $newTag->name = $tagName;
                    $newTag->slug = Str::slug($tagName, '-');
                    $newTag->save();
                    if(isset($formData['tags'])){
                        array_push($formData['tags'],strval($newTag->id) );//agiungo id al array tags di form data
                    }else{
                        $formData['tags'] = [strval($newTag->id)];
                    }
                }
            }
        }
        //dd($formData['tags']);
        // Generiamo lo slug
        /*
            Titolo: il mio post
            Slug: il-mio-post
        */
        $slug = Str::slug($newPost->title, '-');

        $slug_presente = Post::where('slug', $slug)->first();
        $contatore = 1;
        while($slug_presente){
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore++;
        }

        $newPost->slug = $slug;
        $newPost->save();
        //$newPost->tags()->attach($formData['tags']);
        if(isset($formData['tags'])){
            
            $newPost->tags()->attach($formData['tags']);
        }
        return redirect()->route('admin.posts.index')->with('inserted', 'Il record è stato correttamente salvato');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        if(!$post){
            abort(404);
        }return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post){
            abort(404);
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // salviamo in una var 
        $request->validate([
            'title'=>'required|max:255',
            'content'=> 'required',
            'tags'=> 'exists:tags,id',
            'newTags'=>'nullable',
            'category_id'=>'nullable|exists:categories,id' // Quello che mi hai passato, nella tabella cagtegories esiste l'id?
        ]);
        $formData = $request->all();
        
        if($formData['newTags']){
            $tagNames = explode(',',$formData['newTags']);
            foreach($tagNames as $tagName){
                $incluedTags=false;
                $oldTag = Tag::where('name',$tagName)->first();//controllo se gia esiste un tag con lo stesso no
                if(isset($formData['tags']) && $oldTag){ //controllo se esiste gia l'array tags in formData
                    if(in_array($oldTag->id,$formData['tags'])){
                        $tagName=null; //setto iltag name a null se gia esiste un altro  
                    }
                }
                
                if($oldTag){
                    
                    if(isset($formData['tags'])){ //controllo se esiste gia l'array tags in formData
                        if(!(in_array($oldTag->id,$formData['tags']))){
                            array_push($formData['tags'],strval($oldTag->id) ); //agiungo id al formData 
                        }
                    }else{
                        $formData['tags'] = [strval($oldTag->id)];
                    }
                }
                else if($tagName){
                    $newTag = new Tag;
                    $newTag->name = $tagName;
                    $newTag->slug = Str::slug($tagName, '-');
                    $newTag->save();
                    if(isset($formData['tags'])){
                        array_push($formData['tags'],strval($newTag->id) );//agiungo id al array tags di form data
                    }else{
                        $formData['tags'] = [strval($newTag->id)];
                    }
                }
            }
        }

        if($formData['title'] != $post->title){
            $slug = Str::slug($formData['title'], '-');

            $slug_presente = Post::where('slug', $slug)->first();
            $contatore = 1;
            while($slug_presente){
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            }
            $formData['slug'] = $slug;
        }

        $post->update($formData);
        if(array_key_exists('tags', $formData)){
            $post->tags()->sync($formData['tags']);
        }
        else{
            $post->tags()->sync([]);
        }
        return redirect()->route('admin.posts.index')->with('updated', 'Post correttamente aggiornato');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Models\User;

class PostController extends Controller{


    //管理者ページ


    public function Alclist(){

    	$list = Post::where('type','article')->get();
    	return view('Alcviews.Alclist',['list'=>$list]);
    }

    public function Alcform(){

        $categories = Taxonomy::where('type','category')->get();
        $tags = Taxonomy::where('type','tag')->get();
        $plists = Post::where('type','attachment')->get();
        return view('Alcviews.Alcform',['categories'=>$categories,'tags'=>$tags,'plists'=>$plists]);
    }

    public function form(Request $request){

        $validataedData = $request->validate([

        	'title' => 'required|string|max:200',
        	'content' => 'required|string',
        	'slug' => 'required|string|max:200',
        	'status' => 'required|string',
            'image' => 'required'
        ]);

        $post = new Post();
        $post->user_id = auth()->id();
        $post->mime_type = $request->image;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->save();

        $post->taxonomy()->attach($request->category);
        $post->taxonomy()->attach($request->tag);

        return redirect('Alclist');
    }


    public function Alcedit($id){

        $categories = Taxonomy::where('type','category')->get();
        $tags = Taxonomy::where('type','tag')->get();
        $plists = Post::where('type','attachment')->get();

        $post=Post::find($id);
        $image=Post::find($post->mime_type);
        $linked_taxonomy = $post->taxonomy;

        if(is_null($post)){
            return redirect('Alcviews.Alclist');
        }

        return view('Alcviews.Alcedit',['post'=>$post,'categories'=>$categories,'tags'=>$tags,'linked_taxonomy'=>$linked_taxonomy,'plists'=>$plists]);
    }

    public function edit(Request $request){

        $request->validate([

            'id' => 'required',
            'title' => 'required|string',
            'content' => 'required|string',
            'slug' => 'required|string',
            'status' => 'required|string'
        ]);

        $id = auth()->id();

        $post=Post::find($request->id);
        $post->user_id = $id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->mime_type = $request->image;
        $post->save();

        $post->taxonomy()->sync($request->category);
        $post->taxonomy()->attach($request->tag);

        return redirect('Alclist');
    }

    public function delete(Request $request){

        $validateData = $request->validate([
            'id'=>'required'
        ]);

        Post::find($request->id)->delete();
        return redirect('Alclist');
    }


    public function Alcpform(){

        return view('Alcviews.Alcpform');
    }

    public function pform(Request $request){

        $file = $request->file('image');
        $today = date("Y/m/d/");

        if($request->file('image')->isValid()){

            $request->image->storeAs('public',$today.$file->getClientOriginalName());

            $post = new Post();
            $post->user_id = 1;
            $post->title = $file->getClientOriginalName();
            $post->slug = '/storage/'.$today.$file->getClientOriginalName();
            $post->status = 'inherit';
            $post->type = 'attachment';
            $post->mime_type = 'image/png';
            $post->save();
        }

        return redirect('Alcpform');
    }

    public function Alcplist(){

        $list = Post::where('type','attachment')->get();
        return view('Alcviews.Alcplist',['list'=>$list]);
    }

    public function pdelete(Request $request){

        $validateData = $request->validate([
            'ids'=>'array|required'
        ]);

        $images = Post::whereIn('id',$request->ids)->get();

        foreach($images as $image){

            Storage::disk('public')->delete(substr($image->slug,9));
            Post::destroy($image->id);
        }

        return redirect('Alcplist');
    }

    public function Alcmlist(){

        $list = User::all();
        return view('Alcviews.Alcmlist',['list'=>$list]);
    }

    public function Alcmform(){

        return view('Alcviews.Alcmform');
    }

    Public function mform(Request $request){

        $validataedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('Alcmlist');
    }





    //閲覧用ページ

    public function top(){

        return view('Alcviews.top');
    }

    public function list(){

        $lists = Post::where('status','publish')->get();
        $klist = Taxonomy::where('type','category')->get();
        $tlist = Taxonomy::where('type','tag')->get();
        return view('Alcviews.list',['klist'=>$klist,'tlist'=>$tlist,'lists'=>$lists]);
    }

    public function kiji($slug){

        $post=Post::where('slug',$slug)->first();
        if(is_null($post)){
            return redirect('top');
        }

        $image=Post::find($post->mime_type);
        return view('Alcviews.kiji',['post'=>$post,'image'=>$image]);
    }

    public function kklist($slug){

        $title=Taxonomy::where('slug',$slug)->first();
        $posts=Taxonomy::where('slug',$slug)->first()->posts()->where('status','publish')->get();
        return view('Alcviews.kklist',['posts'=>$posts,'title'=>$title]);
    }

    public function tklist($slug){

        $title=Taxonomy::where('slug',$slug)->first();
        $posts=Taxonomy::where('slug',$slug)->first()->posts()->where('status','publish')->get();
        return view('Alcviews.tklist',['posts'=>$posts,'title'=>$title]);
    }

}






















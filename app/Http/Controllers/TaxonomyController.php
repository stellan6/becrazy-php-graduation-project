<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxonomy;
use App\Models\Post;

class TaxonomyController extends Controller{


    public function Alcklist(){

    	$list = Taxonomy::where('type','=','category')->get();
    	return view('Alcviews.Alcklist',['list'=>$list]);
    }

    public function Alctlist(){

    	$list = Taxonomy::where('type','=','tag')->get();
    	return view('Alcviews.Alctlist',['list'=>$list]);
    }




    public function Alcktform(){

    	return view('Alcviews.Alcktform');
    }

    public function ktform(Request $request){

    	$validataedData = $request->validate([

    		'type' => 'required|string',
        	'name' => 'required|string',
        	'slug' => 'required|string'
        ]);

        $taxonomy = new Taxonomy();
        $taxonomy->type = $request->type;
        $taxonomy->name = $request->name;
        $taxonomy->slug = $request->slug;
        $taxonomy->save();
        return redirect('Alclist');
    }


    public function Alcktedit($id){

        $taxonomy=Taxonomy::find($id);
        if(is_null($taxonomy)){
            return redirect('Alcviews.Alclist');
        }
        return view('Alcviews.Alcktedit',['taxonomy'=>$taxonomy]);
    }


    public function ktedit(Request $request){

        $validataedData = $request->validate([

            'type' => 'required|string',
            'name' => 'required|string',
            'slug' => 'required|string'
        ]);

        $taxonomy=Taxonomy::find($request->id);
        $taxonomy->type=$request->type;
        $taxonomy->name=$request->name;
        $taxonomy->slug=$request->slug;
        $taxonomy->save();
        return redirect('Alclist');
        }

    public function ktdelete(Request $request){

        $validateData = $request->validate([
            'id'=>'required'
        ]);

        $taxonomy = Taxonomy::find($request->id);
        $taxonomy->posts()->detach();
        Taxonomy::destroy($request->id);
        return redirect('Alclist');
    }

}





















<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        //select * from posts
        $postsFromDB=Post::all();//collection object
       /* $allPosts= [
            ['id'=> 1,'title'=>'php','postedBy'=> 'Ahmad','createdAt'=>'22-10-2022'],
            ['id'=>2,'title'=>'java','postedBy'=> 'Mustafa','createdAt'=>'13-10-2022'],
            ['id'=>3,'title'=>'Html','postedBy'=> 'Mouna','createdAt'=>'20-01-2022'],
        ];*/
        return View('posts.index',['posts'=>$postsFromDB]);
    }

    //convention over configration

    public function show(Post $post){//type hinting
        /*$singlPostFromDB=Post::findOrFail($postId);
        $singlPostFromDB=Post::find($postId);
        if(is_null($singlPostFromDB)){
            return to_route('posts.index');
        }
        $singlPostFromDB=Post::were('id',$postId)->first();//model object
        $singlPostFromDB=Post::were('id',$postId)->get();//collection object
        dd($singlPostFromDB);//model object

        $singlPost= ['id'=> 1,'title'=>'php','description'=>'Description is description','postedBy'=> 'Ahmad','createdAt'=>'22-10-2022'];*/
        return  View('posts.show',['post'=>$post]);
    }

    public function create(){
        $users=User::all();
        return View('posts.create',['users'=>$users]);
        //store data to DB
    }

    public function store(){
        // $data=request()->all();
          request()->validate ([
            'title'=>['required','min:3'],
            'description'=>['required','min:5'],
            'post_creator'=>['required','exists:users,id'],

          ]);

        // Validate the request...
 
        // $post = new Post;
 
        // $post->title = request()->title;
        // $post->description = request()->description;
 
        // $post->save();//insert to DB
        Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'user_id'=>request()->post_creator,
        ]);
 
        return to_route('posts.index');
    }

    public function edit(Post $post ){

        $users=User::all();
        return View('posts.edit',['users'=>$users,'post'=>$post]);
    }
    
    public function update($postId){
        
        $title=request()->title;
        $description=request()->description;
        $post_creator=request()->post_creator;

        $singlPostFromDB=Post::find($postId);
        $singlPostFromDB ->update( [
                'title' => $title,
                'description' => $description,
                'user_id'=>$post_creator,]
        );
        
        return to_route('posts.show',$postId);
    }

    public function destroy($postId){

        $singlPostFromDB=Post::find($postId);
        $singlPostFromDB ->delete();
       
        return to_route('posts.index');
    }

}

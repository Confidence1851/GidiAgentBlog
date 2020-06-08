<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\PostCommentRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    protected $user;
    protected $post;

    /**
     * PostController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(UserRepositoryInterface $user ,PostRepositoryInterface $post )
    {
        $this->user = $user;
        $this->post = $post;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return response()->json($this->post->all() , 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'post_category_id' => 'required|exists:blog_post_categories,id',
            'title' => 'required|string|max:100',
            'body' => 'required|string',
            'image' => 'nullable|string',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false ,'data' => $validator->errors() , 'status' => 400]);
        }
        $data = $request->all();
        $data['author_id'] = $this->user->user();
        $data['slug'] = Str::slug($data['title']);
        $data['image'] = 'Store image and return filename';

        $response =  $this->post->store($data);
        return response()->json(['success' => true ,'data' => $response ,'status' => 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response =  $this->post->get($id);
        if(empty($response)){
            return response()->json(['success' => false ,'data' => 'Not Found' , 'status' => 400]);
        }
        // $response['comments']  = $response->comments();
        // $response['category']  = $response->category();
        return response()->json(['success' => true ,'data' => $response ,'status' => 200]);
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
        $response =  $this->post->get($id);
        if(empty($response)){
            return response()->json(['success' => false ,'data' => 'Not Found' , 'status' => 400]);
        }

        $validator =  Validator::make($request->all(),[
            'post_category_id' => 'required|exists:blog_post_categories,id',
            'title' => 'required|string|max:100',
            'body' => 'required|string',
            'image' => 'nullable|string',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false ,'data' => $validator->errors() , 'status' => 400]);
        }
        $data = $request->all();
        $data['author_id'] = $this->user->user();
        $data['slug'] = Str::slug($data['title']);
        $data['image'] = 'Store image and return filename';

        $response =  $this->post->update($id ,$data);
        return response()->json(['success' => true ,'data' => $response ,'status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response =  $this->post->get($id);
        if(empty($response)){
            return response()->json(['success' => false ,'data' => 'Not Found' , 'status' => 400]);
        }
        $response->delete($id);
        return response()->json(['success' => true ,'data' => $response ,'status' => 200]);
    }
}

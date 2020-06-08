<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\PostCategoryRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{

    protected $user;
    protected $post_category;
    protected $SuccessCode = 200;
    protected $NotFoundCode = 404;
    protected $ValidationErrorCode = 422;

    /**
     * PostCategoryController constructor.
     *
     * @param (UserRepositoryInterface $user ,PostCategoryRepositoryInterface $post_category
     */
    public function __construct(UserRepositoryInterface $user ,PostCategoryRepositoryInterface $post_category )
    {
        $this->user = $user;
        $this->post_category = $post_category;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->post_category->all() , $this->SuccessCode);
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
            'category_name' => 'required|string|max:100|unique:blog_post_categories',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false ,'data' => $validator->errors() , 'status' => $this->ValidationErrorCode]);
        }
        $data = $request->all();
        $data['author_id'] = $this->user->user();

        $response =  $this->post_category->store($data);
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
        $response =  $this->post_category->get($id);
        if(empty($response)){
            return response()->json(['success' => false ,'data' => 'Not Found' , 'status' => $this->NotFoundCode]);
        }
        return response()->json(['success' => true ,'data' => $response ,'status' => $this->SuccessCode]);
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
        $response =  $this->post_category->get($id);
        if(empty($response)){
            return response()->json(['success' => false ,'data' => 'Not Found' , 'status' => $this->NotFoundCode]);
        }

        $validator =  Validator::make($request->all(),[
            'category_name' => 'required|string|max:100|unique:blog_post_categories',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false ,'data' => $validator->errors() , 'status' => $this->ValidationErrorCode]);
        }
        $data = $request->all();

        $response =  $this->post_category->update($id , $data);
        return response()->json(['success' => true ,'data' => $response ,'status' => $this->SuccessCode]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response =  $this->post_category->get($id);
        if(empty($response)){
            return response()->json(['success' => false ,'data' => 'Not Found' , 'status' => $this->NotFoundCode]);
        }
        $response->post_category->delete($id);
        return response()->json(['success' => true ,'data' => $response ,'status' => $this->SuccessCode]);
    }
}

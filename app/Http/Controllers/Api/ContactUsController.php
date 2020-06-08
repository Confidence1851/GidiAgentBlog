<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    protected $contact;

    protected $SuccessCode = 200;
    protected $NotFoundCode = 404;
    protected $ValidationErrorCode = 422;

    /**
     * PostController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(ContactUsRepositoryInterface $contact)
    {
        $this->contact = $contact;
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
            'name' => 'required|string',
            'email' => 'required|string|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false ,'data' => $validator->errors() , 'status' => $this->ValidationErrorCode]);
        }

        $response =  $this->contact->store($request->all());
        return response()->json(['success' => true ,'data' => $response ,'status' => 201]);
    }
}

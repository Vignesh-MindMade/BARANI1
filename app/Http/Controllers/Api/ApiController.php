<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Config;

class ApiController extends Controller
{
    
    
    public function validation($request, $rules, $messages=[])
    {
        $validator = Validator::make($request->all(), $rules, $messages);
        $this->errors = $validator->errors()->all();
        return count($this->errors) <= 0;
    }
    
    
    public function response($data=[], $status=true, $code=200)
    // added
    // public function response($data=[], $status=false, $code=200)
    {   
        // return $data;
        $data = (array)$data;
        $code = count($data) > 0?$code:204;
        return response()->json(['message' => $data, 'status'=>$status], $code);
    }
    
     public function failed($error=[])
    {
        if (count($error) > 0) {
            $this->errors = array_merge($this->errors, $error);
        }
        
        return $this->response($this->errors, false, 422);
    }
    
    
    
}

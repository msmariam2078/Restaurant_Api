<?php

namespace App\Http\Controllers;
use App\Http\Resources\ReviewResource;
use App\Http\traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\str;
class ReviewController extends Controller
{  use GeneralTrait;
    public function create(Request $request,$uuid){
     $validate=Validator::make($request->all(),[
    "review"=>"required|integer|min:0|max:5",
    ]);
    if($validate->fails()){
     return $this->requiredField($validate->errors()->first());}
     $resto=Restaurant::where('uuid',$uuid)->first();
     if(!$resto)
     {
        return $this->apiResponse(null,false,['not found'],404) ;
     }  
    // $auth_order=Order::where('user_id',Auth::id())->where('restaurant_id',$resto->id)->first();
     $prev_review=Review::where('restaurant_id',$resto->id)->where('user_id',Auth::id())->first();

    if($prev_review)
    {
       return $this->unAuthorizeResponse(['you cant rereview']);
    }
    $uuir=Str::uuid();
    
     $review=Review::create(['uuid'=>$uuir,'restaurant_id'=>$resto->id,"user_id"=>Auth::id(),'review'=>$request->review]);
     return $this->apiResponse(ReviewResource::make($review));
    }


    public function update(Request $request,$uuid){
            
        $validator =Validator::make($request->all(), [
          
            'review' => "required|integer|min:0|max:5"
        ]);
        if($validator->fails()) {
            return $this->requiredFielde($validator->errors()->first());
        }
        $review=Review::where('uuid',$uuid)->first();
        if(!$review)
        {
           return $this->apiResponse(null,false,['not found'],404) ;
        }
        $review->update($request->all());
       return $this->apiResponse(['update successfully!']) ;



 }

    public function delete($uuid)

    {

     
             $review=Review::where('uuid',$uuid)->first();
             if(!$review)
             {
                return $this->apiResponse(null,false,['not found'],404) ;
             } 
             $review->delete();
             return $this->apiResponse(ReviewResource::make($review));

    }
}
    
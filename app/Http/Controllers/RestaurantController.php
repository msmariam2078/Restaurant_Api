<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Resources\RestaurantsResource;
use App\Http\Resources\RestaurantResource;
use Illuminate\Support\Facades\Validator;
use App\Http\traits\GeneralTrait;
class RestaurantController extends Controller
{    use GeneralTrait;

    public function index(){
       
    $restaurants=Restaurant::all();
    if($restaurants->isEmpty())
    {return $this->notFoundResponse(['there is no data']);}
    return $this->apiResponse( RestaurantsResource::collection($restaurants)) ;      
}

    public function show($uuid){

    $restaurant=Restaurant::where('uuid',$uuid)->first();
    if(!$restaurant)
    {
        return $this->apiResponse(null,false,['not found'],404) ; 
    }
    return $this->apiResponse( RestaurantsResource::make($restaurant)) ;

}
    public function search(Request $request){

    $validate=Validator::make($request->all(),[
    'cusine_type'=>'string|min:4|max:50|regex:/^[A-Za-z]+$/|in:western,eastern,indian',
    'location'=>'string|min:4|max:50',
        ]);
        
    if($validate->fails()){
    return $this->requiredField($validate->errors()->first());}

    $query=Restaurant::query();
    if($request->cusine_type)
    {
        $query->where('cusine_type',$request->cusine_type);
    }
    if($request->location)
    {
        $query->where('location','like','%'.$request->location.'%');
    }
   $restaurants=$query->get();

       
    return $this->apiResponse( RestaurantsResource::collection($restaurants)) ;      

         



}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item_order;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\str;
use App\Models\Item;
use App\Models\Restaurant;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Http\traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class OrderController extends Controller
{
    use GeneralTrait;

public function index(){

$orders=Order::all();
if($orders->isEmpty())
{return $this->notFoundResponse(['there is no data']);}
return $this->apiResponse( OrdersResource::collection($orders)) ;      
}


public function create(Request $request,$uuid)  
{
$validate=Validator::make($request->all(),[
'items'=>'array|required',
'items.*.uuid'=>'string|exists:menus,uuid',
'items.*.quantity'=>'integer|min:1',
'order_type'=>'required|string|in:delivrey,pickup']
);

if($validate->fails()){
return $this->requiredField($validate->errors()->first());}
       
$restaurant=Restaurant::where('uuid',$uuid)->first(); 
// dd($restaurant);
if(!$restaurant)
{
    return $this->apiResponse(null,false,['not found'],404); 
} 
// dd($request->order_type);     
$order=Order::create(
[
'uuid'=>Str::uuid(),
'user_id'=>Auth::id(),

'order_type'=>$request->order_type,

'total_cost'=>0]
);


foreach($request->items as $item)
{
$item_m=Menu::where('uuid',$item['uuid'])->first(); 


$exist=Menu::where('id',$item_m->id)->where('restaurant_id',$restaurant->id)->first();
if(!$exist)
{$order->delete();
    return  $this->requiredField(['invalid item']);
}
Item_order::create(['menu_id'=>$item_m->id,'number'=>$item['quantity'],'order_id'=>$order->id]);
 }
return $this->apiResponse(OrdersResource::make($order));
       
       

    }


public function update(Request $request,$uuid)  
{
$validate=Validator::make($request->all(),[
'items'=>'array|required|',
'items.*.uuid'=>'string|exists:menus,uuid',
'items.*.quantity'=>'integer|min:1'
]
);

if($validate->fails()){
return $this->requiredField($validate->errors()->first());}

$order=Order::where('uuid',$uuid)->first();
if(!$order)
{
    return $this->apiResponse(null,false,['not found'],404); 
} 
$order->item_orders()->delete();
$order->total_cost=0.0;
$order->save();
foreach($request->items as $item)
{
  $item_m=Menu::where('uuid',$item['uuid'])->first(); 
//   $exist=Menu::where('id',$item->id)->where('restaurant_id',$order->restaurant_id)->first();
//   if(!$exist)
//   {
//       return  $this->requiredField(['invalid item']);
//   }
Item_order::create(['menu_id'=>$item_m->id,'number'=>$item['quantity'],'order_id'=>$order->id]);


}

return $this->apiResponse(['updated successfuly']); 



}

        public function show($uuid){
     
            $order=Order::where('uuid',$uuid)->first();
            if(!$order)
            {
               return $this->apiResponse(null,false,['not found'],404) ;
            }

 
        return $this->apiResponse (OrdersResource::make($order));

    }
}

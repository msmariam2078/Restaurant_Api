<?php

namespace App\Observers;

use App\Models\Item_order;
use App\Models\Order;
class Item_orderObserver
{
    /**
     * Handle the Item_order "created" event.
     *
     * @param  \App\Models\Item_order  $item_order
     * @return void
     */
    public function created(Item_order $item_order)
    {
        $order=Order::findOrFail($item_order->order_id);

        foreach ($order->item_orders as $item_order) {
          $order->total_cost= $order->total_cost+ ($item_order->menu->price*$item_order->number);

        }
        $order->save();
        
    }

    /**
     * Handle the Item_order "updated" event.
     *
     * @param  \App\Models\Item_order  $item_order
     * @return void
     */
    public function updated(Item_order $item_order)
    {
        //
    }

    /**
     * Handle the Item_order "deleted" event.
     *
     * @param  \App\Models\Item_order  $item_order
     * @return void
     */
    public function deleted(Item_order $item_order)
    {
        //
    }

    /**
     * Handle the Item_order "restored" event.
     *
     * @param  \App\Models\Item_order  $item_order
     * @return void
     */
    public function restored(Item_order $item_order)
    {
        //
    }

    /**
     * Handle the Item_order "force deleted" event.
     *
     * @param  \App\Models\Item_order  $item_order
     * @return void
     */
    public function forceDeleted(Item_order $item_order)
    {
        //
    }
}

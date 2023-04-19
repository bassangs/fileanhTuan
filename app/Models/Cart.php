<?php

namespace App\Models;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id, $color){
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if($this->items){
            if(array_key_exists($id . '_' . $color, $this->items)){
                $storedItem = $this->items[$id . '_' . $color];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id . '_' . $color] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function deleteItem($id, $color){
        $this->totalQty -= $this->items[$id . '_' . $color]['qty'];
        $this->totalPrice -= $this->items[$id . '_' . $color]['price'];
        unset($this->items[$id . '_' . $color]);
    }

    public function changeQty($request)
    {
        $color = $request->color;
        if ((int) $this->items[$request->id . '_' . $color]['qty'] < (int) $request->qty) {
            $currentQty = (int) $request->qty - (int) $this->items[$request->id . '_' . $color]['qty'];
            $this->totalQty += $currentQty;
            $this->totalPrice += $currentQty * $this->items[$request->id . '_' . $color]['item']['price'];
            $this->items[$request->id . '_' . $color]['qty'] += (int) $currentQty;
        } else if ((int) $this->items[$request->id . '_' . $color]['qty'] > (int) $request->qty) {
            $currentQty = (int) $this->items[$request->id . '_' . $color]['qty'] - (int) $request->qty;
            $this->totalQty -= $currentQty;
            $this->totalPrice -= $currentQty * $this->items[$request->id . '_' . $color]['item']['price'];
            $this->items[$request->id . '_' . $color]['qty'] -= (int) $currentQty;
        }
        $this->items[$request->id . '_' . $color]['price'] = (int) $request->qty * $this->items[$request->id . '_' . $color]['item']['price'];
    }
}

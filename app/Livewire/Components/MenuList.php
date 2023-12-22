<?php

namespace App\Livewire\Components;

use App\Models\Order;
use Livewire\Component;
use App\Models\Category;
use App\Models\FoodItem;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class MenuList extends Component
{
    public $ordercode;
    public $selectedCategory;

    #[On('changeList')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.components.menu-list', ['categories' => $categories]);
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = Category::find($categoryId);
        $this->dispatch('changeList');
    }

    public function resetCategory()
    {
        $this->reset('selectedCategory');
    }

    public function addMenu($menuId)
    {
        $menu = FoodItem::find($menuId);
        $item = OrderItem::where('order_code', $this->ordercode)->where('menu_name', $menu->name)->first();

        if (isset($item)) {
            DB::transaction(function () use ($menu, $item) {

                $item->quantity += 1;
                $item->total_price += $menu->price;
                $item->save();

                $item->order->total_price += $menu->price;
                $item->push();
            });
        } else {
            DB::transaction(function () use ($menu) {
                $order = Order::where('order_code', $this->ordercode)->first();
                $order->total_price += $menu->price;
                $order->save();

                $newItem = new OrderItem;
                $newItem->quantity = 1;
                $newItem->menu_name = $menu->name;
                $newItem->order_code = $this->ordercode;
                $newItem->single_price = $menu->price;
                $newItem->total_price = $menu->price;
                $newItem->save();
            });
        }

        $this->dispatch('updateOrder');
    }
}

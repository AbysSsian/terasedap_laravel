<?php

namespace App\Livewire\Components;

use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class EditOrderItemModal extends Component
{
    public $item;
    public $quantity;

    public function mount()
    {
        $this->quantity = $this->item->quantity;
    }

    public function render()
    {
        return view('livewire.components.edit-order-item-modal', ['item' => $this->item]);
    }

    #[On('close-delete-item-modal')]
    public function resetInput()
    {
        $this->quantity = $this->item->quantity;
    }

    public function decrementQuantity()
    {
        $this->quantity -= 1;
    }

    public function incrementQuantity()
    {
        $this->quantity += 1;
    }

    public function deleteItem($id)
    {
        $orderItem = OrderItem::find($id);

        DB::transaction(function () use ($orderItem) {
            $orderItem->order->total_price -= $orderItem->total_price;
            $orderItem->push();

            $orderItem->delete();
        });

        $this->dispatch('close-delete-item-modal');
        $this->dispatch('updateOrder');
    }

    public function saveItem($id)
    {
        $orderItem = OrderItem::find($id);
        $prevPrice = $orderItem->total_price;
        $newPrice = $this->quantity * $orderItem->single_price;
        $differencePrice = $newPrice - $prevPrice;

        DB::transaction(function () use ($orderItem, $prevPrice, $newPrice, $differencePrice) {
            $orderItem->quantity = $this->quantity;
            $orderItem->total_price = $newPrice;
            $orderItem->save();

            $orderItem->order->total_price += $differencePrice;
            $orderItem->push();
        });
        $this->dispatch('close-delete-item-modal');
        $this->dispatch('updateOrder');
    }
}

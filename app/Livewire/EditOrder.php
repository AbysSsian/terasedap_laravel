<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\On;
use App\Models\CanceledOrder;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

class EditOrder extends Component
{

    public $order;

    public function mount($id)
    {

        $this->order = Order::find($id);
    }

    #[Layout('/components/layouts/editorder')]
    #[On('updateOrder')]
    public function render()
    {
        return view('livewire.edit-order', ['order' => $this->order]);
    }

    public function cancelEdit()
    {
        return redirect()->route('admin.orders');
    }

    public function decrementQuantity($itemId)
    {
        $orderitem = OrderItem::find($itemId);

        DB::transaction(function () use ($orderitem) {


            $orderitem->quantity -= 1;
            $orderitem->total_price -= $orderitem->single_price;
            $orderitem->save();

            $orderitem->order->total_price -= $orderitem->single_price;
            $orderitem->push();
        });

        $this->dispatch('updateOrder');
    }

    public function incrementQuantity($itemId)
    {
        $orderitem = OrderItem::find($itemId);

        DB::transaction(function () use ($orderitem) {
            $orderitem->quantity += 1;
            $orderitem->total_price += $orderitem->single_price;
            $orderitem->save();

            $orderitem->order->total_price += $orderitem->single_price;
            $orderitem->push();
        });

        $this->dispatch('updateOrder');
    }

    public function deleteItem($id)
    {
        $orderItem = OrderItem::find($id);

        DB::transaction(function () use ($orderItem) {
            $orderItem->order->total_price -= $orderItem->total_price;
            $orderItem->push();

            $orderItem->delete();
        });

        $this->dispatch('updateOrder');
    }

    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);

        DB::transaction(function () use ($order) {

            $canceled = new CanceledOrder();
            $canceled->order_id = $order->id;
            $canceled->canceled_reason = '';
            $canceled->save();

            $order->status = 'canceled';
            $order->save();

            // foreach ($order->items as $item) {
            //     $item->delete();
            // }

            $order->delete();
        });

        return redirect()->route('admin.orders');
    }
}

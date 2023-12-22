@push('styles')
    <link rel="stylesheet" href="{{ asset('css/livewire.css')}}">
@endpush
<div>
    <button class="cancel-edit-button" wire:click="cancelEdit"><x-iconsax-out-arrow-left-2 style="height: 30px;" />
        Return
    </button>
    <main id="edit-order"> 
        <livewire:Components.MenuList ordercode="{{$order->order_code}}" />
        <div id="order-list">
            <h2>Order</h2>
            <div id="order-detail">
                <table>
                    <tr>
                        <td>Table Number</td>
                        <td>: {{$order->table_number}}</td>
                    </tr>
                    <tr>
                        <td>Order Number</td>
                        <td>: {{$order->order_code}}</td>
                    </tr>
                    <tr>
                        <td>Order Time</td>
                        <td>: {{$order->order_date}}</td>
                    </tr>
                    <tr>
                        <td>Payment</td>
                        <td>: {{ $order->payment_method}}</td>
                    </tr>
                </table>
            </div>
            <div id="order-items">
                @foreach ($order->items()->onlyTrashed()->get() as $item)
                    <div class="deleted-list-item">
                        <div>
                            <p>
                                {{$item->menu_name}}
                            </p>
                            <p>
                                Qty: {{$item->quantity}} <span>Canceled</span>
                            </p>
                            <div>
                                <?= nl2br($item->notes); ?>
                            </div>
                        </div>
                        <div>
                            <p>Rp. {{ number_format($item->total_price, 0, ',', '.')}}</p>
                        </div>
                    </div>
                @endforeach
                @foreach ($order->items as $item)
                    <div class="order-list-item" x-data x-on:click="$dispatch('open-delete-item-modal', {itemId:'{{$item->id}}'})" wire:key="{{$item->id}}">
                        <div>
                            <p>{{$item->menu_name}}</p>
                            <p>Qty: {{$item->quantity}}</p>
                            <div>
                                <?= nl2br($item->notes); ?>
                            </div>
                            <div>
                                <button class="delete-item" wire:click="deleteItem({{$item->id}})">Delete</button>

                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: flex-end;">
                                <p>Rp. {{ number_format($item->total_price, 0, ',', '.') }}</p>
                                <div>
                                    <x-iconsax-out-edit style="width: 20px; margin-left:10px;" />
                                </div>
                            </div>
                            <div>
                                <div class="order-item-quantity">
                                    <button wire:click="decrementQuantity({{$item->id}})" @if ($item->quantity == 1)
                                    disabled
                                @endif><x-iconsax-lin-minus style="width: 18px" /></button>
                                    <input type="number" min="1" disabled value="{{$item->quantity}}">
                                    <button wire:click="incrementQuantity({{$item->id}})"><x-iconsax-lin-add style="width: 18px" /></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="order-foot">
                <div>
                    <button class="delete-button" wire:click="cancelOrder({{$order->id}})">
                        Cancel Order
                    </button>
                </div>
                <div id="save-changes">
                    <h2>Rp. {{number_format($order->total_price, 0, '', '.')}}</h2>
                    <button wire:click="cancelEdit">Save Changes</button>
                </div>
            </div>
        </div>
    </main>
</div>
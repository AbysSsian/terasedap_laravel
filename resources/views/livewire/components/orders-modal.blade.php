<div 
x-data="{ show: false, name: '{{$name}}' }"
x-show="show"
x-on:open-modal.window="console.log($event.detail);show = ($event.detail.name === name)"
x-on:close-modal.window="show = false"
style="z-index: -50; display:none;"
x-transition
>
    <div class="order-modal-background" x-on:click="show = false"></div>
    <div class="order-modal">
        <div class="modal-header">
            <div class="modal-title">
                Order Details
            </div>
            <div>
                <button style="background: none; border:none;" x-on:click="show = false">
                    <x-maki-cross style="height:20px;" />
                </button>
            </div>
        </div>
        <div class="modal-body">
            <div class="order-modal-detail">
                <div style="margin-right: 10px">
                    <p>Order Number</p>
                    <p>Order Time</p>
                    <p>Table Number</p>
                    <p>Payment Method</p>
                </div>
                <div>
                    <p>: {{ $detail->order_code}}</p>
                    <p>: {{ $detail->order_date }}</p>
                    <p>: {{ $detail->table_number }}</p>
                    <p>: {{ $detail->payment_method }}</p>
                </div>
            </div>
            <div class="order-modal-items" style="margin-top: 10px">
                <div>Order Items</div>
                @foreach ($detail->items as $item)
                    <div class="item-detail">
                        <div>
                            <div style="margin-right:40px; display:flex;margin-bottom:4px;">
                                <div style="margin-right:10px;">
                                    {{$item->food->name}}
                                </div>
                                <div>
                                    x {{$item->quantity}}
                                </div>
                            </div>
                            <div style="display: flex;overflow-wrap: break-word; max-width:200px; margin-left:10px">
                                {{ $item->notes}}
                            </div>
                        </div>
                        <div>
                            Rp. {{ number_format($item->food_price, 0, '', '.') }} 
                            {{-- <x-iconsax-out-add-circle class="delete-button-icon" /> --}}
                        </div>
                    </div>
                @endforeach
                <div class="detail-price" style="margin-top: 20px;">
                    <p>Total Payment</p>
                    <p>Rp. {{ number_format($detail->total_price, 0, '', '.')}}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="display:flex; justify-content: space-between;">
            <button style="color: #fb3c2c; border: none; background: none;" x-on:click="$dispatch('open-delete-modal', {orderId : '{{$detail->id}}'})" orderId="{{$detail->id}}">
                <x-iconsax-out-trash style="height: 18px;" /> Cancel Order
            </button>
            <div>
                @switch($detail->status)
                    @case('unpaid')
                    <button class="modal-button received" wire:click="receiveOrder({{$detail->id}})">Receive</button>
                    @break
                    @case('unpayed')
                    <button class="modal-button received" wire:click="receiveOrder({{$detail->id}})">Receive</button>
                    @break
                    @case('received')
                    <button class="modal-button paid" wire:click="payOrder({{$detail->id}})">Pay</button>
                    @break
                @endswitch
                <button class="modal-button close" x-on:click="show = false">Close</button>
            </div>
        </div>
    </div>
        {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

        {{-- @foreach ($detail->items as $item)
            <livewire:Components.DeleteItemModal wire:key="{{$item->id}}" itemId="{{$item->id}}" />
        @endforeach --}}
</div>
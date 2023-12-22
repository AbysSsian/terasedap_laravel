@push('styles')
    <link rel="stylesheet" href="{{asset('css/livewire.css')}}">
@endpush
<div class="admin">
    <h2>Order History</h2>
    <div id="history">
        <div id="list-order">
            @foreach ($orders as $order)
            <div class="list-order-item" wire:click="selectOrder({{$order->id}})">
                <div>
                    <div class="item-code">
                        {{$order->order_code}}
                    </div>
                    <div style="font-size:12px; color: #9e9e9e">
                        {{ date_format($order->updated_at, 'd/m/Y') }}
                    </div>
                </div>
                <div class="item-status {{$order->status}}">
                    {{$order->status}}
                </div>
            </div>
            @endforeach
        </div>

        <div id="view-order">
            @if (isset($selectedOrder))
            <div id="order-detail">
                <div style="display:flex; margin-bottom:16px;">
                    <div style="margin-right: 10px; width: max-content">
                        <p>Number</p>
                        <p>Order Date</p>
                        <p>Table</p>
                        <p>Payment</p>
                        @if ($selectedOrder->trashed())
                            <p>Canceled</p>
                        @endif
                    </div>

                    <div>
                        <p>: {{$selectedOrder->order_code}}</p>
                        <p>: {{$selectedOrder->updated_at}}</p>
                        <p>: {{$selectedOrder->table_number}}</p>
                        <p>: {{ strtoupper($selectedOrder->payment_method)}}</p>
                        @if ($selectedOrder->trashed())
                            : {{$selectedOrder->canceled->canceled_reason}}
                        @endif
                    </div>
                </div>

                @foreach ($selectedOrder->items()->withTrashed()->get() as $item)
                <div style="margin-bottom: 6px;">
                    <div style="padding: 4px;">
                        <div class="item-name">
                            {{ $item->menu_name}}
                        </div>
                        <div>
                            <?= nl2br($item->notes) ?>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <div>
                                x{{$item->quantity }} @ <span>Rp. {{number_format($item->single_price, 0,'', '.')}}</span>
                            </div>
                            <div>
                                Rp. {{number_format($item->total_price, 0,'', '.')}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else 
            <div style="display: flex; align-items:center; justify-content:center; height: 100%; font-size:24px">
                Select an order
            </div>
            @endif

        </div>
    </div>
</div>
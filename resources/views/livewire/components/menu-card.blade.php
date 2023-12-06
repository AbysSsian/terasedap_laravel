<div class="menu-item">
    <a href="{{ route('fooditem.description', ['id' => $item->id]) }}" style="text-decoration-line: none;">
        <div>
            @if($item->image)
            <img src="{{ $item->getImageURL() }}" alt="{{ $item->name }}">
            @else
            <p>No image available</p>
            @endif
            <div class="menu-detail">
                <p class="food-name">{{ $item->name }}</p>
                <p class="food-price">Rp {{ number_format($item->price, 0, '', '.') }}</p>
            </div>
        </div>
    </a>
    <div class="item-button">
        @if ($added)
        @if ($cart_item->quantity > 1)
        <button wire:click.prevent="decrement({{$cart_item->id}})" wire:loading.attr="disabled"><x-iconsax-out-minus style="width:20px" /></button>
        @else
        <button wire:click.prevent="remove({{$cart_item->id}})" wire:loading.attr="disabled"><x-iconsax-out-minus style="width:20px" /></button>
        @endif
        <input type="text" class="item-quantity" value="{{ $cart_item->quantity }}" disabled />
        <button wire:click.prevent="increment({{$cart_item->id}})" wire:loading.attr="disabled"><x-iconsax-out-add style="width:20px" /></button>
        @else
        <button style="width: 100%;" wire:click.prevent="addItem">
            Add to Cart</button>
        @endif
    </div>
</div>
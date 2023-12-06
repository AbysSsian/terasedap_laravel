<div class="cart-item">
    <div class="item-detail">
        <div class="name-description">
            <p class="item-name">
                {{ $food->name }}
            </p>
            <p class="item-note">
                <?= nl2br($detail->notes) ?>
            </p>
        </div>
        <a href="{{route('fooditem.description', ['id' => $food->id])}}">
            <div class="item-image">
                <img src="{{ $food->getImageURL() }}" alt="">
            </div>
        </a>
        </div>
        <div class="item-price">
            Rp {{ number_format($detail->food_price, 0, '', '.')}}
        </div>
    <div class="order-detail">
        <div>
            <button class="add-notes" x-data x-on:click="$dispatch('open-notes', { itemId : {{ $detail->id }} })"><x-iconsax-bol-note-21 style="height: 16px; margin-right:4px" />notes</button>
        </div>
        <div class="item-button">
        @if ($detail->quantity > 1)
        <button wire:click.prevent="decrement({{ $detail->id }})" wire:loading.attr="disabled" class="quantity-item"><x-iconsax-out-minus style="width:16px" /></button>
        @else
        <button wire:click.prevent="remove({{$detail->id}})" wire:loading.attr="disabled" class="quantity-item"><x-iconsax-out-minus style="width:16px; height:16px" />
        </button>
        @endif
        <input type="text" class="cart-item-quantity" value="{{ $detail->quantity }}" disabled />
        <button wire:click.prevent="increment({{$detail->id}})" wire:loading.attr="disabled" class="quantity-item"><x-iconsax-out-add style="width:16px; height:16px" /></button>
        </div>
    </div>
</div>

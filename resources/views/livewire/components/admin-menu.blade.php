<a href="{{ route('food-item.edit', $detail->id)}}">
    <div wire:transition class="admin-menu">
        <div class="menu-detail" style="display: flex; flex-direction:column; justify-content:space-between">
            <div>
                {{ $detail->name }}
            </div>
            <div>
                Rp. {{ number_format($detail->price, 0, '', '.')}}
            </div>
            <div wire:click="deleteOrder({{$detail->id}})">
                <button style="z-index: 10; background-color:#565656; border:none; color:#e9e9e9">
                    <x-iconsax-out-trash style="width:16px;" /> Delete
                </button>
            </div>
        </div>
        <div class="menu-image">
            <img src="{{ $detail->getImageURL() }}" alt="{{ $detail->name }}">
        </div>
    </div>
</a>
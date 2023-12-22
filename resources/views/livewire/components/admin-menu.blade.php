<div>
    <div class="menu-list">
        <div class="image-name">
            <img src="{{ $detail->getImageURL() }}" alt="{{$detail->name}}">
            <p>{{ $detail->name }}</p>
        </div>
        <div class="price-button">
            <p>Rp. {{ number_format($detail->price, 0, ',', '.')}}</p>
            <a href="{{route('food-item.edit', $detail->id)}}" class="menu-edit-button">Edit</a>
            <button class="delete-button" x-data x-on:click="$dispatch('open-delete-menu-modal', {menuId: '{{$detail->id}}' })">Delete</button>
        </div>
    </div>
</div>
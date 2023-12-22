<div id="menu-list">
    @if (isset($selectedCategory))
        
    <div class="menu-list-item" wire:click="resetCategory">
        <p>
            Back to Category
        </p>
    </div>
        @foreach ($selectedCategory->items as $menu)
        <div class="menu-list-item" wire:click="addMenu({{$menu->id}})" wire:key="{{$menu->id}}">
            <p>
                {{$menu->name}}
            </p>
            
            <p>
                Rp. {{number_format($menu->price, 0, ',', '.')}}
            </p>
        </div>
        @endforeach



    @elseif (empty($selectedCategory))
        @foreach ($categories as $category)
            <div class="menu-list-item" wire:click="selectCategory({{$category->id}})" wire:key="{{$category->id}}">
                <p>
                    {{$category->name}}
                </p>
            </div>
        @endforeach
    @endif


</div>

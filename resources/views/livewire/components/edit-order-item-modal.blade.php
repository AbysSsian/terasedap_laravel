<div class="delete-menu-modal"
x-data="{show : false, itemId: '{{$item->id}}'}"
x-show="show"
x-on:open-delete-item-modal.window = "show = ($event.detail.itemId === itemId)"
x-on:close-delete-item-modal.window= "show = false"
x-on:updateOrder.window="show = false"
x-on:keydown.escape.window = "show=false"
style="display: none;"
wire:transition
>
    <div class="modal-background" x-on:click="$dispatch('close-delete-item-modal')">
    </div>
    <div class="modal">
        <div class="modal-header">
            <div>
                {{$item->menu_name}}
            </div>
            <div><x-maki-cross style="height:20px;" x-on:click="$dispatch('close-delete-item-modal')" />
            </div>
        </div>
        <div class="modal-body">
            <div class="order-item-quantity">
                <button wire:click="decrementQuantity" @if ($quantity == 1)
                disabled
            @endif><x-iconsax-lin-minus style="width: 18px" /></button>
                <input type="number" wire:model="quantity" min="1" disabled>
                <button wire:click="incrementQuantity"><x-iconsax-lin-add style="width: 18px" /></button>
            </div>
        </div>
        <div class="modal-footer" style="justify-content: space-between">
            <button class="delete" wire:click="deleteItem({{$item->id}})">Delete</button>
            <button class="edit" wire:click="saveItem({{$item->id}})">Save</button>
        </div>
    </div>
</div>

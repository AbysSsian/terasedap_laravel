<div class="delete-menu-modal"
x-data="{show : false, menuId: '{{$menu->id}}'}"
x-show="show"
x-on:open-delete-menu-modal.window = "show = ($event.detail.menuId === menuId)"
x-on:close-delete-menu-modal.window= "show = false"
x-on:keydown.escape.window = "show=false"
style="display: none;"
wire:transition
>
    <div class="modal-background" x-on:click="$dispatch('close-delete-menu-modal')">
    </div>
    <div class="modal">
        <div class="modal-header">
            <div>
                Delete Menu
            </div>
            <div><x-maki-cross style="height:20px;" x-on:click="$dispatch('close-delete-menu-modal')" />
            </div>
        </div>
        <div class="modal-body">
            <p>The menu <span style="font-weight: 600">{{$menu->name}}</span> will be permanently deleted. Are you sure you want to continue?</p>
        </div>
        <div class="modal-footer">
            <button class="delete" wire:click="deleteMenu({{$menu->id}})">Delete</button>
            <button class="cancel" x-on:click="$dispatch('close-delete-menu-modal')">Cancel</button>
        </div>
    </div>
</div>

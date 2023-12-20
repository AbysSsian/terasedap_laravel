<?php

namespace App\Livewire\Components;

use App\Models\FoodItem;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteMenuModal extends Component
{
    public $menu;

    public function render()
    {
        return view('livewire.components.delete-menu-modal', ['menu' => $this->menu]);
    }

    public function deleteMenu(FoodItem $menu)
    {
        Storage::disk('public')->delete($menu->image);
        $menuname = $menu->name;
        $menu->delete();

        $this->dispatch('close-delete-menu-modal');
        session()->flash('deleted', $menuname . ' has been deleted!');

        return redirect()->route('admin.menu');
    }
}

<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\FoodItem;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryList extends Component
{
    public $editCategoryId;
    public $editCategoryName;
    public $updatedCategoryId;

    public function edit($categoryId)
    {
        $this->editCategoryId = $categoryId;
        $this->editCategoryName = Category::find($categoryId)->name;
        $this->dispatch('edit-category');
    }

    public function delete($deletedCategoryId)
    {
        FoodItem::where("category_id",$deletedCategoryId)->delete();
        Category::find($deletedCategoryId)->delete();
    }

    public function cancelEdit()
    {
        $this->reset();
    }

    public function update()
    {
        Category::find($this->editCategoryId)->update([
            'name' => $this->editCategoryName
        ]);

        $this->reset();
    }

    #[On('edit-category')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.components.category-list', ['categories' => $categories]);
    }
}

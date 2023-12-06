<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FoodItemController extends Controller
{
    public function createForm()
    {
        $categories = Category::pluck('name', 'id');
        return view('add_food_item', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validation (validate image upload, etc.) goes here

        // Store food item
        $foodItem = new FoodItem();
        $foodItem->name = $request->input('name');
        $foodItem->price = $request->input('price');
        $foodItem->description = $request->input('description');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            //Store the image in the storage folder
            $path = $image->storeAs('images', $imageName, 'public');

            $foodItem->image = $path;
        }
        $foodItem->category_id = $request->input('category');

        $foodItem->save();

        return redirect('/add-food-item');
    }

    public function editForm($id)
    {
        $foodItem = FoodItem::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('edit_food_item', compact('foodItem', 'categories'));
    }

    // Update the edited food item
    public function update(Request $request, $id)
    {
        // Validation (similar to store method) goes here

        $foodItem = FoodItem::findOrFail($id);
        $foodItem->name = $request->input('name');
        $foodItem->price = $request->input('price');
        $foodItem->description = $request->input('description');
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image in the storage folder
            $path = $image->storeAs('images', $imageName, 'public');

            // Delete the previous image if it exists and update the image path
            if ($foodItem->image) {
                Storage::disk('public')->delete($foodItem->image);
            }
            $foodItem->image = $path;
        }
        $foodItem->category_id = $request->input('category');
        $foodItem->save();

        return redirect('/add-food-item');
    }

    // Remove a food item
    public function destroy($id)
    {
        $foodItem = FoodItem::findOrFail($id);
        $foodItem->delete();

        return redirect('/add-food-item');
    }

    public function showDescription($id)
    {
        $foodItem = FoodItem::findOrFail($id);
        return view('fooditem_description', ['foodItem' => $foodItem]);
    }

    public function displayAll()
    {
        if (!Session::has('order_code')) {
            return redirect()->route('scan_qr');
        }

        $categories = Category::all();
        $foodItems = FoodItem::all();
        return view('display_food_items', ['foodItems' => $foodItems, 'categories' => $categories]);
    }

    public function addFoodItemView()
    {
        $foodItems = FoodItem::with('category')->get();
        $categories = Category::pluck('name', 'id');

        return view('add_food_item', compact('foodItems', 'categories'));
    }
}

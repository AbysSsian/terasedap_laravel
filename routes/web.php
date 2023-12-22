<?php

use App\Models\Cart;
use App\Livewire\Menu;
use App\Livewire\Order;
use App\Livewire\Category;
use App\Livewire\EditOrder;

use App\Livewire\OrderHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/generate-url/{table}', function ($table) {
    $url = URL::signedRoute('check-route-validation', ['table' => $table], now()->addHour());
    return redirect($url);
})->name('table');

Route::get('/validation/{table}', function ($table) {
    Session::put('table', $table);
    $date = date('Ymd');
    $count = Cart::whereDate('created_at', now()->format('Y-m-d'))
        ->where('status', '!=', 'pending')
        ->where('table_number', $table)
        ->count();
    $count += 1;
    $code = $date . str_pad($table, 2, '0', STR_PAD_LEFT) . str_pad($count, 3, '0', STR_PAD_LEFT);
    Session::put('order_code', $code);
    $cart = Cart::where('order_code', $code)->first();

    if (!$cart) {
        Cart::create([
            'table_number' => $table,
            'order_code' => $code,
            'total_price' => 0,
        ]);
    }
    return redirect()->route('food-items');
})->name('check-route-validation')->middleware('signed');

Route::get('/menu', [FoodItemController::class, 'displayAll'])->name('food-items');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication'])->name('authentication');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/thankyou', function () {
    return view('thank_you');
})->name('thank_you');

Route::get('/error', function () {
    return view('scan_qr');
})->name('scan_qr');

Route::get('/fooditem/{id}/description', [FoodItemController::class, 'showDescription'])->name('fooditem.description');

Route::post('/confirm-order', [CartController::class, 'confirmOrder'])->name('confirmOrder');

Route::get('/receipt/{ordercode}', [CartController::class, 'downloadReceipt'])->name('downloadReceipt');

Route::get('/admin/category', Category::class)->name('admin.category')->middleware('auth', 'admin');
Route::get('admin/orders', Order::class)->name('admin.orders')->middleware('auth', 'admin');
Route::get('admin/menu', Menu::class)->name('admin.menu')->middleware('auth', 'admin');
Route::get('admin/history', OrderHistory::class)->name('admin.history')->middleware('auth', 'admin');
Route::get('admin/order/edit/initialize/{id}', function ($id) {
    $url = URL::signedRoute('order.edit', ['id' => $id]);

    return redirect($url);
})->name('initialize.edit')->middleware('auth', 'admin');

Route::get('admin/order/edit/{id}', EditOrder::class)->name('order.edit')->middleware('auth', 'admin', 'signed');




Route::get('/add-food-item', [FoodItemController::class, 'addFoodItemView'])->middleware('auth', 'admin')->name('add-menu');
Route::post('/add-food-item', [FoodItemController::class, 'store'])->name('fooditem.store')->middleware('auth', 'admin');

Route::get('/admin/menu/edit/{id}', [FoodItemController::class, 'editForm'])->name('food-item.edit')->middleware('auth', 'admin');
Route::post('save-menu/{id}', [FoodItemController::class, 'update'])->name('save_menu')->middleware('auth', 'admin');

// Route::put('/edit_food_item/{id}', [FoodItemController::class, 'update'])->name('food-item.update')->middleware('auth', 'admin');


Route::delete('/add-food-item/{id}', [FoodItemController::class, 'destroy'])->name('food_items.destroy')->middleware('auth', 'admin');

// Route for displaying the edit form for a food item
Route::get('/add-food-item/{id}/edit', [FoodItemController::class, 'editForm'])->name('food_items.editForm')->middleware('auth', 'admin');

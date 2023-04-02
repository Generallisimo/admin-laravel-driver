<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Проверка если зарегестрирован то редирект сразу
// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect('/admin');
//     } else {
//         return redirect('/login');
//     }
// });
Route::get('/', function () {
    return view ('welcome');
});

// админка для менеджера
Route::middleware(['auth', 'verified'])->group(function () {
    // главная
    Route::get('/admin', [AdminPanelController::class, 'AdminPanel'])->name('admin');
    // водители
    Route::get('/admin/drivers', [AdminPanelController::class, 'AdminDrivers'])->name('driver');
    // добавление
    Route::get('/admin/drivers/add-new-user', [AdminPanelController::class, 'addNewUser'])->name('addNewUser');
    Route::post('/admin/drivers/add-new-user/add-user', [AdminPanelController::class, 'addUser'])->name('addUser');
    // удаление
    Route::get('/admin/drivers/delete-user/{id}', [AdminPanelController::class, 'deleteUser'])->name('deleteUser');
    // cинхронизация
    Route::post('/admin/drivers/sync-drivers', [AdminPanelController::class, 'sync'])->name('sync-drivers');
    // водилы карточка
    Route::get('/admin/drivers/{id}', [AdminPanelController::class, 'show'])->name('showDriver');
    Route::post('/admin/drivers/{id}/files', [AdminPanelController::class, 'showFiles'])->name('showDriverUpload');

});


// Route::get('/authlogin', function () {
//     return view('/auth_admin/login');
// });


Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

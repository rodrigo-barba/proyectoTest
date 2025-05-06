<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\UserAccessDashboardMiddleware;

// landing Laravel (comento para usar las de Vue)
Route::get('/', function () {
    return view('welcome');
});

// Vue
// Route::get('/{n1?}/{n2?}', function () {
//     return view('vue');
// });

// ejemplo simple login usando autenticacion SPA
Route::post('user/login', [LoginController::class, 'authenticate']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// rutas del dashboard protegidas por auth para post y categorias 
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', UserAccessDashboardMiddleware::class]], function () {
    Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,
        'category' => App\Http\Controllers\Dashboard\CategoryController::class
    ]);
    Route::get('', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
});

Route::group(['prefix' => 'blog'], function () {
    // ruta para index
    Route::get('', [BlogController::class, 'index'])->name('blog.index');
    //ruta usando cache
    Route::get('detail/{id}', [BlogController::class, 'show'])->name('blog.show');
    // ruta sin usar cache
    // Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
});


require __DIR__.'/auth.php';

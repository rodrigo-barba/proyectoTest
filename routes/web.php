<?php

// use App\Http\Controllers\Blog\BlogController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// use App\Http\Middleware\UserAccessDashboardMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

// comenté la ruta anterior para poder usar esta con Vue
Route::get('/{n1?}/{n2?}', function () {
    return view('vue');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', UserAccessDashboardMiddleware::class]], function () {
//     Route::resources([
//         'post' => App\Http\Controllers\Dashboard\PostController::class,
//         'category' => App\Http\Controllers\Dashboard\CategoryController::class
//     ]);
//     Route::get('', function () {
//         return view('dashboard');
//     })->middleware(['auth'])->name('dashboard');
// });

// Route::group(['prefix' => 'blog'], function () {
//     // ruta para index
//     Route::get('', [BlogController::class, 'index'])->name('blog.index');
//     Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
// });


// require __DIR__.'/auth.php';

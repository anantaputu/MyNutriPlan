<?php

// Import Facades dan Models
use Illuminate\Support\Facades\Route;
use App\Models\Article;

// Import Controller
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\FoodMaterialController as AdminFoodMaterialController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\UserFoodMaterialController;
use App\Http\Controllers\Member\MenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Guest)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $latestArticles = Article::latest()->take(3)->get();
    return view('welcome', ['articles' => $latestArticles]);
})->name('welcome');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Rute yang Memerlukan Otentikasi
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute pengalihan utama setelah login berdasarkan peran
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('member.dashboard');
    })->name('dashboard');

    // Rute manajemen profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Grup Rute Khusus Admin
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('users', AdminUserController::class);
        Route::resource('food-materials', AdminFoodMaterialController::class);
        Route::resource('menus', AdminMenuController::class);
        Route::resource('articles', AdminArticleController::class);

    });

    /*
    |--------------------------------------------------------------------------
    | Grup Rute Khusus Member
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:member')->prefix('member')->name('member.')->group(function () {
        
        // --- PERBAIKAN DI SINI ---
        // Rute dashboard sekarang menunjuk ke controller yang benar.
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        
        // Rute untuk mengelola bahan makanan milik pengguna
        Route::resource('foodMaterials', UserFoodMaterialController::class)->except(['show']);
        
        Route::resource('menus', MenuController::class)->only(['index']);
        Route::get('/menus/{menu:slug}', [MenuController::class, 'show'])->name('menus.show');
    });
});


// Rute Otentikasi (Login, Register, Logout, dll.)
require __DIR__.'/auth.php';

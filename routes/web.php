<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/admin', static fn () => redirect('/admin/index.php'));
Route::get('/dashboard.php', static fn () => redirect('/admin/dashboard.php'));
Route::get('/blogs.php', static fn () => redirect('/admin/blogs.php'));
Route::get('/blog_edit.php', static function (Request $request) {
    $query = $request->getQueryString();
    return redirect('/admin/blog_edit.php' . ($query ? ('?' . $query) : ''));
});
Route::get('/header_edit.php', static fn () => redirect('/admin/header_edit.php'));
Route::get('/background_edit.php', static fn () => redirect('/admin/background_edit.php'));
Route::get('/media.php', static function (Request $request) {
    $query = $request->getQueryString();
    return redirect('/admin/media.php' . ($query ? ('?' . $query) : ''));
});
Route::get('/edit.php', static function (Request $request) {
    $query = $request->getQueryString();
    return redirect('/admin/edit.php' . ($query ? ('?' . $query) : ''));
});

Route::get('/index.html', static fn () => redirect()->route('home'));
Route::get('/about.html', static fn () => redirect()->route('about'));
Route::get('/services.html', static fn () => redirect()->route('services'));
Route::get('/pricing.html', static fn () => redirect()->route('pricing'));
Route::get('/projects.html', static fn () => redirect()->route('projects'));
Route::get('/contact.html', static fn () => redirect()->route('contact'));
Route::get('/blog.html', static fn () => redirect()->route('blog.index'));

Route::get('/blog.php', static function (Request $request) {
    $id = (string) $request->query('id', '');

    if ($id === '') {
        return redirect()->route('blog.index');
    }

    return redirect()->route('blog.show', ['id' => $id]);
});

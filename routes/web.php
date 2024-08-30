<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google/redirect',function(Request $request){
    return Socialite::driver("google")->redirect();
});

Route::get('/auth/google/callback',function(Request $request){
    $googleUser = Socialite::driver("google")->user();

    $user = User::updateOrCreate(
        ['google_id'=> $googleUser->id],
        [
            'name'=> $googleUser->name,
            'email' => $googleUser->email,
            'password' => Str::password(12),
            'email_verified_at' => now()
        ]);

    Auth::login($user);

    return redirect("http://localhost:8000/dashboard");

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

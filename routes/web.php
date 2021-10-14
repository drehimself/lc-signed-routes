<?php

use App\Mail\ConfirmAppointmentMailable;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'appointments' => auth()->user()->appointments,
    ]);
})->middleware(['auth'])->name('dashboard');

Route::post('/confirm/{appointment}', function (Request $request, Appointment $appointment) {
    $appointment->confirmed_at = now();
    $appointment->save();

    return redirect('dashboard')->with('success_message', 'Appointment was confirmed!');
})->middleware(['auth'])->name('confirm');


Route::get('/admin', function () {
    return view('admin', [
        'appointments' => Appointment::with('user')->get(),
    ]);
})->middleware(['auth'])->name('admin');

Route::post('/email/{appointment}', function (Request $request, Appointment $appointment) {
    Mail::to($appointment->user)->send(new ConfirmAppointmentMailable($appointment));

    return redirect('admin')->with('success_message', 'Email was sent!');
})->middleware(['auth'])->name('email');


require __DIR__.'/auth.php';

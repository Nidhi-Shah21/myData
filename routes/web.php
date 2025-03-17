<?php

use App\Http\Controllers\GoogleCalendarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//google calender
//php artisan serve --host=localhost --port=8000
Route::get('auth/google', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);
Route::get('add-event', [GoogleCalendarController::class, 'addEvent'])->name('addEvent');

Route::get('events', [GoogleCalendarController::class, 'listEvents'])->name('google.events');

Route::get('delete-event/{eventId}', [GoogleCalendarController::class, 'deleteEvent'])->name('google.deleteEvent');

Route::any('update-event/{eventId}', [GoogleCalendarController::class, 'updateEvent'])->name('google.updateEvent');





<?php
Route::group(['middleware' => 'Maintenance'], function () {
    Route::get('/', function () {
        //return  \Illuminate\Support\Facades\Hash::make('12345');
        return view('style.home');
    });
});

Route::any('maintenance', function() {
    if (setting()->status === 'open')
    return redirect('/');
    return view('style.maintenance');

});


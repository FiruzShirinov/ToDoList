<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\ListUnitController;
use App\Http\Controllers\UserController;
use App\Models\ListItem;
use App\Models\ListUnit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'reset' => false,
    'confirm' =>false,
    'verify' => false
]);

Route::middleware('auth')->group(function(){
    Route::controller(ListUnitController::class)->group(function(){
        Route::get('/list-units', 'index')->name('list-units');
        Route::post('/list-units', 'store');
        Route::patch('/list-units/{listUnit}', 'update');
        Route::delete('/list-units/{listUnit}', 'destroy');
        Route::post('/share-list-unit-with-user/{listUnit}/{user}', 'shareListUnitWithUser');
    });

    Route::controller(ListItemController::class)->group(function(){
        Route::get('/list-items/{listUnit}', 'index')->name('items.index');
        Route::post('/list-items/{listUnit}', 'store');
        Route::patch('/list-items/{listUnit}/{listItem}', 'update');
        Route::delete('/list-items/{listUnit}/{listItem}', 'destroy');
        Route::post('/upload-image/{listItem}', 'uploadImage');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/get-available-users/{listUnit}', 'getAvailableUsers');
    });

    Route::controller(ImageController::class)->group(function(){
        Route::post('/images/{listItem}', 'store');
        Route::delete('/images/{listItem}', 'destroy');
    });
});

Route::get('/test', function(){
    $listUnit = ListUnit::first();
    // dd($listUnit->sharedWithUsers()->pluck('id'));

    $me = User::first();
    dd(get_class($me));
    $chuck = User::latest()->first();
    // dd(
    //     $user->sharedByMe()->get(),
    //     $user->sharedWithMe()->get()
    // );
    $listUnitsSharedByMe = $me->sharedListUnitsByMe()->get();
    $listUnitsSharedWithChuck = $chuck->sharedListUnitsWithMe()->get();

    foreach ($listUnitsSharedByMe as $listUnit) {
        dump($listUnit, $listUnit->pivot->sharedBy->name, $listUnit->pivot->sharedWith->name);
    }
    foreach ($listUnitsSharedWithChuck as $listUnit) {
        dump($listUnit, $listUnit->pivot->sharedBy->name, $listUnit->pivot->sharedWith->name);
    }
});

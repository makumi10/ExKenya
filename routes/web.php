<?php

use App\Models\City;
use App\Models\Hotel;
use App\Models\County;
use App\Models\Restaurant;
use App\Http\Livewire\User\County as CountyController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\CitiesList;
use App\Http\Livewire\User\City as UserCity;
use App\Http\Livewire\User\CountiesList;
use App\Http\Livewire\User\Hotel as UserHotel;
use App\Http\Livewire\User\HotelsList;
use App\Http\Livewire\User\PointOfInterest;
use App\Http\Livewire\User\PoisList;
use App\Http\Livewire\User\Recommendation;
use App\Http\Livewire\User\Restaurant as UserRestaurant;
use App\Http\Livewire\User\RestaurantsList;
use App\Models\PointOfInterest as ModelsPointOfInterest;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostsController;

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
    $counties = County::all()->random(4);
    $cities = City::all()->random(4);
    $pois = ModelsPointOfInterest::all()->random(4);
    $hotels = Hotel::all()->random(4);
    $restaurants = Restaurant::all()->random(4);
    return view('landing.welcome', compact('counties', 'cities' , 'pois' , 'hotels' , 'restaurants'));
})->name('home');
//Blog posts Routes
Route::post('/vote/upvote/{id}', 'App\Http\Controllers\PostsController@upVote')->name('upvote');
Route::post('/vote/downvote/{id}', 'App\Http\Controllers\PostsController@downVote')->name('downvote');
Route::resource('/blog', PostsController::class);

// user routes
Route::middleware(['auth' ])->group(function(){
    route::get('/counties',CountiesList::class )->name('user.counties');
    route::get('/cities',CitiesList::class )->name('user.cities');
    route::get('/restaurants',RestaurantsList::class )->name('user.restaurants');
    route::get('/hotels',HotelsList::class )->name('user.hotels');
    route::get('/pois',PoisList::class )->name('user.pois');

    route::get('/county/{id}',CountyController::class )->name('user.county');
    route::get('/city/{id}',UserCity::class )->name('user.city');
    route::get('/point-of-interest/{id}',PointOfInterest::class )->name('user.poi');
    route::get('/hotel/{id}',UserHotel::class )->name('user.hotel');
    route::get('/restaurant/{id}',UserRestaurant::class )->name('user.restaurant');


    route::get('/get-recomendation',Recommendation::class )->name('user.recomendation');
});


// admin routes
Route::middleware(['auth', 'role:administrator'])->group(function () {

    route::get('/admin/users', function () {
        return view('pages.admins.dashboard');
    })->name('admin.users');

    route::get('/admin/counties', function () {
        return view('pages.admins.dashboard');
    })->name('admin.counties');

    route::get('/admin/county/{id}/manage/cities', function ($id) {
        $county = County::findOrFail($id);
        return view('pages.admins.county', ['id' => $id, 'county' => $county]);
    })->name('admin.county.manage.cities');

    route::get('/admin/county/{id}/manage/hotels', function ($id) {
        $county = County::findOrFail($id);
        return view('pages.admins.county', ['id' => $id, 'county' => $county]);
    })->name('admin.county.manage.hotels');

    route::get('/admin/county/{id}/manage/pois', function ($id) {
        $county = County::findOrFail($id);
        return view('pages.admins.county', ['id' => $id, 'county' => $county]);
    })->name('admin.county.manage.pointsOfInterest');

    route::get('/admin/county/{id}/manage/restaurants', function ($id) {
        $county = County::findOrFail($id);
        return view('pages.admins.county', ['id' => $id, 'county' => $county]);
    })->name('admin.county.manage.restaurants');

    route::get('/admin/manage-channels', function () {
        return view('pages.admins.dashboard');
    })->name('admin.manage-channels');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' , 'userHasDetails'])->name('dashboard');

//Comment Route
Route::post('/comment/store', 'App\Http\Controllers\CommentController@store')->name('comment.add');
Route::delete('/comment/delete/{id}', 'App\Http\Controllers\CommentController@destroy')->name('comment.delete');

//Channel Routesc
Route::get('/channel/{id}', 'App\Http\Controllers\PostsController@getChannel')->name('Channel');




require __DIR__ . '/auth.php';
Route::get('/blogg', function () {
    return view('blog');
});
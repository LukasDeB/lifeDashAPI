<?php

use Illuminate\Http\Request;
use \Unisharp\FileApi\FileApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'upload',
    'middleware' => ['cors'],
], function() {
    Route::post('/quests', 'QuestsController@uploadIcon');
});

Route::group([
    'prefix' => 'goals',
    'middleware' => ['cors'],
], function() {
    Route::get('/', 'GoalsController@index');
    Route::get('/{id}', 'GoalsController@show');
    Route::post('/', 'GoalsController@create');
    Route::put('/{goal}', 'GoalsController@update');
    Route::delete('/{goal}', 'GoalsController@delete');

    Route::get('/{goal}/subGoals', 'GoalsController@subGoals');
    Route::post('/{goal}/subGoals', 'GoalsController@addSubGoal');
    Route::delete('/{goal}/subGoals/{subGoal}', 'GoalsController@removeSubGoal');
    
    Route::put('/{goal}/addSavingsProgress', 'GoalsController@addSavingsProgress');
    
    Route::prefix('/subGoals')->group(function() {
        Route::get('/', 'GoalsController@subGoals');
    });
});

Route::group([
    'prefix' => 'quests',
    'middleware' => ['cors'],
], function() {
    Route::get('/', 'QuestsController@index');
    Route::get('/{id}', 'QuestsController@show');
    Route::post('/', 'QuestsController@create');
    Route::put('/{quest}', 'QuestsController@update');
    Route::delete('/{quest}', 'QuestsController@delete');

    Route::get('/{quest}/icon', 'QuestsController@icon');
    Route::post('/{quest}/icon', 'QuestsController@uploadIcon');
});
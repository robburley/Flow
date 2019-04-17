<?php

Route::get('/test', 'TestController@index');

Route::middleware('guest')
     ->group(function () {
         Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
         Route::post('login', 'Auth\LoginController@login');
     });

Route::middleware('auth')
     ->group(function () {
         Route::get('logout', 'Auth\LoginController@logout')->name('logout');

         Route::get('/', 'DashboardController@index')->name('dashboard');

         Route::namespace('Campaigns')
              ->group(function () {
                  Route::post('/prospects', 'ProspectsController@store')->name('prospects.store');
                  Route::get('/prospects/{prospect}', 'ProspectsController@show')->name('prospects.show');
                  Route::get('/prospects/{prospect}/edit', 'ProspectsController@edit')->name('prospects.edit');
                  Route::post('/prospects/{prospect}', 'ProspectsController@update')->name('prospects.update');

                  Route::group(['middleware' => ['role:Admin|Supervisor']], function () {
                      Route::get('/validation', 'ValidationController@index')->name('validation.index');
                      Route::get('/validation/{review}', 'ValidationController@show')->name('validation.show');
                      Route::post('/validation/{review}', 'ValidationController@update')->name('validation.update');
                      Route::delete('/validation/{review}', 'ValidationController@destroy')->name('validation.destroy');

                      Route::get('/assignment', 'AssignmentController@index')->name('assignment.index');
                      Route::get('/assignment/{lead}', 'AssignmentController@show')->name('assignment.show');
                      Route::post('/assignment/{lead}', 'AssignmentController@update')->name('assignment.update');
                  });

                  Route::group(['middleware' => ['role:Admin|Supervisor|Closer']], function () {
                      Route::get('mobile/leads/{lead}', 'Mobile\LeadsController@show')->name('mobile.leads.show');
                      Route::post('mobile/leads/{lead}', 'Mobile\LeadsController@update')->name('mobile.leads.update');
                      Route::get('mobile/leads/pipeline/{status}', 'Mobile\LeadsController@index')
                           ->name('mobile.leads.index');

                      Route::get('mobile/opportunities/{opportunity}', 'Mobile\OpportunitiesController@show')
                           ->name('mobile.opportunities.show');
                      Route::post('mobile/opportunities/{opportunity}', 'Mobile\OpportunitiesController@update')
                           ->name('mobile.opportunities.update');
                      Route::get('mobile/opportunities/pipeline/{status}', 'Mobile\OpportunitiesController@index')
                           ->name('mobile.opportunities.index');
                  });

                  Route::post('documents', 'DocumentsController@store')
                       ->name('documents.store');
                  Route::get('documents/{document}', 'DocumentsController@show')
                       ->name('documents.show');

                  Route::post('notes', 'NotesController@store')
                       ->name('notes.store');

                  Route::get('callbacks', 'CallbacksController@index')
                       ->name('callbacks.index');
              });

         Route::group(['middleware' => ['role:Admin']], function () {
             Route::namespace('Settings')
                  ->prefix('settings')
                  ->name('settings.')
                  ->group(function () {
                      Route::prefix('users')
                           ->name('users.')
                           ->group(function () {
                               Route::get('/', 'UsersController@index')->name('index');
                               Route::get('/new', 'UsersController@create')->name('create');
                               Route::post('/', 'UsersController@store')->name('store');
                               Route::get('/{user}', 'UsersController@edit')->name('edit');
                               Route::patch('/{user}', 'UsersController@update')->name('update');
                           });
                  });

             Route::namespace('Reports')
                  ->prefix('reports')
                  ->name('reports.')
                  ->group(function () {
                      Route::prefix('mobile')
                           ->name('mobile.')
                           ->group(function () {
                               Route::get('/reviews', 'ReviewsController@index')->name('reviews.index');
                               Route::get(
                                   '/qualification',
                                   'QualificationController@index'
                               )->name('qualification.index');
                           });
                  });
         });
     });

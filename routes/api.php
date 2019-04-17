<?php

Route::namespace('Api')
     ->middleware('auth:api')
     ->group(function () {
         Route::post('/prospects', 'ProspectsController@store');
         Route::post('/prospects/{prospect}', 'ProspectsController@update');

         Route::post('/prospects/{prospect}/contacts', 'ContactsController@store');
         Route::post('/prospects/{prospect}/contacts/{contact}', 'ContactsController@update');
         Route::delete('/prospects/{prospect}/contacts/{contact}', 'ContactsController@destroy');

         Route::post('/prospects/{prospect}/reviews/', 'ReviewsController@store');
         Route::post('/prospects/{prospect}/reviews/{review}', 'ReviewsController@update');

         Route::get('/callbacks/', 'CallbacksController@index');
         Route::post('/callbacks/', 'CallbacksController@store');
         Route::post('/callbacks/{callback}', 'CallbacksController@update');

         Route::get('/helpers/file-types', 'HelpersController@fileTypes');
         Route::get('/helpers/closers', 'HelpersController@closers');

         Route::post('/notes', 'NotesController@store');

         Route::prefix('mobile/opportunities/{opportunity}/proposals')
              ->group(function () {
                  Route::post('/', 'ProposalsController@store');
                  Route::post('/{proposal}', 'ProposalsController@update');
                  Route::post('/{proposal}/email', 'EmailProposalsController@store');
                  Route::post('/{proposal}/select', 'SelectProposalController@store');
              });
     });

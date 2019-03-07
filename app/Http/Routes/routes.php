<?php
// allow origin
header('Access-Control-Allow-Origin: *');
// add any additional headers you need to support here
header('Access-Control-Allow-Headers: Origin, Content-Type');
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/




Route::get('payza/ipn','HomeController@payzaIpn');
Route::get('api/stats','HomeController@websiteStats');
    //
    
    Route::post('users/register','HomeController@register');
    Route::get('/assignment','HomeController@assignment');
    Route::get('/how-it-works','HomeController@howitworks')->name('how-it-works');
    Route::get('/faqs','HomeController@faqs');
    Route::get('/pricing','HomeController@pricing');
    Route::get('/guarantees','HomeController@guarantees');
    Route::get('/services','HomeController@services');
    Route::get('/essay-writer','HomeController@essaywriter');
    Route::get('/dissertation','HomeController@dissertation');
    Route::get('/homework','HomeController@homework');
    Route::get('/coursework','HomeController@coursework');
    Route::get('/research-papers','HomeController@researchpapers');
	Route::get('/case-study','HomeController@casestudy');
    Route::get('/thesis','HomeController@thesis');
	Route::get('/us','UnitedStatesController@index');
	Route::get('/au','AustraliaController@index');
	Route::get('/uk','UnitedKingdomController@index');
	
	
	
    Route::get('/money-back-guarantee','HomeController@moneybackguarantee')->name('money-back-guarantee');;
    Route::get('/revision-policy','HomeController@revisionpolicy')->name('revision-policy');;
    Route::get('/privacy-policy','HomeController@privacypolicy')->name('privacy-policy');;
    Route::get('/plagiarism-free-policy','HomeController@plagiarismfreepolicy')->name('plagiarism-free-policy');;
    Route::get('/terms-conditions','HomeController@termsconditions')->name('terms-conditions');;
    

        Route::post('users/login','HomeController@login');
        Route::group(['prefix' => 'api'], function () {
        Route::get('check-email','ExternalController@checkEmail');
        Route::get('help-image','ExternalController@helpImage');
        Route::get('/login','UserController@login');
        Route::get('/login/self','ExternalController@self');
        Route::get('/rates','ExternalController@getRates');
        Route::get('is_loggedin',function(){
           echo json_encode(Auth::user());
        });
    });
    Route::group(['prefix' => 'guest'], function () {
        Route::any('/order','ExternalController@guestOrder');
        Route::any('/preview/{order}','ExternalController@preview');

    });

     Route::get('/','FrontController@index');

     //route for post pages
     Route::get('/essay-writer/{id}','HomeController@showPost');
     Route::get('/post/{id}','HomeController@showPost');
     Route::get('/case-study/{id}','HomeController@showPost');
     Route::get('/dissertation/{id}','HomeController@showPost');
     Route::get('/homework/{id}','HomeController@showPost');
     Route::get('/coursework/{id}','HomeController@showPost');
     Route::get('/research-papers/{id}','HomeController@showPost');
     Route::get('/thesis/{id}','HomeController@showPost');
     Route::get('/us/{id}','HomeController@showPost');
     Route::get('/assignment-expert','HomeController@showPost');    
     Route::get('/do-my-assignment','HomeController@showPost');
	Route::get('/buy-assignment-online','HomeController@showPost');
	Route::get('/assignment-expert','HomeController@showPost');
	Route::get('/assignment-writing-help','HomeController@showPost');
	Route::get('/my-assignment-help','HomeController@showPost');
	Route::get('/cheap-assignment-help-australia','HomeController@showPost');	 
	Route::get('/help-on-assignments','HomeController@showPost');	
	Route::get('/write-my-assignment','HomeController@showPost');	
	Route::get('/assignment-help-tutors','HomeController@showPost');
	Route::get('/homework-and-assignment-help','HomeController@showPost');
	
 
    Route::Auth();

    //Pre-injected routed to order controller


    Route::post('admin/search','OrderController@search');    
    Route::group(['prefix' => 'promotions'], function () {
        Route::get('/','PromotionController@index');
        Route::any('/add','PromotionController@add');
        Route::get('/changestatus/{promotion}/{status}','PromotionController@changeStatus');
        Route::get('/delete/{promotion}','PromotionController@delete');
        Route::get('/search','PromotionController@search');
    });

    Route::group(['prefix' => 'config'], function () {
        Route::get('/','ConfigurationController@index');
    });


    Route::group(['prefix' => 'writer_categories'], function () {
        Route::get('/','WriterCategoryController@index');
        Route::any('/add','WriterCategoryController@add');
        Route::get('/delete/{writer_category}','WriterCategoryController@delete');
    });
    Route::group(['prefix' => 'forgot'], function () {
        Route::get('password','ResetController@index');
        Route::post('password','ResetController@index');
        Route::get('reset','ResetController@reset');
        Route::post('reset','ResetController@reset');
    });

    Route::group(['prefix' => 'admin_groups'], function () {
        Route::get('/','AdminGroupController@index');
        Route::get('/add','AdminGroupController@add');
        Route::post('/add','AdminGroupController@save');
        Route::get('/view/{id}','AdminGroupController@view');
        Route::post('/view/{id}','AdminGroupController@addUser');
    });


     Route::group(['prefix' => 'posts'], function () {
        Route::get('/','AdminPostController@index');
        Route::get('/add','AdminPostController@add');
        Route::post('/add','AdminPostController@save');
        Route::get('/view/{id}','AdminPostController@view');
        Route::post('/view/{id}','AdminPostController@edit');
        Route::get('/delete/{id}','AdminPostController@delete');



    });

      Route::get('/test','AdminPostController@test');

    

    

    Route::group(['prefix' => 'emails'], function () {
               Route::get('/send','EmailController@sendEmails');
               Route::put('/send','EmailController@editEmail');
               Route::post('/send','EmailController@mailUsers');
    });

    Route::group(['prefix' => 'currency'], function () {
        Route::get('/','CurrencyController@index');
        Route::get('/add','CurrencyController@add');
        Route::post('/add','CurrencyController@save');
        Route::get('/delete/{currency}','CurrencyController@delete');
    });
    Route::group(['prefix' => 'download'], function () {
        Route::get('/path',function(\Illuminate\Http\Request $request){
          $path = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$request->path;
            $filetype = $request->file_type;
            $filename = $request->filename;
            $headers = array(
                'Content-Type'=>$filetype
            );
            Return Response::download($path,$filename,$headers);
        });
    });

    Route::group(['prefix' => 'fines'], function () {
        Route::get('/remove/{fine}','FinesController@remove');
        Route::post('/update','FinesController@update');
    });
    Route::group(['prefix' => 'updates'], function () {
        Route::get('/','UpdatesController@index');
        Route::post('/','UpdatesController@updateNow');
    });
    Route::group(['prefix' => 'additional-features'], function () {
        Route::get('/','AdditionalFeaturesController@index');
        Route::get('delete/{additionalFeature}','AdditionalFeaturesController@delete');
        Route::post('/','AdditionalFeaturesController@store');
    });


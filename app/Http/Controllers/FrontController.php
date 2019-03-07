<?php namespace App\Http\Controllers;

use App\Repositories\EmailRepository;
use App\Repositories\PayzaRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Http\Request;
use App\User;
use App\Assign;
use App\Order;
use Validator;
use App\WriterCategory;
use Auth;
use URL;
use App\BidMapper;
use App\Document;
use App\Subject;
use App\Rate;
use App\Academic;
use App\Style;
use App\Language;
use App\Currency;
use App\AdditionalFeature;
class FrontController extends Controller {

	

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('web');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$this->middleware('auth');
		 $documents= Document::where('deleted','=','0')->get();
        $subjects = Subject::where('deleted','=','0')->get();
        $rates = Rate::where('deleted','=',0)->orderBy('hours','desc')->get();
        $academic_levels = Academic::where('deleted','=',0)->get();
        $styles = Style::where('deleted','=',0)->get();
        $languages = Language::where('deleted','=',0)->get();
        $writer_categories = WriterCategory::where('deleted','=',0)->orderBy('amount','asc')->get();
        $currencies = Currency::where('deleted','=',0)->get();
        $additional_features = AdditionalFeature::orderBy('id','desc')->get();
        $settings = ['documents'=>$documents,'additional_features'=>$additional_features,'styles'=>$styles,'languages'=>$languages,'subjects'=>$subjects,'rates'=>$rates,'academics'=>$academic_levels,'writer_categories'=>$writer_categories,'currencies'=>$currencies];
        $webRepo = new WebsiteRepository();
        $website = $webRepo->getWebsite();
    	 return view('front.home_view',[
            'documents'=>$documents,
            'subjects'=>$subjects,
            'academic_levels'=>$academic_levels,
            'settings'=>$settings,
            'styles'=>$styles,
            'languages'=>$languages,
            'writer_categories'=>$writer_categories,
            'currencies'=>$currencies,
            'additional_features'=>$additional_features,
           'website'=>$website
            
        ]);
	}

	
}

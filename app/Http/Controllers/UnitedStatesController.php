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
use DB;
class UnitedStatesController extends Controller {

	protected $user;
    protected $orders;
    protected $fileSaver;
    protected $emailer;
    protected $assign_active = 0;
    protected $assign_pending = 3;
    protected $assign_revision = 2;
    protected $assign_completed = 4;
    protected $order_working = 1;
    protected $order_new = 0;
    protected $bid_assigned = 1;
    protected $order_confirmed = 4;
    protected $cancelled_status = 7;
	
    public $website;
	public $documents;
	public $subjects;
	public $rates;
	public $academic_levels;
	public $styles;
	public $languages;
	public $writer_categories;
	public $additional_features;
	public $settings;
	public $data;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('web');
		
		$this->documents= Document::where('deleted','=','0')->get();
        $this->subjects = Subject::where('deleted','=','0')->get();
        $this->rates = Rate::where('deleted','=',0)->orderBy('hours','desc')->get();
        $this->academic_levels = Academic::where('deleted','=',0)->get();
        $this->styles = Style::where('deleted','=',0)->get();
        $this->languages = Language::where('deleted','=',0)->get();
        $this->writer_categories = WriterCategory::where('deleted','=',0)->orderBy('amount','asc')->get();
        $this->currencies = Currency::where('deleted','=',0)->get();
        $this->additional_features = AdditionalFeature::orderBy('id','desc')->get();
        $this->settings = ['documents'=>$this->documents,'additional_features'=>$this->additional_features,'styles'=>$this->styles,'languages'=>$this->languages,'subjects'=>$this->subjects,'rates'=>$this->rates,'academics'=>$this->academic_levels,'writer_categories'=>$this->writer_categories,'currencies'=>$this->currencies];
	    $webRepo = new WebsiteRepository();
	    $this->website= $webRepo->getWebsite();

	   $this->data= [
            'documents'=>$this->documents,
            'subjects'=>$this->subjects,
            'academic_levels'=>$this->academic_levels,
            'settings'=>$this->settings,
            'styles'=>$this->styles,
            'languages'=>$this->languages,
            'writer_categories'=>$this->writer_categories,
            'currencies'=>$this->currencies,
            'additional_features'=>$this->additional_features,
            'website'=>$this->website            
        ];
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('countries.us.index',$this->data);
	}
	
    function howitworks(){       
    	 return view('howitworks',$this->data);
    }

    function faqs(){   	  
    	 return view('faqs',$this->data);
    }
    
    function pricing(){
        $rates = Rate::where('deleted','=',0)->orderBy('hours','desc')->get();
        $academic_levels = Academic::where('deleted','=',0)->get();
        $deadline=Rate::where('deleted','=',0)->groupBy('label')->orderBy('hours','asc')->get(['label','academic_id','hours']);
        return view('pricing',['rates'=>$rates,'academic_levels'=>$academic_levels,'deadlines'=>$deadline,'website'=>$this->website]);
    }

    function guarantees(){
    	 return view('gurantee',['website'=>$this->website]);
    }
    
    function moneybackguarantee(){
    	 return view('money-back-guarantee',['website'=>$this->website]);
    }
   
    
    function termsconditions(){
    	 return view('terms-conditions',['website'=>$this->website]);
    }

    function revisionpolicy(){
    	 return view('revision-policy',['website'=>$this->website]);
    }
    
    function privacypolicy(){
    	 return view('privacy-policy',['website'=>$this->website]);
    }
	/*
	*	MAIN SILO
	*   -Case Study
	*	-Dissertation
	*	-Homework
	*	-Coursework
	*	-Research Papers
	*	-Thesis
	*	-Essay Writer
	*/
	
	function services(){
    	 return view('services',$this->data);
    }
	
	function essaywriter(){
    	 return view('front.silo.essay-writer',$this->data);
	}
	
    function casestudy(){
    	 return view('front.silo.case-study',$this->data);
    }
	
	function dissertation(){
    	 return view('front.silo.dissertation',$this->data);
    }
	
	function homework(){
    	 return view('front.silo.homework',$this->data);
    }
	
	function coursework(){
    	 return view('front.silo.coursework',$this->data);
    }
	
	function researchpapers(){
    	 return view('front.silo.research-papers',$this->data);
    }
	
	function thesis(){
    	 return view('front.silo.thesis',$this->data);
    }
}

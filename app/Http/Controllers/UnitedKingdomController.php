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
class UnitedKingdomController extends Controller {

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
		return view('countries.uk.index',$this->data);
	}
}

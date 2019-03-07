<?php 
namespace App\Http\Controllers;
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
class HomeController extends Controller {

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
		$this->middleware('auth');
		return redirect("order");
	}

	public function register(Request $request){
		if($request->method()=='POST'){
			if(!$request->isXmlHttpRequest()){
				$robotChecker = new CaptchaRepository();
				$not_robot = $robotChecker->checkRobot($request);
				if(!$not_robot){
					return redirect("user/register")
							->withErrors([
									'robot'=>"Hey, $request->name. You Are a suspected Robot!"
							])
							->withInput();
				}
			}
			$emailer = new EmailRepository();
			$websiteRepo = new WebsiteRepository();
			$website_id = $websiteRepo->getWebsiteId();
			$exists = User::where([
					['website_id','=',$website_id],
					['email','=',$request->email]
			])->get();
			$this->validate($request,[
					'name' => 'required|max:255',
					'phone' => 'required|max:18',
					'email' => 'required|email|max:255',
					'password' => 'required|confirmed|min:6',
			]);
			if(count($exists)>0){
				$this->validate($request,[
						'name' => 'required|max:255',
						'phone' => 'required|max:18',
						'email' => 'required|email|unique:users|max:255',
						'password' => 'required|confirmed|min:6',
				]);

			}
//			if ($validator->fails()) {
//				if($request->isXmlHttpRequest()){
//					return $validator->errors();
//				}
//				return redirect("user/register")
//						->withErrors($validator)
//						->withInput();
//			}
			$writer_category = WriterCategory::where('deleted','=',0)->orderBy('cpp','asc')->first();
			$user = User::create([
					'name'=>$request->name,
					'email'=>$request->email,
					'phone'=>$request->phone,
					'layout'=>env('LAYOUT','gentella'),
					'role'=>'client',
					'website_id'=>$website_id,
					'country'=>$request->country,
					'password'=>bcrypt($request->password)
			]);
			$user->writer_category_id = $writer_category->id;
            $user->referred_by = round($request->referred_by,0);
			$user->save();
			Auth::login($user);
			$emailer->sendRegistrationEmail($user);
			if($request->isXmlHttpRequest()){
				return $user;
			}
			return redirect('order')->with('notice',['class'=>'success','message'=>'Registration successful']);
		}
		return view('auth.register',[

		]);
	}

	public function login(Request $request){
			$password = $request->password;
        $webRepo = new WebsiteRepository();
        $website_id = $webRepo->getWebsiteId();
        $email = $request->email;
           if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            if (Auth::attempt(['email' => $email, 'password' => $password,'website_id'=>$website_id], false)) {
                $user = Auth::user();
                $response = ['status' => true,'url'=>URL::to(env('HOME','stud')),'name'=>$user->name];
            } else {
                $response = ['status' => false, 'error' => 'Invalid email or password'];
            }
        }else{
            if (Auth::attempt(['username' => $email, 'password' => $password,'website_id'=>$website_id], false)) {
                $response = ['status' => true,'url'=>URL::to(env('HOME','stud'))];
                $user = Auth::user();
            } else {
                $response = ['status' => false, 'error' => 'Invalid email or password'];
            }
        }
        return $response;
	}

	public function payzaIpn(Request $request){
	    $payza = new PayzaRepository();
        $token = $request->token;
        $response = $payza->confirmCode($token);
        return $response;
    }

    public function websiteStats(Request $request){
    	$cheat = $request->cheat;
    	$active = Assign::where('status','=',$this->assign_active)->count()+$cheat;
        $completed = Assign::where('status','=',$this->assign_completed)->count()+$cheat;
        $revision = Assign::where('status','=',$this->assign_revision)->count()+$cheat;
        $pending = Assign::where('status','=',$this->assign_pending)->count()+$cheat;
        $active_bids = BidMapper::
        join('orders','orders.id','=','bid_mappers.order_id')
        ->where([
            ['bid_mappers.status','=',1],
            ['orders.deleted_at','=',null]
        ])->count();
        $inactive_bids = BidMapper::join('orders','orders.id','=','bid_mappers.order_id')
        ->where([
            ['bid_mappers.status','=',0],
            ['orders.deleted_at','=',null]
        ])->count();
        return [
        	'active'=>$active,
        	'completed'=>$completed,
        	'revision'=>$revision,
        	'pending'=>$pending,
        	'new'=>$active_bids+$inactive_bids+$cheat
        ];
    }
	
    function howitworks(){       
    	 return view('front.howitworks',$this->data);
    }

    function faqs(){   	  
    	 return view('front.faqs',$this->data);
    }
    
    function pricing(){
        $rates = Rate::where('deleted','=',0)->orderBy('hours','desc')->get();
        $academic_levels = Academic::where('deleted','=',0)->get();
        $deadline=Rate::where('deleted','=',0)->groupBy('label')->orderBy('hours','asc')->get(['label','academic_id','hours']);
        return view('front.pricing',['rates'=>$rates,'academic_levels'=>$academic_levels,'deadlines'=>$deadline,'website'=>$this->website]);
    }

    function guarantees(){
    	 return view('front.gurantee',['website'=>$this->website]);
    }
    
    function moneybackguarantee(){
    	 return view('front.money-back-guarantee',['website'=>$this->website]);
    }
   
    
    function termsconditions(){
    	 return view('front.terms-conditions',['website'=>$this->website]);
    }

    function revisionpolicy(){
    	 return view('front.revision-policy',['website'=>$this->website]);
    }
    
    function privacypolicy(){
    	 return view('front.privacy-policy',['website'=>$this->website]);
    }
	
	function plagiarismfreepolicy(){
    	 return view('front.plagiarism-free-policy',['website'=>$this->website]);
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
    	 return view('front.services',$this->data);
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
	
	/*
	*	CATEGORY PAGES FOR SILO
	*/
	
	function cheapessayhelp(){
    	 return view('front.silo.essay.cheap-essay-help',$this->data);
    }

     public function showPost(Request $request,$id=0){

             $uri = $request->path();
              $getallservices = explode('/', $uri);
              if(count($getallservices)==2)
              {
              $match=$getallservices[0];
              $services =DB::table('post')->select('page_name','title','main_heading')->where('page_name','like',"$match%")->orderBy('createdOn','desc')->get();
               }
               else
               {
                $match='/';
                $services =DB::table('post')->select('page_name','title','main_heading')->where('page_name','not like',"%$match%")->orderBy('createdOn','desc')->get();
               }
             $webRepo = new WebsiteRepository();
	         $website= $webRepo->getWebsite();
             $count =  DB::table('post')->select('*')->where('page_name',$uri)->count();

            if($count>0)
            {
            
            $details =  DB::table('post')->select('*')->where('page_name',$uri)->get();
            return view('front.post_view',['details'=>$details,'website'=>$website,'services'=>$services,'currentUri'=>$uri]);
            }
            else
    	    return \Response::view('errors.404',array(),404);
    }
}

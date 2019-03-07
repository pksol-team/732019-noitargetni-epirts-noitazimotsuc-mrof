<?php
namespace App\Http\Controllers;
use App\AdminGroup;
use App\Repositories\MenuRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Http\Request;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Document;
use DB;
use Validator;
class AdminPostController extends Controller
{
    //
    protected $folder  = 'admin_posts.';
    public function __construct(MenuRepository $menuRepository)
    {
       // $menuRepository->check();
    }

    public function index(Request $request){
        if($request->search){
            $key = $request->search;
            $posts =DB::table('post')->select('*')->where('page_name','like',"%$key%")->orderBy('createdOn','desc')->paginate(10);

        }else{
            $posts = DB::table('post')->select('*')->orderBy('createdOn','desc')->paginate(10);
        }
        return view($this->folder.'index',[
            'posts'=>$posts
        ]);
    }

    public function save(Request $request)
    {
        if($request->first_url_segment=='0')
            $url=$request->page_name;
            else
                $url=$request->first_url_segment.'/'.$request->page_name;

      $insert =[
                'page_name'=>$url,
                'title'=>$request->title,
                'description'=>$request->description,
                'main_heading'=>$request->main_heading,
                'main_content'=>$request->main_content,
                'second_content'=>$request->second_content,
                'order_custom_section'=>$request->order_custom_section,
                'confidentiality_authenticity_section'=>$request->confidentiality_authenticity_section
           ];
    DB::table('post')->insert($insert);
    return redirect('posts/')->with('success','post added successfully !!');
    }

    public function add(Request $request){
        $menus = json_decode(Storage::disk('local')->get('/system_files/roles.json'))->admin;
       $group = AdminGroup::findOrNew($request->id);
        if(!$group->permissions){
            $group->permissions = '[]';
        }
        return view($this->folder.'add',[]);
    }

    public function view($id){
          $posts = DB::table('post')->select('*')->where('id',$id)->get();
        //DB::table('users')->whereIn('id', $array_of_ids)->update(array('votes' => 1));
        return view($this->folder.'view',['posts'=>$posts]);
    }


       public function edit(Request $request ,$id){

        if($request->first_url_segment=='0')
            $url=$request->page_name;
            else

                $url=$request->first_url_segment.'/'.$request->page_name;
         $update =[
                'page_name'=>$url,
                'title'=>$request->title,
                'description'=>$request->description,
                'main_heading'=>$request->main_heading,
                'main_content'=>$request->main_content,
                'second_content'=>$request->second_content,
                'order_custom_section'=>$request->order_custom_section,
                'confidentiality_authenticity_section'=>$request->confidentiality_authenticity_section
           ];
        DB::table('post')->where('id', $id)->update($update);
        return redirect('posts')->with('success', 'Post successfully updated !!');  
    }

         public function delete($id){
          DB::table('post')->where('id', $id)->delete();
         return redirect('posts')->with('success', 'Post Deleted successfully !!');  
    }

}

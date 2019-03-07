<?php

namespace App\Http\Controllers;

use App\Assurance;
use App\Document;
use App\Repositories\FileSaverRepository;
use App\Repositories\MenuRepository;
use App\Subject;
use App\Website;
use Dropbox\Exception;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use URL;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DesignerController extends Controller
{
    //
    protected $folder = 'settings.designer.';
    public function __construct(MenuRepository $menuRepository)
    {
        $menuRepository->check();
    }

    public function index(Request $request){
        $subjects = null;
        $documents = null;
        if(!isset( $request->tab)){
            $tab = 'subjects';
        }else{
            $tab = $request->tab;
        }
        if($tab == 'subjects'){
            $subjects = Subject::where('designer',1)->paginate(10);
        }
        if($tab == 'documents'){
            $documents = Document::join('subjects','documents.subject_id','=','subjects.id')
               -> select('documents.*')->paginate(10);
            $subjects = Subject::where('designer',1)->get();
        }
        return view($this->folder.'index',[
            'subjects'=>$subjects,
            'documents'=>$documents,
            'tab'=>$tab
        ]);
    }

    public function saveSubject(Request $request){
        if(!$request->label){
            return ['Name is required'];
        }
        $subject = Subject::findOrNew($request->id);
        $subject->label = $request->label;
        $subject->designer = 1;
        $subject->save();
        return ['reload'=>true];
    }

    public function saveDocument(Request $request){
        $document = Document::findOrNew($request->id);
        $document->label = $request->label;
        $document->subject_id = $request->subject_id;
        $document->save();
        return ['reload'=>true];
    }

    public function getSubject(Subject $subject){
        return $subject;
    }

    public function getDocument(Document $document){
        return $document;
    }
    public function deleteSubject(Subject $subject){
        $subject->documents()->delete();
        $subject->delete();

        return ['reload'=>true];
    }

    public function deleteDocument(Document $document){
        $document->delete();
        return ['reload'=>true];
    }

}

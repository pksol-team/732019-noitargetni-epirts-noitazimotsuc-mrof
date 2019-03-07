<?php
namespace App;
use App\User;
use App\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
class Post extends Model
{
	 protected $table = 'post';
    //
    protected $fillable = ['title','description','main_heading','main_content'];

}

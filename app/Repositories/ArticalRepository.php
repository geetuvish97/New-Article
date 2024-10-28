<?php 
namespace App\Repositories;
use App\Models\Artical;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
class ArticalRepository extends BaseRepository
{
    /**
    * @return void
    */
    public function __construct(){
        $this->serviceName = "artical";
    }

    /**
    *
    * @return artical instance
    */
    public function artical()
    {
        return new artical;
    }

    /**
    *
    * @return User instance
    */
    public function user()
    {
        return new User;
    }


    /**
    * Save artical using given request.
    * @param object $request
    * @return artical details
    */
    public function create(Request $request){
        $artical['user_id'] = $request->user_id;
        $artical['title'] = $request->title;
        $artical['content'] = $request->content;
        return $this->artical()->create($artical);
    }

    /**
    * Edit artical using given request.
    * @param object $request
    * @param $uuid
    * @return artical details
    */
    public function update(Request $request, $id){
        $artical = $this->artical()->where('id', $id)->first();
        $artical->title = $request->title;
        $artical->content = $request->content;
        $artical->save();
        return $artical;
    }

    /**
    * Delete artical using given request.
    * @param $uuid
    * @return artical details
    */
    public function delete($id){
        return $this->artical()->where('id', $id)->delete();
    }

    /**
    * Get Details of particular uuid artical.
    * @param object $request
    * @return artical details
    */
    public function getarticalById($id){
        return $this->artical()->where('id', $id)->first();
    }

     /**
    * Get listing of user searches by user_uuid.
    * @param object $request
    * @return artical listing
    */
    public function articalListByUserId(Request $request, $user_id){
        $artical = $this->artical()->where('user_id', $user_id)->latest();
        $per_page = $request->per_page ? $request->per_page : $artical->count();
        return $artical->paginate($per_page);
    }
}
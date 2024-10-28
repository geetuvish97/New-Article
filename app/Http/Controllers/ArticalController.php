<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\ArticalRepository;

class ArticalController extends Controller
{
    protected $artical;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticalRepository $artical)
    {
        $this->artical  = $artical;
    }

    /** User Artical Create */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'  => 'required',
            'user_id'  => 'required|exists:users,id',
            'content' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors()->messages()
            ], 422);
        }
        DB::beginTransaction();
        try{
            $artical = $this->artical->create($request);
            if(!$artical){
                DB::rollBack();
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Record not created',
                ], 500);
            }
            DB::commit();
            $response['status'] = 'success';
            $response['message'] = 'Artical successfully created.';
            if($artical){
                $response['data'] = $artical;
            }
            return response()->json($response, 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }   
    }

    /** User Artical Update */
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'title'  => 'required',
            'user_id'  => 'required|exists:users,id',
            'content' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors()->messages()
            ], 422);
        }
        DB::beginTransaction();
        try{
            $artical = $this->artical->update($request, $id);
            if(!$artical){
                DB::rollBack();
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Record not updated',
                ], 500);
            }
            DB::commit();
            $response['status'] = 'success';
            $response['message'] = 'Artical successfully updated.';
            if($artical){
                $response['data'] = $artical;
            }
            return response()->json($response, 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /** Artical Delete */
    public function delete($id){
        DB::beginTransaction();
        try{
            $artical = $this->artical->delete($id);
            if(!$artical){
                DB::rollBack();
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Record not found',
                ], 500);
            }
            DB::commit();
            $response['status'] = 'success';
            $response['message'] = 'Artical successfully deleted.';
            return response()->json($response, 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /** Artical Details By Id */
    public function articalDetailsById($id){
        DB::beginTransaction();
        try{
            $articalDetails = $this->artical->getarticalById($id);
            if(!$articalDetails){
                DB::rollBack();
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Record not found',
                ], 500);
            }
            DB::commit();
            $response['status'] = 'success';
            $response['message'] = 'Artical successfully retrived.';
            if($articalDetails){
                $response['data'] = $articalDetails;
            }
            return response()->json($response, 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /** Artical List*/
     public function list(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) {
            return validationErrors($validator->errors()->messages());
        }
        try{
            $artical = $this->artical->articalListByUserId($request, $request->user_id);
            if(!$artical){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Record not found',
                ], 500);
            }
 
            return response()->json([
                'status' => 'success',
                'message' => 'Record fetched successfully.',
                'data_list' => $artical->toArray()['data'],
                'links' => [
                    'first_page' => $artical->url(1),
                    'next_page' => $artical->nextPageUrl(),
                    'previous_page' => $artical->previousPageUrl()
                ],
                'current_page' => $artical->currentPage(),
                'last_page' => $artical->lastPage(),
                'total_page' => $artical->total(),
                'per_page' => $artical->perPage(),
                'total' => $artical->total(),
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
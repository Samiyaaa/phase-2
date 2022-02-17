<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\RoleUser;
use App\Models\User;

class jobAPIsController extends Controller
{
    public function jobIndex(){
        return Job::all('job_id','title','job_desc','user_id');
    }

    public function jobStore(Request $request){
        $this-> validate($request, [
            'title'  => 'required',
            'job_desc' => 'required'
         ]);

        //  return response()->json([auth()->user()->hasRole('Job Recruiter'), auth()->user()->roleUser()->get()], 200);
        
        $job = new Job;
        $job->title = $request->input('title');
        $job->job_desc = $request->input('job_desc');
        $job->user_id = auth()->user()->id;
        $checkJob = Job::where([
            ['title', '=',  $request->input('title')],
            ['job_desc','=',  $request->input('job_desc')],
            ['user_id','=',  auth()->user()->id]
            ])->first();
            // $user_id = auth()->user()->id;
            // $checkRole = RoleUser::where('user_id',$user_id)->first();
            if(auth()->user()->hasRole('Job Recruiter')){
                if($checkJob === null){
                    $job->save(); 
                }
                else{
                    return ('Job Already Exist');
                } 
            }
            else{
            return response([
                    'message' => 'You have to login as job recruiter!'
                ],401); 
            }
        
        $newJob = Job::where('job_id',$job->job_id)->first();
        $response = [
            'Title' => $newJob->title,
            'Job_id'  => $newJob->job_id,
            'Job_desc' => $newJob->job_desc,
            'Recruiter_id' => $newJob->user_id,
            'message' => 'Job Created Successfully'
        ];

        return response($response);
    }

    public function jobShow($id){
        return Job::find($id);
    }

    public function jobUpdate(Request $request, $id)
    {
        $this-> validate($request, [
            'title'  => 'required',
            'job_desc' => 'required'
         ]);
        $job = Job::find($id);
        if(auth()->user()->id !== $job->user_id){
            return response([
                'message' => 'You are not permitted to perform this action!'
            ],401);
        }
        $job->title = $request->input('title');
        $job->job_desc = $request->input('job_desc');
        $job->save();

        $response = [
            'Title' => $job->title,
            'Job_id'  => $job->job_id,
            'Job_desc' => $job->job_desc,
            'Recruiter_id' => $job->user_id,
            'message' => 'Job Updated Successfully'
        ];

        return response($response);

    }

    public function jobDestroy($id)
    {
        $job = Job::find($id);
        if(auth()->user()->id !== $job->user_id){
            return response([
                'message' => 'You are not permitted to perform this action!'
            ],403);
        }
        $job->applications()->delete();
        $job->delete();
        return ('Job Deleted');
    }

    public function jobShowApplications($id){
        return Application::where(['job_id' =>$id])->get();
    }

    public function userJobs($id){
        $jobs = Job::where(['user_id' =>$id])->get();
        $user = User::where(['id' =>$id])->get();
        return [
            'User' => $user,
            'Jobs' => $jobs
        ];
    }
}

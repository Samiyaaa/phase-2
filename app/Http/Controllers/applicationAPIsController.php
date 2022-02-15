<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\User;

class applicationAPIsController extends Controller
{
    public function applicationIndex(){
        return Application::all('app_id','job_id','user_id');
    }

    public function applicationStore(Request $request){
        $this-> validate($request, [
            'job_id'  => 'required'
         ]);
        
        $application = new Application;
        $application->job_id = $request->input('job_id');
        $application->user_id = auth()->user()->id;
        $checkApplication = Application::where([
            ['job_id','=',  $request->input('job_id')],
            ['user_id','=',  auth()->user()->id]
            ])->first();
        $checkJob = Job::where('job_id',$request->input('job_id'))->first();
        if($checkApplication === null){
            if($checkJob !== null){
               $application->save(); 
            }
            else{
                return ('The job doesn`t exist');
            } 
        }
        else{
            return ('Application Already Exist');
        }

        $newApplication = Application::where('job_id',$application->job_id)->first();
        $response = [
            'Job_id'  => $newApplication->job_id,
            'JobSeeker_id' => $newApplication->user_id,
            'message' => 'Applied Successfully'
        ];

        return response($response);
    }

    public function applicationShow($id){
        return Application::find($id);
    }

    public function applicationDestroy($id)
    {
        $application = Application::find($id);
        if(auth()->user()->id !== $application->user_id){
            return response([
                'message' => 'You are not Autherized for this action!'
            ],401);
        }
        $application->job()->delete();
        $application->delete();
        return ('Application Deleted');
    }

    public function userApplications($id){
        $applications= Application::where(['user_id' =>$id])->get();
        $user = User::where(['id' =>$id])->get();
        return [
            'User' => $user,
            'Applications' => $applications
        ];
    }
}

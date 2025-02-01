<?php

namespace App\Http\Controllers\Api\Influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AppointmentSchedule;
use App\Models\Order;
use Auth;

class AppointmentScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){

        $auth_user = Auth::guard('api')->user();

        $schedules = AppointmentSchedule::orderBy('id','desc')->where('user_id', $auth_user->id)->get();

        return response()->json([
            'schedules' => $schedules
        ]);
    }

    public function create(){
        $days = array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        );

        return response()->json([
            'days' => $days
        ]);
    }


    public function store(Request $request){
        $auth_user = Auth::guard('api')->user();

        $rules = [
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ];
        $customMessages = [
            'day.required' => trans('admin_validation.Day is required'),
            'start_time.required' => trans('admin_validation.Start time is required'),
            'end_time.required' => trans('admin_validation.End time is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        if($request->schedule_allows){
            $days = array(
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'
            );

            foreach ($days as $day){
                $schedule = new AppointmentSchedule();
                $schedule->user_id = $auth_user->id;
                $schedule->day = $day;
                $schedule->start_time = $request->start_time;
                $schedule->end_time = $request->end_time;
                $schedule->status = $request->status;
                $schedule->save();
            }

        }else{
            $schedule = new AppointmentSchedule();
            $schedule->user_id = $auth_user->id;
            $schedule->day = $request->day;
            $schedule->start_time = $request->start_time;
            $schedule->end_time = $request->end_time;
            $schedule->status = $request->status;
            $schedule->save();
        }


        $notification= trans('admin_validation.Created Successfully');
        return response()->json([
            'message' => $notification
        ]);

    }

    public function show($id){
        $days = array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        );

        $schedule = AppointmentSchedule::find($id);

        return response()->json([
            'days' => $days,
            'schedule' => $schedule,
        ]);
    }

    public function update(Request $request, $id){

        $auth_user = Auth::guard('api')->user();

        $rules = [
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ];
        $customMessages = [
            'day.required' => trans('admin_validation.Day is required'),
            'start_time.required' => trans('admin_validation.Start time is required'),
            'end_time.required' => trans('admin_validation.End time is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $schedule = AppointmentSchedule::find($id);
        $schedule->user_id = $auth_user->id;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        $notification= trans('admin_validation.Updated Successfully');
        return response()->json([
            'message' => $notification
        ]);

    }

    public function destroy($id){

        $exist = Order::where('appointment_schedule_id', $id)->count();
        if($exist == 0){
            $schedule = AppointmentSchedule::find($id);
            $schedule->delete();

            $notification= trans('admin_validation.Deleted Successfully');
            return response()->json([
                'message' => $notification
            ]);
        }else{
            $notification= trans('admin_validation.You can not delete this item, there are multiple booking exist under this schedule');
            return response()->json([
                'message' => $notification
            ]);
        }


    }
}

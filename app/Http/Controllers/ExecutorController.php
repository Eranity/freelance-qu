<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TechCard_WorkType;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ExecutorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function busyness()
    {
        $user = Auth::user();
        $dayCount = Carbon::now()->daysInMonth;
        $works = TechCard_WorkType::where('responsible_id' ,'=', $user->id)->get();
        $users = DB::table('tech_card__work_types')
                ->where('users.id', '=',  $user->id)
                ->join('users',  'users.id' ,'=' ,'tech_card__work_types.responsible_id')
                ->select('users.id', 'tech_card__work_types.deadline','tech_card__work_types.start_date', 
                'tech_card__work_types.id AS work_id',
                DB::raw("SUM(DATEDIFF(tech_card__work_types.deadline,tech_card__work_types.start_date)) AS days"),
                DB::raw("SUM(tech_card__work_types.hours) AS hours"))
                ->groupBy('users.id', 'tech_card__work_types.deadline','tech_card__work_types.start_date','work_id')
                ->get();
        $month = [];
        // $dt = new DateTime($users[0]->deadline);
        for($i = 1; $i <= $dayCount; $i++){
            array_push($month, $i);
        }
        // dd($dt->format('d'));
        // dd($users);
        $check = function($v) use ($users){
            $shedule = ['hours' => 0, 'deadline' => "", 'start_date' => "", 'works_ids' => []];
            foreach($users as $u){
                $start = intval((new DateTime($u->start_date))->format('d'));
                $end = intval((new DateTime($u->deadline))->format('d'));
                
                if($end == $v){
                    $shedule['deadline'] = $u->deadline;
                    $shedule['hours'] += $u->days != 0 ? $u->hours / $u->days : $u->hours;
                    array_push($shedule['works_ids'], $u->work_id);
                }
                elseif ($start == $v) {
                    $shedule['start_date'] = $u->start_date;
                    $shedule['hours'] += $u->days != 0 ? $u->hours / $u->days : 0;
                    array_push($shedule['works_ids'], $u->work_id);
                }
            }
            return($shedule);
        };
        $worksByDay = array_map($check, $month);
        // dd($worksByDay);
        $cache = [];
        for($i = 0; $i < count($worksByDay); $i++){
            if($worksByDay[$i]['start_date'] != ''){
                foreach($worksByDay[$i]['works_ids'] as $id){
                    for($j = $i+1; $j < count($worksByDay); $j++){
                        if($worksByDay[$j]['deadline'] != '' && in_array($id , $worksByDay[$j]['works_ids'])){
                            break;
                        }
                        if($worksByDay[$j]['start_date'] != ''){
                            array_push($cache, ['id' => $j, 'value'=>$worksByDay[$i]['hours']]);                
                            $worksByDay[$j]['hours'] -= $worksByDay[$i]['hours'];
                        }
                        $worksByDay[$j]['hours'] +=  $worksByDay[$i]['hours'];
                    }
                }
            }
        }
        foreach($cache as $data){
            $worksByDay[$data['id']]['hours'] += $data['value'];
        }
        $hours = array( ['value' => '09:00', 'hour' => 9], 
                        ['value' => '10:00', 'hour' => 10], 
                        ['value' => '11:00', 'hour' => 11], 
                        ['value' => '12:00', 'hour' => 12], 
                        ['value' => 'Lunch', 'hour' => 13],
                        ['value' => '14:00', 'hour' => 14], 
                        ['value' => '15:00', 'hour' => 15], 
                        ['value' => '16:00', 'hour' => 16], 
                        ['value' => '17:00', 'hour' => 17]); 

                        

        // dd($worksByDay);
        // dd($users);
        // dd($dayCount);
        return view('/dashboards/busyness', ['dayCount' => $dayCount, 'worksByDay' => $worksByDay, 'hours' => $hours]);
    }
}

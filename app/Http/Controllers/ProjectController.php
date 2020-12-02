<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectExecutor;
use App\TechCard;
use App\Responce;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\TechCard_WorkType;
use Illuminate\Support\Arr;
class ProjectController extends Controller
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

    // /**
    //  * Handle the incoming request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function __invoke(Request $request)
    // {
    //     //
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // dd());
        $user = Auth::user();
        $role = $user->role->name;
        $positionIds = $user->positions->pluck('id')->toArray();
        $projectsNew = [];
        $projectsInProgres = [];
        $projectsDone = [];
        switch ($role) {
            case 'executor':
                $projectsNew = DB::table('projects')
                    ->where('projects.status', '=', 'Новый')
                    ->join('tech_cards', 'tech_cards.id', '=', 'projects.tech_id')
                    ->join('tech_card__work_types', 'tech_cards.id', '=', 'tech_card__work_types.tech_card_id')
                    ->join('work_type__positions', 'work_type__positions.work_type_id', '=', 'tech_card__work_types.work_type_id')
                    ->whereIn('work_type__positions.position_id', $positionIds)
                    ->select('projects.id','projects.name','projects.budget','projects.description','projects.status')
                    ->groupBy('projects.id','projects.name','projects.budget','projects.description', 'projects.status')
                    // ->select('projects.id','tech_card__work_types.work_type_id', 'work_type__positions.position_id')
                    ->orderBy('projects.id')
                    ->get();
                $projectsInProgres = $user->projects->where('status', '=', 'В работе');
                $projectsDone = $user->projects->where('status', '=', 'Завершенный');
                break;
            case 'project_manager':
                $projectsNew = DB::table('projects')
                    ->join('tech_cards', 'tech_cards.id', '=', 'projects.tech_id')
                    ->select('projects.id','projects.name','projects.budget','projects.description','projects.status')
                    ->where('tech_cards.project_manager_id', '=', $user->id)
                    ->where('projects.status', '=', 'Новый')
                    ->get();
                $projectsInProgres = DB::table('projects')
                    ->join('tech_cards', 'tech_cards.id', '=', 'projects.tech_id')
                    ->select('projects.id','projects.name','projects.budget','projects.description','projects.status')
                    ->where('tech_cards.project_manager_id', '=', $user->id)
                    ->where('projects.status', '=', 'В работе')
                    ->get();
                $projectsDone = DB::table('projects')
                    ->join('tech_cards', 'tech_cards.id', '=', 'projects.tech_id')
                    ->select('projects.id','projects.name','projects.budget','projects.description','projects.status')
                    ->where('tech_cards.project_manager_id', '=', $user->id)
                    ->where('projects.status', '=', 'Завершенный')
                    ->get();
                break;
            case 'supervisor':
                $projectsNew = Project::all()->where('status','=', 'Новый');
                $projectsInProgres = Project::all()->where('status','=', 'В работе');
                $projectsDone = Project::all()->where('status','=', 'Завершенный');
                break;
            case 'initiator':
                $projectsNew = Project::all()->where('status','=', 'Новый');
                $projectsInProgres = Project::all()->where('status','=', 'В работе');
                $projectsDone = Project::all()->where('status','=', 'Завершенный');
                break;
          }

        // foreach($projects as $project){
        //     switch ($project.status){
        //         case 'Новый':
        //             array_push($projectsNew, $project);
        //             break;
        //         case 'В работе':
        //             array_push($projectsInProgres, $project);
        //             break;
        //         case 'Завершенный':
        //             array_push($projectsDone, $project);
        //             break;
        //       }
        //   }


        return view('/dashboards/project', ['projectsNew' => $projectsNew,
                                            'projectsInProgres' => $projectsInProgres,
                                            'projectsDone' => $projectsDone]);
    }
    public function details($id = null)
    {
        $user = Auth::user();
        $positionIds = $user->positions->pluck('id')->toArray();

        $project = Project::whereId($id)->whereHas('techCard.workTypes.positions', function($q) use ($positionIds) {
            $q->whereIn('id', $positionIds);
        })->with([
            'techCard' => function($q1) use ($positionIds) {
                $q1->whereHas('workTypes.positions', function($q2) use ($positionIds) {
                    $q2->whereIn('id', $positionIds);
                });
            },
            'techCard.workTypes' => function($q1) use ($positionIds) {
                $q1->whereHas('positions', function($q2) use ($positionIds) {
                    $q2->whereIn('id', $positionIds);
                });
            },
            'techCard.workTypes.positions' => function($q1) use ($positionIds) {
                $q1->whereIn('id', $positionIds);
            }
        ])->first();


        $users = [];
        if($user->role->name == 'project_manager'){
            $projectPos = Project::whereId($id)->first();
                $project = $projectPos;
            $positionIds = [];

            foreach($projectPos->techCard->workTypes as $work){
                foreach($work->positions as $pos){
                    array_push($positionIds, $pos->id);
                }
            }
            if($projectPos->status == 'Новый'){
            $users = DB::table('users')
                ->join('user__positions',  'users.id' ,'=' ,'user__positions.user_id')
                ->join('positions', 'user__positions.position_id', '=', 'positions.id')
                ->leftJoin('tech_card__work_types', 'tech_card__work_types.responsible_id', '=', 'users.id')
                ->whereIn('positions.id', $positionIds)
                ->leftJoin('responces','responces.executor_id', '=', 'users.id')
                // ->where('responces.project_id', '=', $id)
                ->select('users.id','users.name','users.rating','users.email','positions.display_name',
                'responces.executor_id','responces.approved',
                DB::raw("SUM(DATEDIFF(tech_card__work_types.deadline,tech_card__work_types.start_date)) AS days"),
                DB::raw("SUM(tech_card__work_types.hours) AS hours"))
                ->groupBy('users.id', 'users.name','users.rating','users.email','positions.display_name',
                'responces.executor_id','responces.approved')
                ->orderBy('responces.approved', 'desc')
                ->get();
            }
            else if ($projectPos->status == 'В работе'){
                $users = DB::table('users')
                ->join('project_executors',  'users.id' ,'=' ,'project_executors.executor_id')
                ->join('user__positions',  'users.id' ,'=' ,'user__positions.user_id')
                ->join('positions', 'user__positions.position_id', '=', 'positions.id')
                ->where('project_executors.project_id', '=', $id)
                ->leftJoin('tech_card__work_types', 'tech_card__work_types.responsible_id', '=', 'users.id')
                ->select('users.id','users.name','users.rating','users.email','positions.display_name', 'tech_card__work_types.status',
                DB::raw("SUM(DATEDIFF(tech_card__work_types.deadline,tech_card__work_types.start_date)) AS days"),
                DB::raw("SUM(tech_card__work_types.hours) AS hours"))
                ->groupBy('users.id', 'users.name','users.rating','users.email','positions.display_name','tech_card__work_types.status')
                ->orderBy('tech_card__work_types.status', 'desc')
                ->get();
            }
        }

        // dd($users);
        return view('/dashboards/project-details', ['project' => $project, 'users' => $users]);
    }

    public function create_view($id = null)
    {
        $techCard = TechCard::findOrFail($id);
        $budget = 0;
        foreach($techCard->workTypes as $workType){
            $budget += $workType->pivot->unit_count * $workType->unit_price;
        }

        // dd($techCard->workTypes[1]);
        return view('/dashboards/project-create', ['techCard' => $techCard, 'budget' => $budget]);
    }

    public function create($id = null, Request $request){
        // dd($request->all());

        DB::beginTransaction();

         $storeData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'budget'=> 'required',
            // 'status'=> 'required',
            'created_date'=> 'required',
            'deadline' => 'required',
        ]);

        $storeData['tech_id']=$id;
        $storeData['deadline']= Carbon::parse($storeData['deadline'])->format('Y-m-d');
        if(!$storeData) {
            return redirect()->route('project-create');
        }


        $techCard = Project::create($storeData);
        foreach($request->all()['works'] as $work){
            $work['start_date'] = Carbon::parse($work['start_date'])->format('Y-m-d');
            $work['deadline'] = Carbon::parse($work['deadline'])->format('Y-m-d');
            TechCard_WorkType::whereId($work['id'])->update(['hours'=>$work['hours'],
                                                             'start_date' => $work['start_date'],
                                                             'deadline' => $work['deadline']]);
        }

        TechCard::whereId($id)->update(['status'=>'Оформлена']);
                        // ->with('success','Product created successfully.');

        DB::commit();

        return redirect()->route('project');
    }

    public function respond($id = null){

        $storeData['project_id']=$id;
        $storeData['executor_id']= Auth::user()->id;
        if(!$storeData) {
            return redirect()->route('project-details');
        }

        Responce::create($storeData);


        return redirect()->route('project');
    }

    public function aproveResponse($id = null, Request $request){
        $storeData = $request->validate([
            'executor_id' => 'required'
        ]);
        $storeData['project_id']=$id;
        if(!$storeData) {
            return redirect()->back();
        }
        DB::beginTransaction();

        ProjectExecutor::create($storeData);
        $isExist = Responce::where('executor_id', '=', $storeData['executor_id'])
        ->where('project_id', '=', $id)->get();

        if(!count($isExist)) Responce::create($storeData);

        Responce::where('executor_id', '=', $storeData['executor_id'])
            ->where('project_id', '=', $id)->update(array('approved' => 1));
        DB::commit();

        return redirect()->back();
    }

    public function rejectResponse($id = null){
        $storeData = $request->validate([
            'executor_id' => 'required'
        ]);
        $storeData['project_id']=$id;
        if(!$storeData) {
            return redirect()->back();
        }
        Responce::where('executor_id', '=', $storeData['executor_id'])
        ->where('project_id', '=', $id)->delete();


        return redirect()->back();
    }

}

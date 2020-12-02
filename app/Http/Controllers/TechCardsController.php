<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TechCard;
use App\Stage;
use App\EditionType;
use App\Project;
use App\User;
use App\Role;
use App\WorkType;
use Illuminate\Support\Carbon;
use App\TechCard_WorkType;
use App\TechCard_Author;
use App\TechCard_Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\FirstSignal;
use App\SecondSignal;
use App\ManagerRemark;
use App\PrintingDelivery;
use App\Printing;
use App\Stock;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;


class TechCardsController extends Controller
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
    public function index()
    {

        // $newTechCards = TechCard::where('status', 'Создано')->get();
        // $inProcessTechCards = TechCard::where('status', 'Оформлена')->get();

        $user = Auth::user();
        $role = $user->role;

        $newTechCards = [];
        $inProcessTechCards = [];
        $doneTechCards = [];

        switch ($role->name) {
            case 'executor':
                // $inProcessTechCards = DB::table('tech_cards')
                // ->join('projects', 'tech_cards.id', '=', 'projects.tech_id')
                // ->where('projects.status', '=', 'В работе')
                // ->join('project_executors', 'project_executors.project_id', '=', 'projects.id')
                // ->where('project_executors.executor_id', '=', $user->id)
                // // ->select('tech_cards.id', 'tech_cards.book_name', 'project_executors.executor_id')
                // ->orderBy('tech_cards.id')
                // ->get();


                // $doneTechCards = DB::table('tech_cards')
                // ->join('projects as projects', 'tech_cards.id', '=', 'projects.tech_id')
                // ->where('projects.status', '=', 'Завершенный')
                // ->join('project_executors', 'project_executors.project_id', '=', 'projects.id')
                // ->where('project_executors.executor_id', '=', $user->id)
                // // ->select('tech_cards.*')
                // ->orderBy('tech_cards.id')
                // ->get();

                $inProcessTechCards = TechCard::whereHas('project', function($q) use ($user) {
                    $q->whereIn('status', ['Новый', 'В работе']);
                })->whereHas('project.executors', function($q) use ($user) {
                    $q->where('executor_id','=', $user->id);
                })->get();

                $doneTechCards = TechCard::whereHas('project', function($q) use ($user) {
                    $q->whereIn('status', ['Завершенный']);
                })->whereHas('project.executors', function($q) use ($user) {
                    $q->where('executor_id','=', $user->id);
                })->get();

            break;

            case 'project_manager':
                $newTechCards = TechCard::where('project_manager_id', $user->id)->where('status', 'Создано')->get();
                $inProcessTechCards = TechCard::where('project_manager_id', $user->id)->whereHas('project', function($q) use ($user) {
                    $q->whereIn('status', ['Новый', 'В работе']);
                })->get();

                $doneTechCards = TechCard::where('project_manager_id', $user->id)->whereHas('project', function($q) use ($user) {
                    $q->where('status', '=', 'Завершенный');
                })->get();
            break;

            case 'initiator':
                $newTechCards = TechCard::where('status', 'Создано')->get();
                $inProcessTechCards = TechCard::whereHas('project', function($q) use ($user) {
                    $q->whereIn('status', ['Новый', 'В работе']);
                })->get();

                $doneTechCards = TechCard::whereHas('project', function($q) use ($user) {
                    $q->where('status', '=', 'Завершенный');
                })->get();
            break;

        }

        return view('/dashboards/tech-cards', [
            'newTechCards' => $newTechCards,
            'inProcessTechCards' => $inProcessTechCards,
            'doneTechCards' => $doneTechCards
        ]);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function details($id = null)
    {
        $techCard = TechCard::findOrFail($id);
        $stages = Stage::orderBy('order', 'asc')->get();
        return view('/dashboards/tech-card-details', ['techCard' => $techCard, 'stages' => $stages]);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {

        $stages = Stage::orderBy('order', 'asc')->get();
        $editionTypes = EditionType::all();

        $projectManagers = Role::where('name', 'project_manager')->first()->users()->get();
        $workTypes = WorkType::all();

        $authors = Role::where('name', 'author')->first()->users()->get();

        $data = [
            'users' => []
        ];

        return view('/dashboards/tech-card-create-test', [
            'stages' => $stages,
            'data' => [],
            'users' => [],
            'editionTypes' => $editionTypes,
            'projectManagers' => $projectManagers,
            'workTypes' => $workTypes,
            'authors' => $authors
        ]);
    }


    public function createTechCard(Request $request)
    {
        // dd($request->all());
        $storeData = $request->validate([

            'book_name' => 'required',
            'project_manager_id' => 'required',
            'created_date' => 'required',
            'appointment_date' => 'required',
            'status' => 'required',
            'author_id' => 'required',


            'order_number' => 'nullable',
            'ib_number' => 'nullable',
            'isbn' => 'nullable',

            //'application_id',
            'languages' => 'nullable',

            'edition_id'=>'nullable',

            'payment' => 'nullable',
            //'department' => 'required',
            'templan' => 'nullable',


            'riso_protocol_number' => 'nullable',
            'riso_protocol_date' => 'nullable',

            'ac_protocol_number' => 'nullable',
            'ac_protocol_date' => 'nullable',

            'rums_protocol_number' => 'nullable',
            'rums_protocol_date' => 'nullable',


            'manuscript' => 'nullable',

            'total_pages' => 'nullable',
            'total_symbols' => 'nullable',
            'author_sheet_volume' => 'nullable',
            'format' => 'nullable',
            'kegel' => 'nullable',
            'editing_complexity' => 'nullable',
            'layout_complexity' => 'nullable',

            'ioot' => 'nullable',
            'conclusion' => 'nullable',

            'circulation_author' => 'nullable',
            'circulation_university' => 'nullable',
            'circulation_library' => 'nullable',

            'works' => 'nullable'
        ]);


        $storeData['application_id'] = 1;
        $storeData['department'] = 'awd';

        $storeData['riso_protocol_date'] = Carbon::createFromFormat($storeData['riso_protocol_date'])->format('Y-m-d');
        $storeData['ac_protocol_date'] = Carbon::createFromFormat($storeData['ac_protocol_date'])->format('Y-m-d');
        $storeData['rums_protocol_date'] = Carbon::createFromFormat($storeData['rums_protocol_date'])->format('Y-m-d');

        $storeData['created_date'] = Carbon::createFromFormat($storeData['created_date'])->format('Y-m-d');
        $storeData['appointment_date'] = Carbon::createFromFormat($storeData['appointment_date'])->format('Y-m-d');



        if(!$storeData) {
            dd($request->all());
            // return redirect()->route('tech-card.add');//->with();
        }

        // dd($storeData);

        DB::beginTransaction();

        $techCard = TechCard::create($storeData);



        foreach($storeData['works'] as $work) {
            TechCard_WorkType::create([
                'tech_card_id' => $techCard->id,
                'work_type_id' => $work['id'],
                'unit_count' => $work['unit_count']
            ]);
        }

        TechCard_Author::create([
            'tech_card_id' => $techCard->id,
            'author_id' => $storeData['author_id']
        ]);
        // dd($storeData['languages']);

        foreach($storeData['languages'] as $language) {
            // dd($language);
            TechCard_Language::create([
                'tech_card_id' => $techCard->id,
                'language' => $language,
            ]);
        }

        DB::commit();

        return redirect()->route('tech-cards')
                        ->with('success','Tech card created successfully.');
    }

    public function edit($id = null) {
        $techCard = TechCard::find($id);

        $stages = Stage::orderBy('order', 'asc')->get();

        $editionTypes = EditionType::all();

        $projectManagers = Role::where('name', 'project_manager')->first()->users()->get();

        $workTypes = WorkType::all();

        $authors = Role::where('name', 'author')->first()->users()->get();

        $data = [
            'users' => []
        ];

        return view('/dashboards/tech-card-create-test', [
            "update" => true,
            'stages' => $stages,
            'techCard' => $techCard,
            'data' => [],
            'users' => [],
            'editionTypes' => $editionTypes,
            'projectManagers' => $projectManagers,
            'workTypes' => $workTypes,
            'authors' => $authors
        ]);
    }

    public function update($id, Request $request) {

        $storeData = $request->validate([

            'book_name' => 'required',
            'project_manager_id' => 'required',
            'created_date' => 'required',
            'appointment_date' => 'required',
            'status' => 'required',
            // 'author_id' => 'required',


            'order_number' => 'nullable',
            'ib_number' => 'nullable',
            'isbn' => 'nullable',

            //'application_id',
            'languages' => 'nullable',

            'edition_id'=>'nullable',

            'payment' => 'nullable',
            //'department' => 'required',
            'templan' => 'nullable',


            'riso_protocol_number' => 'nullable',
            'riso_protocol_date' => 'nullable',

            'ac_protocol_number' => 'nullable',
            'ac_protocol_date' => 'nullable',

            'rums_protocol_number' => 'nullable',
            'rums_protocol_date' => 'nullable',


            'manuscript' => 'nullable',

            'total_pages' => 'nullable',
            'total_symbols' => 'nullable',
            'author_sheet_volume' => 'nullable',
            'format' => 'nullable',
            'kegel' => 'nullable',
            'editing_complexity' => 'nullable',
            'layout_complexity' => 'nullable',

            'ioot' => 'nullable',
            'conclusion' => 'nullable',

            'circulation_author' => 'nullable',
            'circulation_university' => 'nullable',
            'circulation_library' => 'nullable',

            'works' => 'nullable',
            'authors' => 'nullable'
        ]);


        DB::beginTransaction();

        $fields = $request->except(['languages', 'works', 'authors', '_token']);


        $fields['riso_protocol_date']= Carbon::createFromFormat('d/m/Y', $fields['riso_protocol_date'])->format('Y-m-d');
        $fields['ac_protocol_date']= Carbon::createFromFormat('d/m/Y',$fields['ac_protocol_date'])->format('Y-m-d');
        $fields['rums_protocol_date']= Carbon::createFromFormat('d/m/Y',$fields['rums_protocol_date'])->format('Y-m-d');

        $fields['created_date']= Carbon::createFromFormat('d/m/Y',$fields['created_date'])->format('Y-m-d');
        $fields['appointment_date']= Carbon::createFromFormat('d/m/Y',$fields['appointment_date'])->format('Y-m-d');

                // dd($fields);

        TechCard::whereId($id)->update($fields);

        $techCard = TechCard::find($id);


        // foreach($storeData['works'] as $work) {
        //     TechCard_WorkType::create([
        //         'tech_card_id' => $techCard->id,
        //         'work_type_id' => $work['id'],
        //         'unit_count' => $work['unit_count']
        //     ]);
        // }
        // dd($storeData['authors']);

        TechCard_Author::where('tech_card_id', $techCard->id)->delete();
        if(isset($storeData['authors'])) {
            foreach($storeData['authors'] as $authorId) {
                TechCard_Author::create([
                    'tech_card_id' => $techCard->id,
                    'author_id' => $authorId,
                ]);
            }
        }

        TechCard_Language::where('tech_card_id', $techCard->id)->delete();
        if(isset($storeData['languages'])) {
            foreach($storeData['languages'] as $language) {
                TechCard_Language::create([
                    'tech_card_id' => $techCard->id,
                    'language' => $language,
                ]);
            }
        }

        if(isset($storeData['works'])) {
            $workIds = array_column($storeData['works'], 'id');
            // let existingUserOrganizations = await O_SP.find({
            //     serviceProviderId,
            // }, '-_id userId', {session});

            TechCard_WorkType::whereNotIn('work_type_id', $workIds)->where('tech_card_id', $techCard->id)->delete();

            // dd($worksToDelete);

            foreach($storeData['works'] as $work) {
                TechCard_WorkType::updateOrCreate([
                    'tech_card_id' => $techCard->id,
                    'work_type_id' => $work['id']
                ], [
                    'unit_count' => $work['unit_count']
                ]);
            }

        }

        DB::commit();

        return redirect()->route('tech-card.edit', ['id' => $techCard->id])
            ->with('udpate_success', 'Техническая карта успешно обновлен');

    }

    public function stageView($techCardId, $stageId)
    {

        $techCard = TechCard::find($techCardId);
        $stage = Stage::find($stageId);
        $user = Auth::user();


        if(in_array($stage->name, array('1-этап', '2-этап', '3-этап', '4-этап', '5-этап'))) {

            $user = Auth::user();
            if ($user->role->name = 'executor') {
                $positionIds = $user->positions->pluck('id')->toArray();

                $projectsNew = DB::table('tech_cards')
                    ->where('tech_cards.id', '=', $techCard->id)
                    ->join('tech_card__work_types', 'tech_cards.id', '=', 'tech_card__work_types.tech_card_id')
                    ->join('work_type__positions', 'work_type__positions.work_type_id', '=', 'tech_card__work_types.work_type_id')
                    ->join('work_types', 'work_type__positions.work_type_id', '=', 'work_types.id')
                    ->whereIn('work_type__positions.position_id', $positionIds)
                    ->select('work_types.id', 'work_types.name', 'tech_card__work_types.start_date', 'tech_card__work_types.deadline', 'tech_card__work_types.unit_count')
                    // ->groupBy('projects.id','projects.name','projects.budget','projects.description', 'projects.status')
                    // ->select('projects.id','tech_card__work_types.work_type_id', 'work_type__positions.position_id')
                    ->orderBy('work_types.id')
                    ->get();

                // dd($projectsNew);

                // $roleWorkTypes = WorkType::with(array('cover' => function($query) use ($id) {
                //     $query->where('imageable_type', 'App\Models\Thing')
                //           ->where('imageable_id', $id);
                //     }))

                //     whereHas('positions', function($q) {
                //     $q->whereIn('name', $positionNames);
                // })->get();

                // $category_id = array('223','15');
                // WorkType::whereIn('id', function($query) use ($category_id){
                // $query->select('paper_type_id')
                //     ->from(with(new ProductCategory)->getTable())
                //     ->whereIn('category_id', $category_id )
                //     ->where('active', 1);
                // })->get();

                $freeWorks = TechCard_WorkType::where('tech_card_id', $techCardId)->whereNull('stage_id')->get();
            }

            $stageWorks = TechCard_WorkType::where('stage_id', $stageId)->where('tech_card_id', $techCardId)->get();
            $freeWorks = TechCard_WorkType::where('tech_card_id', $techCardId)->whereNull('stage_id')->get();

            return view('/dashboards/stages/stage', [
                'techCard' => $techCard,
                'stage' => $stage,
                'user' => $user,
                'stageWorks' => $stageWorks,
                'freeWorks' => $freeWorks
            ]);

        } else {
            switch ($stage->name) {
                case '1-сигальный экземпляр':

                    $data = FirstSignal::where('tech_card_id', $techCard->id)->first();

                    return view('/dashboards/stages/first-signal', [
                        'techCard' => $techCard,
                        'stage' => $stage,
                        'data' => $data
                    ]);

                    break;
                case '2-сигальный экземпляр':
                    $data = SecondSignal::where('tech_card_id', $techCard->id)->first();

                    return view('/dashboards/stages/second-signal', [
                        'techCard' => $techCard,
                        'stage' => $stage,
                        'data' => $data
                    ]);
                    break;
                case 'Замечание менеджера':
                    $data = ManagerRemark::where('tech_card_id', $techCard->id)->first();
                    return view('/dashboards/stages/manager-remark', [
                        'techCard' => $techCard,
                        'stage' => $stage,
                        'data' => $data
                    ]);
                    break;
                case 'Сдача на печать':
                    $data = PrintingDelivery::where('tech_card_id', $techCard->id)->first();

                    return view('/dashboards/stages/printing-delivery', [
                        'techCard' => $techCard,
                        'stage' => $stage,
                        'data' => $data
                    ]);
                    break;
                case 'Печать':
                    $data = Printing::where('tech_card_id', $techCard->id)->first();

                    return view('/dashboards/stages/printing', [
                        'techCard' => $techCard,
                        'stage' => $stage,
                        'data' => $data
                    ]);
                    break;
                case 'Склад':
                    $data = Stock::where('tech_card_id', $techCard->id)->first();

                    return view('/dashboards/stages/storage', [
                        'techCard' => $techCard,
                        'stage' => $stage,
                        'data' => $data
                    ]);
                    break;
                case 'Распечатать тех карту':
                    return view('/dashboards/stages/print-out', [
                        'techCard' => $techCard,
                        'stage' => $stage
                    ]);
                    break;
            }
        }
    }

    public function addWork($techCardId, $stageId, Request $request)
    {

        $techCard = TechCard::find($techCardId);
        $stage = Stage::find($stageId);
        $user = Auth::user();



        if (in_array($stage->name, array('1-этап', '2-этап', '3-этап', '4-этап', '5-этап'))) {


            $storeData = $request->validate([
                'work_type_id' => 'required',
                // 'completion_date' => 'required',
                'status' => 'required'
            ]);

            // dd($storeData);

            $work = TechCard_WorkType::where('tech_card_id', $techCardId)->where('work_type_id', $storeData['work_type_id'])->firstOrFail();

            $work->stage_id = $stageId;
            if (isset($storeData['completed_date'])) {
                $work->completion_date = $storeData['completed_date'];
            }
            $work->status = $storeData['status'];
            $work->responsible_id = $user->id;
            $work->save();

            return Redirect::to("tech-cards/$techCard->id/stage/$stage->id");

        } else if ($stage->name == '1-сигальный экземпляр') {

            $storeData = $request->validate([
                'start_date' => 'nullable',
                'completed_date' => 'nullable',
                'status' => 'nullable'
            ]);

            if(isset($storeData['start_date'])){
                $storeData['start_date'] = Carbon::createFromFormat('d/m/Y', $storeData['start_date'])->format('Y-m-d');
            }

            if(isset($storeData['completed_date'])){
                $storeData['completed_date'] = Carbon::createFromFormat('d/m/Y', $storeData['completed_date'])->format('Y-m-d');
            }

            FirstSignal::updateOrCreate([
                'tech_card_id' => $techCard->id
            ], $storeData);

            return Redirect::to("tech-cards/$techCard->id/stage/$stage->id");

        } else if ($stage->name == '2-сигальный экземпляр') {
            $storeData = $request->validate([
                'number_of_copies' => 'nullable',
                'format' => 'nullable',

                'total_pages' => 'nullable',
                'colored_count' => 'nullable',
                'inserts_count' => 'nullable',

                'text_paper' => 'nullable',
                'text_paper_colorfulness' => 'nullable',

                'insert_paper' => 'nullable',
                'insert_paper_colorfulness' => 'nullable',

                'cover_paper' => 'nullable',
                'cover_paper_colorfulness' => 'nullable',

                'binding_type' => 'nullable',

                'colored_pages' => 'nullable',

                'start_date' => 'nullable',
                'completed_date' => 'nullable',
                'status' => 'nullable'
            ]);

            if(isset($storeData['start_date'])){
                $storeData['start_date'] = Carbon::createFromFormat('d/m/Y', $storeData['start_date'])->format('Y-m-d');
            }

            if(isset($storeData['completed_date'])){
                $storeData['completed_date'] = Carbon::createFromFormat('d/m/Y', $storeData['completed_date'])->format('Y-m-d');
            }

            SecondSignal::updateOrCreate([
                'tech_card_id' => $techCard->id
            ], $storeData);

            return Redirect::to("tech-cards/$techCard->id/stage/$stage->id");
        } else if ($stage->name == 'Замечание менеджера') {
            $storeData = $request->validate([
                'date' => 'nullable',
                'remark' => 'nullable'
            ]);

            if(isset($storeData['date'])){
                $storeData['date'] = Carbon::createFromFormat('d/m/Y', $storeData['date'])->format('Y-m-d');
            }

            ManagerRemark::updateOrCreate([
                'tech_card_id' => $techCard->id
            ], $storeData);

            return Redirect::to("tech-cards/$techCard->id/stage/$stage->id");
        } else if ($stage->name == 'Сдача на печать') {
            $storeData = $request->validate([
                'number_of_copies' => 'nullable',
                'format' => 'nullable',

                'total_pages' => 'nullable',
                'colored_count' => 'nullable',
                'inserts_count' => 'nullable',

                'text_paper' => 'nullable',
                'text_paper_colorfulness' => 'nullable',

                'insert_paper' => 'nullable',
                'insert_paper_colorfulness' => 'nullable',

                'soft_cover_paper' => 'nullable',
                'soft_cover_paper_colorfulness' => 'nullable',
                'soft_cover_wrap_pressing_type' => 'nullable',

                'hard_cover_paper' => 'nullable',
                'hard_cover_paper_colorfullness' => 'nullable',
                'hard_cover_wrap_pressing_type' => 'nullable',

                'soft_binding_count' => 'nullable',
                'hard_binding_count' => 'nullable',

                'colored_pages' => 'nullable',

                'remark' => 'nullable',

                'start_date' => 'nullable',
                'completed_date' => 'nullable',
                'status' => 'nullable'
            ]);

            if(isset($storeData['start_date'])){
                $storeData['start_date'] = Carbon::createFromFormat('d/m/Y', $storeData['start_date'])->format('Y-m-d');
            }

            if(isset($storeData['completed_date'])){
                $storeData['completed_date'] = Carbon::createFromFormat('d/m/Y', $storeData['completed_date'])->format('Y-m-d');
            }

            PrintingDelivery::updateOrCreate([
                'tech_card_id' => $techCard->id
            ], $storeData);

            return Redirect::to("tech-cards/$techCard->id/stage/$stage->id");
        } else if ($stage->name == 'Печать') {
            $storeData = $request->validate([
                'start_date' => 'nullable',
                'completed_date' => 'nullable',
                'status' => 'nullable'
            ]);

            if(isset($storeData['start_date'])){
                $storeData['start_date'] = Carbon::createFromFormat('d/m/Y', $storeData['start_date'])->format('Y-m-d');
            }

            if(isset($storeData['completed_date'])){
                $storeData['completed_date'] = Carbon::createFromFormat('d/m/Y', $storeData['completed_date'])->format('Y-m-d');
            }

            Printing::updateOrCreate([
                'tech_card_id' => $techCard->id
            ], $storeData);

            return Redirect::to("tech-cards/$techCard->id/stage/$stage->id");
        }  else if ($stage->name == 'Склад') {
            $storeData = $request->validate([
                'library'=> 'nullable',
                'author' => 'nullable',
                'employee_id' => 'nullable',
                'start_date' => 'nullable',
                'completed_date' => 'nullable',
                'status' => 'nullable'
            ]);

            if(isset($storeData['start_date'])){
                $storeData['start_date'] = Carbon::createFromFormat('d/m/Y', $storeData['start_date'])->format('Y-m-d');
            }

            if(isset($storeData['completed_date'])){
                $storeData['completed_date'] = Carbon::createFromFormat('d/m/Y', $storeData['completed_date'])->format('Y-m-d');
            }


            Stock::updateOrCreate([
                'tech_card_id' => $techCard->id
            ], $storeData);

            return Redirect::to("tech-cards/$techCard->id/stage/$stage->id");
        }
    }

    public function editWork($techCardId, $workId, Request $request) {

        $work = TechCard_WorkType::find($workId);
        $techCard = TechCard::find($techCardId);
        $stage = Stage::find($work->stage_id);
        $user = Auth::user();

        return view('/dashboards/stages/stage-edit', [
            'techCard' => $techCard,
            'stage' => $stage,
            'user' => $user,
            'work' => $work
        ]);

    }

    public function updateWork($techCardId, $workId, Request $request) {

        $storeData = $request->validate([
            'completed_date' => 'nullable',
            'status' => 'required'
        ]);

        $work = TechCard_WorkType::find($workId);

        if (isset($storeData['completed_date'])) {
            $work->completed_date = Carbon::createFromFormat('d/m/Y', $storeData['completed_date'])->format('Y-m-d');
        } else {
            $work->completed_date = null;
        }

        $work->status = $storeData['status'];
        $work->save();

        return Redirect::to("tech-cards/$techCardId/stage/$work->stage_id")
        ->with('update_success', 'Работа обновлено успешно');;

    }

    public function deleteWork($techCardId, $workId, Request $request) {
        TechCard_WorkType::whereId($workId)->update([
            'completed_date'=> null,
            'status' => null,
            'responsible_id' => null,
            'stage_id' => null
        ]);

        return redirect()->back()
            ->with('delete_success', 'Работа удалено успешно');

    }
}

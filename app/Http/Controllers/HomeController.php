<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Liste;
use App\Models\Tache;
use App\Models\TacheCopy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $tasks = Tache::where('user_id', $user->id )->whereDate('created_at', Carbon::today())->where('is_close',0)->orderByDesc('created_at')->get();
        $tasksComplet = Tache::where('user_id', $user->id )->where('completed',1)->whereDate('created_at', Carbon::today())->where('is_close',0)->orderByDesc('created_at')->count();
        $tasksC = Tache::where('user_id', $user->id )->where('completed',0)->whereDate('created_at', Carbon::today())->where('is_close',0)->orderByDesc('created_at')->count();
        return view('home',compact('tasks','tasksC','tasksComplet'));
    }

    public function history()
    {
        $user = auth()->user();
        $dates = [];
        $tasks = Tache::where('user_id', $user->id )->where('is_close',1)->orderByDesc('created_at')->get();
        foreach ($tasks as $item){
            $dates[] =  $item->create_day;
        }
        $dates = array_unique($dates);
        return view('history',compact('tasks','dates'));
    }
    // public function commit($id)
    // {
    //     $list = Liste::findOrFail($id);
    //     $tasks = TacheCopy::where('list_id',$list->id)->orderByDesc('created_at')->get();
    //     return view('commit',compact('tasks','list'));
    // }

    public function update($id)
    {
        $task = Tache::findOrFail($id);
        return view('update',compact('task'));
    }

    public function addTask(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'endTaskDate' => 'required',
        ]);
        $createdAt = Carbon::parse($request->endTaskDate);
        Tache::create([
            'name' => $request->name,
            'description' => $request->description,
            'end_task' => $createdAt,
            'user_id' => auth()->user()->id,
            'create_day' =>Carbon::now()->format('Y-m-d')
        ]);
        flashy()->success('tache créée avec succès.');
        return redirect()->back();
    }
    public function postUpdate(Request $request,$id)
    {
        $task = Tache::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'endTaskDate' => 'required|date',
        ]);
        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'end_task' => $request->endTaskDate,
        ]);
        flashy()->success('tache modifiée avec succès.');
        return redirect()->back();
    }

    public function completed(Request $request, $id){
        if (isset($request->complete)) {
            $value = 1;
        }else{
            $value = 0;
        }
        $tasks = Tache::findOrFail($id);
        $tasks->update([
            'completed' => $value
        ]);
        return redirect()->back();
    }

    public function incomplete($id){
        $tasks = Tache::findOrFail($id);
        $tasks->update([
            'completed' => 0
        ]);
        return redirect()->back();
    }
    public function closeDay(){
        $user = auth()->user();
        DB::beginTransaction();
        $tasks = Tache::where('user_id', $user->id )->whereDate('created_at', Carbon::today())->where('is_close',0)->orderByDesc('created_at')->get();
        foreach ($tasks as $task) {
            $task->update([
                'is_close' => 1
            ]);
        }
        flashy()->success('sauvegarde de la fin de journée avec succès.');
        DB::commit();
        return redirect()->back();
    }

    public function filterDay(Request $request){
        $user = auth()->user();
        if($request->day != NULL ){
            $data = Tache::where('user_id', $user->id )->where('create_day',$request->day)->where('is_close',1)->orderByDesc('created_at')->get();
        }else{
            $data = Tache::where('user_id', $user->id )->where('is_close',1)->orderByDesc('created_at')->get();
        }

        if (count($data) > 0) {
            return response()->json($data);
        }
    }

    public function logout(){
        auth()->logout();
        flashy()->success('Deconnexion reussit avec success.');
        return redirect()->route('login');
    }
}

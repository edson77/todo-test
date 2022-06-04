<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Liste;
use App\Models\Tache;
use App\Models\TacheCopy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $tasks = Tache::where('user_id', $user->id )->whereDate('end_task', '>', Carbon::now())->where('completed',0)->orderByDesc('created_at')->get();
        $completedTasks = Tache::where('user_id', $user->id )->where('completed','<>',0)->orderByDesc('created_at')->get();
        $endTasks = Tache::where('user_id', $user->id )->whereDate('end_task', '<=', Carbon::now())->orderByDesc('created_at')->get();
        return view('home',compact('tasks','completedTasks','endTasks'));
    }

    public function history()
    {
        $user = auth()->user();
        $lists = Liste::where('user_id', $user->id)->orderByDesc('created_at')->get();
        return view('history',compact('lists'));
    }
    public function commit($id)
    {
        $list = Liste::findOrFail($id);
        $tasks = TacheCopy::where('list_id',$list->id)->orderByDesc('created_at')->get();
        return view('commit',compact('tasks','list'));
    }

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
            'endTaskDate' => 'required|date',
        ]);
        Tache::create([
            'name' => $request->name,
            'description' => $request->description,
            'end_task' => $request->endTaskDate,
            'user_id' => auth()->user()->id
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

    public function completed($id){
        $tasks = Tache::findOrFail($id);
        $tasks->update([
            'completed' => 1
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
        $list = Liste::create([
            'commit' =>Str::random(4).time(),
            'user_id'=> $user->id,
        ]);
        $tasks = $user->tasks;
        foreach ($tasks as $item) {
            TacheCopy::create([
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'end_task' => $item->end_task,
                'user_id' => $item->user_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'list_id' => $list->id,
                'completed' => $item->completed
            ]);
        }
        flashy()->success('sauvegarde de la fin de journée avec succès.');
        DB::commit();
        return redirect()->back();
    }

    public function logout(){
        auth()->logout();
        flashy()->success('Deconnexion reussit avec success.');
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Models\Department;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User/TeamController
    |--------------------------------------------------------------------------
    |
    | @Description : Team Management Controller
    | @Author : IDDL.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    protected $auth;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission');
        $this->middleware(function($request, $next){
            $this->auth = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['teams'] = Team::with('members.user')->orderBy('id','desc')->get();
        return view('team.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            return User::where('department_id', $request->department_id)->get()->toJson();
        }
        $data['departments'] = Department::orderBy('id','desc')->get();
        return view('team.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'team_name' => 'required|max:255',
        ]);

        try {
            $team = new Team;
            $team->team_name = $request->team_name;
            $team->team_details = $request->team_details;
            $team->created_by = $this->auth->id;
            $team->save();

            if($request->has('user_ids') && is_array($request->user_ids) && count($request->user_ids)>0){
                $users = $request->user_ids;
                foreach($users as $user){
                    if(!empty($user)){
                        $teamMember = new TeamMember;
                        $teamMember->team_id = $team->id;
                        $teamMember->user_id = $user;
                        $teamMember->created_by = $this->auth->id;
                        $teamMember->save();
                    }
                }
            }

            $request->session()->flash('msg_success', 'Team successfully added.');
            return redirect('teams');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Team not added.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['departments'] = Department::orderBy('id','desc')->get();
        $data['team'] = Team::with('members.user.department.users')->find($id);
        return view('team.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'team_name' => 'required|max:255',
        ]);

        try {
            $team = Team::find($id);
            $team->team_name = $request->team_name;
            $team->team_details = $request->team_details;
            $team->updated_by = $this->auth->id;
            $team->save();

            TeamMember::where('team_id', $id)->delete();
            if($request->has('user_ids') && is_array($request->user_ids) && count($request->user_ids)>0){
                $users = $request->user_ids;
                foreach($users as $user){
                    if(!empty($user)){
                        $teamMember = new TeamMember;
                        $teamMember->team_id = $team->id;
                        $teamMember->user_id = $user;
                        $teamMember->created_by = $this->auth->id;
                        $teamMember->save();
                    }
                }
            }

            $request->session()->flash('msg_success', 'Team successfully updated.');
            return redirect('teams');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Team not updated.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            Team::find($id)->delete();
            $request->session()->flash('msg_success', 'Team successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Team not deleted.');
            return redirect()->back();
        }

    }
}

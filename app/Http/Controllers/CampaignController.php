<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{

    public $validation_messages = [
        'required' => 'O campo :attribute é obrigatório.',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data['campaigns'] = Campaign::all();
        if(!$user->ability('administrator', 'administrator')){
            $data['campaigns'] = Campaign::whereHas('customers', function ($query) use($user){
                $query->where(['promoter_id' => $user->id]);
            })->orwhereHas('users', function ($query) use($user){
                $query->where(['user_id' => $user->id]);
            })->get();
        }
        return view('campaigns.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', 'client');
        })->pluck('name', 'id');
        return view('campaigns.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ],
        $this->validation_messages);        
        $campaign = Campaign::Create($request->all());
        $campaign->users()->sync($request->users);
        return redirect()->route('campaigns.edit', $campaign->id)->with('message', 'Cadastro efetuado com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['campaign'] = Campaign::find($id);     
        return view('campaigns.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['campaign'] = Campaign::find($id); 
        $data['users'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', 'client');
        })->pluck('name', 'id');       
        return view('campaigns.edit', $data);
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
        $this->validate($request, [
            'title' => 'required'
        ],
        $this->validation_messages);
        $campaign = Campaign::find($id);
        $campaign->update($request->all());
        $campaign->users()->sync($request->users);
        return redirect()->route('campaigns.edit', $campaign->id)->with('message', 'Cadastro editado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Campaign::destroy($id);
        return redirect()->route('campaigns.index')->with('message', 'Cadastro deletado com sucesso!!');
    }
}

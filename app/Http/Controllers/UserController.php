<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Role;

class UserController extends Controller
{

    public $validation_messages = [
        'required' => 'O campo :attribute é obrigatório.',
    ];

    public function __construct()
    {
        /*
        if( Gate::denies('users', User::class) ){
            abort('403', 'Não autorizado');
        }
        */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::all();
        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::pluck('display_name', 'id');
        return view('users.create', $data);
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
            'email' => 'required',
            'name' => 'required',
            'password' => 'required',
            'role' => 'required'
        ],
        $this->validation_messages);

        $r = $request->all();
        $r['password'] = bcrypt($r['password']);
        $user = User::Create($r);
        $user->roles()->sync($r['role']);
        return redirect()->route('users.index')->with('message', 'Cadastro efetuado com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::find($id);
        return view('users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['roles'] = Role::pluck('display_name', 'id');
        $data['user'] = User::find($id);
        return view('users.edit', $data);
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
            'email' => 'required',
            'name' => 'required',
            'role' => 'required'
        ],
        $this->validation_messages);

        $r = $request->all();
        if((isset($r['password']) && empty($r['password'])) || (!isset($r['password']))){
            unset($r['password']);
        }else{
            $r['password'] = bcrypt($r['password']);
        }

        $user = User::find($id);
        $user->update($r);
        $user->roles()->sync($r['role']);
        return redirect()->route('users.index')->with('message', 'Cadastro editado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('message', 'Cadastro deletado com sucesso!!');
    }
}

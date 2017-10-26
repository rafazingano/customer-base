<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Campaign;

class GalleryController extends Controller
{
    public $validation_messages = [
        'required' => 'O campo :attribute é obrigatório.',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($campaign)
    {
        $data['campaign'] = Campaign::find($campaign);
        $data['galleries'] = Gallery::where(['campaign_id' => $campaign])->get();
        return view('galleries.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaign)
    {
        $data['campaign'] = Campaign::find($campaign);
        return view('galleries.create', $data);
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
        $gallery = Gallery::Create($request->all());
        $this->upload($request, $gallery->id);
        return redirect()->route('campaigns.galleries.edit', ['campaign' => $gallery->campaign_id, 'id' => $gallery->id])->with('message', 'Cadastro efetuado com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['gallery'] = Gallery::find($id);      
        return view('galleries.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($campaign, $id)
    {
        $data['campaign'] = Campaign::find($campaign);
        $data['gallery'] = Gallery::find($id);        
        return view('galleries.edit', $data);
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
        $gallery = Gallery::find($id);
        $gallery->update($request->all());
        $this->upload($request, $gallery->id);
        return redirect()->route('campaigns.galleries.edit', ['campaign' => $gallery->campaign_id, 'id' => $gallery->id])->with('message', 'Cadastro editado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);
        return back()->withInput()->with('message', 'Cadastro deletado com sucesso!!');
    }


    public function upload(Request $request, $id, $dir = 'public/galleries')
    {
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $md5Name = md5(uniqid(rand(), true)) . '.' . $image->guessExtension();
                $path = $image->storeAs($dir, $md5Name);

                $fs[] = ['title' => 'Imagem nova', 'image' => $md5Name, 'gallery_id' => $id];
            }
            Gallery::find($id)->images()->createMany($fs);
            return true;
        }
        return false;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
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
        $data['blogs'] = Blog::paginate(5);
        return view('blogs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
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
        
        $blog = Blog::Create($request->all());
        $this->upload($request, $blog->id);
        return redirect()->route('blogs.edit', $blog->id)->with('message', 'Cadastro efetuado com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['blog'] = Blog::find($id);     
        return view('blogs.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog'] = Blog::find($id);        
        return view('blogs.edit', $data);
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
        $blog = Blog::find($id);
        $blog->update($request->all());
        $this->upload($request, $blog->id);
        return redirect()->route('blogs.edit', $blog->id)->with('message', 'Cadastro editado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::destroy($id);
        return redirect()->route('blogs.index')->with('message', 'Cadastro deletado com sucesso!!');
    }

    private function upload(Request $request, $id, $dir = 'public/blogs'){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $md5Name = md5(uniqid(rand(), true)) . '.' . $image->guessExtension();
            $path = $image->storeAs($dir, $md5Name);                  
            Blog::find($id)->update(['image' => $md5Name]);
        }
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $md5Name = md5(uniqid(rand(), true)) . '.' . $image->guessExtension();
                $path = $image->storeAs($dir, $md5Name);

                $fs[] = ['image' => $md5Name, 'blog_id' => $id];
            }
            Blog::find($id)->images()->createMany($fs);
        }
        return false;
    }
}

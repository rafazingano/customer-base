<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KitItem;
use Excel;
use App\Customer;

class KitItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    public function updatemany(Request $request)
    {
        $input = $request->items;
        foreach ($input as $key => $value) {
           KitItem::where('id', $key)->update($value);
        }
        return back()->withInput()->with('message', 'Cadastros editados com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KitItem::destroy($id);
        return back()->withInput()->with('message', 'Cadastro deletado com sucesso!!');
    }


    public function import($kititem)
    {
        $data['kit_item_id'] = $kititem;
        return view('kititems.import', $data);
    }

    public function importStore(Request $request)
    {
        $input = $request->all();
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path)->get();
            $kit_item = KitItem::find($input['kit_item_id']);
            //dd($data);
            if($data->count()){
                foreach ($data as $key => $value) {
                    if(empty($value->loja)){
                        break;
                    }
                    $user = Customer::where(['loja' => $value->loja, 'campaign_id' => $kit_item->kit->campaign_id])->first();
                    //dd($user->id);
                    if($user){
                        $arr = [
                            'title' => $kit_item->title, 
                            'content' => $value->descricao, 
                            'customer_id' => (integer) $user->id,
                            'amount' => (integer) $value->quantidade, 
                            'kit_item_id' => $kit_item->id, 
                            'kit_id' => $kit_item->kit_id                        
                        ];   
                        if(!empty($arr)){
                            KitItem::where(
                                ['customer_id' => $user->id, 'kit_item_id' => $kit_item->id, 'kit_id' => $kit_item->kit_id ])->update($arr);
                        }   
                    }             
                }
            }
        }
        return back()->withInput()->with('message', 'Importação com sucesso!!');
    }



}

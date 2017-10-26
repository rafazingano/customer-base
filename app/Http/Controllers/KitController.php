<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kit;
use App\Campaign;
use App\Customer;
use App\KitItem;

class KitController extends Controller
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
        $data['kits'] = Kit::where(['campaign_id' => $campaign])->get();
        return view('kits.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaign)
    {
        $data['campaign'] = Campaign::find($campaign);
        return view('kits.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kit = $this->add($request);
        return redirect()->route('campaigns.kits.edit', ['campaign' => $kit->campaign_id,'id' => $kit->id])->with('message', 'Cadastro efetuado com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['campaign'] = Campaign::find($campaign);
        $data['Kit'] = Kit::find($id);     
        return view('kits.show', $data);
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
        $data['kit'] = Kit::find($id); 
        $data['customers'] = Customer::where(['campaign_id' => $campaign])->get();
        //dd($data['customers']);
        return view('kits.edit', $data);
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
        $kit = $this->add($request, $id);
        return redirect()->route('campaigns.kits.edit', ['campaign' => $kit->campaign_id,'id' => $kit->id])->with('message', 'Cadastro editado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kit::destroy($id);
        return back()->withInput()->with('message', 'Cadastro deletado com sucesso!!');
    }

    private function upload(Request $request, $id){
        if($request->hasFile('image')){
            $Kit = Kit::find($id);
            $image = $request->file('image');
            $md5Name = md5(uniqid(rand(), true)) . '.' . $image->guessExtension();
            $path = $image->storeAs('public/Kits', $md5Name);                  
            $Kit->update(['image' => $md5Name]);
        }
        return false;
    }

    private function add(Request $request, $id = null){
        $this->validate($request, [
            'title' => 'required',
        ],
        $this->validation_messages);
        if(!isset($id)){
            $kit = Kit::Create($request->all());
        }else{
            $kit = Kit::find($id);
            $kit->update($request->all());
        }
        //dd($request->items);
        if(isset($request->items)){
            $itemsadd = $kit->items()->createMany($request->items);

            $customers = Customer::where(['campaign_id' => $kit->campaign_id])->get();
            foreach ($customers as $cust) {
                foreach($itemsadd as $itemkit){
                    if(isset($itemkit->title) && !empty($itemkit->title)){
                        $ik = [
                            "title" => $itemkit->title,
                            "amount" => $itemkit->amount,
                            "content" => $itemkit->content,
                            "kit_id" => $itemkit->kit_id,
                            "kit_item_id" => $itemkit->id,
                            "customer_id" => $cust->id
                        ];
                        KitItem::firstOrCreate($ik);
                    }else{
                        KitItem::destroy($itemkit->id);
                    }
                }
            }
        }
        return $kit;
    }
}

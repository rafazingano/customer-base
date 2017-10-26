<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Campaign;
use App\User;
use App\Status;
use App\Kit;
use App\KitItem;
use App\File;
use App\Http\Controllers\FileController;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public $validation_messages = [
        'required' => 'O campo :attribute é obrigatório.',
        'date_format' => 'A data não foi preenchida ou a data não esta no formato devido'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $campaing)
    {
        $data['campaign'] = Campaign::find($campaing);
        $gets = $request->all();
        $gets['campaign_id'] = $campaing;
        if(!isset($gets['promoter_id'])){
            unset($gets['promoter_id']);
        }

        $user = Auth::user();
        if($user->hasRole(['promoter'])){
            $gets['promoter_id'] = $user->id;
        }
        /*
        if($user->ability('administrator', 'client')){
            $gets['client_id'] = $user->id;
        }
        */
        $data['customers'] = $data['campaign']->customers()->where($gets)->get();

        $data['customer_ativado'] = Customer::where($gets)->whereHas('status', function ($query) {
            $query->where('title', 'like', 'Ativado');
        })->count();
        $data['customer_parcial'] = Customer::where($gets)->whereHas('status', function ($query) {
            $query->where('title', 'like', 'Parcial');
        })->count();
        $data['customer_aguardando'] = Customer::where($gets)->whereHas('status', function ($query) {
            $query->where('title', 'like', 'Aguardando');
        })->count();
        $data['customer_recusado'] = Customer::where($gets)->whereHas('status', function ($query) {
            $query->where('title', 'like', 'Recusado');
        })->count();
        $data['customer_entregue'] = Customer::where($gets)->whereHas('status', function ($query) {
            $query->where('title', 'like', 'Entregue');
        })->count();
        $data['customer_despachado'] = Customer::where($gets)->whereHas('status', function ($query) {
            $query->where('title', 'like', 'Despachado');
        })->count();

        // $data['promotores'] = User::has('customers', '>=', 1)->whereHas('roles', function ($query) {
        //     $query->where('name', 'like', 'promoter');
        // })->pluck('name', 'id');

        $data['promotores'] = User::whereHas('customers', function ($query) use($campaing) {
            $query->where('campaign_id', $campaing);
        })->whereHas('roles', function ($query) {
            $query->where('name', 'like', 'promoter');
        })->pluck('name', 'id');


        return view('customers.index', $data);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaing)
    {
        $data['campaign'] = Campaign::find($campaing);
        $data['status'] = Status::pluck('title', 'id');
        $data['promoters'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', 'promoter');
        })->pluck('name', 'id');
        $data['representatives'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', 'representative');
        })->pluck('name', 'id');
        $data['kits'] = Kit::pluck('title', 'id');
        return view('customers.create', $data);
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
            'razao_social' => 'required'
        ],
        $this->validation_messages);
        $r = $request->all();
        if($r['data'] == "____-__-__"){
            unset($r['data']);
        }
        if(isset($r['data'])){
            $r['data'] .= ' 00:00:00';
        }
        if($r['data_2'] == "____-__-__"){
            unset($r['data_2']);
        }
        if(isset($r['data_2'])){
            $r['data_2'] .= ' 00:00:00';
        }
        $r['concluido_data'] = isset($r['concluido'])? Carbon::now() : NULL;
        $c = Customer::Create($r);
        $this->upload($request, $c->id);

        $itemsadd = KitItem::whereNull('customer_id')->whereHas('kit', function ($query) use($r) {
            $query->where('campaign_id', $r['campaign_id']);
        })->get();
        //dd($itemsadd);
        foreach($itemsadd as $itemkit){
            if(isset($itemkit->title) && !empty($itemkit->title)){
                $ik = [
                    "title" => $itemkit->title,
                    "amount" => $itemkit->amount,
                    "content" => $itemkit->content,
                    "kit_id" => $itemkit->kit_id,
                    "kit_item_id" => $itemkit->id,
                    "customer_id" => $c->id
                ];
                KitItem::firstOrCreate($ik);
            }else{
                KitItem::destroy($itemkit->id);
            }
        }



        return redirect()->route('campaigns.customers.index', $request->campaign_id)->with('message', 'Cadastro efetuado com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$data['colls'] = $this->colls;
        $data['customer'] = Customer::find($id);     
        return view('customers.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($campaing, $id)
    {
        $data['campaign'] = Campaign::find($campaing);
        $data['status'] = Status::pluck('title', 'id');
        $data['promoters'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', 'promoter');
        })->pluck('name', 'id');
        $data['representatives'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', 'representative');
        })->pluck('name', 'id');
        $data['kits'] = Kit::pluck('title', 'id');

        $data['customer'] = Customer::find($id);        
        return view('customers.edit', $data);
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
            'razao_social' => 'required'
        ],
        $this->validation_messages);
        $r = $request->all();
        if($r['data'] == "____-__-__"){
            unset($r['data']);
        }        
        if(isset($r['data'])){
            $r['data'] .= ' 00:00:00';
        }
        if($r['data_2'] == "____-__-__"){
            unset($r['data_2']);
        }
        if(isset($r['data_2'])){
            $r['data_2'] .= ' 00:00:00';
        }
        $r['concluido_data'] = isset($r['concluido'])? Carbon::now() : NULL;
        $customer = Customer::find($id);
        $customer->update($r);

        $this->upload($request, $id);

        return redirect()->route('campaigns.customers.index', $request->campaign_id)->with('message', 'Cadastro editado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        Customer::destroy($id);
        return redirect()->route('campaigns.customers.index', $customer->campaign_id)->with('message', 'Cadastro deletado com sucesso!!');
    }

    private function upload(Request $request, $id){
        if($request->hasFile('files')){
            $file = new FileController();
            $os = $file->upload($request);
            if(count($os) > 0){
                foreach($os as $o){
                    File::Create(['name' => $o, 'customer_id' => $id]);
                }
                return true;
            }
        }
        return false;
    }

    public function import($campaign)
    {
        $data['campaign_id'] = $campaign;
        return view('customers.import', $data);
    }

    public function exportStore($campaign){
        $data = Customer::where(['campaign_id' => $campaign])->get();
        Excel::create('Export List', function($excel) use($data) 
        {
            $excel->sheet('Sheet01', function($sheet) use($data) 
            {
              $sheet->fromArray( $data );
            });

        })->export('xls');
        return redirect()->route('campaigns.index')->with('message', 'Exportação com sucesso!!');
    }

    public function importStore(Request $request)
    {
        //ini_set('max_execution_time', 180);
        $input = $request->all();
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path)->get();
            //dd($data);
            if($data->count()){
                foreach ($data as $key => $value) {
                    if(empty($value->cnpj)){
                        break;
                    }
                    $promoter = User::where(['name' => $value->promotor])->first();
                    if(isset($value->promotor) && !isset($promoter->id)){
                        $r['name'] = $value->promotor;
                        $r['email'] = md5(uniqid("")) . '@email.com';
                        $r['password'] = bcrypt($value->promotor);
                        $promoter = User::Create($r);
                        $promoter->roles()->sync(2);
                    }
                    $status = Status::where(['title' => $value->status])->first();
                    $arr[] = [
                        //'kit_id' => Kit::where('title', 'LIKE', ),
                        'promoter_id' => isset($promoter->id)? $promoter->id : 1,
                        'status_id' => isset($status->id)? $status->id : 1,

                        'campaign_id' => (integer) $input['campaign_id'],
                        'cnpj' => $value->cnpj,
                        //'ativacao' => $value->data_da_ativacao,
                        'desconformidade' => $value->desconformidade,
                        'nivel' => $value->nivel,
                        //'status' => $value->status,
                        //'represvendedor' => $value->represvendedor,
                        'localizador' => $value->localizador,
                        'qt' => $value->qt,
                        'roteiro' => $value->roteiro,
                        'previsao' => $value->previsao,
                        'fone_1' => $value->fone_1,
                        'fone_2' => $value->fone_2,
                        //'canal' => $value->canal,
                        'code' => (string) $value->id,
                        'ie' => (string) $value->ie,
                        'razao_social' => $value->razao_social,
                        'endereco' => $value->endereco,
                        'bairro' => $value->bairro,
                        'cidade' => $value->cidade,
                        'uf' => $value->uf,
                        'cep' => (string) $value->cep,
                        //'promotor' => $value->promotor,
                        //'kit' => $value->kit,
                        'loja' => $value->loja,
                        'data' => $value->data,
                        'data_2' => $value->data2,
                        'feedback' => $value->feedback,
                        'recebido_por' => $value->recebido_por,
                        'concluido' => isset($value->concluido) && in_array($value->concluido, ['Concluído', 'concluido'])? true : false,
                        'concluido_data' => isset($value->concluido_data) && ($value->concluido_data != 'NULL')? $value->concluido_data : NULL,
                        'contato' => $value->contato,
                        'email' => $value->e_mail,
                        'distancia' => $value->distancia,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ];                    
                }
                if(!empty($arr)){
                    Customer::insert($arr);
                }
            }
        }
        return redirect()->route('campaigns.customers.index', $input['campaign_id'])->with('message', 'Importação com sucesso!!');
    }

}

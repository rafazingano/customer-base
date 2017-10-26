<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $dates = array('data', 'concluido_data', 'data_2');
    
	protected $fillable = [
	    'desconformidade',
        'data',
	    'nivel',
	    'canal',
	    'cnpj',
	    'ie',
        'telefone',
        'feedback',
        'concluido',
        'concluido_data',
	    'razao_social',
	    'endereco',
	    'bairro',
	    'cidade',
	    'uf',
	    'cep',
	    'promoter_id',
	    'qt',
	    'status_id',
	    'kit_id',
        'campaign_id',
        'representative_id',
        'recebido_por',
        'loja',
        'contato',
        'roteiro',
        'fone_1',
        'fone_2',
        'email',
        'distancia',
        'data_2'
    ];

	public function files()
    {
        return $this->hasMany('App\File');
    }

    public function campaign()
    {
        return $this->belongsTo('App\campaign');
    }

    public function promoter()
    {
        return $this->belongsTo('App\User', 'promoter_id');
    }

    public function representative()
    {
        return $this->belongsTo('App\User', 'representative_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function kit()
    {
        return $this->belongsTo('App\Kit');
    }

    public function kit_items()
    {
        return $this->hasMany('App\KitItem');
    }
}

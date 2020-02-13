<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable=['nombre', 'categoria', 'precio', 'stock','imagen'];

    public function scopeCategoria($query,$v){
        if($v=='%'){
            return $query->where('categoria','like' ,$v)
            ->orWhereNull('categoria');
        }
        if(!isset($v)){
            return $query->where('categoria','like' ,'%')
            ->orWhereNull('categoria');
        }
        return $query->where('categoria', $v);
    }

    public function scopePrecio($query, $opcion){
        switch($opcion){
            case 0 :
                return $query;
            case 1:
                return $query->where('precio','<',50);
            case 2:
                return $query->whereBetween('precio',[51,120]);
            case 3:
                return $query->where('precio','>',121);
        }
    }


}

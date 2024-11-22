<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'classes';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['name', 'description', 'course_id', 'order_classe'];

    //Criar relacionamento ente um e muitos
    public function course(){
        return $this->belongsTo(Course::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    //Indicar o nome da tabela
    protected $table = 'courses';

    //Indicar quais colunas podem ser cadastradas
    protected $fillable = ['name', 'price'];

    //Criar relacionamento ente um e muitos
    public function classe(){
        return $this->HasMany(Course::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use OwenIt\Auditing\Contracts\Auditable;
use \OwenIt\Auditing\Auditable as AuditingAuditable;

class Course extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    //Indicar o nome da tabela
    protected $table = 'courses';

    //Indicar quais colunas podem ser cadastradas
    protected $fillable = ['name', 'price'];

    //Criar relacionamento ente um e muitos
    public function classe(){
        return $this->HasMany(Course::class);
    }
}

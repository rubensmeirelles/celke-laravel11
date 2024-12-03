<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use \OwenIt\Auditing\Auditable as AuditingAuditable;

class Classe extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    // Indicar o nome da tabela
    protected $table = 'classes';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['name', 'description', 'course_id', 'order_classe'];

    //Criar relacionamento ente um e muitos
    public function course(){
        return $this->belongsTo(Course::class);
    }

}

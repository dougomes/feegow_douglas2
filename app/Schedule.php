<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /*
    Desnecessário setar $table (Nome da tabela tratada pela classe) uma vez que a engine usa como padrão o plural da classe.
    Ainda mais tendo a classe criada pelo sistema pelo comando: php artisan make:model Schedule -mcr
    Que cria a as classes e implementações básicas de: Model, Migration e Controller. Porém é boa prática
    principalmente se um terceiro for realizar manutenção do sistema
    */
    protected $table = 'schedules';

    //Se não quiser que o Eloquent faça gestão de datas de criação e modificação de registros
    //public $timestamps = false

    //Array dos campos que podem ser editados em massa. Bom para informações não sensíveis
    protected $fillable = [
        'specialty_id',
        'professional_id',
        'name',
        'cpf',
        'source_id',
        'birthdate',
        'date_time'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SottoProgetto extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'sotto_progetti';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'titolo',
        'descrizione',
        'data_rilascio',
        'responsabile_id',
        'progetto_id',
    ];

    public function responsabile(){
        return $this->belongsTo(Ricercatore::class, 'responsabile_id');
    }

    public function progetto(){
        return $this->belongsTo(Progetto::class, 'progetto_id');
    }

    public function ricercatori(){
        return $this->belongsToMany(Ricercatore::class);
    }

    public function milestones(){
        return $this->hasMany(Milestone::class);
    }
}

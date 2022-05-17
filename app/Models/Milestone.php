<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Milestone extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'milestones';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'data_evento',
        'descrizione',
        'sotto_progetto_id',
    ];

    public function sotto_progetto()
    {
        return $this->belongsTo(SottoProgetto::class, 'sotto_progetto_id');
    }
}

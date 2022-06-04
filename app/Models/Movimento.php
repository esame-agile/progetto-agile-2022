<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Movimento extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'movimenti';
    public $timestamps = true;
    /*
     * approvazione può essere 0, 1 o 2:
     * 0 se il movimento non è ancora stato approvato
     * 1 se il movimento è stato approvato
     * 2 se il movimento è stato rifiutato
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'importo',
        'causale',
        'data',
        'approvazione',
        'progetto_id',
        'utente_id',
    ];

    public function progetto(){
        return $this->belongsTo(Progetto::class, "progetto_id");
    }

    public function ricercatore(){
        return $this->belongsTo(Ricercatore::class, "utente_id");
    }

    public function finanziatore(){
        return $this->belongsTo(Finanziatore::class, "utente_id");
    }
}

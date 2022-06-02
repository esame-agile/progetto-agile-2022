<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pubblicazione extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'pubblicazioni';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'doi',
        'titolo',
        'sorgente',
        'ufficiale',
        'tipologia',
        'autori_esterni',
        'progetto_id',
        'file_name'
    ];

    public function ricercatore(){
        return $this->belongsToMany(Ricercatore::class);
    }
    public function progetto(){
        return $this->belongsTo(Progetto::class,'progetto_id');
    }
}

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'importo',
        'causale',
        'data',
        'progetto_id'
    ];

    public function progetto(){
        return $this->belongsTo(Progetto::class, "progetto_id");
    }
}

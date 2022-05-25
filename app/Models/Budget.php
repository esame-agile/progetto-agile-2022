<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Budget extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'budget';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'importo',

    ];


    public function movimenti(){
        return $this->hasMany(Movimento::class);
    }
    public function progetto(){
        return $this->belongsTo(Progetto::class);
    }
}

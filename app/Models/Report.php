<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Report extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'reports';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'titolo',
        'file_name',
        'data',
        'ricercatore_id',

    ];

    public function autore(){
        return $this->belongsTo(Ricercatore::class, 'ricercatore_id');
    }

    public function sotto_progetto(){
        return $this->belongsTo(SottoProgetto::class);
    }
    public function progetto(){
        return $this->belongsTo(Progetto::class);
    }
}

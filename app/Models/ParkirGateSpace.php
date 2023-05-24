<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirGateSpace extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'parkir_gate_spaces';
    /**
     * @var string
     */
    protected $primaryKey = 'id_gatespace';
    /**
     * @var string[]
     */
    protected $fillable = ['id_gate', 'kode_space', "id_user"];

    public function gate() {
        return $this->belongsTo(ParkirGate::class, 'id_gate', 'id_gate');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function trans() {
        return $this->belongsTo(ParkirTrans::class, 'id_gatespace', 'id_gatespace');
    }


}

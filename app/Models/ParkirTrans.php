<?php

namespace App\Models;

use Illuminate\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirTrans extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'parkir_trans';
    /**
     * @var string
     */
    protected $primaryKey = 'id_trans';
    /**
     * @var string[]
     */
    protected $fillable = ['id_gate', 'id_gatespace', 'id_user', 'tgl_masuk', 'tgl_keluar', 'lama_parkir', 'kode_masuk', 'kode_keluar', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gate() {
        return $this->belongsTo(ParkirGate::class, 'id_gate', 'id_gate');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gatespace() {
        return $this->belongsTo(ParkirGateSpace::class, 'id_gatespace', 'id_gatespace');
    }
}

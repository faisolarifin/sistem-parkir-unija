<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirGate extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'parkir_gates';
    /**
     * @var string
     */
    protected $primaryKey = 'id_gate';
    /**
     * @var string[]
     */
    protected $fillable = ['nama_gate', 'jml_max', 'id_akun'];

    public function akun() {
        return $this->belongsTo(Account::class, 'id_akun', 'id_akun');
    }

}

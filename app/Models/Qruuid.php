<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qruuid extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'user_qr_uuid';
    /**
     * @var string
     */
    protected $primaryKey = 'id_qr';
    /**
     * @var string[]
     */
    protected $fillable = ['id_user', 'uuid_enter', 'uuid_exit', "id_trans"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trans() {
        return $this->belongsTo(ParkirTrans::class, 'id_trans', 'id_trans');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

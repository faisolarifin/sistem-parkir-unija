<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var string
     */
    protected $primaryKey = 'id_user';
    /**
     * @var string[]
     */
    protected $fillable = ['nama', 'email', 'no_identitas', 'platnomor'];

    public function account() {
        return $this->belongsTo(Account::class, 'id_user', 'id_user');
    }
}

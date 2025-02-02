<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boutiques extends Model
{    
    public $table = "boutiques";
    protected $primaryKey = "id";
    public $incrementing = true;

    public function get_utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

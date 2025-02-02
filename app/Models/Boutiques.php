<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boutiques extends Model
{    
    public $table = "boutiques";
    protected $primaryKey = "id";
    public $incrementing = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'shop_name',
        'subdomain',
    ];
    

    public function get_utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = [
        "last_code", 
        "new_code", 
        "description", 
        "observations", 
        "type", 
        "user_id", 
        "state"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

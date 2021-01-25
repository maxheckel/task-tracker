<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $fillable = ['user_id',
        'name',
        'rate',
        'currency',
        'street1',
        'street2',
        'city',
        'state',
        'zip',
        'country',
        'contact_email',
        'contact_phone'
    ];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}

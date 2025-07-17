<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
     protected $table = 'person'; // use exact table name if not plural
    protected $primaryKey = 'person_id'; // this is important!
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'firstName',
        'lastName',
        'middleName',
        'birthDate',
        'address',
        'contactNo'
    ];
}

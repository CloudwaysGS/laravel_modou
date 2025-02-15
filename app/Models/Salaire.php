<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'nom', 'amount', 'payment_date', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

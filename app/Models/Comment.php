<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['employee_id','author','body'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
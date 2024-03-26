<?php




namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['trainer_id', 'amount', 'month'];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}

<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = ['name'];

    public function trainings()

    {
        
        return $this->hasMany(Training::class);
    }

    public function clients()

    {
        return $this->hasMany(Client::class);
    }
}

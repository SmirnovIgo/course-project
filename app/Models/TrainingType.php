<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
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

    public function managers()

    {
        return $this->hasMany(Manager::class);
    }

    public function administrators()

    {
        return $this->hasMany(Administrator::class);
    }
}

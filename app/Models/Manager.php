<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function trainings()

    {
        return $this->hasMany(Training::class);

    }
}

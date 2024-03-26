<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $fillable = ['name'];
    
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function administrators()
    {
        return $this->hasMany(Administrator::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

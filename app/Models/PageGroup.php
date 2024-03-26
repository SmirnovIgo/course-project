<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageGroup extends Model
{
    use HasFactory;

    protected $table = 'pages_groups';
    protected $fillable = [
        'name'
    ];
    public function pageGroupPermission() {
        return $this->hasMany(PageGroupPermission::class);
    }
}

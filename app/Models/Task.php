<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline'
    ];

    protected $dates = ['deleted_at'];

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
    }

    // Аксессор для преобразования даты при извлечении
    public function getDeadlineAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'открыта' : 'закрыта';
    }
}

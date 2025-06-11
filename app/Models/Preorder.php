<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'description', 'status', 'admin_message'];

    public function items()
    {
        return $this->hasMany(PreorderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getStatusTextAttribute()
{
    return [
        'pending' => 'В обработке',
        'completed' => 'Выполнен',
        'rejected' => 'Отклонен'
    ][$this->status] ?? $this->status;
}

// Получение только выполненных заказов
public function scopeCompleted($query)
{
    return $query->where('status', 'completed');
}

// Получение только новых заказов
public function scopePending($query)
{
    return $query->where('status', 'pending');
}
}

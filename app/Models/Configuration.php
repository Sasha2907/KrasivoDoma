<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'product_type', 'width', 'height',
        'fabric_id', 'sewing_type_id', 'quilting_method'
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function fabric() {
        return $this->belongsTo(Fabric::class);
    }
    
    public function sewingType() {
        return $this->belongsTo(SewingType::class);
    }
}

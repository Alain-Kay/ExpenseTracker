<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $primaryKey = 'income_id';
    protected $fillable = [
        'user_id',
        'income_category_id',
        'income_currency_id',
        'income_title',
        'income_source',
        'income_description',
        'income_amount',
        'income_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'income_category_id', 'category_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'income_currency_id', 'currency_id');
    }
}

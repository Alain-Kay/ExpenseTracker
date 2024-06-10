<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $primaryKey = 'expense_id';
    protected $fillable = [
        'expense_category_id',
        'user_id',
        'expense_currency_id',
        'expense_title',
        'expense_description',
        'expense_amount',
        'expense_date'
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
        return $this->belongsTo(Category::class, 'expense_category_id', 'category_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'expense_currency_id', 'currency_id');
    }
}

<?php

namespace App\Models;

use App\Models\FeeCategoryAmount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeCategory extends Model
{
    use HasFactory;

    public function fee_category_amount()
    {
        return $this->hasMany(FeeCategoryAmount::class);
    }
}

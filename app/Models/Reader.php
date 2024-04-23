<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reader extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'checkout', 'reader_id', 'book_id')
        ->withPivot('start_date', 'end_date', 'is_returned');
    }
}

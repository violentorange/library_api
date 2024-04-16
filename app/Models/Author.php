<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'country_id',
    // ];

    protected $guarded = [];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);

    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'author_book');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListUnit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(ListItem::class);
    }

    public function sharedByUsers()
    {
        return $this->belongsToMany(User::class,'shared_list_unit', 'list_unit_id', 'shared_by')
            ->withPivot('shared_with')
            ->using(SharedListUnit::class);
    }

    public function sharedWithUsers()
    {
        return $this->belongsToMany(User::class,'shared_list_unit', 'list_unit_id', 'shared_with')
            ->withPivot('shared_by')
            ->using(SharedListUnit::class);
    }
}

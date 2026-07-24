<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrDocument extends Model
{
    protected $fillable = [
        'title',
        'category',
        'file_path',
        'description',
        'uploaded_by',
        'user_id',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

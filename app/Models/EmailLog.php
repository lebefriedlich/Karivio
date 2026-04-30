<?php

namespace App\Models;

use App\Traits\CleansBinaryDates;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutIncrementing;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Table('email_logs')]
#[Fillable([
    'user_id',
    'to',
    'subject',
    'body',
    'attachments',
    'status',
    'error_message',
    'scheduled_at',
])]
#[WithoutIncrementing]
class EmailLog extends Model
{
    use HasUuids, CleansBinaryDates;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'attachments' => 'json',
            'scheduled_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

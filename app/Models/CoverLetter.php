<?php

namespace App\Models;

use App\Traits\CleansBinaryDates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutIncrementing;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('cover_letters')]
#[Fillable([
    'user_id',
    'language',
    'full_name',
    'phone',
    'email',
    'city',
    'date',
    'company_name',
    'company_address',
    'applied_position',
    'content',
])]
#[WithoutIncrementing]
class CoverLetter extends Model
{
    use HasUuids, CleansBinaryDates;

    protected $keyType = 'string';

    public function getProcessedContent()
    {
        $placeholders = [
            // Company Name
            '{{ Nama Perusahaan }}' => $this->company_name,
            '{{ Company Name }}' => $this->company_name,
            '{{ nama perusahaan / company name }}' => $this->company_name,
            
            // Position
            '{{ Posisi }}' => $this->applied_position,
            '{{ Position }}' => $this->applied_position,
            '{{ posisi / position }}' => $this->applied_position,
            '{{ Posisi yang Dilamar }}' => $this->applied_position,
            '{{ Position Applied }}' => $this->applied_position,
        ];

        $processed = $this->content;
        foreach ($placeholders as $key => $value) {
            $keyNoSpace = str_replace(['{{ ', ' }}'], ['{{', '}}'], $key);
            $processed = str_ireplace([$key, $keyNoSpace], $value ?: $key, $processed);
        }

        return $processed;
    }
}

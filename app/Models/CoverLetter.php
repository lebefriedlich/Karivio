<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutIncrementing;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('cover_letters')]
#[Fillable([
    'user_id',
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
    use HasUuids;

    protected $keyType = 'string';

    public function getProcessedContent()
    {
        $placeholders = [
            '{{ Nama Lengkap }}' => $this->full_name,
            '{{ Telepon }}' => $this->phone,
            '{{ Email }}' => $this->email,
            '{{ Kota }}' => $this->city,
            '{{ Tanggal }}' => \Carbon\Carbon::parse($this->date)->translatedFormat('d F Y'),
            '{{ Nama Perusahaan }}' => $this->company_name,
            '{{ Alamat Perusahaan }}' => $this->company_address,
            '{{ Posisi }}' => $this->applied_position,
        ];

        return str_replace(array_keys($placeholders), array_values($placeholders), $this->content);
    }
}

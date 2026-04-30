<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\WithoutIncrementing;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[Table('users')]
#[Fillable([
    'name',
    'email',
    'password',
    'google_id',
    'avatar',
    'google_token',
    'google_refresh_token',
    'google_token_expires_at',
])]
#[Hidden(['password', 'remember_token'])]
#[WithoutIncrementing]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'google_token_expires_at' => 'datetime',
        ];
    }

    /**
     * Override asDateTime to clean binary data from hosting.
     */
    protected function asDateTime($value)
    {
        if (is_resource($value)) {
            $value = stream_get_contents($value);
        }

        if (is_string($value)) {
            // Remove binary null bytes and non-printable characters
            $value = preg_replace('/[[:cntrl:]]/', '', $value);
            
            // Fallback if string is empty or corrupted after cleaning
            if (empty($value) || !preg_match('/^[0-9]/', $value)) {
                return parent::asDateTime(now());
            }
        }

        return parent::asDateTime($value);
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get a valid access token, refreshing it if necessary.
     */
    public function getValidGoogleToken()
    {
        if ($this->google_token_expires_at && $this->google_token_expires_at->isFuture()) {
            return $this->google_token;
        }

        if (!$this->google_refresh_token) {
            return null;
        }

        $client = new \Google\Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        
        $response = $client->fetchAccessTokenWithRefreshToken($this->google_refresh_token);

        if (isset($response['error'])) {
            return null;
        }

        $this->update([
            'google_token' => $response['access_token'],
            'google_token_expires_at' => is_numeric($response['expires_in'] ?? null) 
                ? now()->addSeconds((int) $response['expires_in']) 
                : now()->addHour(),
        ]);

        return $response['access_token'];
    }
}

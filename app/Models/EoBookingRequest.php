<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EoBookingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_organizer_id',
        'event_name', // Nama event yang diinginkan user
        'event_date', // Tanggal event yang diinginkan user
        'notes',      // Catatan tambahan dari user
        'status',     // Contoh: 'pending', 'accepted', 'rejected', 'completed'
    ];

    /**
     * Get the user that owns the booking request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event organizer for the booking request.
     */
    public function eventOrganizer()
    {
        return $this->belongsTo(EventOrganizer::class);
    }
}
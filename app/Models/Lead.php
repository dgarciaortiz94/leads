<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'lead_closing',
    ];


    /**
     * Get the lead_status associated with the lead.
     */
    public function leadStatus()
    {
        return $this->hasOne(LeadStatus::class);
    }

}

<?php

namespace App\Models\Settings;

use App\Traits\Uuid;
use App\Traits\Audit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Skill extends Model
{
    use Notifiable, Audit, Uuid;
}

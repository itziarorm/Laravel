<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WizardPotion extends Model
{
    use HasFactory;

    protected $table = 'wizard_potions';
    public $timestamps = false;

    protected $fillable = ['wizard_id', 'potion_id', 'date_brewed'];
}

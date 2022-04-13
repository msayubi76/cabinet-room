<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralSetting extends Model
{
    use SoftDeletes, Multitenantable;
    protected $fillable = [
        'japan_rate' ,
        'welcome_message',
        'ceo_image',
        'ceo_name',
        'ceo_message',
        'df_image',
        'df_name',
        'df_message',
        'coordinator_image',
        'coordinator_name',
        'coordinator_message',
        'hirose_president_image',
        'hirose_president_name',
        'hirose_president_message',
        'head_office_address',
        'branch_address',
        'tel_1',
        'mobile_1',
        'fax_1',
        'tel_2',
        'mobile_2',
        'fax_2',
        'email_1',
        'email_2',
        'email_3',
    ];
}

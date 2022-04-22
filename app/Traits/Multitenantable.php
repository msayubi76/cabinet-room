<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait Multitenantable{

    public static function bootMultitenantable() {

            static::creating(function($model) {
                $userid = (!Auth::guest()) ? Auth::user()->id : null;
                $model->created_by = $userid;
            });
            static::updating(function($model) {
                $userid = (!Auth::guest()) ? Auth::user()->id : null;
                $model->updated_by = $userid;
            });
            static::deleting(function($model) {
                $userid = (!Auth::guest()) ? Auth::user()->id : null;
                $model->deleted_by = $userid;
            });

    }

}
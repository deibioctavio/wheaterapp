<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ElfSundae\Laravel\Hashid\Facades\Hashid;

class APISecurity extends Model
{
    public static function getReversibleHash($integer) {
        hashid('hashids_string');
        return hashid_encode($integer);

    }

    public static function getReverseHash($hash) {
        hashid('hashids_string');
        return hashid_decode($hash);
    }
}

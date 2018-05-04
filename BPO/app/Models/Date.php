<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
        /*Skru av timestamps*/
        public $timestamps = false;

        /**
         * Tabellen som er assosiert med denen modellen.
         *
         * @var string
         */
        protected $table = 'dates';
}

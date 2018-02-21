<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /*Skru av timestamps*/
    public $timestamps = false;

    /**
     * Tabellen som er assosiert med denen modellen.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * Primærnøkkelen som er definert i databasen for denne tabellen.
     *
     * @var array
     */
    protected $primaryKey = ['group_number', 'year'];

    /**
     * Deaktiverer automatisk økning av primærnøkkel.
     *
     * @var bool
     */
    public $incrementing = false;
}

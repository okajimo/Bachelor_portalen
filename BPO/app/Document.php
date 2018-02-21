<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /*Skru av timestamps*/
    public $timestamps = false;

    /**
     * Tabellen som er assosiert med denen modellen.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * Primærnøkkelen som er definert i databasen for denne tabellen.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    /**
     * Deaktiverer automatisk økning av primærnøkkel.
     *
     * @var bool
     */
    public $incrementing = true;
}

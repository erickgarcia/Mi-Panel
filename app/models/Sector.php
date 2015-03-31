<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Sector extends Eloquent {
    use SoftDeletingTrait;
    use Culpa\CreatedBy;
    use Culpa\DeletedBy;
    use Culpa\UpdatedBy;

    protected $blameable = array('created', 'updated', 'deleted');
    protected $softDelete = true;
}
Sector::observe(new Culpa\BlameableObserver);
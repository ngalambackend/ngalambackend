<?php
namespace App\Traits;

use Ramsey\Uuid\Uuid as Generator;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
/**
 * @author oimtrust
 * @copyright oimtrust
 */
trait Uuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = Generator::uuid4()->toString();
            } catch (InvalidUuidStringException $e) {
                // report($e);
                abort(500, $e->getMessage());
            }
        });
    }

    /**
     * @return boolean
     */
    public function getIncrementing()
    {
        return false;
    }
}

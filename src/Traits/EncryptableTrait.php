<?php

namespace Fundamental\Encryptable;

use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

trait EncryptableTrait
{
    public function setAttribute($attribute, $val)
    {
        if (
            ($this->encryptAll and !$this->shouldSkip($attribute))
            or $this->shouldEncrypt($attribute)
        ) {
            $val = $this->encrypt($val);
        }

        parent::setAttribute($attribute, $val);
    }

    public function getAttributeValue($attribute)
    {
        $val = $this->getAttributeFromArray($attribute);

        if ($this->shouldEncrypt) {
            $val = $this->decrypt($val);
        }

        if ($this->hasMutator($attribute)) {
            return $this->mutateAttribute($attribute, $val);
        }

        if ($this->hasCast($attribute)) {
            $cast = $this->getCasts()[$attribute];

            if (!is_null($val) and ($cast == 'date' or $cast == 'datetime' or in_array($attribute, $this->getDates))) {
                if ($cast == 'date') {
                    return $this->asDate($val);
                }

                return $this->asDateTime($val);
            }

            return $this->castAttribute($attribute, $val);
        }

        return $val;
    }

    public function shouldEncrypt($attribute)
    {
        return in_array($attribute, $this->encryption);
    }

    public function shouldSkip($attribute)
    {
        return in_array($attribute, $this->skipEncryption) and (!in_array($attribute, [$this->primaryKey, 'created_at', 'updated_at', 'deleted_at']));
    }

    private function encrypt($data)
    {
        try {
            $val = Crypt::encrypt($data);
        } catch (Exception $e) {
            throw new Exception('EncryptException: ' . $e->getMessage());
        }

        return $val;
    }

    private function decrypt($data)
    {
        try {
            $val = Crypt::decrypt($data);
        } catch (Exception $e) {
            throw new Exception('DecryptException: ' . $e->getMessage());
        }

        return $val;
    }
}
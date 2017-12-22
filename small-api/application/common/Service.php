<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\Validate;

class Service
{
    /**
     * @var array
     */
    protected $param;

    /**
     * @var string
     */
    protected $error;

    /**
     * Service constructor.
     * @param array $param
     * @param Validate|null $validate
     */
    public function __construct(array $param = [], Validate $validate = null)
    {
        $this->param = $param;
        if (is_null($validate) || !$validate->check($this->param)) {
            $this->error = $validate->getError();
        }
    }

}
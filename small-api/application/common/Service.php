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
     * @var number
     */
    protected $code;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * Service constructor.
     */
    public function __construct()
    {
    }

    /**
     * 数据验证
     * @param array $param
     * @param Validate|null $validate
     * @return $this
     */
    public function validate(array $param = [], Validate $validate = null)
    {
        $this->param = $param;
        if (is_null($validate) || !$validate->check($this->param)) {
            $this->error = $validate->getError();
        }

        return $this;
    }

    protected function returnData(): array
    {
        return [
            'code' => $this->code,
            'error' => $this->error,
            'data' => $this->data,
        ];
    }
}
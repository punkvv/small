<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\Validate;

class VService
{
    /**
     * 返回描述信息
     * @var string
     */
    protected $message;

    /**
     * 全局 code
     * @var number
     */
    protected $code;

    /**
     * 返回数据
     * @var mixed
     */
    protected $data;

    /**
     * 描述状态
     * @var number
     */
    protected $status;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        $this->code = HttpCode::$success;
        $this->status = 1;
    }

    /**
     * 数据验证
     * @param array $param
     * @param Validate|null $validate
     * @param string $scene 验证场景
     * @return bool
     */
    protected function validate(array $param = [], Validate $validate = null, $scene = '')
    {
        if ($scene) {
            $validate->scene($scene);
        }
        $isCheck = $validate->check($param);
        if (!$isCheck) {
            $this->message = $validate->getError();
            $this->status = 0;
        }

        return $isCheck;
    }

    protected function result(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'status' => $this->status,
            'data' => $this->data,
        ];
    }
}
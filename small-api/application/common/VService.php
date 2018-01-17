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
     * 返回标识
     * @var string
     */
    protected $name;

    /**
     * http code
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
        $this->code = HttpCode::$ok;
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
            $this->name = 'FIELD_TYPE_MISMATCH';
            $this->code = HttpCode::$unprocesableEntity;
        }

        return $isCheck;
    }

    protected function result()
    {
        $data = [];
        if (isset($this->message)) {
            $data['message'] = $this->message;
        }
        if (isset($this->name)) {
            $data['name'] = $this->name;
        }
        if (isset($this->status)) {
            $data['status'] = $this->status;
        }
        $data['code'] = $this->code;
        if (is_array($this->data)) {
            $data = array_merge($data, $this->data);
        } else {
            $data['data'] = $this->data;
        }

        return $data;
    }

}
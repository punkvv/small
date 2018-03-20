<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

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
        $this->code = VCode::$ok;
    }

    protected function result()
    {
        if (isset($this->message)) {
            $this->data['message'] = $this->message;
        }
        if (isset($this->name)) {
            $this->data['name'] = $this->name;
        }
        if (isset($this->status)) {
            $this->data['status'] = $this->status;
        }
        $this->data['code'] = $this->code;

        return $this->data;
    }

}
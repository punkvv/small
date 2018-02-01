<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use app\common\util\token\Token;
use think\Controller;
use think\exception\HttpResponseException;
use think\facade\Response;

class VController extends Controller
{

    /**
     * 请求参数
     * @var array
     */
    protected $param;

    /**
     * token
     * @var
     */
    protected $token;

    /**
     * token 存储的值
     * @var
     */
    protected $info;

    /**
     * 初始化
     */
    protected function initialize()
    {
        $this->param = $this->request->param();
        $this->setToken();
    }

    /**
     * 返回 restful
     * @param $data
     * @param string $type
     * @param array $header
     */
    public function restful($data, $type = 'json', $header = [])
    {
        $response = Response::create($data, $type)->header($header);

        throw new HttpResponseException($response);
    }

    public function setToken()
    {
        $header = $this->request->header();
        $token = empty($header['authorization']) ? '' : substr($header['authorization'], 7);
        $this->token = $token;
    }

    /**
     * 获取后台用户id
     * @param int $adminId
     * @return mixed
     */
    public function adminId($adminId = 0)
    {
        $info = $this->getTokenInfo();
        if (!isset($info['admin_id']) || $adminId && $adminId != $info['admin_id']) {
            $data['code'] = HttpCode::$unauthorized;
            $data['name'] = 'TOKEN_FAIL';
            $data['message'] = 'Not Authored';
            $this->restful($data);
        }
        $adminId = $info['admin_id'];

        return $adminId;
    }

    public function userId($userId = 0)
    {
        $info = $this->getTokenInfo();
        if (!isset($info['user_id']) || $userId && $userId != $info['user_id']) {
            $data['code'] = HttpCode::$unauthorized;
            $data['name'] = 'TOKEN_FAIL';
            $data['message'] = 'Not Authored';
            $this->restful($data);
        }
        $userId = $info['user_id'];

        return $userId;
    }

    public function getTokenInfo()
    {
        if (!$this->info) {
            $this->checkToken();
        }

        return $this->info;
    }

    public function checkToken()
    {
        $message = '';
        $info = [];
        if (empty($this->token)) {
            $message = 'Token 不能为空';
        } else {
            try {
                $info = Token::get($this->token);
            } catch (\Exception $e) {
                $message = 'Token 无效';
            }
        }
        if (!empty($message)) {
            $data['code'] = HttpCode::$unauthorized;
            $data['name'] = 'TOKEN_FAIL';
            $data['message'] = $message;
            $this->restful($data);
        } else {
            $this->info = $info;
        }
    }

}


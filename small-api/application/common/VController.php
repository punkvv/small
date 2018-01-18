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

    public function adminId()
    {
        $info = $this->getTokenInfo();
        if (!isset($info['admin_id'])) {
            $data['code'] = HttpCode::$unauthorized;
            $data['name'] = 'TOKEN_FAIL';
            $data['message'] = 'Token 异常';
            $this->restful($data);
        }

        return $info['admin_id'];
    }

    public function userId($userId)
    {
        $info = $this->getTokenInfo();
        if (!isset($info['user_id'])) {
            $data['code'] = HttpCode::$unauthorized;
            $data['name'] = 'TOKEN_FAIL';
            $data['message'] = 'Token 异常';
            $this->restful($data);
        } elseif ($info['user_id'] != $userId) {
            $data['code'] = HttpCode::$unauthorized;
            $data['name'] = 'UNAUTHORIZED';
            $data['message'] = '未登录';
            $this->restful($data);
        }

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
        $info = Token::get($this->token);
        if (!$info) {
            $data['code'] = HttpCode::$unauthorized;
            $data['name'] = 'TOKEN_FAIL';
            $data['message'] = '登录已过期';
            $this->restful($data);
        } else {
            $this->info = $info;
        }
    }

}


<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\HttpCode;
use app\common\VService;
use think\facade\Env;

class UploadService extends VService
{
    public function imageLocal()
    {
        $request = request();
        $file = $request->file('file');
        $path = config('upload.image_local');
        $info = $file->validate([
            'size' => 5 * 1024 * 1024,
            'ext' => 'jpg,png,gif',
        ])->move(Env::get('root_path').'public'.$path);
        if ($info) {
            $saveName = '//'.$request->host().$path.'/'.$info->getSaveName();
            $this->data['url'] = $saveName;
        } else {
            $this->message = $file->getError();
            $this->name = 'UPLOAD_FAILED';
            $this->code = HttpCode::$invalidRequest;
        }

        return $this->result();
    }
}
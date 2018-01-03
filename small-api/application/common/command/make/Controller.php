<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\command\make;

use think\console\command\Make;

class Controller extends Make
{
    protected $type = "Controller";

    protected function configure()
    {
        parent::configure();
        $this->setName('make:vcontroller')
            ->setDescription('Create a new resource controller class');
    }


    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

}
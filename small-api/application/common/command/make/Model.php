<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\command\make;

use think\console\command\Make;

class Model extends Make
{

    protected $type = "Model";

    protected function configure()
    {
        parent::configure();
        $this->setName('make:v-model')
            ->setDescription('Create a new model class');
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }
}
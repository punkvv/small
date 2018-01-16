<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\util;

use think\Collection;

class Paginate
{
    /** @var Collection 数据集 */
    protected $items;

    /** @var integer|null 数据总数 */
    protected $total;

    public function __construct(array $items, int $total)
    {
        $this->items = $items;
        $this->total = $total;
    }

    public function toArray()
    {

        return [
            'total' => intval($this->total()),
            'items' => $this->items->toArray(),
        ];
    }

    public function total()
    {
        return $this->total;
    }

}
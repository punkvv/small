<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\util;

class Paginate
{
    protected $items;

    protected $total;

    protected $page;

    protected $limit;

    public function __construct($items, int $total, int $page, int $limit)
    {
        $this->items = $items;
        $this->total = $total;
        $this->page = $page;
        $this->limit = $limit;
    }

    public function toArray()
    {

        return [
            'total' => intval($this->total()),
            'page' => intval($this->page()),
            'per_page' => intval($this->limit()),
            'items' => $this->items,
        ];
    }

    public function total()
    {
        return $this->total;
    }

    public function page()
    {
        return $this->page;
    }

    public function limit()
    {
        return $this->limit;
    }

}
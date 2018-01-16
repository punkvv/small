<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use app\common\util\Paginate;
use think\Model;

class VModel extends Model
{
    protected function nativePaginate(
        string $select,
        string $sqlExceptSelect,
        int $pageNumber = 1,
        int $pageSize = 20,
        array $bind = []
    ) {
        if ($pageNumber < 1 || $pageSize < 1) {
            return false;
        }
        $totalRowSql = 'SELECT COUNT(*) '.static::replaceOrderBy($sqlExceptSelect);
        $result = $this->query($totalRowSql, $bind);
        $size = count($result);
        $isGroupBySql = $size > 1;
        $totalRow = null;
        if ($isGroupBySql) {
            $totalRow = $size;
        } else {
            $totalRow = ($size > 0) ? current($result[0]) : 0;
        }

        if ($totalRow == 0) {
            $paginate = new Paginate([], 0);

            return $paginate->toArray();
        }

        $totalPage = intval($totalRow / $pageSize);
        if ($totalRow % $pageSize != 0) {
            $totalPage++;
        }
        if ($pageNumber > $totalPage) {
            $paginate = new Paginate([], $totalRow);

            return $paginate->toArray();
        }

        $findSql = $select.' '.$sqlExceptSelect;
        $sql = $this->mysqlForPaginate($pageNumber, $pageSize, $findSql);
        $items = $this->query($sql, $bind);
        $paginate = new Paginate($items, $totalRow);

        return $paginate->toArray();
    }

    protected function like(string $str): string
    {
        return '%'.$str.'%';
    }

    private function mysqlForPaginate(int $pageNumber, int $pageSize, string $findSql): string
    {
        $offset = $pageSize * ($pageNumber - 1);

        return $findSql.' LIMIT '.intval($offset).', '.intval($pageSize);
    }

    private function srvForPaginate(int $pageNumber, int $pageSize, string $findSql): string
    {
        $end = $pageNumber * $pageSize;
        if ($end <= 0) {
            $end = $pageSize;
        }
        $begin = ($pageNumber - 1) * $pageSize;
        if ($begin < 0) {
            $begin = 0;
        }

        return 'SELECT * FROM ( SELECT row_number() over (order by tempcolumn) temprownumber, * FROM ( SELECT TOP '.$end.' tempcolumn=0,'.$findSql.')vip)mvp where temprownumber>'.$begin;
    }

    private function replaceOrderBy(string $sqlExceptSelect): string
    {
        $str = preg_replace('/order\s+by\s+[^,\s]+(\s+asc|\s+desc)?(\s*,\s*[^,\s]+(\s+asc|\s+desc)?)*/im', '',
            $sqlExceptSelect);

        return $str;
    }
}
<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use app\common\util\Paginate;
use think\db\Query;
use think\facade\Config;
use think\Model;

class VModel extends Model
{
    protected function nativePaginate(
        string $select,
        string $sqlExceptSelect,
        array $gen = [],
        array $bind = []
    ) {
        $page = $this->getPage($gen);
        unset($gen);
        $pageNumber = $page['page'];
        $pageSize = $page['per_page'];
        if ($pageNumber < 1 || $pageSize < 1) {
            $paginate = new Paginate([], 0, $pageNumber, $pageSize);

            return $paginate->toArray();
        }
        $totalRowSql = 'SELECT COUNT(*) '.$this->replaceOrderBy($sqlExceptSelect);
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
            $paginate = new Paginate([], 0, $pageNumber, $pageSize);

            return $paginate->toArray();
        }

        $totalPage = intval($totalRow / $pageSize);
        if ($totalRow % $pageSize != 0) {
            $totalPage++;
        }
        if ($pageNumber > $totalPage) {
            $paginate = new Paginate([], $totalRow, $pageNumber, $pageSize);

            return $paginate->toArray();
        }

        $findSql = $select.' '.$sqlExceptSelect;
        $sql = $this->forPaginate($pageNumber, $pageSize, $findSql);
        $items = $this->query($sql, $bind);
        $paginate = new Paginate($items, $totalRow, $pageNumber, $pageSize);

        return $paginate->toArray();
    }

    protected function queryPaginate(Query $query, array $gen = [])
    {
        $sql = $query->fetchSql(true)->select();
        $i = strpos($sql, 'FROM');
        $select = substr($sql, 0, $i);
        $from = substr($sql, $i);

        return $this->nativePaginate($select, $from, $gen);
    }

    protected function getPage(array $param)
    {
        $pageNumber = empty($param['page']) ? 1 : $param['page'];
        $pageSize = empty($param['per_page']) ? 100000000 : $param['per_page'];
        unset($param);

        return [
            'page' => intval($pageNumber),
            'per_page' => intval($pageSize),
        ];
    }

    private function forPaginate(int $pageNumber, int $pageSize, string $findSql): string
    {
        $type = Config::get('database.type');
        $str = '';
        if ($type === 'mysql') {
            $offset = $pageSize * ($pageNumber - 1);
            $str = $findSql.' LIMIT '.intval($offset).', '.intval($pageSize);
        } elseif ($type === 'sqlsrv') {
            $end = $pageNumber * $pageSize;
            if ($end <= 0) {
                $end = $pageSize;
            }
            $begin = ($pageNumber - 1) * $pageSize;
            if ($begin < 0) {
                $begin = 0;
            }
            $str = 'SELECT * FROM ( SELECT row_number() over (order by tempcolumn) temprownumber, * FROM ( SELECT TOP '.$end.' tempcolumn=0,'.$findSql.')vip)mvp where temprownumber>'.$begin;
        }

        return $str;
    }

    private function replaceOrderBy(string $sqlExceptSelect): string
    {
        $str = preg_replace('/order\s+by\s+[^,\s]+(\s+asc|\s+desc)?(\s*,\s*[^,\s]+(\s+asc|\s+desc)?)*/im', '',
            $sqlExceptSelect);

        return $str;
    }

    public function falseDelete($id)
    {
        return $this->changeFiledByPk($id, 'is_del', 0);
    }

    public function changeStatus($id, $status)
    {
        $status = $status == 1 ? 1 : 2;

        return $this->changeFiledByPk($id, 'status', $status);
    }

    protected function changeFiledByPk($id, $filed, $value)
    {
        return $this->where($this->getPk(), $id)->setField($filed, $value);
    }
}
<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\util;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use think\facade\Env;

class Excel
{
    public static function xls($data = [], $title = [])
    {
        if (empty($data)) {
            return false;
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $webPath = config('upload.excel_download');
        $path = Env::get('root_path').'public'.$webPath;
        $name = File::buildSaveName($path).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($path.'/'.$name);
        $saveName = '//'.request()->host().$webPath.'/'.$name;

        return $saveName;
    }
}
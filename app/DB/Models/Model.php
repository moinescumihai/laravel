<?php namespace App\DB\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\DB;

abstract class Model extends BaseModel {

    protected static $queryFields;
    protected static $queryNum;
    protected static $queryTotal;
    protected static $commonTableQuery;
    private static $commonFilters;

    /**
     *  To be implemented
     */
    protected static function fetchByFilters($data){}

    protected static function fetchByFiltersResponse($data){
        $condition = ' AND (';
        foreach ($data['columns'] as $column){
            $condition .= $column['searchable']=='true' ? $column['name'].' LIKE "%'.$data['search']['value'].'%" OR ': '';
        }
        return [
            'data'  =>  DB::select( self::$queryFields.' '.
                                    self::$commonTableQuery.' '.
                                    str_replace('OR )', ' ) ', $condition.=')').
                                    ' ORDER BY '.$data['columns'][$data['order'][0]['column']]['name'].' '.$data['order'][0]['dir'].
                                    ' LIMIT '.$data['start'].','.$data['length']),
            'num'   =>  (int) DB::select(self::$queryNum.self::$commonFilters)[0]->cnt,
            'total' =>  (int) DB::select(self::$queryTotal)[0]->total
        ]; 
    }


}

<?php

namespace App\Models;
use Auth;

trait CommonTrait
{
    /**
     * Details:
     * @param int $limit
     * @param int $offset
     * @param array $search
     * @param array $where
     * @param array $with
     * @return array
     * @Author: Md. Abdullah <abdullah@abdullah001rti@gmail.com>
     * @Date: 29/06/2022
     * @Time: 07:08 AM
     */

    public function getDataForDataTable($limit = 20, $offset = 0, $search = [], $where = [], $with = []){

        $totalData = $this::query();
        $filterData = $this::query();
		$totalCount = $this::query();

        if(count($where) > 0){
            foreach ($where as $keyW => $valueW) {
                $keyW = str_replace(' and', '', $keyW);
                $totalData->where($keyW, $valueW);
                $filterData->where($keyW, $valueW);
                $totalCount->where($keyW, $valueW);
			}
        }


        if($limit > 0){
            $totalData->limit($limit)->offset($offset);
        }
        
        if(count($with) > 0){
            foreach ($with as $w) {
                $totalData->with($w);
            }
        }

        if(count($search) > 0){
            $totalData->where(function($totalData) use($search) {
				foreach ($search as $keyS => $valueS) {
					if(strpos($keyS, ' and') === false){
						$totalData->orWhere($keyS, 'like', "%$valueS%");
					}
					else{
						$keyS = str_replace(' and', '', $keyS);
						$totalData->where($keyS, $valueS);
					}
				}
			});

			$filterData->where(function($filterData) use($search) {
				foreach ($search as $keyS => $valueS) {
					$filterData->orWhere($keyS, 'like', "%$valueS%");
				}
			});
        }

		$totalData->orderBy($this->getTable() . '.id', 'DESC');

        return [
            'data' => $totalData->get(),
            'draw'      => request()->input('draw'),
            'recordsTotal'  => $totalCount->count(),
            'recordsFiltered'   => $filterData->count(),
        ];
    }

}

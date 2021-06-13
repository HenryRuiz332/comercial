<?php


	
	namespace App\Traits;
	use Illuminate\Pagination\LengthAwarePaginator ;
	use Illuminate\Support\Arr;
	
	trait Paginate {


		public static function createPaginator($request,$items,$perPage){
	        $perPage = 1000000;
	        $currentPage = LengthAwarePaginator::resolveCurrentPage();
	        $perPage = $perPage;

	        $items = array_reverse( Arr::sort($items , function ($value) {
	            return $value['created_at'];
	        }));
	        $currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);

	        $itemsPaginated = new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage,[
	            'path' => $request->url(),
	            'pageName' => 'page',
	        ]);
	        return $itemsPaginated;

	    }
	}
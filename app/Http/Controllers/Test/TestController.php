<?php
namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function select()
    {
        return view('test.select');
    }

    public function sortable(Request $request)
    {
        // 본사만 특정 매장의 정보를 확인할 수 있다.
        // $store = $this->getStoreData();
        // $isHeadquarter = $this->getIsHeadquarter();
        // $headquarter = $this->getHeadquarterData();

        // 매장 id (본사이면 선택한 매장 없으면 본사 매장, 아니면 로그인한 매장)
        // $storeId = $isHeadquarter ? ($request->store_id ?? $headquarter->id) : $store->id;

        // 기준 매장
        // $currentStore = Store::find($storeId, ['id', 'type']);

        // 상품 분류
        // $categories = $this->getCategoryList($request);

        $sortOptions = [
            'device_displays.seq:asc' => '정렬: 순서',
            'categories.name:asc' => '정렬: 분류명',
            'categories.id:desc' => '정렬: 등록일(최근 순)',
            'categories.id:asc' => '정렬: 등록일(오래된 순)',
        ];

        // 검색 파라미터 쿠키 생성
        // configSearchParam($request);

        // 스크립트 파일 전달용
        $initParams = [
            'request' => [
                'search' => $request->search,
                'sort' => $request->sort,
                // 'page' => $request->page
            ],
            'store' => 3, // 현재 선택된 매장
            // 'categories' => $categories
        ];

        return view('test.sortable');
    }
}

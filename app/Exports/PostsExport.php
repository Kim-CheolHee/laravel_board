<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostsExport implements FromCollection
{
    private $bulletinBoardId;

    public function __construct(int $bulletinBoardId)
    {
        $this->bulletinBoardId = $bulletinBoardId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::where('bulletin_board_id', $this->bulletinBoardId)->get();
    }
}

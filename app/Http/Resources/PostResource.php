<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PostResource",
 *     type="object",
 *     @OA\Property(
 *         property="user_id",
 *         type="int"
 *     ),
 *     @OA\Property(
 *         property="bulletin_board_id",
 *         type="int"
 *     ),
 *    @OA\Property(
 *         property="title",
 *         type="string"
 *     ),
 *    @OA\Property(
 *         property="content",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="published_at",
 *         type="string",
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="Created_at",
 *         type="string",
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time"
 *     )
 * )
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'bulletin_board_id' => $this->bulletin_board_id,
            'title' => $this->title,
            'content' => $this->content,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

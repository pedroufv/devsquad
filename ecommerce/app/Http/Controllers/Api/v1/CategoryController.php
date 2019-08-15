<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     *  @OA\Get(
     *      tags={"categories"},
     *      summary="get all categories",
     *      description="get all categories on database",
     *      path="/categories",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="search",
     *          in="query",
     *          description="search results using key:value",
     *          @OA\Schema(type="string"),
     *          style="form"
     *      ),
     *      @OA\Parameter(
     *          name="searchJoin",
     *          in="query",
     *          description="use AND or OR",
     *          @OA\Schema(type="string"),
     *          style="form"
     *      ),
     *      @OA\Parameter(
     *          name="orderBy",
     *          in="query",
     *          description="order results by",
     *          @OA\Schema(type="string"),
     *          style="form"
     *      ),
     *      @OA\Parameter(
     *          name="sortedBy",
     *          in="query",
     *          description="use ASC or DESC",
     *          @OA\Schema(type="string"),
     *          style="form"
     *      ),
     *      @OA\Parameter(
     *          name="with",
     *          in="query",
     *          description="get relationship",
     *          @OA\Schema(type="string"),
     *          style="form"
     *      ),
     *      @OA\Response(
     *          response="200", description="List of categories"
     *      )
     *  )
     */
    public function index()
    {
        return response()->json($this->repository->all());
    }
}

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

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     *  @OA\Get(
     *      tags={"users"},
     *      summary="get all user",
     *      description="get all user on database and paginate then",
     *      path="/users",
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
     *      @OA\Response(
     *          response="200", description="List of users"
     *      )
     *  )
     */
    public function index()
    {
        return $this->repository->paginate();
    }

    /**
     *  @OA\Post(
     *      tags={"users"},
     *      summary="store a user",
     *      description="store a new user on database",
     *      path="/users",
     *      security={{"bearerAuth": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="201", description="New user created"
     *      )
     *  )
     */
    public function store()
    {
        return $this->repository->create(request()->all());
    }
}

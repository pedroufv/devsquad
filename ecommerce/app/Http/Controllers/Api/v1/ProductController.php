<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\Interfaces\ProductRepository;

/**
 * Class ProductController.
 *
 * @package namespace App\Http\Controllers\Api;
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * ProductController constructor.
     *
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     *  @OA\Get(
     *      tags={"products"},
     *      summary="get all products",
     *      description="get all products paginate on database",
     *      path="/products",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="search",
     *          in="query",
     *          description="search results using key:value",
     *          @OA\Schema(type="string"),
     *          style="form"
     *      ),
     *      @OA\Response(
     *          response="200", description="List of products"
     *      )
     *  )
     */
    public function index()
    {
        return $this->repository->paginate(10);
    }

    /**
     *  @OA\Post(
     *      tags={"products"},
     *      summary="store a product",
     *      description="store a new product on database",
     *      path="/products",
     *      security={{"bearerAuth": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="price", type="string"),
     *              @OA\Property(property="image", type="string"),
     *              @OA\Property(property="category_id", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="201", description="New product created"
     *      )
     *  )
     */
    public function store(ProductCreateRequest $request)
    {
        try {

            $product = $this->repository->create($request->all());

            $response = [
                'message' => 'Product created.',
                'data'    => $product->toArray(),
            ];

            return response()->json($response, 201);

        } catch (\Exception $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     *  @OA\Get(
     *      tags={"products"},
     *      summary="show a product",
     *      description="show product",
     *      path="/products/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          description="ID of product",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200", description="New product created"
     *      )
     *  )
     */
    public function show($id)
    {
        $product = $this->repository->find($id);

        return response()->json(['data' => $product]);
    }

    /**
     *  @OA\Put(
     *      tags={"products"},
     *      summary="update a product",
     *      description="update a product on database",
     *      path="/products/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          description="ID of product",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="price", type="string"),
     *              @OA\Property(property="image", type="string"),
     *              @OA\Property(property="category_id", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="201", description="Product updated"
     *      )
     *  )
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {

            $product = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Product updated.',
                'data'    => $product->toArray(),
            ];

            return response()->json($response);
        } catch (\Exception $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessage()
            ]);
        }
    }


    /**
     *  @OA\Delete(
     *      tags={"products"},
     *      summary="remove a product",
     *      description="remove a product on database",
     *      path="/products/{id}",
     *      @OA\Parameter(
     *          description="ID of product",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response="200", description="Product deleted"
     *      )
     *  )
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'Product deleted.',
            'deleted' => $deleted,
        ]);
    }
}

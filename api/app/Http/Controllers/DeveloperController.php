<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDeveloperRequest;
use App\Http\Requests\SearchDeveloperRequest;
use App\Services\DeveloperService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeveloperController extends Controller
{
    private DeveloperService $service;

    /**
     * DeveloperController constructor.
     * @param DeveloperService $service
     */
    public function __construct(DeveloperService $service)
    {
        $this->service = $service;
    }

    public function get(Request $request)
    {
        try {
            $result = $this->service->getById((int)$request->id);
            return new JsonResource($result);
        } catch (HttpException $e) {
            $data = [
                'message' => $e->getMessage()
            ];

            return new JsonResponse($data, $e->getStatusCode());
        }
    }

    public function create(SaveDeveloperRequest $request)
    {
        try {
            $result = $this->service->create($request->all());
            return new JsonResponse($result, Response::HTTP_CREATED);
        } catch (HttpException $e) {
            $data = [
                'message' => $e->getMessage()
            ];

            return new JsonResponse($data, $e->getStatusCode());
        }
    }

    public function update(SaveDeveloperRequest $request)
    {
        try {
            $result = $this->service->update($request->all(),(int)$request->id);
            return new JsonResponse($result, Response::HTTP_OK);
        } catch (HttpException $e) {
            $data = [
                'message' => $e->getMessage()
            ];

            return new JsonResponse($data, $e->getStatusCode());
        }
    }

    public function remove(Request $request)
    {
        try {
            $result = $this->service->remove((int)$request->id);
            return new JsonResponse($result, Response::HTTP_NO_CONTENT);
        } catch (HttpException $e) {
            $data = [
                'message' => $e->getMessage()
            ];

            return new JsonResponse($data, $e->getStatusCode());
        }
    }

    public function search(SearchDeveloperRequest $request)
    {
        try {
            $result = $this->service->search($request->all());
            return new JsonResource($result);
        } catch (HttpException $e) {
            $data = [
                'message' => $e->getMessage()
            ];

            return new JsonResponse($data, $e->getStatusCode());
        }
    }
}
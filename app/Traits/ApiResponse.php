<?php


namespace App\Traits;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Contracts\Pagination\Paginator;

trait ApiResponse
{


    public function __construct()
    {

    }

    public function default($content = [], $location = null)
    {
        $rtn      = [
            'status' => true,
            'data'   => [],
            'msg'    => '',
        ];
        $rtn      = array_merge($rtn, $content);
        $response = new Response($rtn);

        // 201
        $response->setStatusCode(Response::HTTP_CREATED);
        if (!is_null($location)) {
            $response->header('Location', $location);
        }

        return $response;
    }

    /**
     * 响应创建的响应并关联位置（如果提供）。
     * Respond with a created response and associate a location if provided.
     *
     * @param null $content 响应数据
     * @param null|string $location 重定向
     * @return Response
     */
    public function created($content = null, $location = null)
    {
        $response = new Response($content);
        // 201
        $response->setStatusCode(Response::HTTP_CREATED);
        if (!is_null($location)) {
            $response->header('Location', $location);
        }
        return $response;
    }

    public function error($message = '', $statusCode = Response::HTTP_BAD_REQUEST)
    {
        throw new HttpException($statusCode, $message);
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}

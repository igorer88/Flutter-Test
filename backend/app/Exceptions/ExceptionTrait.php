<?php
namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait {

    public function apiExceptions($request, $e){

        if($this->isModel($e)){

            return $this->ModelResponse($e);
        }

        if($this->isHttp($e)){

            return$this->HttpResponse($e);
        }
        return parent::render($request, $e);
    }

    protected function isModel($e){
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e){
        return $e instanceof NotFoundHttpException;
    }

    protected function ModelResponse($e){
        return response()->json([
            "errors" => 'Product model not found'
        ],Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse($e){
        return response()->json([
            "errors" => 'Incorrect route'
        ],Response::HTTP_NOT_FOUND);
    }


}

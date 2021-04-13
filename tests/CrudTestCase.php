<?php

namespace Tests;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\utilities\Traits\AttachJwtToken;
use Tests\utilities\Traits\AuthTestTrait;

abstract class CrudTestCase extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use AuthTestTrait;
    use AttachJwtToken;


    protected $seed = true;

    protected $base_route = null;
    protected $base_model = null;

    public function multipleDelete($model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.destroyAll" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model, [], 5);

        $ids = $model->map(function ($item, $key) {
            return $item->id;
        });

        return $this->deleteJson(route($route), ['ids' => $ids]);
    }


    protected function setBaseRoute($route)
    {
        $this->base_route = $route;
    }

    protected function setBaseModel($model)
    {
        $this->base_model = $model;
    }

    protected function viewSuccessful($route = '')
    {
        $route = $this->base_route ? "{$this->base_route}.show" : $route;

        return $this->get(route($route), $this->attachToken([]))->assertSuccessful();
    }


    protected function createSuccessful($attributes = [], $model = '', $route = '')
    {
        $route = $this->base_route ? "{$this->base_route}.store" : $route;
        $model = $this->base_model ?? $model;

        $attributes = raw($model, $attributes);

        $response = $this->postJson(route($route), $attributes, $this->attachToken([]))->assertSuccessful();

        $model = new $model;

        $this->assertDatabaseHas($model->getTable(), $attributes);

        return $response;
    }

    protected function createForbidden($attributes = [], $model = '', $route = '')
    {
        $route = $this->base_route ? "{$this->base_route}.store" : $route;
        $model = $this->base_model ?? $model;

        $attributes = raw($model, $attributes);

        return $this->postJson(route($route), $attributes, $this->attachToken([]))->assertForbidden();
    }

    protected function updateSuccessful($attributes = [], $model = '', $route = '')
    {
        $route = $this->base_route ? "{$this->base_route}.update" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model);

        if (!auth()->user()) {
            $this->expectException(AuthenticationException::class);
        }

        $response = $this->patchJson(route($route, $model->id), $attributes, $this->attachToken([]))->assertSuccessful();

        tap($model->fresh(), function ($model) use ($attributes) {
            collect($attributes)->each(function ($value, $key) use ($model) {
                $this->assertEquals($value, $model[$key]);
            });
        });

        return $response;
    }

    protected function updateForbidden($attributes = [], $model = '', $route = '')
    {
        $route = $this->base_route ? "{$this->base_route}.update" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model);

        if (!auth()->user()) {
            $this->expectException(AuthenticationException::class);
        }

        $response = $this->patchJson(route($route, $model->id), $attributes, $this->attachToken([]))->assertForbidden();

        tap($model->fresh(), function ($model) use ($attributes) {
            collect($attributes)->each(function ($value, $key) use ($model) {
                $this->assertEquals($value, $model[$key]);
            });
        });

        return $response;
    }

    protected function removeSuccessful($model = '', $route = '')
    {

        $route = $this->base_route ? "{$this->base_route}.destroy" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model);

        $response = $this->deleteJson(route($route, $model->id), $this->attachToken([]));

        $this->assertDatabaseMissing($model->getTable(), $model->toArray());

        return $response;
    }

    protected function removeForbidden($model = '', $route = '')
    {
        $route = $this->base_route ? "{$this->base_route}.destroy" : $route;
        $model = $this->base_model ?? $model;
        $model = create($model);
        return $this->deleteJson(route($route, $model->id), $this->attachToken([]))->assertForbidden();
    }
}

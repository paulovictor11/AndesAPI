<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([])
    ->group(function (Router $router) {
        $router->post('login', 'AuthController@login');
        $router->post('{id}/pass', 'AuthController@updatePass');
        $router->post('refresh', 'AuthController@refresh');
        $router->post('logout', 'AuthController@logout');

        $router->name('administrador.')->group(function () use ($router) {
            $router->match(
                ['GET', 'POST'],
                '/administradores',
                'AdministradorController@index'
            )->name('index');

            $router->match(
                ['GET', 'PUT', 'DELETE'],
                'administrador/{id}',
                'AdministradorController@detail'
            )->name('detail');
        });

        $router->name('categoria.')->group(function () use ($router) {
            $router->match(
                ['GET', 'POST'],
                'categorias',
                'CategoriaController@index'
            )->name('index');

            $router->match(
                ['GET', 'PUT', 'DELETE'],
                'categoria/{id}',
                'CategoriaController@detail'
            )->name('detail');
        });

        $router->name('cliente.')->group(function () use ($router) {
            $router->match(
                ['GET', 'POST'],
                'clientes',
                'ClienteController@index'
            )->name('index');

            $router->match(
                ['GET', 'PUT', 'DELETE'],
                'cliente/{id}',
                'ClienteController@detail'
            )->name('detail');
        });

        // Compras route

        $router->name('foto.')->group(function () use ($router) {
            $router
                ->get('/fotos', 'FotoController@list')
                ->name('list');

            $router
                ->post('/fotos', 'FotoController@index')
                ->name('index');

            $router
                ->get('/foto/{id}', 'FotoController@listById')
                ->name('listById');

            $router->match(
                ['PUT', 'DELETE'],
                'foto/{id}',
                'FotoController@detail'
            )->name('detail');
        });

        $router->name('genero.')->group(function () use ($router) {
            $router->match(
                ['GET', 'POST'],
                'generos',
                'GeneroController@index'
            )->name('index');

            $router->match(
                ['GET', 'PUT', 'DELETE'],
                'genero/{id}',
                'GeneroController@detail'
            )->name('detail');
        });

        $router->name('produto.')->group(function () use ($router) {
            $router
                ->get('/produtos', 'ProdutoController@list')
                ->name('list');

            $router
                ->post('/produtos', 'ProdutoController@index')
                ->name('index');

            $router
                ->get('/produto/{id}', 'ProdutoController@listById')
                ->name('listById');

            $router->match(
                ['PUT', 'DELETE'],
                'produto/{id}',
                'ProdutoController@detail'
            )->name('detail');
        });

        $router->name('usuario.')->group(function () use ($router) {
            $router->match(
                ['GET', 'POST'],
                'usuarios',
                'UsuarioController@index'
            )->name('index');

            $router->match(
                ['GET', 'PUT', 'DELETE'],
                'usuario/{id}',
                'UsuarioController@detail'
            )->name('detail');
        });
    });

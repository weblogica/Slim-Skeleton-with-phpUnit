<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 18/12/17
 * Time: 17:53
 */

use AeroTransfers\Controllers\Clients;
use Illuminate\Database\Capsule\Manager;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Respect\Validation\Validator as Validator;

class AeroTransfersApp
{
    private $app;

    public function __construct() {
        // Instantiate the app
        $settings = require __DIR__ . '/../src/settings_dev.php';
        $app = new \Slim\App($settings);

        $container = $this->getDependencies($app);
        $this->getMiddleware($container, $app);
        $this->getRoutes($app);

        $this->app = $app;
    }

    /**
     * Get an instance of the application.
     *
     * @return \Slim\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param $app
     */
    private function getRoutes(\Slim\App $app)
    {
        
        $app->get(
            '/clients/find/{id}',
            Clients::class . ":findOne"
        );
        $app->get(
            '/clients/new/{name}',
            Clients::class . ":createNewClient"
        );

        \AeroTransfers\Routes\AuthRoutes::getRoutes($app);
        \AeroTransfers\Routes\AdminRoutes::getRoutes($app);

        $app->get(
            '/[{name}]',
            function (Request $request, Response $response, $args) {
                $response = $this->view->render(
                    $response,
                    "home.twig"
                );

                return $response;
            }
        )->setName("home");
    }

    /**
     * @param $container
     * @param $app
     */
    private function getMiddleware(\Slim\Container $container, \Slim\App $app)
    {
        // Application middleware - Register service provider
        $container['cache'] = function () {
            return new \Slim\HttpCache\CacheProvider();
        };

        // Register middleware
        $app->add(new \Slim\HttpCache\Cache('public', 0));

        // CSRF MiddleWare ( Cross-site request forgery )
        /*$container['csrf'] = function (\Slim\Container $container) {
            return new \Slim\Csrf\Guard($container);
        };
        $app->add(new \AeroTransfers\Middleware\CsrfViewMiddleware($container));*/

        // AeroTransfers Middleware
        $app->add(new \AeroTransfers\Middleware\ValidationErrorsMiddleware($container));
        $app->add(new \AeroTransfers\Middleware\OldInputMiddleware($container));
    }

    /**
     * @param $app
     * @return mixed
     */
    private function getDependencies(\Slim\App $app)
    {
        /** @var \Slim\Container $container */
        $container = $app->getContainer();

        // Database connection
        /** @var Manager $capsule */
        $capsule = new Manager();
        $capsule->addConnection($container['settings']['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $container['db'] = function ($container) use ($capsule) {
            return $capsule;
        };
        
        // view renderer
        /*$container['view'] = function ($c) {
            $settings = $c->get('settings')['renderer'];
            return new \Slim\Views\PhpRenderer($settings['template_path']);
        };*/

        $container['view'] = function ($container) {
            $settings = $container->get('settings')['renderer'];
            $view = new Twig(
                $settings['template_path'],
                ["cache" => false]);

            $view->addExtension(new TwigExtension(
               $container->router,
               $container->request->getUri()
            ));

            return $view;
        };

        // Slim Flash
        /*$container['flash'] = function ($container) {
            return new Slim\Fl
        }*/

        // Auth Class
        $container['auth'] = function ($container) {
            return new AeroTransfers\Domain\Auth\Auth();
        };
        $view = $container->get('view');
        $view->getEnvironment()->addGlobal('auth', [
            'check' => $container->auth->check(),
            'user'  => $container->auth->user()
        ]);

        $container['validator'] = function ($container) {
            return new \AeroTransfers\Validation\Validator();
        };

        Validator::with("AeroTransfers\\Validation\\Rules\\");

        // monolog
        $container['logger'] = function ($c) {
            $settings = $c->get('settings')['logger'];
            $logger   = new \Monolog\Logger($settings['name']);
            $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
            return $logger;
        };

        return $container;
    }
}
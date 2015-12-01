<?php

namespace NABVelocity;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class VelocityServiceProvider
 *
 * @package NABVelocity
 */
class VelocityServiceProvider implements ServiceProviderInterface
{
    protected $injectionList
        = array(
            'velocity.identityToken',
            'velocity.applicationProfileId',
            'velocity.merchantProfileId',
            'velocity.workflowId'
        );

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $app['velocity.processor'] = $app->share(
            function () use ($app) {
                try {
                    return new Client(
                        $app['velocity.applicationProfileId'],
                        $app['velocity.identityToken'],
                        $app['velocity.workflowId'],
                        $app['velocity.isTestAccount']
                    );
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            }
        );
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}

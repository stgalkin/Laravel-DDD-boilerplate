<?php

namespace App\Src\Users\Providers;

use App\Src\Users\Services\UserService;
use App\Src\Users\Services\UserServiceContract;
use App\Src\Users\User\Profile\ProfileContract;
use App\Src\Users\User\Profile\ProfileEntity;
use App\Src\Users\User\Repositories\UserRepositoryContract;
use App\Src\Users\User\Repositories\UserRepositoryDoctrine;
use App\Src\Users\User\UserContract;
use App\Src\Users\User\UserEntity;
use App\Src\Users\User\Mutators\DTO\Mutator as UserMutator;
use App\Src\Users\User\Profile\Mutators\DTO\Mutator as ProfileMutator;
use Illuminate\Support\ServiceProvider;

/**
 * Class UserServiceProvider
 * @package App\Src\Users\Providers
 */
class UserServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot(): void
    {
        $this->bootMigrations();
        $this->bootRoutes();
        $this->bootConfigs();
        $this->bootCommands();
        $this->bootSchedule();
    }

    /**
     * Boot migrations
     *
     * @return void
     */
    private function bootMigrations(): void
    {
        $this->loadMigrationsFrom($this->path() . 'Migrations');
    }

    /**
     * Boot routes
     *
     * @return void
     */
    private function bootRoutes(): void
    {
        $this->loadRoutesFrom($this->path() . 'Routes' . DIRECTORY_SEPARATOR . 'routes.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerEntities();
        $this->registerRepositories();
        $this->registerServices();
        $this->registerMutators();
    }

    /**
     * Register repositories
     *
     * @return void
     */
    protected function registerEntities(): void
    {
        $this->app->bind(UserContract::class, UserEntity::class);
        $this->app->bind(ProfileContract::class, ProfileEntity::class);
    }

    /**
     * Register repositories
     *
     * @return void
     */
    protected function registerRepositories(): void
    {
        $this->app->singleton(UserRepositoryContract::class, UserRepositoryDoctrine::class);
    }

    /**
     * Register services
     *
     * @return void
     */
    protected function registerServices(): void
    {
        $this->app->bind(UserServiceContract::class, UserService::class);
    }

    /**
     * Register mutators
     *
     * @return void
     */
    public function registerMutators(): void
    {
        $this->app->singleton(UserMutator::class, UserMutator::class);
        $this->app->singleton(ProfileMutator::class, ProfileMutator::class);
    }

    /**
     * Boot configs
     *
     * @return void
     */
    private function bootConfigs(): void
    {
    }

    /**
     *
     */
    private function bootCommands(): void
    {
//        $this->commands([
//        ]);
    }

    /**
     *
     */
    private function bootSchedule(): void
    {
//        $this->app->booted(function () {
//            $schedule = app(Schedule::class);
//            $schedule->command("YOUR_SIGNATURE")->everyFiveMinutes()->withoutOverlapping();
//        });
    }

    /**
     * @return string
     */
    private function path(): string
    {
        return base_path('app/src/Users/');
    }
}

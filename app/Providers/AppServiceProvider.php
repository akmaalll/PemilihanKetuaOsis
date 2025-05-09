<?php

namespace App\Providers;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\BaseContract;
use App\Http\Services\Repositories\Contracts\KetosContract;
use App\Http\Services\Repositories\Contracts\KriteriaContract;
use App\Http\Services\Repositories\Contracts\MenuContract;
use App\Http\Services\Repositories\Contracts\NilaiKetosContract;
use App\Http\Services\Repositories\Contracts\RoleContract;
use App\Http\Services\Repositories\Contracts\SawMethodContract;
use App\Http\Services\Repositories\Contracts\SettingContract;
use App\Http\Services\Repositories\Contracts\UserMenuContract;
use App\Http\Services\Repositories\Contracts\UsersContract;
use App\Http\Services\Repositories\KetosRepository;
use App\Http\Services\Repositories\KriteriaRepository;
use App\Http\Services\Repositories\MenuRepository;
use App\Http\Services\Repositories\NilaiKetosRepository;
use App\Http\Services\Repositories\RoleRepository;
use App\Http\Services\Repositories\SawMethodRepository;
use App\Http\Services\Repositories\SettingRepository;
use App\Http\Services\Repositories\UserMenuRepository;
use App\Http\Services\Repositories\UsersRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(BaseContract::class, BaseRepository::class);

        $this->app->bind(MenuContract::class, MenuRepository::class);
        $this->app->bind(RoleContract::class, RoleRepository::class);
        $this->app->bind(SettingContract::class, SettingRepository::class);
        $this->app->bind(UserMenuContract::class, UserMenuRepository::class);
        $this->app->bind(UsersContract::class, UsersRepository::class);
        $this->app->bind(KetosContract::class, KetosRepository::class);
        $this->app->bind(KriteriaContract::class, KriteriaRepository::class);
        $this->app->bind(NilaiKetosContract::class, NilaiKetosRepository::class);
        $this->app->bind(SawMethodContract::class, SawMethodRepository::class);
    }
}

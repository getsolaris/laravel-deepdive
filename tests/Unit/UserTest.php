<?php

namespace Tests\Unit;

use App\Enums\StatusEnum;
use App\Models\Scopes\ActiveStatusScope;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * Activity 가 active 인 유저 테스트
     *
     * @return void
     */
    public function test_has_active(): void
    {
        DB::enableQueryLog();

        $users1 = User::query()
            ->active()
            ->get();

        // Dynamic Scope
        $users2 = User::query()
            ->status(StatusEnum::INACTIVE->value)
            ->get();

        dump(DB::getQueryLog());

        $this->assertTrue(true);
    }

    /**
     * Global Scope
     *
     * @return void
     */
    public function test_global_scope()
    {
        DB::enableQueryLog();

        $users = User::query()
            ->get();

        dump(DB::getQueryLog());

        $this->assertTrue(true);
    }

    /**
     * Global Scope 제거
     *
     * @return void
     */
    public function test_disable_global_scope()
    {
        DB::enableQueryLog();

        $users = User::query()
            ->withoutGlobalScope(ActiveStatusScope::class)
            ->get();

        dump(DB::getQueryLog());

        $this->assertTrue(true);
    }
}

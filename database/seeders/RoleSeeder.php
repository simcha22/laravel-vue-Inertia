<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminRole();
        $this->createUserRole();
        $this->createCoachRole();
        $this->createTrainingRole();
    }

    protected function createRole(RoleName $role, Collection $permissions): void
    {
        $newRole = Role::create(['name' => $role->value]);
        $newRole->permissions()->sync($permissions);
    }

    protected function createAdminRole(): void
    {
        $permissions = Permission::query()->pluck('id');
        $this->createRole(RoleName::ADMIN, $permissions);
    }

    protected function createUserRole(): void
    {
        $permissions = Permission::query()
            ->orWhere('name', 'like', 'post.%')
            ->orWhere('name', 'like', 'comment.%')
            ->orWhere('name', 'like', 'attachment.%')
            ->orWhereIn('name', [
                'user.view',
                'user.delete',
                'user.update',
                'workout.view',
                'workout.viewAny',
                'exercise.view',
                'exercise.viewAny',
            ])
            ->pluck('id');

        $this->createRole(RoleName::USER, $permissions);
    }

    protected function createCoachRole(): void
    {
        $permissions = Permission::query()
            ->orWhere('name', 'like', 'post.%')
            ->orWhere('name', 'like', 'comment.%')
            ->orWhere('name', 'like', 'attachment.%')
            ->orWhere('name', 'like', 'workout.%')
            ->orWhere('name', 'like', 'exercise.%')
            ->orWhereIn('name', [
                'user.view',
                'user.delete',
                'user.update',
            ])
            ->pluck('id');

        $this->createRole(RoleName::COACH, $permissions);
    }

    protected function createTrainingRole(): void
    {
        $permissions = Permission::query()
            ->orWhere('name', 'like', 'post.%')
            ->orWhere('name', 'like', 'comment.%')
            ->orWhere('name', 'like', 'attachment.%')
            ->orWhereIn('name', [
                'user.view',
                'user.delete',
                'user.update',
                'workout.view',
                'workout.viewAny',
                'exercise.view',
                'exercise.viewAny',
            ])
            ->pluck('id');

        $this->createRole(RoleName::TRAINING, $permissions);
    }
}

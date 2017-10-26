<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


         $statuses = [
            ['title' => 'Ativado', 'color' => '#03662F'],
            ['title' => 'Parcial', 'color' => '#F7BC00'],
            ['title' => 'Aguardando', 'color' => '#3C5A9A'],
            ['title' => 'Recusado', 'color' => '#E10800'],                
            ['title' => 'Entregue', 'color' => '#909090'],
            ['title' => 'Despachado', 'color' => '#909090'],
        ];
        foreach ($statuses as $status) {
            DB::table('statuses')->insert($status);
        }


        $users = [
            ['name' => 'Administrador', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'remember_token' => str_random(10), 'created_at' => '2017-01-01 00:00', 'updated_at' => '2017-01-01 00:00'],
            ['name' => 'Promotor teste', 'email' => 'promotor@admin.com', 'password' => bcrypt('promotor'), 'remember_token' => str_random(10), 'created_at' => '2017-01-01 00:00', 'updated_at' => '2017-01-01 00:00'],
            ['name' => 'Cliente teste', 'email' => 'cliente@admin.com', 'password' => bcrypt('cliente'), 'remember_token' => str_random(10), 'created_at' => '2017-01-01 00:00', 'updated_at' => '2017-01-01 00:00']
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        $roles = [
            ['name' => 'administrator', 'display_name' => 'Administrator', 'description' => 'Administrator'],
            ['name' => 'promoter', 'display_name' => 'Promotor', 'description' => 'Promotor'],
            ['name' => 'client', 'display_name' => 'Cliente', 'description' => 'Cliente']
        ];
        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }

        $user_roles = [
                ['role_id' => 1, 'user_id' => 1],
                ['role_id' => 2, 'user_id' => 2],
                ['role_id' => 3, 'user_id' => 3]
        ];
        foreach ($user_roles as $user_role) {
            DB::table('role_user')->insert($user_role);
        }

        $per_basic = ['admin', 'show', 'create', 'edit', 'destroy'];
        $per_contr = ['admin', 'dashboard', 'user', 'customer', ];
        foreach ($per_contr as $c) {
            foreach ($per_basic as $b) {
                $permissions[] = [
                    'name' => $c . '-' . $b,
                    'display_name' => $c . '.' . $b,
                    'description' => $c . '.' . $b
                ];
            }
        }
        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }

        

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //$this->call([TaskSeeder::class,]);

       /* User::factory()->create([
         'name' => 'User345',
         'email' => 'User345@test.com',
        ]);*/

        $user = User::firstOrCreate(['email' => 'Useruser34@test.com'], ['name'=>'User345','password' => bcrypt('password123'),]);
        $tasks = Task::factory()->count(3)->create(['user_id' => $user->id]);

        foreach($tasks as $task){
            Note::factory()->count(3)->create(['task_id'=>$task->id,'user_id' => $task->user_id,]);
        }

    }
}

<?php

use Illuminate\Database\Seeder;
use App\Model\Task;
use App\Model\Admin;
use App\User;
use DateTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsDataSeed::class);
        //$this->call(TasksDataSeed::class);
        $this->call(UsersDataSeed::class);
    }
}


class AdminsDataSeed extends Seeder 
{
    public function run()
    {
      //  DB::table('admins')->delete();

        Admin::create(array('name'=>'Admin','email'=>'admin@gmail.com', 'password' => bcrypt(123456)));
    }
}

class UsersDataSeed extends Seeder 
{
    public function run()
    {
      //  DB::table('users')->delete();

        User::create(array('name'=>'zj','email'=>'zj@gmail.com', 'password' => bcrypt(123456)));
       // User::create(array('name'=>'hoang','email'=>'hoang@gmail.com', 'password' => bcrypt(123456)));
    }
}
class TasksDataSeed extends Seeder 
{
    public function run()
    {
        Task::create(
            array(
                'name'=>' Task new 222',
                'creater_id'=> '15',
                'creater_role'=> 'user', 
                'assigned_to_id' => '16', 
                'project_name'=>'Ship', 
                'due_date' => new DateTime(), 
                'description' => 'something', 
                'comments' => 'nothing',
                'priority' => 'High',
                'progress' => 0  
            ));
    }
}
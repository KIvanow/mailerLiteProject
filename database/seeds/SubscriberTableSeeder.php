<?
class UserTableSeeder extends Seeder {

public function run()
{
    DB::table('subscriber')->delete();

    User::create(['email' => 'foo@bar.com']);
}

}
?>
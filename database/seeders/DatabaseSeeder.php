<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'password' => Hash::make('123456')
        ]);

        DB::table('policies')->insert([
            'text' => '
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus est id
            magni perferendis provident quidem rem, repellat reprehenderit sit!
            Atque dignissimos dolor eius incidunt libero nesciunt, quaerat sapiente.
            Consequuntur, cumque deserunt ex impedit nostrum obcaecati ratione soluta
            temporibus voluptate? Aspernatur commodi cumque, debitis delectus, deserunt
            dolor doloremque dolores dolorum maiores molestiae nostrum provident quaerat
            quas qui, quia suscipit tempora tempore. A ab accusamus aliquam delectus deleniti
            doloremque earum est et excepturi fugit illo, ipsa ipsam iusto laudantium
            maxime minus nam nemo nesciunt odio omnis placeat possimus quae qui repellat
            rerum saepe similique sint soluta sunt suscipit totam veritatis vero vitae. Iure
            rem repellat similique temporibus ut? Aperiam culpa debitis dolorem dolorum
            eaque eligendi? Ad cupiditate incidunt, odio odit officia quae sed sint. Culpa
            cumque debitis ducimus explicabo, fuga impedit inventore magnam maxime minus
            natus nemo nulla, pariatur quidem quos repellat ut vel. Ab aperiam assumenda
            blanditiis cumque delectus doloribus dolorum ex fugiat ipsam iure magni minus
            nesciunt nobis nostrum nulla odio pariatur, possimus quidem quod quos, sit
            suscipit unde velit vero voluptatibus! Ab ad aperiam architecto aspernatur
            autem blanditiis, dolores dolorum explicabo, harum impedit incidunt
            inventore ipsam ipsum maxime nam nemo non optio pariatur possimus quas
            quidem quisquam ratione recusandae reiciendis reprehenderit sapiente sequi
            sit ut vero voluptatem? Ab accusantium alias aspernatur beatae enim iusto
            minima molestiae nam numquam odit omnis pariatur quaerat quas quia quo
            repellendus saepe tempore totam vel, velit. Consequuntur delectus ex r
            atione recusandae! A accusamus aliquam amet aspernatur commodi consequatur
            consequuntur, dicta dolore, doloremque doloribus ducimus eaque earum
            explicabo harum illo inventore ipsa itaque laborum magni omnis pariatur
            perspiciatis, quas quidem quo quos reiciendis rerum voluptate? Delectus
            ex excepturi ipsam molestias necessitatibus officia pariatur voluptates.
            Ab cupiditate delectus deleniti, dolores ea eveniet exercitationem fuga,
            ipsum labore laudantium natus neque officia officiis porro praesentium quae quos.
            ',
        ]);
    }
}

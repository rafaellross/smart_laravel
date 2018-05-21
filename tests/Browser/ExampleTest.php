<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\Browser\Pages\Login;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function elements()
    {
        return [
            '@username' => 'input[name=username]',
        ];
    }    

    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login);
        });

    }


}

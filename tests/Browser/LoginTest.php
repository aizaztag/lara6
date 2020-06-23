<?php
namespace App\Modules\Web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favourites;
use App\Models\User;
use Tests\DuskTestCase;
use Validator;
use Response;
use Illuminate\Http\Request;
use JWTAuth;
use DB;

/**
 * Class FavouriteController
 * @package App\Modules\Web\Controllers
 */
class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_I_can_login_successfully()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'viraj@virajkhatavkar.com')
                ->type('password', '123s123fdfd123')
                ->press('Login')
                ->assertSee('You are logged in!');
        });
    }
}
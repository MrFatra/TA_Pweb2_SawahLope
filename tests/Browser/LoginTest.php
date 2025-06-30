<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * Test login dengan kode tiket yang valid
     */
    public function testVerifiedLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth/login')
                ->waitForInput('ticket_code')
                ->type('ticket_code', 'SAWAHLOPE-1-budi-santoso-Y2OO1G')
                ->press('Login')
                ->waitForLocation('/')
                ->assertPathIs('/');
        });
    }

    /**
     * Test login dengan kode tiket yang tidak terdaftar
     */
    public function testUnverifiedLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth/login')
                ->waitForInput('ticket_code')
                ->type('ticket_code', 'ABC-123')
                ->press('Login')
                ->assertPathIs('/auth/login')
                ->assertSee('Kode tiket yang Anda berikan tidak valid.');
        });
    }

    /**
     * Test login dengan kode tiket yang kosong
     */
    public function testEmptyLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth/login')
                ->waitForInput('ticket_code')
                ->type('ticket_code', '')
                ->press('Login')
                ->assertPathIs('/auth/login')
                ->assertSee('Kode tiket tidak boleh kosong.');
        });
    }
}

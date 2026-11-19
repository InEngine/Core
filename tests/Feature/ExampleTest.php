<?php

test('splash page loads', function () {
    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('InEngine Core', false)
        ->assertSee('Built on', false)
        ->assertSee('Laravel', false)
        ->assertSee('https://github.com/InEngine/Core', false);
});

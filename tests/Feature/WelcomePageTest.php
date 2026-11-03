<?php

test('the welcome page introduces Eduleb and links to the learning platform', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Find your best way')
        ->assertSee('Explore Eduleb')
        ->assertSee(route('home'));
});

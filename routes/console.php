<?php

use Spatie\ShortSchedule\ShortSchedule;

/*
|--------------------------------------------------------------------------
| Short Schedule
|--------------------------------------------------------------------------
*/

app()->booted(function () {
    app(ShortSchedule::class)
        ->command('demo:every-second')
        ->everySecond();
});
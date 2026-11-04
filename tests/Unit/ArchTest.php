<?php

arch('App code does not extend Modulus ModuleServiceProvider')
    ->expect('App')
    ->not->toExtend('InEngine\Modulus\ModuleServiceProvider');

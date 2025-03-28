<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('plans:expire')->daily()->onOneServer();
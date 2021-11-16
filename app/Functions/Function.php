<?php

use Carbon\Carbon;

// Calculate Age
$calculateAge = fn($date) => Carbon::parse($date)->age;

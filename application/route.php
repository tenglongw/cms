<?php
\think\Route::pattern([
    'name' => '\w+',
    'id' => '\d+',
]);
\ebcms\Route::route();
return [];
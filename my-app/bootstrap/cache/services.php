<?php return array (
  'providers' => 
  array (
    0 => 'Telegram\\Bot\\Laravel\\TelegramServiceProvider',
    1 => 'Laravel\\Boost\\BoostServiceProvider',
    2 => 'Laravel\\Mcp\\Server\\McpServiceProvider',
    3 => 'Laravel\\Pail\\PailServiceProvider',
    4 => 'Laravel\\Roster\\RosterServiceProvider',
    5 => 'Laravel\\Sail\\SailServiceProvider',
    6 => 'Laravel\\Tinker\\TinkerServiceProvider',
    7 => 'Laravel\\Ui\\UiServiceProvider',
    8 => 'Larswiegers\\LaravelMaps\\LaravelMapsServiceProvider',
    9 => 'Carbon\\Laravel\\ServiceProvider',
    10 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    11 => 'Termwind\\Laravel\\TermwindServiceProvider',
    12 => 'LarsWiegers\\LaravelMaps\\LaravelMapsServiceProvider',
    13 => 'App\\Providers\\AppServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Laravel\\Boost\\BoostServiceProvider',
    1 => 'Laravel\\Mcp\\Server\\McpServiceProvider',
    2 => 'Laravel\\Pail\\PailServiceProvider',
    3 => 'Laravel\\Roster\\RosterServiceProvider',
    4 => 'Laravel\\Ui\\UiServiceProvider',
    5 => 'Larswiegers\\LaravelMaps\\LaravelMapsServiceProvider',
    6 => 'Carbon\\Laravel\\ServiceProvider',
    7 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    8 => 'Termwind\\Laravel\\TermwindServiceProvider',
    9 => 'LarsWiegers\\LaravelMaps\\LaravelMapsServiceProvider',
    10 => 'App\\Providers\\AppServiceProvider',
  ),
  'deferred' => 
  array (
    'Telegram\\Bot\\BotsManager' => 'Telegram\\Bot\\Laravel\\TelegramServiceProvider',
    'Telegram\\Bot\\Api' => 'Telegram\\Bot\\Laravel\\TelegramServiceProvider',
    'telegram' => 'Telegram\\Bot\\Laravel\\TelegramServiceProvider',
    'telegram.bot' => 'Telegram\\Bot\\Laravel\\TelegramServiceProvider',
    'Laravel\\Sail\\Console\\InstallCommand' => 'Laravel\\Sail\\SailServiceProvider',
    'Laravel\\Sail\\Console\\PublishCommand' => 'Laravel\\Sail\\SailServiceProvider',
    'command.tinker' => 'Laravel\\Tinker\\TinkerServiceProvider',
  ),
  'when' => 
  array (
    'Telegram\\Bot\\Laravel\\TelegramServiceProvider' => 
    array (
    ),
    'Laravel\\Sail\\SailServiceProvider' => 
    array (
    ),
    'Laravel\\Tinker\\TinkerServiceProvider' => 
    array (
    ),
  ),
);
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Project Assignment Front-End</title>

  @vite([
  'resources/js/app.js',
  'resources/sass/app.scss'
  ])
</head>
<body class="antialiased">
  <div id="app"></div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email</title>

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      color: #333333
    }
    .logo {
      width: 80px;
      margin-right: 30px;
    }
    .header {
      padding: 30px;
      background-color: #E5E5E5;
      display: flex;
      margin-bottom: 30px;
    }
    .content {
      margin: auto;
      width: 80%
    }
  </style>
</head>
<body>
    {{-- <h3>Hello {{ $name }}</h3>
    <p>{{ $body }}</p> --}}

    {{-- Header --}}
    <div class="container">
      <div class="header">
        <img class="logo" src="{{ $message->embed(asset('img/logo-kota-samarinda.png')) }}" alt="logo-kota-samarinda">
        <h1>Dinas Perumahan dan Permukiman Samarinda</h1>
      </div>
      <div class="content">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore odit nesciunt fugit atque, esse architecto deserunt molestiae temporibus sit asperiores adipisci quaerat aspernatur vero velit dolores quia quo reiciendis dignissimos!
      </div>
    </div>
</body>
</html>
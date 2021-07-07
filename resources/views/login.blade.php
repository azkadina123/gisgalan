<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('login.css') }}">


    <title>Document</title>
</head>
<body>
    

<div class="login">
<center><img style="width:80px;high:80px" src="{{ asset('image/logotegal.png') }}" alt=""></center>
  <h1>Selamat Datang</h1>
    <form method="post">
      <input type="text" name="u" placeholder="Username" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Masuk</button>
    </form>
</div>


</body>
</html>
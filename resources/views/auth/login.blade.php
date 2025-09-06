<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>
  <div class="login-wrapper">

    <form autocomplete='off' class='form' method="POST" action="{{ route('login') }}">
      <div class='control'>
        <h1>
          Sign In
        </h1>
      </div>
      @csrf
      @method("post")
      @if($errors->any())
      @foreach($errors->all() as $err)
      <div class="error" style="color: red;">{{$err}}</div>
      @endforeach
      @endif
      <div class='control block-cube block-input'>
        <input type="email" value="{{old("email")}}" name="email" placeholder="Email" required>
        <div class='bg-top'>
          <div class='bg-inner'></div>
        </div>
        <div class='bg-right'>
          <div class='bg-inner'></div>
        </div>
        <div class='bg'>
          <div class='bg-inner'></div>
        </div>
      </div>
      <div class='control block-cube block-input'>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <div class='bg-top'>
          <div class='bg-inner'></div>
        </div>
        <div class='bg-right'>
          <div class='bg-inner'></div>
        </div>
        <div class='bg'>
          <div class='bg-inner'></div>
        </div>
      </div>
      <button class='btn block-cube block-cube-hover' type='submit'>
        <div class='bg-top'>
          <div class='bg-inner'></div>
        </div>
        <div class='bg-right'>
          <div class='bg-inner'></div>
        </div>
        <div class='bg'>
          <div class='bg-inner'></div>
        </div>
        <div class='text'>
          Log In
        </div>
      </button>
    </form>




  </div>
</body>

</html>
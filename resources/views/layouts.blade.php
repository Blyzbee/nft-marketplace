<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NFT Marketplace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="/">NFT Marketplace</a>
        <div>
          <ul class="navbar-nav ml-auto">
            @guest <!-- Si l'utilisateur n'est pas connecté -->
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Connexion</a>
            </li>
            @else <!-- Si l'utilisateur est connecté -->
            <li class="nav-item">
              <a class="nav-link" href="{{ route('collection') }}">
                Voir ma collection
              </a>
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
              </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    copyright - marketplace nft tous droits réservé
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
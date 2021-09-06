<!doctype html>
  <html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>タグの一覧</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="top">Top</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="list">酒類一覧</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="Alclist">管理者ページ</a>
          </li>
        </ul>
      </div>
    </nav>


    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8 mt-3">
          <h1>タグ一覧</h1>
          @csrf
          <table class="table table-bordered mt-3">
            <thead>
              <tr>
                <th>id</th><th>type</th><th>NAME</th><th>URL</th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $taxonomy)
              <tr>
                <td>{{$taxonomy->id}}</td>
                <td>{{$taxonomy->type}}</td>
                <td><a href="Alcktedit{{$taxonomy->id}}">{{$taxonomy->name}}(編集する)</a></td>
                <td>{{$taxonomy->slug}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
            <div class="col-9"></div>
            <div class="col-3 mt-3">
              <p><a class="btn btn-primary" href="Alcktform" role="button">タグの追加</a></p>
            </div>
          </div>
        </div>
        <div class="col-2"></div>
      </div>
    </div>
  </body>
</html>















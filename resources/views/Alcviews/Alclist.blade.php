<!doctype html>
  <html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>記事リスト</title>
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
          <li class="nav-item">
            <a class="nav-link" href=""></a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mt-1">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <input type="submit" value="ログアウトする">
            </form>
          </li>
        </ul>
      </div>
    </nav>


    <div class="row">
      <div class="col-2">
        <div class="list-group">
          <a href="Alcform" class="list-group-item list-group-item-action list-group-item-secondary">記事を新しく追加する</a>
          <a href="Alcklist" class="list-group-item list-group-item-action list-group-item-secondary">☆カテゴリーの一覧</a>
          <a href="Alctlist" class="list-group-item list-group-item-action list-group-item-secondary">☆タグの一覧</a>
          <a href="Alcktform" class="list-group-item list-group-item-action list-group-item-secondary">カテゴリータグ追加</a>
          <a href="Alcplist" class="list-group-item list-group-item-action list-group-item-secondary">☆管理画像一覧</a>
          <a href="Alcpform" class="list-group-item list-group-item-action list-group-item-secondary">管理画像追加</a>
          <a href="Alcmlist" class="list-group-item list-group-item-action list-group-item-secondary">☆管理者一覧</a>
          <a href="Alcmform" class="list-group-item list-group-item-action list-group-item-secondary">管理者の追加</a>
          <a href="/password/change" class="list-group-item list-group-item-action list-group-item-secondary">ログインユーザーのパスワード変更</a>
        </div>
      </div>
      <div class="container">
        <div class="col-10 mt-3">
          <h1>記事一覧</h1>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>id</th><th>記事タイトル</th><th>記事内容</th><th>URL</th><th>ステータス</th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td><a href="Alcedit{{$post->id}}">{{$post->title}}(編集)</a></td>
                <td>{{$post->content}}</td>
                <td>{{$post->slug}}</td>
                <td>{{$post->status}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>

























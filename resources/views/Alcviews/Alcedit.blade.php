<!doctype html>
  <html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>記事の編集</title>
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
      <a class="nav-link" href="Alclist">管理者ページ<span class="sr-only">(current)</span></a>
    </li>
  </ul>
</div>
</nav>

  <div class="container">
  <div class="row">

    <div class="col-2"></div>

    <div class="col-8 mt-3">
    <h1>記事編集ページ</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form method="POST" action="edit">
      @csrf
      <input type="hidden" name="id" value="{{$post->id}}">

      <div class="form-group">
        <label class="formlabel">商品名</label>
        <input class="form-control" type=text name="title" required value="{{$post->title}}">
      </div>
      
      <div class="form-group">
        <label class="form-label">商品紹介文</label>
        <textarea class="form-control" name="content" required>{!!$post->content!!}</textarea>
      </div>
      
      <div class="form-group">
        <label class="formlabel">URL</label>
        <input class="form-control" type=text name="slug" required value="{{$post->slug}}">
      </div>
      
      <div class="form-group">
        <label class="control-label">ステータス</label>
        <div class="radio">
          <label><input type="radio" name="status" value="publish" @if($post->status === "publish") checked @endif>公開済み</label>
          <label><input type="radio" name="status" value="draft" @if($post->status === "draft") checked @endif>下書き</label>
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label">カテゴリー</label>
        <select class="form-control" name="category">
          @foreach($categories as $category)
          <option value="{{$category->id}}" @if($linked_taxonomy->contains($category->id)) selected @endif>{{$category->name}}</option>
          @endforeach
        </select>
      </div>
     
     <div class="form-group">
        <label class="control-label">タグ</label>
        <div class="checkbox">
          @foreach($tags as $tag)
          <input type="checkbox" name="tag[]" value="{{$tag->id}}" @if($linked_taxonomy->contains($tag->id)) checked @endif>{{$tag->name}}
          @endforeach
        </div>
      </div>

      <label class="control-label">記事に使用する画像</label>
      <div class="row">
        @foreach($plists as $image)
          <div class="col-md-2">
            <ul class="media-list">
              <img src="{{$image->slug}}" style="width:100%">
              <input type="radio" name="image" value="{{$image->id}}"@if($image->id == $post->mime_type) checked @endif>
            </ul>
          </div>
        @endforeach
      </div>
      
      <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary mb-3 mt-3">編集完了</button>
        </div>
      </div>
    </form>

    <h2>記事の削除</h2>
    <form method="POST" action="delete">
      @csrf
      <input type="hidden" name="id" value="{{$post->id}}">
      <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary mb-3 mt-3">記事を削除する</button>
        </div>
      </div>
    </form>
  </body>
</div>

<div class="col-2"></div>

</div>
</div>
  </html>

























<nav class="navbar navbar-default navbar-fixed-bottom" style="background: none; border: none">
  <div class="container-fluid">
    <ul class="navbar-form navbar-right" style="border: none">
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
              data-target="#vocabularyModal">
        <i class="fa fa-language"></i>
      </button>
      <button type="button" class="btn btn-success btn-icon btn-sm" id="doTest">
        Nộp bài
        <i class="fa fa-check-circle"></i>
      </button>
      @isset($questions)
        <button type="button" class="btn btn-info btn-icon" data-toggle="modal"
                data-target=".doing">Tình trạng làm bài
          <i class="entypo-info"></i>
        </button>
      @endisset
    </ul>
  </div>
</nav>
<nav class="navbar navbar-default navbar-fixed-bottom" style="background: none; border: none">
    <div class="container-fluid">
        <ul class="navbar-form navbar-right" style="border: none">
            <div class="btn-group btn-group-sm" role="group">
                <button id="backwardEnglish" class="btn btn-success" type="button">
                    <i class="fa fa-step-backward"></i>
                </button>
                <button id="playEnglish" class="btn btn-success" type="button">
                    <i class="fa fa-play"></i>
                </button>
                <button id="forwardEnglish" class="btn btn-success" type="button">
                    <i class="fa fa-step-forward"></i>
                </button>
            </div>
            <button type="button" id="changeModeBtn" class="btn btn-primary btn-sm"
                    data-toggle="tooltip" data-placement="top"
                    title="Thay đổi chế độ sắp xếp">
                <i class="fa fa-exchange"></i>
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crazyListModal">
                <i class="fa fa-refresh" data-placement="top" title="Đổi bài học" data-toggle="tooltip"></i>
            </button>

            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                    data-target="#vocabularyModal">
                <i class="fa fa-language"></i>
            </button>
            <button type="button" class="btn btn-success btn-icon btn-sm" id="submitEnglishBtn">
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

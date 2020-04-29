const playEnglishBtn = '#playEnglish';
const backwardEnglishBtn = '#backwardEnglish';
const forwardEnglishBtn = '#forwardEnglish';
const audio = '#audio';
const changeModeBtn = '#changeModeBtn';

$(changeModeBtn).click(function () {
    isChange = !isChange;
    isSortOrChange(isChange);
});

class AudioEnglish {
    changeIcon() {
        this.track = document.getElementById('audio');
        if (this.track.paused === true) {
            $(playEnglishBtn).html('<i class="fa fa-pause"></i>');
        } else {
            $(playEnglishBtn).html('<i class="fa fa-play"></i>');
        }
    }

    togglePlay() {
        this.track = document.getElementById('audio');
        if (this.track.paused === true) {
            $(playEnglishBtn).html('<i class="fa fa-pause"></i>');
            this.track.play();
        } else {
            $(playEnglishBtn).html('<i class="fa fa-play"></i>');
            this.track.pause();
        }
    }

    duration(i) {
        this.track = document.getElementById('audio');
        this.track.play();
        this.track.currentTime = this.track.currentTime + (5 * i);
    }
}

const ae = new AudioEnglish();

$(audio).click(function () {
    ae.changeIcon();
});

$(playEnglishBtn).click(function () {
    ae.togglePlay();
});

$(backwardEnglishBtn).click(function () {
    ae.duration(-1);
});

$(forwardEnglishBtn).click(function () {
    ae.duration(1);
});

const writingInput = '.writingInput';
let isPlayer = true;

$(writingInput).keyup(function () {
    isPlayer = false
});

$(document).keyup(function (e) {
    e.preventDefault()
    if (isPlayer) {
        const key = e.which;
        console.log(key);
        if (key === 87) {
            ae.togglePlay();
        } else if (key === 81) {
            ae.duration(-1);
        } else if (key === 69) {
            ae.duration(1);
        } else if (key === 82) {
            isChange = !isChange;
            isSortOrChange(isChange);
        }
    }
    isPlayer = true;
});
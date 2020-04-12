// const {window.echo} = require('../common/window.echo');
console.log(window.echo);
const axios = require('axios');

const messageList = '#messageList';
const userId = $('meta[name=user-id]').attr('content');
const formSendMessage = '#formSendMessage';

class Chat {
    selfMsg(res) {
        return `<div id="${res.id}" class="text-right form-group text-info"><strong>${res.content}</strong></div>`
    }

    msg(res) {
        return `<div id="${res.id}" class="form-group">
                    <p><strong>${res.creator.email}</strong></p>
                    <p>${res.content}</p>
                </div>`
    }

    setMessage(userId, res) {
        if (userId == res.created_by) {
            return this.selfMsg(res);
        }

        return this.msg(res);
    }

}

window.echo.channel('Message')
    .listen('.message', (res) => {
        if ($(`#${res.id}`).length === 0 && userId != res.created_by) {
            const chat = new Chat();
            const msg = chat.msg(res);
            $(messageList).append(msg);
        } else {
            toastr.success('Notify');
        }
    });
//
// if (parseInt(userId) > 0) {
//     window.echo.private(`App.User.${userId}`)
//         .notification(function (notification) {
//             console.log(notification);
//             toastr.success('Notify');
//         });
// }

$(formSendMessage).submit(async function (e) {
    e.preventDefault();
    const self = $(this);
    const url = self.attr('action');
    const data = self.serialize();
    self.trigger('reset');
    const result = await axios.post(url, data);
    const chat = new Chat();
    $(messageList).append(chat.selfMsg(result.data));
});

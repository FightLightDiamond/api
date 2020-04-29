// const {echo} = require('../common/echo');
const groupId = $('meta[name=group-id]').attr('content');

// if(parseInt(groupId) > 0) {
//     window.demo = echo.join(`group.${groupId}`)
//         .here((users) => {
//             console.log('here', users)
//         })
//         .joining((user) => {
//             toastr.success(user.name + ' joined');
//             console.log('joining', user)
//         })
//         .leaving((user) => {
//             console.log('leaving', user)
//         })
//         .listen('.group-wizz', (e) => {
//             console.log('group-wizz', e);
//         }).listenForWhisper('test', (e) => {
//             console.log(e);
//         });
//
// }

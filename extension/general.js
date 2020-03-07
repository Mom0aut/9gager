

setTimeout(function() {req();}, 4000);
setTimeout(function() {req('nsfw');}, 4000);
setTimeout(function() {req('girl');}, 4000);
setTimeout(function() {req('girlcelebrity');}, 4000);
setTimeout(function() {req('cosplay');}, 4000);


let internalReqCounter = 0;
let maxInternalReqCounter = 5000;

function req(channel, next) {
    console.log('9gag rss extension, channel:' + channel + ' next:' + next + ' counter:' + internalReqCounter);

    internalReqCounter++;
    if(internalReqCounter > maxInternalReqCounter) {
        console.log('9gag rss reached maximum:' + maxInternalReqCounter);
        return;
    }

    let url = 'https://9gag.com/v1/group-posts/group/default/type/fresh';
    if(channel)
        url = 'https://9gag.com/v1/group-posts/group/' + channel + '/type/fresh';
    
    if(next)
        url += '?' + next;
    fetch(url)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            sendit(channel, data);
            //console.log('xxxxx:' + data);
        });
}

function sendit(channel, data) {
    fetch('https://9gagrss.xyz/post9gag.php', {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
            mode: 'cors', // no-cors, *cors, same-origin
            credentials: 'same-origin', // include, *same-origin, omit
        },
        body: JSON.stringify(data),
    })
    .then((response) => response.json())
    .then((data) => {
        console.log('Success:', data);
        if(data.next)
            setTimeout(function() {req(channel, data.next);}, 4000);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
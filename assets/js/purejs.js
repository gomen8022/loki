document.addEventListener('DOMContentLoaded', function () {
    var appElement = document.querySelector('#app');
    var movesData = [];

    var appData = {
        location: document.querySelector('meta[name="location"]').getAttribute('content'),
        user_uuid: document.querySelector('header').getAttribute('id'),
        timeOnPage: performance.now(),
        forming_type: document.querySelector('body').getAttribute('id'),
        movesData: movesData
    };

    function mouseEnter(event) {
        appElement.addEventListener('mousemove', mouseMove);
    }

    function mouseLeave(event) {
        appElement.removeEventListener('mousemove', mouseMove);
    }

    function mouseMove(event) {
        blockStatisticResolve(event.target, 'move');
    }

    function mouseClick(event) {
        blockStatisticResolve(event.target, 'click');
    }

    function blockStatisticResolve(target, moveType) {
        let timeStart = moveType === 'click' ? 0 : performance.now();

        var parentBlock, moveData;
        var findSimilar = false;

        if (!target.classList.contains("afterBody")) {
            if (!target.parentElement.classList.contains("afterBody") &&
                target.parentElement.tagName !== 'BODY' &&
                target.parentElement.tagName !== 'HTML') {
                parentBlock = target.closest('.parent');
            } else {
                parentBlock = target;
            }

            let BlockVersion;
            var blockVersions = parentBlock.className.replace(' parent', '').split(' ');

            blockVersions.forEach(function (element) {
                if (element.indexOf('_block_') === 0) {
                    var versions = element.split('_');
                    BlockVersion = versions[2];
                }
            });

            moveData = {
                blockName: parentBlock.id,
                blockVersion: BlockVersion,
                moveType: moveType,
                times: 1,
                time: appData.timeOnPage,
                lead: window.lead // Make sure this variable exists globally or fetch it appropriately
            };

            if (movesData.length > 0) {
                movesData.forEach(function (data, index) {
                    if (data.blockName === parentBlock.id && data.moveType === moveType) {
                        let times = data.times;
                        let timeCurrent = moveType !== 'click' ? data.time + (Math.round((appData.timeOnPage + timeStart) / 10000)) : data.time;
                        findSimilar = true;
                        moveData = {
                            blockName: parentBlock.id,
                            blockVersion: BlockVersion,
                            moveType: moveType,
                            times: times + 1,
                            time: timeCurrent,
                            lead: window.lead
                        };
                        movesData[index] = moveData;
                    }
                });
            }

            if (!findSimilar) {
                movesData.push(moveData);
            }
        }
    }

    function sendUnliqStatistic() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/' + appData.location + '/unliquid-stats', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle success
                console.log(xhr.responseText);
            }
        };
        xhr.send(JSON.stringify({
            data: {
                user_id: appData.user_uuid,
                moves: movesData,
                lead: window.lead,
                forming_type: appData.forming_type
            }
        }));
    }

    function sendStatistic() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/' + appData.location + '/stats', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle success
                console.log(xhr.responseText);
            }
        };
        xhr.send(JSON.stringify({
            data: {
                user_id: appData.user_uuid,
                moves: movesData,
                lead: window.lead,
                forming_type: appData.forming_type
            }
        }));
    }

    // Add event listeners to handle mouse events
    appElement.addEventListener('mouseenter', mouseEnter);
    appElement.addEventListener('mouseleave', mouseLeave);
    appElement.addEventListener('click', mouseClick);
});

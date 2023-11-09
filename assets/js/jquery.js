$(function() {
    var appData = {
        location: $('meta[name="location"]').attr('content'),
        user_uuid: $('header').attr('id'),
        timeOnPage: performance.now(),
        forming_type: $('body').attr('id'),
        movesData: []
    };

    function blockStatisticResolve(target, moveType) {
        let timeStart = 0;
        if (moveType !== 'click') {
            timeStart = performance.now();
        }

        var parentBlock, moveData;
        var findSimilar = false;

        if (!$(target).hasClass("afterBody")) {
            if (!$(target.parentElement).hasClass("afterBody") && target.parentElement.tagName !== 'BODY' && target.parentElement.tagName !== 'HTML') {
                parentBlock = $(target).closest('.parent')[0];
            } else {
                parentBlock = target;
            }

            let BlockVersion;
            var blockVersions = $(parentBlock).attr('class').replace(' parent', '').split(' ');

            blockVersions.forEach((element) => {
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
                lead: window.lead
            }

            if (appData.movesData.length > 0) {
                for (let k in appData.movesData) {
                    if (appData.movesData[k].blockName === parentBlock.id && appData.movesData[k].moveType === moveType) {
                        let times = appData.movesData[k].times;
                        let timeCurrent = 0;
                        if (moveType !== 'click') {
                            timeCurrent = appData.movesData[k].time + (Math.round((appData.timeOnPage + timeStart) / 10000));
                        }
                        findSimilar = true;
                        moveData = {
                            blockName: parentBlock.id,
                            blockVersion: BlockVersion,
                            moveType: moveType,
                            times: times + 1,
                            time: timeCurrent,
                            lead: window.lead
                        };
                        appData.movesData[k] = moveData;
                    }
                }
            }

            if (!findSimilar) {
                appData.movesData.push(moveData);
            }
        }
    }

    $(document).on('mouseenter', function(event) {
        $(document).on('mousemove', function(event) {
            blockStatisticResolve(event.target, 'move');
        });
    }).on('mouseleave', function(event) {
        $(document).off('mousemove');
    });

    $(document).on('click', function(event) {
        blockStatisticResolve(event.target, 'click');
    });

    function sendUnliqStatistic() {
        $.post('/api/' + appData.location + '/unliquid-stats', {
            data: {
                user_id: appData.user_uuid,
                moves: appData.movesData,
                lead: window.lead,
                forming_type: appData.forming_type
            }
        }).done(function(response) {
            // Обробка успішної відповіді
        }).fail(function(error) {
            console.log(error);
        });
    }

    function sendStatistic() {
        $.post('/api/' + appData.location + '/stats', {
            data: {
                user_id: appData.user_uuid,
                moves: appData.movesData,
                lead: window.lead,
                forming_type: appData.forming_type
            }
        }).done(function(response) {
        }).fail(function(error) {
            console.log(error);
        });
    }

});

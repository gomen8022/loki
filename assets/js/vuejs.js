const app = new Vue({
    el: '#app',
    data: {
        location: $('meta[name="location"]').attr('content'),
        user_uuid: $('header').attr('id'), //DUUID.DeviceUUID().get(),
        timeOnPage: performance.now(),
        forming_type: $('body').attr('id'),
        movesData: []
    },
    methods: {
        mouseEnter(event) {
            this.$el.addEventListener('mousemove', this.mouseMove, false);
        },
        mouseLeave(event) {
            // this.$el.removeEventListener('mousemove', this.mouseMove());
        },
        mouseMove(event) {
            this.blockStatisticResolve(event.target, 'move')
        },
        mouseClick(event) {
            this.blockStatisticResolve(event.target, 'click')
        },
        blockStatisticResolve(target, moveType) {
            let timeStart = 0;

            if (moveType !== 'click') {
                timeStart = performance.now()
            }

            var parentBlock, moveData;
            var findSimilar = false;

            if (target.classList.contains("afterBody") === false) {
                if (target.parentElement.classList.contains("afterBody") === false
                    && target.parentElement.tagName !== 'BODY'
                    && target.parentElement.tagName !== 'HTML') {
                    parentBlock = target.closest('.parent');
                } else {
                    parentBlock = target
                }

                let BlockVersion;
                var blockVersions = parentBlock.className.replace(' parent', '').split(' ');

                blockVersions.forEach((element) => {
                    if (element.search('_block_') == 0) {
                        var versions = element.split('_')
                        BlockVersion = versions[2];
                    }
                });

                moveData = {
                    blockName: parentBlock.id,
                    blockVersion: BlockVersion,
                    moveType: moveType,
                    times: 1,
                    time: this.timeOnPage,
                    lead: window.lead
                }

                if (this.movesData.length > 0) {
                    for (let k in this.movesData) {
                        if (this.movesData[k].blockName === parentBlock.id
                            && this.movesData[k].moveType === moveType) {
                            let times = this.movesData[k].times;
                            let timeCurrent = 0;
                            if (moveType !== 'click') {
                                timeCurrent = this.movesData[k].time + (Math.round((this.timeOnPage + timeStart) / 10000))
                            }
                            findSimilar = true;
                            moveData = {
                                blockName: parentBlock.id,
                                blockVersion: BlockVersion,
                                moveType: moveType,
                                times: times + 1,
                                time: timeCurrent,
                                lead: window.lead
                            }
                            this.movesData[k] = moveData
                        }
                    }
                }

                if (!findSimilar) {
                    this.movesData.push(moveData)
                }
            }
        },
        sendUnliqStatistic() {
            axios.post('/api/' + this.location + '/unliquid-stats', {
                data: {
                    user_id: this.user_uuid,
                    moves: this.movesData,
                    lead: window.lead,
                    forming_type: this.forming_type
                }
            })
                .then(function (response) {
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        sendStatistic() {
            axios.post('/api/' + this.location + '/stats', {
                data: {
                    user_id: this.user_uuid,
                    moves: this.movesData,
                    lead: window.lead,
                    forming_type: this.forming_type
                }
            })
                .then(function (response) {
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
});
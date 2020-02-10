(function ($) {
    $.fn.ThreadTable = function (options) {
        var thisTable = this;

        getThead = (showCreate, canCreate) => {
            var templateThead = `
                <thead>
                    <tr>
                        <th colspan="5" style="border-top:none;">
                            <button class="btn btn-outline-dark pull-right" {canCreate}>
                            <i class="fa fa-edit"></i> Create Thread
                            </button>
                        </th>
                    </tr>
                </thead>
            `;

            if (!showCreate)
                return "";
            else if (!canCreate)
                return templateThead.replace("{canCreate}", "disabled");
            else
                return templateThead.replace("{canCreate}", "");
        };

        var defaultObj = {
            name: 'Thread Table',
            url: '/subcategory/{subCategoryId}/threads',
            showCreate: true,
            canCreate: true,
            autoRefresh: false,
            refreshTime: 1000,
            loadThreads: function () {
                thead = getThead(this.showCreate, this.canCreate);
                thisTable.html(thead + `
                    <tbody><tr height="200" class="text-center"><td colspan="5" class="align-middle">Loading...</td></tr></tbody>
                `);
                this.getThreads((isError) => {
                    if (isError) {
                        thisTable.html(thead + `
                            <tbody><tr height="200" class="text-center"><td colspan="5" class="align-middle">Some error has happened. <br> Please reload the page</td></tr></tbody>
                        `);
                    }
                });
            },
            getThreads: function (callback = null) {
                $.ajax({
                    method: 'GET',
                    url: this.url,
                    showCreate: this.showCreate,
                    canCreate: this.canCreate,
                    success: function (data) {
                        var thead = getThead(this.showCreate, this.canCreate);
                        if (data.threads != null && data.threads.length > 0) {
                            var content = thead + '<tbody>';
                            data.threads.forEach((item) => {
                                content += `
                                <tr>
                                    <td>${(item.hot) ? '[HOT]' : ''}</td>
                                    <td>${item.title}</td>
                                    <td>by ${item.author}</td>
                                    <td>
                                    <i class="fa fa-eye"></i> ${item.views} 
                                    <i class="fa fa-comments"></i> ${item.comments}
                                    </td>
                                    <td>${item.lastReply}</td>
                                </tr>
                                `;
                            });
                            content += '</tbody>';
                            thisTable.html(content);
                        }
                        else
                            thisTable.html(thead + `
                                <tbody><tr height="200" class="text-center"><td colspan="5" class="align-middle">There are no threads to be shown</td></tr></tbody>
                            `);
                        if (callback != null) callback(false);
                    },
                    error: function () {
                        if (callback != null) callback(true);
                    }
                });
            }
        };

        var threadTableObj = $.extend({}, defaultObj, options);
        if (threadTableObj.autoRefresh) {
            setInterval(function () { threadTableObj.getThreads(); }, threadTableObj.refreshTime);
        }
        return threadTableObj;
    }
}(jQuery));
(function ($) {
    $.fn.ThreadTable = function (options) {
        var thisTable = this;

        var thead = `
        <thead>
            <tr>
                <th colspan="5" style="border-top:none;">
                    <button class="btn btn-outline-dark pull-right">
                    <i class="fa fa-edit"></i> Create Thread
                    </button>
                </th>
            </tr>
        </thead>
        `;

        var defaultObj = {
            name: 'Thread Table',
            url: '/subcategory/{subCategoryId}/threads',
            autoRefresh: false,
            refreshTime: 1000,
            loadThreads: function () {
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
                    success: function (data) {
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
                                    <td>${item.lastUpdate}</td>
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
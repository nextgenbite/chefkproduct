(function ($) {
    var fileUploadCount = 0;

    $.fn.fileUpload = function () {
        return this.each(function () {
            var fileUploadDiv = $(this);
            var fileUploadId = `fileUpload-${++fileUploadCount}`;

            // Create HTML content for the file upload area
            var fileDivContent = `
                <label for="${fileUploadId}" class="file-upload border-gray-200 shadow dark:bg-gray-700">
                    <div class="dark:bg-slate-400">
                        <i class="material-icons-outlined">cloud_upload</i>
                        <p>Drag & Drop Files Here</p>
                        <span>OR</span>
                        <div>Browse Files</div>
                    </div>
                    <input type="file" accept="image/*" id="${fileUploadId}" name="images[]" multiple hidden />
                </label>
            `;

            fileUploadDiv.html(fileDivContent).addClass("file-container");

            var table = null;
            var tableBody = null;

            // Create a table containing file information
            function createTable() {
                table = $(`
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 30%;">File Name</th>
                                <th>Preview</th>
                                <th style="width: 20%;">Size</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                `);

                tableBody = table.find("tbody");
                fileUploadDiv.append(table);
            }

            // Handle file inputs and display them in the table
            function handleFiles(files) {
                if (!table) {
                    createTable();
                }

                tableBody.empty();
                if (files.length > 0) {
                    $.each(files, function (index, file) {
                        var fileName = file.name;
                        var fileSize = (file.size / 1024).toFixed(2) + " KB";
                        var fileType = file.type;
                        var preview = fileType.startsWith("image")
                            ? `<img src="${URL.createObjectURL(file)}" alt="${fileName}" height="30" class=" h-12">`
                            : `<i class="material-icons-outlined">visibility_off</i>`;

                        var row = $(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${fileName}</td>
                                <td>${preview}</td>
                                <td>${fileSize}</td>
                                <td>${fileType}</td>
                                <td><button type="button" class="deleteBtn"><i class="material-icons-outlined">delete</i></button></td>
                            </tr>
                        `);

                        row.find(".deleteBtn").click(function () {
                            $(this).closest("tr").remove();
                            if (tableBody.find("tr").length === 0) {
                                tableBody.append('<tr><td colspan="6" class="no-file">No files selected!</td></tr>');
                            }
                        });

                        tableBody.append(row);
                    });
                } else {
                    tableBody.append('<tr><td colspan="6" class="no-file">No files selected!</td></tr>');
                }
            }

            // Drag and drop events
            fileUploadDiv.on({
                dragover: function (e) {
                    e.preventDefault();
                    fileUploadDiv.addClass("dragover");
                },
                dragleave: function () {
                    fileUploadDiv.removeClass("dragover");
                },
                drop: function (e) {
                    e.preventDefault();
                    fileUploadDiv.removeClass("dragover");
                    handleFiles(e.originalEvent.dataTransfer.files);
                }
            });

            // File input change event
            fileUploadDiv.find(`#${fileUploadId}`).change(function () {
                handleFiles(this.files);
            });
        });
    };
})(jQuery);

// Initialize the plugin
$(document).ready(function () {
    $(".file-upload-wrapper").fileUpload();
});

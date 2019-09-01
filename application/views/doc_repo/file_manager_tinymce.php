<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
    var FileBrowserDialogue = {
        init: function () {
            // Here goes your code for setting your custom things onLoad.
        },
        mySubmit: function (URL) {
            // pass selected file path to TinyMCE
            parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);

            // close popup window
            parent.tinymce.activeEditor.windowManager.close();
        }
    }

    $(document).ready(function () {
        var customData = {};
        if (config.csrf_protection) {
            customData[config.csrf_token_name] = $.cookie(config.csrf_cookie_name);
        }

        var elf = $('#elfinder').elfinder({
            // set your elFinder options here
            url: '<?php echo $this->config->item('index_page') ? "/{$this->config->item('index_page')}" : '' ?>/doc_repo/file_manager_connector/tinymce', // connector URL (REQUIRED)
            customData: customData,
            defaultView: 'list',
            commandsOptions: {
                getfile: {onlyURL: true}
            },
            getFileCallback: function (file) { // editor callback
                // file.url - commandsOptions.getfile.onlyURL = false (default)
                // file     - commandsOptions.getfile.onlyURL = true
                FileBrowserDialogue.mySubmit(file); // pass selected file path to TinyMCE
            }
        }).elfinder('instance');

        elf.upload = function(files) {
            var hasError;
            elf.log(files); // print to browser consol
            if (hasError) {
                elf.error('upload error');
                return $.Deferred().reject();
            } else {

                window.location.reload();
                return elf.transport.upload(files, elf);
            }
        };
    });
</script>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder" style="margin: 5px;"></div>
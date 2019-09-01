<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        var customData = {};
        if (config.csrf_protection) {
            customData[config.csrf_token_name] = $.cookie(config.csrf_cookie_name);
        }

        var elf = $('#elfinder').elfinder({
            // set your elFinder options here
            url: '<?php echo $this->config->item('index_page') ? "/{$this->config->item('index_page')}" : '' ?>/doc_repo/file_manager_connector/attachment_node/<?php echo (int)$node_id; ?>', // connector URL (REQUIRED)
            customData: customData,
            defaultView: 'list',
            commandsOptions: {
                getfile: {onlyURL: true}
            },
            getFileCallback: function (file) { // editor callback
                parent.getFileFromSidCallback_<?php echo htmlfilter($property_id) ?>(file);

                //remove elfinder
                parent.document.getElementById('sid_wrapper_<?php echo htmlfilter($property_id) ?>').remove();
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
<div id="elfinder"></div>
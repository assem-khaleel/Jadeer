<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript">
    $(document).ready(function () {
        var customData = {};
        if (config.csrf_protection) {
            customData[config.csrf_token_name] = $.cookie(config.csrf_cookie_name);
        }

        var elf = $('#elfinder').elfinder({
            url: '<?php echo $this->config->item('index_page') ? "/{$this->config->item('index_page')}" : '' ?>/doc_repo/file_manager_connector',
            customData: customData,
            defaultView: 'list',
            uiOptions: {
                toolbar: [
                    // toolbar configuration
                    ['back', 'forward'],
                    ['reload'],
                    ['home', 'up'],
                    ['mkdir', 'upload'],
                    ['info'],
                    ['quicklook'],
                    ['rm'],
                    ['rename'],
                    ['search'],
                    ['view']
                ]
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
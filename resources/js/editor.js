
window.editor = function(){

    return {
        wysiwyg: null,
        content: '',
        init: function() {
            
            this.$refs.wysiwyg.contentDocument.querySelector('head').innerHTML += `<style>
            *, ::after, ::before {box-sizing: border-box;}
            :root {tab-size: 4;}
            html {line-height: 1.15;text-size-adjust: 100%;}
            body {margin: 0px; padding: 1rem 0.5rem;}
            body {font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";}
            </style>`;
            this.$refs.wysiwyg.contentDocument.body.innerHTML += ``;
            // Make editable
            this.$refs.wysiwyg.contentDocument.designMode = "on";

            let _this = this;
            this.$refs.wysiwyg.contentDocument.addEventListener('keyup', function(){
                _this.content = _this.$refs.wysiwyg.contentDocument.body.innerHTML;
            });
        },
        format: function(cmd, param) {
            this.$refs.wysiwyg.contentDocument.execCommand(cmd, !1, param||null);
            this.content = this.$refs.wysiwyg.contentDocument.body.innerHTML;
        },
        
    }
}
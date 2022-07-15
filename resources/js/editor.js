
window.editor = function(content){

    return {
        wysiwyg: null,
        content: '',

        fileImageInput: null,

        init: function() {
            this.content = content;
            this.$refs.wysiwyg.contentDocument.querySelector('head').innerHTML += `<style>
            *, ::after, ::before {box-sizing: border-box;}
            :root {tab-size: 4;}
            html {line-height: 1.15;text-size-adjust: 100%;}
            body {margin: 0px; padding: 1rem 0.5rem;}
            body {font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";}
            code{ background: #EEE; padding: 2px; display: inline-block; }
            </style>`;
            this.$refs.wysiwyg.contentDocument.body.innerHTML += this.content;
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

        loadImage: function(){
            this.fileImageInput = document.createElement('input');
            this.fileImageInput.type="file";
            
            let _this = this;

            this.fileImageInput.addEventListener('change', function(){
                const reader = new FileReader();
                reader.onload = (event) => {
                    let data = event.target.result;
                    _this.$refs.wysiwyg.contentDocument.body.innerHTML += `<img src="data:${_this.fileImageInput.files[0].type};base64,${btoa(data)}" class="display: inline-block">`;
                };
                
                reader.readAsBinaryString(_this.fileImageInput.files[0]);
            });
            
            this.fileImageInput.click();

        },

        code: function (){
            const selection = this.$refs.wysiwyg.contentDocument.getSelection();
            this.$refs.wysiwyg.contentDocument.execCommand("insertHTML", false ,`<code>${selection}</code>`);
        }
        
    }
}
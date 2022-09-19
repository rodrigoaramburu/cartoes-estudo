<div class="mt-2">
    <label for="{{$name}}" class="block">{{$label}}</label>
    <textarea name="{{$name}}" id="{{$name}}" class="hidden">{!! $value ?? '{}' !!}</textarea>
    <div id="{{$name}}_div" class="w-full h-auto bg-white border border-gray-700"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const frontEditor = new EditorJS({
                holder: '{{$name}}_div',
                logLevel: 'ERROR',
                data: {!! $value ?? '{}' !!},
                tools: {
                    paragraph:{
                        class: Paragraph,
                        inlineToolbar: true,
                        tunes: ['alignTune'],
                    },
                    header: {
                        class: Header,
                        inlineToolbar: true, 
                        tunes: ['alignTune'], 
                    },
                    embedImage: {
                        class: EmbedImage,
                    },
                    embedAudio: {
                        class: EmbedAudio,
                    },
                    code: {
                        class: CodeTool,
                    },
                    alignTune: {
                        class: AlignmentTuneTool,
                    },
                },
                minHeight: 200,
                
                
                onChange: (api, event) => {
                    api.saver.save().then(outputData => {
                        document.querySelector('#{{$name}}').value = JSON.stringify(outputData);
                    });
                }
            });
        });
    </script>
</div>
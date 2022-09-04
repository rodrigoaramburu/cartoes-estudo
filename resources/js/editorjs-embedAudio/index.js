import css from './index.css';

export default class EmbedAudio {
    constructor({data, config, api, readOnly}){
        this.data = data;
        this.wrapper = undefined;
    }

    static get toolbox() {
        return {
          title: 'Audio',
          icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" /></svg>`
        };
      }

    render(){
        this.wrapper = document.createElement('div');
        this.wrapper.classList.add('embed-audio-wrapper');
        if(this.data.src !== undefined){
            this._createAudio();
            return this.wrapper;
          }

        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'audio/*';

        input.addEventListener('change', () => {
            const reader = new FileReader();
            reader.onload = (event) => {
                const data = event.target.result;
                this.data.src = `data:${input.files[0].type};base64,${btoa(data)}`;
                this._createAudio();
            };
            reader.readAsBinaryString(input.files[0]);
        });
        this.wrapper.appendChild(input);

        return this.wrapper;
    }

    _createAudio(){
        const audio = document.createElement('audio');
        audio.src = this.data.src;
        audio.controls= true;
        
        this.wrapper.innerHTML = '';
        this.wrapper.appendChild(audio);
    }

    save(blockContent){
        return {
          src: this.data.src,
        }
      }
}

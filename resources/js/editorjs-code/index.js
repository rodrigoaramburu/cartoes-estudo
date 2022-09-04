import css from './index.css';

export default class Code {

    constructor({data, config, api, readOnly}){
        this.data = data;
        this.wrapper = undefined;
    }

    static get toolbox() {
        return {
          title: 'Code',
          icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" /></svg>`
        };
    }

    render(){
        this.wrapper = document.createElement('code');
        this.wrapper.contentEditable = true;
        if(this.data.code){
            this.wrapper.innerText = this.data.code;
        }
        this.wrapper.classList.add('code-wrapper');

        return this.wrapper;
    }


    save(blockContent){
        return {
          code: blockContent.innerText,
        }
      }

}
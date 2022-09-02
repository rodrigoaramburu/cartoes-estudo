import css from './index.css';

export default class EmbedImage {

    constructor({data, config, api, readOnly}){
        this.data = data;
        this.data.align = this.data.align ?? 'left';
        this.data.width = this.data.width ?? 'auto';
        this.data.height = this.data.height ?? 'auto';
        this.wrapper = undefined;
    }

    static get toolbox() {
        return {
          title: 'Image',
          icon: '<svg width="17" height="15" viewBox="0 0 336 276" xmlns="http://www.w3.org/2000/svg"><path d="M291 150V79c0-19-15-34-34-34H79c-19 0-34 15-34 34v42l67-44 81 72 56-29 42 30zm0 52l-43-30-56 30-81-67-66 39v23c0 19 15 34 34 34h178c17 0 31-13 34-29zM79 0h178c44 0 79 35 79 79v118c0 44-35 79-79 79H79c-44 0-79-35-79-79V79C0 35 35 0 79 0z"/></svg>'
        };
      }

    render(){
        this.wrapper = document.createElement('div');
        this.wrapper.classList.add('embed-image-wrapper');
        
        if(this.data.url !== undefined){
          this._createImage();
          return this.wrapper;
        }
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        
        input.addEventListener('change', () => {
            const reader = new FileReader();
            reader.onload = (event) => {
                const data = event.target.result;
                this.data.url = `data:${input.files[0].type};base64,${btoa(data)}`;
                this._createImage();
            };
            reader.readAsBinaryString(input.files[0]);
        });
        this.wrapper.appendChild(input);
        return this.wrapper;
    }

    _createImage(){
        const figure = document.createElement('figure');
        figure.classList.add('align-'+this.data.align);
        const img = document.createElement('img');
        img.style.width = this.data.width;
        img.style.height = this.data.height;
        img.src = this.data.url;
        figure.appendChild(img);
        this.wrapper.innerHTML = '';
        this.wrapper.appendChild(figure);
    }

    renderSettings(){
        const settings = [
            {
              name: 'left',
              icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" /></svg>
            `
            },
            {
              name: 'center',
              icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            `
            },
            {
              name: 'right',
              icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" /></svg>`
            }
          ];
          const wrapper = document.createElement('div');
      
          settings.forEach( tune => {
            let button = document.createElement('div');
      
            button.classList.add('cdx-settings-button');
            button.innerHTML = tune.icon;
            button.addEventListener('click', () => {
                this._toggleTuneAlign(tune.name);
                button.classList.toggle('cdx-settings-button--active');
              });
            wrapper.appendChild(button);
          });


          let buttonResize = document.createElement('div');
      
          buttonResize.classList.add('cdx-settings-button');
          buttonResize.innerHTML = `<?xml version="1.0" ?><svg version="1.1" width="16" height="16" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M31.49072,1.90784C31.46204,1.13294,30.76996,0.49829,30,0.5h-7.98633c-1.96869,0.034-1.97394,2.96533,0.00006,3   c-0.00006,0,4.36517,0,4.36517,0l-7.8291,7.8291c-0.58594,0.58594-0.58594,1.53516,0,2.12109s1.53516,0.58594,2.12109,0   L28.5,5.6211v4.36523c0.03174,1.96783,2.96667,1.974,3-0.00006C31.5,9.98633,31.5,2,31.5,2   C31.5,1.96845,31.49268,1.93891,31.49072,1.90784z"/><path d="M25.80176,11.91797c-0.82813,0-1.5,0.67188-1.5,1.5v13.01367c0,1.14063-0.92773,2.06836-2.06836,2.06836H5.56836   C4.42773,28.5,3.5,27.57227,3.5,26.43164V9.7666c0-1.14063,0.92773-2.06836,2.06836-2.06836h13.01367   c0.82813,0,1.5-0.67188,1.5-1.5s-0.67188-1.5-1.5-1.5H5.56836C2.77344,4.69824,0.5,6.97168,0.5,9.7666v16.66504   C0.5,29.22656,2.77344,31.5,5.56836,31.5H22.2334c2.79492,0,5.06836-2.27344,5.06836-5.06836V13.41797   C27.30176,12.58985,26.62988,11.91797,25.80176,11.91797z"/></g></svg>`;
          buttonResize.addEventListener('click', () => {
            this._tuneResize();    
          });
          wrapper.appendChild(buttonResize);
      
          return wrapper;
    }

    _toggleTuneAlign(name){
       this.data.align = name;
       this.wrapper.querySelector('figure').classList.remove('align-left');
       this.wrapper.querySelector('figure').classList.remove('align-center');
       this.wrapper.querySelector('figure').classList.remove('align-right');
       this.wrapper.querySelector('figure').classList.add('align-'+this.data.align);
    }

    _tuneResize(){
      let size = prompt('Inform width and height? (ex. 200px|auto)');
      if(!size) return;
      size = size.split('|')
      this.data.width = size[0];
      this.data.height = size[1];
      this.wrapper.querySelector('figure img').style.width = this.data.width;
      this.wrapper.querySelector('figure img').style.height = this.data.height;
    }

    save(blockContent){
        return {
          url: this.data.url,
          align: this.data.align,
          width:  this.data.width,
          height: this.data.height
        }
      }

}
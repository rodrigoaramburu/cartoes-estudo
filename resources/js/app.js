import Alpine from 'alpinejs'
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import Paragraph from '@editorjs/paragraph';
import EmbedImage from './editorjs-embedImage/index.js';
import EmbedAudio from './editorjs-embedAudio/index.js';
import Code from './editorjs-code/index.js';
import AlignmentTuneTool  from 'editorjs-text-alignment-blocktune';


window.Alpine = Alpine;
Alpine.start();

window.EditorJS = EditorJS;
window.Header = Header;
window.Paragraph = Paragraph;
window.EmbedImage = EmbedImage;
window.EmbedAudio = EmbedAudio;
window.Code = Code
window.AlignmentTuneTool = AlignmentTuneTool;


